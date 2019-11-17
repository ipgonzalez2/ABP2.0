<?php

require_once(__DIR__."/../core/ValidationException.php");

class Pista {


	private $id_pista;


	private $tipo_pista;

	

	public function __construct($id_pista=NULL, $tipo_pista=NULL) {
		$this->id_pista = $id_pista;
		$this->tipo_pista = $tipo_pista;
	}
	

	public function getIdPista() {
		return $this->id_pista;
	}


	public function setIdPista($id_pista) {
		$this->id_pista = $id_pista;
	}


	public function getTipoPista() {
		return $this->tipo_pista;
	}


	public function setTipoPista($tipo_pista) {
		$this->tipo_pista = $tipo_pista;
	}


}
