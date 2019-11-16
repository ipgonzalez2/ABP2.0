<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Grupo {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_grupo;

	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $categorianivel_grupo;
    
    private $numParejas;

	
	
	/** 
	* The constructor
	*
	* @param string $categorianivel_grupo The name of the reservation
	* @param string $Precio The password of the reservation
	*/
	public function __construct($id_grupo=NULL, $categorianivel_grupo=NULL, $numParejas=NULL) {
		$this->id_grupo = $id_grupo;
        $this->categorianivel_grupo = $categorianivel_grupo;
        $this->numParejas = $numParejas;
	}
	
	/**
	* Gets the CategoriaNivelGrupo of this reservation
	*
	* @return string The CategoriaNivelGrupo of this reservation
	*/
	public function getIdGrupo() {
		return $this->id_grupo;
	}

	/**
	* Sets the CategoriaNivelGrupo of this reservation
	*
	* @param string $categorianivel_grupo The CategoriaNivelGrupo of this reservation
	* @return void
	*/
	public function setIdGrupo($id_grupo) {
		$this->id_grupo = $id_grupo;
	}

	/**
	* Gets the CategoriaNivelGrupo of this reservation
	*
	* @return string The CategoriaNivelGrupo of this reservation
	*/
	public function getCategoriaNivelGrupo() {
		return $this->categorianivel_grupo;
	}

	/**
	* Sets the CategoriaNivelGrupo of this reservation
	*
	* @param string $categorianivel_grupo The CategoriaNivelGrupo of this reservation
	* @return void
	*/
	public function setCategoriaNivelGrupo($categorianivel_grupo) {
		$this->categorianivel_grupo = $categorianivel_grupo;
    }
    
    public function getNumParejas(){
        return $this->numParejas;
    }

    public function setNumParejas($numParejas){
        $this->numParejas = $numParejas;
    }


}
