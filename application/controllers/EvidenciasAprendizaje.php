<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $Consultas_Model
 * @property $Periodos_Model
 * @property $Areas_Model
 * @property $Usuarios_Model
 * @property $load
 * @property $input
 * @property $Materias_Model
 * @property $SemanasPeriodo_Model
 * @property $EvidenciasAprendizaje_Model
 * @property $session
 * @property $PlanAreas_Model
 * @property $EvidenciasAprendizajeComponentes_Model
 */
Class EvidenciasAprendizaje extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model(["EvidenciasAprendizajeComponentes_Model", "Consultas_Model", "Areas_Model", "Periodos_Model", "PlanAreas_Model", "Materias_Model", "Caracterizacion_Estandar_Competencia_Model", "Caracterizacion_DBA_Model", "EvidenciasAprendizaje_Model", "SemanasPeriodo_Model", "Usuarios_Model"]);
	}

    function index(){
        if(is_logged()){
            $rol = strtolower(logged_user()["rol"]);
            $params["areas"] =  ($rol == "docente") ? $this->Areas_Model->getAreasDocente(logged_user()["id"]) : $this->Areas_Model->getAll();
            $params["periodos"] = $this->Periodos_Model->getAll();
            $params["materias"] = false;
            $params["docentes"] = $this->Usuarios_Model->get_by_role("docente");
            
			if(strtolower(logged_user()["rol"]) != "estudiante"){
                $params["docente"] = null;
                $params["area"] = null;
                $params["materia"] = null;
                $params["periodo"] = null;
                $params["semana"] = null;
                $params["estado"] = null;
                $params["evidencias_aprendizaje"] = null;

                if($this->input->post()){
                    $params["docente"] = $this->input->post("docente");
                    if($params["docente"]){
                        $params["areas"] =  json_decode(json_encode($this->Consultas_Model->asignadoc($params["docente"], true)), true);
                    }
                    $params["area"] = $this->input->post("area");
                    $params["materia"] = $this->input->post("materia");
                    $params["periodo"] = $this->input->post("periodo");
                    $params["semana"] = $this->input->post("semana");
                    $params["estado"] = $this->input->post("estado");
                    $params["materias"] = $this->Materias_Model->getMateriasArea($params["area"]);
                    $params["semanas"] = $this->SemanasPeriodo_Model->getByPeriodo($params["periodo"]);
                    $params["evidencias_aprendizaje"] = $this->EvidenciasAprendizaje_Model->get_by_filter($params["area"], $params["materia"], $params["semana"], $params["periodo"], $params["estado"], $params["docente"]);
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

    function uncompleted($PlanAulaId = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $evidencias = $this->EvidenciasAprendizaje_Model->uncompleted($PlanAulaId);
                if($evidencias) json_response($evidencias, true, "Evidencias de aprendizaje incompletas");
                else json_response(array("error" => "404"), false, "No se han encontrado evidencias de aprendizaje");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }

    function use(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $data = $this->input->post();
                $evidencia = $this->EvidenciasAprendizaje_Model->findOne($data["id_evidencia_aprendizaje"]);
                $evidenciaComponentes = $this->EvidenciasAprendizajeComponentes_Model->getAllByEvidencia($data["id_evidencia_aprendizaje"]);
                $planAula = $this->PlanAreas_Model->find($data["id_plan_aula"]);
                $idEvidenciaAprendizaje = $data["id_evidencia_aprendizaje"];

                if($evidencia && $planAula){
                    $evidencia["id_plan_area"] = $data["id_plan_aula"];
                    $evidencia["created_at"] = date("Y-m-d H:i:s");
                    $evidencia["semanas"] = serialize($data["semanas"]);
                    $evidencia["observaciones_coordinador"] = "";
                    unset($evidencia["id_evidencia_aprendizaje"]);

                    $newIdEvidenciaAprendizaje = $this->EvidenciasAprendizaje_Model->create($evidencia);

                    if($newIdEvidenciaAprendizaje){
                        if($data["mode"] == "true") {
                            $this->EvidenciasAprendizaje_Model->update(array("id_evidencia_aprendizaje" => $idEvidenciaAprendizaje, "is_completo" => 1));
                        }

                        if($evidenciaComponentes){
                            foreach ($evidenciaComponentes as $evidenciaComponente) {
                                unset($evidenciaComponente["id_componente"]);
                                $evidenciaComponente["id_evidencia_aprendizaje"] = $newIdEvidenciaAprendizaje;
                                $this->EvidenciasAprendizajeComponentes_Model->create($evidenciaComponente);
                            }
                        }

                        json_response($evidencia, true, "Evidencia de aprendizaje copiada exitosamente");
                    }
                }
                else {
                    json_response(array("error" => "404"), false, "No se han encontrado los registros seleccionados");
                }
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }
}
