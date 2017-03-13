<?php
namespace AppBundle\Services;
use BackendBundle\Entity\Notification;

class NotificationService {
	public $manager;
	
	public function __construct($manager){
		$this->manager = $manager;
	}//Con esto hemos conseguido tener el entitymanager de doctrine aqui para poder trabajar con entidades y repositorios.

	public function set($user, $type, $typeId, $extra = null){
		//Recibe $user que es el user para el que va la notificacion
		//$type es para el tipo de notificacion que es
		//$typeId se recibe en el caso de que tengamos que guardar un iD de un registro en concreto para luego sacar el usuario que le a dado like
		
		$em = $this->manager;
		
		$notification = new Notification();
		$notification->setUser($user);//guardamos el usuario que nos llega por parametro
		$notification->setType($type);//guardamos el tipo de notificacion que nos va a llegar
		$notification->setTypeId($typeId);//guardamos lo que nos llega por parametro
		$notification->setReaded(0);//ponemos que no esta leido por defecto
		$notification->setCreatedAt(new \DateTime("now"));//Le indicamos la fecha en formato DateTime
		$notification->setExtra($extra);
		
		$em->persist($notification);
		$flush = $em->flush();
		
		if($flush == null){
			$status = true;
		}else{
			$status = false;
		}
		
		return $status;
	}
	
	
	public function read($user){
		$em = $this->manager;
		
		$notification_repo = $em->getRepository('BackendBundle:Notification');
		$notifications = $notification_repo->findBy(array('user' => $user));
		
		foreach($notifications as $notification){//ESTO VA A RECORRER CADA UNA DE LAS NOTIFICACIONES
			$notification->setReaded(1);//Esto hace un update en cada registro y le cambia el valor de 0 a 1 y le cambia el valor de notificaciones que tenga cad usuario
		
			$em->persist($notification);
		}
		$flush = $em->flush();
		
		if($flush == null){
			$status = true;
		}else{
			$status = false;
		}
		
		return true;
	}
	
}
