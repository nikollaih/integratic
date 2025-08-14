<?php
class Materias_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function getMateria($id_materia){
		$this->db->from("cfg_materias cm");
		$this->db->join("cfg_areas ca", "cm.area = ca.codarea");
        $this->db->where("codmateria", $id_materia);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

    function getGruposMateria($ids_materia){
        $this->db->query("SET SESSION sql_mode = (SELECT REPLACE(@@SESSION.sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $this->db->select("cm.codmateria, cm.nommateria, am.grupo, cm.grado, cm.area"); // Select relevant columns
        $this->db->from("asg_materias am");
        $this->db->join("cfg_materias cm", "am.materia = cm.codmateria");
        $this->db->where_in("cm.codmateria", $ids_materia);
        $this->db->group_by(["cm.codmateria", "cm.grado", "am.grupo"]); // Grouping by multiple columns

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

	function getMateriaPrueba($array_materias_id){
		$this->db->from("cfg_materias");
        $this->db->where_in("codmateria", $array_materias_id);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getMateriasArea($area){
		$this->db->from("cfg_materias");
        $this->db->where("area", $area);
        $this->db->order_by("nommateria", "asc");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function getMateriasAreaDocente($area, $id_docente){
        $this->db->from("cfg_materias cm");
        $this->db->join("asg_materias am", "cm.codmateria = am.materia");
        $this->db->where("cm.area", $area);
        $this->db->where("am.docente", $id_docente);
        $this->db->order_by("cm.nommateria", "asc");
        $this->db->group_by("am.materia");
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

	function getMateriasDocente($id_docente, $ids = false, $group_by = true){
		if($ids){
			$this->db->select("am.materia");
		}
		$this->db->from("asg_materias am");
		$this->db->join("cfg_materias cm", "am.materia = cm.codmateria");
        $this->db->where("am.docente", $id_docente);
		if($group_by) {$this->db->group_by("am.materia");}
        $this->db->order_by("cm.nommateria", "asc");
        $this->db->order_by("am.grupo", "asc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getMateriasGrupoGrado($grado, $grupo, $idDocente = null){
          $this->db->select("cm.codmateria, cm.nommateria, cm.area, cm.grado, am.materia, am.grupo");
		$this->db->from("cfg_materias cm");
		$this->db->join("asg_materias am", "cm.codmateria = am.materia");
		$this->db->where("cm.grado", $grado);
		$this->db->where("am.grupo", $grupo);
        if($idDocente){
            $this->db->where("am.docente", $idDocente);
        }
        $this->db->group_by("cm.codmateria, cm.nommateria, cm.area, cm.grado, am.materia, am.grupo");

		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : [];
	}
}