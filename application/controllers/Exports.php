<?php
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    class Exports extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(['Actividades_Model', 'Actividades_Model', 'Asignacion_Participantes_Prueba_Model', 'Pruebas_Model', 'Estudiante_Model', 'CaracterizacionEstudiantesPreguntas_Model', 'CaracterizacionEstudiantesRespuestas_Model']);
    }

    public function exportarActividadNotas($id_actividad){
        setlocale(LC_ALL, 'es_ES');
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $grupo_materia = $this->session->userdata("materia_grupo");
                $estudiantes = get_students_by_materia($grupo_materia["materia"], $grupo_materia["grupo"]);
                $actividad = $this->Actividades_Model->get_actividad($id_actividad);

                for ($i=0; $i < count($estudiantes); $i++) { 
                    $estudiantes[$i]["respuesta"] = $this->Actividades_Model->get_activity_response($id_actividad, $estudiantes[$i]["documento"]);
                }

                $line = 1;
                $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
                $sheet = $spreadsheet->getActiveSheet();
                $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
                $spreadsheet->getDefaultStyle()->getFont()->setSize(10);

                // Set the cells dimensions
                $sheet->getColumnDimension('A')->setWidth(50);
                $sheet->getColumnDimension('B')->setWidth(23);

                // Set the table titles
                $sheet->setCellValue('A'.$line, 'Estudiante'); 
                $sheet->setCellValue('B'.$line, 'Calificación');
                $sheet->getStyle("A".$line.":B".$line)->applyFromArray($this->getDocumentTitleStyle());
                $line++;

                if($estudiantes){
                    foreach ($estudiantes as $e) {
                        $calificacion = "1";
                        if(is_array($e["respuesta"])){
                            $calificacion = $e["respuesta"]["calificacion"];
                        }
                        $sheet->setCellValue('A'.$line, $e["nombre"]); 
                        $sheet->setCellValue('B'.$line, $calificacion);
                        $line++;
                    }
                }

                $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        
                $filename = 'Calificaciones_'.str_replace(" ", "_", $actividad["titulo_actividad"]); // set filename for excel file to be exported
             
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8'); // generate excel file
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');       
                header ('Cache-Control: cache, must-revalidate'); 
                 /* Obtenemos los caracteres adicionales o mensajes de advertencia y los
                guardamos en el archivo "depuracion.txt" si tenemos permisos */
                file_put_contents('depuracion.txt', ob_get_contents());
                /* Limpiamos el búfer */
                ob_end_clean();
                $writer->save('php://output');	// download file
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    public function exportarPruebaNotas($id_prueba){
        setlocale(LC_ALL, 'es_ES');
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $prueba = $this->Pruebas_Model->get($id_prueba);
                $participantes = $this->Asignacion_Participantes_Prueba_Model->get_all($id_prueba);

                $line = 1;
                $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
                $sheet = $spreadsheet->getActiveSheet();
                $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
                $spreadsheet->getDefaultStyle()->getFont()->setSize(10);

                // Set the cells dimensions
                $sheet->getColumnDimension('A')->setWidth(18);
                $sheet->getColumnDimension('B')->setWidth(50);
                $sheet->getColumnDimension('C')->setWidth(23);
                $sheet->getColumnDimension('D')->setWidth(23);
                $sheet->getColumnDimension('E')->setWidth(50);
                $sheet->getColumnDimension('F')->setWidth(10);
                $sheet->getColumnDimension('G')->setWidth(10);

                // Set the table titles
                $sheet->setCellValue('A'.$line, 'Identificación'); 
                $sheet->setCellValue('B'.$line, 'Nombre Completo');
                $sheet->setCellValue('C'.$line, 'Teléfono');
                $sheet->setCellValue('D'.$line, 'Email');
                $sheet->setCellValue('E'.$line, 'Institución');
                $sheet->setCellValue('F'.$line, 'Grado');
                $sheet->setCellValue('G'.$line, 'Nota');
                $sheet->getStyle("A".$line.":G".$line)->applyFromArray($this->getDocumentTitleStyle());
                $line++;

                if($participantes){
                    foreach ($participantes as $participante) {
                        $info_prueba = info_prueba_realizada($id_prueba, $participante["id_participante_prueba"]);

                        $sheet->setCellValue('A'.$line, $participante["identificacion"]); 
                        $sheet->setCellValue('B'.$line, $participante["apellidos"]." ".$participante["nombres"]);
                        $sheet->setCellValue('C'.$line, $participante["telefono"]); 
                        $sheet->setCellValue('D'.$line, $participante["email"]);
                        $sheet->setCellValue('E'.$line, ($info_prueba["porcentaje"] == null) ? $participante["institucion"] : $info_prueba["institucion"]); 
                        $sheet->setCellValue('F'.$line, ($info_prueba["porcentaje"] == null) ? $participante["grado"] : $info_prueba["grado"]);
                        $sheet->setCellValue('G'.$line, ($info_prueba["porcentaje"] == null) ? "" : $info_prueba["calificacion"]); 
                        $sheet->getStyle("A".$line.":G".$line)->applyFromArray($this->getItemListStyle());
                        $sheet->getStyle("A".$line)->applyFromArray([
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                                ]
                            ]);
                        $line++;
                    }
                }

                $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        
                $filename = 'Calificaciones_'.str_replace(" ", "_", $prueba["nombre_prueba"]); // set filename for excel file to be exported
             
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8'); // generate excel file
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');       
                header ('Cache-Control: cache, must-revalidate'); 
                 /* Obtenemos los caracteres adicionales o mensajes de advertencia y los
                guardamos en el archivo "depuracion.txt" si tenemos permisos */
                file_put_contents('depuracion.txt', ob_get_contents());
                /* Limpiamos el búfer */
                ob_end_clean();
                $writer->save('php://output');	// download file
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function exportarCaracterizacionEstudiantes($grado) {
        setlocale(LC_ALL, 'es_ES');
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $preguntas = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
                $estudiantes = $this->Estudiante_Model->getStudentsByGrado($grado);
                $line = 1;
                $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
                $sheet = $spreadsheet->getActiveSheet();
                $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
                $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
                $col_index = 0;

                if(is_array($preguntas)){
                    $column = $this->getExcelColumnName($col_index); // Obtener el nombre de la columna basado en el índice
                    $cell = $column . $line; // Combinar columna con número de línea
                    $sheet->setCellValue($cell, "Nombre completo");
                    $col_index++;

                    foreach ($preguntas as $pregunta) {
                        $column = $this->getExcelColumnName($col_index); // Obtener el nombre de la columna basado en el índice
                        $cell = $column . $line; // Combinar columna con número de línea

                        $sheet->setCellValue($cell, $pregunta["titulo_excel"]);
                        // Incrementar el índice de columna
                        $col_index++;
                    }

                    if(is_array($estudiantes)) {
                        foreach ($estudiantes as $estudiante) {
                            $respuestas = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($estudiante["documento"]);
                            $line++;
                            $col_index = 0;
                            $column = $this->getExcelColumnName($col_index);
                            $cell = $column . $line; // Combinar columna con número de línea
                            $sheet->setCellValue($cell, $estudiante["nombre"]);
                            $col_index++;

                            if(is_array($respuestas) ) {
                                for ($i = 0; $i < count($preguntas); $i++) {
                                    // Filtrar los arrays
                                    $filtered = array_filter($respuestas, function($array) use ($preguntas, $i) {
                                        return $array['id_pregunta'] == $preguntas[$i]["id"];
                                    });

                                    $respuesta = get_respuesta_excel($preguntas[$i], array_values($filtered));

                                    $column = $this->getExcelColumnName($col_index); // Obtener el nombre de la columna basado en el índice
                                    $cell = $column . $line; // Combinar columna con número de línea
                                    $sheet->setCellValue($cell, $respuesta);
                                    $col_index++;
                                }
                            }
                        }
                    }
                }

                $filename = "Caracterizacion estudiantes ".$grado;

                // Set the table titles
                $this->exportFile($spreadsheet, $filename);
            }
            else{
                header("Location: ".base_url());
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    // Función para convertir un índice a un nombre de columna de Excel
    function getExcelColumnName($index) {
        $letters = '';
        while ($index >= 0) {
            $letters = chr($index % 26 + 65) . $letters;
            $index = intval($index / 26) - 1;
        }
        return $letters;
    }

    public function exportFile($spreadsheet, $filename) {
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        header('Cache-Control: max-age=0');
        header ('Cache-Control: cache, must-revalidate');
        /* Obtenemos los caracteres adicionales o mensajes de advertencia y los
       guardamos en el archivo "depuracion.txt" si tenemos permisos */
        file_put_contents('depuracion.txt', ob_get_contents());
        /* Limpiamos el búfer */
        ob_end_clean();
        $writer->save('php://output');	// download file
    }
     
    // Define the table headers style
    public function getItemTitleStyle(){
        return [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                ],
            ],
        ];
    }

    // Define the table items style
    function getItemListStyle(){
        return [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
    }

    function getDocumentTitleStyle(){
        return [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                ],
            ],
        ];
    }
} 
