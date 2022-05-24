<?php
   class Caracterizacion extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->model(["Caracterizacion_DBA_Model", "Caracterizacion_Areas_Model"]);
    }

    public function DBA(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $params["dbas"] = $this->Caracterizacion_DBA_Model->get_all();
                $this->load->view("caracterizacion/dba/index", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function addDBA($id_dba = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $params["areas"] = $this->Caracterizacion_Areas_Model->get_all();
                $params["data"] = $this->Caracterizacion_DBA_Model->get($id_dba);
                if($this->input->post()){
                    $data = $this->input->post();
                    if($this->Caracterizacion_DBA_Model->get($data["id_dba"])){
                        if($this->Caracterizacion_DBA_Model->update($data)){
                            $params["message"]["message"] = "DBA modificado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar modificar el DBA.";
                            $params["message"]["type"] = "danger";
                        }
                    }
                    else{
                        if($this->Caracterizacion_DBA_Model->create($data)){
                            $params["message"]["message"] = "DBA creado exitosamente.";
                            $params["message"]["type"] = "success";
                        }
                        else{
                            $params["message"]["message"] = "Ha ocurrido un error al intentar crear el DBA.";
                            $params["message"]["type"] = "danger";
                        }
                    }

                    $params["data"] = $this->Caracterizacion_DBA_Model->get($id_dba);
                }

                $this->load->view("caracterizacion/dba/add", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function deleteDBA($id_dba){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $dba = $this->Caracterizacion_DBA_Model->get($id_dba);
                if($dba){
                    if($this->Caracterizacion_DBA_Model->update(array("id_dba" => $dba["id_dba"], "estado" => 0))){
                        json_response(array("error" => false), true, "DBA eliminado correctamente");
                    }
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado el DBA");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }
}
?>