<?php

class RecuperacionEstudiante_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'recuperaciones_estudiantes';
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function getAll($idRecuperacion) {
        $this->db->select("e.*");
        $this->db->from($this->table." re");
        $this->db->join("estudiante e", "re.id_estudiante = e.documento");
        $this->db->where("re.id_recuperacion", $idRecuperacion);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function update($idRecuperacion, $documento, $data) {
        $this->db->where('id_recuperacion', $idRecuperacion);
        $this->db->where('id_estudiante', $documento);
        return $this->db->update($this->table, $data);
    }

    public function get($idRecuperacion, $idEstudiante) {
        $this->db->select("e.*, re.*");
        $this->db->from($this->table." re");
        $this->db->join("estudiante e", "re.id_estudiante = e.documento");
        $this->db->where("re.id_recuperacion", $idRecuperacion);
        $this->db->where("re.id_estudiante", $idEstudiante);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function delete($idRecuperacion, $idEstudiante) {
        $this->db->where("id_recuperacion", $idRecuperacion);
        $this->db->where("id_estudiante", $idEstudiante);
        return $this->db->delete($this->table);
    }
}