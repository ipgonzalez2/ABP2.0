<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Reserva {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_reserva;

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $fecha;

	/**
	* The password of the reservation
	* @var string
	*/
	private $precio;

	/**
	* The name of the reservation
	* @var string
	*/
	private $usuario_reserva;

	/**
	* The pista_reserva of the reservation
	* @var string
	*/
	private $pista_reserva;

	private $hora;

	private $partido_reserva;

	
	/** 
	* The constructor
	*
	* @param string $fecha The name of the reservation
	* @param string $Precio The password of the reservation
	*/
	public function __construct($id_reserva=NULL, $fecha=NULL, $precio=NULL, $usuario_reserva=NULL,
	$pista_reserva=NULL, $hora=NULL, $partido_reserva=NULL) {
		$this->id_reserva = $id_reserva;
		$this->fecha = $fecha;
		$this->precio = $precio;
		$this->usuario_reserva = $usuario_reserva;
		$this->pista_reserva = $pista_reserva;
		$this->hora = $hora;
		$this->partido_reserva = $partido_reserva;
	}
	
	/**
	* Gets the fecha of this reservation
	*
	* @return string The fecha of this reservation
	*/
	public function getIdReserva() {
		return $this->id_reserva;
	}

	/**
	* Sets the fecha of this reservation
	*
	* @param string $fecha The fecha of this reservation
	* @return void
	*/
	public function setIdReserva($id_reserva) {
		$this->id_reserva = $id_reserva;
	}

	/**
	* Gets the fecha of this reservation
	*
	* @return string The fecha of this reservation
	*/
	public function getFecha() {
		return $this->fecha;
	}

	/**
	* Sets the fecha of this reservation
	*
	* @param string $fecha The fecha of this reservation
	* @return void
	*/
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	/**
	* Gets the password of this reservation
	*
	* @return string The password of this reservation
	*/
	public function getPrecio() {
		return $this->precio;
	}
	/**
	* Sets the password of this reservation
	*
	* @param string $Precio The password of this reservation
	* @return void
	*/
	public function setPrecio($precio) {
		$this->precio = $precio;
	}

	/**
	* Gets the password of this reservation
	*
	* @return string The password of this reservation
	*/
	public function getUsuarioReserva() {
		return $this->usuario_reserva;
	}
	/**
	* Sets the password of this reservation
	*
	* @param string $Precio The password of this reservation
	* @return void
	*/
	public function setUsuarioReserva($usuario_reserva) {
		$this->usuario_reserva = $usuario_reserva;
	}

	/**
	* Gets the password of this reservation
	*
	* @return string The password of this reservation
	*/
	public function getPistaReserva() {
		return $this->pista_reserva;
	}
	/**
	* Sets the password of this reservation
	*
	* @param string $Precio The password of this reservation
	* @return void
	*/
	public function setPistaReserva($pista_reserva) {
		$this->pista_reserva = $pista_reserva;
	}

	public function getHora(){
		return $this->hora;
	}

	public function setHora($hora){
		$this->hora = $hora;
	}

	public function getPartidoReserva(){
		return $this->partido_reserva;
	}

	public function setPartidoReserva($partido_reserva){
		$this->partido_reserva = $partido_reserva;
	}



	/**
	* Checks if the current reservation instance is valid
	* for being registered in the database
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForRegister() {
		$errors = array();
		$fechaActual = date('d-m-Y');

		if (strlen($this->fecha) < 5 || $this->fecha<$fechaActual  ) {
			$errors["fecha"] = "La fecha debe tener al menos 5 caracteres y no puede ser anterior al dia de hoy";

		}
		if (strlen($this->precio) < 1) {
			$errors["precio"] = "El precio debe tener al menos un caracter";
		}
		if (strlen($this->pista_reserva) < 1) {
			$errors["pista_reserva"] = "Debe tener al menos un caracter";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "reservation is not valid");
		}

	}
}
