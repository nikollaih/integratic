<?php
class PlanAreas_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function create($data){
        unset($data['id_plan_area']);
        $this->db->insert("plan_areas", $data);
        return $this->db->insert_id();
    }

    function update($data){
        $this->db->where("id_plan_area", $data["id_plan_area"]);
        return $this->db->update("plan_areas", $data);
    }

    function find($idPlanArea){
        $this->db->select("pa.*, p.periodo, p.id_periodo, ca.*, cm.*");
        $this->db->from("plan_areas pa");
        $this->db->join("periodos p", "p.id_periodo = pa.periodo");
        $this->db->join("cfg_areas ca", "ca.codarea = pa.area");
        $this->db->join("cfg_materias cm", "cm.codmateria = pa.materia");
        $this->db->where("id_plan_area", $idPlanArea);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    function get_all($idPlanArea){
        $this->db->select("pa.*, p.periodo, p.id_periodo");
        $this->db->from("plan_areas pa");
        $this->db->join("periodos p", "p.id_periodo = pa.periodo");
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function get_by_docente($idDocente, $area = null, $materia = null, $periodo = null){
        $this->db->select('ca.*, cm.*, p.*, pa.*, p.periodo as nombre_periodo');
        $this->db->from("plan_areas pa");
        $this->db->join("cfg_areas ca", "ca.codarea = pa.area");
        $this->db->join("cfg_materias cm", "cm.codmateria = pa.materia");
        $this->db->join("periodos p", "p.id_periodo = pa.periodo");
        $this->db->where("pa.created_by", $idDocente);

        if($area != "" && $area != null){
            $this->db->where("pa.area", $area);
        }
        if($materia != "" && $materia != null){
            $this->db->where("pa.materia", $materia);
        }
        if($periodo != "" && $periodo != null){
            $this->db->where("pa.periodo", $periodo);
        }

        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function get_by_filter($area = null, $materia = null, $periodo = null, $year = null){
        $startDate = $year."-01-01";
        $endDate = $year."-12-31";
        $this->db->select('ca.*, cm.*, pa.*, p.*');
        $this->db->from("plan_areas pa");
        $this->db->join("cfg_areas ca", "ca.codarea = pa.area");
        $this->db->join("cfg_materias cm", "cm.codmateria = pa.materia");
        $this->db->join("periodos p", "p.id_periodo = pa.periodo");
        if($area != "" && $area != null){
            $this->db->where("pa.area", $area);
        }
        if($materia != "" && $materia != null){
            $this->db->where("pa.materia", $materia);
        }
        if($periodo != "" && $periodo != null){
            $this->db->where("pa.periodo", $periodo);
        }
        if($year){
            $this->db->where('pa.fecha_inicio >=', $startDate);
            $this->db->where('pa.fecha_fin <=', $endDate);
        }
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function delete($idPlanArea){
        $this->db->where("id_plan_area", $idPlanArea);
        return $this->db->delete("plan_areas");
    }
} 
