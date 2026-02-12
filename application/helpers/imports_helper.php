<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function importar_participantes_pruebas($FILES, $start_line = 1){
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if(isset($FILES['participantes']['name']) && in_array($FILES['participantes']['type'], $file_mimes)) {
        $participantes = [];
        $arr_file = explode('.', $FILES['participantes']['name']);
        $extension = end($arr_file);
        $inputFileName = $FILES['participantes']['tmp_name'];
        
        if('csv' == $extension){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            $reader->setInputEncoding('UTF-8');
            // Read the CSV file contents
            $fileContents = file_get_contents($inputFileName);

            // Convert the contents to UTF-8
            $fileContents = mb_convert_encoding($fileContents, 'UTF-8', 'UTF-8');

            // Write the modified contents back to the file
            file_put_contents($inputFileName, $fileContents);
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        if(is_array($sheetData)){
            if(count($sheetData) > 1){
                for ($i=$start_line; $i < count($sheetData); $i++) { 
                    $participante = $sheetData[$i];

                    $nuevo_participante["identificacion"] = (isset($participante[0])) ? $participante[0] : "";
                    $nuevo_participante["nombres"] = (isset($participante[1])) ? utf8_encode($participante[1]) : "";
                    $nuevo_participante["apellidos"] = (isset($participante[2])) ? utf8_encode($participante[2]) : "";
                    $nuevo_participante["telefono"] = (isset($participante[3])) ? $participante[3] : "";
                    $nuevo_participante["email"] = (isset($participante[4])) ? $participante[4] : "";
                    $nuevo_participante["institucion"] = (isset($participante[5])) ? $participante[5] : "";
                    $nuevo_participante["grado"] = (isset($participante[6])) ? $participante[6] : "";
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

function importar_estudiantes($FILES){
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if(isset($FILES['estudiantes']['name']) && in_array($FILES['estudiantes']['type'], $file_mimes)) {
        $estudiantes = [];
        $arr_file = explode('.', $FILES['estudiantes']['name']);
        $extension = end($arr_file);
        
        if('csv' == $extension){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($FILES['estudiantes']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        if(is_array($sheetData)){
            if(count($sheetData) > 1){
                for ($i=1; $i < count($sheetData); $i++) {
                    $estudiante = $sheetData[$i];

                    if(trim($estudiante[1]) != "" && trim($estudiante[3]) != "" && trim($estudiante[0]) != ""){
                        $nuevo_estudiante["documento"] = $estudiante[1];
                        $nuevo_estudiante["nombre"] = $estudiante[0];
                        $nuevo_estudiante["email_acudiente"] = $estudiante[2];
                        $nuevo_estudiante["grado"] = $estudiante[3];
                        $nuevo_estudiante["email"] = $estudiante[4];
                        $nuevo_estudiante["nee"] = $estudiante[5];
                        array_push($estudiantes, $nuevo_estudiante);
                    }
                }
            }
        }

        if(count($estudiantes)){
            return $estudiantes;
        }
        else{
            return false;
        }
    }
    return false;
}

function importar_instituciones($FILES, $municipio, $start_line = 0){
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if(isset($FILES['instituciones']['name']) && in_array($FILES['instituciones']['type'], $file_mimes)) {
        $instituciones = [];
        $arr_file = explode('.', $FILES['instituciones']['name']);
        $extension = end($arr_file);
        $inputFileName = $FILES['instituciones']['tmp_name'];
        
        if('csv' == $extension){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            $reader->setInputEncoding('UTF-8');
            // Read the CSV file contents
            $fileContents = file_get_contents($inputFileName);

            // Convert the contents to UTF-8
            $fileContents = mb_convert_encoding($fileContents, 'UTF-8', 'UTF-8');

            // Write the modified contents back to the file
            file_put_contents($inputFileName, $fileContents);
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        if(is_array($sheetData)){
            if(count($sheetData) > 1){
                for ($i = $start_line; $i < count($sheetData); $i++) { 
                    $institucion = $sheetData[$i];
                    $nueva_institucion["id_municipio"] = $municipio;
                    $nueva_institucion["nombre_institucion"] = (isset($institucion[0])) ? $institucion[0] : "";
                    array_push($instituciones, $nueva_institucion);
                }
            }
        }

        if(count($instituciones)){
            return $instituciones;
        }
        else{
            return false;
        }
    }
}