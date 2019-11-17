<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Notificacion.php");
require_once(__DIR__."/../model/NotificacionMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class UsersController
*
* Controller to login, logout and user registration

*/
class UsersController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->userMapper = new UserMapper();
		$this->notificacionMapper = new NotificacionMapper();

		$this->view->setLayout("welcome");
	}
/*funcion que inicia sesion para un usuario si esta registrado previamente*/
	public function login() {

		if (isset($_POST["username"])){ 
			if ($this->userMapper->isValidUser($_POST["username"],$_POST["passwd"])) {

				$user = $this->userMapper->findByUserEmail($_POST["username"]);
				$id = $this->userMapper->findByUserID($_POST["username"]);
				$rol = $this->userMapper->findByUserRol($_POST["username"]);
				$_SESSION["currentuser"]= $_POST["username"];
				$_SESSION["userid"]= $id;
				

				$_SESSION["useremail"]=$user->getEmail();

				$_SESSION["userrol"]=$rol;

				$this->view->redirect("index", "indexLogged");

			}else{
				$errors = array();
				$errors["general"] = "Username is not valid";
				$this->view->setVariable("errors", $errors);
			}
		}
		$this->view->setLayout("welcome");

		$this->view->render("users", "login");
	}

	/*funcion que registra a un usuario*/
	public function register() {

		$user = new User();

		if (isset($_POST["username"])){ 
			$user->setUsername($_POST["username"]);
			$user->setPasswd($_POST["passwd"]);
			$user->setNombre($_POST["nombre"]);
			$user->setEmail($_POST["email"]);
			$user->setRol("deportista");
			$user->setSexo($_POST["sexo"]);
			$user->setNivel(1);

			try{
				$user->checkIsValidForRegister(); 
				if (!$this->userMapper->usernameExists($_POST["username"])){

					
					$this->userMapper->save($user);

					$this->view->redirect("users", "login");
				} else {
					$errors = array();
					$errors["username"] = "Username already exists";
					$this->view->setVariable("errors", $errors);
				}
			}catch(ValidationException $ex) {
				
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the User object visible to the view
		$this->view->setVariable("user", $user);

		// render the view (/view/users/register.php)
		$this->view->render("users", "register");

	}

	/* funcion que edita a un usuario*/
	public function edit() {
		
		$userId = $this->view->getVariable("userId");
		$user = $this->userMapper->findUser($userId);
		$userPasswd = $user->getPasswd();
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		if (isset($_POST["username"])){ 
			$user->setUsername($_POST["username"]);
			if(isset($_POST["passwd"]) && $_POST["passwd"] != ""){
				$user->setPasswd($_POST["passwd"]);	
			}
			$user->setNombre($_POST["nombre"]);
			$user->setEmail($_POST["email"]);

			$this->userMapper->edit($user);

			$this->view->redirect("users","logout");
		}

		// Put the User object visible to the view
		$this->view->setVariable("user", $user);
		$this->view->setLayout("forms");


		$this->view->render("users", "edit");
	}

	/*funcion que elimina a un usuario*/
	public function delete() {

		$userId = $this->view->getVariable("userId");

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		$this->userMapper->delete($userId);
		$this->view->redirect("users","logout");

	}

	/*funcion que carga las notificaciones que tiene un usuario*/
	public function notificaciones() {

		$userId = $this->view->getVariable("userId");

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		$notificaciones = $this->notificacionMapper->findNotificacionesId($userId);

		// Put the User object visible to the view
		$this->view->setVariable("notificaciones", $notificaciones);
		$this->view->setLayout("forms");

		// render the view (/view/users/login.php)
		$this->view->render("users", "notificaciones");
	}

	/*funcion que cierra la sesion*/
	public function logout() {
		session_destroy();

		$this->view->redirect("index", "indexNoLogged");

	}



}
