<?php
class Usuarios_Model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function login($usr,$pass){
    $result=$this->db->query("Select * From usuarios where usuario='$usr' And clave='$pass' ");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
}