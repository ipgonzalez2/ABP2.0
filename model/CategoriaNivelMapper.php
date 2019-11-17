<?php


require_once(__DIR__."/../core/PDOConnection.php");


class CategoriaNivelMapper {

	
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($categoria_nivel) {
		$stmt = $this->db->prepare("INSERT INTO categorianivel values (?,?,?,?)");
        $stmt->execute(array(0,$categoria_nivel->getCategoria(), $categoria_nivel->getNivel(), 
        $categoria_nivel->getCampeonato()));
	}

	public function findId($id_campeonato, $categoria, $nivel){
		$stmt = $this->db->prepare("SELECT id_categorianivel FROM categorianivel WHERE campeonato=? AND categoria=? AND nivel=?");
		$stmt->execute(array($id_campeonato, $categoria, $nivel));
		$categoria_nivel = $stmt->fetch(PDO::FETCH_ASSOC);
		return $categoria_nivel["id_categorianivel"];
	}

	public function findAll($id_campeonato) 
	{
		$stmt = $this->db->prepare("SELECT id_categorianivel FROM categorianivel where campeonato=?");
		$stmt->execute(array($id_campeonato));
		
		$categorias_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$categorias = array();

		foreach ($categorias_db as $categoria) {
			array_push($categorias, $categoria["id_categorianivel"]);
		}
		return $categorias;
	}

	public function findAllCampeonatosInscrito($categorias) 
	{
		$campeonatos = array();
		foreach($categorias as $categoria){
			$stmt = $this->db->prepare("SELECT campeonato FROM categorianivel where id_categorianivel=?");
			$stmt->execute(array($categoria));
			$c = $stmt->fetch(PDO::FETCH_ASSOC);
			array_push($campeonatos, $c["campeonato"]);
		}

		return $campeonatos;
	}


}
