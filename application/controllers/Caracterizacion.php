<?php
   class Caracterizacion extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->model(["Caracterizacion_Model", "Caracterizacion_DBA_Model", "Caracterizacion_Areas_Model", "Caracterizacion_Lineamientos_Model", "Caracterizacion_Estandar_Competencia_Model"]);
    }

    public function getCaracterizacionAreas(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $areas = $this->Caracterizacion_Areas_Model->get_all();
                json_response($areas, true, "Lista de items.");
            }
            //else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }


    // ========== CARACTERIZACION ========== //
    public function index(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $params["areas"] = $this->Caracterizacion_Areas_Model->get_all();
                $this->load->view("caracterizacion/index", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function add($id_caracterizacion = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                if($this->input->post()){
                    $data = $this->input->post();
                    if($this->Caracterizacion_Model->get($data["id_caracterizacion"])){
                        if($this->Caracterizacion_Model->update($data)){
                            $params["message"]["message"] = "Caracterización de contenido modificado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar modificar la Caracterización de contenido.";
                            $params["message"]["type"] = "danger";
                        }
                    }
                    else{
                        if($this->Caracterizacion_Model->create($data)){
                            $params["message"]["message"] = "Caracterización de contenido creado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar crear la Caracterización de contenido.";
                            $params["message"]["type"] = "danger";
                        }
                    }
                }
                $params["data"] = $this->Caracterizacion_Model->get($id_caracterizacion);
                $params["dbas"] = $this->Caracterizacion_DBA_Model->get_all();
                $params["areas"] = $this->Caracterizacion_Areas_Model->get_all();
                $params["lineamientos"] = $this->Caracterizacion_Lineamientos_Model->get_all();
                $params["estandares"] = $this->Caracterizacion_Estandar_Competencia_Model->get_all();
                $this->load->view("caracterizacion/add", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

   /**
    * It gets the data from the database and returns it in a json format.
    * </code>
    */
    public function getSelectsData(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $id_area = $this->input->post()["area"];
                $grado = $this->input->post()["grado"];
                $params["dbas"] = $this->Caracterizacion_DBA_Model->get_all_area_grado($id_area, $grado);
                $params["lineamientos"] = $this->Caracterizacion_Lineamientos_Model->get_all_area_grado($id_area, $grado);
                $params["estandares"] = $this->Caracterizacion_Estandar_Competencia_Model->get_all_area_grado($id_area, $grado);
                json_response($params, true, "Lista de items.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }

    public function getContenidoData(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $id_area = $this->input->post()["area"];
                $grado = $this->input->post()["grado"];
                $params["contenido"] = $this->Caracterizacion_Model->get_all_area_grado($id_area, $grado);
                json_response($params, true, "Lista de items.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }


    // ============== DBA ============= //
    public function DBA(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $params["dbas"] = $this->Caracterizacion_DBA_Model->get_all();
                $this->load->view("caracterizacion/dba/index", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function addDBA($id_dba = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $params["areas"] = $this->Caracterizacion_Areas_Model->get_all("dba");
                $params["data"] = $this->Caracterizacion_DBA_Model->get($id_dba);
                if($this->input->post()){
                    $data = $this->input->post();
                    if($this->Caracterizacion_DBA_Model->get($data["id_dba"])){
                        $data["grado"] = serialize($data["grado"]);
                        if($this->Caracterizacion_DBA_Model->update($data)){
                            $params["message"]["message"] = "DBA modificado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar modificar el DBA.";
                            $params["message"]["type"] = "danger";
                        }
                    }
                    else{
                        $data["grado"] = serialize($data["grado"]);
                        if($this->Caracterizacion_DBA_Model->create($data)){
                            $params["message"]["message"] = "DBA creado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar crear el DBA.";
                            $params["message"]["type"] = "danger";
                        }
                    }

                    $params["data"] = $this->Caracterizacion_DBA_Model->get($id_dba);
                }

                $this->load->view("caracterizacion/dba/add", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function deleteDBA($id_dba){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $dba = $this->Caracterizacion_DBA_Model->get($id_dba);
                if($dba){
                    if($this->Caracterizacion_DBA_Model->update(array("id_dba" => $dba["id_dba"], "estado" => 0))){
                        json_response(array("error" => false), true, "DBA eliminado correctamente");
                    }
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado el DBA");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }


    // ============== LINEAMIENTO CURRICULAR ============= //
    public function lineamientoCurricular(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $params["lineamientos"] = $this->Caracterizacion_Lineamientos_Model->get_all();
                $this->load->view("caracterizacion/lineamientos/index", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function addLineamientoCurricular($id_lineamiento_curricular = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $params["areas"] = $this->Caracterizacion_Areas_Model->get_all("lc");
                $params["data"] = $this->Caracterizacion_Lineamientos_Model->get($id_lineamiento_curricular);
                if($this->input->post()){
                    $data = $this->input->post();
                    if($this->Caracterizacion_Lineamientos_Model->get($data["id_lineamiento_curricular"])){
                        if($this->Caracterizacion_Lineamientos_Model->update($data)){
                            $params["message"]["message"] = "Lineamiento curricular modificado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar modificar el lineamiento curricular.";
                            $params["message"]["type"] = "danger";
                        }
                    }
                    else{
                        if($this->Caracterizacion_Lineamientos_Model->create($data)){
                            $params["message"]["message"] = "Lineamiento curricular creado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar crear el lineamiento curricular.";
                            $params["message"]["type"] = "danger";
                        }
                    }

                    $params["data"] = $this->Caracterizacion_Lineamientos_Model->get($id_lineamiento_curricular);
                }

                $this->load->view("caracterizacion/lineamientos/add", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function deleteLineamientoCurricular($id_lineamiento_curricular){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $lineamiento_curricular = $this->Caracterizacion_Lineamientos_Model->get($id_lineamiento_curricular);
                if($lineamiento_curricular){
                    if($this->Caracterizacion_Lineamientos_Model->update(array("id_lineamiento_curricular" => $lineamiento_curricular["id_lineamiento_curricular"], "estado" => 0))){
                        json_response(array("error" => false), true, "Lineamiento curricular eliminado correctamente");
                    }
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado el lineamiento curricular");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }


    // ============== ESTANDAR DE COMPETENCIAS ============= //
    public function estandarCompetencia(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $params["estandares"] = $this->Caracterizacion_Estandar_Competencia_Model->get_all();
                $this->load->view("caracterizacion/estandar/index", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function addEstandarCompetencia($id_estandar = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $params["areas"] = $this->Caracterizacion_Areas_Model->get_all("ec");
                $params["data"] = $this->Caracterizacion_Estandar_Competencia_Model->get($id_estandar);
                if($this->input->post()){
                    $data = $this->input->post();
                    if($this->Caracterizacion_Estandar_Competencia_Model->get($data["id_estandar"])){
                        $data["grado"] = serialize($data["grado"]);
                        if($this->Caracterizacion_Estandar_Competencia_Model->update($data)){
                            $params["message"]["message"] = "Estandar de competencia modificado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar modificar el Estandar de competencia.";
                            $params["message"]["type"] = "danger";
                        }
                    }
                    else{
                        $data["grado"] = serialize($data["grado"]);
                        if($this->Caracterizacion_Estandar_Competencia_Model->create($data)){
                            $params["message"]["message"] = "Estandar de competencia creado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar crear el Estandar de competencia.";
                            $params["message"]["type"] = "danger";
                        }
                    }

                    $params["data"] = $this->Caracterizacion_Estandar_Competencia_Model->get($id_estandar);
                }

                $this->load->view("caracterizacion/estandar/add", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function deleteEstandarCompetencia($id_estandar){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $estandar = $this->Caracterizacion_Estandar_Competencia_Model->get($id_estandar);
                if($estandar){
                    if($this->Caracterizacion_Estandar_Competencia_Model->update(array("id_estandar" => $estandar["id_estandar"], "estado" => 0))){
                        json_response(array("error" => false), true, "Estandar de competencia eliminado correctamente");
                    }
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado el Estandar de competencia");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }

    public function updateDB(){
        $estandares = $this->Caracterizacion_Estandar_Competencia_Model->get_all();
        $dbas = $this->Caracterizacion_DBA_Model->get_all();

        if($estandares){
            foreach ($estandares as $estandar) {
                $estandar["grado"] = serialize([trim($estandar["grado"])]);
                $this->Caracterizacion_Estandar_Competencia_Model->update($estandar);
            }
        }

        if($dbas){
            foreach ($dbas as $dba) {
                $dba["grado"] = serialize([trim($dba["grado"])]);
                $this->Caracterizacion_DBA_Model->update($dba);
            }
        }
    }
}
?>