<?php
class Caracterizacion_Areas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

    function get($id_area){
		$this->db->from("caracterizacion_area");
		$this->db->where("id_caracterizacion_area", $id_area);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_all(){
		$this->db->from("caracterizacion_area");
        $this->db->order_by("descripcion_area", "asc");
		$this->db->where("estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function create($data){
        return $this->db->insert("caracterizacion_area", $data);
    }

    function update($data){
		$this->db->where("id_caracterizacion_area", $data["id_caracterizacion_area"]);
		return $this->db->update("caracterizacion_area", $data);
	}

	function delete($id_area){
		$this->db->where("id_caracterizacion_area", $id_area);
		return $this->db->delete("caracterizacion_area");
	}
}