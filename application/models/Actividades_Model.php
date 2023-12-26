<?php
class Actividades_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	// Get the activity for a particular group
	function get_all($materia, $grupo, $rol = "docente", $all = false){
		$this->db->from("actividades a");
		$this->db->join("usuarios u", "a.created_by = u.id");
		$this->db->join("cfg_materias cm", "cm.codmateria = a.materia");
		$this->db->join("periodos p", "p.id_periodo = a.id_periodo");
        $this->db->where("a.grupo", $grupo);
		if($materia != null){
			$this->db->where("a.materia", $materia);
		}
		if(strtolower($rol) == "estudiante" && !$all){
			$this->db->where("a.disponible_desde <=", date("Y-m-d h:i"));
		}
		$this->db->order_by("a.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	// Get the activity for a particular group
	function get_all_for_students($materia, $periodo, $grupo = null, $grado = null, $id = null){
		$this->db->select("a.*, ra.*, p.periodo, cm.nommateria, cm.grado, ra.created_by");
		$this->db->from("actividades a");
		$this->db->join("usuarios u", "a.created_by = u.id");
		$this->db->join("cfg_materias cm", "cm.codmateria = a.materia");
		$this->db->join("asg_materias am", "cm.codmateria = am.materia");
		$this->db->join("periodos p", "p.id_periodo = a.id_periodo");
		$this->db->join("respuestas_actividades ra", "a.id_actividad = ra.id_actividad AND ra.created_by = '$id'", "left");
		if($periodo != null && $periodo != "null"){
			$this->db->where("a.id_periodo", $periodo);
		}
		if($materia != null && $materia != "null"){
			$this->db->where("a.materia", $materia);
			$this->db->where("a.grupo", $grupo);
		}
		else {	
			$this->db->where("cm.grado", $grado);
			$this->db->where("a.grupo", $grupo);
		}
		$this->db->order_by("a.created_at", "desc");
		$this->db->group_by("a.id_actividad");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : [];
	}

	// Get the activity for a particular group
	function get_actividad($id_actividad){
		$this->db->from("actividades");
        $this->db->where("id_actividad", $id_actividad);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_actividad_all($id_actividad){
		$this->db->from("actividades a");
		$this->db->join("cfg_materias cm", "a.materia = cm.codmateria");
		$this->db->join("usuarios u", "a.created_by = u.id");
        $this->db->where("a.id_actividad", $id_actividad);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
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
		$data["created_at"] = date("Y-m-d H:i:s");
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

	function delete($id_actividad){
		$this->db->where("id_actividad", $id_actividad);
		return $this->db->delete("actividades");
	}

	function delete_responses($id_actividad){
		$this->db->where("id_actividad", $id_actividad);
		return $this->db->delete("respuestas_actividades");
	}

	function delete_response($id_respuesta){
		$this->db->where("id_respuestas_actividades", $id_respuesta);
		return $this->db->delete("respuestas_actividades");
	}
}