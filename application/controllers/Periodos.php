<?php

   class Periodos extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(["Periodos_Model", "SemanasPeriodo_Model"]);
    }

    function index(){
        if(is_logged() && strtolower(logged_user()["rol"]) != "estudiante"){
            $params["periodos"] = $this->Periodos_Model->getAll();
            $this->load->view("periodos/all", $params);
        }
        else header("Location: ".base_url());
    }

    // Crea un nuevo periodo o modifica uno existente
    function create(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $postData = $this->input->post();
                $periodo = $this->Periodos_Model->find($postData["id_periodo"]);
                $idPeriodo = ($periodo) ? $this->Periodos_Model->update($postData) : $this->Periodos_Model->create($postData);
                if($idPeriodo){
                    json_response($idPeriodo, true, "Información guardada exitosamente.");
                }
                json_response(null, false, "Ha ocurrido un error, por favor intente de nuevo más tarde.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }

    // Elimina un periodo de la base de datos
    function delete($idPeriodo){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $isUsed = $this->SemanasPeriodo_Model->getByPeriodo($idPeriodo);

                if($isUsed == false){
                    $removed = $this->Periodos_Model->delete($idPeriodo);
                    if($removed){
                        json_response($idPeriodo, true, "Periodo eliminado exitosamente.");
                    }
                    json_response(null, false, "Ha ocurrido un error, por favor intente de nuevo más tarde.");
                }
                json_response(null, false, "No puede eliminar este periodo porque tiene semanas asignadas.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }
}