<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Reserva.php");
require_once(__DIR__."/../model/ReservaMapper.php");
require_once(__DIR__."/../model/Calendario.php");
require_once(__DIR__."/../model/CalendarioMapper.php");
require_once(__DIR__."/../model/Pista.php");
require_once(__DIR__."/../model/PistaMapper.php");
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
class ReservasController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
    private $reservaMapper;
	private $calendarioMapper;
	private $pistaMapper;
	private $partidoMapper;
	private $inscripcionPartidoMapper;
	private $notificacionMapper;

	public function __construct() {
		parent::__construct();

        $this->reservaMapper = new ReservaMapper();
		$this->calendarioMapper = new CalendarioMapper();
		$this->pistaMapper = new PistaMapper();
		$this->partidoMapper = new PartidoMapper();
		$this->inscripcionPartidoMapper = new InscripcionPartidoMapper();
		$this->notificacionMapper = new NotificacionMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("reservar");
	}

	public function addReserva() {

		$reserva = new Reserva();
		$calendario = new Calendario();
		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");


		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		if($userRol == "administrador"){
			$this->view->redirect("index", "indexLogged");
		}
		
		$numReservasUser = $this->reservaMapper->getNumReservasUser($userId);
		if($numReservasUser == 5){
			$this->view->redirect("index", "indexLogged");
		}

        
		if(isset($_POST["hora"])){

        
			$numPistas = $this->pistaMapper->getNumPistas();
			$pistas = $this->pistaMapper->getPistas();
			$pista = $this->calendarioMapper->getPistaLibre($_POST["fecha"],$_POST["hora"],$pistas);
			$esUltimaPistaLibre = $this->calendarioMapper->esUltimaPistaLibre($_POST["fecha"],$_POST["hora"],$pista,$numPistas);
			$reserva->setFecha($_POST["fecha"]);
			$reserva->setPrecio(16);
			$reserva->setUsuarioReserva($userId);
			$reserva->setPistaReserva($pista);
			$reserva->setHora($_POST["hora"]);


			if($esUltimaPistaLibre){
				$partidoMismaFecha = $this->partidoMapper->getPartidoFecha($_POST["fecha"], $_POST["hora"]);
				if($partidoMismaFecha!=NULL){
					$this->partidoMapper->cerrarPartido($partidoMismaFecha);
					$numInscripciones = $this->inscripcionPartidoMapper->getNumInscripciones($partidoMismaFecha);
					if($numInscripciones > 0){
						$inscritos = $this->inscripcionPartidoMapper->getInscritos($partidoMismaFecha);
						foreach($inscritos as $inscrito){
						$notificacion = new Notificacion();
						$notificacion->setIdUsuarioNotificacion($inscrito);
						$notificacion->setMensaje("El partido con fecha ".$_POST["fecha"]." ha sido cancelado.
						\nLo sentimos.\n");
						$this->notificacionMapper->save($notificacion);
						}
						$this->inscripcionPartidoMapper->deleteInscripciones($partidoMismaFecha);
						}
				}
			}
			
			$calendario->setFechaCalendario($_POST["fecha"]);
			$calendario->setEstadoCalendario("ocupado");
			$calendario->setPistaCalendario($pista);
			$calendario->setHoraCalendario($_POST["hora"]);


			$this->reservaMapper->save($reserva);
			$this->calendarioMapper->save($calendario);
			$this->view->redirect("index","indexLogged");
		}

        
		$fechas = array();
		$horas = array();
		$numPistas = $this->pistaMapper->getNumPistas();
        for($i=0; $i < 14; $i++){
            $dias = "+".(7+$i)." days";
			$fecha=date("Y-m-d",strtotime($dias));
			$horasDia = $this->calendarioMapper->getHoras($fecha, $numPistas);
			array_push($fechas, $fecha);
			array_push($horas, $horasDia);
		}

        $this->view->setLayout("reservar");
		$this->view->setVariable("fechas", $fechas);
		$this->view->setVariable("horas", $horas);
		$this->view->render("reservar", "reservar");
	}

	public function showallReservasActivas(){

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");


		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		if($userRol == "administrador"){
			$this->view->redirect("index", "indexLogged");
		}

		$reservasActivas = $this->reservaMapper->getReservasActivas($userId);
		$this->view->setLayout("table");

		$this->view->setVariable("reservasActivas", $reservasActivas);
		$this->view->render("reservas", "showReservasActivas");
	}

	public function deleteReserva() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->redirect("users", "login");
		}

		if($userRol=="administrador"){
			$this->view->redirect("index", "indexLogged");
		}

		if(isset($_GET["idReserva"])){

			if(!($this->reservaMapper->esPropietario($_GET["idReserva"], $userId))){
				$this->view->redirect("index", "indexLogged");
			}

			$reserva = $this->reservaMapper->findReserva($_GET["idReserva"]);
			$fecha_actual = new DateTime(date("Y-m-d"));
 			$fecha = new DateTime($reserva->getFecha());
			 $interval = ($fecha_actual->diff($fecha))->format("%a");
			if($interval==0){
				$this->view->redirect("index", "indexLogged");
			}
  			if($interval == 1){
				$hora_actual = (new DateTime(date("H:i:s",time())))->format("H");
				$minutos_actual = (new DateTime(date("H:i:s",time())))->format("i");
				$hora = (new DateTime($reserva->getHora()))->format("H");
				$minutos = (new DateTime($reserva->getHora()))->format("i");
			if(($hora<$hora_actual || ($hora==$hora_actual && $minutos<$minutos_actual))){   
				$this->view->redirect("index", "indexLogged");
			}
			}
			$this->reservaMapper->deleteReserva($_GET["idReserva"]);
			$this->calendarioMapper->deleteCalendario($reserva->getFecha(), $reserva->getHora(), $reserva->getPistaReserva());
			
			$this->view->redirect("index", "indexLogged");

		}

		$this->view->render("reservas", "showReservasActivas");
	}

	
	}

