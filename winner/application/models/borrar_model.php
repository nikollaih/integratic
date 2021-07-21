<?php

class Borrar_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function bo_inscrito($id,$con) {        
        $result=$this->db->query("Delete from inscritos where documento=$id and concurso=$con");
    }
}
