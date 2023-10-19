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

    function update($data){
        $this->db->where("id_semana_periodo", $data["id_semana_periodo"]);
        return $this->db->update("semanas_periodo", $data);
    }

    function delete($idSemana){
        $this->db->where("id_semana_periodo", $idSemana);
        return $this->db->delete("semanas_periodo");
    }

    function getByPeriodo($idPeriodo){
        $this->db->select("sm.*, p.periodo as nombre_periodo");
        $this->db->from("semanas_periodo sm");
        $this->db->join("periodos p", "sm.periodo = p.id_periodo");
        $this->db->where("sm.periodo", $idPeriodo);
        $this->db->order_by("semana ASC");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function find($idArea){
        $this->db->from("semanas_periodo");
        $this->db->where("id_semana_periodo", $idArea);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    function getByIDs($semanasIDs){
        $this->db->from("semanas_periodo");
        $this->db->where_in("id_semana_periodo", $semanasIDs);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
} 
