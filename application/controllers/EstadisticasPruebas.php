<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticasPruebas extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model(['Pruebas_Model', 'Preguntas_Model', 'Participantes_Prueba_Model', 'Realizar_Prueba_Model']);
    }

    public function ver(){
        $params["cantidad_pruebas"] = $this->Pruebas_Model->get_count();
        $params["cantidad_preguntas"] = $this->Preguntas_Model->get_count();
        $params["cantidad_participantes"] = $this->Participantes_Prueba_Model->get_count();
        $this->load->view("estadisticas/pruebas", $params);
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