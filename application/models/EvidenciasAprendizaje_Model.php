<?php  
class EvidenciasAprendizaje_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function create($data){
        unset($data['id_evidencia_aprendizaje']);
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

    // Obtiene la lista de evidencias de aprendizaje basados
    // en los fintros establecidos por el usuario
    function get_by_filter($area = null, $materia = null, $semana = null, $periodo = null, $estado = null){
        $this->db->from("evidencias_aprendizaje ea");
        $this->db->join("plan_areas pa", "ea.id_plan_area = pa.id_plan_area");
        $this->db->join("usuarios u", "u.id = pa.created_by");
        $this->db->join("cfg_areas ca", "ca.codarea = pa.area");
        $this->db->join("cfg_materias cm", "cm.codmateria = pa.materia");
        $this->db->join("periodos p", "p.id_periodo = pa.periodo");

        // Aplica filtro de área
        if($area != null){
            $this->db->where("pa.area", $area);
        }

        // Aplica filtro de materia
        if($materia != null){
            $this->db->where("pa.materia", $materia);
        }

        // Aplica filtro de periodo
        if($periodo != null && $semana == null){
            $this->db->where("pa.periodo", $periodo);
        }

        // Aplica filtro de estado
        if($estado != null){
            $this->db->where("ea.estado_completo", $estado);
        }

        // Aplica filtro de semana
        if($semana != null){
            $this->db->where("ea.semanas LIKE '%\"".$semana."\"%'", NULL, FALSE);
        }
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
