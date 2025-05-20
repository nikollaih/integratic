<?php

/**
 * @property $load
 * @property $TipoComponenteEvidencia_Model
 * @property $input
 */
class EvidenciasAprendizajeComponentes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['TipoComponenteEvidencia_Model']);
    }

    public function index(){
        if(is_logged()){
            if(logged_user()["rol"] === "super"){
                $params["componentes"] = $this->TipoComponenteEvidencia_Model->getAll(true);
                $this->load->view('evidencias_aprendizaje_componentes/index', $params);
            }
            else header("Location:".base_url());
        }
        else header("Location:".base_url());
    }

    public function agregar(){
        if(is_logged()){
            if(logged_user()["rol"] === "super") {
                $params = [];
                if ($this->input->post()) {
                    $params["message"] = $this->saveComponente($this->input->post());
                }
                $this->load->view('evidencias_aprendizaje_componentes/agregar', $params);
            }
            else header("Location:".base_url());
        }
        else header("Location:".base_url());
    }

    public function modificar($idTipoComponente = null){
        if(is_logged()){
            if(logged_user()["rol"] === "super") {
                $params = [];
                $params["componente"] = $this->TipoComponenteEvidencia_Model->find($idTipoComponente);

                if ($params["componente"]) {

                    if ($this->input->post()) {
                        $params["message"] = $this->saveComponente($this->input->post());
                        $params["componente"] = $this->TipoComponenteEvidencia_Model->find($idTipoComponente);
                    }

                    $this->load->view('evidencias_aprendizaje_componentes/agregar', $params);
                } else header("Location:" . base_url() . '/EvidenciasAprendizajeComponentes');
            }
            else header("Location:".base_url());
        }
        else header("Location:".base_url());
    }

    public function eliminar($idTipoComponente = null){
        if(is_logged()){
            if(logged_user()["rol"] === "super") {
                $exists = $this->TipoComponenteEvidencia_Model->find($idTipoComponente);

                if ($exists) {
                    if ($this->TipoComponenteEvidencia_Model->delete($exists["id_tipo_componente"])) {
                        json_response(null, true, "Componente eliminado correctamente");
                    }
                }
                json_response(null, false, "No se ha podido eliminar el componente");
            }
        }
        json_response(null, false, "No se puede realizar esta acción");
    }

    private function saveComponente($data): array
    {
        $newData["nombre"] = $data["nombre"];
        $newData["descripcion"] = $data["descripcion"];
        $newData["activo"] = $data["activo"];
        $newData["id_tipo_componente"] = $data["id_tipo_componente"];
        $exists = $this->TipoComponenteEvidencia_Model->find($newData["id_tipo_componente"]);

        if($exists){
            if($this->TipoComponenteEvidencia_Model->update($newData)){
                return ["type" => "success", "message" => "Se ha actualizado el componente"];
            }
        }
        else {
            unset($newData["id_tipo_componente"]);
            if($this->TipoComponenteEvidencia_Model->create($newData)){
                return ["type" => "success", "message" => "Se ha creado el componente"];
            }
        }

        return ["type" => "danger", "message" => "Ha ocurrido un error, intente de nuevo más tarde"];
    }
}