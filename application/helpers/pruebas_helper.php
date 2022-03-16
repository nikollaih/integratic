<?php
    if(!function_exists('asignar_preguntas_prueba'))
    {
        function asignar_preguntas_prueba($id_prueba){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Pruebas_Model", "Asignacion_Preguntas_Prueba_Model"));
            $prueba = $CI->Pruebas_Model->get($id_prueba);

            if($prueba){
                $materias = unserialize($prueba["materias"]);
                $dificultad = unserialize($prueba["dificultad"]);
                $preguntas = obtener_preguntas($materias, $dificultad);
                if($preguntas && count($preguntas) >= $prueba["cantidad_preguntas"]){
                    $asignadas = obtener_preguntas_asignadas_prueba($preguntas, $prueba["cantidad_preguntas"]);
                    $temp_asignadas = [];
                    for ($i=0; $i < count($asignadas); $i++) { 
                        $temp["id_prueba"] = $id_prueba;
                        $temp["id_pregunta"] = $asignadas[$i];

                        array_push($temp_asignadas, $temp);
                    }

                    if($CI->Asignacion_Preguntas_Prueba_Model->create($temp_asignadas)){
                        return array("type" => "success", "message" => "La prueba ha sido creada y las preguntas han sido asignadas correctamente.", "success" => true);
                    }
                    else{
                        return array("type" => "warning", "message" => "La prueba fue creada pero no fue posible asignar las preguntas a la prueba.", "success" => false);
                    }
                }
                else{
                    return array("type" => "warning", "message" => "La prueba fue creada pero la cantidad de preguntas no está disponible para ser asignadas.", "success" => false);
                }
            }
            else{
                return array("type" => "danger", "message" => "Error al intentar crear la prueba.", "success" => false);
            }
        }
    
    }

    if(!function_exists('info_prueba_realizada'))
    {
        function info_prueba_realizada($id_prueba, $id_participante){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Realizar_Prueba_Model", "Asignacion_Preguntas_Prueba_Model", "Preguntas_Model", "Respuestas_Realizar_Prueba_Model"));
            $correctas = 0;
            $preguntas = $CI->Preguntas_Model->get_preguntas_prueba($id_prueba);
            $realizar_prueba = $CI->Realizar_Prueba_Model->get($id_prueba, $id_participante);

            if($realizar_prueba){
                $respuestas = $CI->Respuestas_Realizar_Prueba_Model->get($realizar_prueba["id_realizar_prueba"]);
            }
            else{
                $respuestas = false;
            }

            if($respuestas){
                foreach ($respuestas as $respuesta) {
                    $respuestas_pregunta = obtener_respuestas_pregunta($respuesta["id_pregunta"]);
                    foreach ($respuestas_pregunta as $rp) {
                        if($respuesta["id_respuesta"] == $rp["id_respuesta_pregunta_prueba"] && $rp["tipo_respuesta"] == 1){
                            $correctas++;
                        }
                    }
                }
            }

            $respuesta = array(
                "correctas" => $correctas,
                "total" => count($preguntas),
                "parcial" => ($respuestas) ? count($respuestas) : 0,
                "porcentaje" => ($correctas == 0 && !$respuestas) ? null : number_format((float)($correctas / count($preguntas)) * 100, 1, '.', ''),
                "institucion" => ($realizar_prueba) ? $realizar_prueba["institucion"] : null,
                "grado" => ($realizar_prueba) ? $realizar_prueba["grado"] : null
            );

            return $respuesta;
        }
    
    }
?>