<?php
if(!function_exists('create_notificacion_docente'))
{
    function create_notificacion_docente($materia, $nombre_estudiante, $grado, $nombre_actividad){
        $CI = &get_instance();
        $CI->load->model(["Notificaciones_Model", "Materias_Model"]);
        $materiaData = $CI->Materias_Model->getMateria($materia);

        $notificacion["descripcion"] = "El estudiante <b>$nombre_estudiante</b> del grado <b>$grado</b> ha cargado una respuesta para la actividad <b>$nombre_actividad</b> de <b>".$materiaData['nommateria']."</b>";
        $notificacion["grado"] = $grado;
        $notificacion["materia"] = $materia;

        return $CI->Notificaciones_Model->create($notificacion);
    }

}

if(!function_exists('obtener_contador_notificaciones'))
    {
        function obtener_contador_notificaciones(){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Notificaciones_Model"));
            $user = $CI->session->userdata('logged_in');

            $notificaciones_dom = "";
            if(isset($user["id"])){
                $ultimaFechaAnuncios = $user["ultima_fecha_anuncios"];
                $notificacionesQuery = get_grupos_docente($user["id"]);
                $notificaciones = $CI->Notificaciones_Model->getByDocente($user["id"], $notificacionesQuery, $ultimaFechaAnuncios);
                return ($notificaciones) ? count($notificaciones) : 0;
            }

            return 0;
        }
    
    }

if(!function_exists('docente_notificaciones'))
{
    function docente_notificaciones(){
        $CI = &get_instance();
        $CI->load->library('session');
        $CI->load->model(array("Notificaciones_Model"));
        $user = $CI->session->userdata('logged_in');

        $notificaciones_dom = "";
        if(isset($user["id"])){
            $notificacionesQuery = get_grupos_docente($user["id"]);
            $notificaciones = $CI->Notificaciones_Model->getByDocente($user["id"], $notificacionesQuery);
    
            if($notificaciones){
                foreach ($notificaciones as $notificacion) {
                    $notificaciones_dom .= $CI->load->view("notificaciones/docente", $notificacion, TRUE);
                }
            }
        }

        return $notificaciones_dom;
    }

}
?>