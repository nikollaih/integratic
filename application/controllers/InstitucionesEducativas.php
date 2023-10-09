<?php
// Contenido del fichero /application/controllers/jugadores.php 
defined('BASEPATH') OR exit('No direct script access allowed');   

class InstitucionesEducativas extends CI_Controller {       
  	public function __construct(){ 
    	parent::__construct();    
        $this->load->model(["Instituciones_Educativas_Model"]);     
  	}


  	public function get_by_municipio($id_municipio){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $instituciones = $this->Instituciones_Educativas_Model->get_by_municipio($id_municipio);
                json_response($instituciones, true, "Lista de items.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }
}