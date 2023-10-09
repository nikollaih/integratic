<?php  
class Periodos_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function getAll(){
        $this->db->from("periodos");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}   
}