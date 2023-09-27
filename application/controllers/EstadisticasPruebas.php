<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticasPruebas extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model(['Pruebas_Model', 'Preguntas_Model', 'Participantes_Prueba_Model', 'Realizar_Prueba_Model', 'Consultas_Model', 'Materias_Model', 'AlcancePruebas_Model']);
    }

    public function ver($alcance = "all"){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $temp_materias_ids = [];
                $params["materias"] = $this->Materias_Model->getMateriasDocente(logged_user()["id"]);
                if(is_array($params["materias"])){
                    for ($i=0; $i < count($params["materias"]); $i++) { 
                        array_push($temp_materias_ids, $params["materias"][$i]["codmateria"]);
                    }
                }
                $params["alcance"] = $alcance;
                $params["alcances"] = $this->AlcancePruebas_Model->get_all();
                $params["cantidad_pruebas"] = $this->Pruebas_Model->get_count_by_materias($temp_materias_ids, $alcance);
                $params["cantidad_preguntas"] = $this->Preguntas_Model->get_count_by_materias($temp_materias_ids);
                $params["cantidad_participantes"] = $this->Participantes_Prueba_Model->get_count_by_materias($temp_materias_ids, $alcance);
                $params["pruebas_aprobadas"] = $this->Realizar_Prueba_Model->get_aprobadas($temp_materias_ids, true, $alcance);
                $params["pruebas_no_aprobadas"] = $this->Realizar_Prueba_Model->get_aprobadas($temp_materias_ids, false, $alcance);
                $this->load->view("estadisticas/pruebas", $params);
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    public function participante($identificacion){
        $params["participante"] = $this->Participantes_Prueba_Model->get($identificacion);

        if($params["participante"]){
            $params["pruebas"] = $this->Realizar_Prueba_Model->get_by_participante($params["participante"]["id_participante_prueba"]);
            $this->load->view("estadisticas/participante_pruebas", $params);
        }
    }

    function municipios(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $this->load->view("estadisticas/municipios");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function instituciones($municipio){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $params["municipio"] = $municipio;
                $this->load->view("estadisticas/instituciones", $params);
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function areas($institucion){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $params["institucion"] = $institucion;
                $this->load->view("estadisticas/areas", $params);
            }
        }
        else{
            header("Location: ".base_url());
        }
    }
}
?>