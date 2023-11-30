<?php
   class Calendario extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(['Actividades_Model', 'Materias_Model', 'Periodos_Model']);
    }

    // Shows the activities calendar
    function actividades(){
        if(is_logged()){
            $grado = $this->session->userdata()["logged_in"]["grado"];
            $grupo = $this->session->userdata()["logged_in"]["grupo"];

            $params["materias"] = $this->Materias_Model->getMateriasGrupoGrado($grado, $grupo);
            $params["periodos"] = $this->Periodos_Model->getAll();
            $this->load->view("calendario/actividades", $params);
        }
        else header("Location: ".base_url());

    }

    // Get the activities list base on parameters
    function getActividadesList(){
        if(is_logged()){
            $materia = null;
            $periodo = null;
            $grado = $this->session->userdata()["logged_in"]["grado"];
            $grupo = $this->session->userdata()["logged_in"]["grupo"];
            
            if($this->input->post()){
                $materia = $this->input->post("id_materia");
                $periodo = $this->input->post("id_periodo");
            }

            $actividades = $this->Actividades_Model->get_all_for_students($materia, $periodo, $grupo, $grado);
            json_response($actividades, true, "Lista de actividades");
        }
        else json_response(null, false, "Por favor inicie sesion");
    }
}

?>