<?php
class Asignacion_Participantes_Prueba_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get_all($id_prueba){
		$this->db->from("core_participantes_pruebas cpp");
        $this->db->join("asignacion_participantes_prueba pp", "pp.id_participante = cpp.id_participante_prueba");
		$this->db->where("pp.id_prueba", $id_prueba);
		$this->db->group_by("cpp.id_participante_prueba");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get($id_prueba, $id_participante){
		$this->db->from("core_participantes_pruebas cpp");
        $this->db->join("asignacion_participantes_prueba pp", "pp.id_participante = cpp.id_participante_prueba");
		$this->db->where("pp.id_prueba", $id_prueba);
		$this->db->where("pp.id_participante", $id_participante);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_participante($id_participante){
		$this->db->from("core_participantes_pruebas cpp");
		$this->db->where("cpp.id_participante_prueba", $id_participante);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

    function create($data){
        return $this->db->insert("asignacion_participantes_prueba", $data);
    }

	function update($data){
		$this->db->where("identificacion", $data["identificacion"]);
        return $this->db->update("asignacion_participantes_prueba", $data);
    }

	function delete($id_prueba, $id_participante){
		$this->db->where("id_participante", $id_participante);
		$this->db->where("id_prueba", $id_prueba);
		return $this->db->delete("asignacion_participantes_prueba");
	}
}