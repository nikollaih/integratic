<?php

if(!function_exists("obtener_respuesta_caracterizacion")){
    function obtener_respuesta_caracterizacion($respuestas, $idPregunta){
        $respuestasFiltradas = [];

        if(is_array($respuestas)){
            foreach ($respuestas as $respuesta) {
                if ($respuesta['id_pregunta'] == $idPregunta) {
                    $respuestasFiltradas[] = $respuesta;
                    break; // Rompemos el bucle una vez que encontramos el primer elemento
                }
            }
        }

        if(is_array($respuestasFiltradas) && count($respuestasFiltradas) > 0) {
            return $respuestasFiltradas[0];
        }

        return false;
    }
}

if(!function_exists("count_filters_caracterizacion")){
    function count_filters_caracterizacion($filters): int
    {
        $counter = 0;
        if(is_array($filters)){
            foreach ($filters as $value) {
                if(is_array($value)) {
                    if(count($value) > 0) {
                        $counter ++;
                    }
                }
                else {
                    if(!empty($value)) {
                        $counter ++;
                    }
                }
            }
        }

        return $counter;
    }
}

if(!function_exists("get_respuesta_excel")){
    function get_respuesta_excel($pregunta, $respuesta)
    {
        if(is_array($respuesta)){
            if(isset($respuesta[0])){
                if($respuesta[0]["respuesta_otro"] != ""){
                    return $respuesta[0]["respuesta_otro"];
                }

                if($pregunta["es_multiple"] == "1" || $pregunta["tipo_etiqueta"] == "checkbox") {
                    $customRespuesta = unserialize($respuesta[0]["respuesta"]);
                    return implode(", ", $customRespuesta);
                }

                return $respuesta[0]["respuesta"];
            }
        }

        return "No completo";
    }
}