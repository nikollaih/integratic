<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barreras_Model extends CI_Model {

    public function get_all($categoria_id = null) {
        $this->db->select('b.*, c.nombre_categoria');
        $this->db->from('barreras b');
        $this->db->join('categorias_barreras c', 'b.id_categoria = c.id_categoria_barrera');

        if ($categoria_id) {
            $this->db->where('b.id_categoria', $categoria_id);
        }

        return $this->db->get()->result();
    }

    public function get($id) {
        $this->db->select('b.*, c.nombre_categoria');
        $this->db->from('barreras b');
        $this->db->join('categorias_barreras c', 'b.id_categoria = c.id_categoria_barrera');
        $this->db->where('b.id_barreras', $id);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('barreras', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_barreras', $id);
        return $this->db->update('barreras', $data);
    }

    public function delete($id) {
        $this->db->where('id_barreras', $id);
        return $this->db->delete('barreras');
    }

    public function get_categorias() {
        return $this->db->get('categorias_barreras')->result();
    }
}
