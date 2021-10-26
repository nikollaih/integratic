<?php
    if(!function_exists('respuestas_actividad'))
    {
        function respuestas_actividad($actividad = null, $estudiante = null){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Actividades_Model"));
            return $CI->Actividades_Model->get_activity_response($actividad,  $estudiante);
        }
    
    }
?>