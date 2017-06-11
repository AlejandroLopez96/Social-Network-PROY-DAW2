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


use BackendBundle\Entity\User;
//Para crear la objeto user necesitamos el use de la entidad
use BackendBundle\Entity\PrivateMessage;
use AppBundle\Form\PrivateMessageType;

class PrivateMessageController extends Controller {

	private $session;

	public function __construct() {//Utilizamos el constructor que es el primer metodo que se ejecuta al crear el objeto
		$this->session = new Session(); //Aqui iniciarlizamos la variable session y le damos como valor el objeto Session
	}
	//Con esta funcion ya podemos crear sessiones y podemos utilizar los mensajes flash que son parte del objeto session ya que tenemos metodos para utilizar los mensajes flash

	public function indexAction(Request $request){
		
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		
		$private_message = new PrivateMessage();
		$form = $this->createForm(PrivateMessageType::class, $private_message, array(
			'empty_data' => $user
		));
		
		$form->handleRequest($request);
		
		if($form->isSubmitted()){
			if($form->isValid()){
				//upload image
				$file = $form['image']->getData();

				if (!empty($file) && $file != null) {
					$ext = $file->guessExtension(); //Capturamos la extension del fichero con esta funcion
					if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
						$file_name = $user->getId() . time() . "." . $ext;
						$file->move("uploads/messages/images", $file_name);

						$private_message->setImage($file_name);
					} else {
						$private_message->setImage(null);
					}
				} else {
					$private_message->setImage(null);
				}

				//upload document				
				$doc = $form['file']->getData();

				if (!empty($doc) && $doc != null) {
					$ext = $doc->guessExtension(); //Capturamos la extension del fichero con esta funcion
					if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx') {
						$file_name = $user->getId() . time() . "." . $ext;
						$doc->move("uploads/messages/documents", $file_name);

						$private_message->setFile($file_name);
					} else {
						$private_message->setFile(null);
					}
				} else {
					$private_message->setFile(null);
				}

				$private_message->setEmitter($user); //Guargamos en la entidad el usuario que esta guardando la publicacion 
				$private_message->setCreatedAt(new \DateTime("now")); //Con esto metemos la fecha que nosotros estamos utilizando ahora que seria el objeto DateTime de php que nos sacaria la fecha completa con horas minutos seg...del momento de la publicacion
				$private_message->setReaded(0);
				
				$em->persist($private_message);
				$flush = $em->flush();
				
				if($flush == null){
					$status = "El mensaje privado se ha enviado correctamente";
				}else{
					$status = "El mensaje privado no se ha podido enviar correctamente";
				}
				
			}else{
				$status = "El mensaje privado no se ha podido enviar correctamente";
			}
			$this->session->getFlashBag()->add('status', $status);
			return $this->redirectToRoute('private_message_index');
		}
		
		$private_messages = $this->getPrivateMessages($request);
		$this->setReaded($em, $user);
		
		return $this->render('AppBundle:PrivateMessage:index.html.twig', array(
			'form' => $form->createView(),
			'pagination' => $private_messages
		));
	}
	
	
	public function sendedAction(Request $request){
		$private_messages = $this->getPrivateMessages($request, 'sended');
		
		return $this->render('AppBundle:PrivateMessage:sended.html.twig', array(
			'pagination' => $private_messages
		));
		
	}
	
	
	public function getPrivateMessages($request, $type = null){
		$em = $this->getDoctrine()->getManager();
		
		$user = $this->getUser();
		$user_id = $user->getId();
		
		if($type == 'sended'){
			//Saca todos los mensajes privados en los cuales somos nosotros los emisores
			$dql = "SELECT p FROM BackendBundle:PrivateMessage p WHERE"
					. " p.emitter = $user_id ORDER BY p.id DESC";
		}else{
			//Saca todos los mensajes privados en los cuales yo soy el receiver
			$dql = "SELECT p FROM BackendBundle:PrivateMessage p WHERE"
					. " p.receiver = $user_id ORDER BY p.id DESC";
		}
		
		$query = $em->createQuery($dql);
		
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5);
		
		return $pagination;
	}
	
	
	public function notReadedAction(){
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		
		$private_message_repo = $em->getRepository('BackendBundle:PrivateMessage');
		$count_not_readed_msg = count($private_message_repo->findBy(array(
			'receiver' => $user,
			'readed' => 0
		)));
		
		return new Response($count_not_readed_msg);
	}
	
	
	private function setReaded($em, $user){
		$private_message_repo = $em->getRepository('BackendBundle:PrivateMessage');
		$messages = $private_message_repo->findBy(array(
			'receiver' => $user,
			'readed' => 0
		));
		
		
		foreach($messages as $msg){
			$msg->setReaded(1);
			
			$em->persist($msg);
		}
		
		$flush = $em->flush();
				
		if($flush == null){
			$result = true;
		}else{
			$result = false;
		}
		
		return $result;
	}
	
}
