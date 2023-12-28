<?php
class Cursos_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function create($data){
        $this->db->insert("cursos", $data);
        return $this->db->insert_id();
    }

    function update($data){
        $this->db->where("id_curso", $data["id_curso"]);
        return $this->db->update("cursos", $data);
    }

    function find($idCurso){
        $this->db->from("cursos c");
        $this->db->join("usuarios u", "u.id = c.created_by");
        $this->db->where("c.id_curso", $idCurso);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    function get_all(){
        $this->db->from("cursos c");
        $this->db->join("usuarios u", "u.id = c.created_by");
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function get_by_grado($grado){
        $this->db->from("cursos c");
        $this->db->join("usuarios u", "u.id = c.created_by");
        $this->db->like("c.grados", $grado);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function delete($idCurso){
        $this->db->where("id_curso", $idCurso);
        return $this->db->delete("cursos");
    }
}
