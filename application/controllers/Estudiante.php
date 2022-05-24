<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
         $this->load->helper('form');
         $this->load->helper('html');
         $this->load->helper('url');
         $this->load->model(['Estudiante_Model', 'Usuarios_Model']);
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
      
    public function areas(){
      	if(is_logged() && logged_user()['rol'] === 'Estudiante'){
        	if($datos  = $this->Estudiante_Model->getAreas(logged_user()['id'])){                   
            	echo json_encode($datos);
			}
			else
			{
				echo ("Error en consulta");
			}
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
}