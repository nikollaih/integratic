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
		return $this->db->insert_id(); 
	}

	// Create a new question
	function update($data){
		$this->db->where("identificacion", $data["identificacion"]);
		return $this->db->update("core_participantes_pruebas", $data);
	}

}