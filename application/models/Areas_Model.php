<?php  
class Areas_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function getAreasDocente($id_docente){
        $this->db->from("cfg_areas ca");
        $this->db->join("cfg_materias cm", "ca.codarea = cm.area");
		$this->db->join("asg_materias am", "am.materia = cm.codmateria");
        $this->db->where("am.docente", $id_docente);
		$this->db->group_by("ca.codarea");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function get_by_materias($materias){
        $this->db->from("cfg_areas ca");
        $this->db->join("cfg_materias cm", "ca.codarea = cm.area");
        $this->db->where_in("cm.codmateria", $materias);
        $this->db->group_by("ca.codarea");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function find($idArea){
        $this->db->from("cfg_areas ca");
        $this->db->where("ca.codarea", $idArea);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
    }
} 
