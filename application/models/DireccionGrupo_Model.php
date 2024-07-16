<?php

class DireccionGrupo_Model extends CI_Model
{
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'direccion_grupo';
    }

    public function create($direccion_grupo) {
        return $this->db->insert($this->table, $direccion_grupo);
    }

    public function update($direccion_grupo) {
        $this->db->where('id_direccion_grupo', $direccion_grupo['id_direccion_grupo']);
        return $this->db->update($this->table, $direccion_grupo);
    }

    public function getByDocente($id_docente) {
        $this->db->from($this->table);
        $this->db->where('docente', $id_docente);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function get() {
        $this->db->from($this->table);
        $this->db->join("usuarios u", "u.id = {$this->table}.docente");
        $this->db->order_by('u.nombres', 'asc');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}