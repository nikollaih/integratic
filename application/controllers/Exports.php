<?php
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    /**
     * @property $PIAR_Model
     */
class Exports extends CI_Controller {

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(['PIAR_Item_Model', 'PIAR_Actividad_Model', 'AjustesRazonables_Model', 'Barreras_Model', 'Caracterizacion_DBA_Model', 'Areas_Model', 'PIAR_Model', 'Actividades_Model', 'Actividades_Model', 'Asignacion_Participantes_Prueba_Model', 'Pruebas_Model', 'Estudiante_Model', 'CaracterizacionEstudiantesPreguntas_Model', 'CaracterizacionEstudiantesRespuestas_Model', 'Materias_Model']);
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


    public function exportarAnexo1Piar($piarId) {
        setlocale(LC_ALL, 'es_ES');
        if (!is_logged()) {
            header("Location: " . base_url());
            return;
        }

        if (strtolower(logged_user()["rol"]) !== "docente") {
            // podrías redirigir o devolver un error si hace falta
            return;
        }

        $piar = $this->PIAR_Model->get($piarId);
        $estudiante = $this->Estudiante_Model->getStudentUserByDocument($piar["documento"]);
        $preguntas = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
        $respuestas = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($piar["documento"]);

        $line = 1;
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(10);

        /* -----------------------------
           Helpers y estilos mejorados
           ----------------------------- */

        $setColsWidth = function($sheet, $cols, $width = 20) {
            foreach ($cols as $c) {
                $sheet->getColumnDimension($c)->setWidth($width);
            }
        };

        // Calcula y aplica altura de fila según número de líneas (minHeight en puntos)
        $setRowHeightAuto = function($sheet, $line, $text, $minHeight = 18, $lineHeight = 15) {
            $lines = max(1, substr_count((string)$text, "\n") + 1);
            $height = max($minHeight, $lines * $lineHeight);
            $sheet->getRowDimension($line)->setRowHeight($height);
        };

        // Bordes suaves y relleno de sección
        $baseBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD'],
                ],
            ],
        ];

        $sectionFill = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F6F9FC'],
            ],
        ];

        $styles = [
            'title' => array_merge($this->getDocumentTitleStyle(), $sectionFill),
            'item'  => $this->getItemListStyle(),
            'bordered' => $baseBorders,
        ];

        /**
         * addMerged mejorado:
         * - acepta $text como string o como ['label'=>'..','value'=>'..'] para usar RichText
         * - activa wrapText si detecta \n
         * - ajusta altura de fila
         */
        $addMerged = function($sheet, $startCol, $endCol, &$line, $text = null, $style = null, $minRowHeight = 18) use ($setRowHeightAuto) {
            $range = $startCol . $line . ':' . $endCol . $line;
            $sheet->mergeCells($range);

            $calcText = '';

            if (is_array($text) && isset($text['label']) && array_key_exists('value', $text)) {
                $label = (string)$text['label'];
                $value = (string)$text['value'];

                $rich = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
                $runLabel = $rich->createTextRun($label . ': ');
                $runLabel->getFont()->setBold(true);
                $rich->createTextRun($value);

                $sheet->getCell($startCol . $line)->setValue($rich);
                $calcText = $label . ': ' . $value;
            } else {
                $sheet->setCellValue($startCol . $line, (string)$text);
                $calcText = (string)$text;
            }

            if ($style) {
                $sheet->getStyle($range)->applyFromArray($style);
            }

            // activar wrap text si texto contiene salto de linea
            $sheet->getStyle($range)->getAlignment()->setWrapText(true);

            // Alinear verticalmente al centro por defecto
            $sheet->getStyle($range)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Ajustar altura acorde al contenido
            $setRowHeightAuto($sheet, $line, $calcText, $minRowHeight);
        };

        /**
         * addTwoMergedColumns mejorado:
         * - left y right pueden ser strings o arrays ['label'=>'..','value'=>'..']
         */
        $addTwoMergedColumns = function($sheet, &$line, $left, $right, $style = null, $minRowHeight = 18) use ($addMerged) {
            $addMerged($sheet, 'A', 'C', $line, $left, $style, $minRowHeight);
            $addMerged($sheet, 'D', 'F', $line, $right, $style, $minRowHeight);
        };

        // Aplicar anchos de columnas A..F (ajusta valores si necesitas)
        $setColsWidth($sheet, ['A','B','C','D','E','F'], 22);
        // hacer E y F un poco más anchas para emails largos
        $setColsWidth($sheet, ['E','F'], 28);

        /* -----------------------------
           Construcción del documento
           ----------------------------- */

        // 1. Título principal
        $addMerged($sheet, 'A', 'F', $line, 'INFORMACIÓN GENERAL DEL ESTUDIANTE (ANEXO 1)', $styles['title'], 26);
        $line++;

        // Fecha y lugar
        $fechaLugar = isset($piar["fecha_elaboracion"]) ? $piar["fecha_elaboracion"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Fecha y Lugar de Diligenciamiento', 'value' => $fechaLugar], '', $styles['item']);
        $line++;

        // Nombre y rol que diligencia (se dejan en blanco para rellenar manualmente si se requiere)
        $addTwoMergedColumns($sheet, $line, 'Nombre de la persona que diligencia:', 'Rol que desempeña en la SE o la IE:', $styles['item']);
        $line += 2;

        // 1. INFORMACIÓN GENERAL DEL ESTUDIANTE (sección)
        $addMerged($sheet, 'A', 'F', $line, '1. INFORMACIÓN GENERAL DEL ESTUDIANTE', $styles['title'], 22);
        $line += 2;

        // Nombres / Apellidos
        $nombres = isset($estudiante["nombres"]) ? $estudiante["nombres"] : '';
        $apellidos = isset($estudiante["apellidos"]) ? $estudiante["apellidos"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Nombres', 'value' => $nombres], ['label' => 'Apellidos', 'value' => $apellidos], $styles['item']);
        $line++;

        // Lugar nacimiento / Edad / Fecha nacimiento
        $lugarNacimiento = isset($piar["lugar_nacimiento"]) ? $piar["lugar_nacimiento"] : '';
        $fechaNacimiento = isset($piar["fecha_nacimiento"]) ? $piar["fecha_nacimiento"] : '';
        $edad = ($fechaNacimiento) ? get_years($fechaNacimiento, date("Y-m-d")) : '';
        $addMerged($sheet, 'A', 'B', $line, ['label' => 'Lugar de nacimiento', 'value' => $lugarNacimiento], $styles['item']);
        $addMerged($sheet, 'C', 'D', $line, ['label' => 'Edad', 'value' => $edad], $styles['item']);
        $addMerged($sheet, 'E', 'F', $line, ['label' => 'Fecha de nacimiento', 'value' => $fechaNacimiento], $styles['item']);
        $line++;

        // Tipo de documento / No de identificación
        $tipoDoc = isset($piar["tipo_doc"]) ? $piar["tipo_doc"] : '';
        $numId = isset($piar["num_identificacion"]) ? $piar["num_identificacion"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Tipo de documento', 'value' => $tipoDoc], ['label' => 'No de identificación', 'value' => $numId], $styles['item']);
        $line++;

        // Departamento / Municipio
        $departamento = isset($piar["departamento"]) ? $piar["departamento"] : '';
        $municipio = isset($piar["municipio"]) ? $piar["municipio"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Departamento', 'value' => $departamento], ['label' => 'Municipio', 'value' => $municipio], $styles['item']);
        $line++;

        // Dirección (A-F)
        $direccion = isset($piar["direccion"]) ? $piar["direccion"] : '';
        $addMerged($sheet, 'A', 'F', $line, ['label' => 'Dirección', 'value' => $direccion], $styles['item'], 26);
        $line++;

        // Teléfono (A-C) / Correo (D-F) — con más altura
        $telefono = isset($piar["telefono"]) ? $piar["telefono"] : '';
        $email = isset($estudiante["email"]) ? $estudiante["email"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => 'Teléfono', 'value' => $telefono], $styles['item'], 28);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Correo electrónico', 'value' => $email], $styles['item'], 28);
        $line++;

        // Centro de protección (A-F) con detalle si aplica
        $esCentro = (isset($piar["es_centro_proteccion"]) && $piar["es_centro_proteccion"] === "1");
        $centroTexto = $esCentro ? "SI\n¿Dónde? " . (isset($piar["centro_proteccion"]) ? $piar["centro_proteccion"] : '') : "NO";
        $addMerged($sheet, 'A', 'F', $line, ['label' => '¿Está en centro de protección?', 'value' => $centroTexto], $styles['item'], 28);
        $line++;

        // Mensaje sobre registro civil
        $addMerged($sheet, 'A', 'F', $line, 'Si el estudiante no tiene registro civil debe iniciarse la gestión con la familia y la Registraduría', $styles['item'], 22);
        $line++;

        // Grupo étnico
        $grupoEtnico = (isset($piar["grupo_etnico"]) && $piar["grupo_etnico"] === "1") ? "SI" : "NO";
        $addMerged($sheet, 'A', 'F', $line, ['label' => '¿Se reconoce o pertenece a un grupo étnico?', 'value' => $grupoEtnico], $styles['item']);
        $line++;

        // Víctima del conflicto + registro
        $esVictima = (isset($piar["es_victima_conflicto_armado"]) && $piar["es_victima_conflicto_armado"] === "1") ? "SI" : "NO";
        $tieneRegistro = (isset($piar["registro_victima_conflicto_armado"]) && $piar["registro_victima_conflicto_armado"] === "1") ? "SI" : "NO";
        $addMerged($sheet, 'A', 'F', $line, ['label' => '¿Se reconoce como víctima del conflicto armado?', 'value' => $esVictima . "\nRegistro: " . $tieneRegistro], $styles['item'], 26);
        $line += 2;

        // 2. ENTORNO SALUD
        $addMerged($sheet, 'A', 'F', $line, '2. ENTORNO SALUD', $styles['title'], 22);
        $line += 2;

        $afiliacion = (isset($piar["afiliacion_sistema_salud"]) && $piar["afiliacion_sistema_salud"] === "1") ? "SI" : "NO";
        $eps = isset($piar["eps"]) ? $piar["eps"] : '';
        $tipoAfiliacion = isset($piar["tipo_afiliacion_sistema_salud"]) ? $piar["tipo_afiliacion_sistema_salud"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => 'Afiliación al sistema de salud', 'value' => $afiliacion], $styles['item']);
        $addMerged($sheet, 'D', 'E', $line, ['label' => 'EPS', 'value' => $eps], $styles['item']);
        $addMerged($sheet, 'F', 'F', $line, $tipoAfiliacion, $styles['item']);
        $line++;

        // Lugar donde lo atienden en caso de emergencia
        $lugarAtencion = isset($piar["lugar_atencion_emergencia"]) ? $piar["lugar_atencion_emergencia"] : '';
        $addMerged($sheet, 'A', 'F', $line, ['label' => 'Lugar donde lo atienden en caso de emergencia', 'value' => $lugarAtencion], $styles['item'], 24);
        $line++;

        // Atendido por sector salud / frecuencia
        $atendido = (isset($piar["es_atendido_sector_salud"]) && $piar["es_atendido_sector_salud"] === "1") ? "SI" : "NO";
        $frecuencia = isset($piar["es_atendido_frecuencia"]) ? $piar["es_atendido_frecuencia"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => '¿El niño está siendo atendido por el sector salud?', 'value' => $atendido], $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Frecuencia', 'value' => $frecuencia], $styles['item']);
        $line++;

        // Diagnóstico médico
        $diag = (isset($piar["diagnostico_medico"]) && $piar["diagnostico_medico"] === "1") ? "SI" : "NO";
        $diagCual = isset($piar["diagnostico_cual"]) ? $piar["diagnostico_cual"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => 'Tiene diagnóstico médico', 'value' => $diag], $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Cuál', 'value' => $diagCual], $styles['item']);
        $line++;

        // Terapias
        $terapias = (isset($piar["terapias"]) && $piar["terapias"] === "1") ? "SI" : "NO";
        $terapiasCual = isset($piar["terapias_cual"]) ? $piar["terapias_cual"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => '¿El niño está asistiendo a terapias?', 'value' => $terapias], $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Cuál', 'value' => $terapiasCual], $styles['item']);
        $line++;

        // Tratamiento médico por enfermedad en particular
        $recibeTrat = (isset($piar["recibe_tratamiento_enfermedad_particular"]) && $piar["recibe_tratamiento_enfermedad_particular"] === "1") ? "SI" : "NO";
        $recibeTratCual = isset($piar["recibe_tratamiento_enfermedad_particular_cual"]) ? $piar["recibe_tratamiento_enfermedad_particular_cual"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => '¿Actualmente recibe tratamiento médico por alguna enfermedad en particular?', 'value' => $recibeTrat], $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Cuál', 'value' => $recibeTratCual], $styles['item']);
        $line++;

        // Medicamentos y frecuencia
        $medicamentos = (isset($piar["medicamentos"]) && $piar["medicamentos"] === "1") ? "SI" : "NO";
        $medFrec = isset($piar["medicamentos_frec_horario"]) ? $piar["medicamentos_frec_horario"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => '¿Consume medicamentos?', 'value' => $medicamentos], $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Frecuencia y horario', 'value' => $medFrec], $styles['item']);
        $line++;

        // Productos de apoyo
        $productosApoyo = isset($piar["productos_apoyo"]) ? $piar["productos_apoyo"] : '';
        $addMerged($sheet, 'A', 'F', $line, ['label' => '¿Cuenta con productos de apoyo para favorecer su movilidad, comunicación e independencia?', 'value' => $productosApoyo], $styles['item'], 28);
        $line += 2;

        // 3. ENTORNO HOGAR
        $addMerged($sheet, 'A', 'F', $line, '3. ENTORNO HOGAR', $styles['title'], 22);
        $line += 2;

        // Nombres de madre / padre
        $madreNombre = isset($piar["madre_nombre"]) ? $piar["madre_nombre"] : '';
        $padreNombre = isset($piar["padre_nombre"]) ? $piar["padre_nombre"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Nombre de la madre', 'value' => $madreNombre], ['label' => 'Nombre del padre', 'value' => $padreNombre], $styles['item']);
        $line++;

        // Ocupaciones
        $madreOcup = isset($piar["madre_ocupacion"]) ? $piar["madre_ocupacion"] : '';
        $padreOcup = isset($piar["padre_ocupacion"]) ? $piar["padre_ocupacion"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Ocupación de la madre', 'value' => $madreOcup], ['label' => 'Ocupación del padre', 'value' => $padreOcup], $styles['item']);
        $line++;

        // Nivel educativo madre / padre
        $nivMadre = isset($piar["nivel_educativo_madre"]) ? $piar["nivel_educativo_madre"] : '';
        $nivPadre = isset($piar["nivel_educativo_padre"]) ? $piar["nivel_educativo_padre"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Nivel educativo alcanzado', 'value' => $nivMadre], ['label' => 'Nivel educativo alcanzado', 'value' => $nivPadre], $styles['item']);
        $line++;

        // Cuidador: A-B, C, D, E-F (tel y email multilinea)
        $nombreCuidador = isset($piar["nombre_cuidador"]) ? $piar["nombre_cuidador"] : '';
        $parentesco = isset($piar["parentesco_cuidador"]) ? $piar["parentesco_cuidador"] : '';
        $nivEduCuidador = isset($piar["nivel_educativo_cuidador"]) ? $piar["nivel_educativo_cuidador"] : '';
        $telCuidador = isset($piar["telefono_cuidador"]) ? $piar["telefono_cuidador"] : '';
        $emailCuidador = isset($piar["correo_electronico_cuidador"]) ? $piar["correo_electronico_cuidador"] : '';
        $addMerged($sheet, 'A', 'B', $line, ['label' => 'Nombre cuidador', 'value' => $nombreCuidador], $styles['item']);
        $addMerged($sheet, 'C', 'C', $line, ['label' => 'Parentesco', 'value' => $parentesco], $styles['item']);
        $addMerged($sheet, 'D', 'D', $line, ['label' => 'Nivel educativo', 'value' => $nivEduCuidador], $styles['item']);
        $addMerged($sheet, 'E', 'F', $line, "Teléfono:\n{$telCuidador}\nCorreo electrónico:\n{$emailCuidador}", $styles['item'], 32);
        $line++;

        // Número de hermanos / Posición que ocupa
        $numHermanos = obtenerRespuesta($preguntas, $respuestas, 25);
        $posicionHerm = isset($piar["lugar_que_ocupa_hermanos"]) ? $piar["lugar_que_ocupa_hermanos"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Número hermanos', 'value' => $numHermanos], ['label' => 'Posición que ocupa', 'value' => $posicionHerm], $styles['item']);
        $line++;

        // Personas que viven con el / Quiénes apoyan la crianza
        $personasViven = obtenerRespuesta($preguntas, $respuestas, 54);
        $quienesApoyan = isset($piar["quienes_apoyan_crianza"]) ? $piar["quienes_apoyan_crianza"] : '';
        $addTwoMergedColumns($sheet, $line, ['label' => 'Personas que viven con él', 'value' => $personasViven], ['label' => '¿Quiénes apoyan la crianza del estudiante?', 'value' => $quienesApoyan], $styles['item'], 24);
        $line++;

        // ¿Está bajo protección?
        $estaProteccion = (isset($piar["esta_bajo_proteccion"]) && $piar["esta_bajo_proteccion"] === "1") ? "Si" : "No";
        $addMerged($sheet, 'A', 'F', $line, ['label' => '¿Está bajo protección?', 'value' => $estaProteccion], $styles['item']);
        $line++;

        // Subsidio
        $recibeSubsidio = (isset($piar["recibe_subsidio_entidad"]) && $piar["recibe_subsidio_entidad"] === "1") ? "Si" : "No";
        $recibeSubsidioCual = isset($piar["recibe_subsidio_entidad_cual"]) ? $piar["recibe_subsidio_entidad_cual"] : '';
        $addMerged($sheet, 'A', 'F', $line, ['label' => 'La familia recibe algún subsidio de alguna entidad o institución', 'value' => $recibeSubsidio . "\n¿Cuál? " . $recibeSubsidioCual], $styles['item'], 28);
        $line += 2;

        // 4. ENTORNO EDUCATIVO
        $addMerged($sheet, 'A', 'F', $line, '4. ENTORNO EDUCATIVO', $styles['title'], 22);
        $line++;
        $addMerged($sheet, 'A', 'F', $line, 'Información de la Trayectoria Educativa', $styles['title'], 20);
        $line ++;

        // Vinculado otra institución
        $vinculado = (isset($piar["es_vinculado_otra_institucion"]) && $piar["es_vinculado_otra_institucion"] === "1") ? "Si - ¿Cuál?" : "No - ¿Por qué?";
        $vinculadoCual = isset($piar["es_vinculado_otra_institucion_cual"]) ? $piar["es_vinculado_otra_institucion_cual"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => '¿Ha estado vinculado en otra institución educativa, fundación o modalidad de educación inicial?', 'value' => $vinculado], $styles['item'], 50);
        $addMerged($sheet, 'D', 'F', $line, "- {$vinculadoCual}", $styles['item'], 50);
        $line++;

        // Último grado cursado / Observaciones / Aprobó
        $ultimoGrado = isset($piar["ultimo_grado_cursado"]) ? $piar["ultimo_grado_cursado"] : '';
        $ultimoAprobo = (isset($piar["ultimo_grado_cursado_aprobo"]) && $piar["ultimo_grado_cursado_aprobo"] === "1") ? "Si" : "No";
        $ultimoObs = isset($piar["ultimo_grado_cursado_observaciones"]) ? $piar["ultimo_grado_cursado_observaciones"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => 'Ultimo grado cursado', 'value' => $ultimoGrado . ' - ¿Aprobó? ' . $ultimoAprobo], $styles['item'], 50);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Observaciones', 'value' => $ultimoObs], $styles['item'], 50);
        $line++;

        // Informe pedagógico
        $recibeInforme = (isset($piar["recibe_informe_pedagogico"]) && $piar["recibe_informe_pedagogico"] === "1") ? "Si" : "No";
        $recibeInformeInst = isset($piar["recibe_informe_pedagogico_institucion"]) ? $piar["recibe_informe_pedagogico_institucion"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => '¿Se recibe informe pedagógico cualitativo que describa el proceso de desarrollo y aprendizaje del estudiante y/o PIAR?', 'value' => $recibeInforme], $styles['item'], 50);
        $addMerged($sheet, 'D', 'F', $line, ['label' => '¿De qué institución o modalidad proviene el informe?', 'value' => $recibeInformeInst], $styles['item'], 50);
        $line++;

        // Programas complementarios
        $asisteProg = (isset($piar["asiste_programas_complementarios"]) && $piar["asiste_programas_complementarios"] === "1") ? "Si" : "No";
        $asisteProgCuales = isset($piar["asiste_programas_complementarios_cuales"]) ? $piar["asiste_programas_complementarios_cuales"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => '¿Está asistiendo en la actualidad a programas complementarios?', 'value' => $asisteProg], $styles['item'], 50);
        $addMerged($sheet, 'D', 'F', $line, ['label' => '¿Cuáles?', 'value' => $asisteProgCuales], $styles['item'], 50);
        $line ++;
        $addMerged($sheet, 'A', 'F', $line, 'Información de la institución educativa en la que se matricula', $styles['title'], 20);
        $line ++;

        // Información institución donde se matricula
        $institucion = isset(configuracion()["nombre_institucion"]) ? configuracion()["nombre_institucion"] : '';
        $sede = isset($piar['sede']) ? $piar['sede'] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => 'Nombre de la Institución educativa a la que se matricula', 'value' => $institucion], $styles['item'], 50);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Sede', 'value' => $sede], $styles['item'], 50);
        $line++;

        // Medio transporte / distancia
        $medioTrans = isset($piar["medio_de_transporte"]) ? $piar["medio_de_transporte"] : '';
        $distancia = isset($piar["distancia_institucion_hogar"]) ? $piar["distancia_institucion_hogar"] : '';
        $addMerged($sheet, 'A', 'C', $line, ['label' => 'Medio que usará el estudiante para transportarse a la institución educativa', 'value' => $medioTrans], $styles['item'], 50);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Distancia entre la institución educativa o sede y el hogar del estudiante (Tiempo)', 'value' => $distancia], $styles['item'], 50);
        $line++;

        /* -----------------------------
           Escritura del archivo
           ----------------------------- */

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Anexo 1';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: cache, must-revalidate');

        // depuración opcional
        file_put_contents('depuracion.txt', ob_get_contents());
        ob_end_clean();

        $writer->save('php://output');
    }

    public function exportarAnexo2Piar($piarId) {
        setlocale(LC_ALL, 'es_ES');
        if (!is_logged()) {
            header("Location: " . base_url());
            return;
        }

        if (strtolower(logged_user()["rol"]) !== "docente") {
            // podrías redirigir o devolver un error si hace falta
            return;
        }

        $piar = $this->PIAR_Model->get($piarId);
        $items_piar = $this->PIAR_Item_Model->getAllByPiar($piarId);
        $items_piar_category = $this->PIAR_Item_Model->getAllByPiarCategories($piarId);
        $items_piar = array_merge($items_piar, $items_piar_category);

        if ($items_piar) {
            $items_piar = $this->getItemPiarDBAs($items_piar);
            $items_piar = $this->getItemPiarBarrerasAjustesRazonables($items_piar);
        }

        // preguntas/respuestas si usas obtenerRespuesta()
        $preguntas = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
        $respuestas = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($piar["documento"]);

        $line = 1;
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(10);



        /* -----------------------------
           Helpers y estilos
           ----------------------------- */

        $setColsWidth = function($sheet, $cols, $width = 20) {
            foreach ($cols as $c) {
                $sheet->getColumnDimension($c)->setWidth($width);
            }
        };

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);

        // Ajuste de altura por cantidad de líneas (fallback simple)
        $setRowHeightAuto = function($sheet, $line, $text, $minHeight = 18, $lineHeight = 15) {
            $text = (string)$text;
            $linesFromNL = max(1, substr_count($text, "\n") + 1);
            $len = mb_strlen($text);
            $linesByLen = max(1, (int)ceil($len / 80));
            $lines = max($linesFromNL, $linesByLen);
            $height = max($minHeight, $lines * $lineHeight);
            $sheet->getRowDimension($line)->setRowHeight($height);
        };

        $baseBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD'],
                ],
            ],
        ];

        $sectionFill = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F6F9FC'],
            ],
        ];

        $styles = [
            'title' => array_merge($this->getDocumentTitleStyle(), $sectionFill),
            'item'  => $this->getItemListStyle(),
            'bordered' => $baseBorders,
        ];

        // Helpers para convertir letra<->índice (1-based)
        $getColIndex = function($col) {
            $col = strtoupper($col);
            $len = strlen($col);
            $index = 0;
            for ($i = 0; $i < $len; $i++) {
                $index = $index * 26 + (ord($col[$i]) - ord('A') + 1);
            }
            return $index; // 1-based
        };
        $getColLetter = function($index) {
            $index--; // 0-based
            $letters = '';
            while ($index >= 0) {
                $letters = chr($index % 26 + 65) . $letters;
                $index = intval($index / 26) - 1;
            }
            return $letters;
        };

        /**
         * addMerged mejorado:
         * - limpia HTML (strip_tags) y normaliza <br>/<p> a \n
         * - convierte secuencias escapadas \\n / \\r\\n a saltos reales
         * - acepta string o ['label'=>'..','value'=>'..'] (label en negrita)
         * - calcula la altura de fila en base al ancho sumado de las columnas merged
         * - activa wrapText siempre
         */
        $addMerged = function($sheet, $startCol, $endCol, &$line, $text = null, $style = null, $minRowHeight = 18) use ($setRowHeightAuto, $getColIndex, $getColLetter) {
            $range = $startCol . $line . ':' . $endCol . $line;
            $sheet->mergeCells($range);

            $calcText = '';

            // función auxiliar para normalizar HTML y secuencias escapadas a texto plano con \n
            $normalizeHtmlToText = function($html) {
                if ($html === null || $html === '') return '';
                // Primero, convertir secuencias escapadas (literal backslash+n, backslash+r\n, etc.) a saltos reales
                // cubrimos varios casos: \\r\\n, \\n, \r\n, \r
                $html = str_replace(["\\r\\n", "\\n", "\\r"], "\n", $html);
                // convertir <br> y </p> y </div> a saltos
                $html = preg_replace('/<\s*(br|br\/|br \/)>/i', "\n", $html);
                $html = preg_replace('/<\/\s*(p|div)[^>]*>/i', "\n", $html);
                // quitar etiquetas restantes
                $text = strip_tags($html);
                // convertir múltiples saltos a uno doble (mejor legibilidad)
                $text = preg_replace("/(\r\n|\r|\n){2,}/", "\n\n", $text);
                // trim
                $text = trim($text);
                return $text;
            };

            if (is_array($text) && isset($text['label']) && array_key_exists('value', $text)) {
                $label = $normalizeHtmlToText((string)$text['label']);
                $value = $normalizeHtmlToText((string)$text['value']);
                $calcText = $label . ': ' . $value;

                $rich = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
                $runLabel = $rich->createTextRun($label . ': ');
                $runLabel->getFont()->setBold(true);
                $rich->createTextRun($value);
                $sheet->getCell($startCol . $line)->setValue($rich);
            } else {
                $plain = $normalizeHtmlToText((string)$text);
                $sheet->setCellValue($startCol . $line, $plain);
                $calcText = $plain;
            }

            if ($style) {
                $sheet->getStyle($range)->applyFromArray($style);
            }

            // activar wrapText siempre
            $sheet->getStyle($range)->getAlignment()->setWrapText(true);
            // alineacion vertical
            $sheet->getStyle($range)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // --- cálculo de ancho total de columnas merged ---
            $startIdx = $getColIndex($startCol);
            $endIdx = $getColIndex($endCol);
            $totalWidth = 0.0;
            for ($i = $startIdx; $i <= $endIdx; $i++) {
                $colLetter = $getColLetter($i);
                $colDim = $sheet->getColumnDimension($colLetter);
                $w = $colDim->getWidth();
                if (empty($w) || $w === 0) {
                    $w = 20; // fallback
                }
                $totalWidth += (float)$w;
            }

            // estimacion: cada unidad de ancho ~ 1.2 caracteres
            $charsPerLine = max(20, (int)floor($totalWidth * 1.2));
            $linesFromNL = max(1, substr_count($calcText, "\n") + 1);
            $linesByLen = max(1, (int)ceil(mb_strlen($calcText) / $charsPerLine));
            $lines = max($linesFromNL, $linesByLen);

            $lineHeight = 15; // puntos por linea (ajustable)
            $height = max($minRowHeight, $lines * $lineHeight);
            $sheet->getRowDimension($line)->setRowHeight($height);
        };

        // helper para dos columnas (A-C / D-F)
        $addTwoMergedColumns = function($sheet, &$line, $left, $right, $style = null, $minRowHeight = 18) use ($addMerged) {
            $addMerged($sheet, 'A', 'C', $line, $left, $style, $minRowHeight);
            $addMerged($sheet, 'D', 'F', $line, $right, $style, $minRowHeight);
        };

        /* -----------------------------
           Columnas y anchos iniciales (fijos)
           ----------------------------- */
        // Ajustes iniciales (fijamos los anchos y no tocaremos columnas después)
        $setColsWidth($sheet, ['A','B'], 18);
        $setColsWidth($sheet, ['C','D','E'], 36);
        $setColsWidth($sheet, ['F'], 20);

        /* -----------------------------
           Cabecera
           ----------------------------- */

        // Título principal
        $addMerged($sheet, 'A', 'F', $line, 'PLAN INDIVIDUAL DE AJUSTES RAZONABLES – PIAR (ANEXO 2)', $styles['title'], 28);
        $line++;

        // Fecha / Institución / Sede / Jornada
        $fechaFormato = isset($piar["fecha_elaboracion"]) ? date("Y-m-d", strtotime($piar["fecha_elaboracion"])) : '';
        $institucion = configuracion()["nombre_institucion"] ?? '';
        $sede = $piar['sede'] ?? $institucion;
        $jornada = $piar['jornada'] ?? '';

        $addMerged($sheet, 'A', 'B', $line, ['label' => 'Fecha de elaboración', 'value' => $fechaFormato], $styles['item']);
        $addMerged($sheet, 'C', 'D', $line, ['label' => 'Institución educativa', 'value' => $institucion], $styles['item']);
        $addMerged($sheet, 'E', 'E', $line, ['label' => 'Sede', 'value' => $sede], $styles['item']);
        $addMerged($sheet, 'F', 'F', $line, ['label' => 'Jornada', 'value' => $jornada], $styles['item']);
        $line++;

        // Docentes que elaboran y cargo
        $docentes = [];
        if (!empty($items_piar)) {
            foreach ($items_piar as $item) {
                if (isset($item["nombres"], $item["apellidos"], $item["nommateria"])) {
                    $clave = $item["nombres"] . '|' . $item["apellidos"] . '|' . $item["nommateria"];
                    if (!in_array($clave, $docentes)) {
                        $docentes[] = $clave;
                    }
                }
            }
        }
        $docentes_text = '';
        if (!empty($docentes)) {
            $linesDoc = [];
            foreach ($docentes as $d) {
                [$n, $a, $m] = explode('|', $d);
                $linesDoc[] = trim($n . ' ' . $a . ' (' . $m . ')');
            }
            $docentes_text = implode("\n", $linesDoc);
        }
        $addMerged($sheet, 'A', 'F', $line, ['label' => 'Docentes que elaboran y cargo', 'value' => $docentes_text], $styles['item'], 36);
        $line += 2;

        /* -----------------------------
           Datos del estudiante
           ----------------------------- */
        $addMerged($sheet, 'A', 'F', $line, 'DATOS DEL ESTUDIANTE', $styles['title'], 20);
        $line += 2;

        $nombreEst = $piar["nombre"] ?? '';
        $documento = obtenerRespuesta($preguntas, $respuestas, 2) ?? '';
        $edad = get_years(obtenerRespuesta($preguntas, $respuestas, 7), date("Y-m-d"));
        $grado = $piar["grado"] ?? '';

        $addMerged($sheet, 'A', 'C', $line, ['label' => 'Nombre del estudiante', 'value' => $nombreEst], $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Documento de identificación', 'value' => $documento], $styles['item']);
        $line++;
        $addMerged($sheet, 'A', 'C', $line, ['label' => 'Edad', 'value' => $edad], $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, ['label' => 'Grado', 'value' => $grado], $styles['item']);
        $line += 2;

        /* -----------------------------
           1. Características del estudiante
           ----------------------------- */
        $addMerged($sheet, 'A', 'F', $line, '1. Características del estudiante', $styles['title'], 20);
        $line += 2;

        $entorno_personal = isset($piar['entorno_personal']) ? preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $piar['entorno_personal']) : '';
        $entorno_personal = strip_tags($entorno_personal);

        $descripcion_general = isset($piar['descripcion_general']) ? preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $piar['descripcion_general']) : '';
        $descripcion_general = strip_tags($descripcion_general);

        $descripcion_que_hace = isset($piar['descripcion_que_hace']) ? preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $piar['descripcion_que_hace']) : '';
        $descripcion_que_hace = strip_tags($descripcion_que_hace);

        $addMerged($sheet, 'A', 'F', $line, ['label' => 'Entorno personal', 'value' => $entorno_personal], $styles['item'], 28);
        $line++;
        $addMerged($sheet, 'A', 'F', $line, ['label' => 'Descripción general del estudiante', 'value' => $descripcion_general], $styles['item'], 36);
        $line++;
        $addMerged($sheet, 'A', 'F', $line, ['label' => 'Descripción de lo que hace / habilidades', 'value' => $descripcion_que_hace], $styles['item'], 36);
        $line += 2;

        /* -----------------------------
           2. Ajustes razonables (tabla)
           ----------------------------- */

        $addMerged($sheet, 'A', 'F', $line, '2. Ajustes razonables', $styles['title'], 20);
        $line++;

        // Header tabla: Areas (A-B) | OBJETIVOS (C) | BARRERAS (D) | AJUSTES (E) | EVALUACIÓN (F)
        $addMerged($sheet, 'A', 'B', $line, 'Áreas', $styles['item'], 20);
        $addMerged($sheet, 'C', 'C', $line, 'OBJETIVOS/PROPÓSITOS', $styles['item'], 20);
        $addMerged($sheet, 'D', 'D', $line, 'BARRERAS QUE SE EVIDENCIAN', $styles['item'], 20);
        $addMerged($sheet, 'E', 'E', $line, 'AJUSTES RAZONABLES', $styles['item'], 20);
        $addMerged($sheet, 'F', 'F', $line, 'EVALUACIÓN DE LOS AJUSTES', $styles['item'], 20);
        $line++;

        if (!empty($items_piar)) {
            foreach ($items_piar as $item) {
                $rol = strtolower(logged_user()["rol"]);
                if ($rol == "coordinador" || $rol == "docente de apoyo" || (isset($item["id_docente"]) && logged_user()["id"] == $item["id_docente"]) || (isset($item["id_materia"]) && $item["id_materia"] == "")) {

                    $area = $item["nomarea"] ?? ($item["nommateria"] ?? "Otras");

                    // OBJETIVOS: puede estar serializado
                    $objetivos_text = '';
                    if (isset($item["objetivos"]) && strpos($item["objetivos"], 'a:') === 0) {
                        $objetivos = @unserialize($item["objetivos"]);
                        if ($objetivos && is_array($objetivos)) {
                            if (!empty($objetivos['dbas']) && is_array($objetivos['dbas']) && !empty($item["dbas"])) {
                                foreach ($objetivos['dbas'] as $dba_id) {
                                    foreach ($item["dbas"] as $dba) {
                                        if (is_array($dba) && isset($dba['id_dba']) && $dba['id_dba'] == $dba_id) {
                                            $objetivos_text .= "- " . ($dba['descripcion_dba'] ?? '') . "\n";
                                        }
                                    }
                                }
                            }
                            if (!empty($objetivos['observaciones'])) {
                                $objetivos_text .= "Observaciones: " . $objetivos['observaciones'] . "\n";
                            }
                        }
                    } else {
                        $objetivos_text = $item["objetivos"] ?? '';
                    }
                    // normalizar y limpiar HTML
                    $objetivos_text = preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $objetivos_text);
                    $objetivos_text = strip_tags($objetivos_text);

                    // BARRERAS
                    $barreras_text = '';
                    if (isset($item["barreras"]) && strpos($item["barreras"], 'a:') === 0 && !empty($item["barreras_seleccionadas"])) {
                        if (strpos($item["barreras"], "observaciones") !== false) {
                            $tmp = @unserialize($item["barreras"]);
                            if ($tmp && is_array($tmp) && !empty($tmp['observaciones'])) {
                                $barreras_text .= $tmp['observaciones'] . "\n";
                            }
                        }
                        foreach ($item["barreras_seleccionadas"] as $barrera) {
                            $desc = is_object($barrera) ? ($barrera->descripcion ?? '') : ($barrera['descripcion'] ?? '');
                            $barreras_text .= "- " . $desc . "\n";
                        }
                    } else {
                        $barreras_text = $item["barreras"] ?? '';
                    }
                    $barreras_text = preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $barreras_text);
                    $barreras_text = strip_tags($barreras_text);

                    // AJUSTES RAZONABLES
                    $ajustes_text = '';
                    if (isset($item["ajustes_razonables"]) && strpos($item["ajustes_razonables"], 'a:') === 0 && !empty($item["ajustes_razonables_seleccionados"])) {
                        if (strpos($item["ajustes_razonables"], "observaciones") !== false) {
                            $tmp = @unserialize($item["ajustes_razonables"]);
                            if ($tmp && is_array($tmp) && !empty($tmp['observaciones'])) {
                                $ajustes_text .= $tmp['observaciones'] . "\n";
                            }
                        }
                        foreach ($item["ajustes_razonables_seleccionados"] as $aj) {
                            $desc = is_object($aj) ? ($aj->descripcion ?? '') : ($aj['descripcion'] ?? '');
                            $ajustes_text .= "- " . $desc . "\n";
                        }
                    } else {
                        $ajustes_text = $item["ajustes_razonables"] ?? '';
                    }
                    $ajustes_text = preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $ajustes_text);
                    $ajustes_text = strip_tags($ajustes_text);

                    // EVALUACIÓN: aquí convertimos secuencias escapadas a saltos reales y limpiamos HTML
                    $evaluacion = (string)($item["evaluacion"] ?? '');
                    // convertir secuencias literales \r\n, \n, etc. a saltos reales
                    $evaluacion = str_replace(["\\r\\n", "\\n", "\\r"], "\n", $evaluacion);
                    // normalizar también tags <br>/<p> a \n y luego strip_tags
                    $evaluacion = preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $evaluacion);
                    $evaluacion = preg_replace('/<\/\s*(p|div)[^>]*>/i', "\n", $evaluacion);
                    $evaluacion = strip_tags($evaluacion);
                    // limpiar múltiple saltos consecutivos
                    $evaluacion = preg_replace("/(\r\n|\r|\n){2,}/", "\n\n", trim($evaluacion));

                    // Escribir fila
                    $addMerged($sheet, 'A', 'B', $line, ['label' => 'Área', 'value' => $area], $styles['item'], 24);
                    $addMerged($sheet, 'C', 'C', $line, $objetivos_text, $styles['item'], 30);
                    $addMerged($sheet, 'D', 'D', $line, $barreras_text, $styles['item'], 30);
                    $addMerged($sheet, 'E', 'E', $line, $ajustes_text, $styles['item'], 30);
                    $addMerged($sheet, 'F', 'F', $line, $evaluacion, $styles['item'], 30);

                    $line++;
                }
            }
        } else {
            $addMerged($sheet, 'A', 'F', $line, 'No se encontraron ajustes/ítems para este PIAR', $styles['item'], 18);
            $line++;
        }

        $line += 2;

        /* -----------------------------
           5. Recomendaciones para plan de mejoramiento
           ----------------------------- */
        $addMerged($sheet, 'A', 'F', $line, '5. RECOMENDACIONES PARA EL PLAN DE MEJORAMIENTO INSTITUCIONAL', $styles['title'], 20);
        $line += 2;

        // Header: ACTORES (A-B), ACCIONES (C-D), ESTRATEGIAS (E-F)
        $addMerged($sheet, 'A', 'B', $line, 'ACTORES', $styles['item'], 18);
        $addMerged($sheet, 'C', 'D', $line, 'ACCIONES', $styles['item'], 18);
        $addMerged($sheet, 'E', 'F', $line, 'ESTRATEGIAS A IMPLEMENTAR', $styles['item'], 18);
        $line++;

        // Filas
        $actors = [
            ['label' => 'FAMILIA, CUIDADORES O CON QUIENES VIVE', 'acciones' => ($piar['acciones_familia'] ?? ''), 'estrategias' => ($piar['estrategias_familia'] ?? '')],
            ['label' => 'DOCENTES', 'acciones' => ($piar['acciones_docentes'] ?? ''), 'estrategias' => ($piar['estrategias_docentes'] ?? '')],
            ['label' => 'DIRECTIVOS', 'acciones' => ($piar['acciones_directivos'] ?? ''), 'estrategias' => ($piar['estrategias_directivos'] ?? '')],
            ['label' => 'ADMINISTRATIVOS', 'acciones' => ($piar['acciones_administrativos'] ?? ''), 'estrategias' => ($piar['estrategias_administrativos'] ?? '')],
            ['label' => 'PARES (Compañeros)', 'acciones' => ($piar['acciones_companeros'] ?? ''), 'estrategias' => ($piar['estrategias_companeros'] ?? '')],
        ];

        foreach ($actors as $act) {
            $acciones = preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $act['acciones']);
            $acciones = strip_tags($acciones);
            $estrategias = preg_replace('/\s*<br\s*\/?>\s*/i', "\n", $act['estrategias']);
            $estrategias = strip_tags($estrategias);

            $addMerged($sheet, 'A', 'B', $line, $act['label'], $styles['item']);
            $addMerged($sheet, 'C', 'D', $line, $acciones, $styles['item'], 26);
            $addMerged($sheet, 'E', 'F', $line, $estrategias, $styles['item'], 26);
            $line++;
        }

        $line += 2;

        // Firma y cargo (tres columnas/espacios)
        $addMerged($sheet, 'A', 'C', $line, 'Firma y cargo de quienes realizan el proceso de valoración', $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, 'Cargo / Área', $styles['item']);
        $line += 3;

        // Tabla final de firmas
        $addMerged($sheet, 'A', 'C', $line, 'Nombre y firma', $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, 'Nombre y firma', $styles['item']);
        $line++;
        $addMerged($sheet, 'A', 'C', $line, 'Área', $styles['item']);
        $addMerged($sheet, 'D', 'F', $line, 'Área', $styles['item']);
        $line++;

        /* -----------------------------
           Escritura del archivo
           ----------------------------- */

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Anexo 2';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: cache, must-revalidate');

        // depuración opcional
        file_put_contents('depuracion_anexo2.txt', ob_get_contents());
        ob_end_clean();

        $writer->save('php://output');
    }


    private function getItemPiarDBAs($itemsPiar) {
        if($itemsPiar){
            for ($i = 0; $i < count($itemsPiar); $i++) {
                if(isset($itemsPiar[$i]["id_materia"])){
                    $materia = $this->Materias_Model->getMateria($itemsPiar[$i]["id_materia"]);
                    if($materia){
                        $area = $this->Areas_Model->find($materia["area"]);

                        $itemsPiar[$i]["dbas"] = $this->Caracterizacion_DBA_Model->get_all_area_grado($area["caracterizacion_area"], $materia["grado"]);
                    }
                }
            }
        }
        return $itemsPiar;
    }

    private function getItemPiarBarrerasAjustesRazonables($itemsPiar){
        if($itemsPiar){
            for ($i = 0; $i < count($itemsPiar); $i++) {
                $itemsPiar[$i]["barreras_seleccionadas"] = (!str_contains($itemsPiar[$i]["barreras"], "observaciones") && (strpos($itemsPiar[$i]["barreras"], 'a:') === 0)) ?
                    $this->Barreras_Model->get_by_ids(unserialize($itemsPiar[$i]["barreras"])) :
                    ((strpos($itemsPiar[$i]["barreras"], 'a:2:') === 0) ?
                        $this->Barreras_Model->get_by_ids(unserialize($itemsPiar[$i]["barreras"])["barreras"]) :
                        $itemsPiar[$i]["barreras"]);

                $itemsPiar[$i]["ajustes_razonables_seleccionados"] = (!str_contains($itemsPiar[$i]["ajustes_razonables"], "observaciones") && (strpos($itemsPiar[$i]["ajustes_razonables"], 'a:') === 0)) ?
                    $this->AjustesRazonables_Model->get_by_ids(unserialize($itemsPiar[$i]["ajustes_razonables"])) :
                    ((strpos($itemsPiar[$i]["ajustes_razonables"], 'a:2:') === 0) ?
                        $this->AjustesRazonables_Model->get_by_ids(unserialize($itemsPiar[$i]["ajustes_razonables"])["ajustes_razonables"]) :
                        $itemsPiar[$i]["ajustes_razonables"]);
            }
        }
        return $itemsPiar;

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
