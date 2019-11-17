<?php

require_once(__DIR__."/../core/ValidationException.php");

class CategoriaNivel {

	private $id_categorianivel;

    private $categoria;
    
    private $nivel;
    
    private $campeonato;
	
	

    public function __construct($categoria=NULL, $nivel=NULL,
    $campeonato=NULL, $id_categorianivel=NULL) {
        $this->categoria = $categoria;
        $this->nivel = $nivel;
		$this->campeonato = $campeonato;
		$this->id_categorianivel = $id_categorianivel;
	}

	public function getIdCategoriaNivel() {
		return $this->id_categorianivel;
	}

	public function setIdCategoriaNivel($id_categorianivel) {
		$this->id_categorianivel = $id_categorianivel;
    }

	public function getCategoria() {
		return $this->categoria;
	}

	public function setCategoria($categoria) {
		$this->categoria = $categoria;
    }
    
	public function getNivel() {
		return $this->nivel;
	}

	public function setNivel($nivel) {
		$this->nivel = $nivel;
    }

	public function getCampeonato() {
		return $this->campeonato;
	}

	public function setCampeonato($campeonato) {
		$this->campeonato = $campeonato;
    }

    
	public function checkIsValidForRegister() {
		$errors = array();
		$fechaActual = date('d-m-Y');


		if (strlen($this->categoria) < 11) {
			$errors["categoria"] = "La categoria debe tener al menos 11 caracteres";

		}
		if (strlen($this->fecha_fin_inscripcion ) < 11 || $this->fecha_fin_inscripcion<$fechaActual ) {
			$errors["fecha_fin_inscripcion"] = "La fecha debe tener al menos 11 caracteres y no puede ser anterior al dia de hoy";
		}
		if (strlen($this->nivel) < 2) {
			$errors["nivel"] = "El nivel debe tener al menos 2 caracteres";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "categoria/nivel is not valid");
		}
	}

}
