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
		$this->db->join("cfg_materias cm", "cm.codmateria = a.materia");
        $this->db->where("a.grupo", $grupo);
        $this->db->where("a.materia", $materia);
		$this->db->order_by("a.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_activity_response($id_actividad, $estudiante){
		$this->db->from("respuestas_actividades");
		$this->db->where("id_actividad", $id_actividad);
		$this->db->where("created_by", $estudiante);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_all_activity_response($id_actividad){
		$this->db->from("respuestas_actividades ra");
		$this->db->join("actividades a", "a.id_actividad == ra.id_actividad");
		$this->db->where("id_actividad", $id_actividad);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	// Create a new activity
	function create($data){
		$this->db->insert("actividades", $data);
		return $this->db->insert_id(); 
	}

	// Create a new activity response
	function create_response($data){
		$this->db->insert("respuestas_actividades", $data);
		return $this->db->insert_id(); 
	}

	// Update an activity
	function update($data){
		$this->db->where("id_actividad", $data["id_actividad"]);
		return $this->db->update("actividades", $data);
	}

	// Update an activity
	function update_response($data){
		$this->db->where("id_respuestas_actividades", $data["id_respuestas_actividades"]);
		return $this->db->update("respuestas_actividades", $data);
	}
}