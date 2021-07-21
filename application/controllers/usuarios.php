<?php
  
   class Usuarios extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model('general_model');
    }
    
    public function nuevo()
    {
        date_default_timezone_set ('America/Bogota');
         if(isset ($_POST["ced"])){
            $ced        = $_POST["ced"];
            $nom        = $_POST["nombres"];
            $ape        = $_POST["apellidos"];
            $cargo      = $_POST["cargo"];
            $rol        = $_POST["rol"];
            $cel        = $_POST["cel"];
            $usr        = $_POST["mail"];
            $pass       = $_POST["pass"];
            $fecha      = date('Y-m-d H:i:s');

            $datos = array(
                "id"        => $ced,
                "nombres"   => $nom,
                "apellidos" => $ape,
                "cargo"     => $cargo,
                "rol"       => $rol,
                "nocel"     => $cel,
                "usuario"   => $usr,
                "clave"     => $pass,
                "fecha"     => $fecha,
                "estado"    => "ac"
             );

            if($this->general_model->insertar("usuarios",$datos)==true){
                echo ("Registro Guardado");}
            else { echo ("No se pudo guardar los datos");} 
         }
    }

} 
