<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Clase.php");
require_once(__DIR__."/../model/ClaseMapper.php");
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
require_once(__DIR__."/../model/Partido.php");
require_once(__DIR__."/../model/PartidoMapper.php");
require_once(__DIR__."/../model/InscripcionPartido.php");
require_once(__DIR__."/../model/InscripcionPartidoMapper.php");


require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PartidosController
*
* Controller to partidos
*/
class ClasesController extends BaseController {

	private $partidoMapper;
	private $inscripcionPartidoMapper;
	private $notificacionMapper;
	private $calendarioMapper;
	private $pistaMapper;
	private $reservaMapper;
	private $enfrentamientoMapper;

	public function __construct() {
        parent::__construct();
        
		$this->notificacionMapper = new NotificacionMapper();
		$this->calendarioMapper = new CalendarioMapper();
		$this->pistaMapper = new PistaMapper();
		$this->reservaMapper = new ReservaMapper();
		$this->enfrentamientoMapper = new EnfrentamientoMapper();
        $this->userMapper = new UserMapper();
        $this->claseMapper = new ClaseMapper();
        $this->partidoMapper = new PartidoMapper();
        $this->inscripcionPartidoMapper = new InscripcionPartidoMapper();

		$this->view->setLayout("welcome");
	}
	

	/*funcion que permite al administrador crear un partido*/
	public function solicitarClase() {

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}

		if (isset($_POST["duracion"])){ 
            $entrenador = $this->userMapper->findEntrenador();
            $clase = new Clase();
            $userId = $this->view->getVariable("userId");
            $user = $this->userMapper->findUser($userId);
            switch($_POST["duracion"]){
                case "1": 
                    if($user->getSocio()==true){
                        $precio = 30;
                    }else{
                        $precio = 27;
                    }
                break;
                case "5":
                    if($user->getSocio()==true){
                        $precio = 126;
                    }else{
                        $precio = 140;
                    }
                break;
                case "10":
                    if($user->getSocio()==true){
                        $precio = 234;
                    }else{
                        $precio = 260;
                    }
                break;
            }
            $clase->setUsuarioClase($userId);
            $clase->setPrecio($precio);
            $clase->setDuracion(intval($_POST["duracion"]));
            $clase->setEstado("pendiente");
            $clase->setComentario($_POST["comentario"]);
            $this->claseMapper->save($clase);
            $email = "padelbit@gmail.com";
            $emailE = $entrenador->getEmail();
		    $headers = 'From: ' .$email . "\r\n". 
  		    'Reply-To: ' . $email. "\r\n" . 
  		    'X-Mailer: PHP/' . phpversion();
			$mensaje = "SOLICITUD DE ".$_POST["duracion"]." CLASES.
			\nHorarios disponibles:.\n". $_POST["comentario"];
            $mensaje = wordwrap($mensaje, 70, "\r\n");
            mail($emailE, "Solicitud clases", $mensaje , $headers);
			$this->view->redirect("index", "indexLogged");
		}

