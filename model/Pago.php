<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Pago {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_pago;

	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $tipo_pago;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $estado_pago;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $cantidad;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
	private $reserva_pago;

	
	
	/** 
	* The constructor
	*
	* @param string $tipo_pago The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($id_pago=NULL, $tipo_pago=NULL, $estado_pago=NULL,
    $cantidad=NULL, $reserva_pago=NULL) {
		$this->id_pago = $id_pago;
        $this->tipo_pago = $tipo_pago;
        $this->estado_pago = $estado_pago;
        $this->cantidad = $cantidad;
        $this->reserva_pago = $reserva_pago;
	}
	
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdPago() {
		return $this->id_pago;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $tipo_pago The tipoPista of this reservation
	* @return void
	*/
	public function setIdPago($id_pago) {
		$this->id_pago = $id_pago;
	}

	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getTipoPago() {
		return $this->tipo_pago;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $tipo_pago The tipoPista of this reservation
	* @return void
	*/
	public function setTipoPago($tipo_pago) {
		$this->tipo_pago = $tipo_pago;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getEstadoPago() {
		return $this->estado_pago;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $tipo_pago The tipoPista of this reservation
	* @return void
	*/
	public function setEstadoPago($estado_pago) {
		$this->estado_pago = $estado_pago;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getCantidad() {
		return $this->cantidad;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $tipo_pago The tipoPista of this reservation
	* @return void
	*/
	public function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getReservaPago() {
		return $this->reserva_pago;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $tipo_pago The tipoPista of this reservation
	* @return void
	*/
	public function setReservaPago($reserva_pago) {
		$this->reserva_pago = $reserva_pago;
	}


}
