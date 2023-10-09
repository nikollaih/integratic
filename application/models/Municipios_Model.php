<?php
class Municipios_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

    public function get_all(){
        $this->db->from("municipios");
        $this->db->order_by("municipio", "ASC");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}