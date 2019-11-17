<?php


require_once(__DIR__."/../core/ValidationException.php");

class Confirmacion {


	private $id_enfrentamiento;


    private $deportista;

	

    public function __construct($id_enfrentamiento=NULL, $deportista=NULL) {
		$this->id_enfrentamiento = $id_enfrentamiento;
        $this->deportista = $deportista;
	}
	

	public function getIdEnfrentamiento() {
		return $this->id_enfrentamiento;
	}


	public function setIdEnfrentamiento($id_enfrentamiento) {
		$this->id_enfrentamiento = $id_enfrentamiento;
	}


	public function getDeportista() {
		return $this->deportista;
	}


	public function setDeportista($deportista) {
		$this->deportista = $deportista;
    }
    
    

	


}
