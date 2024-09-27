<?php

class Recuperacion_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'recuperaciones';
        $this->periodos_table = 'periodos';
        $this->materias_table = 'cfg_materias';
        $this->actividades_table = 'actividades';
        $this->recuperaciones_actividades_table = 'recuperaciones_actividades';
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where("id_recuperacion", $id);
        $this->db->update($this->table, $data);
    }

    public function getAll($createdUserId) {
        $this->db->select($this->table.'.*, '.$this->periodos_table.'.periodo,'.$this->materias_table.'.nommateria, '.$this->materias_table.'.grado');
        $this->db->from($this->table);
        $this->db->join($this->periodos_table, $this->periodos_table.'.id_periodo = '.$this->table.'.id_periodo');
        $this->db->join($this->materias_table, $this->materias_table.'.codmateria = '.$this->table.'.materia');
        $this->db->where('created_by', $createdUserId);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getActivities($idRecuperacion) {
        $this->db->select($this->table.'.*, '.$this->actividades_table.'.*');
        $this->db->from($this->table);
        $this->db->join($this->recuperaciones_actividades_table, $this->table.'.id_recuperacion = '.$this->recuperaciones_actividades_table.'.id_recuperacion');
        $this->db->join($this->actividades_table, $this->recuperaciones_actividades_table.'.id_actividad = '.$this->actividades_table.'.id_actividad');
        $this->db->where($this->table.'.id_recuperacion', $idRecuperacion);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function find($id) {
        $this->db->from($this->table);
        $this->db->where('id_recuperacion', $id);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function delete($id) {
        $this->db->where("id_recuperacion", $id);
        $this->db->delete($this->table);
    }
}