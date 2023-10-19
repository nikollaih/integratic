<?php

   class SemanasPeriodo extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(["SemanasPeriodo_Model", "EvidenciasAprendizaje_Model"]);
    }

    function getSemanasPeriodo($idPeriodo){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $semanas = $this->SemanasPeriodo_Model->getByPeriodo($idPeriodo);
                json_response($semanas, true, "Lista de items.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }

    // Crea una nueva semana
    function create(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $postData = $this->input->post();
                $semana = $this->SemanasPeriodo_Model->find($postData["id_semana_periodo"]);
                $idSemana = ($semana) ? $this->SemanasPeriodo_Model->update($postData) : $this->SemanasPeriodo_Model->create($postData);
                if($idSemana){
                    json_response($idSemana, true, "Información guardada exitosamente.");
                }
                json_response(null, false, "Ha ocurrido un error, por favor intente de nuevo más tarde.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }

    // Elimina una semana de la base de datos
    function delete($idSemana){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $isUsed = $this->EvidenciasAprendizaje_Model->getBySemanasPeriodo([$idSemana]);

                if($isUsed == false){
                    $removed = $this->SemanasPeriodo_Model->delete($idSemana);
                    if($removed){
                        json_response($idSemana, true, "Semana eliminada exitosamente.");
                    }
                    json_response(null, false, "Ha ocurrido un error, por favor intente de nuevo más tarde.");
                }
                json_response(null, false, "No puede eliminar esta semana porque está siendo utilizada en una o más evidencias de aprendizaje.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }
}