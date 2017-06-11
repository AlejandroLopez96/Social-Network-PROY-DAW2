<?php
namespace AppBundle\Twig;

//Usamos esto ya que es una interfaz que tenemos que usar para hacer un puente entre doctrine y el filtro de twig e inyectar el servicio
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserStatsExtension extends \Twig_Extension {
	
	protected $doctrine;
	
	public function __construct(RegistryInterface $doctrine) { 
		$this->doctrine = $doctrine;
	}

	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('user_stats', array($this, 'userStatsFilter'))
		);
	}
	
	
	public function userStatsFilter($user){
		$following_repo = $this->doctrine->getRepository('BackendBundle:Following');
		$publication_repo = $this->doctrine->getRepository('BackendBundle:Publication');
		$like_repo = $this->doctrine->getRepository('BackendBundle:Like');
		
		$user_following = $following_repo->findBy(array('user' => $user));//Sacamos todos los registros de la tabla following cuyo usuario es igual al usuario que le pasamos por parametro. Osea cuantos usuarios seguimos
		$user_followers = $following_repo->findBy(array('followed' => $user));//Sacamos nuestros seguidores
		$user_publications = $publication_repo->findBy(array('user' => $user));//Sacamos todas las publicaciones del usuario que indicamos
		$user_likes = $like_repo->findBy(array('user' => $user));//Todas las publicaciones que nos gustan
		
		$result = array(
			'following' => count($user_following),
			'followers' => count($user_followers),
			'publications' => count($user_publications),
			'likes' => count($user_likes)
		);//Con esto nos devuelve un array con toda la informacion que necesitamos de marcadores y estadisticas
		
		return $result;
		
	}
	
	public function getName(){
		return 'user_stats_extension';
	}
	
}
