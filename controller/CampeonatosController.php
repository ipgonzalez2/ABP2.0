<?php

require_once(__DIR__."/../core/ViewManager.php");

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
require_once(__DIR__."/../model/Enfrentamiento.php");
require_once(__DIR__."/../model/EnfrentamientoMapper.php");
require_once(__DIR__."/../model/Pista.php");
require_once(__DIR__."/../model/PistaMapper.php");
require_once(__DIR__."/../model/Calendario.php");
require_once(__DIR__."/../model/CalendarioMapper.php");
require_once(__DIR__."/../model/Partido.php");
require_once(__DIR__."/../model/PartidoMapper.php");


require_once(__DIR__."/../controller/BaseController.php");

/**
* Class CampeonatosController
*
* Controller to campeonatos
*/
class CampeonatosController extends BaseController {

    private $campeonatoMapper;
	private $categoriaNivelMapper;
	private $userMapper;
	private $parejaMapper;
	private $grupoMapper;
	private $notificacionMapper;
	private $enfrentamientoMapper;
	private $pistaMapper;
	private $calendarioMapper;
	private $partidoMapper;

	public function __construct() {
		parent::__construct();

        $this->campeonatoMapper = new CampeonatoMapper();
        $this->categoriaNivelMapper = new CategoriaNivelMapper();
		$this->userMapper = new UserMapper();
		$this->parejaMapper = new ParejaMapper();
		$this->grupoMapper = new GrupoMapper();
		$this->notificacionMapper = new NotificacionMapper();
		$this->enfrentamientoMapper = new EnfrentamientoMapper();
		$this->pistaMapper = new PistaMapper();
		$this->calendarioMapper = new CalendarioMapper();
		$this->partidoMapper = new PartidoMapper();
		$this->view->setLayout("forms");

	}
	

	
	//Función que añade un campeonato con sus correspondientes categorías/niveles.
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

