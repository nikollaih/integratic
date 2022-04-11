<?php
class Configuracion_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getConfiguracion(){
        $this->db->from("configuracion");
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function addConfiguracion($data){
        $this->db->insert("configuracion", $data);
        return $this->db->insert_id();
    }

    public function updateConfiguracion($data){
        $this->db->where("id_configuracion", $data["id_configuracion"]);
        return $this->db->update("configuracion", $data);
    }
}