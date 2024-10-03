<?php

class Recuperaciones extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model(['RecuperacionPruebas_Model', 'Pruebas_Model', 'Recuperacion_Model', 'Estudiante_Model', 'Materias_Model', 'Consultas_Model', 'Periodos_Model', 'Actividades_Model', 'RecuperacionActividades_Model']);
    }

    public function index() {
        if(is_logged()) {
            $userId = logged_user()["id"];
            $params["recuperaciones"] = $this->Recuperacion_Model->getAll($userId);
            $this->load->view("recuperaciones/index", $params);
        }
        else{
            header("Location: ".base_url());
        }
    }

    // Carga el formulario para crear una nueva recuperación
    function create($idRecuperacion = null){
        // Verifica si existe un usuario logueado
        if(is_logged()){
            $userId = logged_user()["id"];
            if($this->input->post()){
                $data = $this->input->post();
                $params["message"] = $this->save($data["recuperacion"]);
            }
            $params["materias"] = $this->Materias_Model->getMateriasDocente($userId);
            $params["grupos"] = $this->Consultas_Model->allGrupos();
            $params["periodos"] = $this->Periodos_Model->getAll();
            $params["recuperacion"] = $this->Recuperacion_Model->find($idRecuperacion);
            $this->load->view("recuperaciones/create", $params);
        }
        else header("Location: ".base_url());
    }

    // Guarda la información de una nueva recuperación
    private function save($recuperacion){
        $recuperacion["created_by"] = logged_user()["id"];
        $existsRecuperacion = $this->Recuperacion_Model->find($recuperacion["id_recuperacion"]);

        if(!$existsRecuperacion){
            unset($recuperacion["id_recuperacion"]);
            $this->Recuperacion_Model->create($recuperacion);
            return array("type" => "success", "message" => "Recuperación creada exitosamente.", "success" => true);
        }
        else{
            $this->Recuperacion_Model->update($recuperacion["id_recuperacion"], $recuperacion);
            return array("type" => "success", "message" => "Recuperación modificada exitosamente.", "success" => true);
        }
    }

    function view($idRecuperacion = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) !== "estudiante"){
                $params["recuperacion"] = $this->Recuperacion_Model->find($idRecuperacion);
                if($params["recuperacion"]) {
                    $params["actividades"] = $this->Recuperacion_Model->getActivities($idRecuperacion);
                    $params["pruebas"] = $this->Recuperacion_Model->getPruebas($idRecuperacion);
                    $params["actividades_disponibles"] = $this->Actividades_Model->getActivitiesRecuperaciones($params["recuperacion"]["materia"], $params["recuperacion"]["grupo"]);
                    $params["pruebas_disponibles"] = $this->Pruebas_Model->getPruebasRecuperaciones($params["recuperacion"]["materia"]);
                    $this->load->view("recuperaciones/view", $params);
                }
                else header("Location: ".base_url().'Recuperaciones');
            }
            else header("Location: ".base_url().'Recuperaciones');
        }
        else header("Location: ".base_url());
    }

    function asignar_actividad_recuperacion() {
        if(is_logged()){
            if($this->input->post()){
                $data = $this->input->post();
                $existsRecuperacion = $this->Recuperacion_Model->find($data["id_recuperacion"]);
                if(is_array($data["actividades"]) && count($data["actividades"]) > 0 && $existsRecuperacion) {
                    $actividadRecuperacion["id_recuperacion"] = $data["id_recuperacion"];
                    foreach($data["actividades"] as $actividad) {
                        $actividadRecuperacion["id_actividad"] = $actividad;
                        $existsRecuperacionActividad = $this->RecuperacionActividades_Model->get($actividadRecuperacion["id_recuperacion"], $actividadRecuperacion["id_actividad"]);
                        if(!$existsRecuperacionActividad) {
                            $this->RecuperacionActividades_Model->create($actividadRecuperacion);
                        }
                    }

                    header("Location: ".base_url()."Recuperaciones/view/".$actividadRecuperacion["id_recuperacion"]);
                }
                else {
                    header("Location: ".base_url()."Recuperaciones");
                }
            }
            else {
                header("Location: ".base_url()."Recuperaciones");
            }
        }
        else header("Location: ".base_url());
    }

    function asignar_prueba_recuperacion() {
        if(is_logged()){
            if($this->input->post()){
                $data = $this->input->post();
                $existsRecuperacion = $this->Recuperacion_Model->find($data["id_recuperacion"]);
                if(is_array($data["pruebas"]) && count($data["pruebas"]) > 0 && $existsRecuperacion) {
                    $actividadRecuperacion["id_recuperacion"] = $data["id_recuperacion"];
                    foreach($data["pruebas"] as $prueba) {
                        $actividadRecuperacion["id_prueba"] = $prueba;
                        $existsRecuperacionActividad = $this->RecuperacionPruebas_Model->get($actividadRecuperacion["id_recuperacion"], $actividadRecuperacion["id_prueba"]);
                        if(!$existsRecuperacionActividad) {
                            $this->RecuperacionPruebas_Model->create($actividadRecuperacion);
                        }
                    }

                    header("Location: ".base_url()."Recuperaciones/view/".$actividadRecuperacion["id_recuperacion"]);
                }
                else {
                    header("Location: ".base_url()."Recuperaciones");
                }
            }
            else {
                header("Location: ".base_url()."Recuperaciones");
            }
        }
        else header("Location: ".base_url());
    }

    function delete(){
        if(is_logged()) {
            // Verifica que no sea un estudiante quien hace la petición
            if(strtolower(logged_user()["rol"]) !== "estudiante"){
                $data = $this->input->post();
                // Verifica que el type sea correcto
                if(isset($data["type"]) && ($data["type"] === "actividad" || $data["type"] === "prueba")) {
                    $type = $data["type"];

                    // Si es una actividad entonces asigna el modelo de actividades, de lo contrario asigna el de pruebas
                    if($type === "actividad") {
                        $model = $this->RecuperacionActividades_Model;
                    }
                    if($type === "prueba") {
                        $model = $this->RecuperacionPruebas_Model;
                    }


                    // Elimina el registro
                    $deleted = $model->delete($data["id_recuperacion"], $data["id_fk"]);

                    // Verifica que el registro haya sido eliminado
                    if($deleted) {
                        json_response($data, true, $type." eliminada satisfactoriamente");
                    }
                    else {
                        json_response(null, false, "No se pudo eliminar el registro");
                    }
                }
                else json_response($data, false, "La información recibida no es correcta");
            }
            else json_response(null, false, "No tiene permisos para realizar esta acción");
        }
        else json_response(null, false, "Inicie sessión para continuar");
    }
}