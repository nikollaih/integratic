<?php
  
   class Upload extends CI_Controller {
	
      public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url')); 
         $this->load->model('Consultas_Model');
      }

       public function do_upload()
       {
           // 1) Directorio base en el servidor (ajústalo a tu caso)
           $basePath = FCPATH . DIRECTORY_SEPARATOR; // p.ej. /var/www/html/uploads/

           // 2) Leer dir del POST y normalizar (quitar acentos/raros)
           $rawDir = $this->input->post('dir', true) ?? '';
           $normalizedDir = string_to_folder_name($rawDir);               // "MATEMATICAS GENERALES PS"
           // Asegurar separadores y evitar dobles slashes
           $normalizedDir = trim($normalizedDir, "/\\");
           $targetPath = $basePath . $normalizedDir . DIRECTORY_SEPARATOR;

           // 3) Crear recursivamente el directorio destino si no existe
           if (!is_dir($targetPath)) {
               if (!mkdir($targetPath, 0755, true) && !is_dir($targetPath)) {
                   return json_response(null, false, "No se pudo crear la ruta destino: {$targetPath}");
               }
           }

           // 4) Validar que venga al menos un archivo
           if (empty($_FILES['archivo']['name'])) {
               return json_response(null, false, "No se ha seleccionado ningún archivo");
           }

           // 5) Config del Upload (válida para CI)
           $config = [
               'upload_path'      => $targetPath,                   // ¡La ruta normalizada que sí existe!
               'allowed_types'    => '*',                           // Mejor especificar: 'jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip'
               'max_size'         => 10240,                         // 10 MB en KB (CI usa KB)
               'remove_spaces'    => false,
               'file_ext_tolower' => true,
               // 'encrypt_name'   => true, // activa si quieres nombres aleatorios
           ];
           $this->load->library('upload');
           $this->upload->initialize($config);

           // 6) Manejo de múltiples archivos: asegúrate que el input sea name="archivo[]"
           $files = $_FILES['archivo'];
           $count = is_array($files['name']) ? count($files['name']) : 1;

           $subidos = [];
           $errores = [];

           for ($i = 0; $i < $count; $i++) {
               // Re-mapear el $_FILES para cada iteración (formato que espera CI)
               $_FILES['archivo_single']['name']     = is_array($files['name']) ? $files['name'][$i] : $files['name'];
               $_FILES['archivo_single']['type']     = is_array($files['type']) ? $files['type'][$i] : $files['type'];
               $_FILES['archivo_single']['tmp_name'] = is_array($files['tmp_name']) ? $files['tmp_name'][$i] : $files['tmp_name'];
               $_FILES['archivo_single']['error']    = is_array($files['error']) ? $files['error'][$i] : $files['error'];
               $_FILES['archivo_single']['size']     = is_array($files['size']) ? $files['size'][$i] : $files['size'];

               // Re-inicializar por si cambiaste algo
               $this->upload->initialize($config);

               if ($this->upload->do_upload('archivo_single')) {
                   $data = $this->upload->data();
                   // $data['full_path'] te da la ruta completa del archivo guardado
                   $subidos[] = [
                       'file_name' => $data['file_name'],
                       'full_path' => $data['full_path'],
                       'file_size' => $data['file_size'],
                       'file_ext'  => $data['file_ext'],
                   ];
               } else {
                   $errores[] = [
                       'archivo' => $_FILES['archivo_single']['name'],
                       'error'   => $this->upload->display_errors('', ''),
                   ];
               }
           }

           if (!empty($subidos) && empty($errores)) {
               return json_response(['files' => $subidos, 'path' => $targetPath], true, "Archivo(s) subido(s) exitosamente");
           } elseif (!empty($subidos) && !empty($errores)) {
               return json_response(
                   ['files_ok' => $subidos, 'files_error' => $errores, 'path' => $targetPath],
                   true,
                   "Algunos archivos se subieron y otros fallaron"
               );
           } else {
               return json_response(['errors' => $errores, 'path' => $targetPath], false, "Ningún archivo se pudo subir");
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
