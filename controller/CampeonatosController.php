<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Campeonato.php");
require_once(__DIR__."/../model/CampeonatoMapper.php");
require_once(__DIR__."/../model/CategoriaNivel.php");
require_once(__DIR__."/../model/CategoriaNivelMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Pareja.php");
require_once(__DIR__."/../model/ParejaMapper.php");
require_once(__DIR__."/../model/Grupo.php");
require_once(__DIR__."/../model/GrupoMapper.php");
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
class CampeonatosController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
    private $campeonatoMapper;
	private $categoriaNivelMapper;
	private $userMapper;
	private $parejaMapper;
	private $grupoMapper;
	private $notificacionMapper;

	public function __construct() {
		parent::__construct();

        $this->campeonatoMapper = new CampeonatoMapper();
        $this->categoriaNivelMapper = new CategoriaNivelMapper();
		$this->userMapper = new UserMapper();
		$this->parejaMapper = new ParejaMapper();
		$this->grupoMapper = new GrupoMapper();
		$this->notificacionMapper = new NotificacionMapper();
		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("forms");
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

					// perform the redirection. More or less:
					// header("Location: index.php?controller=users&action=login")
					// die();
					$this->view->setLayout("forms");
					$this->view->redirect("index", "indexLogged");
		}
		$this->view->setLayout("forms");
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
		$categorias_niveles = $this->parejaMapper->findInscritos($userId);
		$campeonatosInscrito = $this->categoriaNivelMapper->findAllCampeonatosInscrito($categorias_niveles);

		$campeonatos = $this->campeonatoMapper->findAllCampeonatosAbiertos($campeonatosInscrito);
		}

		$this->view->setVariable("campeonatos", $campeonatos);
		$this->view->setLayout("table");

		$this->view->render("campeonatos", "showall");
	}	

		public function cerrarCampeonato() {

		$userRol = $this->view->getVariable("userRol");
		
		if (!isset($this->currentUser)) {
			$this->view->redirect("users", "login");
		}

		if($userRol=="deportista"){
			$this->view->redirect("index", "indexLogged");
		}

		if(isset($_GET["idCampeonato"])){
			
			$categoriasNiveles = $this->categoriaNivelMapper->findAll($_GET["idCampeonato"]);
			
			foreach($categoriasNiveles as $cn){
			
			$parejas = $this->parejaMapper->findParejas($cn);
			$numParejas = count($parejas);

			if($numParejas >= 8){

			$done = false;
			$tamaño = 12;
			$tamañoFinal = 12;
			$resto = 8;
			$i = 12;
			$diferencia = $tamaño - $resto;

			while($done==false && $i >= 8){
				if($numParejas % $i == 0){
					$done = true;
					$tamañoFinal = $i;
					$resto = 0;
				}
				$i--;
			}

			$i = 12;
			$encontrado = false;

			while(!$done && $i >= 8){
				$sobrantes = $numParejas % $i;
				if($sobrantes < $resto){
					$tamaño--;
				}else{
					$encontrado = true;
					if($i-$sobrantes < $diferencia){
						$tamañoFinal = $i;
						$diferencia = $tamañoFinal - $sobrantes;
					}
				}
				if($i == 8 && $encontrado){
					$done = true;
					$resto = $numParejas % $tamañoFinal;
				}
				$i--;
			}

			if($done){
				$numGrupos = floor($numParejas / $tamañoFinal);
			}else{
				$i = 12;
				$resto = 7;
				$tamañoFinal = 12;
				$encontrado = false;
				while($i >= 8){
					$grupos = floor($numParejas / $i);
					$gruposProbar = $grupos - 1;
					$faltan = $numParejas - ($gruposProbar * $i);
					if($faltan > 7 && $faltan < 13){
						$encontrado = true;
						$numGrupos = $gruposProbar;
						$tamañoFinal = $i;
						$resto = $faltan;
					}else if(!$encontrado){
					$restoGrupo = $numParejas % $i;
					if($grupos >= 1 && $restoGrupo < $resto){
						$tamañoFinal = $i;
						$resto = $restoGrupo;
					}
				}
				
					$i--;
				}
				}

				//Crear grupos
				for($i = 0; $i < $numGrupos; $i++){
					$grupo = new Grupo();
					$grupo->setCategoriaNivelGrupo($cn);
					$grupo->setNumParejas($tamañoFinal);

					$idGrupo = $this->grupoMapper->save($grupo);

					for($j=($i*$tamañoFinal); $j<($i*$tamañoFinal)+$tamañoFinal;$j++){
						$this->parejaMapper->actualizarPareja($parejas[$j]->getIdPareja(),$idGrupo);
					}
				}
				if($resto >=8 ){
					$grupo = new Grupo();
					$grupo->setCategoriaNivelGrupo($cn);
					$grupo->setNumParejas($resto);
					$idGrupo = $this->grupoMapper->save($grupo);

					for($j=($numGrupos*$tamañoFinal); $j<(($numGrupos*$tamañoFinal)+$resto); $j++){
						$this->parejaMapper->actualizarPareja($parejas[$j]->getIdPareja(),$idGrupo);
					}
				}

			}
		}

			$parejasSinGrupo = $this->parejaMapper->findParejasSinGrupo($categoriasNiveles);
			$campeonato = $this->campeonatoMapper->findCampeonato($_GET["idCampeonato"]);
			foreach($parejasSinGrupo as $parejaSinGrupo){
				$notificacion1 = new Notificacion();
				$notificacion2 = new Notificacion();
				$notificacion1->setIdUsuarioNotificacion($parejaSinGrupo->getDeportista1());
				$notificacion2->setIdUsuarioNotificacion($parejaSinGrupo->getDeportista2());
				$notificacion1->setMensaje("\nSe ha quedado fuera del campeonato ".$campeonato->getNombreCampeonato()."
				. Lo sentimos.");
				$notificacion2->setMensaje("\nSe ha quedado fuera del campeonato ".$campeonato->getNombreCampeonato()."
				. Lo sentimos.");
				$this->notificacionMapper->save($notificacion1);
				$this->notificacionMapper->save($notificacion2);
				$this->parejaMapper->deletePareja($parejaSinGrupo->getIdPareja);
			}

			$this->campeonatoMapper->cerrarCampeonato($_GET["idCampeonato"]);
		}

		
		$this->view->redirect("campeonatos", "showallCampeonatos");
	}

	public function inscribirCampeonato() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "administrador") {
			$this->view->redirect("index","indexLogged");
		}

		if(isset($_GET["idCampeonato"])){

			$campeonato = $this->campeonatoMapper->findCampeonato($_GET["idCampeonato"]);
			//$inscrito = $this->inscripcionPartidoMapper->estaInscrito($userId,$_GET["idPartido"]);

			if(/*$inscrito ||*/ $campeonato->getEstadoCampeonato()=="cerrado"){
				$this->view->redirect("index","indexLogged");
			}
			
			$this->view->setVariable("campeonato", $campeonato);
			$this->view->setLayout("forms");
			$this->view->render("campeonatos", "showCampeonatoInscribir");
		}

		if(isset($_POST["loginPareja"])){
			var_dump($_POST);
			$posibleInscripcion = false;
			$deportista1 = $this->userMapper->findUser($userId);
			$deportista2 = $this->userMapper->findUserLogin($_POST["loginPareja"]);
			$sexoDeportista1 = $deportista1->getSexo();
			$sexoDeportista2 = $deportista2->getSexo();

			switch($_POST["categoria"]){
				case "masculina":
					if($sexoDeportista1 == $sexoDeportista2 && $sexoDeportista2 == "hombre"){
						$posibleInscripcion = true;
					}
				break;
				case "femenina":
					if($sexoDeportista1 == $sexoDeportista2 && $sexoDeportista2 == "mujer"){
						$posibleInscripcion = true;
					}
				break;
				case "mixto":
					if($sexoDeportista2 != $sexoDeportista1){
						$posibleInscripcion = true;
					}
				break;
			}

			$categoriasNiveles = $this->categoriaNivelMapper->findAll($_POST["idCampeonato"]);
			$inscritos = $this->parejaMapper->estanInscritos($deportista1->getIdUsuario(), $deportista2->getIdUsuario(), $categoriasNiveles);

			if($deportista2 == NULL || !$posibleInscripcion || $inscritos){
				$this->view->redirect("index", "indexLogged");
			}

			$categoriaNivel = $this->categoriaNivelMapper->findId($_POST["idCampeonato"],$_POST["categoria"],$_POST["nivel"]);

			$pareja = new Pareja();
			$pareja->setDeportista1($deportista1->getIdUsuario());
			$pareja->setDeportista2($deportista2->getIdUsuario());
			$pareja->setCategoriaNivel($categoriaNivel);


			$this->parejaMapper->save($pareja);

			$this->view->redirect("index", "indexLogged");


		}

		
	}

	/*

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

	
*/
	public function showallCampeonatosInscrito() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "administrador"){
			$this->view->redirect("index","indexLogged");
		}
		$categoriasInscrito = $this->parejaMapper->findInscritos($userId);
		$campeonatosInscrito = $this->categoriaNivelMapper->findAllCampeonatosInscrito($categoriasInscrito);
		$campeonatos = $this->campeonatoMapper->findAll($campeonatosInscrito);
		$this->view->setLayout("table");
		$this->view->setVariable("campeonatos", $campeonatos);

		$this->view->render("campeonatos", "showallInscrito");
	}

	

	


}
