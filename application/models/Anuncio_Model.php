<?php
class Anuncio_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	 // Get the announcements for a particular group
	function get_all($materia, $grupo){
		$this->db->from("anuncios a");
		$this->db->join("usuarios u", "a.created_by = u.id");
        $this->db->where("a.grupo", $grupo);
        $this->db->where("a.materia", $materia);
		$this->db->order_by("a.created_at", "desc");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	 // Get the announcements for a particular group
	 function get($id_anuncio){
		$this->db->from("anuncios a");
		$this->db->join("usuarios u", "a.created_by = u.id");
        $this->db->where("a.id_anuncio", $id_anuncio);
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	// Create a nrew announcement
	function create($data){
		$this->db->insert("anuncios", $data);
		return $this->db->insert_id(); 
	}

	function delete($id_anuncio){
		$this->db->where("id_anuncio", $id_anuncio);
		return $this->db->delete("anuncios");
	}
}