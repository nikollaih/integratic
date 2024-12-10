<?php

class RepositorioActividades_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'repositorio_actividades';
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get($idActividad){
        $this->db->where('id_actividad', $idActividad);
        $this->db->from($this->table);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function getByMateria($idMateria){
        $this->db->where('materia', $idMateria);
        $this->db->from($this->table);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function update($idActividad, $data) {
        $this->db->where('id_actividad', $idActividad);
        return $this->db->update($this->table, $data);
    }
}