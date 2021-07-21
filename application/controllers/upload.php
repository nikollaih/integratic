<?php
  
   class Upload extends CI_Controller {
	
      public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url')); 
         $this->load->model('consultas_model');
      }

function do_upload(){
    // Revisamos si se ha subido algo
        // Cargamos la libreria Upload
        $this->load->library('upload');
        //$ruta=utf8_encode($this->input->post("dir"));
        $ruta=utf8_decode($this->input->post("dir"));
        /*
         * Revisamos si el archivo fue subido
         * Comprobamos si existen errores en el archivo subido
         */
        if (!empty($_FILES['archivo']['name']))
        {
            // Configuración para el Archivo 1
            $config['upload_path'] = $ruta;
            $config['allowed_types'] = '*'; 
            //$config['max_size'] = '4000000';
            $config['max_execution_time'] = '1000';
            $config['max_input_time'] = '1000';
            $config['post_max_size'] = '10M';
            $config['upload_max_filesize'] = '10M';
      

            // Cargamos la configuración del Archivo 1
            $this->upload->initialize($config);

            // Subimos archivo 1
            if ($this->upload->do_upload('archivo'))
            {
                $data = $this->upload->data();
                echo json_encode($ruta);
            }
            else
            {echo json_encode($ruta);
                //echo $this->upload->display_errors();
            }
        }
    }    
    
function do_upload_act(){
    // Revisamos si se ha subido algo
        // Cargamos la libreria Upload
        $this->load->library('upload');
        $mat=$this->input->post("diract");        
        $ruta=utf8_decode($mat);
        /*
         * Revisamos si el archivo fue subido
         * Comprobamos si existen errores en el archivo subido
         */
        if (!empty($_FILES['archivo']['name']))
        {
            // Configuración para el Archivo 1
            $config['upload_path'] = $ruta;
            $config['allowed_types'] = '*';
            $config['max_size'] = '20000000';    

            // Cargamos la configuración del Archivo 1
            $this->upload->initialize($config);

            // Subimos archivo 1
            if ($this->upload->do_upload('archivo'))
            {
                $data = $this->upload->data();
                echo json_encode($data);
            }
            else
            {
                //echo $this->upload->display_errors();
            }
        }
    }
    
function do_download(){      
    $fileName = basename($_POST['archivo']); 
    $filePath    = $_POST['ruta']."/".$fileName;
    if (file_exists($filePath)){
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        readfile($filePath);
        echo($filePath);
     }else{echo("Error de Archivo!");}
}

  function bajar_carpeta($carpeta,$nombre){   
    // Creamos un instancia de la clase ZipArchive
     $this->load->library('zip');
     $carpeta = str_replace("~"," ",$carpeta);
     $carpeta = str_replace("-","/",$carpeta);
     $nombre  = str_replace("~"," ",$nombre);  
     $carpeta = utf8_decode($carpeta);
     $nombre  = utf8_decode($nombre);      
     $this->zip->read_dir($carpeta);
     $this->zip->download($nombre.'.zip');
    }    

function backup_bd()
{
    $this->load->helper('url');
    $this->load->helper('file');
    $this->load->helper('download');
    $this->load->library('zip');
    $this->load->dbutil();
    date_default_timezone_set ('America/Bogota');
    $carpeta    = 'principal/backup/';
    if (!is_dir($carpeta)) {mkdir($carpeta, 0777);}

    $db_format=array('format'=>'zip','filename'=>'my_db_backup.sql');
    $backup=& $this->dbutil->backup($db_format);
    $dbname='backup-'.date('Y-m-d_g-i-s-a').'.zip';
    $save='principal/backup/'.$dbname;
    write_file($save,$backup);
    force_download($dbname,$backup);
    $this->zip->download($save);
} 
function backup_dir()
{
    $this->load->helper('download');
    $this->load->library('zip'); 
    $time = time(); 
    $this->zip->read_dir('principal/areas/');
    $this->zip->download('my_backup.'.$time.'.zip');
}       
} 
