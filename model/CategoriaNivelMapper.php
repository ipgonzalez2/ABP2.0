<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class CategoriaNivelMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a User into the database
	*
	* @param User $categoria_nivel The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
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
/*
	public function findAllPartidos() 
	{
		$stmt = $this->db->prepare("SELECT * FROM PARTIDO");
		$stmt->execute();
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $categoria_nivel) {
			array_push($partidos, new Partido($categoria_nivel["ID_PARTIDO"],$categoria_nivel["FECHA_PARTIDO"], $categoria_nivel["PRECIO_PARTIDO"],
			$categoria_nivel["ESTADO_PARTIDO"], $categoria_nivel["FECHA_FIN_INSCRIPCION"]));
		}
		return $partidos;
	}

	public function findAllPartidosAbiertos($partidosInscrito) 
	{
		$stmt = $this->db->prepare("SELECT * FROM PARTIDO WHERE ESTADO_PARTIDO=?");
		$stmt->execute(array("ABIERTO"));
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $categoria_nivel) {
				if(!(in_array($categoria_nivel["ID_PARTIDO"],$partidosInscrito))){
					array_push($partidos, new Partido($categoria_nivel["ID_PARTIDO"],$categoria_nivel["FECHA_PARTIDO"], $categoria_nivel["PRECIO_PARTIDO"],
					$categoria_nivel["ESTADO_PARTIDO"], $categoria_nivel["FECHA_FIN_INSCRIPCION"]));
				}
		}

		return $partidos;
	}

	public function actualizarPartidos() 
	{
		$stmt = $this->db->prepare("SELECT * FROM PARTIDO");
		$stmt->execute();
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $categoria_nivel) {
			$fechaInscripcionPartido=date("Y-m-d",strtotime($categoria_nivel["FECHA_FIN_INSCRIPCION"]));
			$fechaActual=date("Y-m-d",strtotime("Today"));
			if(($fechaInscripcionPartido <= $fechaActual) && ($categoria_nivel["ESTADO_PARTIDO"] == "ABIERTO")){
				$stmt = $this->db->prepare("UPDATE PARTIDO SET 
				ESTADO_PARTIDO = ? WHERE ID_PARTIDO = ?");
				$stmt->execute(array("CERRADO",$categoria_nivel["ID_PARTIDO"]));
			}
		}
	}

	public function deletePartido($idPartido){

		$stmt = $this->db->prepare("DELETE FROM PARTIDO WHERE ID_PARTIDO = ?"); 
		$stmt->execute(array($idPartido));

	}

	public function comprobarPartido($idPartido){

		$stmt = $this->db->prepare("SELECT ESTADO_PARTIDO WHERE ID_PARTIDO = ?"); 
		$stmt->execute(array($idPartido));

		$estado = $stmt->fetch(PDO::FETCH_ASSOC);
		if($estado == "CERRADO"){
			$this->actualizarPartidos();
			return false;
		}
		return true;

	}

	public function findPartido($id_partido){
		$stmt = $this->db->prepare("SELECT * FROM PARTIDO WHERE ID_PARTIDO=?");
		$stmt->execute(array($id_partido));
		$categoria_nivel = $stmt->fetch(PDO::FETCH_ASSOC);

		if($categoria_nivel != null) {
			return new Partido(
			$id_partido,
			$categoria_nivel["FECHA_PARTIDO"],
			$categoria_nivel["PRECIO_PARTIDO"],
			$categoria_nivel["ESTADO_PARTIDO"],
			$categoria_nivel["FECHA_FIN_INSCRIPCION"]);
		} else {
			return NULL;
		}
	}

	public function cerrarPartido($idPartido)
    {
        $stmt = $this->db->prepare("UPDATE PARTIDO SET ESTADO_PARTIDO = ? WHERE ID_PARTIDO=?");
        $stmt->execute(array("CERRADO",$idPartido));
	}
	
	public function findAllPartidosInscrito($partidosInscrito) 
	{
		$stmt = $this->db->prepare("SELECT * FROM PARTIDO");
		$stmt->execute();
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $categoria_nivel) {
				if((in_array($categoria_nivel["ID_PARTIDO"],$partidosInscrito))){
					array_push($partidos, new Partido($categoria_nivel["ID_PARTIDO"],$categoria_nivel["FECHA_PARTIDO"], $categoria_nivel["PRECIO_PARTIDO"],
					$categoria_nivel["ESTADO_PARTIDO"], $categoria_nivel["FECHA_FIN_INSCRIPCION"]));
				}
		}

		return $partidos;
	}

*/
}
