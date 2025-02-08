<?php

/**
 * @property $load
 * @property string $piar_table
 * @property $db
 * @property string $piar_item_table
 * @property string $materias_table
 */
class PIAR_Item_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->piar_table = 'piar';
        $this->piar_item_table = 'piar_item';
        $this->materias_table = 'cfg_materias';
    }

    public function create($data){
        $this->db->insert($this->piar_item_table, $data);
        return $this->db->insert_id();
    }

    public function update($idPiarItem, $data){
        $this->db->where('id_piar_item', $idPiarItem);
        return $this->db->update($this->piar_item_table, $data);
    }

    public function get($piarItemId){
        $this->db->from($this->piar_item_table);
        $this->db->join($this->piar_table, $this->piar_item_table.'.id_piar = '.$this->piar_table.'.id_piar');
        $this->db->join($this->materias_table, $this->materias_table.'.codmateria = '.$this->piar_item_table.'.id_materia');
        $this->db->where($this->piar_item_table.'.id_piar_item', $piarItemId);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : [];
    }

    public function getAllByPiar($piarId){
        $this->db->from($this->piar_item_table);
        $this->db->join($this->piar_table, $this->piar_item_table.'.id_piar = '.$this->piar_table.'.id_piar');
        $this->db->join($this->materias_table, $this->materias_table.'.codmateria = '.$this->piar_item_table.'.id_materia');
        $this->db->where($this->piar_item_table.'.id_piar', $piarId);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : [];
    }

    public function delete($piarItemId){
        $this->db->where('id_piar_item', $piarItemId);
        return $this->db->delete($this->piar_item_table);
    }
}