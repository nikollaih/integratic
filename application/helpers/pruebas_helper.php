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
?>