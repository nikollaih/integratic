<?php
class Respuestas_Realizar_Prueba_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	 function get_by_prueba_participante($id_prueba, $id_participante){
		$this->db->select("rrp.id_pregunta");
		$this->db->from("realizar_prueba rp");
		$this->db->join("respuestas_realizar_prueba rrp", "rp.id_realizar_prueba = rrp.id_realizar_prueba");
		$this->db->where("rp.id_prueba", $id_prueba);
		$this->db->where("rp.id_participante", $id_participante);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get($id_realizar_prueba){
		$this->db->from("respuestas_realizar_prueba rrp");
		$this->db->join("preguntas_prueba pp", "rrp.id_pregunta = pp.id_pregunta_prueba");
		$this->db->where("rrp.id_realizar_prueba", $id_realizar_prueba);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function create($data){
		$this->db->insert("respuestas_realizar_prueba", $data);
		return $this->db->insert_id();
	}
}