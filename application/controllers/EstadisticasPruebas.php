<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticasPruebas extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model(['Pruebas_Model', 'Preguntas_Model', 'Participantes_Prueba_Model', 'Realizar_Prueba_Model', 'Consultas_Model', 'Materias_Model', 'AlcancePruebas_Model', 'Municipios_Model', 'Areas_Model', 'Materias_Model', 'Instituciones_Educativas_Model']);
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
                $params["municipios"] = $this->Realizar_Prueba_Model->get_by_municipios();
                if(is_array($params["municipios"])){
                    for ($i=0; $i < count($params["municipios"]); $i++) { 
                        $params["municipios"][$i]["aprobadas"] = $this->Realizar_Prueba_Model->get_aprobados_by_municipios($params["municipios"][$i]["id_municipio"]);
                        $params["municipios"][$i]["no_aprobadas"] = $this->Realizar_Prueba_Model->get_aprobados_by_municipios($params["municipios"][$i]["id_municipio"], false);
                    }
                }
                $this->load->view("estadisticas/municipios", $params);
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function instituciones($idMunicipio){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $params["municipio"] =  $this->Municipios_Model->find($idMunicipio);
                $params["instituciones"] = $this->Realizar_Prueba_Model->get_by_instituciones($idMunicipio);
                if(is_array($params["instituciones"])){
                    for ($i=0; $i < count($params["instituciones"]); $i++) { 
                        $params["instituciones"][$i]["aprobadas"] = $this->Realizar_Prueba_Model->get_aprobados_by_instituciones($params["instituciones"][$i]["id_institucion_educativa"]);
                        $params["instituciones"][$i]["no_aprobadas"] = $this->Realizar_Prueba_Model->get_aprobados_by_instituciones($params["instituciones"][$i]["id_institucion_educativa"], false);
                    }
                }
                
                $this->load->view("estadisticas/instituciones", $params);
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function areas($grado = "0", $institucion = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $params["institucion"] = $this->Instituciones_Educativas_Model->find($institucion);
                $params["grado"] = $grado;
                $pruebas = $this->Pruebas_Model->get_by_grado($grado, $institucion);
                $materias = [-1];
                if(is_array($pruebas)){
                    foreach ($pruebas as $prueba) {
                        $materias = array_unique (array_merge ($materias, unserialize($prueba["materias"])));
                    }
                }

                $params["areas"] = $this->Areas_Model->get_by_materias($materias);
                if(is_array($params["areas"])){
                    for ($i=0; $i < count($params["areas"]); $i++) { 
                        $materias_area = $this->Materias_Model->getMateriasArea($params["areas"][$i]["codarea"]);
                        $materias_area_ids = [];
                        if(is_array($materias_area)){
                            for ($j=0; $j < count($materias_area); $j++) { 
                                array_push($materias_area_ids, $materias_area[$j]["codmateria"]);
                            }
                        }

                        $params["areas"][$i]["aprobadas"] = $this->Realizar_Prueba_Model->get_aprobados_by_grado_area($grado, $materias_area_ids, true, $institucion);
                        $params["areas"][$i]["no_aprobadas"] = $this->Realizar_Prueba_Model->get_aprobados_by_grado_area($grado, $materias_area_ids, false, $institucion);
                    }
                }
                $this->load->view("estadisticas/areas", $params);
            }
        }
        else{
            header("Location: ".base_url());
        }
    }
}
?>