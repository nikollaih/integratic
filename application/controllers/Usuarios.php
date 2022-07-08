<?php
  
   class Usuarios extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(['General_Model', "Usuarios_Model", "Estudiante_Model"]);
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

            if($this->General_Model->insertar("usuarios",$datos)==true){
                echo ("Registro Guardado");}
            else { echo ("No se pudo guardar los datos");} 
         }
    }

	// Actualiza la fecha de ultima vista a las notificaciones
    public function actualizar_fecha_notificaciones(){
		if(is_logged()){
			$data["id"] = logged_user()["id"];
			$data["ultima_fecha_anuncios"] = date("Y-m-d H:i:s");

			if($this->Usuarios_Model->update_user($data)){
				json_response(null, true, "Fecha actualizada");
			}
			else{
				json_response(null, false, "Ha ocurrido un error");
			}
		}
		else{
			json_response(null, false, "Usuario no válido");
		}
	}

    public function logout(){
        $this->session->sess_destroy();
        header("Location: ".base_url());
    }

    public function remover_espacios_blanco(){
        $usuarios = $this->Usuarios_Model->get_all();
        if($usuarios){
            for ($i=0; $i < count($usuarios) ; $i++) {
                $usuario_id = $usuarios[$i]["id"];
                if($usuarios[$i]["id"] != trim($usuarios[$i]["id"]) || $usuarios[$i]["clave"] != trim($usuarios[0]["clave"]) || $usuarios[$i]["usuario"] != trim($usuarios[0]["usuario"])){
                    $usuarios[$i]["id"] = trim($usuarios[$i]["id"]);
                    $usuarios[$i]["clave"] = trim($usuarios[$i]["clave"]);
                    $usuarios[$i]["usuario"] = trim($usuarios[$i]["usuario"]);
                    $this->Usuarios_Model->update_old_user($usuario_id, $usuarios[$i]);
                }
            }
        }

        $estudiantes = $this->Estudiante_Model->getAllStudents();
        if($estudiantes){
            for ($i=0; $i < count($estudiantes) ; $i++) {
                $estudiante_id = $estudiantes[$i]["documento"];
                if($estudiantes[$i]["documento"] != trim($estudiantes[$i]["documento"])){
                    $estudiantes[$i]["documento"] = trim($estudiantes[$i]["documento"]);
                    $this->Estudiante_Model->update_old($estudiante_id, $estudiantes[$i]);
                }
            }
        }
    }
} 
