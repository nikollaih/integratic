<?php
   class Materias extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model('Materias_Model');
    }

    public function get($id_materia){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $materia = $this->Materias_Model->getMateria($id_materia);
                json_response($materia, true, "Lista de items.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }

    public function getMateriasArea($id_area){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $materias = $this->Materias_Model->getMateriasArea($id_area);
                json_response($materias, true, "Lista de items.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }
} 
