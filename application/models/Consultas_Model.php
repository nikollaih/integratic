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
      if($result->row_array()){$this->registrar_ingreso($result->row_array()["id"]); }
      return $result->row_array();
    }      
  }

  public function registrar_ingreso($user_id){
    $date = date_create();
    $fecha = date_format($date, 'Y-m-d H:i:s');
    $hora= date_format($date, 'H:i:s');
    $this->db->query("INSERT INTO ingresos (documento, fecha, hora) VALUES('$user_id','$fecha','$hora')");
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

    public function get_materias_diff_ids($ids){
    	$this->db->from("cfg_materias cm");
    	$this->db->order_by("cm.nommateria");
      $this->db->where_in("cm.codmateria", $ids);
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

    public function allGrupos(){
        $result=$this->db->query("select distinct grado,grupo from asg_materias,cfg_materias Where codmateria=materia");
        if(!$result) {return false;}
        else {return $result->result_array();}
    }

    public function allDistinctGrupos($userID = null)
    {
        $this->db->distinct();
        $this->db->select('grupo');
        $this->db->from('asg_materias');
        $this->db->join('cfg_materias', 'codmateria = materia', 'inner');

        if (!is_null($userID)) {
            $this->db->where('docente', $userID);
        }

        $query = $this->db->get();

        if (!$query) {
            return false;
        }

        return $query->result_array();
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
    $result=$this->db->query("select * from cfg_materias cm JOIN cfg_areas ca ON cm.area = ca.codarea ORDER BY nommateria ASC");
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
    return $result->result();
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
  public function lisusuario($rol = "Docente"){
    $result=$this->db->query("select * from usuarios where estado='ac' And rol = '".$rol."' Order By nombres,apellidos");
    if(!$result) {return false;}
    else {return $result->result();}      
  } 
  public function con_areas(){
    $result=$this->db->query("Select * from cfg_areas where tipo<>'gestion'");
    if(!$result) {return false;}
    else {return $result->result();}      
  }  
  public function con_docentes($filter){
    if($filter == null)
    $result=$this->db->query("select * from usuarios where estado='ac' And rol = 'docente' Order By nombres,apellidos");
    else
    $result=$this->db->query("select * from usuarios where estado='ac' And rol != 'estudiante' Order By nombres,apellidos");
    if(!$result) {return false;}
    else {return $result->result();}      
  } 
  public function con_nodocentes(){
    $result=$this->db->query("select * from usuarios where estado='ac' And rol != 'Docente' AND rol != 'Estudiante' Order By nombres,apellidos");
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
    $result=$this->db->query("Select u.nombres, u.apellidos, am.*, cm.*, ca.* from asg_materias am join cfg_materias cm on am.materia = cm.codmateria join cfg_areas ca on cm.area = ca.codarea join usuarios u on u.id = am.docente where materia='".$mat."' and codarea=area and codmateria=materia and u.id = '".logged_user()['id']."'");
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

  /**
   * Get all the rows from the table 'ingresos' where the column 'fecha' is equal to the value of the
   * variable .
   * 
   * @param fecha is the date that I want to search in the database
   * 
   * @return An array of arrays.
   */
  public function ingresos($fecha){
    $this->db->from("ingresos i");
    $this->db->join("estudiante e", "i.documento = e.documento");
    $this->db->where("i.fecha", $fecha);
    $result = $this->db->get();
    return ($result->num_rows() > 0) ? $result->result_array() : false;
  }

  public function getRoles(){
      $this->db->select("DISTINCT(rol)");
      $this->db->from("usuarios");
      $result = $this->db->get();
      return ($result->num_rows() > 0) ? $result->result_array() : false;
  }
}
