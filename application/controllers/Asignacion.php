<?php
   class Asignacion extends CI_Controller { 
    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model('general_model');
    }
 
    public function val_asigna()
    {         
        if(isset ($_POST["mat"])){ 
                $mat      = $_POST["mat"];                     
                $gru      = $_POST["gru"]; 
                $datos = $this->general_model->val_asg($mat,$gru); 
                $res="";
                foreach($datos as $row){
                    $id=$row->docente;
                    $doc = $this->general_model->nom_docente($id);
                    foreach($doc as $col){                        
                        $res.="\n".$col->nombres." ".$col->apellidos."\n";                         
                    }    
                }     
            if ($res!==""){echo ($res);}  else{echo '0';}   
             
           }
    }
    public function in_asigna()
    {         
        if(isset ($_POST["ced"])){               
            $ced      = $_POST["ced"];
            $mat      = $_POST["mat"];  
            $gru      = $_POST["gru"];  
            $nomarea=$this->general_model->cop_materia($mat);
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
                if($this->general_model->insertar("asg_materias",$datos)==true){
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
                if($this->general_model->bo_asg($ced,$mat,$gru)==true){
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
        if($this->general_model->insertar("asg_proyectos",$datos)==true){                    
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
        if($this->general_model->insertar("asg_procesos",$datos)==true){                    
            echo ("Proceso Asignado!");}
        else { echo ("No se pudo Asignar Proceso!");}                     
       }
    }      
    public function bo_asignapro(){         
        if(isset ($_POST["ced"])){ 
                $ced      = $_POST["ced"];
                $pro      = $_POST["pro"];                       
                if($this->general_model->bo_asgpro($ced,$pro)==true){
                    echo ("Proyecto Eliminado!");}
                else { echo ("No se pudo Eliminar Proyecto!");}                     
           }
    }    
    public function bo_asignaproc(){         
        if(isset ($_POST["ced"])){ 
                $ced      = $_POST["ced"];
                $pro      = $_POST["pro"];                       
                if($this->general_model->bo_asgproc($ced,$pro)==true){
                    echo ("Proceso Eliminado!");}
                else { echo ("No se pudo Eliminar Proceso!");}                     
           }
    }        
} 
