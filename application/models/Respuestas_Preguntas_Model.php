<?php
class Respuestas_Preguntas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	 function get_all($id_pregunta){
		$this->db->from("respuestas_preguntas_pruebas");
		$this->db->where("id_pregunta", $id_pregunta);
		$this->db->order_by("tipo_respuesta", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	// Create a new answer
	function create($data){
		$this->db->insert("respuestas_preguntas_pruebas", $data);
		return $this->db->insert_id(); 
	}

	// Update an answer
	function update($data){
		$this->db->where("id_respuesta_pregunta_prueba", $data["id_respuesta_pregunta_prueba"]);
		return $this->db->update("respuestas_preguntas_pruebas", $data);
	}

	function get_respuestas_exportar($ids_preguntas){
		$this->db->from("respuestas_preguntas_pruebas");
		$this->db->where_in("id_pregunta", $ids_preguntas);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_respuestas_exportar_by_materia($id_materia){
		$this->db->select("rpp.*");
		$this->db->from("respuestas_preguntas_pruebas rpp");
		$this->db->join("preguntas_prueba pp", "pp.id_pregunta_prueba = rpp.id_pregunta");
		$this->db->where_in("pp.id_materia", $id_materia);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}
}