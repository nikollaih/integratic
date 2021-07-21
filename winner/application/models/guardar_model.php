<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardar_Model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

public function insertar($tabla,$data){
    $this->db->insert($tabla,$data);
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }   
}
  public function sql($sql){
    $result=$this->db->query($sql);
    if(!$result) {return 0;}
    else {return 1;}
  }
}