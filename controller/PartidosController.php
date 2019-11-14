<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Partido.php");
require_once(__DIR__."/../model/PartidoMapper.php");
require_once(__DIR__."/../model/InscripcionPartido.php");
require_once(__DIR__."/../model/InscripcionPartidoMapper.php");
require_once(__DIR__."/../model/Notificacion.php");
require_once(__DIR__."/../model/NotificacionMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class UsersController
*
* Controller to login, logout and user registration
*
* @author lipido <lipido@gmail.com>
*/
class PartidosController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $partidoMapper;
	private $inscripcionPartidoMapper;
	private $notificacionMapper;

	public function __construct() {
		parent::__construct();

		$this->partidoMapper = new PartidoMapper();
		$this->inscripcionPartidoMapper = new InscripcionPartidoMapper();
		$this->notificacionMapper = new NotificacionMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("welcome");
	}
	
	public function addPartido() {
		$partido = new Partido();
		$userRol = $this->view->getVariable("userRol");

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "deportista"){
			$this->view->redirect("index", "indexLogged");
		}

		if (isset($_POST["fechaPartido"])){ // reaching via HTTP Post...
			// populate the User object with data form the form
			$fechaPartido=date("Y-m-d",strtotime($_POST["fechaPartido"]));
			$fechaInscripcionPartido=date("Y-m-d", strtotime("-3 day", strtotime($_POST["fechaPartido"])));
			$partido->setFechaPartido($fechaPartido);
            $partido->setFechaFinInscripcion($fechaInscripcionPartido);
            $partido->setPrecioPartido($_POST["precioPartido"]);
            $partido->setEstadoPartido("abierto");

					$this->partidoMapper->save($partido);

					// POST-REDIRECT-GET
					// Everything OK, we will redirect the user to the list of posts
					// We want to see a message after redirection, so we establish
					// a "flash" message (which is simply a Session variable) to be
					// get in the view after redirection.
					$this->view->setFlash("Username ".$partido->getIdPartido()." successfully added. Please login now");

					// perform the redirection. More or less:
					// header("Location: index.php?controller=users&action=login")
					// die();
					$this->view->redirect("index", "indexLogged");
		}
		$this->view->setLayout("forms");

		// render the view (/view/users/login.php)
		$this->view->render("partidos", "addPartido");
	}

	public function showallPartidos() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		$this->partidoMapper->actualizarPartidos();
		if($userRol == "administrador"){
		$partidos = $this->partidoMapper->findAllPartidos();
		}else{
		$partidosInscrito = $this->inscripcionPartidoMapper->findPartidosInscritos($userId);
		$partidos = $this->partidoMapper->findAllPartidosAbiertos($partidosInscrito);
		}
		$this->view->setVariable("partidos", $partidos);
		$this->view->setLayout("table");

		$this->view->render("partidos", "showall");
	}	

	public function deletePartido() {

		$userRol = $this->view->getVariable("userRol");
		
		if (!isset($this->currentUser)) {
			$this->view->redirect("users", "login");
		}

		if($userRol=="deportista"){
			$this->view->redirect("index", "indexLogged");
		}

		if(isset($_GET["idPartido"])){
			$partido = $this->partidoMapper->findPartido($_GET["idPartido"]);
			$fechaPartido = $partido->getFechaPartido();
			if($partido->getEstadoPartido() == "cerrado"){
				$this->view->redirect("index","indexLogged");
			}
			$this->partidoMapper->deletePartido($_GET["idPartido"]);
			$numInscripciones = $this->inscripcionPartidoMapper->getNumInscripciones($_GET["idPartido"]);
			if($numInscripciones > 0){
				$inscritos = $this->inscripcionPartidoMapper->getInscritos($_GET["idPartido"]);
				foreach($inscritos as $inscrito){
					$notificacion = new Notificacion();
					$notificacion->setIdUsuarioNotificacion($inscrito);
					$notificacion->setMensaje("El partido con fecha ".$fechaPartido." ha sido cancelado.
					\nLo sentimos.\n");
					$this->notificacionMapper->save($notificacion);
				}
				$this->inscripcionPartidoMapper->deleteInscripciones($_GET["idPartido"]);
			}
			$this->view->redirect("index", "indexLogged");

		}

		$this->view->render("partidos", "showall");
	}

	public function showPartidoInscribir() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "administrador") {
			$this->view->redirect("index","indexLogged");
		}

		if(isset($_GET["idPartido"])){

			$partido = $this->partidoMapper->findPartido($_GET["idPartido"]);
			$inscrito = $this->inscripcionPartidoMapper->estaInscrito($userId,$_GET["idPartido"]);

			if($inscrito || $partido->getEstadoPartido()=="cerrado"){
				$this->view->redirect("index","indexLogged");
			}
			
			$this->view->setVariable("partido", $partido);

		}

		$this->view->render("partidos", "showPartidoInscribir");
	}

	public function inscribirPartido() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "administrador") {
			$this->view->redirect("index","indexLogged");
		}

		if(isset($_GET["idPartido"])){

			$partido = $this->partidoMapper->findPartido($_GET["idPartido"]);
			$inscrito = $this->inscripcionPartidoMapper->estaInscrito($userId,$_GET["idPartido"]);

			if($inscrito || $partido->getEstadoPartido()=="cerrado"){
				$this->view->redirect("index","indexLogged");
			}

			$fechaPartido = $partido->getFechaPartido();
			$pago = $partido->getPrecioPartido();
			$inscripcionPartido = new InscripcionPartido();
			$inscripcionPartido->setIdInscripcionPartido($_GET["idPartido"]);
			$inscripcionPartido->setIdInscripcionUsuario($userId);
			$numInscripciones = $this->inscripcionPartidoMapper->getNumInscripciones($_GET["idPartido"]);
			if($numInscripciones == 3){
				$this->inscripcionPartidoMapper->save($inscripcionPartido);
				$this->partidoMapper->cerrarPartido($_GET["idPartido"]);
				$inscritos = $this->inscripcionPartidoMapper->getInscritos($_GET["idPartido"]);
				foreach($inscritos as $inscrito){
					$notificacion = new Notificacion();
					$notificacion->setIdUsuarioNotificacion($inscrito);
					$notificacion->setMensaje("El partido con fecha ".$fechaPartido." ha sido cerrado.
					\nRecuerde que tendrá que pagar un importe de ".$pago." al acceder al mismo.\n");
					$this->notificacionMapper->save($notificacion);
				}
			}else if($numInscripciones>-1 && $numInscripciones<4){
				$this->inscripcionPartidoMapper->save($inscripcionPartido);
			}else{
				$this->partidoMapper->cerrarPartido($_GET["idPartido"]);
			}

		}
		$this->view->redirect("index","indexLogged");

	}

	

	public function showallPartidosInscrito() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "administrador"){
			$this->view->redirect("index","indexLogged");
		}
		$partidosInscrito = $this->inscripcionPartidoMapper->findPartidosInscritos($userId);
		$partidos = $this->partidoMapper->findAllPartidosInscrito($partidosInscrito);

		$this->view->setVariable("partidos", $partidos);

		$this->view->render("partidos", "showallInscrito");
	}	

	

	


}
