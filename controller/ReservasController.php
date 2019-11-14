<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Reserva.php");
require_once(__DIR__."/../model/ReservaMapper.php");
require_once(__DIR__."/../model/Calendario.php");
require_once(__DIR__."/../model/CalendarioMapper.php");
require_once(__DIR__."/../model/Pista.php");
require_once(__DIR__."/../model/PistaMapper.php");

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

	public function __construct() {
		parent::__construct();

        $this->reservaMapper = new ReservaMapper();
		$this->calendarioMapper = new CalendarioMapper();
		$this->pistaMapper = new PistaMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("welcome");
	}

	public function addReserva() {
		$reserva = new Reserva();
		$userRol = $this->view->getVariable("userRol");
		$userId = $this->view->getVariable("userId");
        
		$fechas = array();
		$horas = array();
		$numPistas = $this->pistaMapper->getNumPistas();
        for($i=0; $i < 8; $i++){
            $dias = "+".(7+$i)." days";
			$fecha=date("Y-m-d",strtotime($dias));
			$horasDia = $this->calendarioMapper->getHoras($fecha, $numPistas);
			array_push($fechas, $fecha);
			array_push($horas, $horasDia);
		}

	//	$numPistas = $this->pistaMapper->getNumPistas();
	//	$horasFecha = $this->calendarioMapper->getHoras("2019-11-21", $numPistas);
		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "administrador"){
			$this->view->redirect("index", "indexLogged");
		}

		
        $this->view->setLayout("forms");
		$this->view->setVariable("fechas", $fechas);
		$this->view->setVariable("horas", $horas);
		// render the view (/view/users/login.php)
		$this->view->render("reservar", "reservar");
	}

}
