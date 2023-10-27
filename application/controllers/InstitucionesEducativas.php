<?php
// Contenido del fichero /application/controllers/jugadores.php 
defined('BASEPATH') OR exit('No direct script access allowed');   

class InstitucionesEducativas extends CI_Controller {       
  	public function __construct(){ 
    	parent::__construct();    
        $this->load->model(["Instituciones_Educativas_Model", "Municipios_Model"]);     
  	}

    public function index($municipio = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "super"){
                $params["selected_municipio"] = $municipio;
                $params["municipios"] = $this->Municipios_Model->get_all();
                if(isset($_FILES["instituciones"])){
                    $data = $this->input->post();
                    $instituciones = importar_instituciones($_FILES, $data["municipio"]);
                    if(is_array($instituciones)){
                        if ($this->Instituciones_Educativas_Model->insert_multiple($instituciones)){
							$params["message"]["message"] = "Instituciones educativas importadas correctamente";
							$params["message"]["type"] = "success";
						}
						else{
							$params["message"]["message"] = "No se han podido importar las instituciones educativas";
							$params["message"]["type"] = "error";
						}
                    }
                }

                if(is_array($params["municipios"])){
                    $params["instituciones"] = ($municipio == null) ? $this->Instituciones_Educativas_Model->get_by_municipio($params["municipios"][0]["id_municipio"]) : $this->Instituciones_Educativas_Model->get_by_municipio($municipio); 
                }

                $this->load->view("instituciones_educativas/index", $params);
            }
            else{
                header("Location: ".base_url());
            }
        }
        else{
            header("Location: ".base_url());
        }
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