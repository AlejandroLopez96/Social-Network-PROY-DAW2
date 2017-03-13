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
use AppBundle\Form\RegisterType;
use AppBundle\Form\UserType;

class UserController extends Controller {

	private $session;

	public function __construct() {//Utilizamos el constructor que es el primer metodo que se ejecuta al crear el objeto
		$this->session = new Session(); //Aqui iniciarlizamos la variable session y le damos como valor el objeto Session
	}

//Con esta funcion ya podemos crear sessiones y podemos utilizar los mensajes flash que son parte del objeto session ya que tenemos metodos para utilizar los mensajes flash

	public function loginAction(Request $request) {//Con el objeto Request vamos a poder recibir peticiones por http y poder recibir parametros get y post
		if (is_object($this->getUser())) {//Si el metodo getUser nos devuelve un objeto entonces nos redirige al /home porque significa que el usuario esta logeado
			return $this->redirect('home');
		}

		$authenticationUtils = $this->get('security.authentication_utils'); //Esto es el servicio de autentificacion de Symfony
		$error = $authenticationUtils->getLastAuthenticationError();
		$lastUsername = $authenticationUtils->getLastUsername(); //Aqui guardamos la informacion de cuando alguien se intenta logear y falla
		//Al definir todos estos metodos ya va a funcionar la autentificacion

		return $this->render('AppBundle:User:login.html.twig', array(
					'last_username' => $lastUsername,
					'error' => $error
		));
	}

	public function registerAction(Request $request) {//Con el objeto Request vamos a poder recibir peticiones por http y poder recibir parametros get y post
		if (is_object($this->getUser())) {
			return $this->redirect('home');
		}

		$user = new User();
		$form = $this->createForm(RegisterType::class, $user);

		//Esto sirve para settear directamente en el objeto Usuario lo que se recibe por el metodo post
		$form->handleRequest($request);
		//Este if comprobamos que el formulario se ha enviado correctamente
		if ($form->isSubmitted()) {
			//Y con este comprobamos que el formulario es valido
			if ($form->isValid()) {
				//Conseguimos el EntityManager para empezar a trabajar con la bd
				$em = $this->getDoctrine()->getManager();
				//$user_repo = $em->getRepository("BackendBundle:User") carga el repositorio o la Entidad Usuario y tenemos acceso a hacer consultas sobre esa entidad
				//$user_repo = $em->getRepository("BackendBundle:User");
				//La query-> Saca todo los objetos de usuario con los datos cargados de bd cuyo email sea igual al email que pasamos por parametro o cuyo nick sea igual al nick que pasamos por parametro
				$query = $em->createQuery('SELECT u FROM BackendBundle:User u WHERE u.email = :email OR u.nick = :nick')
						->setParameter('email', $form->get("email")->getData())//Con esto conseguimos el dato que nos llega por post en el campo email en el formulario y en el siguiente del nick
						->setParameter('nick', $form->get("nick")->getData());

				$user_isset = $query->getResult(); //Con esto sabemos directamente si nos devuelve algo o no

				if (count($user_isset) == 0) {

					//Codificacion de contraseña
					$factory = $this->get("security.encoder_factory"); //Security es un servicio de symfony
					$encoder = $factory->getEncoder($user); //Utilizo el factory para saacar el encode que tiene la clase usuario


					$password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());
					//Utilizamos el objeto encode y va a utilizar un metodo que se llama encodePassword y le pasamos el valor por post que nos llega por formulario y obtenemos el valor, y despues utilizamos el Salt que tenga la clase usuario

					$user->setPassword($password);
					$user->setRole("ROLE_USER");
					$user->setImage(null);

					$em->persist($user); //Esto volcamos dentro de doctrine todos los datos que hemos hecho, guardar ese objeto y persistirlo dentro de doctrine y luego guardarlo en la base de datos
					$flush = $em->flush(); //Con esto pasamos todos los objetos que tengamos persistidos lo pasa a la base de datos

					if ($flush == null) {
						$status = "Te has registrado correctamente";
						$this->session->getFlashBag()->add("status", $status);
						return $this->redirect("login");
					} else {
						$status = "No te has registrado correctamente";
					}
				} else {
					$status = "El usuario ya existe!!";
				}
			} else {
				$status = "No te has registrado correctamente!!";
			}

			$this->session->getFlashBag()->add("status", $status); //Con esto creamos el mensaje Flash
		}

