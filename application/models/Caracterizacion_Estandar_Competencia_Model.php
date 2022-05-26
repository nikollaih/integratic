<?php
class Caracterizacion_Estandar_Competencia_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

    function get($id_estandar){
		$this->db->from("caracterizacion_estandar ce");
		$this->db->join("caracterizacion_area ca", "ce.id_area = ca.id_caracterizacion_area");
		$this->db->where("ce.id_estandar", $id_estandar);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_all(){
		$this->db->from("caracterizacion_estandar ce");
		$this->db->join("caracterizacion_area ca", "ce.id_area = ca.id_caracterizacion_area");
		$this->db->order_by("ca.id_caracterizacion_area", "asc");
        $this->db->order_by("ce.descripcion_estandar", "asc");
		$this->db->where("ce.estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_all_area_grado($id_area, $grado){
		$this->db->from("caracterizacion_estandar ce");
		$this->db->join("caracterizacion_area ca", "ce.id_area = ca.id_caracterizacion_area");
		$this->db->order_by("ca.id_caracterizacion_area", "asc");
        $this->db->order_by("ce.descripcion_estandar", "asc");
		$this->db->where("ce.estado", 1);
		$this->db->where("ce.id_area", $id_area);
		$this->db->where("ce.grado", $grado);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function create($data){
        return $this->db->insert("caracterizacion_estandar", $data);
    }

    function update($data){
		$this->db->where("id_estandar", $data["id_estandar"]);
		return $this->db->update("caracterizacion_estandar", $data);
	}

	function delete($id_estandar){
		$this->db->where("id_estandar", $id_estandar);
		return $this->db->delete("caracterizacion_estandar");
	}
}