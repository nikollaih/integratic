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
		$this->db->from("asg_materias am");
		$this->db->join("cfg_materias cm", "am.materia = cm.codmateria");
        $this->db->where_in("materia", $ids_materia);
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
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getMateriasDocente($id_docente, $ids = false){
		if($ids){
			$this->db->select("am.materia");
		}
		$this->db->from("asg_materias am");
		$this->db->join("cfg_materias cm", "am.materia = cm.codmateria");
        $this->db->where("am.docente", $id_docente);
		$this->db->group_by("am.materia");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getMateriasGrupoGrado($grado, $grupo){
		$this->db->from("cfg_materias cm");
		$this->db->join("asg_materias am", "cm.codmateria = am.materia");
		$this->db->where("cm.grado", $grado);
		$this->db->where("am.grupo", $grupo);

		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : [];
	}
}