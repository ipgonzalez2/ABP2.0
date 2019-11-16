<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Pareja {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_pareja;

	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $deportista1;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $deportista2;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $categorianivel;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
	private $grupo;

	
	
	/** 
	* The constructor
	*
	* @param string $deportista1 The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($id_pareja=NULL, $deportista1=NULL, $deportista2=NULL,
    $categorianivel=NULL, $grupo=NULL) {
		$this->id_pareja = $id_pareja;
        $this->deportista1 = $deportista1;
        $this->deportista2 = $deportista2;
        $this->categorianivel = $categorianivel;
        $this->grupo = $grupo;
	}
	
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdPareja() {
		return $this->id_pareja;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $deportista1 The tipoPista of this reservation
	* @return void
	*/
	public function setIdPareja($id_pareja) {
		$this->id_pareja = $id_pareja;
	}

	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getDeportista1() {
		return $this->deportista1;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $deportista1 The tipoPista of this reservation
	* @return void
	*/
	public function setDeportista1($deportista1) {
		$this->deportista1 = $deportista1;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getDeportista2() {
		return $this->deportista2;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $deportista1 The tipoPista of this reservation
	* @return void
	*/
	public function setDeportista2($deportista2) {
		$this->deportista2 = $deportista2;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getCategoriaNivel() {
		return $this->categorianivel;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $deportista1 The tipoPista of this reservation
	* @return void
	*/
	public function setCategoriaNivel($categorianivel) {
		$this->categorianivel = $categorianivel;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getGrupo() {
		return $this->grupo;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $deportista1 The tipoPista of this reservation
	* @return void
	*/
	public function setGrupo($grupo) {
		$this->grupo = $grupo;
	}


}
