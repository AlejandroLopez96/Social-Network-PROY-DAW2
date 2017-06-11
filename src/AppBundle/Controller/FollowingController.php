<?php

namespace AppBundle\Controller;

//Aqui espefico donde esta ésta clase, que esta en AppBundle y el directorio Controller

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//Aqui utilizamos las configuraciones de la ruta, con esto nos permite hacer rutas con anotaciones
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//Utilizamos la clase controller para poder extender de ella como hago abajo en la declaracion de la clase y utilizar un controlador
use Symfony\Component\HttpFoundation\Request;
//Nos permite recoger respuestas http, recoger parametros por get, por post...
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
//Con esto podemos utilizar las sesiones
use BackendBundle\Entity\Following;
use BackendBundle\Entity\User;

//Para crear la objeto user necesitamos el use de la entidad


class FollowingController extends Controller {

	private $session;

	public function __construct() {//Utilizamos el constructor que es el primer metodo que se ejecuta al crear el objeto
		$this->session = new Session(); //Aqui iniciarlizamos la variable session y le damos como valor el objeto Session
	}

	//Con esta funcion ya podemos crear sessiones y podemos utilizar los mensajes flash que son parte del objeto session ya que tenemos metodos para utilizar los mensajes flash


	public function followAction(Request $request) {
		$user = $this->getUser();
		$followed_id = $request->get('followed');

		$em = $this->getDoctrine()->getManager();

		$user_repo = $em->getRepository("BackendBundle:User");
		$followed = $user_repo->find($followed_id); //sacamos los datos del usuario que vamos a seguir

		$following = new Following();
		$following->setUser($user);
		$following->setFollowed($followed);

		$em->persist($following);
		$flush = $em->flush();
		//Ya con todo esto tenemos los id de cada usuario de tanto el user que sigue como el seguido en su tabla correspondiente

		if ($flush == null) {
			$notification = $this->get('app.notification_service');
			$notification->set($followed, 'follow', $user->getId());
			
			
			$status = "Ahora estas siguiendo a este usuario";
		} else {
			$status = "No se ha podido seguir a este usuario";
		}

		return new Response($status);
	}

	public function unfollowAction(Request $request) {
		$user = $this->getUser();
		$followed_id = $request->get('followed');

		$em = $this->getDoctrine()->getManager();

		$following_repo = $em->getRepository("BackendBundle:Following");
		$followed = $following_repo->findOneBy(array(
			'user' => $user,
			'followed' => $followed_id
		));//Sacamos un objeto del registro del follow que hemos hecho dentro de la tabla following

		$em->remove($followed);
		$flush = $em->flush();
		
		if ($flush == null) {
			$status = "Has dejado de seguir a este usuario";
		} else {
			$status = "No has dejado de seguir a este usuario";
		}

		return new Response($status);
	}

	public function followingAction(Request $request, $nickname = null){
		$em = $this->getDoctrine()->getManager();
		
		if($nickname != null){
			$user_repo = $em->getRepository('BackendBundle:User');
			$user = $user_repo->findOneBy(array('nick' => $nickname));
		}else{
			$user = $this->getUser();//Asi cargariamos el perfil del usuario que nosotros tenemos en sesion
		}
		
		if(empty($user) || !is_object($user)){//Si el usuario que llega por url esta vacio o no es un objeto nos redirige a home_publications
			return $this->redirect($this->generateUrl('home_publications'));
		}
		
		$user_id = $user->getId();
		//Vamos a sacar todos los registros de la tabla followin cuyo usuario sea el $user_id
		$dql = "SELECT f FROM BackendBundle:Following f WHERE f.user = $user_id ORDER BY f.id DESC";
		$query = $em->createQuery($dql);
		
		$paginator = $this->get('knp_paginator');
		$following = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		
		return $this->render('AppBundle:Following:following.html.twig', array(
			'type' => 'following',//Aqui guardamos un string con el tipo que estamos usando (siguiendo o seguir)
			'profile_user' => $user,//Aqui va a estar todos los datos del usuario a mostrar
			'pagination' => $following//En la vista vamos a tener una variable llamada pagination que le pasamos la variable de nuestra accion pagination, entonces la informacion de $pagination se pasa a la vista y en la vista se va a convertir en una variable disponible en la vista
		));
	}
	
	public function followedAction(Request $request, $nickname = null){
		$em = $this->getDoctrine()->getManager();
		
		if($nickname != null){
			$user_repo = $em->getRepository('BackendBundle:User');
			$user = $user_repo->findOneBy(array('nick' => $nickname));
		}else{
			$user = $this->getUser();//Asi cargariamos el perfil del usuario que nosotros tenemos en sesion
		}
		
		if(empty($user) || !is_object($user)){//Si el usuario que llega por url esta vacio o no es un objeto nos redirige a home_publications
			return $this->redirect($this->generateUrl('home_publications'));
		}
		
		$user_id = $user->getId();
		//Vamos a sacar todos los registros de la tabla following cuyo usuario seguido sea el $user_id
		$dql = "SELECT f FROM BackendBundle:Following f WHERE f.followed = $user_id ORDER BY f.id DESC";
		$query = $em->createQuery($dql);
		
		$paginator = $this->get('knp_paginator');
		$followed = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		
		return $this->render('AppBundle:Following:following.html.twig', array(
			'type' => 'followed',//Aqui guardamos un string con el tipo que estamos usando (siguiendo o seguido)
			'profile_user' => $user,//Aqui va a estar todos los datos del usuario a mostrar
			'pagination' => $followed//En la vista vamos a tener una variable llamada pagination que le pasamos la variable de nuestra accion pagination, entonces la informacion de $pagination se pasa a la vista y en la vista se va a convertir en una variable disponible en la vista
		));
	}
	
}
