<?php
class Visor_Model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }  
  public function con_ordenes(){
    $result=$this->db->query("Select * From pro_orden, cfg_cliente where ord_estado<>'fi' And ord_cliente=cli_nit Order By ord_numero");
    if(!$result) {return false;}
    else {return $result->result();}
  } 
  public function con_rec($dato){
    $sql="Select * From pro_orden "
            . "Where ord_numero='$dato'";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }  
  public function con_plan($dato){
    $sql="Select * From pro_orden, pro_plancha "
            . "Where ord_numero='$dato' And ord_numero=pla_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }
  public function con_corte($dato){
    $sql="Select * From pro_orden, pro_corte,cfg_tpapel,cfg_cortes,cfg_origen_papel "
            ."Where ord_numero='$dato' And ord_numero=cor_orden "
            ."And tp_codigo=cor_tpapel And tc_codigo=cor_tamcorte "
            ."And op_codigo=cor_cli_papel";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }  
  public function con_lito($dato){
    $sql="Select * From pro_orden, pro_litografia "
            . "Where ord_numero='$dato' And ord_numero=lito_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
   public function con_ani($dato){
    $sql="Select * From pro_orden, pro_anillado "
            . "Where ord_numero='$dato' And ord_numero=ani_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }
  public function con_bri($dato){
    $sql="Select * From pro_orden, pro_brillo "
            . "Where ord_numero='$dato' And ord_numero=bri_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }
  public function con_ensa($dato){
    $sql="Select * From pro_orden, pro_ensanduchado "
            . "Where ord_numero='$dato' And ord_numero=ensa_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_esta($dato){
    $sql="Select * From pro_orden, pro_estampado "
            . "Where ord_numero='$dato' And ord_numero=esta_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_gra($dato){
    $sql="Select * From pro_orden, pro_grapado "
            . "Where ord_numero='$dato' And ord_numero=gra_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_inter($dato){
    $sql="Select * From pro_orden, pro_intercalado "
            . "Where ord_numero='$dato' And ord_numero=inter_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  } 
  public function con_pega($dato){
    $sql="Select * From pro_orden, pro_pegado "
            . "Where ord_numero='$dato' And ord_numero=pega_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  } 
  public function con_ple($dato){
    $sql="Select * From pro_orden, pro_plegado "
            . "Where ord_numero='$dato' And ord_numero=ple_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  } 
  public function con_plas($dato){
    $sql="Select * From pro_orden, pro_plastificado "
            . "Where ord_numero='$dato' And ord_numero=plas_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_rep($dato){
    $sql="Select * From pro_orden, pro_repujado "
            . "Where ord_numero='$dato' And ord_numero=rep_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_tro($dato){
    $sql="Select * From pro_orden, pro_troquelado "
            . "Where ord_numero='$dato' And ord_numero=tro_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_etro($dato){
    $sql="Select * From pro_orden, pro_etroquel "
            . "Where ord_numero='$dato' And ord_numero=etr_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_esp($dato){
    $sql="Select * From pro_orden, pro_especial "
            . "Where ord_numero='$dato' And ord_numero=esp_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_laser($dato){
    $sql="Select * From pro_orden, pro_laser "
            . "Where ord_numero='$dato' And ord_numero=laser_orden";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }   
  public function con_nombre($dato){
    $sql="Select * From vw_ordener_visor Where orden='$dato'";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  } 
  public function inicia_pro($dato){
    $sql="Update pro_orden Set ord_estado='ac' Where ord_numero='$dato'";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return true;}
  }  
  public function consulta_orden($dato){
    $sql="Select * from vw_ordenes Where orden='$dato'";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return true;}
  }  
  public function consulta_orden_pla($dato){
    $sql="Select * from pro_plancha Where pla_orden='$dato'";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }
  public function consulta_orden_cor($dato){
    $sql="Select * from pro_corte Where cor_orden='$dato'";
    $result=$this->db->query($sql);    
    if(!$result) {return false;}
    else {return $result->result();}
  }  
  public function asigna_operario($tipo,$orden,$num,$op){
      switch($tipo){
          case 'pla':   $sql="Update pro_plancha Set pla_estado='pe',pla_operario='$op' Where pla_orden='$orden' and pla_secuencia='$num'"; break;
          case 'cor':   $sql="Update pro_corte Set cor_estado='pe',cor_operario='$op' Where cor_orden='$orden' and cor_secuencia='$num'"; break;
          case 'lito':  $sql="Update pro_litografia Set lito_estado='pe',lito_operario='$op' Where lito_orden='$orden' and lito_secuencia='$num'"; break;
          case 'ani':   $sql="Update pro_anillado Set ani_estado='pe',ani_operario='$op' Where ani_orden='$orden' and ani_secuencia='$num'"; break;
          case 'bri':   $sql="Update pro_brillo Set bri_estado='pe',bri_operario='$op' Where bri_orden='$orden' and bri_secuencia='$num'"; break;
          case 'ensa':  $sql="Update pro_ensanduchado Set ensa_estado='pe',ensa_operario='$op' Where ensa_orden='$orden' and ensa_secuencia='$num'"; break;
          case 'esta':  $sql="Update pro_estampado Set esta_estado='pe',esta_operario='$op' Where esta_orden='$orden' and esta_secuencia='$num'"; break;
          case 'gra':   $sql="Update pro_grapado Set gra_estado='pe',gra_operario='$op' Where gra_orden='$orden' and gra_secuencia='$num'"; break;
          case 'inter': $sql="Update pro_intercalado Set inter_estado='pe',inter_operario='$op' Where inter_orden='$orden' and inter_secuencia='$num'"; break;
          case 'pega':  $sql="Update pro_pegado Set pega_estado='pe',pega_operario='$op' Where pega_orden='$orden' and pega_secuencia='$num'"; break;
          case 'ple':   $sql="Update pro_plegado Set ple_estado='pe',ple_operario='$op' Where ple_orden='$orden' and ple_secuencia='$num'"; break;
          case 'plas':  $sql="Update pro_plastificado Set plas_estado='pe',plas_operario='$op' Where plas_orden='$orden' and plas_secuencia='$num'"; break;
          case 'rep':   $sql="Update pro_repujado Set rep_estado='pe',rep_operario='$op' Where rep_orden='$orden' and rep_secuencia='$num'"; break;
          case 'tro':   $sql="Update pro_troquelado Set tro_estado='pe',tro_operario='$op' Where tro_orden='$orden' and tro_secuencia='$num'"; break;
          case 'etr':   $sql="Update pro_etroquel Set etr_estado='pe',etr_operario='$op' Where etr_orden='$orden' and etr_secuencia='$num'"; break;
          case 'esp':   $sql="Update pro_especial Set esp_estado='pe',esp_operario='$op' Where esp_orden='$orden' and esp_secuencia='$num'"; break;
          case 'laser': $sql="Update pro_laser Set laser_estado='pe',laser_operario='$op' Where laser_orden='$orden' and laser_secuencia='$num'"; break;
      }
        $result=$this->db->query($sql);    
        if(!$result) {return false;}
        else {return true;}
  }
  public function priorizar_orden($orden,$op){
        $query="Update pro_plancha Set pla_prioridad='$op' Where pla_orden=$orden";
        $result=$this->db->query($query);
        $query="Update pro_corte Set cor_prioridad='$op' Where cor_orden=$orden";
        $result=$this->db->query($query);        
        $query="Update pro_litografia Set lito_prioridad='$op' Where lito_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_anillado Set ani_prioridad='$op' Where ani_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_brillo Set bri_prioridad='$op' Where bri_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_ensanduchado Set ensa_prioridad='$op' Where ensa_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_estampado Set esta_prioridad='$op' Where esta_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_grapado Set gra_prioridad='$op' Where gra_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_intercalado Set inter_prioridad='$op' Where inter_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_pegado Set pega_prioridad='$op' Where pega_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_plegado Set ple_prioridad='$op' Where ple_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_plastificado Set plas_prioridad='$op' Where plas_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_repujado Set rep_prioridad='$op' Where rep_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_troquelado Set tro_prioridad='$op' Where tro_orden=$orden";
        $result+=$this->db->query($query);
        $query="Update pro_laser Set laser_prioridad='$op' Where laser_orden=$orden";     
        $result+=$this->db->query($query);
        return $result;  
  }   
}