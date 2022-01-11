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
}