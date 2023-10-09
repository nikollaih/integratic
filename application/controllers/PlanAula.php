<?php
   class PlanAula extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(["Areas_Model", "Periodos_Model"]);
    }

    public function create($idPlanArea = null){   
        if(is_logged()){
			if(strtolower(logged_user()["rol"]) == "docente"){
                if($this->input->post()){
                    $params["message"] = $this->savePlanArea($this->input->post());
                }

                $params["areas"] = $this->Areas_Model->getAreasDocente(logged_user()["id"]);
                $params["periodos"] = $this->Periodos_Model->getAll();

                $this->load->view("plan_aula/create", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    private function savePlanArea($data){
        if($data){

        }
        else return array("status" => false, "message" => "No se puede guardar la información");
    }
} 
