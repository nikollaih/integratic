<?php

class Configuracion extends CI_Controller {	
    public function __construct() { 
        parent::__construct(); 
        $this->load->model(["Configuracion_Model"]);
    }

    public function index(){
        $params["data"] = $this->Configuracion_Model->getConfiguracion();
        if($this->input->post()){
            $params["message"] = $this->modificarConfiguracion($this->input->post()["data"], $_FILES);
            $params["data"] = $this->Configuracion_Model->getConfiguracion();
        }
        $this->load->view("configuracion/index", $params);
    }

    function modificarConfiguracion($data, $FILES){
        if($data["id_configuracion"] != "null"){
            if($this->Configuracion_Model->updateConfiguracion($data)){
                $this->modificarLogo($FILES, $data["id_configuracion"]);
                return array("type" => "success", "message" => "Información modificada satisfactoriamente.", "success" => true);
            }
            else{
                return array("type" => "danger", "message" => "Ha ocurrido un error al intentar modificar la información, por favor intente de nuevo más tarde.", "success" => false);
            }
        }
        else{
            $id_configuracion = $this->Configuracion_Model->addConfiguracion($data);
            if($id_configuracion){
                $this->modificarLogo($FILES, $id_configuracion);
                return array("type" => "success", "message" => "Información creada satisfactoriamente.", "success" => true);
            }
            else{
                return array("type" => "danger", "message" => "Ha ocurrido un error al intentar guardar la información, por favor intente de nuevo más tarde.", "success" => false);
            }
        }
    }

    function modificarLogo($FILES, $id_configuracion){
        if(isset($FILES["logo"])){
            if(isset($FILES['logo']['name'])) {
                if($FILES['logo']['size'] > 0){
                    $file_name = "logo.".get_file_format($FILES['logo']['name']);
                    $file_tmp =$FILES['logo']['tmp_name'];
                    move_uploaded_file($file_tmp,"img/".$file_name);
                    $this->Configuracion_Model->updateConfiguracion(array("id_configuracion" => $id_configuracion, "logo_institucion" => $file_name));
                }
            }
        }
    }
}