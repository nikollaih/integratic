<?php
    if(!function_exists('obtener_preguntas'))
    {
        function obtener_preguntas($materias = null, $dificultad = null, $only_ids = false, $temas = null){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Preguntas_Model"));
            return $CI->Preguntas_Model->get_all_mat_dif($materias,  $dificultad, $only_ids, $temas);
        }
    
    }

    if(!function_exists('get_pregunta_dificultad'))
    {
        function get_pregunta_dificultad($dificultades): string
        {
            $dificultad_text = "";
            $dificultad = unserialize($dificultades);

            if(is_array($dificultad)){
                for ($i=0; $i < count($dificultad); $i++) {
                    switch ($dificultad[$i]) {
                        case '2':
                            $dificultad_text .= "- Intermedia <br>";
                            break;
                        case '3':
                            $dificultad_text .= "- Avanzada <br>";
                            break;
                        default:
                            $dificultad_text .= "- Facil <br>";
                            break;
                    }
                }
            }

            return $dificultad_text;
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
        function seleccionar_siguiente_pregunta($asignadas, $resueltas_multiples, $resueltas_abiertas){
            $resueltas_multiples = $resueltas_multiples ?: [];
            $resueltas_abiertas = $resueltas_abiertas ?: [];
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Respuestas_Preguntas_Model"));

            $restantes = [];

            foreach ($asignadas as $asignada) {
                $resuelta = false;
                $resueltas = array_merge($resueltas_multiples, $resueltas_abiertas);

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
            $resueltas_abiertas = $CI->RespuestasRealizarPruebaAbiertas_Model->get_by_prueba_participante($id_prueba, $id_participante);

            $preguntas_resueltas = 0;

            if($resueltas){
                $preguntas_resueltas = count($resueltas);
            }

            if($resueltas_abiertas){
                $preguntas_resueltas += count($resueltas_abiertas);
            }

            if($prueba["cantidad_preguntas"] == $preguntas_resueltas){
                return true;
            }
            else{
                return seleccionar_siguiente_pregunta($asignadas, $resueltas, $resueltas_abiertas);
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

    if(!function_exists('excel_respuestas_array'))
    {
        function excel_respuestas_array($FILE){
            $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            if(isset($FILE['archivo_respuestas']['name']) && in_array($FILE['archivo_respuestas']['type'], $file_mimes)) {
                $respuestas = [];
                $arr_file = explode('.', $FILE['archivo_respuestas']['name']);
                $extension = end($arr_file);
                
                if('csv' == $extension){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
        
                $spreadsheet = $reader->load($FILE['archivo_respuestas']['tmp_name']);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
        
                if(is_array($sheetData)){
                    if(count($sheetData) > 1){
                        for ($i=1; $i < count($sheetData); $i++) { 
                            $respuesta = $sheetData[$i];
        
                            $nueva_respuesta["id_pregunta"] = $respuesta[1];
                            $nueva_respuesta["descripcion_respuesta"] = $respuesta[2];
                            $nueva_respuesta["archivo_respuesta"] = $respuesta[3];
                            $nueva_respuesta["nombre_archivo_respuesta"] = $respuesta[4];
                            $nueva_respuesta["tipo_respuesta"] = $respuesta[5];
                            $nueva_respuesta["base64"] = $respuesta[7];
                            array_push($respuestas, $nueva_respuesta);
                        }
                    }
                }
        
                if(count($respuestas)){
                    return $respuestas;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
    
    }

    if(!function_exists('excel_preguntas_array'))
    {
        function excel_preguntas_array($FILE){
            $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            if(isset($FILE['archivo_preguntas']['name']) && in_array($FILE['archivo_preguntas']['type'], $file_mimes)) {
                $preguntas = [];
                $arr_file = explode('.', $FILE['archivo_preguntas']['name']);
                $extension = end($arr_file);
                
                if('csv' == $extension){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
        
                $spreadsheet = $reader->load($FILE['archivo_preguntas']['tmp_name']);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
        
                if(is_array($sheetData)){
                    if(count($sheetData) > 1){
                        for ($i=1; $i < count($sheetData); $i++) { 
                            $pregunta = $sheetData[$i];
        
                            $nueva_pregunta["id_pregunta"] = $pregunta[0];
                            $nueva_pregunta["nombre_author"] = $pregunta[1];
                            $nueva_pregunta["email_author"] = $pregunta[2];
                            $nueva_pregunta["id_materia"] = $pregunta[3];
                            $nueva_pregunta["descripcion_pregunta"] = $pregunta[4];
                            $nueva_pregunta["comentarios_pregunta"] = $pregunta[5];
                            $nueva_pregunta["dificultad"] = $pregunta[6];
                            $nueva_pregunta["archivo"] = $pregunta[7];
                            $nueva_pregunta["nombre_archivo"] = $pregunta[8];
                            $nueva_pregunta["base64"] = $pregunta[10];
                            $nueva_pregunta["tipo_pregunta"] = $pregunta[11];
                            array_push($preguntas, $nueva_pregunta);
                        }
                    }
                }
        
                if(count($preguntas)){
                    return $preguntas;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
    
    }
?>