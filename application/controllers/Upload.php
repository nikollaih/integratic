<?php
  
   class Upload extends CI_Controller {
	
      public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url')); 
         $this->load->model('Consultas_Model');
      }

function do_upload(){
    // Revisamos si se ha subido algo
    // Cargamos la libreria Upload
    $this->load->library('upload');
    //$ruta=utf8_encode($this->input->post("dir"));
    $ruta=utf8_decode($this->input->post("dir"));
    $split_ruta = explode("/", $ruta);

    if(is_array($split_ruta)){
        $temp_ruta = "";
        for ($i=0; $i < count($split_ruta); $i++) { 
            $temp_ruta.= $split_ruta[$i]."/";
            if (string_to_folder_name($temp_ruta) && !is_dir($temp_ruta)) {
                mkdir(string_to_folder_name($temp_ruta), 0755);
            }
        }
    }
    /*
        * Revisamos si el archivo fue subido
        * Comprobamos si existen errores en el archivo subido
        */
    if (!empty($_FILES['archivo']['name'])){
        // Configuración para el Archivo 1
        $config['upload_path'] = $ruta;
        $config['allowed_types'] = '*';
        $config['max_execution_time'] = '1000';
        $config['max_input_time'] = '1000';
        $config['post_max_size'] = '10M';
        $config['upload_max_filesize'] = '10M';
        $config['remove_spaces'] = FALSE;

        // Cargamos la configuración del Archivo 1
        $this->upload->initialize($config);

        $files = $_FILES;
        $cpt = count($_FILES ['archivo'] ['name']);

        for ($i = 0; $i < $cpt; $i ++) {
            $_FILES ['archivo'] ['name'] = $files ['archivo'] ['name'] [$i];;
            $_FILES ['archivo'] ['type'] = $files ['archivo'] ['type'] [$i];
            $_FILES ['archivo'] ['tmp_name'] = $files ['archivo'] ['tmp_name'] [$i];
            $_FILES ['archivo'] ['error'] = $files ['archivo'] ['error'] [$i];
            $_FILES ['archivo'] ['size'] = $files ['archivo'] ['size'] [$i];
            $this->upload->do_upload('archivo');
        }

        json_response(null, true, "Archivo subido exitosamente");
    }
    else{
        json_response(null, false, "No se ha selecionado ningun archivo");
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
            $config['remove_spaces'] = FALSE;    

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
    if (string_to_folder_name($carpeta)) {mkdir(string_to_folder_name($carpeta), 0777);}

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
