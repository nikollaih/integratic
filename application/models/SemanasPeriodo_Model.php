<?php  
class SemanasPeriodo_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function create($data){
        $this->db->insert("semanas_periodo", $data);
        return $this->db->insert_id();
    }

    function getByPeriodo($idPeriodo){
        $this->db->from("semanas_periodo");
        $this->db->where("periodo", $idPeriodo);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function find($idArea){
        $this->db->from("semanas_periodo");
        $this->db->where("id_semana_periodo", $idArea);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
    }
} 
