<?php


/**
 * @property $load
 * @property string $piar_table
 * @property $db
 * @property string $piar_actividad_table
 */
class PIAR_Actividad_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->piar_table = 'piar';
        $this->piar_actividad_table = 'piar_actividades';
    }

    public function create($data)
    {
        $this->db->insert($this->piar_actividad_table, $data);
        return $this->db->insert_id();
    }

    public function update($idPiarActividad, $data)
    {
        $this->db->where('id_piar_actividad', $idPiarActividad);
        return $this->db->update($this->piar_actividad_table, $data);
    }

    public function get($piarActivityId)
    {
        $this->db->from($this->piar_actividad_table);
        $this->db->where($this->piar_actividad_table . '.id_piar_actividad', $piarActivityId);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function getAllByPiar($piarId)
    {
        $this->db->from($this->piar_actividad_table);
        $this->db->join($this->piar_table, $this->piar_actividad_table . '.id_piar = ' . $this->piar_table . '.id_piar');
        $this->db->where($this->piar_actividad_table . '.id_piar', $piarId);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : [];
    }

    public function delete($piarActividadId)
    {
        $this->db->where('id_piar_actividad', $piarActividadId);
        return $this->db->delete($this->piar_actividad_table);
    }
}