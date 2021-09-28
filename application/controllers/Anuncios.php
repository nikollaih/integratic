<?php
   class Anuncios extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model('Anuncio_Model');
    }

    public function create(){
         // Verificamos si existe un usuario logueado
         if(is_logged()){
            $data["titulo"] = $this->input->post("titulo");
            $data["descripcion"] = $this->input->post("descripcion");
            $data["created_by"] = logged_user()["id"];
            $data["materia"] = $this->session->userdata('materia_grupo')["materia"];
            $data["grupo"] = $this->session->userdata('materia_grupo')["grupo"];

            if($this->Anuncio_Model->create($data)){
                json_response($data, true, "Anuncio creado satisfactoriamente");
            }
            else{
                json_response(null, false, "Ha ocurrido un error, por favor intente de nuevo más tarde.");
            }
        }
        else{
            json_response(null, false, "Usuario no válido.");
        }
    }
     
} 
