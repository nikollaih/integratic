<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticasPruebas extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model(['Pruebas_Model', 'Preguntas_Model', 'Participantes_Prueba_Model', 'Realizar_Prueba_Model', 'Consultas_Model', 'Materias_Model']);
    }

    public function ver(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $temp_materias_ids = [];
                $params["materias"] = $this->Materias_Model->getMateriasDocente(logged_user()["id"]);
                if(is_array($params["materias"])){
                    for ($i=0; $i < count($params["materias"]); $i++) { 
                        array_push($temp_materias_ids, $params["materias"][$i]["codmateria"]);
                    }
                }
                $params["cantidad_pruebas"] = $this->Pruebas_Model->get_count_by_materias($temp_materias_ids);
                $params["cantidad_preguntas"] = $this->Preguntas_Model->get_count_by_materias($temp_materias_ids);
                $params["cantidad_participantes"] = $this->Participantes_Prueba_Model->get_count_by_materias($temp_materias_ids);
                $params["pruebas_aprobadas"] = $this->Realizar_Prueba_Model->get_aprobadas($temp_materias_ids);
                $params["pruebas_no_aprobadas"] = $this->Realizar_Prueba_Model->get_aprobadas($temp_materias_ids, false);
                $this->load->view("estadisticas/pruebas", $params);
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    public function participante($identificacion){
        $identificacion = decrypt_string($identificacion, true);
        $params["participante"] = $this->Participantes_Prueba_Model->get($identificacion);

        if($params["participante"]){
            $params["pruebas"] = $this->Realizar_Prueba_Model->get_by_participante($params["participante"]["id_participante_prueba"]);
            $this->load->view("estadisticas/participante_pruebas", $params);
        }
    }
}
?>