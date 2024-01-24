<?php
   class Temas extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url')); 
       $this->load->model(['Temas_Model', 'Materias_Model', 'Caracterizacion_DBA_Model']);
    }

    function index(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $materiasDocente = get_docente_materias(logged_user()["id"], true);
                $params["temas"] = $this->Temas_Model->get_by_materias($materiasDocente);
                if($params["temas"]){
                    for ($i=0; $i < count($params["temas"]); $i++) {
                        $materias = unserialize($params["temas"][$i]["materias"]);
                        $params["temas"][$i]["materias"] = $this->Materias_Model->getMateriaPrueba($materias);
                    }
                }
                $this->load->view("temas/lista", $params);
            }
        }
        else header("Location: ".base_url());
    }

    function create(){
        if(is_logged()){
            $params["materias"] = $this->Materias_Model->getMateriasDocente(logged_user()["id"]);

            if($this->input->post()){
                $params["message"] = $this->procesarTema($this->input->post());
            }

            $this->load->view("temas/crear", $params);
        }
        else header("Location: ".base_url());
    }

    function update($id_tema){
        if(is_logged()){
            $params["materias"] = $this->Materias_Model->getMateriasDocente(logged_user()["id"]);
            $params["tema"] = $this->Temas_Model->find($id_tema);
            $params["dba"] = $this->Caracterizacion_DBA_Model->get($params["tema"]["dba"]);

            if($this->input->post()){
                $params["message"] = $this->procesarTema($this->input->post());
            }

            $this->load->view("temas/crear", $params);
        }
        else header("Location: ".base_url());
    }

    function procesarTema($post){
        $post["materias"] = serialize($post["materias"]);
        $data = $post;
        if(($data["id_tema"] == null)){
            unset($data["id_tema"]);
        }
        $id_tema = ($post["id_tema"] != null) ? $this->Temas_Model->update($data) : $this->Temas_Model->create($data);

        $success_status = ($post["id_tema"] != null) ? "Tema modificado exitosamente" : "Tema creado exitosamente";
        $fail_status = ($post["id_tema"] != null) ? "No se ha podido modificar el tema, intente de nuevo más tarde." : "No se ha podido crear el tema, intente de nuevo más tarde.";

        if($id_tema) return array("type" => "success", "message" => $success_status, "success" => true);
        else return array("type" => "danger", "message" => $fail_status, "success" => false);
    }

    // Eliminar tema
    function delete($id_tema){
        if(is_logged()){
            $tema = $this->Temas_Model->find($id_tema);
            if($tema){
                if($this->Temas_Model->update(array("id_tema" => $id_tema, "status" => 0)))
                    json_response(null, true, "Tema eliminado exitosamente.");
            }
            else json_response(null, false, "El tema no existe.");
        }
        else json_response(null, false, "Usuario no válido.");
    }
     
    function getTemasMateria($id_materia){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $temas = $this->Temas_Model->get_by_materias([$id_materia]);
                json_response($temas, true, "Listado de items.");
            }
            else json_response(null, false, "El tema no existe.");
        }
        else json_response(null, false, "Usuario no válido.");
    }
} 
