<?php
class Estudiante_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function getAll(){
		$this->db->from("estudiantes e");
		$this->db->right_join("usuarios u", "e.document = u.id");
		$result = $this->db->query();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

}