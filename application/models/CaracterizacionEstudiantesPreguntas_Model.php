<?php

/**
 * @property $load
 */
class CaracterizacionEstudiantesPreguntas_Model extends CI_Model
{

    /**
     * @var string
     */
    private $table;
    /**
     * @var string
     */
    private $table_categorias;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'caracterizacion_estudiantes_preguntas';
        $this->table_categorias = 'caracterizacion_estudiantes_preguntas_categorias';
    }

    public function getPreguntas() {
        $this->db->select($this->table_categorias . ".*, ".$this->table . ".*");
        $this->db->from($this->table);
        $this->db->join($this->table_categorias, "$this->table_categorias.id_caracterizacion_estudiantes_preguntas_categorias = $this->table.categoria");
        $this->db->order_by($this->table.".categoria", "asc");
        $this->db->order_by($this->table.".orden", "asc");
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}