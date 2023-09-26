<?php
class Participantes_Prueba_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get($identificacion){
		$this->db->from("core_participantes_pruebas cpp");
        $this->db->where("cpp.identificacion", $identificacion);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	// Create a new question
	function create($data){
		$this->db->insert("core_participantes_pruebas", $data);
		return $this->get($data["identificacion"]); 
	}

	// Create a new question
	function update($data){
		$this->db->where("identificacion", $data["identificacion"]);
		$this->db->update("core_participantes_pruebas", $data);
		return $this->get($data["identificacion"]); 
	}

	function get_count_by_materias($ids_materias, $alcance = "all"){
		$query = "";
		if(is_array($ids_materias)){
			$query = "(";
			for ($i=0; $i < count($ids_materias) ; $i++) { 
				$query.= "p.materias LIKE '%".$ids_materias[$i]."%' OR ";
			}
			$query = substr($query, 0, -4);
			$query.= ")";
		}
		$this->db->select("COUNT(DISTINCT(cpp.identificacion)) as cantidad_participantes");
		$this->db->from("core_participantes_pruebas cpp");
		$this->db->join("asignacion_participantes_prueba app", "cpp.id_participante_prueba = app.id_participante");
		$this->db->join("pruebas p", "p.id_prueba = app.id_prueba");
		if($alcance != "all"){
			$this->db->where("p.alcance_prueba", $alcance);
		}
		$this->db->where($query, NULL, FALSE);
		$this->db->group_by("cpp.identificacion");
		$result = $this->db->get();
		echo $this->db->last_query();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_participante_by_identificacion($identificacion){
		$this->db->from("core_participantes_pruebas cpp");
		$this->db->where("cpp.identificacion", $identificacion);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}
}