<?php
  
   class Foros extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model('Foro_Model');
    }
    
    public function ver($id_foro){
        $data["foro"] = $this->Foro_Model->get($id_foro);
        $data["respuestas"] = $this->Foro_Model->get_answers($id_foro);
        $this->load->view("foros/ver", $data);
    }

    public function agregar_respuesta($id_foro){
        $foro = $this->Foro_Model->get($id_foro);
        $mensaje = $this->input->post("mensaje");

        $respuesta["id_foro"] = $id_foro;
        $respuesta["created_by"] = logged_user()["id"];
        $respuesta["descripcion"] = $mensaje;

        if($this->Foro_Model->add_answer($respuesta)){
            json_response(null, true, "Respuesta creada exitosamente");
        }
        else{
            json_response(null, true, "Error al intentar crear la respuesta");
        }
    }

} 
