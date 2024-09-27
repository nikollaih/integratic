<?php

class RecuperacionActividades_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'recuperaciones_actividades';
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get($idRecuperacion, $idActividad) {
        $this->db->from($this->table);
        $this->db->where("id_actividad", $idActividad);
        $this->db->where("id_recuperacion", $idRecuperacion);

        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}