		if (isset($_POST["nombreCampeonato"])){ 
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
					$this->view->setLayout("forms");
					$this->view->redirect("index", "indexLogged");
		}
		$this->view->setLayout("forms");
		$this->view->render("campeonatos", "addCampeonato");
	}

	/*
	Función que muestra un listado de todos los campeonatos al administrador y
	de los disponibles para inscribirse a los deportistas */
	public function showallCampeonatos() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
        }
        
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

		/* Funcion que se encarga de cerrar un campeonato, distibuyendo a las correspondientes
		parejas en grupos que tambien son creados*/
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
				$this->parejaMapper->deletePareja($parejaSinGrupo->getIdPareja());
			}

			//LIGA REGULAR
			$grupos = $this->grupoMapper->findAll($categoriasNiveles);
			foreach($grupos as $grupo){
				$parejas = $this->parejaMapper->findAll($grupo->getIdGrupo());
				for($i = 0; $i < count($parejas); $i++){
					$pareja1 = $parejas[$i];
					for($j = $i+1; $j < count($parejas); $j++){
						$pareja2 = $parejas[$j];
						$enfrentamiento = new Enfrentamiento();
						$enfrentamiento->setPareja1($pareja1->getIdPareja());
						$enfrentamiento->setPareja2($pareja2->getIdPareja());
						$enfrentamiento->setGrupoEnfrentamiento($grupo->getIdGrupo());
						$enfrentamiento->setTipoEnfrentamiento("liga");
						$enfrentamiento->setEstadoEnfrentamiento("abierto");
						//fecha y hora
						$numPistas = $this->pistaMapper->getNumPistas();
						$fechaFin = new DateTime($campeonato->getFechaFin());
						$fechaInicio = new DateTime($campeonato->getFechaInicio());
						$interval = ($fechaInicio->diff($fechaFin))->format("%a");
						$encontrado = false;
						$z = 0;
						while(!$encontrado && $i<$interval){
            			$dias = "+".+$z." days";
						$fecha=date("Y-m-d",strtotime($dias, strtotime($campeonato->getFechaInicio())));
						$horasDia = $this->calendarioMapper->getHoras($fecha, $numPistas);
						$horasPartido = $this->partidoMapper->getHoras($fecha, $numPistas);
						$horasEnfrentamiento = $this->enfrentamientoMapper->getHoras($fecha,$grupo->getIdGrupo());
						$horasSinPartidos = array_diff($horasDia, $horasPartido);
						$horasFinales = array_diff($horasSinPartidos, $horasEnfrentamiento);
						$horasElegir=array();
						foreach($horasFinales as $horaFinal){
							array_push($horasElegir, $horaFinal);
						}
						$juegaAlgunaPareja = $this->enfrentamientoMapper->jueganParejas($pareja1->getIdPareja(),$pareja2->getIdPareja(),$fecha);
						if(!$juegaAlgunaPareja){
							$encontrado=true;
							$enfrentamiento->setFechaEnfrentamiento($fecha);
							$enfrentamiento->setHoraEnfrentamiento($horasElegir[0]);
						}
						$z++;
						}
						$this->enfrentamientoMapper->save($enfrentamiento);
					}
				}
				
			}




			$this->campeonatoMapper->cerrarCampeonato($_GET["idCampeonato"]);
		}

		
		$this->view->redirect("campeonatos", "showallCampeonatos");
	}

	/*Funcion que permite inscribir a una pareja a un campeonato*/
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

			
			$inscritos = $this->parejaMapper->estanInscritos($deportista1->getIdUsuario(), $deportista2->getIdUsuario(), $categoriasNiveles);

			if($deportista2 == NULL || !$posibleInscripcion || $inscritos){
				$this->view->$categoriasNiveles = $this->categoriaNivelMapper->findAll($_POST["idCampeonato"]);direct("index", "indexLogged");
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

	/*funcion que muestra los campeonatos en los que está inscrito un usuario*/
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

	
	/*funcion que muestra los grupos asociados a un campeonato*/
	public function showallGrupos() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "deportista") {
			$this->view->redirect("index","indexLogged");
		}

		if(isset($_GET["idCampeonato"])){

			$categoriasNiveles = $this->categoriaNivelMapper->findAll($_GET["idCampeonato"]);

			$grupos = $this->grupoMapper->findAll($categoriasNiveles);
			$this->view->setVariable("grupos", $grupos);
			$this->view->setLayout("table");
			$this->view->render("campeonatos", "showallGrupos");
		}

	}

	/*funcion que muestra la liga regular asociada a un grupo*/
	public function verLigaRegularGrupo(){

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		if(isset($_GET["idGrupo"])){

			$enfrentamientos = $this->enfrentamientoMapper->getEnfrentamientos($_GET["idGrupo"]);
			$nombresDeportistas=array();

			foreach($enfrentamientos as $e){
				$pareja1 = $this->parejaMapper->findPareja($e->getPareja1());
				$pareja2 = $this->parejaMapper->findPareja($e->getPareja2());
				$deportista1 = $this->userMapper->findUser($pareja1->getDeportista1());
				$deportista2 = $this->userMapper->findUser($pareja1->getDeportista2());
				$deportista3 = $this->userMapper->findUser($pareja2->getDeportista1());
				$deportista4 = $this->userMapper->findUser($pareja2->getDeportista2());
				array_push($nombresDeportistas, $deportista1->getNombre());
				array_push($nombresDeportistas, $deportista2->getNombre());
				array_push($nombresDeportistas, $deportista3->getNombre());
				array_push($nombresDeportistas, $deportista4->getNombre());
			}

			$this->view->setVariable("enfrentamientos", $enfrentamientos);
			$this->view->setVariable("deportistas", $nombresDeportistas);
			$this->view->setLayout("table");
			$this->view->render("campeonatos", "showLigaRegular");
		}
	}
	

	


}
