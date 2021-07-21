<?php

class Cargar_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function llena_select($tabla) {        
        $result = $this->db->get($tabla);
        if (!$result) {
            return false;
        } else {
            return $result->result();
        }
    }
  
}
