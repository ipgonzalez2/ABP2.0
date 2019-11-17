<?php


require_once(__DIR__."/../core/ValidationException.php");

class Enfrentamiento {

	private $id_enfrentamiento;

    private $pareja1;
    
    private $pareja2;

    private $resultado1;
    
    private $resultado2;

    private $grupo_enfrentamiento;

    private $tipo_enfrentamiento;
	
	
    public function __construct($id_enfrentamiento=NULL, $pareja1=NULL, $pareja2=NULL,
    $resultado1=NULL,$resultado2=NULL,$grupo_enfrentamiento=NULL,$tipo_enfrentamiento=NULL) {
		$this->id_enfrentamiento = $id_enfrentamiento;
        $this->pareja1 = $pareja1;
        $this->pareja2 = $pareja2;
        $this->resultado1 = $resultado1;
        $this->resultado2 = $resultado2;
        $this->grupo_enfrentamiento = $grupo_enfrentamiento;
        $this->tipo_enfrentamiento = $tipo_enfrentamiento;
	}
	
	public function getIdEnfrentamiento() {
		return $this->id_enfrentamiento;
	}

	public function setIdEnfrentamiento($id_enfrentamiento) {
		$this->id_enfrentamiento = $id_enfrentamiento;
	}

	public function getPareja1() {
		return $this->pareja1;
	}

	public function setPareja1($pareja1) {
		$this->pareja1 = $pareja1;
    }
    
    
	public function getPareja2() {
		return $this->pareja2;
	}

	public function setPareja2($pareja2) {
		$this->pareja2 = $pareja2;
    }

    public function getResultado1() {
		return $this->resultado1;
	}

	public function setResultado1($resultado1) {
		$this->resultado1 = $resultado1;
    }

	public function getResultado2() {
		return $this->resultado2;
	}

	public function setResultado2($resultado2) {
		$this->resultado2 = $resultado2;
    }

	public function getGrupoEnfrentamiento() {
		return $this->grupo_enfrentamiento;
	}

	public function setGrupoEnfrentamiento($grupo_enfrentamiento) {
        $this->grupo_enfrentamiento = $grupo_enfrentamiento;
	}
    
    public function getTipoEnfrentamiento() {
		return $this->tipo_enfrentamiento;
	}

	public function setTipoEnfrentamiento($tipo_enfrentamiento) {
        $this->tipo_enfrentamiento = $tipo_enfrentamiento;
    }
    
	


}
