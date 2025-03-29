<?php
class Preguntas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get_all($materias, $id_materia){
		$this->db->select("pp.*, cm.*, t.id_tema, t.nombre_tema");
		$this->db->from("preguntas_prueba pp");
		$this->db->join("cfg_materias cm", "cm.codmateria = pp.id_materia");
		$this->db->join("temas t", "t.id_tema = pp.id_tema", "left outer");
		if($id_materia && $id_materia != "null"){
			$this->db->where("pp.id_materia", $id_materia);
		}
		else{
			$this->db->where_in("pp.id_materia", $materias);
		}
		$this->db->where("pp.estado", 1);
		$this->db->order_by("pp.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get($id_pregunta){
		$this->db->from("preguntas_prueba pp");
		$this->db->join("cfg_materias cm", "cm.codmateria = pp.id_materia");
		$this->db->order_by("pp.created_at", "desc");
		$this->db->where("pp.id_pregunta_prueba", $id_pregunta);
		$this->db->where("pp.estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	 }

	// Create a new question
	function create($data){
		$this->db->insert("preguntas_prueba", $data);
		return $this->db->insert_id(); 
	}

	// Modify a question
	function update($data){
		$this->db->where("id_pregunta_prueba", $data["id_pregunta_prueba"]);
		return $this->db->update("preguntas_prueba", $data);
	}

	// Get the questions listing based on subject and difficult
	function get_all_mat_dif($materias, $dificultad, $only_ids, $temas){
		if($only_ids){
			$this->db->select("pp.id_pregunta_prueba");
		}
		$this->db->from("preguntas_prueba pp");
		$this->db->join("cfg_materias cm", "cm.codmateria = pp.id_materia");
        $this->db->join("temas t", "pp.id_tema = t.id_tema");
		$this->db->where_in("id_materia", $materias);
        if(is_array($temas)){
            $this->db->where_in("pp.id_tema", $temas);
        }
		if(is_array($dificultad)){
			$like_query = "(";
			for ($i=0; $i < count($dificultad); $i++) {
				if($i == 0){
					$like_query .= "dificultad LIKE '%".$dificultad[$i]."%'";
				}
				else {
					$like_query .= " OR dificultad LIKE '%".$dificultad[$i]."%'";
				}
			}
			$like_query .= ")";
		}
		$this->db->where($like_query);
		$this->db->where("pp.estado", 1);
		$this->db->order_by("pp.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_preguntas_prueba($id_prueba, $id_pregunta = null){
		$this->db->from("asignacion_preguntas_prueba app");
		$this->db->join("preguntas_prueba pp", "app.id_pregunta = pp.id_pregunta_prueba");
		$this->db->join("cfg_materias cm", "cm.codmateria = pp.id_materia");
		$this->db->where("app.id_prueba", $id_prueba);
		$this->db->where("pp.estado", 1);
		if($id_pregunta != null){
			$this->db->where("app.id_pregunta", $id_pregunta);
		}
		$result = $this->db->get();
		
		if($result->num_rows() > 0){
			return ($id_pregunta == null) ? $result->result_array() : $result->row_array();
		}
		else{
			return false;
		}
	}

	// Get the questions listing that will be exported
	function get_preguntas_exportar($ids){
		$this->db->from("preguntas_prueba pp");
		$this->db->where_in("id_pregunta_prueba", $ids);
		$this->db->where("pp.estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	// Get the questions listing that will be exported
	function get_preguntas_exportar_by_materia($id_materia){
		$this->db->from("preguntas_prueba pp");
		$this->db->where_in("id_materia", $id_materia);
		$this->db->where("pp.estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_count(){
		$this->db->select("COUNT(pp.id_pregunta_prueba) as cantidad_preguntas");
		$this->db->from("preguntas_prueba pp");
		$this->db->where("pp.estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_count_by_materias($ids_materias){
		$this->db->select("COUNT(pp.id_pregunta_prueba) as cantidad_preguntas");
		$this->db->from("preguntas_prueba pp");
		$this->db->where_in("pp.id_materia", $ids_materias);
		$this->db->where("pp.estado", 1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_cantidad_pruebas($id_pregunta){
		$this->db->from("pruebas");
		$this->db->like("materias", '"'.$id_pregunta.'"');
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_cantidad_correctas_incorrectas($id_pregunta, $tipo_respuesta = 1){
		$this->db->from("respuestas_realizar_prueba rrp");
		$this->db->join("respuestas_preguntas_pruebas rpp", "rrp.id_respuesta = id_respuesta_pregunta_prueba");
		$this->db->where("rrp.id_pregunta", $id_pregunta);
		$this->db->where("rpp.tipo_respuesta", $tipo_respuesta);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_cantidad_correctas_incorrectas_by_materia($id_materia, $tipo_respuesta = 1, $alcance = "all"){
		$this->db->from("preguntas_prueba pp");
		$this->db->join("respuestas_realizar_prueba rrp", "rrp.id_pregunta = pp.id_pregunta_prueba");
		$this->db->join("respuestas_preguntas_pruebas rpp", "rrp.id_respuesta = id_respuesta_pregunta_prueba");
		$this->db->join("realizar_prueba rp", "rrp.id_realizar_prueba = rp.id_realizar_prueba");
		$this->db->join("pruebas p", "rp.id_prueba = p.id_prueba");
		$this->db->where("pp.id_materia", $id_materia);
		$this->db->where("rpp.tipo_respuesta", $tipo_respuesta);
		$this->db->where("pp.estado", 1);
		if($alcance != "all"){
			$this->db->where("p.alcance_prueba", $alcance);
		}
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}
}