<?php
class Caracterizacion_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

    function get($id_caracterizacion){
		$this->db->select("c.*, ca.descripcion_area, cd.descripcion_dba, clc.descripcion_lineamiento_curricular, ce.descripcion_estandar");
		$this->db->from("caracterizacion c");
		$this->db->join("caracterizacion_area ca", "c.id_area = ca.id_caracterizacion_area");
        $this->db->join("caracterizacion_dba cd", "c.id_dba = cd.id_dba", "left outer");
        $this->db->join("caracterizacion_lineamiento_curricular clc", "c.id_lineamiento_curricular = clc.id_lineamiento_curricular", "left outer");
        $this->db->join("caracterizacion_estandar ce", "c.id_estandar = ce.id_estandar", "left outer");
		$this->db->where("c.estado", 1);
        $this->db->where("c.id_caracterizacion", $id_caracterizacion);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_all(){
		$this->db->select("c.*, ca.descripcion_area, cd.descripcion_dba, clc.descripcion_lineamiento_curricular, ce.descripcion_estandar");
		$this->db->from("caracterizacion c");
		$this->db->join("caracterizacion_area ca", "c.id_area = ca.id_caracterizacion_area");
        $this->db->join("caracterizacion_dba cd", "c.id_dba = cd.id_dba", "left outer");
        $this->db->join("caracterizacion_lineamiento_curricular clc", "c.id_lineamiento_curricular = clc.id_lineamiento_curricular", "left outer");
        $this->db->join("caracterizacion_estandar ce", "c.id_estandar = ce.id_estandar", "left outer");
		$this->db->where("c.estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_all_area_grado($id_area, $grado){
		$this->db->select("c.*, ca.descripcion_area, cd.descripcion_dba, clc.descripcion_lineamiento_curricular, ce.descripcion_estandar");
		$this->db->from("caracterizacion c");
		$this->db->join("caracterizacion_area ca", "c.id_area = ca.id_caracterizacion_area");
        $this->db->join("caracterizacion_dba cd", "c.id_dba = cd.id_dba", "left outer");
        $this->db->join("caracterizacion_lineamiento_curricular clc", "c.id_lineamiento_curricular = clc.id_lineamiento_curricular", "left outer");
        $this->db->join("caracterizacion_estandar ce", "c.id_estandar = ce.id_estandar", "left outer");
		$this->db->where("c.estado", 1);
		$this->db->where("c.id_area", $id_area);
		$this->db->where("c.grado", $grado);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function create($data){
        return $this->db->insert("caracterizacion", $data);
    }

    function update($data){
		$this->db->where("id_caracterizacion", $data["id_caracterizacion"]);
		return $this->db->update("caracterizacion", $data);
	}

	function delete($id_caracterizacion){
		$this->db->where("id_caracterizacion", $id_caracterizacion);
		return $this->db->delete("caracterizacion");
	}
}