<?php
class TipoComponenteEvidencia_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function create($data){
        $this->db->insert("tipo_componente_evidencia", $data);
        return $this->db->insert_id();
    }

    public function update($data){
        $this->db->where("id_tipo_componente", $data["id_tipo_componente"]);
        return $this->db->update("tipo_componente_evidencia", $data);
    }

    public function find($id){
        $this->db->from("tipo_componente_evidencia");
        $this->db->where("id_tipo_componente", $id);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function getAll($all = false) {
        $this->db->from("tipo_componente_evidencia");
        $this->db->order_by("orden", "asc");
        if(!$all){
            $this->db->where("activo", 1);
        }
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function delete($id){
        $this->db->where("id_tipo_componente", $id);
        return $this->db->delete("tipo_componente_evidencia");
    }
}
