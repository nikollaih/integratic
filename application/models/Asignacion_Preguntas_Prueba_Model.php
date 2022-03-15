<?php
class Asignacion_Preguntas_Prueba_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get_all($id_prueba){
		$this->db->from("asignacion_preguntas_prueba app");
        $this->db->join("preguntas_prueba pp", "pp.id_pregunta_prueba = app.id_pregunta");
		$this->db->where("app.id_prueba", $id_prueba);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function create($data){
        return $this->db->insert_batch("asignacion_preguntas_prueba", $data);
    }

	function delete($id_asignacion_pregunta_prueba){
		$this->db->where("id_asignacion_pregunta_prueba", $id_asignacion_pregunta_prueba);
		return $this->db->delete("asignacion_preguntas_prueba");
	}
}