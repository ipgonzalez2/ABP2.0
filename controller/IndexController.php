<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class IndexController
*
* Controller to the main page
*/
class IndexController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->userMapper = new UserMapper();

		$this->view->setLayout("default");
	}

	
	//Carga la vista si no se ha iniciado sesión
	public function indexNoLogged() {

		if (isset($this->currentUser)) {

            $this->view->redirect("index", "indexLogged");
            
		}

		$this->view->setLayout("default");
		$this->view->render("main", "mainNoLogged");
    }
	
	//Carga la vista correspondiente si hay una sesión abierta
    public function indexLogged() {

		if (!isset($this->currentUser)) {

            $this->view->redirect("index", "indexNoLogged");
            
        }
        
        
        $userRol = $this->view->getVariable("userRol");

        if($userRol == "administrador"){

            $this->view->setLayout("default");
            $this->view->render("main", "mainAdmin");

        }else if($userRol == "deportista"){

            $this->view->setLayout("default");
            $this->view->render("main", "main");

		}

	}

	


}
