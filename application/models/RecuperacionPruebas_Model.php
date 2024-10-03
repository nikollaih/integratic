<?php

class RecuperacionPruebas_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'recuperaciones_pruebas';
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get($idRecuperacion, $idPrueba) {
        $this->db->from($this->table);
        $this->db->where("id_prueba", $idPrueba);
        $this->db->where("id_recuperacion", $idRecuperacion);

        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function delete($idRecuperacion, $idPrueba) {
        $this->db->where('id_recuperacion', $idRecuperacion);
        $this->db->where('id_prueba', $idPrueba);
        return $this->db->delete($this->table);
    }
}