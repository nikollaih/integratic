<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function importar_participantes_pruebas($FILES){
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if(isset($FILES['participantes']['name']) && in_array($FILES['participantes']['type'], $file_mimes)) {
        $participantes = [];
        $arr_file = explode('.', $FILES['participantes']['name']);
        $extension = end($arr_file);
        
        if('csv' == $extension){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($FILES['participantes']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        if(is_array($sheetData)){
            if(count($sheetData) > 1){
                for ($i=1; $i < count($sheetData); $i++) { 
                    $participante = $sheetData[$i];

                    $nuevo_participante["identificacion"] = $participante[0];
                    $nuevo_participante["nombres"] = $participante[1];
                    $nuevo_participante["apellidos"] = $participante[2];
                    $nuevo_participante["telefono"] = $participante[3];
                    $nuevo_participante["email"] = $participante[4];
                    $nuevo_participante["institucion"] = $participante[5];
                    $nuevo_participante["grado"] = $participante[6];
                    array_push($participantes, $nuevo_participante);
                }
            }
        }

        if(count($participantes)){
            return $participantes;
        }
        else{
            return false;
        }
    }
}