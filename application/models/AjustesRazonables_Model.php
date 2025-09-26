<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjustesRazonables_Model extends CI_Model {

    public function get_all($categoria_id = null) {
        $this->db->select('a.*, c.nombre_categoria');
        $this->db->from('ajustes_razonables a');
        $this->db->join('categorias_ajustes_razonables c', 'a.id_categoria = c.id_categorias_ajustes_razonables');

        if ($categoria_id) {
            $this->db->where('a.id_categoria', $categoria_id);
        }

        return $this->db->get()->result();
    }

    public function get_by_ids($array_ids = null) {
        if(!is_array($array_ids) || empty($array_ids)) {
            return [];
        }

        $this->db->select('a.*, c.nombre_categoria');
        $this->db->from('ajustes_razonables a');
        $this->db->join('categorias_ajustes_razonables c', 'a.id_categoria = c.id_categorias_ajustes_razonables');
        $this->db->where_in('a.id_ajustes_razonables', $array_ids);

        return $this->db->get()->result();
    }

    public function get($id) {
        $this->db->select('ar.*, cat.nombre_categoria');
        $this->db->from('ajustes_razonables ar');
        $this->db->join('categorias_ajustes_razonables cat', 'ar.id_categoria = cat.id_categorias_ajustes_razonables');
        $this->db->where('ar.id_ajustes_razonables', $id);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('ajustes_razonables', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_ajustes_razonables', $id);
        return $this->db->update('ajustes_razonables', $data);
    }

    public function delete($id) {
        $this->db->where('id_ajustes_razonables', $id);
        return $this->db->delete('ajustes_razonables');
    }

    public function get_categorias() {
        return $this->db->get('categorias_ajustes_razonables')->result();
    }
}
