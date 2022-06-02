<?php
class General_Model extends CI_Model { 
 
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
  public function bo_asg($id,$mat,$gru){
    $result=$this->db->query("delete from asg_materias Where docente='$id' And materia='$mat' And grupo='$gru'");
    if(!$result) {return false;}
    else {return $result;}      
  } 
  public function val_asg($mat,$gru){
    $result=$this->db->query("Select * from asg_materias Where materia='$mat' And grupo='$gru'");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function bo_asgpro($id,$pro){
    $result=$this->db->query("delete from asg_proyectos Where docente='$id' And proyecto='$pro'");
    if(!$result) {return false;}
    else {return $result;}      
  }  
  public function bo_asgproc($id,$pro){
    $result=$this->db->query("delete from asg_procesos Where docente='$id' And proceso='$pro'");
    if(!$result) {return false;}
    else {return $result;}      
  }   
  public function co_docente(){
    $result=$this->db->query("select * from usuarios Where estado='ac'");
    if(!$result) {return false;}
    else {return $result->row();}      
  }
  public function nom_docente($id){
    $result=$this->db->query("select * from usuarios Where id='$id'");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function co_nomarea($id){
    $result=$this->db->query("select nomarea from cfg_areas Where codarea='$id'");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
  public function cop_materia($id){
    $result=$this->db->query("select * from cfg_areas,cfg_materias Where codmateria=$id And codarea=area");
    if(!$result) {return false;}
    else {return $result->result();}      
  }      
}
