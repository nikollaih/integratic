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

    if(!function_exists('seleccionar_siguiente_pregunta'))
    {
        function seleccionar_siguiente_pregunta($asignadas, $resueltas){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Respuestas_Preguntas_Model"));

            $restantes = [];
            foreach ($asignadas as $asignada) {
                $resuelta = false;

                if($resueltas){
                    for ($i=0; $i < count($resueltas); $i++) { 
                        if($asignada["id_pregunta_prueba"] == $resueltas[$i]["id_pregunta"]){
                            $resuelta = true;
                            $i = count($resueltas);
                        }
                    }

                    if(!$resuelta){
                        array_push($restantes, $asignada);
                    }
                }
                else{
                    array_push($restantes, $asignada);
                }
            }

            if(count($restantes)){
                $siguiente["pregunta"] = $restantes[intval(rand(0, count($restantes) - 1))];
                $siguiente["respuestas"] = $CI->Respuestas_Preguntas_Model->get_all($siguiente["pregunta"]["id_pregunta"]);
                return $siguiente;
            }
            else{
                return false;
            }
        }
    
    }

    if(!function_exists('siguiente_pregunta'))
    {
        function siguiente_pregunta($id_prueba, $id_participante){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Pruebas_Model", "Preguntas_Model", "Respuestas_Realizar_Prueba_Model"));
            
            $prueba = $CI->Pruebas_Model->get($id_prueba);
            $asignadas = $CI->Preguntas_Model->get_preguntas_prueba($id_prueba);
            $resueltas = $CI->Respuestas_Realizar_Prueba_Model->get_by_prueba_participante($id_prueba, $id_participante);

            if($resueltas && $prueba["cantidad_preguntas"] == count($resueltas)){
                return true;
            }
            else{
                return seleccionar_siguiente_pregunta($asignadas, $resueltas);
            }
        }
    
    }

    if(!function_exists('obtener_respuestas_pregunta'))
    {
        function obtener_respuestas_pregunta($id_pregunta){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Respuestas_Preguntas_Model"));
            
            return $CI->Respuestas_Preguntas_Model->get_all($id_pregunta);
        }
    
    }
?>