<?php
   class Cursos extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(['Cursos_Model', 'Materias_Model', 'Estudiante_Model']);
    }

    // Muestra la lista de todos los cursos disponibles
    function index(){
        if(is_logged()){
            $idUser = logged_user()["id"];
            $rolUser = logged_user()["rol"];

            $params["cursos"] = (strtolower($rolUser) == "docente") ? $this->Cursos_Model->get_all($idUser) : $this->Cursos_Model->get_by_grado(logged_user()["grado"].logged_user()["grupo"]);
            $this->load->view("cursos/index", $params);
        }
        else header("Location: ".base_url());
    }

    // Carga el formulario para crear un nuevo curso
    function create($idCurso = null){
        // Verificamos si existe un usuario logueado
        if(is_logged()){
            if($this->input->post()){
                $data = $this->input->post();
                $params["message"] = $this->save($data["curso"]);
            }
            $params["curso"] = $this->Cursos_Model->find($idCurso);
            $params["grados"] = $this->Estudiante_Model->getGrados();
            $this->load->view("cursos/create", $params);
        }
        else header("Location: ".base_url());
    }

    function ver($idCurso){
        // Verificamos si existe un usuario logueado
        if(is_logged()){
            $params["curso"] = $this->Cursos_Model->find($idCurso);
            $this->load->view("cursos/ver", $params);
        }
        else header("Location: ".base_url());
    }

    // Guarda la información de un nuevo curso o modifica uno existente
    function save($curso){
        $curso["grados"] = serialize($curso["grados"]);
        $curso["created_by"] = logged_user()["id"];
        $existsCurso = $this->Cursos_Model->find($curso["id_curso"]);

        if(!$existsCurso){
            $this->Cursos_Model->create($curso);
            return array("type" => "success", "message" => "Curso creado exitosamente.", "success" => true);
        }
        else{
            $this->Cursos_Model->update($curso);
            return array("type" => "success", "message" => "Curso modificado exitosamente.", "success" => true);
        }

        return array("type" => "error", "message" => "Ha ocurrido un error.", "success" => false);
    }

    // Eliminar anuncio
    function delete($idCurso){
        if(is_logged()){
            $curso = $this->Cursos_Model->find($idCurso);
            if($curso){
                if($this->Cursos_Model->delete($idCurso)){
                    json_response(null, true, "Curso eliminado exitosamente.");
                }
                else {
                    json_response(null, false, "Ha ocurrido un error.");
                }
            }
            else{
                json_response(null, false, "El curso no existe.");
            }
        }
        else{
            json_response(null, false, "Usuario no válido.");
        }
    }
} 
