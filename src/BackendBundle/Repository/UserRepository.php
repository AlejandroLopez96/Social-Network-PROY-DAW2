<?php
namespace BackendBundle\Repository;

class UserRepository extends \Doctrine\ORM\EntityRepository{//Esto va a extender el propio repositorio que tiene ya de por si la clase User
	public function getFollowingUsers($user){
		$em = $this->getEntityManager();//Dentro de un repositorio el entity manager se saca de esta manera
		$following_repo = $em->getRepository('BackendBundle:Following');
		$following = $following_repo->findBy(array('user' => $user));
		
		$following_array = array();
		foreach($following as $follow){
			$following_array[] = $follow->getFollowed();
		}
		
		$user_repo = $em->getRepository('BackendBundle:User');
		$users = $user_repo->createQueryBuilder('u')
				//Cuando el id es diferente al usuario y cuando el id este dentro de larray de following
				->where("u.id != :user AND u.id IN (:following)")
				//pasamos el parametros de user
				->setParameter('user', $user->getId())
				//pasamos el array following_array 
				->setParameter('following', $following_array)
				//se ordena por id descendente
				->orderBy('u.id', 'DESC');
		
		return $users;
	}
}
