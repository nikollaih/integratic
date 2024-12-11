<?php

class RespuestasActividades extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Actividades_Model']);
        $this->load->library(['upload', 'zip']);
    }

    public function downloadZIPFile($idActividad) {
        if(logged_user()){
            $USER_ROLE = strtolower(logged_user()['rol']);
            if($USER_ROLE == 'docente'){
                $respuestas = $this->Actividades_Model->get_all_activity_responses($idActividad);

                if($respuestas){
                    foreach ($respuestas as $respuesta) {
                        $FILE_PATH = 'uploads/actividades/respuestas/'.$respuesta['url_archivo'];
                        if(file_exists($FILE_PATH)){
                            // Obtener la extensión del archivo original
                            $file_extension = pathinfo($FILE_PATH, PATHINFO_EXTENSION);
                            $file_name = $respuesta["nombres"].' '.$respuesta["apellidos"].'.'.$file_extension;
                            $this->zip->read_file($FILE_PATH, $file_name);
                        }
                    }

                    // Nombre del archivo ZIP para descargar
                    $zip_filename = string_to_folder_name($respuestas[0]["titulo_actividad"]).'.zip';

                    // Descargar el archivo ZIP
                    $this->zip->download($zip_filename);
                }
            }
            else json_response(null, false, "No tiene permisos para realizar esta acción");
        }
        else json_response(['error' => 'auth'], false, "Debe iniciar sesión para continuar");
    }
}