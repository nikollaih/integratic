<?php

class EvidenciasAprendizajeSoportes_Model extends CI_Model
{
    private $table = "evidencias_aprendizaje_soportes";
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Agrega un nuevo documento de soporte a la evidencia
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Obtiene la lista de soportes de una evidencia de aprendizaje
    // $idEvidenciaAprendizaje: Int -> ID de la evidencia de aprendizaje para consultar sus soportes
    public function getAll($idEvidenciaAprendizaje) {
        $this->db->from($this->table);
        $this->db->where("id_evidencia_aprendizaje", $idEvidenciaAprendizaje);

        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    // Obtiene un registro de soporte de la evidencia de aprendizaje
    public function find($idSoporteEvidenciaAprendizaje) {
        $this->db->from($this->table);
        $this->db->where("id", $idSoporteEvidenciaAprendizaje);

        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    // Elimina un registro de soporte de la evidencia de aprendizaje
    public function delete($idSoporteEvidenciaAprendizaje) {
        $this->db->where("id", $idSoporteEvidenciaAprendizaje);
        return $this->db->delete($this->table);
    }
}