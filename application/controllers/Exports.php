<?php
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    class Exports extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(['Actividades_Model', 'Actividades_Model']);
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
                        $calificacion = "0";
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
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
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
