<?php
class Materias_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function getMateria($id_materia){
		$this->db->from("cfg_materias");
        $this->db->where("codmateria", $id_materia);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function getMateriaPrueba($array_materias_id){
		$this->db->from("cfg_materias");
        $this->db->where_in("codmateria", $array_materias_id);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}
}