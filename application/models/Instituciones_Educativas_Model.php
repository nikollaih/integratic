<?php
class Instituciones_Educativas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

    public function get_by_municipio($id_municipio){
        $this->db->from("instituciones_educativas");
        $this->db->where("id_municipio", $id_municipio);
        $this->db->order_by("nombre_institucion", "ASC");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

	public function find($id_ie){
        $this->db->from("instituciones_educativas");
        $this->db->where("id_institucion_educativa", $id_ie);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : [] ;
    }
}