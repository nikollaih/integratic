<?php
class Tablero_Model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }
 
  public function llena_select($tabla){
    $result=$this->db->get($tabla);
    if(!$result) {return false;}
    else {return $result->result();}
  }
   public function num_ordenes(){
    $result=$this->db->query("Select count(*) as numordenes From vw_ordenes");
    if(!$result) {return false;}
    else {return $result->result();}
  } 
  public function con_ordenes(){
    $result=$this->db->query("Select * From vw_ordenes Order By orden");
    if(!$result) {return false;}
    else {return $result->result();}
  }
  public function con_avance($orden,$sec){
    $result=$this->db->query("Select sum(pro_avance) as avance From pro_avances where pro_orden='$orden' And pro_secuencia='$sec'");
    if(!$result) {return false;}
    else {return $result->result();}
  }  
}