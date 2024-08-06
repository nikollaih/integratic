<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class EvidenciasAprendizaje extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model(["Areas_Model", "Periodos_Model", "PlanAreas_Model", "Materias_Model", "Caracterizacion_Estandar_Competencia_Model", "Caracterizacion_DBA_Model", "EvidenciasAprendizaje_Model", "SemanasPeriodo_Model", "Usuarios_Model"]);
	}

    function index(){
        if(is_logged()){
            $rol = strtolower(logged_user()["rol"]);
            $params["areas"] =  ($rol == "docente") ? $this->Areas_Model->getAreasDocente(logged_user()["id"]) : $this->Areas_Model->getAll();
            $params["periodos"] = $this->Periodos_Model->getAll();
            $params["materias"] = false;
            
			if(strtolower(logged_user()["rol"]) != "estudiante"){
                $params["area"] = null;
                $params["materia"] = null;
                $params["periodo"] = null;
                $params["semana"] = null;
                $params["estado"] = null;
                $params["evidencias_aprendizaje"] = null;

                if($this->input->post()){
                    $params["area"] = $this->input->post("area");
                    $params["materia"] = $this->input->post("materia");
                    $params["periodo"] = $this->input->post("periodo");
                    $params["semana"] = $this->input->post("semana");
                    $params["estado"] = $this->input->post("estado");
                    $params["materias"] = $this->Materias_Model->getMateriasArea($params["area"]);
                    $params["semanas"] = $this->SemanasPeriodo_Model->getByPeriodo($params["periodo"]);
                    $params["evidencias_aprendizaje"] = $this->EvidenciasAprendizaje_Model->get_by_filter($params["area"], $params["materia"], $params["semana"], $params["periodo"], $params["estado"]);
                }
        }
            $this->load->view("plan_aula/evidencias_aprendizaje", $params);
        }
        else header("Location: ".base_url());
    }

    function find($idEvidenciaAprendizaje){
		if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $evidencia = $this->EvidenciasAprendizaje_Model->find($idEvidenciaAprendizaje);
                if($evidencia) json_response($evidencia, true, "Evidencia de aprendizaje");
                else json_response(array("error" => "404"), false, "No se ha encontrado la evidencia de aprendizaje");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
	}

    function remove($idEvidenciaAprendizaje){
		if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $evidencia = $this->EvidenciasAprendizaje_Model->find($idEvidenciaAprendizaje);

                if($evidencia){
                    if($this->EvidenciasAprendizaje_Model->delete($idEvidenciaAprendizaje)){
                        json_response(array("error" => false), true, "Registro eliminado correctamente");
                    }
                    else json_response(array("error" => "general"), false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado la evidencia de aprendizaje");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
	}

    function update(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $data = $this->input->post();
                if($data){
                    $evidencia = $this->EvidenciasAprendizaje_Model->find($data["id_evidencia_aprendizaje"]);

                    if($evidencia){
                        if($this->EvidenciasAprendizaje_Model->update($data)){
                            json_response(array("error" => false), true, "Evidencia modificada correctamente");
                        }
                        else json_response(array("error" => "general"), false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                    }
                    else json_response(array("error" => "404"), false, "No se ha encontrado la evidencia de aprendizaje");
                }
                else json_response(array("error" => "404"), false, "No es posible realizar esta acción");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }

    function AgregarObservacion() {
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "coordinador"){
                $data = $this->input->post();
                if($data){
                    $evidencia = $this->EvidenciasAprendizaje_Model->find($data["id_evidencia_aprendizaje"]);
                    if($evidencia){
                        $this->session->set_flashdata('message', 'Observaciones agregadas exitosamente!');
                        $this->EvidenciasAprendizaje_Model->update($data);
                    }
                }
            }
        }

        header("Location: ".base_url()."PlanAula/create/".$evidencia["id_plan_area"]);
    }
}
