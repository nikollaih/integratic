<?php
class Actividades_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	 // Get the activity for a particular group
	function get_all($materia, $grupo){
		$this->db->from("actividades a");
		$this->db->join("usuarios u", "a.created_by = u.id");
        $this->db->where("a.grupo", $grupo);
        $this->db->where("a.materia", $materia);
		$this->db->order_by("a.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	// Create a new activity
	function create($data){
		$this->db->insert("actividades", $data);
		return $this->db->insert_id(); 
	}

	// Update an activity
	function update($data){
		$this->db->where("id_actividad", $data["id_actividad"]);
		return $this->db->update("actividades", $data);
	}
}