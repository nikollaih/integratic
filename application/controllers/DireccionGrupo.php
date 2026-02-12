<?php

/**
 * @property $DireccionGrupo_Model
 */
class DireccionGrupo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DireccionGrupo_Model');
    }

    public function guardar() {
        if(is_logged()){
            if($this->input->post()){
                $data = $this->input->post();
                $already_exists = $this->DireccionGrupo_Model->getByDocente($data['docente']);

                if($already_exists){
                    $data["id_direccion_grupo"] = $already_exists["id_direccion_grupo"];
                    $this->DireccionGrupo_Model->update($data);
                }
                else {
                    $this->DireccionGrupo_Model->create($data);
                }

                json_response(null, true, "Dirección de grupo asignada exitosamente.");
            }
            else json_response(null, false, "No es posible realizar esta acción.");
        }
        else json_response(null, false, "Debe iniciar sesión para realizar esta acción.");
    }

    public function get() {
        if(is_logged()){
            $result = $this->DireccionGrupo_Model->get();
            json_response($result, true, "Lista de dirección de grupo.");
        }
        else json_response(null, false, "Debe iniciar sesión para realizar esta acción.");
    }

    public function delete($id) {
        if(is_logged() && strtolower(logged_user()["rol"]) == "super"){
            $result = $this->DireccionGrupo_Model->delete($id);
            if($result) json_response(null, true, "Dirección de grupo eliminada exitosamente.");
            else json_response(null, false, "No es posible eliminar esta dirección de grupo.");
        }
        else json_response(null, false, "Debe iniciar sesión para realizar esta acción.");
    }
}