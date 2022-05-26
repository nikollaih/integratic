<?php
class Caracterizacion_Lineamientos_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

    function get($id_lineamiento_curricular){
		$this->db->from("caracterizacion_lineamiento_curricular clc");
		$this->db->join("caracterizacion_area ca", "clc.id_area = ca.id_caracterizacion_area");
		$this->db->where("clc.id_lineamiento_curricular", $id_lineamiento_curricular);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_all(){
		$this->db->from("caracterizacion_lineamiento_curricular clc");
		$this->db->join("caracterizacion_area ca", "clc.id_lineamiento_curricular = ca.id_caracterizacion_area");
		$this->db->order_by("ca.id_caracterizacion_area", "asc");
        $this->db->order_by("clc.descripcion_lineamiento_curricular", "asc");
		$this->db->where("clc.estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_all_area_grado($id_area, $grado){
		$this->db->from("caracterizacion_lineamiento_curricular clc");
		$this->db->join("caracterizacion_area ca", "clc.id_lineamiento_curricular = ca.id_caracterizacion_area");
		$this->db->order_by("ca.id_caracterizacion_area", "asc");
        $this->db->order_by("clc.descripcion_lineamiento_curricular", "asc");
		$this->db->where("clc.estado", 1);
		$this->db->where("clc.id_area", $id_area);
		$this->db->where("clc.grado", $grado);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function create($data){
        return $this->db->insert("caracterizacion_lineamiento_curricular", $data);
    }

    function update($data){
		$this->db->where("id_lineamiento_curricular", $data["id_lineamiento_curricular"]);
		return $this->db->update("caracterizacion_lineamiento_curricular", $data);
	}

	function delete($id_lineamiento_curricular){
		$this->db->where("id_lineamiento_curricular", $id_lineamiento_curricular);
		return $this->db->delete("caracterizacion_lineamiento_curricular");
	}
}