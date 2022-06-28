<?php
   class Asignacion extends CI_Controller { 
    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model('General_Model');
    }
 
    public function val_asigna()
    {         
        if(isset ($_POST["mat"])){ 
            $mat      = $_POST["mat"];                     
            $gru      = $_POST["gru"]; 
            $datos = $this->General_Model->val_asg($mat,$gru); 
            $res="";
            foreach($datos as $row){
                $id=$row->docente;
                $doc = $this->General_Model->nom_docente($id);
                foreach($doc as $col){                        
                    $res.= $col->nombres." ".$col->apellidos."\n";                         
                }    
            }     
            if ($res!==""){
                json_response(null, true, $res);
            }  else{
                json_response(null, false, "");
            }   
             
           }
    }
    public function in_asigna()
    {         
        if(isset ($_POST["ced"])){               
            $ced      = $_POST["ced"];
            $mat      = $_POST["mat"];  
            $gru      = $_POST["gru"];  
            $nomarea=$this->General_Model->cop_materia($mat);
            foreach($nomarea as $row){
                $narea=$row->nomarea; 
                $nmate=$row->nommateria;
                $grado=$row->grado;
            }
                $datos = array(
                    "docente" => $ced,
                    "materia" => $mat,
                    "grupo"   => $gru
                    );
                if($this->General_Model->insertar("asg_materias",$datos)==true){
                    //$dir=utf8_decode(base_url().'principal/areas/'.$narea.'/'.$nmate.'/'.$grado);
                    $dir=utf8_decode('./principal/areas/'.$narea.'/'.$nmate.$grado.'/'.$grado.$gru);
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777);
                        echo('Hecho! '.$dir);
                    }else{echo('Error!');}                       
                    echo ("Materia Asignada!");}
                else { echo ("No se pudo Asignar Materia!");}                     
           }
    }   
    public function bo_asigna()
    {         
        if(isset ($_POST["ced"])){ 
                $ced      = $_POST["ced"];
                $mat      = $_POST["mat"];                     
                $gru      = $_POST["gru"];   
                if($this->General_Model->bo_asg($ced,$mat,$gru)==true){
                    echo ("Materia Eliminada!");}
                else { echo ("No se pudo Eliminar Materia!");}                     
           }
    }
    public function in_asignapro(){         
    if(isset ($_POST["ced"])){ 
        $ced      = $_POST["ced"];
        $pro      = $_POST["pro"];  
        //se arma el array de guardago
        $datos = array(
            "docente"   => $ced,
            "proyecto"  => $pro
            );
        if($this->General_Model->insertar("asg_proyectos",$datos)==true){                    
            echo ("Proyecto Asignado!");}
        else { echo ("No se pudo Asignar Proyecto!");}                     
       }
    }  
    public function in_asignaproc(){         
    if(isset ($_POST["ced"])){ 
        $ced      = $_POST["ced"];
        $pro      = $_POST["pro"];  
        //se arma el array de guardago
        $datos = array(
            "docente"   => $ced,
            "proceso"  => $pro
            );
        if($this->General_Model->insertar("asg_procesos",$datos)==true){                    
            echo ("Proceso Asignado!");}
        else { echo ("No se pudo Asignar Proceso!");}                     
       }
    }      
    public function bo_asignapro(){         
        if(isset ($_POST["ced"])){ 
                $ced      = $_POST["ced"];
                $pro      = $_POST["pro"];                       
                if($this->General_Model->bo_asgpro($ced,$pro)==true){
                    echo ("Proyecto Eliminado!");}
                else { echo ("No se pudo Eliminar Proyecto!");}                     
           }
    }    
    public function bo_asignaproc(){         
        if(isset ($_POST["ced"])){ 
                $ced      = $_POST["ced"];
                $pro      = $_POST["pro"];                       
                if($this->General_Model->bo_asgproc($ced,$pro)==true){
                    echo ("Proceso Eliminado!");}
                else { echo ("No se pudo Eliminar Proceso!");}                     
           }
    }        
} 
