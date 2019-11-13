<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Reserva.php");
require_once(__DIR__."/../model/ReservaMapper.php");
require_once(__DIR__."/../model/Calendario.php");
require_once(__DIR__."/../model/CalendarioMapper.php");

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

	public function __construct() {
		parent::__construct();

        $this->reservaMapper = new ReservaMapper();
        $this->calendarioMapper = new CalendarioMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("welcome");
	}

	public function addReserva() {
		$reserva = new Reserva();
        $userRol = $this->view->getVariable("userRol");
        
        $fechas = array();
        for($i=0; $i < 8; $i++){
            $dias = "+".(7+$i)." days";
            $fecha=date("Y-m-d",strtotime($dias));
            array_push($fechas, $fecha);
        }

		if (!isset($this->currentUser)) {
			$this->view->setFlashDanger("You must be logged");
			$this->view->redirect("users", "login");
		}
		if($userRol == "ADMINISTRADOR"){
			$this->view->redirect("index", "indexLogged");
		}

		if (isset($_POST["fecha"])){ // reaching via HTTP Post...
            // populate the User object with data form the form
            $this->view->setVariable("fechas", $fechas);
            $this->view->setVariable("fecha", $_POST["fecha"]);
            $horas = $this->calendarioMapper->getHoras($_POST["fecha"]);
            $this->view->setVariable("horas", $horas);
            $this->view->render("reservas","addReserva");			
		}
        $this->view->setLayout("forms");
        $this->view->setVariable("fechas", $fechas);
		// render the view (/view/users/login.php)
		$this->view->render("reservas", "addReserva");
	}


}