		$this->view->render("clases", "solicitarClase");
    }
    
    public function showallSolicitudes(){
        $userId = $this->view->getVariable("userId");

        $solicitudesClases = $this->claseMapper->findSolicitudes();

		// Put the User object visible to the view
		$this->view->setVariable("clasesPendientes", $solicitudesClases);
		$this->view->setLayout("table");

		// render the view (/view/users/login.php)
		$this->view->render("clases", "solicitudes");
    }

    public function reservarClase() {

		$reserva = new Reserva();
		$calendario = new Calendario();



		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
        }
              
		if(isset($_POST["hora"])){

            $clase = $this->claseMapper->findClase($_GET["idClase"]);
			$numPistas = $this->pistaMapper->getNumPistas();
			$pistas = $this->pistaMapper->getPistas();
			$pista = $this->calendarioMapper->getPistaLibre($_POST["fecha"],$_POST["hora"],$pistas);
			$esUltimaPistaLibre = $this->calendarioMapper->esUltimaPistaLibre($_POST["fecha"],$_POST["hora"],$pista,$numPistas);
			$reserva->setFecha($_POST["fecha"]);
            $reserva->setUsuarioReserva($clase->getUsuarioClase());
            $reserva->setPrecio($clase->getPrecio());
			$reserva->setPistaReserva($pista);
            $reserva->setHora($_POST["hora"]);
            $reserva->setClase($clase->getIdClase());


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
            $this->claseMapper->actualizarClase($clase->getIdClase(), $clase->getDuracion());
            $user = $this->userMapper->findUser($clase->getUsuarioClase());
            $emailUsuario = $user->getEmail();
			$notificacion = new Notificacion();
			$notificacion->setIdUsuarioNotificacion($user->getIdUsuario());
						$mensaje = "Tu entrenador ha reservado una nueva clase para el día ".$_POST["fecha"]." a las ".$_POST["hora"]." en la pista ".$pista;
						$notificacion->setMensaje($mensaje);
						$mensaje = wordwrap($mensaje, 70, "\r\n");
						$this->notificacionMapper->save($notificacion);
						$email = "padelbit@gmail.com";
		$headers = 'From: ' .$email . "\r\n". 
  		'Reply-To: ' . $email. "\r\n" . 
  		'X-Mailer: PHP/' . phpversion();
						mail($emailUsuario, "Nueva reserva de clase", $mensaje, $headers);
			$this->view->redirect("clases","showallSolicitudes");
		}

        
		$fechas = array();
		$horas = array();
        $numPistas = $this->pistaMapper->getNumPistas();
        $clase = $this->claseMapper->findClase($_GET["idClase"]);
        for($i=0; $i < 14; $i++){
            $dias = "+".(7+$i)." days";
			$fecha=date("Y-m-d",strtotime($dias));
			$horasDia = $this->calendarioMapper->getHoras($fecha, $numPistas);
            $horasReservas = $this->reservaMapper->getHorasReserva($fecha, $clase->getUsuarioClase());
            $horasClases = $this->reservaMapper->getHorasClases($fecha);
            $horasFinalesDia = array_diff($horasDia, $horasReservas);
            $h = array_diff($horasFinalesDia,$horasClases);
			array_push($fechas, $fecha);
			array_push($horas, $h);
		}

        $this->view->setLayout("reservar");
		$this->view->setVariable("fechas", $fechas);
        $this->view->setVariable("horas", $horas);
        $this->view->setVariable("idClase", $_GET["idClase"]);
		$this->view->render("reservar", "reservarClase");
    }
    
    public function showClasesEntrenador(){
        $userId = $this->view->getVariable("userId");

        $clases = $this->reservaMapper->findClases();

		// Put the User object visible to the view
		$this->view->setVariable("clases", $clases);
		$this->view->setLayout("table");

		// render the view (/view/users/login.php)
		$this->view->render("clases", "horario");
    }


    public function showallClases(){
        $userId = $this->view->getVariable("userId");

        $clases = $this->reservaMapper->findClasesUsuario($userId);

		// Put the User object visible to the view
		$this->view->setVariable("clases", $clases);
		$this->view->setLayout("table");

		// render the view (/view/users/login.php)
		$this->view->render("clases", "clasesUser");
    }

    public function cancelarClase() {

		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
		
		if (!isset($this->currentUser)) {
			$this->view->redirect("users", "login");
		}

		if(isset($_GET["idClase"])){

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
            $clase = $this->claseMapper->findClase($_GET["idClase"]);
            $this->claseMapper->cancelarClase($_GET["idClase"], $clase->getDuracion());

            $user = $this->userMapper->findUser($userId);
            $notificacion = new Notificacion();
            if($user->getRol()=="entrenador"){
                $userClase = $this->userMapper->findUser($clase->getUsuarioClase());
                $emailUsuario = $userClase->getEmail();
                $notificacion->setIdUsuarioNotificacion($userClase->getIdUsuario());
            }else{
                $emailUsuario = $user->getEmail();
                $notificacion->setIdUsuarioNotificacion($user->getIdUsuario());
            }

			
			$mensaje = "Se ha cancelado la clase del día ".$reserva->getFecha()." a las ".$reserva->getHora();
						$notificacion->setMensaje($mensaje);
						$mensaje = wordwrap($mensaje, 70, "\r\n");
						$this->notificacionMapper->save($notificacion);
						$email = "padelbit@gmail.com";
		$headers = 'From: ' .$email . "\r\n". 
  		'Reply-To: ' . $email. "\r\n" . 
  		'X-Mailer: PHP/' . phpversion();
						mail($emailUsuario, "Clase cancelada", $mensaje, $headers);
			
			$this->view->redirect("index", "indexLogged");

		}
	}
	


}
