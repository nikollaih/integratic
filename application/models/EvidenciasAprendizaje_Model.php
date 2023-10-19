<?php  
class EvidenciasAprendizaje_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function create($data){
        $this->db->insert("evidencias_aprendizaje", $data);
        return $this->db->insert_id();
    }

    function update($data){
        $this->db->where("id_evidencia_aprendizaje", $data["id_evidencia_aprendizaje"]);
        return $this->db->update("evidencias_aprendizaje", $data);
    }

    function getByPlanArea($idPlanArea){
        $this->db->from("evidencias_aprendizaje ea");
        $this->db->where("ea.id_plan_area", $idPlanArea);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function getBySemanasPeriodo($semanasIDS){
        $this->db->from("evidencias_aprendizaje ea");
        if(is_array($semanasIDS)){
            $this->db->like("ea.semanas", '"'.$semanasIDS[0].'"', "both");
        }
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function find($idEvidenciaAprendizaje){
        $this->db->from("evidencias_aprendizaje");
        $this->db->where("id_evidencia_aprendizaje", $idEvidenciaAprendizaje);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    function delete($idEvidenciaAprendizaje){
        $this->db->where("id_evidencia_aprendizaje", $idEvidenciaAprendizaje);
        return $this->db->delete("evidencias_aprendizaje");
    }

    function deleteByPlanAula($idPlanAula){
        $this->db->where("id_plan_area", $idPlanAula);
        return $this->db->delete("evidencias_aprendizaje");
    }
} 
