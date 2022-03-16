<?php
class Consultas_Model extends CI_Model { 
 
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }
  public function login($usr,$pass){
    $result=$this->db->query("Select * From usuarios where usuario='$usr' And clave='$pass'");
    if(!$result){return false;}
    else{
      if($result->row_array()){$this->registrar_ingreso($usr); }
      return $result->row_array();
    }      
  }

  public function registrar_ingreso($user_id){
    $date = date_create();
    $fecha= date_format($date, 'Y-m-d H:i:s');
    $hora= date_format($date, 'H:i:s');
    $f=$this->db->query("INSERT INTO ingresos VALUES(0,'$user_id','$fecha','$hora')");
  }

  public function login_estudiante($usr){
    date_default_timezone_set('america/bogota');
    if($usr){$result=$this->db->query("Select * From estudiante where documento='$usr'");}
    if(!$result) {return false;}
    else {
      if($result->row_array()){$this->registrar_ingreso($usr); }
      return $result->result();}      
  } 
  
  	public function get_materias_diff(){
    	$this->db->from("cfg_materias");
    	$this->db->order_by("nommateria");
    	$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
  	}

	public function get_materia($codmateria){
    	$this->db->from("cfg_materias");
    	$this->db->where("codmateria", $codmateria);
    	$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
  	}

  public function nom_docente($id){
    $result=$this->db->query("Select * From usuarios where id='$id'");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function asignacion($id){
    $result=$this->db->query("select distinct codmateria,nomarea,nommateria,grado,icomateria from asg_materias,cfg_materias,cfg_areas Where docente='$id' And codmateria=materia And codarea=area");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
  public function asigna_procesos($id){
    $result=$this->db->query("select distinct codpro,nomproceso,icono from asg_procesos,cfg_procesos Where docente='$id' And codpro=proceso");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
  public function grupos(){
    $result=$this->db->query("select distinct grado,grupo from asg_materias,cfg_materias Where codmateria=materia");
    if(!$result) {return false;}
    else {return $result->result();}      
  }    
  public function asignadoc($id){
    $result=$this->db->query("select codmateria,nomarea,nommateria,grado,grupo from asg_materias,cfg_materias,cfg_areas Where docente='$id' And codmateria=materia And codarea=area");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
  public function asignapro($id){
    $result=$this->db->query("select codpro,nomproyecto from asg_proyectos,cfg_proyectos Where docente='$id' And codpro=proyecto");
    if(!$result) {return false;}
    else {return $result->result();}      
  }    
  public function asignaproc($id){
    $result=$this->db->query("select codpro,nomproceso from asg_procesos,cfg_procesos Where docente='$id' And codpro=proceso");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function tmaterias(){
    $result=$this->db->query("select * from cfg_materias");
    if(!$result) {return false;}
    else {return $result->result();}      
  }    
    public function proyectos($id){
    $result=$this->db->query("select * from asg_proyectos,cfg_proyectos Where docente = '$id' And codpro=proyecto");
    if(!$result) {return false;}
    else {return $result->result();}      
  }
    public function planeacion(){
    $result=$this->db->query("select * from cfg_menu_planea");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
    public function tproyectos(){
    $result=$this->db->query("select * from cfg_proyectos");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
    public function tprocesos(){
    $result=$this->db->query("select * from cfg_procesos");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function materias(){
   $result=$this->db->query("select * from cfg_materias Order By nommateria");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
    public function mat_area($area){
   $result=$this->db->query("select * from cfg_materias Where area=$area");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
  public function materias_grupo($gra){
   $result=$this->db->query("select * from cfg_materias Where grado='$gra' Order By nommateria");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function info_materia($mat){
    $result=$this->db->query("select * from cfg_materias where codmateria='$mat'");
    if(!$result) {return false;}
    else {return $result->row();}      
  }    
  public function lisusuario(){
    $result=$this->db->query("select * from usuarios where estado='ac' And rol<>'super' Order By nombres,apellidos");
    if(!$result) {return false;}
    else {return $result->result();}      
  } 
  public function con_areas(){
    $result=$this->db->query("Select * from cfg_areas where tipo<>'gestion'");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
  public function con_docentes(){
    $result=$this->db->query("select * from usuarios where estado='ac' And rol<>'super' Order By nombres,apellidos");
    if(!$result) {return false;}
    else {return $result->result();}      
  } 
  public function con_nodocentes(){
    $result=$this->db->query("select * from usuarios where estado='ac' And rol <>'Docente' Order By nombres,apellidos");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function con_materias($area){
    $result=$this->db->query("Select * from cfg_materias,cfg_areas where area=$area and codarea=area");
    if(!$result) {return false;}
    else {return $result->result();}      
  }    
  public function con_materia($mat){
    $result=$this->db->query("Select * from cfg_materias,cfg_areas where codarea=area and codmateria=$mat");
    if(!$result) {return false;}
    else {return $result->result();}      
  }    
  public function con_usuario($usr){
    $result=$this->db->query("Select * from usuarios where id=$usr");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function con_proyecto($pro){
    $result=$this->db->query("Select * from cfg_proyectos where codpro=$pro");
    if(!$result) {return false;}
    else {return $result->result();}      
  }     
  public function con_proceso($pro){
    $result=$this->db->query("Select * from cfg_procesos where codpro=$pro");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
    public function conp_areas($cod){
    $result=$this->db->query("Select * from cfg_areas where codarea=$cod");
    if(!$result) {return false;}
    else {return $result->result();}      
  } 
  public function conp_materias($mat,$doc){
    $result=$this->db->query("Select * from asg_materias,cfg_materias,cfg_areas where materia=$mat and docente like '$doc' and codarea=area and codmateria=materia");
    if(!$result) {return false;}
    else {return $result->result();}      
  }   
  public function conp_materias_gen($mat){
    $result=$this->db->query("Select * from asg_materias,cfg_materias,cfg_areas where materia=$mat and codarea=area and codmateria=materia");
    if(!$result) {return false;}
    else {return $result->result();}      
  }      
    public function con_menuad(){
    $result=$this->db->query("Select * from cfg_menuad Order By orden");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
    public function consu_menuad($id){
    $result=$this->db->query("Select * from cfg_menuad where id='$id'");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
  public function ingresos($fecha){
    $result=$this->db->query("Select grado,ingresos.documento,nombre,hora From ingresos,estudiante 
where fecha='$fecha' and estudiante.documento=ingresos.documento order by grado,nombre,hora");
    if(!$result) {return false;}
    else {return $result->result();}      
  }    
}