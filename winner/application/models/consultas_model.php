<?php
class Consultas_Model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }  
  public function con_municipios(){
    $result=$this->db->query("Select * From municipios");
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_usuarios(){
    $result=$this->db->query("Select * From usuario");
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_barrio($dato){
    $result=$this->db->query("Select * From barrios where id='$dato'");
    if(!$result) {return false;}
    else {return $result->result();}
  }  
  public function con_barrios($dato){
    $result=$this->db->query("Select * From barrios where municipio='$dato'");
    if(!$result) {return false;}
    else {return $result->result();}
  }  
  public function con_persona($id){
    $result=$this->db->query("Select * From persona Where documento='$id'");
    if(!$result) {return false;}
    else {return $result->result();}
  }  
  public function con_concurso($id){
    $result=$this->db->query("Select * From concurso Where id='$id'");
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function concursoac(){
    $result=$this->db->query("Select * From concurso Where estado='ac'");
    if(!$result) {return false;}
    else {return $result->result();}
  } 
  public function con_inscrito($id){
    $result=$this->db->query("select * from inscritos,concurso where concurso.id=inscritos.concurso and documento='$id'");
    if(!$result) {return false;}
    else {return $result->result();}
  }  
  public function con_posibles($con){
    $result=$this->db->query("select * from persona,barrios where barrios.id=barrio and not exists (select documento from ganadores where ganadores.documento=persona.documento) and '$con'");
    if(!$result) {return false;}
    else {return $result->result();}
  }
  public function con_ganador($com,$est,$gen,$mun,$bar,$loc,$eda,$ocom,$oest,$ogen,$omun,$obar,$oloc,$oeda,$pcom,$pest,$pgen,$pmun,$pbar,$ploc,$peda){
    switch ($ocom) {
      case 'IG': $ocom="=";  break;
      case 'DI': $ocom="<>"; break;
      case 'MA': $ocom=">";  break;
      case 'ME': $ocom="<";  break;
    }
    switch ($oest) {
      case 'IG': $oest="=";  break;
      case 'DI': $oest="<>"; break;
      case 'MA': $oest=">";  break;
      case 'ME': $oest="<";  break;
    }    
    switch ($ogen) {
      case 'IG': $ogen="=";  break;
      case 'DI': $ogen="<>"; break;
      case 'MA': $ogen=">";  break;
      case 'ME': $ogen="<";  break;
    }    
    switch ($omun) {
      case 'IG': $omun="=";  break;
      case 'DI': $omun="<>"; break;
      case 'MA': $omun=">";  break;
      case 'ME': $omun="<";  break;
    }
    switch ($obar) {
      case 'IG': $obar="=";  break;
      case 'DI': $obar="<>"; break;
      case 'MA': $obar=">";  break;
      case 'ME': $obar="<";  break;
    }
    switch ($oloc) {
      case 'IG': $oloc="=";  break;
      case 'DI': $oloc="<>"; break;
      case 'MA': $oloc=">";  break;
      case 'ME': $oloc="<";  break;
    }    
    switch ($oeda) {
      case 'IG': $oeda="=";  break;
      case 'DI': $oeda="<>"; break;
      case 'MA': $oeda=">";  break;
      case 'ME': $oeda="<";  break;
    }    
    if($com==="S"){$com="comuna";}
    if($est==="S"){$est="estrato";}
    if($gen==="S"){$gen="genero";}
    if($mun==="S"){$mun="municipio";}
    if($bar==="S"){$bar="barrio";}
    if($loc==="S"){$loc="locutor";}
    if($eda==="S"){$eda="edad";}
    $where="N";
    $sql="Select * from gpersona ";
    if($est==='estrato')  {$this->db->where($est.$oest,$pest);}   
    if($gen==='genero')   {$this->db->where($gen.$ogen,$pgen);}    
    if($gen==='municipio'){$this->db->where($mun.$omun,$pmun);}    
    if($com==='comuna')   {$this->db->where($com.$ocom,$pcom);}     
    if($bar==='barrio')   {$this->db->where($bar.$obar,$pbar);}       
    $result = $this->db->get("gpersona");
    if(!$result) {return false;}
    else {return $result->result();}
  }         
}