<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportarPreguntasExcel($questions, $materia){
    // TODO validar login
    if(1 == 1){
        if(is_array($questions)){
            $line = 1;
            $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
            $sheet = $spreadsheet->getActiveSheet();
            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $spreadsheet->getDefaultStyle()->getFont()->setSize(10);

            // Set the table titles
            $sheet->setCellValue('A'.$line, 'ID PREGUNTA'); 
            $sheet->setCellValue('B'.$line, 'NOMBRE AUTOR');
            $sheet->setCellValue('C'.$line, 'EMAIL AUTOR');
            $sheet->setCellValue('D'.$line, 'ID MATERIA'); 
            $sheet->setCellValue('E'.$line, 'DESCRIPCION'); 
            $sheet->setCellValue('F'.$line, 'COMENTARIOS'); 
            $sheet->setCellValue('G'.$line, 'DIFICULTAD'); 
            $sheet->setCellValue('H'.$line, 'ARCHIVO'); 
            $sheet->setCellValue('I'.$line, 'NOMBRE ARCHIVO'); 
            $sheet->setCellValue('J'.$line, 'FECHA DE CREACION'); 
            $sheet->setCellValue('K'.$line, 'ARCHIVO');
            $sheet->setCellValue('L'.$line, 'TIPO PREGUNTA');

            $line++;

            foreach ($questions as $q) {
                $file = "";

                if($q["archivo"] && $q["nombre_archivo"] && file_exists("./uploads/preguntas/".$q["archivo"])){
                    $formato = explode(".", $q["nombre_archivo"]);
                    $formato = $formato[count($formato) - 1];
                    $file = "data:image/".$formato.";base64,".base64_encode(file_get_contents(base_url()."uploads/preguntas/".$q["archivo"]));
                }
                // Set the winners data
                $sheet->setCellValue('A'.$line, $q["id_pregunta_prueba"]); 
                $sheet->setCellValue('B'.$line, $q["nombre_author"]); 
                $sheet->setCellValue('C'.$line, $q["email_author"]); 
                $sheet->setCellValue('D'.$line, $q["id_materia"]); 
                $sheet->setCellValue('E'.$line, $q["descripcion_pregunta"]); 
                $sheet->setCellValue('F'.$line, $q["comentarios_pregunta"]);
                $sheet->setCellValue('G'.$line, $q["dificultad"]); 
                $sheet->setCellValue('H'.$line, $q["archivo"]);
                $sheet->setCellValue('I'.$line, $q["nombre_archivo"]);
                $sheet->setCellValue('J'.$line, $q["created_at"]);
                $sheet->setCellValue('K'.$line, $file);
                $sheet->setCellValue('L'.$line, $q["tipo_pregunta"]);
                $line++;
            }


            $writer = new Xlsx($spreadsheet); // instantiate Xlsx
    
            $filename = 'Preguntas_'.$materia["nommateria"]."_".$materia["grado"]."_".date("Y_m_d"); // set filename for excel file to be exported
         
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // generate excel file
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $writer->save('php://output');	// download file
        }
        else{
            json_response(null, false, "No hay preguntas seleccionadas.");
        }
    }
    else{
        json_response(null, false, "Usted no puede realizar esta acción.");
    }
}

function exportarRespuestasExcel($answers, $materia){
    // TODO validar login
    if(1 == 1){
        if(is_array($answers)){
            $line = 1;
            $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
            $sheet = $spreadsheet->getActiveSheet();
            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $spreadsheet->getDefaultStyle()->getFont()->setSize(10);

            // Set the table titles
            $sheet->setCellValue('A'.$line, 'ID RESPUESTA'); 
            $sheet->setCellValue('B'.$line, 'ID PREGUNTA');
            $sheet->setCellValue('C'.$line, 'DESCRIPCION');
            $sheet->setCellValue('D'.$line, 'ARCHIVO'); 
            $sheet->setCellValue('E'.$line, 'NOMBRE ARCHIVO'); 
            $sheet->setCellValue('F'.$line, 'TIPO RESPUESTA'); 
            $sheet->setCellValue('G'.$line, 'FECHA DE CREACION');
            $sheet->setCellValue('H'.$line, 'ARCHIVO');

            $line++;

            foreach ($answers as $q) {
                $file = "";
                $formato = "";


                if($q["archivo_respuesta"] && $q["nombre_archivo_respuesta"] && file_exists("./uploads/respuestas/".$q["archivo_respuesta"])){
                    $formato = explode(".", $q["nombre_archivo_respuesta"]);
                    $formato = $formato[count($formato) - 1];
                    $file = "data:image/".$formato.";base64,".base64_encode(file_get_contents(base_url()."uploads/respuestas/".$q["archivo_respuesta"]));
                }
                // Set the winners data
                $sheet->setCellValue('A'.$line, $q["id_respuesta_pregunta_prueba"]); 
                $sheet->setCellValue('B'.$line, $q["id_pregunta"]); 
                $sheet->setCellValue('C'.$line, $q["descripcion_respuesta"]); 
                $sheet->setCellValue('D'.$line, $q["archivo_respuesta"]); 
                $sheet->setCellValue('E'.$line, $q["nombre_archivo_respuesta"]); 
                $sheet->setCellValue('F'.$line, $q["tipo_respuesta"]);
                $sheet->setCellValue('G'.$line, $q["created_at"]);
                $sheet->setCellValue('H'.$line, $file);
                $line++;
            }


            $writer = new Xlsx($spreadsheet); // instantiate Xlsx
    
            $filename = 'Respuestas_'.$materia["nommateria"]."_".$materia["grado"]."_".date("Y-m-d");; // set filename for excel file to be exported
         
            header('Content-Type: application/vnd.ms-excel'); // generate excel file
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $writer->save('php://output');	// download file
        }
        else{
            json_response(null, false, "No hay registros de respuestas.");
        }
    }
    else{
        json_response(null, false, "Usted no puede realizar esta acción.");
    }
}