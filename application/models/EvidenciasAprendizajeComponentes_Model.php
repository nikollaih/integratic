<?php
class EvidenciasAprendizajeComponentes_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function create($data){
        $this->db->insert("evidencia_componentes", $data);
        return $this->db->insert_id();
    }

    public function update($data){
        $this->db->where("id_componente", $data["id_componente"]);
        return $this->db->update("evidencia_componentes", $data);
    }

    public function find($id){
        $this->db->from("evidencia_componentes");
        $this->db->where("id_componente", $id);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function getAll() {
        $this->db->from("evidencia_componentes");
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}
