<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $Participantes_Prueba_Model
 * @property $Estudiante_Model
 * @property $load
 * @property $input
 * @property $Usuarios_Model
 */
class Estudiante extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
         $this->load->helper('form');
         $this->load->helper('html');
         $this->load->helper('url');
         $this->load->model(['Estudiante_Model', 'Usuarios_Model', 'Participantes_Prueba_Model']);
    }

	public function verTodos(){
		if(is_logged() && strtolower(logged_user()['rol']) == 'super'){
			$params["estudiantes"] = $this->Estudiante_Model->getAll();
			$this->load->view("estudiantes/ver_todos", $params);
		}
		else{
			header("Location: ".base_url());
		}
	}

	function modificar($documento = null){
		if(is_logged() && strtolower(logged_user()['rol']) == 'super'){
			if($this->input->post()){
				$data = $this->input->post();
				$params["message"] = $this->procesoModificar($data, $documento);
			}
			$params["documento"] = $documento;
			$params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($documento);
			$this->load->view("estudiantes/modificar", $params);
		}
		else{
			header("Location: ".base_url());
		}
	}

	function procesoModificar($data, $documento){
		$dataEstudiante = array(
			"documento" => $data["documento"],
			"nombre" => $data["nombre"],
			"grado" => $data["grado"],
			"email" => $data["email"],
            "nee" => $data["nee"],
            "email_acudiente" => $data["email_acudiente"]
		);

		$dataUsuario = array(
			"id" => $data["documento"],
			"clave" => $data["clave"],
			"rol" => "Estudiante",
			"cargo" => "Estudiante",
			"email" => $data["email"]
		);

		if($documento){
			if($this->Estudiante_Model->update($dataEstudiante))
				if($this->Usuarios_Model->update_user($dataUsuario))
					return array("success" => true, "message" => "Estudiante y usuario modificado exitosamente.", "type" => "success");
				else 
					return array("success" => false, "message" => "Estudiante modificado exitosamente, no se ha podido modificar el usuario.", "type" => "warning");
			else
				return array("success" => false, "message" => "No se ha podido modificar el estudiante.", "type" => "danger");
		}
		else{
			$dataUsuario["usuario"] = $data["documento"];
			$dataUsuario["fecha"] = date("Y-m-d H:i:s");
			$dataUsuario["estado"] = "ac";
			$dataUsuario["nombres"] = getNombresApellidos($data["nombre"])["nombres"];
			$dataUsuario["apellidos"] = getNombresApellidos($data["nombre"])["apellidos"];

			if($this->Estudiante_Model->add($dataEstudiante))
				if($this->Usuarios_Model->add($dataUsuario))
					return array("success" => true, "message" => "Estudiante creado exitosamente.", "type" => "success");
				else 
					return array("success" => false, "message" => "Estudiante creado exitosamente, no se ha podido crear el usuario.", "type" => "warning");
			else
				return array("success" => false, "message" => "No se ha podido crear el estudiante.", "type" => "danger");
		}
	}
      
    function areas(){
      	if(is_logged() && logged_user()['rol'] === 'Estudiante'){
			$datos  = $this->Estudiante_Model->getAreas(logged_user()['id']);
        	if($datos) echo json_encode($datos);
			else echo ("Error en consulta");
      	}
    }  
    
    public function materias($area_id){
      	if(is_logged() && logged_user()['rol'] === 'Estudiante'){
        	if($datos  = $this->Estudiante_Model->getMaterias(logged_user()['id'], $area_id)){                   
            	echo json_encode($datos);
       		}else{
          		echo ("Error en consulta");
        	}
      	}
    }
	
	public function mover(){
		mover_estudiantes_usuarios();
	}

	public function estudiantes_grado_grupo($grado_grupo){
		if(is_logged()){
			if(strtolower(logged_user()["rol"]) == "docente"){
				$estudiantes = $this->Estudiante_Model->getStudentsByGrado($grado_grupo);
				json_response($estudiantes, true, "Lista de estudiantes");
			}
			else{
				json_response(array("error" => "permissions"), false, "No tiene los permisos necesarios para realizar esta accion");
			}
		}
		else{
			json_response(array("error" => "login"), false, "Iniciar sesion");
		}
	}

	public function importar(){
		if(is_logged()){
			if(strtolower(logged_user()["rol"]) == "super"){
				$params = [];
				if(isset($_FILES["estudiantes"])){
					$estudiantes = (importar_estudiantes($_FILES));
					if($estudiantes){
						if ($this->Estudiante_Model->setImportedStudents($estudiantes)){
							mover_estudiantes_usuarios();
							$params["message"]["message"] = "Estudiantes importados correctamente";
							$params["message"]["type"] = "success";
						}
						else{
							$params["message"]["message"] = "No se han podido importar los estudiantes";
							$params["message"]["type"] = "error";
						}
					}
					else{
						$params["message"]["message"] = "No se han podido importar los estudiantes";
						$params["message"]["type"] = "error";
					}
				}

				$this->load->view('estudiantes/import', $params);
			}
			else header("Location: ".base_url());
		}
		else header("Location: ".base_url());
	}

	function eliminarTodos(){
        if(is_logged() && strtolower(logged_user()["rol"]) == "super"){
            $this->Usuarios_Model->delete_all_users_rol("Estudiante");
            $this->Estudiante_Model->delete_all_estudents();
			json_response(array("error" => false), true, "Estudiantes eliminados exitosamente");
        }
		else{
			json_response(array("error" => "permissions"), false, "No tiene los permisos necesarios para realizar esta accion");
		}
    }

	public function eliminar($documento){
		if(is_logged()){
			if(strtolower(logged_user()["rol"]) == "super"){
				$estudiante = $this->Estudiante_Model->getStudentsByDocuments([$documento]);
				if($estudiante){
					if($this->Usuarios_Model->delete($documento)){
						if($this->Estudiante_Model->delete($documento))
							json_response(array("error" => false), true, "Estudiante eliminado exitosamente");
						else
							json_response(array("error" => "general"), false, "No se ha podido eliminar el estudiante, por favor intente de nuevo más tarde");
					}
					else
						json_response(array("error" => "general"), false, "No se ha podido eliminar el estudiante, por favor intente de nuevo más tarde");
				}
				else
					json_response(array("error" => "404"), false, "No se ha encontrado un estudiante con número identificación: ".$documento);
			}
			else
				json_response(array("error" => "permissions"), false, "No tiene los permisos necesarios para realizar esta accion");
		}
		else
			json_response(array("error" => "login"), false, "Iniciar sesion");
	}

    public function actualizarInformacionPruebas(){
        if(is_logged() && strtolower(logged_user()['rol']) == 'super'){
            $estudiantes = $this->Estudiante_Model->getAll();

            if($estudiantes){
                for ($i = 0; $i < count($estudiantes); $i++) {
                    $this->Participantes_Prueba_Model->update(array("identificacion" => $estudiantes[$i]["id"], "grado" => $estudiantes[$i]["grado"]));
                }
            }

            echo "Actualización exitosa";
        }
        else{
            header("Location: ".base_url());
        }
    }
}