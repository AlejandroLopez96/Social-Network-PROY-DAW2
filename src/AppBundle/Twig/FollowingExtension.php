<?php
namespace AppBundle\Twig;

//Usamos esto ya que es una interfaz que tenemos que usar para hacer un puente entre doctrine y el filtro de twig e inyectar el servicio
use Symfony\Bridge\Doctrine\RegistryInterface;

class FollowingExtension extends \Twig_Extension {
	
	protected $doctrine;
	
	public function __construct(RegistryInterface $doctrine) { 
		$this->doctrine = $doctrine;
	}

	public function getFilters() {
		return array(
			//Esto nos va a permitir defiinir un filtro de twig, el filtro se va a llamar following y le pasamos un array diciendo que esta en esta clase y que metodo va a ser que lo llamamos followingFilter y ese es el metodo que se va a llamar cuando llamamos al filtro dentro de la vista
			new \Twig_SimpleFilter('following', array($this, 'followingFilter'))
		);
	}
	
	
	public function followingFilter($user, $followed){//Esta funcion recibe como parametros el $user osea el usuario que esta identificado y el $followed que es el usuario que supuestamente estoy siguiendo 
		$following_repo= $this->doctrine->getRepository('BackendBundle:Following');//Aqui comprobamos si seguimos o no al $followed
		//Ahora pedimos que nos saque el registro cuyo user sea con el que estoy logueado y cuyo followed (si es que existe) sea el que nos esta llegando por parametro
		$user_following = $following_repo->findOneBy(array(
			"user" => $user,
			"followed" => $followed
		));
		
		if(!empty($user_following) && is_object($user_following)){
			$result = true;
		}else{
			$result = false;
		}
		
		return $result;
		//Con todo esto hemos hecho la comprobacion de si seguimos a un usuario o no
	}
	
	public function getName(){//Esta funcion sirve para definir el nombre que tiene la extension
		return "following_extension";
	}
}
