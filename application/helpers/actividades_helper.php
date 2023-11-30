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

    function getActivityStatus($actividad) {
        $currentDate = date("Y-m-d h:i a");
        $disponibleHasta = date("Y-m-d h:i a", strtotime($actividad["disponible_hasta"]));
    
        if ($actividad["id_respuestas_actividades"]) return "Entregada";
        if ($actividad["disponible_desde"] > $currentDate) return "No disponible";
        if ($disponibleHasta < $currentDate) return "Vencida";
    
        return "Disponible";
    }
?>