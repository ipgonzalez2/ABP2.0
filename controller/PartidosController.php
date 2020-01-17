<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Partido.php");
require_once(__DIR__."/../model/PartidoMapper.php");
require_once(__DIR__."/../model/InscripcionPartido.php");
require_once(__DIR__."/../model/InscripcionPartidoMapper.php");
require_once(__DIR__."/../model/Notificacion.php");
require_once(__DIR__."/../model/NotificacionMapper.php");
require_once(__DIR__."/../model/Calendario.php");
require_once(__DIR__."/../model/CalendarioMapper.php");
require_once(__DIR__."/../model/Pista.php");
require_once(__DIR__."/../model/PistaMapper.php");
require_once(__DIR__."/../model/Reserva.php");
require_once(__DIR__."/../model/ReservaMapper.php");
require_once(__DIR__."/../model/Enfrentamiento.php");
require_once(__DIR__."/../model/EnfrentamientoMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");


require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PartidosController
*
* Controller to partidos
*/
class PartidosController extends BaseController {

	private $partidoMapper;
	private $inscripcionPartidoMapper;
	private $notificacionMapper;
	private $calendarioMapper;
	private $pistaMapper;
	private $reservaMapper;
	private $enfrentamientoMapper;

	public function __construct() {
		parent::__construct();

		$this->partidoMapper = new PartidoMapper();
		$this->inscripcionPartidoMapper = new InscripcionPartidoMapper();
		$this->notificacionMapper = new NotificacionMapper();
		$this->calendarioMapper = new CalendarioMapper();
		$this->pistaMapper = new PistaMapper();
		$this->reservaMapper = new ReservaMapper();
		$this->enfrentamientoMapper = new EnfrentamientoMapper();
		$this->userMapper = new UserMapper();

		$this->view->setLayout("welcome");
	}
	

	/*funcion que permite al administrador crear un partido*/
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

		if (isset($_POST["hora"])){ 
			$fechaInscripcionPartido=date("Y-m-d", strtotime("-1 day", strtotime($_POST["fecha"])));
			$partido->setFechaPartido($_POST["fecha"]);
            $partido->setFechaFinInscripcion($fechaInscripcionPartido);
            $partido->setPrecioPartido(9);
			$partido->setEstadoPartido("abierto");
			$partido->setHoraPartido($_POST["hora"]);

					$this->partidoMapper->save($partido);
					$this->view->redirect("index", "indexLogged");
		}
		$fechas = array();
		$horas = array();
		$numPistas = $this->pistaMapper->getNumPistas();
        for($i=0; $i < 14; $i++){
            $dias = "+".(7+$i)." days";
			$fecha=date("Y-m-d",strtotime($dias));
			$horasDia = $this->calendarioMapper->getHoras($fecha, $numPistas);
			$horasPartido = $this->partidoMapper->getHoras($fecha, $numPistas);
			$horasEnfrentamiento = $this->enfrentamientoMapper->getHorasPistas($fecha, $numPistas);
			$horasFinales = array_diff($horasDia, $horasPartido);
			$horasElegir = array_diff($horasFinales, $horasEnfrentamiento);
			array_push($fechas, $fecha);
			array_push($horas, $horasFinales);
		}

		$this->view->setLayout("reservar");
		$this->view->setVariable("fechas", $fechas);
		$this->view->setVariable("horas", $horas);

