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

	// Get the questions listing based on subject and difficult
	function get_all_mat_dif($materias, $dificultad){
		$this->db->from("preguntas_prueba pp");
		$this->db->join("cfg_materias cm", "cm.codmateria = pp.id_materia");
		$this->db->where_in("id_materia", $materias);
		$this->db->where_in("dificultad", $dificultad);
		$this->db->order_by("pp.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_preguntas_prueba($id_prueba){
		$this->db->from("asignacion_preguntas_prueba app");
		$this->db->join("preguntas_prueba pp", "app.id_pregunta = pp.id_pregunta_prueba");
		$this->db->join("cfg_materias cm", "cm.codmateria = pp.id_materia");
		$this->db->where("app.id_prueba", $id_prueba);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}
}