<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Notificacion.php");
require_once(__DIR__."/../model/NotificacionMapper.php");
require_once(__DIR__."/../model/Pago.php");
require_once(__DIR__."/../model/PagoMapper.php");
require_once(__DIR__."/../model/Reserva.php");
require_once(__DIR__."/../model/ReservaMapper.php");
require_once(__DIR__."/../model/InscripcionPartido.php");
require_once(__DIR__."/../model/InscripcionPartidoMapper.php");
require_once(__DIR__."/../model/Grupo.php");
require_once(__DIR__."/../model/GrupoMapper.php");


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
		$this->pagoMapper = new PagoMapper();
		$this->reservaMapper = new ReservaMapper();
		$this->inscripcionPartidoMapper = new InscripcionPartidoMapper();
		$this->grupoMapper = new GrupoMapper();

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
			$user->setSocio(false);

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
		$this->view->setLayout("table");

		// render the view (/view/users/login.php)
		$this->view->render("users", "notificaciones");
	}

	/*funcion que cierra la sesion*/
	public function logout() {
		session_destroy();

		$this->view->redirect("index", "indexNoLogged");

	}

	/*funcion que convierte en socio a un usuario*/
	public function addSocio() {

		$userId = $this->view->getVariable("userId");
		$user = $this->userMapper->findUser($userId);
		$pago = new Pago();

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
	

		if($user->getSocio() == true){
			$this->view->setVariable("esSocio", true);
			$pagoSocio = $this->pagoMapper->findPago($userId);
			$this->view->setVariable("pago", $pagoSocio);
		}else{
			$this->view->setVariable("esSocio", false);
		}

		if(isset($_POST["pago"])){
			$pago->setUsuarioPago($userId);
			if($_POST["pago"] == "anual"){
				$pago->setPrecio(204);
				$fecha_actual = new DateTime(date("Y-m-d"));
				$pago->setFechaValido($fecha_actual->format('Y-m-d'));
			}else{
				$pago->setPrecio(25);
				$fecha_actual = new DateTime(date("Y-m-d"));
				$pago->setFechaValido($fecha_actual->format('Y-m-d'));
			}
			$pago->setEstadoPago("pagado");

			$this->pagoMapper->save($pago);
			$this->userMapper->setSocio($userId, true);

			$this->view->redirect("index", "indexLogged");
		}

		// render the view (/view/users/register.php)
		$this->view->render("users", "socio");

	}

	public function removeSocio() {

		$userId = $this->view->getVariable("userId");
		$user = $this->userMapper->findUser($userId);

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		$pagoSocio = $this->pagoMapper->findPago($userId);

			$this->pagoMapper->remove($pagoSocio->getIdPago());
			$this->userMapper->setSocio($userId, false);

			$this->view->redirect("index", "indexLogged");

		// render the view (/view/users/register.php)
		$this->view->render("users", "socio");

	}

	public function verEstadisticas() {

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		$numReservasHora = $this->reservaMapper->getReservasHora();
		$numReservasTotales = $this->reservaMapper->getTotalSinPartidos();

		$horas = array();
		$porcentajes = array();

		for($i = 0; $i < count($numReservasHora); $i = $i + 2){
			array_push($horas, $numReservasHora[$i]);
			$p = ($numReservasHora[$i + 1] / $numReservasTotales) * 100;
			array_push($porcentajes, round($p,2)); 
		}

		$numSocios = $this->userMapper->getNumSocios();

		$numPartidosPorDeportista = $this->inscripcionPartidoMapper->getPartidosPorDeportista();

		$numInscritosCampeonato = $this->grupoMapper->getInscritosCampeonato();

		$this->view->setVariable("horas", $horas);
		$this->view->setVariable("porcentajes", $porcentajes);
		$this->view->setVariable("numSocios", $numSocios);
		$this->view->setVariable("partidos", $numPartidosPorDeportista);
		$this->view->setVariable("campeonatos", $numInscritosCampeonato);

		$this->view->render("users", "estadisticas");

	}



}
