<?php
class AlcancePruebas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get_all(){
		$this->db->from("alcance_prueba");
		$this->db->order_by("descripcion", "asc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}
}