		return $this->render('AppBundle:User:register.html.twig', array(
					"form" => $form->createView()
		));
	}

	public function nickTestAction(Request $request) {
		$nick = $request->get("nick"); //Aqui guardamos en la variable nick lo que recogemos por post que es el parametro nick

		$em = $this->getDoctrine()->getManager();
		$user_repo = $em->getRepository("BackendBundle:User");
		$user_isset = $user_repo->findOneBy(array("nick" => $nick)); ///El findOneBy lo que hace es buscar una aparicion de ese nick en la base de datos y asi sabremos si esta siendo utilizado es nick o no

		$result = "used";
		if (count($user_isset) >= 1 && is_object($user_isset)) {//Con is_object comprobamos que sea un objeto
			$result = "used";
		} else {
			$result = "unused";
		}

		return new Response($result);
	}

	public function editUserAction(Request $request) {

		$user = $this->getUser(); //Esto va a cargar los datos del usuario que esta logueado dentro del formulario
		$user_image = $user->getImage(); //Para poder guardar la imagen antigua en el caso de que no subamos ninguna imagen por formulario
		$form = $this->createForm(UserType::class, $user);

		//Esto sirve para settear directamente en el objeto Usuario lo que se recibe por el metodo post
		$form->handleRequest($request);
		//Este if comprovamos que el formulario se ha enviado correctamente
		if ($form->isSubmitted()) {
			//Y con este comprobamos que el formulario es valido
			if ($form->isValid()) {
				//Conseguimos el EntityManager para empezar a trabajar con la bd
				$em = $this->getDoctrine()->getManager();
				//La query-> Saca todo los objetos de usuario con los datos cargados de bd cuyo email sea igual al email que pasamos por parametro o cuyo nick sea igual al nick que pasamos por parametro
				$query = $em->createQuery('SELECT u FROM BackendBundle:User u WHERE u.email = :email OR u.nick = :nick')
						->setParameter('email', $form->get("email")->getData())//Con esto conseguimos el dato que nos llega por post en el campo email en el formulario y en el siguiente del nick
						->setParameter('nick', $form->get("nick")->getData());

				$user_isset = $query->getResult(); //Con esto sabemos directamente si nos devuelve algo o no
				//Si el email del usuario logueado y el email del usuario que existe en la bd es igual,  y el nick del usuario logueado y el nick del usuario que existe en la bd es igual, entonces va a poder actualizar el usuario  o por el caso contrario si el usserisset da 0 si no existe lo vas a poder modificar
				if (count($user_isset) == 0 || ($user->getEmail() == $user_isset[0]->getEmail() && $user->getNick() == $user_isset[0]->getNick())) {

					//upload files
					$file = $form["image"]->getData();

					if (!empty($file) && $file != null) {//Si $file no esta vacia y tampoco esta a null entonces me va apermitir subir esa imagen
						$ext = $file->guessExtension(); //Aqui sacamos la extension del fichero que se esta subiendo 
						if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
							$file_name = $user->getId() . time() . "." . $ext;
							$file->move("uploads/users", $file_name);

							$user->setImage($file_name);
						}
					} else {
						$user->setImage($user_image); //$user_image es la imagen por defecto que va a tener el usuario subida por defecto
					}

					$em->persist($user); //Esto volcamos dentro de doctrine todos los datos que hemos hecho, guardar ese objeto y persistirlo dentro de doctrine y luego guardarlo en la base de datos
					$flush = $em->flush(); //Con esto pasamos todos los objetos que tengamos persistidos lo pasa a la base de datos

					if ($flush == null) {
						$status = "Has modificado correctamente tus datos.";
					} else {
						$status = "No has modificado tus datos correctamente";
					}
				} else {
					$status = "El usuario ya existe!!";
				}
			} else {
				$status = "No se han actualizado tus datos correctamente";
			}

			$this->session->getFlashBag()->add("status", $status); //Con esto creamos el mensaje Flash
			return $this->redirect("my-data");
		}

		return $this->render('AppBundle:User:edit_user.html.twig', array(
					"form" => $form->createView()
		));
	}

	public function usersAction(Request $request) {

		$em = $this->getDoctrine()->getManager();

		$dql = "SELECT u from BackendBundle:User u ORDER BY u.id ASC"; //Esta consulta es al objeto de User y nos saca todos los registro de la tabla usuarios
		$query = $em->createQuery($dql);

		$paginator = $this->get("knp_paginator"); //Esto es un servicio que ya tiene el bundle de KnpPaginatorBundle
		//en paginate se pasan varios parametros el 1 es la query, el 2 es el parametro get que estamso recogiendo de la url mediante el obj request de httpFundation y el 3 es el numero de registro que va a mostrar por pagina
		$pagination = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		
		//En el array pasamos variables y opciones para la vista
		return $this->render('AppBundle:User:users.html.twig', array(
			'pagination' => $pagination//En la vista vamos a tener una variable llamada pagination que le pasamos la variable de nuestra accion pagination, entonces la informacion de $pagination se pasa a la vista y en la vista se va a convertir en una variable disponible en la vista
		));
	}

	
	public function searchAction(Request $request) {

		$em = $this->getDoctrine()->getManager();
		
		$search = trim($request->query->get("search", null));//Trim lo que hace es limpiar los espacios que se puedan meter en el buscador
		
		if($search == null){//Si $search esta vacia os redirecciona a una ruta que generamos con generateURL que es 'home_publications' y poniendo esto nos lleva al home
			return $this->redirect($this->generateURL('home_publications'));
		}

		$dql = "SELECT u from BackendBundle:User u "
				. "WHERE u.name LIKE :search OR u.surname LIKE :search OR u.nick LIKE :search "
				. "ORDER BY u.id ASC"; //Esta consulta es al objeto de User y nos saca todos los registro de la tabla usuarios
		$query = $em->createQuery($dql)->setParameter('search', "%$search%");//setParameter lo que hace es limpiar y escapar los string que recibimos por la url y segurizarlos 
		//Lo que hacemos aqui arriba es que dentro del parametro search va a guardar entre %...% el contenido de la cadena que hay guardada en la variable $search por lo que encuentra cualquier coincidencia que con las letras que escriba en el search
		
		
		$paginator = $this->get("knp_paginator"); //Esto es un servicio que ya tiene el bundle de KnpPaginatorBundle
		//en paginate se pasan varios parametros el 1 es la query, el 2 es el parametro get que estamso recogiendo de la url mediante el obj request de httpFundation y el 3 es el numero de registro que va a mostrar por pagina
		$pagination = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		
		//En el array pasamos variables y opciones para la vista
		return $this->render('AppBundle:User:users.html.twig', array(
			'pagination' => $pagination//En la vista vamos a tener una variable llamada pagination que le pasamos la variable de nuestra accion pagination, entonces la informacion de $pagination se pasa a la vista y en la vista se va a convertir en una variable disponible en la vista
		));
	}


	public function profileAction(Request $request, $nickname = null){
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
		//Vamos a sacar todas la publicaciones de nuestra tabla publication cuyo usuario sea el $user_id
		$dql = "SELECT p FROM BackendBundle:Publication p WHERE p.user = $user_id ORDER BY p.id DESC";
		$query = $em->createQuery($dql);
		
		$paginator = $this->get('knp_paginator');
		$publications = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		
		return $this->render('AppBundle:User:profile.html.twig', array(
			'user' => $user,//Aqui va a estar todos los datos del usuario a mostrar
			'pagination' => $publications//En la vista vamos a tener una variable llamada pagination que le pasamos la variable de nuestra accion pagination, entonces la informacion de $pagination se pasa a la vista y en la vista se va a convertir en una variable disponible en la vista
		));
		
	}

	
}
