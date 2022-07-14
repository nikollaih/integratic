<?php
  
   class Config extends CI_Controller {	
    public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form','url','html')); 
         $this->load->model('General_Model');
         $this->load->model('Config_Model');
         $this->load->model('Consultas_Model');
         $this->load->library('upload');
      }
    public function nuevoMenu(){

         if (!empty($_FILES['archivomenu']['name'])){
            $datos = array(
                "nombre"        => $this->input->post("nombremenu"),
                "nivel"         => '1',
                "nivel_sup"     => '1',
                "orden"         => $this->input->post("posicion"),
                "tipo"          => $this->input->post("tipoenlace"),
                "enlace"        => $this->input->post("enlace"),
                "areas"         => strtoupper($this->input->post("areas")),
                "descripcion"   => strtoupper($this->input->post("titulo")),
                "icono"         => $_FILES["archivomenu"]['name']
             );

            if($this->General_Model->insertar("cfg_menuad",$datos)==true){
                 echo json_encode("Creado Satisfactoriamente!");}
            else { echo ("No se pudo guardar los datos");} 
         }else { echo json_encode("Nada");}
    }
    public function nuevoArea(){
        date_default_timezone_set ('America/Bogota');
        $nom = $this->input->post("nomarea");
        $tipo = $this->input->post("tipo");
        $fecha = date('Y-m-d');


        if (!empty($_FILES['archivo']['name'])){
            $ico = $_FILES["archivo"]['name'];

            $datos = array(
                "nomarea"   => $nom,
                "tipo"      => 'areas',
                "icoarea"   => $ico,
                "fecha"     => $fecha
            );

            if($this->General_Model->insertar("cfg_areas",$datos)==true){
                $dir=utf8_decode('./principal/areas/'.$nom);
                if (!is_dir($dir)) { mkdir($dir, 0777); } 
                move_uploaded_file($_FILES['archivo']['tmp_name'], "img/botones/areas/".$_FILES['archivo']['name']);
                 echo json_encode("Area creada!");}
            else { echo ("No se pudo guardar los datos");} 
        }
        else {
            $ico = $this->input->post("icoarea");
            if($ico != null){
                $datos = array(
                    "nomarea"   => $nom,
                    "tipo"      => 'areas',
                    "icoarea"   => $ico,
                    "fecha"     => $fecha
                );

                if($this->General_Model->insertar("cfg_areas",$datos)==true){
                    echo json_encode("Area creada!");
                }
                else { 
                    echo ("No se pudo guardar los datos");
                } 
            }
            else{
                echo json_encode("Nada");
            }
        }
    }
    
    public function nuevoMateria(){
        date_default_timezone_set ('America/Bogota');
        $nom = $this->input->post("nommateria");
        $area = $this->input->post("areasmat");
        $grado = $this->input->post("grado");
        $fecha = date('Y-m-d');
        $ico = "";

        $datos = array(
            "area"          => $area,
            "nommateria"    => $nom,
            "grado"         => $grado,
            "icomateria"    => $ico,
            "fecha"         => $fecha
        );

        $nomarea=$this->General_Model->co_nomarea($area);
        foreach($nomarea as $row){
            $narea=$row->nomarea;
        }            
        if($this->General_Model->insertar("cfg_materias",$datos)==true){
            //$dir=utf8_decode('./principal/areas/'.$narea.'/'.$nom.$grado);
            $dir='./principal/areas/'.$narea;
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }

            $dir .= '/'.$nom.$grado;
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }
                echo json_encode("Asignatura creada!");
            }
        else { 
            echo ("No se pudo guardar los datos");
        } 
    } 

    public function nuevoProyecto(){
        date_default_timezone_set ('America/Bogota');
        $nom = $this->input->post("nomproyecto");

        if (!empty($_FILES['icopro']['name'])){
            $ico = $_FILES["icopro"]['name'];

            $datos = array(
                "nomproyecto" => $nom,
                "icono" => $ico,
            );

            if($this->General_Model->insertar("cfg_proyectos", $datos)==true){
                $dir=utf8_decode('./principal/proyectos/'.$nom);
                if (!is_dir($dir)) { 
                    mkdir($dir, 0777); 
                }
                move_uploaded_file($_FILES['icopro']['tmp_name'], "img/botones/proyectos/".$_FILES['icopro']['name']);
                echo "Proyecto creado!";
            }
            else { echo ("No se pudo guardar los datos");} 
        }
        else {
            $ico = $this->input->post("icoproyecto");
            if($ico != null){
                $datos = array(
                    "nomproyecto" => $nom,
                    "icono" => $ico,
                );

                if($this->General_Model->insertar("cfg_proyectos",$datos)==true){
                    echo "Proyecto creado!";
                }
                else { 
                    echo ("No se pudo guardar los datos");
                } 
            }
            else{
                echo json_encode("Nada");
            }
        }
    }    
    public function nuevoProceso(){
        date_default_timezone_set ('America/Bogota');
        $nom = $this->input->post("nomproc");

        if (!empty($_FILES['icoproc']['name'])){
            $ico = $_FILES["icoproc"]['name'];

            $datos = array(
                "nomproceso" => $nom,
                "icono" => $ico,
            );

            if($this->General_Model->insertar("cfg_procesos", $datos)==true){
                $dir=utf8_decode('./principal/procesos/'.$nom);
                if (!is_dir($dir)) { 
                    mkdir($dir, 0777); 
                }
                move_uploaded_file($_FILES['icoproc']['tmp_name'], "img/botones/procesos/".$_FILES['icoproc']['name']);
                echo "Proceso creado!";
            }
            else { echo ("No se pudo guardar los datos");} 
        }
        else {
            $ico = $this->input->post("icoproceso");
            if($ico != null){
                $datos = array(
                    "nomproceso" => $nom,
                    "icono" => $ico,
                );

                if($this->General_Model->insertar("cfg_procesos",$datos)==true){
                    echo "Proceso creado!";
                }
                else { 
                    echo ("No se pudo guardar los datos");
                } 
            }
            else{
                echo json_encode("Nada");
            }
        }
    }    
    
    
