<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Partido.php");
require_once(__DIR__."/../model/PartidoMapper.php");

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

	public function __construct() {
		parent::__construct();

		$this->partidoMapper = new PartidoMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("welcome");
	}
	
	public function addPartido() {
		$partido = new Partido();

		if (isset($_POST["fechaPartido"])){ // reaching via HTTP Post...
			// populate the User object with data form the form
			$fechaPartido=date("Y-m-d",strtotime($_POST["fechaPartido"]));
			$fechaInscripcionPartido=date("Y-m-d", strtotime("-1 day", strtotime($_POST["fechaPartido"])));
			$partido->setFechaPartido($fechaPartido);
            $partido->setFechaFinInscripcion($fechaInscripcionPartido);
            $partido->setPrecioPartido($_POST["precioPartido"]);
            $partido->setEstadoPartido("ABIERTO");

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

		// render the view (/view/users/login.php)
		$this->view->render("partidos", "addPartido");
	}

	public function showallPartidos() {

		$userRol = $this->view->getVariable("userRol");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "ADMINISTRADOR"){
		$partidos = $this->partidoMapper->findAllPartidos();
		}else{
		$partidos = $this->partidoMapper->findAllPartidosAbiertos();
		}
		$this->view->setVariable("partidos", $partidos);

		$this->view->render("partidos", "showall");
	}	

	public function deletePartido() {
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		if(isset($_GET["idPartido"])){

			$this->partidoMapper->deletePartido($_GET["idPartido"]);
			$this->view->redirect("partidos", "showallPartidos");

		}

		$this->view->render("partidos", "showall");
	}

	


}
