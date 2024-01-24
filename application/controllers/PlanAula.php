<?php
use Dompdf\Dompdf;
use Dompdf\Options;
   class PlanAula extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(["Areas_Model", "Periodos_Model", "PlanAreas_Model", "Materias_Model", "Caracterizacion_Estandar_Competencia_Model", "Caracterizacion_DBA_Model", "EvidenciasAprendizaje_Model", "SemanasPeriodo_Model", "Usuarios_Model"]);
    }

    function index(){
        if(is_logged()){
            $params["areas"] = $this->Areas_Model->getAreasDocente(logged_user()["id"]);
            $params["periodos"] = $this->Periodos_Model->getAll();
            $params["materias"] = false;
            $params["area"] = null;
            $params["materia"] = null;
            $params["periodo"] = null;
            
			if(strtolower(logged_user()["rol"]) != "estudiante"){
                if(strtolower(logged_user()["rol"]) == "docente"){
                    $params["planes_aula"] = $this->PlanAreas_Model->get_by_docente(logged_user()["id"]);
                }
                else {
                    if($this->input->post()){
                        $params["area"] = $this->input->post("area");
                        $params["materia"] = $this->input->post("materia");
                        $params["periodo"] = $this->input->post("periodo");
                        $params["materias"] = $this->Materias_Model->getMateriasArea($params["area"]);
                    }

                    $params["planes_aula"] = $this->PlanAreas_Model->get_by_filter($params["area"], $params["materia"], $params["periodo"]);
                }
            }

            $this->load->view("plan_aula/all", $params);
        }
        else header("Location: ".base_url());
    }

    public function create($idPlanAula = null, $idEvidenciaAprendizaje = null){   
        if(is_logged()){
			if(strtolower(logged_user()["rol"]) == "docente"){
                if($this->input->post()){
                    $plan = $this->input->post("plan");
                    $params["message"] = $this->savePlanArea($plan);
                    $this->saveEvidencia($this->input->post("evidencia"), $plan["id_plan_area"]);
                    $idEvidenciaAprendizaje = null;
                }
                $params["materias"] = null;
                $params["estandares"] = null;
                $params["dbas"] = null;
                $params["evidencias"] = null;

                $params["plan_area"] = $this->PlanAreas_Model->find($idPlanAula);
                if(!$params["plan_area"]){
                    $idEvidenciaAprendizaje = null;
                }

                $params["selectedEvidencia"] = $this->EvidenciasAprendizaje_Model->find($idEvidenciaAprendizaje);

                if(is_array($params["selectedEvidencia"]) && ($params["selectedEvidencia"]["id_plan_area"] != $idPlanAula)){
                    header("Location: ".base_url()."/PlanAula");
                }

                $params["areas"] = $this->Areas_Model->getAreasDocente(logged_user()["id"]);
                $params["periodos"] = $this->Periodos_Model->getAll();

                if(is_array($params["plan_area"])){
                    $area = $this->Areas_Model->find($params["plan_area"]["area"]);
                    $materia = $this->Materias_Model->getMateria($params["plan_area"]["materia"]);
                    $params["materias"] = $this->Materias_Model->getMateriasArea($params["plan_area"]["area"]);
                    $params["estandares"] = $this->Caracterizacion_Estandar_Competencia_Model->get_all_area_grado($area["caracterizacion_area"], $materia["grado"]);
                    $params["dbas"] = $this->Caracterizacion_DBA_Model->get_all_area_grado($area["caracterizacion_area"], $materia["grado"]);
                    $params["evidencias"] = $this->EvidenciasAprendizaje_Model->getByPlanArea($params["plan_area"]["id_plan_area"]);
                    $params["semanas"] = $this->SemanasPeriodo_Model->getByPeriodo($params["plan_area"]["periodo"]);
                }

                $this->load->view("plan_aula/create", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    // Crea o actualiza la información de un plan de area
    private function savePlanArea($data){
        if($data){
            $data["dbas"] = (isset($data["dbas"])) ? serialize($data["dbas"]) : serialize([]);
            $data["estandares_basicos"] = (isset($data["estandares_basicos"])) ? serialize($data["estandares_basicos"]) : serialize([]);
            $data["created_by"] = logged_user()["id"];

            if($data["id_plan_area"] != null && $data["id_plan_area"] != "null"){
                $idPlanAula = $this->PlanAreas_Model->update($data);
            }
            else {
                $idPlanAula = $this->PlanAreas_Model->create($data);
            }

            if($idPlanAula) {
                return array("status" => true, "type" => "success", "message" => "Información guardada exitosamente");
            }
            else {
                return array("status" => false, "type" => "danger", "message" => "Ha ocurrido un error, por favor intente de nuevo");
            }
        }
        else return array("status" => false, "type" => "danger", "message" => "No se puede guardar la información");
    }

    function saveEvidencia($evidencia, $idPlanAula){
        if($evidencia && isset($evidencia["semanas"])){
            $evidencia["id_plan_area"] = $idPlanAula;
            $evidencia["semanas"] = serialize($evidencia["semanas"]);
            $evidencia["is_only_row"] = (isset($evidencia["is_only_row"])) ? 1 : 0;

            if($evidencia["id_evidencia_aprendizaje"] == "null" || $evidencia["id_evidencia_aprendizaje"] == null)
                $this->EvidenciasAprendizaje_Model->create($evidencia);
            else {
                $this->EvidenciasAprendizaje_Model->update($evidencia);
            }
        }
    }

    function ver($idPlanAula){
        $params["plan_area"] = $this->PlanAreas_Model->find($idPlanAula);
        if(is_array($params["plan_area"])){
            $area = $this->Areas_Model->find($params["plan_area"]["area"]);
            $materia = $this->Materias_Model->getMateria($params["plan_area"]["materia"]);
            $params["usuario"] = $this->Usuarios_Model->get_user($params["plan_area"]["created_by"]);
            $params["area"] = $area;
            $params["materia"] = $materia;
            $params["materias"] = $this->Materias_Model->getMateriasArea($params["plan_area"]["area"]);
            $params["estandares"] = $this->Caracterizacion_Estandar_Competencia_Model->get_all_area_grado($area["caracterizacion_area"], $materia["grado"]);
            $params["dbas"] = $this->Caracterizacion_DBA_Model->get_all_area_grado($area["caracterizacion_area"], $materia["grado"]);
            $params["evidencias"] = $this->EvidenciasAprendizaje_Model->getByPlanArea($params["plan_area"]["id_plan_area"]);
            $params["semanas"] = $this->SemanasPeriodo_Model->getByPeriodo($params["plan_area"]["periodo"]);
        }

        $this->load->view("plan_aula/ver", $params);

        // Cargar HTML en dompdf (puedes cargar tu vista aquí)
        $html = $html = $this->output->get_output();

        // Configurar opciones de dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
      

        // Inicializar dompdf
        $dompdf = new Dompdf($options);
        // Configurar orientación a horizontal
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->set_option('defaultMediaType', 'all');
        $dompdf->set_option('isFontSubsettingEnabled', true);
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        
        $dompdf->loadHtml($html);

        // Renderizar PDF
        $dompdf->render();

        // Mostrar el PDF en el navegador o descargarlo
        $dompdf->stream('documento.pdf', array('Attachment' => false));
    }

    // Eliminar un plan de aula con sus respectivas evidencias de aprendizaje
    function delete($idPlanAula){
        if(is_logged()){
            $planAula = $this->PlanAreas_Model->find($idPlanAula);
            if(is_array($planAula)){
                if(strtolower(logged_user()["rol"]) == "docente" && $planAula["created_by"] == logged_user()["id"]){
                    $this->EvidenciasAprendizaje_Model->deleteByPlanAula($idPlanAula);
                    if($this->PlanAreas_Model->delete($idPlanAula)){
                        json_response(null, true, "Plan de aula eliminado exitosamente");
                    }
                    else{
                        json_response(null, true, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                    }
                }
                else {
                    json_response(null, false, "No tiene permisos para realizar esta acción");
                }
            }
            else {
                json_response(null, false, "No existe el plan de aula");
            }
        }
        else{
            json_response(null, false, "Por favor inicie sesion");
        }
    }
} 
