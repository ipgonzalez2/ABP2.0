<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Pista {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_pista;

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $tipo_pista;

	
	
	/** 
	* The constructor
	*
	* @param string $tipo_pista The name of the reservation
	* @param string $Precio The password of the reservation
	*/
	public function __construct($id_pista=NULL, $tipo_pista=NULL) {
		$this->id_pista = $id_pista;
		$this->tipo_pista = $tipo_pista;
	}
	
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdPista() {
		return $this->id_pista;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $tipo_pista The tipoPista of this reservation
	* @return void
	*/
	public function setIdPista($id_pista) {
		$this->id_pista = $id_pista;
	}

	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getTipoPista() {
		return $this->tipo_pista;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $tipo_pista The tipoPista of this reservation
	* @return void
	*/
	public function setTipoPista($tipo_pista) {
		$this->tipo_pista = $tipo_pista;
	}


}
