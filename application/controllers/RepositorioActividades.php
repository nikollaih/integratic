<?php

class RepositorioActividades extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['RepositorioActividades_Model']);
    }

    // Obtiene la lista de actividades en la tabla de repositorio
    public function getByMateria(){
        // Verifica que exista un usuario logueado en el sistema
        if(is_logged()){
             $LOWERCASE_ROLE = strtolower(logged_user()["rol"]);
             // Valida los permisos del usuario logueado
             if($LOWERCASE_ROLE === 'docente' || $LOWERCASE_ROLE === 'coordinador'){
                 // Devuelve la lista de actividades
                 $actividades = $this->RepositorioActividades_Model->getByMateria($this->session->userdata("materia_grupo")["materia"]);
                 json_response($actividades, true, "Lista de actividades");
             }
             else json_response(null, false, "No tiene permisos para realizar esta acción");
        }
        else json_response(["error" => "auth"], false, "Debe iniciar sesión para continuar");
    }
}