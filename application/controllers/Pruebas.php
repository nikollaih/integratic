<?php
  
   class Pruebas extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(["Pruebas_Model", "TipoPrueba_Model", "Consultas_Model", "AlcancePruebas_Model", "Materias_Model", "Preguntas_Model"]);
    }
    
    public function index(){
        $params["pruebas"] = $this->Pruebas_Model->get_all();
        $this->load->view("pruebas/home", $params);
    }

    public function crearPrueba(){
        $params["tipo_pruebas"] = $this->TipoPrueba_Model->get_all();
        $params["alcance_prueba"] = $this->AlcancePruebas_Model->get_all();
        $params["materias"] = $this->Consultas_Model->get_materias_diff();

        if($this->input->post()){
            $params["message"] = $this->guardarPrueba($this->input->post());
        }

        $this->load->view("pruebas/crear_prueba", $params);
    }

    function guardarPrueba($post){
        $prueba = $post["prueba"];
        $prueba["materias"] = serialize($prueba["materias"]);
        $prueba["dificultad"] = serialize($prueba["dificultad"]);

        $id_prueba = $this->Pruebas_Model->create($prueba);

        if($id_prueba){
            if($post["asignacion_preguntas"] == 1){
                return asignar_preguntas_prueba($id_prueba);
            }

            return array("type" => "success", "message" => "Prueba guardada exitosamente.", "success" => true);
        }
        else{
            return array("type" => "danger", "message" => "No se ha podido crear la prueba, intente de nuevo más tarde.", "success" => false);
        }
    }

    function ver($id_prueba){
        $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
        $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
        $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
        $params["preguntas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $this->load->view("pruebas/ver_prueba", $params);
    }
} 
