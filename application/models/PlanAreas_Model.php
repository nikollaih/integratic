<?php  
class PlanAreas_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function create($data){
        $this->db->insert("plan_areas", $data);
        return $this->db->insert_id();
	}   
} 
