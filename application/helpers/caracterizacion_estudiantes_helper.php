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
