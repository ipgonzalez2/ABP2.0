<?php

require_once(__DIR__."/../core/ViewManager.php");

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
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class ReservasController
*
* Controller to reservas
*/
class ReservasController extends BaseController {

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
		$this->userMapper = new UserMapper();

		$this->view->setLayout("reservar");
	}

	/* funcion que añade una reserva para una hora y una fecha*/
	public function addReserva() {

		$reserva = new Reserva();
		$calendario = new Calendario();
		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		$user = $this->userMapper->findUser($userId);


		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		if($userRol == "administrador"){
			$this->view->redirect("index", "indexLogged");
		}
		
		$numReservasUser = $this->reservaMapper->getNumReservasUser($userId);
		if($numReservasUser >= 5){
			$this->view->setFlash("Maximo de 5 reservas activas");
			$this->view->redirect("index", "indexLogged");
		}

        
		if(isset($_POST["hora"])){

        
			$numPistas = $this->pistaMapper->getNumPistas();
			$pistas = $this->pistaMapper->getPistas();
			$pista = $this->calendarioMapper->getPistaLibre($_POST["fecha"],$_POST["hora"],$pistas);
			$esUltimaPistaLibre = $this->calendarioMapper->esUltimaPistaLibre($_POST["fecha"],$_POST["hora"],$pista,$numPistas);
			$reserva->setFecha($_POST["fecha"]);
			if($user->getSocio()==true){
				$reserva->setPrecio(12);
			}else{
			$reserva->setPrecio(22);
			}
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
							$user = $this->userMapper->findUser($inscrito);
							$email = $user->getEmail();
						$notificacion = new Notificacion();
						$notificacion->setIdUsuarioNotificacion($inscrito);
						$mensaje = "El partido con fecha ".$_POST["fecha"]." ha sido cancelado.
						\nLo sentimos.\n";
						$notificacion->setMensaje($mensaje);
						$mensaje = wordwrap($mensaje, 70, "\r\n");
						$this->notificacionMapper->save($notificacion);
						$email = "padelbit@gmail.com";
		$headers = 'From: ' .$email . "\r\n". 
  		'Reply-To: ' . $email. "\r\n" . 
  		'X-Mailer: PHP/' . phpversion();
						mail($email, "Partido cancelado", $mensaje, $headers);
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

			$horasReservas = $this->reservaMapper->getHorasReserva($fecha, $userId);
			$horasFinalesDia = array_diff($horasDia, $horasReservas);
			array_push($fechas, $fecha);
			array_push($horas, $horasFinalesDia);
		}

        $this->view->setLayout("reservar");
		$this->view->setVariable("fechas", $fechas);
		$this->view->setVariable("horas", $horas);
		$this->view->render("reservar", "reservar");
	}

	/*funcion que muestra las reservas activas de un usuario*/

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


	/*funcion que elimina una reserva con un margen de 1 dia*/
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

