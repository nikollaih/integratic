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
            $data["id_anuncio"] = $this->input->post("id_anuncio");
            $data["titulo"] = $this->input->post("titulo");
            $data["descripcion"] = $this->input->post("descripcion");
            $data["created_by"] = logged_user()["id"];
            $data["materia"] = $this->session->userdata('materia_grupo')["materia"];
            $data["grupo"] = $this->session->userdata('materia_grupo')["grupo"];

            $anuncio = $this->Anuncio_Model->get($data["id_anuncio"]);

            if($anuncio){
                if($this->Anuncio_Model->update($data))
                    json_response($data, true, "Anuncio modificado satisfactoriamente");
            }
            else {
                if($this->Anuncio_Model->create($data))
                    json_response($data, true, "Anuncio creado satisfactoriamente");
            }

            json_response(null, false, "Ha ocurrido un error, por favor intente de nuevo más tarde.");
        }
        else{
            json_response(null, false, "Usuario no válido.");
        }
    }

    // Eliminar anuncio
    function delete($id_anuncio){
        if(is_logged()){
            $anuncio = $this->Anuncio_Model->get($id_anuncio);
            if($anuncio){
                if($anuncio["created_by"] == logged_user()["id"]){
                    if($this->Anuncio_Model->delete($id_anuncio)){
                        json_response(null, true, "Anuncio eliminado exitosamente.");
                    }
                }
                else{
                    json_response(null, false, "No tiene permisos para eliminar el anuncio.");
                }
            }
            else{
                json_response(null, false, "El anuncio no existe.");
            }
        }
        else{
            json_response(null, false, "Usuario no válido.");
        }
    }

    // Obtener anuncio
    function getAnuncio($id_anuncio){
        if(is_logged()){
            $anuncio = $this->Anuncio_Model->get($id_anuncio);
            if($anuncio)
                json_response($anuncio, true, "Anuncio.");
            else
                json_response(null, false, "El anuncio no existe.");
        }
        else{
            json_response(null, false, "Usuario no válido.");
        }
    }
     
} 
