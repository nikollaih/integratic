<?php

class CaracterizacionEstudiantesRespuestas_Model extends CI_Model
{

    /**
     * @var string
     */
    private $table;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'caracterizacion_estudiantes_respuestas';
        $this->table_students = 'estudiante';
    }

    public function getRespuestas($idEstudiante) {
        $this->db->select($this->table . ".*");
        $this->db->from($this->table);
        $this->db->where("id_estudiante", $idEstudiante);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function existsRespuesta($idEstudiante, $idPregunta): bool
    {
        $this->db->from($this->table);
        $this->db->where("id_estudiante", $idEstudiante);
        $this->db->where("id_pregunta", $idPregunta);
        $result = $this->db->get();
        return ($result->num_rows() > 0);
    }

    public function setRespuesta($respuesta) {
        return $this->db->insert($this->table, $respuesta);
    }

    public function updateRespuesta($idEstudiante, $idPregunta, $respuesta) {
        $this->db->where("id_estudiante", $idEstudiante);
        $this->db->where("id_pregunta", $idPregunta);
        return $this->db->update($this->table, $respuesta);
    }
}