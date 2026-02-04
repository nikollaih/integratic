<?php

use Mpdf\Mpdf;

/**
 * @property $TipoComponenteEvidencia_Model
 * @property $Areas_Model
 * @property $Periodos_Model
 * @property $input
 * @property $Materias_Model
 * @property $PlanAreas_Model
 * @property $EvidenciasAprendizaje_Model
 * @property $load
 * @property $Caracterizacion_Estandar_Competencia_Model
 * @property $Caracterizacion_DBA_Model
 * @property $SemanasPeriodo_Model
 * @property $EvidenciasAprendizajeComponentes_Model
 */
class PlanAula extends CI_Controller {

    public function __construct() {  
        parent::__construct();
        $this->load->helper(array('form', 'url','html'));
        $this->load->model(["EvidenciasAprendizajeComponentes_Model", "TipoComponenteEvidencia_Model", "Areas_Model", "Periodos_Model", "PlanAreas_Model", "Materias_Model", "Caracterizacion_Estandar_Competencia_Model", "Caracterizacion_DBA_Model", "EvidenciasAprendizaje_Model", "SemanasPeriodo_Model", "Usuarios_Model"]);

        $this->mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L', // A4 landscape orientation
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5
        ]);
    }

    function index(){
        if(is_logged()){
            $params["areas"] = $this->Areas_Model->getAreasDocente(logged_user()["id"]);
            $params["periodos"] = $this->Periodos_Model->getAll();
            $params["materias"] = false;
            $params["area"] = null;
            $params["materia"] = null;
            $params["periodo"] = null;

            if($this->input->post()){
                $params["area"] = $this->input->post("area");
                $params["materia"] = $this->input->post("materia");
                $params["periodo"] = $this->input->post("periodo");
                $params["materias"] = $this->Materias_Model->getMateriasArea($params["area"]);
            }
            
			if(strtolower(logged_user()["rol"]) != "estudiante"){
                if(strtolower(logged_user()["rol"]) == "docente"){
                    $params["planes_aula"] = $this->PlanAreas_Model->get_by_docente(logged_user()["id"], $params["area"], $params["materia"], $params["periodo"]);
                }
                else {
                    $params["planes_aula"] = $this->PlanAreas_Model->get_by_filter($params["area"], $params["materia"], $params["periodo"]);
                }
            }

            $this->load->view("plan_aula/all", $params);
        }
        else header("Location: ".base_url());
    }

    public function create($idPlanAula = null, $idEvidenciaAprendizaje = null){   
        if(is_logged()){
            $rol = strtolower(logged_user()["rol"]);
			if($rol != "estudiante"){
                if($this->input->post()){
                    $plan = $this->input->post("plan");
                    $params["message"] = $this->savePlanArea($plan);
                    $this->saveEvidencia($this->input->post("evidencia"), $plan["id_plan_area"]);
                    $idEvidenciaAprendizaje = null;
                }
                $params["editable"] = ($rol == "docente");
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

                $params["areas"] = ($rol == "docente") ? $this->Areas_Model->getAreasDocente(logged_user()["id"]) : $this->Areas_Model->getAll();
                $params["periodos"] = $this->Periodos_Model->getAll();

                if(is_array($params["plan_area"])){
                    $area = $this->Areas_Model->find($params["plan_area"]["area"]);
                    $materia = $this->Materias_Model->getMateria($params["plan_area"]["materia"]);
                    $params["materias"] = $this->Materias_Model->getMateriasArea($params["plan_area"]["area"]);
                    $params["estandares"] = $this->Caracterizacion_Estandar_Competencia_Model->get_all_area_grado($area["caracterizacion_area"], $materia["grado"]);
                    $params["dbas"] = $this->Caracterizacion_DBA_Model->get_all_area_grado($area["caracterizacion_area"], $materia["grado"]);
                    $params["evidencias"] = $this->EvidenciasAprendizaje_Model->getByPlanArea($params["plan_area"]["id_plan_area"]);
                    $params["semanas"] = $this->SemanasPeriodo_Model->getByPeriodo($params["plan_area"]["id_periodo"]);
                }

                $params["tipos_componentes_evidencia"] = $this->TipoComponenteEvidencia_Model->getAll();

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
        $componentesEvidencia = [];
        if($evidencia && isset($evidencia["semanas"])){
            $tiposComponenteEvidencia = $this->TipoComponenteEvidencia_Model->getAll();
            $evidencia["id_plan_area"] = $idPlanAula;
            $evidencia["semanas"] = serialize($evidencia["semanas"]);
            $evidencia["is_only_row"] = (isset($evidencia["is_only_row"])) ? 1 : 0;


            for ($x = 0; $x < count($tiposComponenteEvidencia); $x++) {
                if(isset($evidencia[$tiposComponenteEvidencia[$x]["id_tipo_componente"]])){
                    $exists = $evidencia[$tiposComponenteEvidencia[$x]["id_tipo_componente"]];

                    if($exists){
                        $componentesEvidencia[] = [
                            "id_tipo_componente" => $tiposComponenteEvidencia[$x]["id_tipo_componente"],
                            "contenido" => $exists["contenido"],
                            "id_componente" => $exists["id_componente"],
                        ];

                        unset($evidencia[$tiposComponenteEvidencia[$x]["id_tipo_componente"]]);
                    }
                }
            }

            if($evidencia["id_evidencia_aprendizaje"] == "null" || $evidencia["id_evidencia_aprendizaje"] == null) {
                $evidenciaAprendizajeID = $this->EvidenciasAprendizaje_Model->create($evidencia);
            }
            else {
               $this->EvidenciasAprendizaje_Model->update($evidencia);
                $evidenciaAprendizajeID = $evidencia["id_evidencia_aprendizaje"];
            }
        }

        if($componentesEvidencia){
            for ($i = 0; $i < count($componentesEvidencia); $i++) {
                $componentesEvidencia[$i]["id_evidencia_aprendizaje"] = $evidenciaAprendizajeID;
                $exists = $this->EvidenciasAprendizajeComponentes_Model->find($componentesEvidencia[$i]["id_componente"]);

                if($exists)
                    $this->EvidenciasAprendizajeComponentes_Model->update($componentesEvidencia[$i]);
                else {
                    unset($componentesEvidencia[$i]["id_componente"]);
                    $this->EvidenciasAprendizajeComponentes_Model->create($componentesEvidencia[$i]);
                }
            }
        }
    }

    function ver($idPlanAula, $outputMode = 'inline', $savePath = null){
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
            $params["tipos_componentes_evidencia"] = $this->TipoComponenteEvidencia_Model->getAll();
        }

        // Limpiar el buffer de salida ANTES de cargar la vista para evitar acumulación
        $this->output->set_output('');
        $this->load->view("plan_aula/ver", $params);
        $html = $this->output->get_output();
        // Crear una nueva instancia de mPDF para cada PDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5
        ]);
        $mpdf->WriteHTML($html);
        // Construir nombre de archivo con usuario
        $usuarioNombre = '';
        if (isset($params["usuario"]["nombres"]) || isset($params["usuario"]["apellidos"])) {
            $usuarioNombre = trim(($params["usuario"]["nombres"] ?? '') . '_' . ($params["usuario"]["apellidos"] ?? ''));
            $usuarioNombre = preg_replace('/[^A-Za-z0-9_\-]/', '_', $usuarioNombre);
        }
        $fileName = 'Plan_Aula_' . ($usuarioNombre ? ('_' . $usuarioNombre) : '') .'_'.$params["plan_area"]['nommateria'].'_'.$params["plan_area"]['grado'].'_'.$params["plan_area"]['periodo']. '.pdf';

        if ($outputMode === 'save' && $savePath) {
            $isDir = (substr($savePath, -1) === DIRECTORY_SEPARATOR) || is_dir($savePath);
            if($isDir){
                $dir = rtrim($savePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
                $saveFullPath = $dir . $fileName;
            } else {
                $saveFullPath = $savePath;
                $dir = dirname($saveFullPath);
            }
            if(!is_dir($dir)){
                if(!mkdir($dir, 0755, true)){
                    return false;
                }
            }
            $pdfString = $mpdf->Output($fileName, 'S');
            file_put_contents($saveFullPath, $pdfString);
            return $saveFullPath;
        } else {
            $mpdf->Output($fileName, 'I');
        }
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

    public function saveLocalPDF($year = null, $area = 0, $offset = 0, $limit = 5) {
        $year = $year ?? date("Y");
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $planesAula = $this->PlanAreas_Model->get_by_filter($area, null, null, $year);
        $baseRel = 'principal/plan_aula/PLAN DE AULA ' . $year . '/';
        $baseFull = rtrim(FCPATH, '/\\') . '/' . trim($baseRel, '/\\') . '/';

        if($planesAula){
            $planAulaList = array_values($planesAula);
            $total = count($planAulaList);
            $offset = intval($offset);
            $limit = intval($limit);
            $chunk = array_slice($planAulaList, $offset, $limit);
            $processed = 0;
            $errors    = [];

            foreach ($chunk as $item) {
                $processed++;
                // Crear carpeta: baseRel/nomarea/nommateria/grado/
                $nomarea = isset($item['nomarea']) ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $item['nomarea']) : 'area';
                $nommateria = isset($item['nommateria']) ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $item['nommateria']) : 'materia';
                $grado = isset($item['grado']) ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $item['grado']) : 'grado';
                $folderRel = rtrim($baseRel, '/\\') . '/' . $nomarea . '/' . $nommateria . '/' . $grado . '/';
                $folderFull = rtrim(FCPATH, '/\\') . '/' . trim($folderRel, '/\\') . '/';
                if (!is_dir($folderFull)) {
                    if (!mkdir($folderFull, 0755, true)) {
                        $errors[] = "No se pudo crear carpeta: $folderFull";
                        continue;
                    }
                }
                // Llamar a ver para guardar el PDF en la carpeta
                $idPlanAula = isset($item['id_plan_area']) ? $item['id_plan_area'] : (isset($item['id']) ? $item['id'] : null);
                if ($idPlanAula) {
                    try {
                        $this->ver($idPlanAula, 'save', $folderFull);
                    } catch (Exception $e) {
                        $errors[] = "Error al generar PDF para PlanAula $idPlanAula: " . $e->getMessage();
                    }
                } else {
                    $errors[] = "No se encontró id_plan_area para el item.";
                }
            }
        }


        // Devuelve el total para el frontend
        json_response([
            'status' => empty($errors) ? 'ok' : 'partial',
            'processed' => $processed?? 0,
            'errors_count' => count($errors?? []),
            'errors' => $errors?? [],
            'base_path' => $baseFull,
            'total' => $total?? 0,
            'offset' => $offset,
            'limit' => $limit,
            'planes' => $planesAula
        ], true);
    }
}
