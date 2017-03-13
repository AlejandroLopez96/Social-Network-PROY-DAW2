<?php
namespace AppBundle\Twig;

//Usamos esto ya que es una interfaz que tenemos que usar para hacer un puente entre doctrine y el filtro de twig e inyectar el servicio
use Symfony\Bridge\Doctrine\RegistryInterface;

class GetUserExtension extends \Twig_Extension {
	
	protected $doctrine;
	
	public function __construct(RegistryInterface $doctrine) { 
		$this->doctrine = $doctrine;
	}

	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('get_user', array($this, 'getUserFilter'))
		);
	}
	
	
	public function getUserFilter($user_id){
		$user_repo = $this->doctrine->getRepository('BackendBundle:User');
		$user= $user_repo->findOneBy(array(
			"id" => $user_id,
		));
		
		if(!empty($user) && is_object($user)){
			$result = $user;
		}else{
			$result = false;
		}
		
		return $result;
	}
	
	public function getName(){
		return 'get_user_extension';
	}
	
}
