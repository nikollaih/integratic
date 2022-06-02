<?php  
class Asigna_Model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
    $this->load->database(); 
  }
  public function bo_asg($id,$mat){
    $result=$this->db->query("delete from asg_materias Where docente='$id' And codmateria='$mat'");
    if(!$result) {return false;}
    else {return $result->result();}      
  }     
} 
