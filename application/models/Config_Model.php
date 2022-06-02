<?php
class Config_Model extends CI_Model {
 
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
  public function bo_asg($id,$mat){
    $result=$this->db->query("delete from asg_materias Where docente='$id' And materia='$mat'");
    if(!$result) {return false;}
    else {return $result;}      
  }  
  public function co_docente(){
    $result=$this->db->query("select * from usuarios Where estado='ac'");
    if(!$result) {return false;}
    else {return $result->row();}      
  } 
public function bo_area($id){
    $this->db->where('codarea', $id);
    $this->db->delete('cfg_areas');    
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }  
public function bo_materia($id){
    $this->db->where('codmateria', $id);
    $this->db->delete('cfg_materias');
    $this->db->where('materia', $id);
    $this->db->delete('asg_materias');    
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }   
public function bo_proyecto($id){
    $this->db->where('codpro', $id);
    $this->db->delete('cfg_proyectos');
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }  
public function bo_proceso($id){
    $this->db->where('codpro', $id);
    $this->db->delete('cfg_procesos');
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }   
public function bo_usr($id){
    $this->db->where('id', $id);
    $this->db->delete('usuarios');
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }   
public function bo_menuad($id){
    $this->db->where('id', $id);
    $this->db->delete('cfg_menuad');
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }    
public function up_area($cod,$nom,$ico,$fecha){
    if($ico!=''){
        $result=$this->db->query("Update cfg_areas Set nomarea='$nom',icoarea='$ico',fecha='$fecha' Where codarea=$cod");
    } else{
        $result=$this->db->query("Update cfg_areas Set nomarea='$nom',fecha='$fecha' Where codarea=$cod");
    }    
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }    
public function up_materia($cod,$nom,$gra,$ico,$fecha){
    if($ico!=''){
        $result=$this->db->query("Update cfg_materias Set nommateria='$nom',grado='$gra',icomateria='$ico',fecha='$fecha' Where codmateria=$cod");
    }else{
        $result=$this->db->query("Update cfg_materias Set nommateria='$nom',grado='$gra',fecha='$fecha' Where codmateria=$cod");
    }
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }  
public function up_proyecto($cod,$nom,$ico){
    if($ico!=''){
        $result=$this->db->query("Update cfg_proyectos Set nomproyecto='$nom',icono='$ico' Where codpro=$cod");
    }else{
        $result=$this->db->query("Update cfg_proyectos Set nomproyecto='$nom' Where codpro=$cod");
    }
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }   
public function up_proceso($cod,$nom,$ico){
    if($ico!=''){
        $result=$this->db->query("Update cfg_procesos Set nomproceso='$nom',icono='$ico' Where codpro=$cod");
    }else{
        $result=$this->db->query("Update cfg_procesos Set nomproceso='$nom' Where codpro=$cod");
    }
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }  
public function up_usuario($cod,$nom,$ape,$car,$rol,$cel,$usr,$pas){
    $sql="Update usuarios Set  nombres='$nom',apellidos='$ape',cargo='$car',rol='$rol',nocel='$cel',usuario='$usr',clave='$pas' Where id=$cod";
    $this->db->query($sql);
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  } 
public function up_menu($cod,$nom,$ord,$tipo,$link,$ico){
    if($ico!=''){
        $result=$this->db->query("Update cfg_menuad Set nombre='$nom',orden=$ord,tipo='$tipo',enlace='$link',icono='$ico' Where id=$cod");
    }else{
        $result=$this->db->query("Update cfg_menuad Set nombre='$nom',orden=$ord,tipo='$tipo',enlace='$link' Where id=$cod");
    }
    if ($this->db->affected_rows() > 0) {
            return true;     }
    else{   return false;    }  
  }   

 	public function con_menu($logged = false){
		$where_query = ($logged) ? "" : "WHERE cm.id != 1";
    	$result = $this->db->query("SELECT * FROM cfg_menu cm ".$where_query);
    	return (!$result) ? false :  $result->result();  
  	}  
	public function con_menupri_fil($areas){
    	$result=$this->db->query("select * from cfg_menu where areas like '%$areas%' union all select * from cfg_menuad where areas like '%$areas%'");
    	if(!$result) {return false;}
    	else {return $result->result();}      
  	}    
}
