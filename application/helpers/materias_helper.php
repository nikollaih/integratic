<?php
if(!function_exists('get_materia_promedio'))
{
    function get_materia_promedio($id_materia){
        $CI = &get_instance();
        $CI->load->model("Preguntas_Model");
        
        $correctas = $CI->Preguntas_Model->get_cantidad_correctas_incorrectas_by_materia($id_materia);
        $incorrectas = $CI->Preguntas_Model->get_cantidad_correctas_incorrectas_by_materia($id_materia, 0);

        $respuesta["correctas"] = ($correctas) ? count($correctas) : 0;
        $respuesta["incorrectas"] = ($incorrectas) ? count($incorrectas) : 0;
        $respuesta["total"] = $respuesta["correctas"] + $respuesta["incorrectas"];
        $respuesta["promedio"] = ($respuesta["total"] > 0) ? round(($respuesta["correctas"] / $respuesta["total"]) * 100, 2) : 0;
        return $respuesta;
    }

}