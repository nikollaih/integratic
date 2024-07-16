<?php

class CaracterizacionEstudiantesPreguntas_Model extends CI_Model
{

    /**
     * @var string
     */
    private $table;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'caracterizacion_estudiantes_preguntas';
    }

    public function getPreguntas() {
        $this->db->select($this->table . ".*");
        $this->db->from($this->table);
        $this->db->order_by($this->table.".orden", "asc");
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}