<?php
class Realizar_Prueba_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get($id_prueba, $id_participante){
		$this->db->from("realizar_prueba rp");
		$this->db->where("rp.id_prueba", $id_prueba);
		$this->db->where("rp.id_participante", $id_participante);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_by_id($id_realizar_prueba){
		$this->db->from("realizar_prueba rp");
		$this->db->where("rp.id_realizar_prueba", $id_realizar_prueba);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

    function create($data){
        $this->db->insert("realizar_prueba", $data);
        return $this->db->insert_id();
    }

	function update($data){
		$this->db->where("id_realizar_prueba", $data["id_realizar_prueba"]);
		return $this->db->update("realizar_prueba", $data);
	}
}