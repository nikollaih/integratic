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
    
    function update($data){
        $this->db->where("id_plan_area", $data["id_plan_area"]);
        return $this->db->update("plan_areas", $data);
	} 

    function find($idPlanArea){
        $this->db->from("plan_areas");
        $this->db->where("id_plan_area", $idPlanArea);
        $result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    function get_all($idPlanArea){
        $this->db->from("plan_areas");
        $result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function get_by_docente($idDocente){
        $this->db->from("plan_areas pa");
        $this->db->join("cfg_areas ca", "ca.codarea = pa.area");
        $this->db->join("cfg_materias cm", "cm.codmateria = pa.materia");
        $this->db->join("periodos p", "p.id_periodo = pa.periodo");
        $this->db->where("pa.created_by", $idDocente);
        $result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
} 
