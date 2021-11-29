<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Files extends CI_Controller {
    function __construct()
	{
		parent::__construct();
		$this->load->helper(['url']);
        $this->load->model(["Actividades_Model"]);
    }

    // Generate the estudiantes excel report by dates
    public function generar_reporte_notas_actividad($id_actividad){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $grupo_materia = $this->session->userdata("materia_grupo");
                $estudiantes = get_students_by_materia($grupo_materia["materia"], $grupo_materia["grupo"]);
                $actividad = $this->Actividades_Model->get($id_actividad);

                if(is_array($estudiantes)){
                    for ($i=0; $i < count($estudiantes); $i++) { 
                        $estudiantes[$i]["respuesta"] = $this->Actividades_Model->get_activity_response($id_actividad, $estudiantes[$i]["documento"]);
                    }

                    $line = 1;
                    $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
                    $sheet = $spreadsheet->getActiveSheet();
                    $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
                    $spreadsheet->getDefaultStyle()->getFont()->setSize(10);

                    // manually set title value
                    $sheet->mergeCells("A".$line.":E".$line);
                    $sheet->setCellValue('A'.$line, 'INTEGRATIC'); 
                    $sheet->getStyle("A".$line.":E".$line)->applyFromArray($this->getDocumentTitleStyle());
                    $sheet->getStyle("A".$line.":E".$line)->getFont()->setSize(14);
                    $line++;
                    $sheet->mergeCells("A".$line.":E".$line);
                    $sheet->setCellValue('A'.$line, 'Calificaciones: '.$actividad["titulo_actividad"]); 
                    $sheet->getStyle("A".$line.":E".$line)->applyFromArray($this->getDocumentTitleStyle());
                    $sheet->getStyle("A".$line.":E".$line)->getFont()->setSize(12);
                    $line += 3;

                    $sheet->getStyle('A'.$line.':E'.$line)->applyFromArray($this->getItemTitleStyle());

                    // Set the cells dimensions
                    $sheet->getColumnDimension('A')->setWidth(20);
                    $sheet->getColumnDimension('B')->setWidth(40);
                    $sheet->getColumnDimension('C')->setWidth(20);
                    $sheet->getColumnDimension('D')->setWidth(40);
                    $sheet->getColumnDimension('E')->setWidth(20);

                    // Set the table titles
                    $sheet->setCellValue('A'.$line, 'DOCUMENTO'); 
                    $sheet->setCellValue('B'.$line, 'NOMBRE ESTUDIANTE'); 
                    $sheet->setCellValue('C'.$line, 'FECHA DE CARGA'); 
                    $sheet->setCellValue('D'.$line, 'NOTAS'); 
                    $sheet->setCellValue('E'.$line, 'CALIFICACIÓN');

                    $line++;

                    foreach ($estudiantes as $estudiante) {
                        // Set the estudiantes data
                        $sheet->setCellValue('A'.$line, $estudiante["documento"]); 
                        $sheet->setCellValue('B'.$line, $estudiante["nombre"]); 
                        $sheet->setCellValue('C'.$line, ($estudiante["respuesta"] != null) ? ucfirst(strftime('%B %d, %Y',strtotime($estudiante["respuesta"]["created_at"]))) : ""); 
                        $sheet->setCellValue('D'.$line,  ($estudiante["respuesta"] != null) ? $estudiante["respuesta"]["estudiante_notas"] : ""); 
                        $sheet->setCellValue('E'.$line, ($estudiante["respuesta"] != null) ? $estudiante["respuesta"]["calificacion"] : ""); 
                        $sheet->getStyle('A'.$line.':E'.$line)->applyFromArray(['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT ] ]);
                        $sheet->getStyle('B'.$line)->applyFromArray(['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT ] ]);
                        $line++;
                    }

                    $sheet->getStyle('A6'.':E'.($line-1))->applyFromArray($this->getItemListStyle());


                    $writer = new Xlsx($spreadsheet); // instantiate Xlsx
            
                    $filename = 'Calificaciones'; // set filename for excel file to be exported
            
                    header('Content-Type: application/vnd.ms-excel'); // generate excel file
                    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                    header('Cache-Control: max-age=0');
                    
                    $writer->save('php://output');	// download file 
                }
                else{
                    json_response(null, false, "No se encontraron calificaciones.");
                }
            }
            else{
                json_response(null, false, "Usted no puede realizar esta acción.");
            }
        }
        else{
            json_response(null, false, "Usted no puede realizar esta acción.");
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
                'outline' => [
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
