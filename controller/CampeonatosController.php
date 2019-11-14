<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Campeonato.php");
require_once(__DIR__."/../model/CampeonatoMapper.php");
require_once(__DIR__."/../model/CategoriaNivel.php");
require_once(__DIR__."/../model/CategoriaNivelMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class UsersController
*
* Controller to login, logout and user registration
*
* @author lipido <lipido@gmail.com>
*/
class CampeonatosController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
    private $campeonatoMapper;
    private $categoriaNivelMapper;

	public function __construct() {
		parent::__construct();

        $this->campeonatoMapper = new CampeonatoMapper();
        $this->categoriaNivelMapper = new CategoriaNivelMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("welcome");
	}
	
	public function addCampeonato() {
		$campeonato = new Campeonato();
		$userRol = $this->view->getVariable("userRol");

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "deportista"){
			$this->view->redirect("index", "indexLogged");
		}

		if (isset($_POST["nombreCampeonato"])){ // reaching via HTTP Post...
			// populate the User object with data form the form
			$fechaCampeonato=date("Y-m-d",strtotime($_POST["fechaInicio"]));
            $fechaInscripcionCampeonato=date("Y-m-d", strtotime("-3 day", strtotime($_POST["fechaInicio"])));
            $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
            $campeonato->setFechaInicio($fechaCampeonato);
            $campeonato->setFechaFin($_POST["fechaFin"]);
            $campeonato->setFechaLimiteInscripcion($fechaInscripcionCampeonato);
            $campeonato->setPrecioCampeonato($_POST["precioCampeonato"]);
            $campeonato->setEstadoCampeonato("abierto");

                    $id = $this->campeonatoMapper->save($campeonato);

                    $categorias = array("masculina", "femenina", "mixto");

                    for($i = 1; $i < 4; $i++){
                        for($j = 0; $j < 3; $j++){
                        $categoriaNivel = new CategoriaNivel();
                        $categoriaNivel->setCategoria($categorias[$j]);
                        $categoriaNivel->setNivel($i);
                        $categoriaNivel->setCampeonato($id);
                        $this->categoriaNivelMapper->save($categoriaNivel);
                        }
                    }
                    


					// POST-REDIRECT-GET
					// Everything OK, we will redirect the user to the list of posts
					// We want to see a message after redirection, so we establish
					// a "flash" message (which is simply a Session variable) to be
					// get in the view after redirection.
					$this->view->setFlash("Username ".$campeonato->getIdCampeonato()." successfully added. Please login now");

					// perform the redirection. More or less:
					// header("Location: index.php?controller=users&action=login")
					// die();
					$this->view->setLayout("forms");
					$this->view->redirect("index", "indexLogged");
		}

		// render the view (/view/users/login.php)
		$this->view->render("campeonatos", "addCampeonato");
	}

	public function showallCampeonatos() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
        }
        
        //$this->partidoMapper->actualizarPartidos();
        
		if($userRol == "administrador"){
		$campeonatos = $this->campeonatoMapper->findAllCampeonatos();
		}else{
		$campeonatosInscrito = $this->inscripcionPartidoMapper->findPartidosInscritos($userId);
		$campeonatos = $this->partidoMapper->findAllPartidosAbiertos($partidosInscrito);
		}
		$this->view->setVariable("campeonatos", $campeonatos);

		$this->view->render("campeonatos", "showall");
	}	
/*
	public function deletePartido() {

		$userRol = $this->view->getVariable("userRol");
		
		if (!isset($this->currentUser)) {
			$this->view->redirect("users", "login");
		}

		if($userRol=="deportista"){
			$this->view->redirect("index", "indexLogged");
		}

		if(isset($_GET["idPartido"])){
			$campeonato = $this->partidoMapper->findPartido($_GET["idPartido"]);
			$fechaPartido = $campeonato->getFechaPartido();
			if($campeonato->getEstadoPartido() == "CERRADO"){
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

		$this->view->render("campeonatos", "showall");
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

			$campeonato = $this->partidoMapper->findPartido($_GET["idPartido"]);
			$inscrito = $this->inscripcionPartidoMapper->estaInscrito($userId,$_GET["idPartido"]);

			if($inscrito || $campeonato->getEstadoPartido()=="CERRADO"){
				$this->view->redirect("index","indexLogged");
			}
			
			$this->view->setVariable("partido", $campeonato);

		}

		$this->view->render("campeonatos", "showPartidoInscribir");
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

			$campeonato = $this->partidoMapper->findPartido($_GET["idPartido"]);
			$inscrito = $this->inscripcionPartidoMapper->estaInscrito($userId,$_GET["idPartido"]);

			if($inscrito || $campeonato->getEstadoPartido()=="CERRADO"){
				$this->view->redirect("index","indexLogged");
			}

			$fechaPartido = $campeonato->getFechaPartido();
			$pago = $campeonato->getPrecioPartido();
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
		$campeonatos = $this->partidoMapper->findAllPartidosInscrito($partidosInscrito);

		$this->view->setVariable("campeonatos", $campeonatos);

		$this->view->render("campeonatos", "showallInscrito");
	}*/	

	

	


}
