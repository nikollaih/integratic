<?php

/**
 * @property $load
 * @property string $piar_table
 * @property $db
 * @property string $piar_item_table
 * @property string $materias_table
 * @property string $areas_table
 * @property string $periodos_table
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
        $this->areas_table = 'cfg_areas';
        $this->periodos_table = 'periodos';
    }

    public function create($data){
        $this->db->insert($this->piar_item_table, $data);
        return $this->db->insert_id();
    }

    public function update($idPiarItem, $data){
        $this->db->where('id_piar_item', $idPiarItem);
        return $this->db->update($this->piar_item_table, $data);
    }

    public function get($piarItemId) {
        // Seleccionar id_materia para verificar si tiene un valor
        $this->db->select('id_materia');
        $this->db->from($this->piar_item_table);
        $this->db->where('id_piar_item', $piarItemId);
        $query = $this->db->get();

        if ($query->num_rows() === 0) {
            return [];
        }

        $row = $query->row_array();
        $id_materia = $row['id_materia'];

        // Construir la consulta principal
        $this->db->select($this->piar_item_table . '.*, ' . $this->piar_table . '.*'); // Campos base
        $this->db->from($this->piar_item_table);
        $this->db->join($this->piar_table, $this->piar_item_table . '.id_piar = ' . $this->piar_table . '.id_piar');

        // Solo hacer JOIN con materias si id_materia no es NULL o vacío
        if (!empty($id_materia)) {
            $this->db->select($this->materias_table . '.*'); // Agregar campos de materias solo si se usa el JOIN
            $this->db->join($this->materias_table, $this->materias_table . '.codmateria = ' . $this->piar_item_table . '.id_materia');
        }

        $this->db->where($this->piar_item_table . '.id_piar_item', $piarItemId);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : [];
    }


    public function getAllByPiar($piarId){
        $this->db->from($this->piar_item_table);
        $this->db->join($this->piar_table, $this->piar_item_table.'.id_piar = '.$this->piar_table.'.id_piar');
        $this->db->join($this->materias_table, $this->materias_table.'.codmateria = '.$this->piar_item_table.'.id_materia');
        $this->db->join($this->areas_table, $this->materias_table.'.area = '.$this->areas_table.'.codarea');
        $this->db->join($this->periodos_table, $this->piar_item_table.'.id_periodo = '.$this->periodos_table.'.id_periodo', 'left outer');
        $this->db->where($this->piar_item_table.'.id_piar', $piarId);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : [];
    }

    public function getByDocenteMateriaPeriodo($docente, $materia, $periodo){
        $this->db->from($this->piar_item_table);
        $this->db->join($this->piar_table, $this->piar_item_table.'.id_piar = '.$this->piar_table.'.id_piar');
        $this->db->join($this->materias_table, $this->materias_table.'.codmateria = '.$this->piar_item_table.'.id_materia');
        $this->db->join($this->areas_table, $this->materias_table.'.area = '.$this->areas_table.'.codarea');
        $this->db->join($this->periodos_table, $this->piar_item_table.'.id_periodo = '.$this->periodos_table.'.id_periodo', 'left outer');
        $this->db->where($this->piar_item_table.'.id_docente', $docente);
        $this->db->where($this->piar_item_table.'.id_materia', $materia);
        $this->db->where($this->piar_item_table.'.id_periodo', $periodo);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : [];
    }

    public function getAllByPiarCategories($piarId){
        $this->db->select($this->piar_item_table.'.*, otro_materia as nommateria');
        $this->db->from($this->piar_item_table);
        $this->db->join($this->piar_table, $this->piar_item_table.'.id_piar = '.$this->piar_table.'.id_piar');
        $this->db->where($this->piar_item_table.'.id_piar', $piarId);
        $this->db->where($this->piar_item_table.'.id_materia', NULL);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : [];
    }

    public function delete($piarItemId){
        $this->db->where('id_piar_item', $piarItemId);
        return $this->db->delete($this->piar_item_table);
    }
}