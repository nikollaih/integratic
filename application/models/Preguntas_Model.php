<?php
class Preguntas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get_all(){
		$this->db->from("preguntas_prueba pp");
		$this->db->join("cfg_materias cm", "cm.codmateria = pp.id_materia");
		$this->db->order_by("pp.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get($id_pregunta){
		$this->db->from("preguntas_prueba pp");
		$this->db->join("cfg_materias cm", "cm.codmateria = pp.id_materia");
		$this->db->order_by("pp.created_at", "desc");
		$this->db->where("pp.id_pregunta_prueba", $id_pregunta);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	 }

	// Create a new question
	function create($data){
		$this->db->insert("preguntas_prueba", $data);
		return $this->db->insert_id(); 
	}

	// Create a new question
	function update($data){
		$this->db->where("id_pregunta_prueba", $data["id_pregunta_prueba"]);
		return $this->db->update("preguntas_prueba", $data);
	}
}