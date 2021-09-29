<?php
// Contenido del fichero /application/controllers/jugadores.php 
defined('BASEPATH') OR exit('No direct script access allowed');   

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Imports extends CI_Controller {       
  	public function __construct(){ 
    	parent::__construct();         
  	}

  	public function importar_estudiantes(){
		$this->load->view('estudiantes/import');
    	$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['upload_file']['name']);
			$extension = end($arr_file);
			if('csv' == $extension){
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			echo "<pre>";
			print_r($sheetData);
		}
	}
}