public function bo_area(){ 
$conta=0; 
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $mat=$this->Consultas_Model->mat_area($id); 
             foreach($mat as $row){$conta=1;} 
             if($conta==0){
                    $conn=$this->Config_Model->bo_area($id); 
                    echo json_encode('Area Borrada!');  
                }
             else{echo json_encode('NO Borrado! Verifique si existen materias'); }   
         }
         else{show_404();}
     }  
public function bo_materia(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->Config_Model->bo_materia($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     } 
public function bo_proyecto(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->Config_Model->bo_proyecto($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }     
public function bo_proceso(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->Config_Model->bo_proceso($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }      
public function bo_usr(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->Config_Model->bo_usr($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }      
public function bo_menuad(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->Config_Model->bo_menuad($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }      
public function up_area(){  
         if ($this->input->is_ajax_request()) {
            date_default_timezone_set ('America/Bogota'); 
            $cod        = $this->input->post("ucodarea");
            $nom        = $this->input->post("unomarea");
            $fecha      = date('Y-m-d');
            $ico        = $_FILES["uicoarea"]['name'];
            
          $this->Config_Model->up_area($cod,$nom,$ico,$fecha);
          echo json_encode($ico);
         }
         else{show_404();}       
     }    
public function up_materia(){  
         if ($this->input->is_ajax_request()) {
            date_default_timezone_set ('America/Bogota'); 
            $cod        = $this->input->post("ucodmat");
            $nom        = $this->input->post("unommat");
            $gra        = $this->input->post("ugramat");
            $fecha      = date('Y-m-d');
            $ico        = $_FILES["uicomat"]['name'];
            
          $this->Config_Model->up_materia($cod,$nom,$gra,$ico,$fecha);
          echo json_encode($ico);
         }
         else{show_404();}       
     }   
public function up_proyecto(){  
         if ($this->input->is_ajax_request()) {
            date_default_timezone_set ('America/Bogota'); 
            $cod        = $this->input->post("ucodigo");
            $nom        = $this->input->post("unombre");
            $ico        = $_FILES["uicono"]['name'];
            
          $this->Config_Model->up_proyecto($cod,$nom,$ico);
          echo json_encode($ico);
         }
         else{show_404();}        
     }   
public function up_proceso(){  
         if ($this->input->is_ajax_request()) {
            date_default_timezone_set ('America/Bogota'); 
            $cod        = $this->input->post("ucodigo");
            $nom        = $this->input->post("unombre");
            $ico        = $_FILES["uicono"]['name'];
            
          $this->Config_Model->up_proceso($cod,$nom,$ico);
          echo json_encode($ico);
         }
         else{show_404();}       
     }      
public function up_usuario(){  
         if ($this->input->is_ajax_request()) {
            date_default_timezone_set ('America/Bogota'); 
            $cod        = $this->input->post("ucod");
            $nom        = $this->input->post("unom");
            $ape        = $this->input->post("uape");
            $car        = $this->input->post("ucar");
            $rol        = $this->input->post("urol");
            $cel        = $this->input->post("ucel");
            $usr        = $this->input->post("uusr");
            $pas        = $this->input->post("upas");
          $this->Config_Model->up_usuario($cod,$nom,$ape,$car,$rol,$cel,$usr,$pas);
          echo json_encode($ico);
         }
         else{show_404();}       
     }  
public function up_menu(){  
         if ($this->input->is_ajax_request()) {
            date_default_timezone_set ('America/Bogota'); 
            $cod        = $this->input->post("uid");
            $nom        = $this->input->post("unombre");
            $ord        = $this->input->post("uorden");
            $tipo       = $this->input->post("utipo");
            $link       = $this->input->post("ulink");
            $ico        = $this->input->post("uicono");
          $this->Config_Model->up_menu($cod,$nom,$ord,$tipo,$link,$ico);
          echo json_encode($ico);
         }
         else{show_404();}       
     }      
     
    public function co_menu(){ 
        if ($this->input->is_ajax_request()) {
            $logged = (is_logged()) ? true : false;
            $con=$this->Config_Model->con_menu($logged); 
            echo json_encode($con);  
        }
        else{
            show_404();
        }
    }     

public function co_menupri_fil($filtro){ 
      $con=''; 
      $con=$this->Config_Model->con_menupri_fil($filtro); 
      echo json_encode($con);  
     }  
public function co_menuadd_fil($filtro){  
      $con='';
      $con=$this->Config_Model->con_menuadd_fil($filtro); 
      echo json_encode($con);  
     }              
}