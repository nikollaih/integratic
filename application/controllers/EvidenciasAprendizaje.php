<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class EvidenciasAprendizaje extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('EvidenciasAprendizaje_Model'));
	}

    function remove($idEvidenciaAprendizaje){
		if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $evidencia = $this->EvidenciasAprendizaje_Model->find($idEvidenciaAprendizaje);

                if($evidencia){
                    if($this->EvidenciasAprendizaje_Model->delete($idEvidenciaAprendizaje)){
                        json_response(array("error" => false), true, "Registro eliminado correctamente");
                    }
                    else json_response(array("error" => "general"), false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado la evidencia de aprendizaje");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
	}
}
