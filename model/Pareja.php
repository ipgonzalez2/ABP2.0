<?php


require_once(__DIR__."/../core/ValidationException.php");

class Pareja {


	private $id_pareja;


    private $deportista1;
    

    private $deportista2;
    

    private $categorianivel;
    

	private $grupo;

	private $puntos;

	

    public function __construct($id_pareja=NULL, $deportista1=NULL, $deportista2=NULL,
    $categorianivel=NULL, $grupo=NULL, $puntos=NULL) {
		$this->id_pareja = $id_pareja;
        $this->deportista1 = $deportista1;
        $this->deportista2 = $deportista2;
        $this->categorianivel = $categorianivel;
		$this->grupo = $grupo;
		$this->puntos = $puntos;
	}
	

	public function getIdPareja() {
		return $this->id_pareja;
	}


	public function setIdPareja($id_pareja) {
		$this->id_pareja = $id_pareja;
	}


	public function getDeportista1() {
		return $this->deportista1;
	}


	public function setDeportista1($deportista1) {
		$this->deportista1 = $deportista1;
    }
    
    

	public function getDeportista2() {
		return $this->deportista2;
	}


	public function setDeportista2($deportista2) {
		$this->deportista2 = $deportista2;
    }
    
    
	public function getCategoriaNivel() {
		return $this->categorianivel;
	}

	public function setCategoriaNivel($categorianivel) {
		$this->categorianivel = $categorianivel;
    }
    
    
	public function getGrupo() {
		return $this->grupo;
	}

	public function setGrupo($grupo) {
		$this->grupo = $grupo;
	}
	public function getPuntos() {
		return $this->puntos;
	}

	public function setPuntos($puntos) {
		$this->puntos = $puntos;
	}


}