		$this->view->render("partidos", "addPartido");
	}

	/*funcion que muestra todos los partidos al administrador
	y los disponibles para inscribirse a los deportistas*/
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


	/*funcion que elimina un partido*/
	public function deletePartido() {

		$userRol = $this->view->getVariable("userRol");
		$userEmail = $this->view->getVariable("userEmail");
		
		if (!isset($this->currentUser)) {
			$this->view->redirect("users", "login");
		}

		if($userRol=="deportista"){
			$this->view->redirect("index", "indexLogged");
		}

		if(isset($_GET["idPartido"])){
			$partido = $this->partidoMapper->findPartido($_GET["idPartido"]);
			$fechaPartido = $partido->getFechaPartido();
			$this->partidoMapper->deletePartido($_GET["idPartido"]);
			$numInscripciones = $this->inscripcionPartidoMapper->getNumInscripciones($_GET["idPartido"]);
			if($numInscripciones > 0){
				$inscritos = $this->inscripcionPartidoMapper->getInscritos($_GET["idPartido"]);
				foreach($inscritos as $inscrito){
					$user = $this->userMapper->findUser($inscrito);
					$email = "padelbit@gmail.com";
		$headers = 'From: ' .$email . "\r\n". 
  		'Reply-To: ' . $email. "\r\n" . 
  		'X-Mailer: PHP/' . phpversion();
					$email = $user->getEmail();
					$notificacion = new Notificacion();
					$notificacion->setIdUsuarioNotificacion($inscrito);
					$mensaje = "El partido con fecha ".$fechaPartido." ha sido cancelado.
					\nLo sentimos.\n";
					$notificacion->setMensaje($mensaje);
					$mensaje = wordwrap($mensaje, 70, "\r\n");
					$this->notificacionMapper->save($notificacion);
					mail($email, "Partido cancelado", $mensaje, $headers);
				}
				$this->inscripcionPartidoMapper->deleteInscripciones($_GET["idPartido"]);
			}
			$this->view->redirect("index", "indexLogged");

		}

		$this->view->render("partidos", "showall");
	}

	/*funcion que muestra en detalle un partido para ser inscrito*/
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
		$this->partidoMapper->actualizarPartidos();
		if(isset($_GET["idPartido"])){

			$partido = $this->partidoMapper->findPartido($_GET["idPartido"]);
			$inscritos = $this->inscripcionPartidoMapper->getInscritos($_GET["idPartido"]);
			$nombres = array();
			foreach($inscritos as $ins){
				$user = $this->userMapper->findUser($ins);
				array_push($nombres, $user->getNombre());
			}
			$inscrito = $this->inscripcionPartidoMapper->estaInscrito($userId,$_GET["idPartido"]);

			if($inscrito || $partido->getEstadoPartido()=="cerrado"){
				$this->view->redirect("index","indexLogged");
			}
			
			$this->view->setVariable("partido", $partido);
			$this->view->setVariable("nombres", $nombres);

		}
		$this->view->setLayout("table");

		$this->view->render("partidos", "showPartidoInscribir");
	}


	/*funcion que inscribe un deportista a un partido*/
	public function inscribirPartido() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		$userEmail = $this->view->getVariable("userEmail");

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "administrador") {
			$this->view->redirect("index","indexLogged");
		}
		$this->partidoMapper->actualizarPartidos();
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

				//Reserva
				$reserva = new Reserva();
				$reserva->setFecha($partido->getFechaPartido());
				$reserva->setPrecio($pago);
				$pistas = $this->pistaMapper->getPistas();
				$pista = $this->calendarioMapper->getPistaLibre($partido->getFechaPartido(),$partido->getHoraPartido(),$pistas);
				$reserva->setPistaReserva($pista);
				$reserva->setHora($partido->getHoraPartido());
				$reserva->setPartidoReserva($_GET["idPartido"]);

				$this->reservaMapper->save($reserva);

				$inscritos = $this->inscripcionPartidoMapper->getInscritos($_GET["idPartido"]);
				foreach($inscritos as $inscrito){
					$email = "padelbit@gmail.com";
		$headers = 'From: ' .$email . "\r\n". 
  		'Reply-To: ' . $email. "\r\n" . 
  		'X-Mailer: PHP/' . phpversion();
					$user = $this->userMapper->findUser($inscrito);
					$email = $user->getEmail();
					$notificacion = new Notificacion();
					$notificacion->setIdUsuarioNotificacion($inscrito);
					$mensaje = "El partido con fecha ".$fechaPartido." ha sido cerrado.
					\nRecuerde que tendrá que pagar un importe de ".$pago." al acceder al mismo.\n Pista: ".$pista."\n";
					$notificacion->setMensaje($mensaje);
					$mensaje = wordwrap($mensaje, 70, "\r\n");
					$this->notificacionMapper->save($notificacion);
					mail($email, "Partido cerrado", $mensaje , $headers);
				}
			}else if($numInscripciones>-1 && $numInscripciones<4){
				$this->inscripcionPartidoMapper->save($inscripcionPartido);
			}

		}
		$this->view->redirect("index","indexLogged");

	}

	
	/*funcion que muestra todos los partidos en los que esta inscrito un usuario*/
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

		$pistas = array();
		foreach($partidos as $partido){
			$pistaPartido = $this->reservaMapper->getPistaPartido($partido->getIdPartido());
			array_push($pistas, $pistaPartido);
		}

		$this->view->setVariable("partidos", $partidos);
		$this->view->setVariable("pistas", $pistas);
		$this->view->setLayout("table");

		$this->view->render("partidos", "showallInscrito");
	}	

	

	


}
