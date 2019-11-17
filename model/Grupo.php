<?php


require_once(__DIR__."/../core/ValidationException.php");

class Grupo {

	private $id_grupo;

    private $categorianivel_grupo;
    
    private $numParejas;

	

	public function __construct($id_grupo=NULL, $categorianivel_grupo=NULL, $numParejas=NULL) {
		$this->id_grupo = $id_grupo;
        $this->categorianivel_grupo = $categorianivel_grupo;
        $this->numParejas = $numParejas;
	}

	public function getIdGrupo() {
		return $this->id_grupo;
	}

	public function setIdGrupo($id_grupo) {
		$this->id_grupo = $id_grupo;
	}

	public function getCategoriaNivelGrupo() {
		return $this->categorianivel_grupo;
	}

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
