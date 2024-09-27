<?php

class Recuperaciones extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model(['Recuperacion_Model', 'Estudiante_Model', 'Materias_Model', 'Consultas_Model', 'Periodos_Model', 'Actividades_Model', 'RecuperacionActividades_Model']);
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
            $params["recuperacion"] = $this->Recuperacion_Model->find($idRecuperacion);
            if($params["recuperacion"]) {
                $params["actividades"] = $this->Recuperacion_Model->getActivities($idRecuperacion);
                $params["actividades_disponibles"] = $this->Actividades_Model->getActivitiesRecuperaciones($params["recuperacion"]["materia"], $params["recuperacion"]["grupo"]);
                $this->load->view("recuperaciones/view", $params);
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
}