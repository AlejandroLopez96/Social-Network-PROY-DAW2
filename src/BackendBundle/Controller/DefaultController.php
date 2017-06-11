<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
	$em = $this->getDoctrine()->getManager();
	//getDoctrine()->esto nos permite acceder a nuestras entiddades y asi podemos gestionar esas entidades y buscar cualquiera de las entidades.
	//getManager()->esto nos da acceso a trabajar con la base de datos y doctrine
	$user_repo = $em->getRepository("BackendBundle:User");
	//sacamos repositorios que no es mas que un modelo que tiene una entidad y una clase o un modelo de consultas
        
	$user = $user_repo->find(1);
	
	//echo "Bienvenido ". $user->getName()." ".$user->getSurname()." tu email es: ".$user->getEmail();      
	//Recurriendo a su metodo getter podemos obtener el valor de la propiedad
	
	var_dump($user);
	die();
	
	return $this->render('BackendBundle:Default:index.html.twig');
    }
}
