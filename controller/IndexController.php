<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class UsersController
*
* Controller to login, logout and user registration
*
* @author lipido <lipido@gmail.com>
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
		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("welcome");
	}

	
	
	public function indexNoLogged() {

		if (isset($this->currentUser)) {

            $this->view->redirect("index", "indexLogged");
            
		}

		$this->view->setLayout("default");
		$this->view->render("main", "mainNoLogged");
    }
    
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
