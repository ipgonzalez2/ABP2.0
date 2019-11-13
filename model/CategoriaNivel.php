<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class CategoriaNivel {


	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $categoria;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $nivel;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $campeonato;
	
	
	/** 
	* The constructor
	*
	* @param string $categoria The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($categoria=NULL, $nivel=NULL,
    $campeonato=NULL) {
        $this->categoria = $categoria;
        $this->nivel = $nivel;
        $this->campeonato = $campeonato;
	}


	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getCategoria() {
		return $this->categoria;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $categoria The tipoPista of this reservation
	* @return void
	*/
	public function setCategoria($categoria) {
		$this->categoria = $categoria;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getNivel() {
		return $this->nivel;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $categoria The tipoPista of this reservation
	* @return void
	*/
	public function setNivel($nivel) {
		$this->nivel = $nivel;
    }

    /**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getCampeonato() {
		return $this->campeonato;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $categoria The tipoPista of this reservation
	* @return void
	*/
	public function setCampeonato($campeonato) {
		$this->campeonato = $campeonato;
    }

    
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->categoria) < 11) {
			$errors["username"] = "Username must be at least 5 characters length";

		}
		if (strlen($this->fecha_fin_inscripcion) < 11) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if (strlen($this->nivel) < 2) {
			$errors["nombre"] = "Name must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}


}
