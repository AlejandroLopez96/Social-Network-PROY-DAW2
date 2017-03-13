<?php
namespace AppBundle\Twig;

//Usamos esto ya que es una interfaz que tenemos que usar para hacer un puente entre doctrine y el filtro de twig e inyectar el servicio
use Symfony\Bridge\Doctrine\RegistryInterface;

class LikedExtension extends \Twig_Extension {
	
	protected $doctrine;
	
	public function __construct(RegistryInterface $doctrine) { 
		$this->doctrine = $doctrine;
	}

	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('liked', array($this, 'likedFilter'))
		);
	}
	
	
	public function likedFilter($user, $publication){
		$like_repo = $this->doctrine->getRepository('BackendBundle:Like');
		$publication_liked= $like_repo->findOneBy(array(
			"user" => $user,
			"publication" => $publication
		));
		
		if(!empty($publication_liked) && is_object($publication_liked)){
			$result = true;
		}else{
			$result = false;
		}
		
		return $result;
	}
	
	public function getName(){
		return 'liked_extension';
	}
	
}
