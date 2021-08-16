<?php
class Foro_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

    // Get all the topics listing
	function get_all($materia, $grupo){
		$this->db->from("foros");
        $this->db->where("grupo", $grupo);
        $this->db->where("materia", $materia);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function get($id_foro = null, $materia = null, $grado = null){
        $this->db->from("foros f");
        $this->db->join("usuarios u", "f.created_by = u.id");
        $this->db->where("f.id_foro", $id_foro);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    function add($data){
        $this->db->inser("foros", $data);
        return $this->get($this->db->insert_id());
    }

    function update($data){
        $this->db->where("id_foro", $data["id_foro"]);
        $this->db->update("foros", $data);
        return $this->get($data["id_foro"]);
    }

    function add_answer($data){
        return $this->db->insert("respuestas_foro", $data);
    }

    function get_answers($id_foro){
        $this->db->from("respuestas_foro f");
        $this->db->join("usuarios u", "f.created_by = u.id");
        $this->db->where("f.id_foro", $id_foro);
        $this->db->order_by("f.created_at", "desc");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}