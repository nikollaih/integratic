<?php

/**
 * @property $load
 * @property $Estudiante_Model
 * @property $Usuarios_Model
 * @property $input
 * @property $PIAR_Model
 */
class PIAR extends CI_Controller
{
    private $USER_ROL;
    public function __construct() {
        parent::__construct();
        $this->load->model(["Estudiante_Model", "Usuarios_Model", "PIAR_Model"]);
        $this->USER_ROL = (is_logged()) ? strtolower(logged_user()["rol"]) : "";
    }

    private function hasPermission(): bool
    {
        return ($this->USER_ROL === "docente" || $this->USER_ROL === "coordinador");
    }

    public function index() {
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiantes"] = $this->PIAR_Model->getStudents();
                $this->load->view("piar/index", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function create($estudianteDocumento = null){
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($estudianteDocumento);

                if(is_array($params["estudiante"]) && $params["estudiante"]["nee"] === "1"){

                    $data = $this->input->post();
                    if($data){
                        $data["id_estudiante"] = $estudianteDocumento;
                        $params["message"] = $this->save($data);
                        if($params["message"]["status"]){
                            header("Location: ".base_url()."Piar/edit/".$params["message"]["id"]);
                        }
                    }

                    $params["docentes"] = $this->Usuarios_Model->get_by_role("docente");
                    $this->load->view("piar/crear", $params);
                }
                else header("Location: ".base_url()."Piar");
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function edit($piarId = null, $isNew = false){
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiante"] = $this->PIAR_Model->get($piarId);

                if(is_array($params["estudiante"]) && $params["estudiante"]["nee"] === "1"){

                    $data = $this->input->post();
                    if($data){
                        $params["message"] = $this->update($piarId, $data);
                        $params["estudiante"] = $this->PIAR_Model->get($piarId);
                    }

                    if($isNew && !$data){
                        $params["message"] = array("status" => true, "type" => "success", "message" => "Formulario creado exitosamente!");
                    }

                    $params["docentes"] = $this->Usuarios_Model->get_by_role("docente");
                    $this->load->view("piar/crear", $params);
                }
                else header("Location: ".base_url()."Piar");
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function view($piarId = null){
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiante"] = $this->PIAR_Model->get($piarId);
                $this->load->view("piar/view", $params);
            }
            else header("Location: ".base_url());
        }
    }

    private function save($data): array
    {
        $created = $this->PIAR_Model->create($data);

        return $created ?
            array("status" => true, "id" => $created) :
            array("status" => false, "type" => "danger", "message" => "No se ha podido crear el formulario");
    }

    private function update($estudianteDocumento, $data): array
    {
        $created = $this->PIAR_Model->update($estudianteDocumento, $data);

        return $created ?
            array("status" => true, "type" => "success", "message" => "Formulario modificado exitosamente!") :
            array("status" => false, "type" => "danger", "message" => "No se ha podido modificar el formulario");
    }
}