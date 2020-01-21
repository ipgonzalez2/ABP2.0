<?php


require_once(__DIR__."/../core/PDOConnection.php");


class ClaseMapper {

	
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($clase) {
		$stmt = $this->db->prepare("INSERT INTO clase values (?,?,?,?,?, ?)");
        $stmt->execute(array(0,$clase->getUsuarioClase(), $clase->getPrecio(), 
		$clase->getDuracion(), $clase->getEstado(), $clase->getComentario()));
		return $this->db->lastInsertId();
	}

	public function findSolicitudes(){

		$stmt = $this->db->prepare("SELECT c.id_clase, u.nombre, c.usuario_clase, c.duracion, c.comentario FROM clase c, usuario u WHERE c.usuario_clase = u.id_usuario and c.estado = ? ORDER BY c.id_clase");
		$stmt->execute(array("pendiente"));
		
		$clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$clases = array();

		foreach ($clases_db as $clase) {
			array_push($clases, $clase["id_clase"]);
			array_push($clases, $clase["nombre"]);
			array_push($clases, $clase["usuario_clase"]);
			array_push($clases, $clase["duracion"]);
			array_push($clases, $clase["comentario"]);
		}
		return $clases;
	}

	public function findClase($id_clase){
		$stmt = $this->db->prepare("SELECT * FROM clase WHERE id_clase=?");
		$stmt->execute(array($id_clase));
		$clase = $stmt->fetch(PDO::FETCH_ASSOC);

		if($clase != null) {
			return new Clase(
			$id_clase,
			$clase["usuario_clase"],
			$clase["precio"],
			$clase["duracion"],
			$clase["estado"],
			$clase["comentario"]);
		} else {
			return NULL;
		}
	}

	public function actualizarClase($id_clase, $duracion){
		if($duracion - 1 == 0){
			$estado = "cerrado";
		}else{
			$estado = "pendiente";
		}
		$stmt = $this->db->prepare("UPDATE clase set duracion=?,estado=?  WHERE id_clase=?");
		$stmt->execute(array($duracion-1, $estado, $id_clase));
	
	}

	public function cancelarClase($id_clase, $duracion){
		$stmt = $this->db->prepare("UPDATE clase set duracion=?,estado=?  WHERE id_clase=?");
		$stmt->execute(array($duracion+1, "pendiente", $id_clase));
	
	}


}
