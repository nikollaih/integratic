<?php
    if(!function_exists('obtener_preguntas'))
    {
        function obtener_preguntas($materias = null, $dificultad = null, $only_ids = false){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Preguntas_Model"));
            return $CI->Preguntas_Model->get_all_mat_dif($materias,  $dificultad, $only_ids);
        }
    
    }

    if(!function_exists('obtener_preguntas_asignadas_prueba'))
    {
        function obtener_preguntas_asignadas_prueba($preguntas, $cantidad_preguntas){
            $preguntas_asignadas = [];

            while (count($preguntas_asignadas) < $cantidad_preguntas) {
                $index = rand(0, count($preguntas) - 1);
                $value = $preguntas[$index]["id_pregunta_prueba"];

                if(!in_array($value, $preguntas_asignadas)){
                    array_push($preguntas_asignadas, $value);
                }
            }

            return $preguntas_asignadas;
        }
    
    }
?>