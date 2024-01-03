<?php
class Archivos_Curso_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function create($data){
        $this->db->insert("archivos_curso", $data);
        return $this->db->insert_id();
    }

    function update($data){
        $this->db->where("id_archivo_curso", $data["id_archivo_curso"]);
        return $this->db->update("archivos_curso", $data);
    }

    function find($idArchivoCurso){
        $this->db->from("archivos_curso ac");
        $this->db->join("cursos c", "ac.id_curso = c.id_curso");
        $this->db->join("usuarios u", "u.id = c.created_by");
        $this->db->where("ac.id_archivo_curso", $idArchivoCurso);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    function get_all($idCurso){
        $this->db->from("archivos_curso ac");
        $this->db->join("cursos c", "ac.id_curso = c.id_curso");
        $this->db->join("usuarios u", "u.id = c.created_by");
        $this->db->where("c.id_curso", $idCurso);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function delete($idCurso){
        $this->db->where("id_archivo_curso", $idCurso);
        return $this->db->delete("archivos_curso");
    }
}
