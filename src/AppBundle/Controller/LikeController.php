<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//Aqui utilizamos las configuraciones de la ruta, con esto nos permite hacer rutas con anotaciones
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//Utilizamos la clase controller para poder extender de ella y utilizar un controlador
use Symfony\Component\HttpFoundation\Request;
//Nos permite recoger respuestas http, recoger parametros por get, por post...
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
//Con esto podemos utilizar las sesiones

use BackendBundle\Entity\User;
use BackendBundle\Entity\Publication;
use BackendBundle\Entity\Like;

class LikeController extends Controller {

	public function likeAction($id = null){//le pasamos un id que por defecto va a null
		$user = $this->getUser();//Usuario logueado
		
		$em = $this->getDoctrine()->getManager();
		
		$publication_repo = $em->getRepository('BackendBundle:Publication');
		$publication = $publication_repo->find($id);//Buscamos el objeto de la publicacion que estamos recibiendo por la url y le pasamos la id
	
		$like = new Like();
		$like->setUser($user);
		$like->setPublication($publication);
		
		$em->persist($like);
		$flush = $em->flush();
		
		if($flush == null){
			//LLamamos al servicio de notificaciones que hemos creado 
			$notification = $this->get('app.notification_service');
			//Llamamos al metodo set y le psamos el usuario al que va dirigida la notificacion(el usuario que haya creado la publicacion y reciba el dato),
			//notidficacion de tipo like y tambien pasamos la id del usuario que le ha dado Like a nuestra publicación y tambien guardamos la publicacion a la que el usuario le a dado like y le pasamos el id de la publicacion
			$notification->set($publication->getUser(), 'like', $user->getId(),  $publication->getId());
			
			$status = "Te gusta esta publicacion";
		}else{
			$status = "No se ha podido guardar el me gusta";
		}
		
		return new Response($status);
		
	}
	
	public function unlikeAction($id = null){
		$user = $this->getUser();
		
		$em = $this->getDoctrine()->getManager();
		$like_repo = $em->getRepository('BackendBundle:Like');
		$like = $like_repo->findOneBy(array(
			'user' => $user,
			'publication' => $id//Ponemos $id porque asi sacamos la publicacion que nos llega por la url
		));
		
		$em->remove($like);
		$flush = $em->flush();
		
		if($flush == null){
			$status = "Ya no te gusta esta publicacion";
		}else{
			$status = "No se ha podido desmarcar el me gusta";
		}
		
		return new Response($status);
	}
	
	public function likesAction(Request $request, $nickname = null){
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
		$dql = "SELECT l FROM BackendBundle:Like l WHERE l.user = $user_id ORDER BY l.id DESC";
		$query = $em->createQuery($dql);
		
		$paginator = $this->get('knp_paginator');
		$likes = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		
		return $this->render('AppBundle:Like:likes.html.twig', array(
			'user' => $user,//Aqui va a estar todos los datos del usuario a mostrar
			'pagination' => $likes//En la vista vamos a tener una variable llamada pagination que le pasamos la variable de nuestra accion pagination, entonces la informacion de $pagination se pasa a la vista y en la vista se va a convertir en una variable disponible en la vista
		));
	}
	
}
