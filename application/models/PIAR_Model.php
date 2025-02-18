<?php

/**
 * @property $load
 * @property string $piar_table
 * @property $db
 * @property string $students_table
 */
class PIAR_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->piar_table = 'piar';
        $this->students_table = 'estudiante';
    }

    public function create($data){
        $this->db->insert('piar', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data){
        $this->db->where('id_piar', $id);
        return $this->db->update($this->piar_table, $data);
    }

    public function getStudents() {
        $this->db->where($this->students_table . '.nee', 1);
        $this->db->from($this->students_table); // Reverse table order
        $this->db->join(
            $this->piar_table,
            $this->piar_table . '.id_estudiante = ' . $this->students_table . '.documento',
            'left'
        );
        $result = $this->db->get();

        return (!empty($result)) ? $result->result_array() : false;
    }

    public function get($piarId) {
        $this->db->where($this->piar_table . '.id_piar', $piarId);
        $this->db->from($this->piar_table); // Reverse table order
        $this->db->join(
            $this->students_table,
            $this->piar_table . '.id_estudiante = ' . $this->students_table . '.documento'
        );
        $result = $this->db->get();

        return (!empty($result)) ? $result->row_array() : false;
    }
}