<?php
class Pruebas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get_all(){
        $this->db->select("p.*, tp.descripcion as tipo_prueba, ap.descripcion as alcance_prueba");
		$this->db->from("pruebas p");
		$this->db->join("alcance_prueba ap", "p.alcance_prueba = ap.id_alcance_prueba");
        $this->db->join("tipo_prueba tp", "p.tipo_prueba = tp.id_tipo_prueba");
		$this->db->order_by("p.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get($id_prueba){
		$this->db->select("p.*, tp.descripcion as tipo_prueba, ap.descripcion as alcance_prueba");
		$this->db->from("pruebas p");
		$this->db->join("alcance_prueba ap", "p.alcance_prueba = ap.id_alcance_prueba");
        $this->db->join("tipo_prueba tp", "p.tipo_prueba = tp.id_tipo_prueba");
		$this->db->where("p.id_prueba", $id_prueba);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	// Create a new test
	function create($data){
		$this->db->insert("pruebas", $data);
		return $this->db->insert_id(); 
	}
}