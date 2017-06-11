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
use BackendBundle\Entity\Publication;
use AppBundle\Form\PublicationType;

class PublicationController extends Controller {

	private $session;

	public function __construct() {//Utilizamos el constructor que es el primer metodo que se ejecuta al crear el objeto
		$this->session = new Session(); //Aqui iniciarlizamos la variable session y le damos como valor el objeto Session
	}

	public function indexAction(Request $request) {

		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$publication = new Publication();
		$form = $this->createForm(PublicationType::class, $publication);

		$form->handleRequest($request);
		if ($form->isSubmitted()) {
			if ($form->isValid()) {


				//upload image
				$file = $form['image']->getData();

				if (!empty($file) && $file != null) {
					$ext = $file->guessExtension(); //Capturamos la extension del fichero con esta funcion
					if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
						$file_name = $user->getId() . time() . "." . $ext;
						$file->move("uploads/publications/images", $file_name);

						$publication->setImage($file_name);
					} else {
						$publication->setImage(null);
					}
				} else {
					$publication->setImage(null);
				}

				//upload document				
				$doc = $form['document']->getData();

				if (!empty($doc) && $doc != null) {
					$ext = $doc->guessExtension(); //Capturamos la extension del fichero con esta funcion
					if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx') {
						$file_name = $user->getId() . time() . "." . $ext;
						$doc->move("uploads/publications/documents", $file_name);

						$publication->setDocument($file_name);
					} else {
						$publication->setDocument(null);
					}
				} else {
					$publication->setDocument(null);
				}

				$publication->setUser($user); //Guargamos en la entidad el usuario que esta guardando la publicacion 
				$publication->setCreatedAt(new \DateTime("now")); //Con esto metemos la fecha que nosotros estamos utilizando ahora que seria el objeto DateTime de php que nos sacaria la fecha completa con horas minutos seg...del momento de la publicacion

				$em->persist($publication); //Asi lo guardara dentro de doctrine
				$flush = $em->flush(); //asi lo vuelca a la bd

				if ($flush == null) {
					$status = "La publicación se ha creado correctamente";
				} else {
					$status = "Error al añadir la publicación";
				}
			} else {
				$status = "La publicación no se ha creado, porque el formulario no es válido";
			}

			$this->session->getFlashBag()->add("status", $status);
			return $this->redirectToRoute("home_publications");
		}

		$publications = $this->getPublications($request);
		
		return $this->render('AppBundle:Publication:home.html.twig', array(
					'form' => $form->createView(),
					'pagination' => $publications
		));
	}

	public function getPublications($request) {
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();

		$publication_repo = $em->getRepository('BackendBundle:Publication');
		$following_repo = $em->getRepository('BackendBundle:Following');

		/*
		  SELECT text FROM publications WHERE user_id = 8
		  OR user_id IN (SELECT followed FROM following WHERE user = 8);
		 */

		$following = $following_repo->findBy(array(
			'user' => $user
		)); //asi sacamos todos los registros en los que aparezca mi usuario en el campo user

		$following_array = array(); //aqui se guardan todos los arrays de los usuarios a los que sigo
		foreach ($following as $follow) {
			$following_array[] = $follow->getFollowed(); //Le metemos un elemento al array por cada elemento que tenemos por lo que llegamos a conseguir un array con todos los id limpios
		}

		$query = $publication_repo->createQueryBuilder('p')
				->where('p.user = (:user_id) OR p.user IN (:following)')//Sacamos todas las publicaciones miass o de los usuarios a los que sigo
				->setParameter('user_id', $user->getId())
				->setParameter('following', $following_array)
				->orderBy('p.id', 'DESC')
				->getQuery();

		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5);
		
		return $pagination;
	}

	
	public function removePublicationAction(Request $request, $id = null){
		$em = $this->getDoctrine()->getManager();
		$publication_repo = $em->getRepository('BackendBundle:Publication');
		$publication = $publication_repo->find($id);//Con el find sacamos la publicacion que nos llega por la url que la recogemos como parametro de la Action
		$user = $this->getUser();
		
		if($user->getId() == $publication->getUser()->getId()){
			$em->remove($publication);
			$flush = $em->flush();

			if($flush == null){
				$status = 'La publicación se ha borrado correctamente';
			}else{
				$status = 'La publicación no se ha borrado';
			}
		}else{
			
		}
		return new Response($status);
		
	}
	
}
