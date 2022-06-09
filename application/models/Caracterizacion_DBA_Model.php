<?php
class Caracterizacion_DBA_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

    function get($id_dba){
		$this->db->from("caracterizacion_dba cd");
		$this->db->join("caracterizacion_area ca", "cd.id_area = ca.id_caracterizacion_area");
		$this->db->where("cd.id_dba", $id_dba);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_all(){
		$this->db->from("caracterizacion_dba cd");
		$this->db->join("caracterizacion_area ca", "cd.id_area = ca.id_caracterizacion_area");
		$this->db->order_by("ca.id_caracterizacion_area", "asc");
        $this->db->order_by("cd.descripcion_dba", "asc");
		$this->db->where("cd.estado", 1);
		$this->db->where("ca.is_dba", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_all_area_grado($id_area, $grado){
		$this->db->from("caracterizacion_dba cd");
		$this->db->join("caracterizacion_area ca", "cd.id_area = ca.id_caracterizacion_area");
		$this->db->order_by("ca.id_caracterizacion_area", "asc");
        $this->db->order_by("cd.descripcion_dba", "asc");
		$this->db->where("cd.estado", 1);
		$this->db->where("cd.id_area", $id_area);
		$this->db->like("grado", '"'.$grado.'"', "both");
		$this->db->where("ca.is_dba", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function create($data){
        return $this->db->insert("caracterizacion_dba", $data);
    }

    function update($data){
		$this->db->where("id_dba", $data["id_dba"]);
		return $this->db->update("caracterizacion_dba", $data);
	}

	function delete($id_dba){
		$this->db->where("id_dba", $id_dba);
		return $this->db->delete("caracterizacion_dba");
	}
}