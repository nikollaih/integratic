<?php
class Pruebas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get_all(){
        $this->db->select("p.id_prueba, p.nombre_prueba, p.created_at, p.estado, tp.descripcion as tipo_prueba, ap.descripcion as alcance_prueba");
		$this->db->from("pruebas p");
		$this->db->join("alcance_prueba ap", "p.alcance_prueba = ap.id_alcance_prueba");
        $this->db->join("tipo_prueba tp", "p.tipo_prueba = tp.id_tipo_prueba");
		$this->db->order_by("p.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}
}