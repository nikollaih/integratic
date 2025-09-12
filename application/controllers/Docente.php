<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
         $this->load->helper('form');
         $this->load->helper('html');
         $this->load->helper('url');
         $this->load->model('Consultas_Model');
		$this->load->model('Estudiante_Model');
         $this->load->model(array('Consultas_Model','Foro_Model', 'Anuncio_Model', 'Actividades_Model'));
    }
    
    public function lista_usr(){  
        if($datos  = $this->Consultas_Model->lisusuario()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en asignacion");}
    }    
    public function asignacion($id){  
        if($datos  = $this->Consultas_Model->asignacion($id)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en asignacion");}
    }
    public function asigna_procesos($id){  
        if($datos  = $this->Consultas_Model->asigna_procesos($id)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en asignacion");}
    }    
    public function asignadoc($id, $diff = 'true'){
        if($datos  = $this->Consultas_Model->asignadoc($id, $diff)){
            json_response($datos, true, "Asignación docente");
        } 
        else{json_response(null, false, "El docente no tiene una asignación academica.");}
    }   
    public function asignapro($id){  
        if($datos  = $this->Consultas_Model->asignapro($id)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en asignacion");}
    }     
    public function asignaproc($id){  
        if($datos  = $this->Consultas_Model->asignaproc($id)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en asignacion");}
    }     
    public function tmaterias(){  
        if($datos  = $this->Consultas_Model->tmaterias()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en asignacion");}
    }    
    public function proyectos($id)
    {  
        if($datos  = $this->Consultas_Model->proyectos($id)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en Asignacion");}
    } 

    function planeacion(){  
        $datos  = $this->Consultas_Model->planeacion();
        if($datos){                   
            echo json_encode($datos);
        } 
        else {
            echo json_encode("{error: 'Error en asignación'}");
        }
    }    

    public function tproyectos()
    {  
        if($datos  = $this->Consultas_Model->tproyectos()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en Proyectos");}
    }     
    public function tprocesos()
    {  
        if($datos  = $this->Consultas_Model->tprocesos()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en Procesos!");}
    }     
    public function renombrar(){
         $nombre    = $_POST['nombre'];
         $nuevo     = $_POST['nuevo'];
         
         if (file_exists($nombre)){
                rename($nombre,$nuevo);
                echo('Renombrado');
            } else { echo($nombre); }
    }
    public function crear(){
        $ruta       = $_POST['ruta'];
        $nomdir     = $_POST['nomdir'];
        //$dir=utf8_decode($ruta.'/'.$nomdir);
        $dir=$ruta.'/'.$nomdir;
        $split_ruta = explode("/", $ruta);

        if(is_array($split_ruta)){
            $temp_ruta = "";
            for ($i=0; $i < count($split_ruta); $i++) { 
                $temp_ruta.= $split_ruta[$i]."/";
                if (string_to_folder_name($temp_ruta) && !is_dir(string_to_folder_name($temp_ruta))) {
                    mkdir(string_to_folder_name($temp_ruta), 0755);
                }
            }
        }
        
        if (string_to_folder_name($dir)) {
            mkdir(string_to_folder_name($dir), 0755);
            echo('Hecho! '.$dir);
        }else{echo('Error!');}    
}
  
    public function eliminar(){
         $nomarc    = $_POST['arc'];
         if(unlink($nomarc)){
             echo("Archivo Eliminado!");
         }
         else{
             echo("Archivo no pudo ser eliminado!");
         }
    }  
    public function eliminacar(){
        $nomdir    = $_POST['arc'];         

        $archivos = scandir($nomdir); //hace una lista de archivos del directorio
        $num = count($archivos); //los cuenta

        //Los borramos
        for ($i=0; $i<=$num; $i++) {
         unlink ($archivos[$i]); 
        }
        //borramos el directorio
        rmdir ($nomdir);  
    }

    public function listar($menu_materia = false){ 
        // Verificamos si existe un usuario logueado
        if(is_logged()){
            // Obtiene las variables POST
            $data["carpeta"] = $this->input->post("ruta");
            $data["titulo"] = $this->input->post("titulo");
            $data["materia"] = $this->input->post("materia");
            $data["grupo"] = $this->input->post("grupo");
            $data["menu_materia"] = $menu_materia;
            $data["foros"] = $this->Foro_Model->get_all($data["materia"], $data["grupo"]);
            $data["anuncios"] = $this->Anuncio_Model->get_all($data["materia"], $data["grupo"]);
            $data["actividades"] = $this->Actividades_Model->get_all($data["materia"], $data["grupo"], logged_user()["rol"]);
            $this->session->set_userdata("materia_grupo", array("materia"  => $data["materia"], "grupo"  => $data["grupo"]));
            $this->load->view("docente/listar", $data);
        }
        else{
            json_response(null, false, "Debe iniciar sesion");
        }
}         
    public function listar_acti(){ 
        $carpeta    = utf8_decode($_POST['ruta']); 
        $titulo     = utf8_decode($_POST['titulo']); 
        $html='<div class="panel panel-primary">';        
        $html=$html.'<div class="panel-heading"><b><div id="titulo">'.$titulo.'</div></b></div>';
        $html=$html.'<div class="panel-body">';         
        $html=$html."<div class='row' id='migas'><input id='ruta' name='ruta' value=".$carpeta." type='hidden'/>";
        $html=$html."<input id='nombre' name='nombre' type='hidden'/>";
        $html=$html."<div class='col-lg-12' style='float:right;'>";        
        $html=$html."<a href='javascript:crear();' style='width:10%'>";
        $html=$html."<img src='./img/iconos/nueva_carpeta.png' width='32' height='32' alt='Nueva Carpeta' title='Nueva Carpeta'></a>&nbsp;";
        $html=$html."<a href='javascript:subir();' style='width:10%'>";
        $html=$html."<img src='./img/iconos/subir_archivo.png' width='32' height='32' alt='Subir Archivo' title='Subir Archivo'></a>&nbsp;"; 
        //$html=$html."<a href='javascript:descargar();' style='width:10%'>";
        //$html=$html."<img src='./img/iconos/down.png' width='40' height='32' alt='Descargar' title='Descargar'></a>&nbsp;";        
        $html=$html."</div></div>";         
        $html=$html."<table style='width:100%;'><tbody><tr>";
        $i=0;
        $carpeta = string_to_folder_name($carpeta);
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                       if (is_dir($carpeta."/".$archivo)){
                           $ruta=utf8_encode($carpeta."/".$archivo);
                            $html=$html.'<td  style="width:50%; height:42px"><a href="javascript:submenu_acti(\''.$ruta.'\',\''.$archivo.'\')">';
                            $html=$html."<img src='./img/iconos/carpeta.png' width='35' height='30'>&nbsp;&nbsp;".utf8_encode($archivo);                                                        
                            $html=$html."</a></td>";  
                            $ruta=$carpeta."/".$archivo;
                            $html=$html.'<td style="width:5%;"><a href="javascript:elicar(\''.$ruta.'\');" style="width:10%">';
                            $html=$html."<img src='./img/iconos/borrar.png' width='25' height='28' alt='Eliminar Archivo' title='Eliminar Carpeta'></a></td>";  
                            $html=$html.'<td style="width:5%;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                            $html=$html."<img src='./img/iconos/ren.png' width='25' height='28' alt='Renombrar Archivo' title='Renombrar Carpeta'></a></td></tr>";                             
                        } 
                    } 
                }
                closedir($dir);
            }
            $html=$html."<tr>";
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){ 
                    if(string_to_folder_name($carpeta."/".$archivo) && $archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && !is_dir($carpeta."/".$archivo)){
                        $ext = explode(".", $archivo);
                        $html=$html."<td  style='width:60%; height:42px'><a target='_blank' href='$carpeta/$archivo'>";                                               
                            switch($ext[1]){
                                case "pdf":$html=$html."<img src='./img/iconos/pdf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "jpg":$html=$html."<img src='./img/iconos/jpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "png":$html=$html."<img src='./img/iconos/png.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;     
                                case "docx":$html=$html."<img src='./img/iconos/docx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;   
                                case "xlsx":$html=$html."<img src='./img/iconos/xlsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;                                      
                                case "jar":$html=$html."<img src='./img/iconos/jar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;  
                                case "html":$html=$html."<img src='./img/iconos/html.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;     
                                case "exe":$html=$html."<img src='./img/iconos/exe.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;        
                                case "rar":$html=$html."<img src='./img/iconos/rar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;                                            
                                case "mp4":$html=$html."<img src='./img/iconos/mp4.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;  
                                case "aac":$html=$html."<img src='./img/iconos/acc.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "ai":$html=$html."<img src='./img/iconos/ai.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "avi":$html=$html."<img src='./img/iconos/avi.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "bmp":$html=$html."<img src='./img/iconos/bmp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "cda":$html=$html."<img src='./img/iconos/cda.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "cdr":$html=$html."<img src='./img/iconos/cdr.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "css":$html=$html."<img src='./img/iconos/css.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "db":$html=$html."<img src='./img/iconos/db.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "dmg":$html=$html."<img src='./img/iconos/dmg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "doc":$html=$html."<img src='./img/iconos/doc.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "docm":$html=$html."<img src='./img/iconos/docm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "dot":$html=$html."<img src='./img/iconos/dot.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "dotm":$html=$html."<img src='./img/iconos/dotm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "dotx":$html=$html."<img src='./img/iconos/dotx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "dwf":$html=$html."<img src='./img/iconos/dwf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "dwg":$html=$html."<img src='./img/iconos/dwg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "eps":$html=$html."<img src='./img/iconos/eps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "fla":$html=$html."<img src='./img/iconos/fla.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "flv":$html=$html."<img src='./img/iconos/flv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "gif":$html=$html."<img src='./img/iconos/gif.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "htm":$html=$html."<img src='./img/iconos/htm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "info":$html=$html."<img src='./img/iconos/info.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "ini":$html=$html."<img src='./img/iconos/ini.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "java":$html=$html."<img src='./img/iconos/java.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "js":$html=$html."<img src='./img/iconos/js.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "mid":$html=$html."<img src='./img/iconos/mid.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "mkv":$html=$html."<img src='./img/iconos/mkv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "mov":$html=$html."<img src='./img/iconos/mov.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "mp3":$html=$html."<img src='./img/iconos/mp3.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "mpg":$html=$html."<img src='./img/iconos/mpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "odp":$html=$html."<img src='./img/iconos/odp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ods":$html=$html."<img src='./img/iconos/ods.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "odt":$html=$html."<img src='./img/iconos/odt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "php":$html=$html."<img src='./img/iconos/php.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "pot":$html=$html."<img src='./img/iconos/pot.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "potm":$html=$html."<img src='./img/iconos/potm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "potx":$html=$html."<img src='./img/iconos/potx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "pps":$html=$html."<img src='./img/iconos/pps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ppsm":$html=$html."<img src='./img/iconos/ppsm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ppsx":$html=$html."<img src='./img/iconos/ppsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ppt":$html=$html."<img src='./img/iconos/ppt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "pptm":$html=$html."<img src='./img/iconos/pptm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "ppts":$html=$html."<img src='./img/iconos/ppts.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "pptx":$html=$html."<img src='./img/iconos/pptx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ps":$html=$html."<img src='./img/iconos/ps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "psd":$html=$html."<img src='./img/iconos/psd.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "pub":$html=$html."<img src='./img/iconos/pub.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "rss":$html=$html."<img src='./img/iconos/rss.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "rtf":$html=$html."<img src='./img/iconos/rtf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "sb2":$html=$html."<img src='./img/iconos/sb2.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "skp":$html=$html."<img src='./img/iconos/skp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "swf":$html=$html."<img src='./img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "sys":$html=$html."<img src='./img/iconos/sys.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "tif":$html=$html."<img src='./img/iconos/tif.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "txt":$html=$html."<img src='./img/iconos/txt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "wav":$html=$html."<img src='./img/iconos/wav.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "wma":$html=$html."<img src='./img/iconos/wma.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "wmv":$html=$html."<img src='./img/iconos/wmv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xlsb":$html=$html."<img src='./img/iconos/xlsb.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xlsm":$html=$html."<img src='./img/iconos/xlsm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xlt":$html=$html."<img src='./img/iconos/xlt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xltm":$html=$html."<img src='./img/iconos/xltm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xltx":$html=$html."<img src='./img/iconos/xltx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "xml":$html=$html."<img src='./img/iconos/xml.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xts":$html=$html."<img src='./img/iconos/xts.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "zip":$html=$html."<img src='./img/iconos/zip.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                default:$html=$html."<img src='./img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;    
                            }                        
                        $html=$html."</a></td>";  
                        $ruta=$carpeta."/".$archivo;
                        $html=$html.'<td style="width:5%;"><a href="javascript:eliminar(\''.$ruta.'\');" style="width:10%">';
                        $html=$html."<img src='./img/iconos/borrar.png2' width='25' height='28' alt='Subir Archivo' title='Eliminar Archivo'></a></td>";  
                        $html=$html.'<td style="width:5%;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                        $html=$html."<img src='./img/iconos/ren.png' width='25' height='28' alt='Subir Archivo' title='Renombrar Archivo'></a></td></tr>";                            
                        } 
                     }  
                    closedir($dir);
                    }
            }
        $html=$html."</tbody></table>";
        $html=$html."</div>";
        echo $html;
}  
    public function listarpro(){ 
        $carpeta    = $_POST['proy'];
        $titulo     = $_POST['tit'];
                 
        $html='<div class="panel panel-primary">';        
        $html=$html.'<div class="panel-heading"><b><div id="titulo">'.$titulo.'</div></b></div>';
        $html=$html.'<div class="panel-body">';         
        $html=$html."<div class='row' id='migas'><input id='ruta' name='ruta' value='$carpeta' type='hidden'/>";
        $html=$html."<input id='nombre' name='nombre' type='hidden'/>";
        $html=$html."<div class='col-lg-12'>";
        $html=$html."<div class='add-announcement-container'>"; 
        $html=$html."<a href='javascript:crear();'>";
        $html=$html."<img src='./img/iconos/nueva_carpeta.png' width='32' height='32' alt='Nueva Carpeta' title='Nueva Carpeta'></a>&nbsp;";
        $html=$html."<a href='javascript:subir();'>";
        $html=$html."<img src='./img/iconos/subir_archivo.png' width='32' height='32' alt='Subir Archivo' title='Subir Archivo'></a>&nbsp;"; 
        $html=$html."</div></div></div>";  
        $html=$html."<table style='width:100%;'><tbody><tr>";
        $i=0;
        $carpeta = string_to_folder_name($carpeta);
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                       if (is_dir($carpeta."/".$archivo)){
                           $ruta=$carpeta."/".$archivo;
                            $html=$html.'<td  style="width:50%; height:42px"><a href="javascript:submenu_doc(\''.$ruta.'\',\''.$archivo.'\')">';
                            $html=$html."<img src='./img/iconos/carpeta.png' height='30'>&nbsp;&nbsp;$archivo";                                                        
                            $html=$html."</a></td>";  
                            $ruta=$carpeta."/".$archivo;
                            date_default_timezone_set ('America/Bogota');
                            setlocale(LC_ALL,"es_ES");
                            $html.="<td style='text-align:right;'>".date("d/m/Y h:i a",filectime(utf8_decode($ruta)))."</td>";                                                     
                            $html=$html.'<td style="width:5%;text-align:right;"><a href="javascript:elicar(\''.$ruta.'\');" style="width:10%">';
                            $html=$html."<img src='./img/iconos/borrar.png' width='25' height='28' alt='Eliminar Carpeta' title='Eliminar Carpeta'></a></td>";  
                            $html=$html.'<td style="width:5%;text-align:right;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                            $html=$html."<img src='./img/iconos/ren.png' width='25' height='28' alt='Renombrar Carpeta' title='Renombrar Carpeta'></a></td></tr>";                             
                        } 
                    } 
                }
                closedir($dir);
            }
            $html=$html."<tr>";
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){ 
                    if(string_to_folder_name($carpeta."/".$archivo) && $archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && !is_dir($carpeta."/".$archivo)){
                        $ext = explode(".", $archivo);
                        $html=$html."<td  style='width:60%; height:42px'><a target='_blank' href='$carpeta/$archivo'>";                                               
                            switch($ext[1]){
                                case "pdf":$html=$html."<img src='./img/iconos/pdf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "jpg":$html=$html."<img src='./img/iconos/jpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "png":$html=$html."<img src='./img/iconos/png.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;     
                                case "docx":$html=$html."<img src='./img/iconos/docx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;   
                                case "xlsx":$html=$html."<img src='./img/iconos/xlsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;                                      
                                case "jar":$html=$html."<img src='./img/iconos/jar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;  
                                case "html":$html=$html."<img src='./img/iconos/html.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;     
                                case "exe":$html=$html."<img src='./img/iconos/exe.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;        
                                case "rar":$html=$html."<img src='./img/iconos/rar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;                                            
                                case "mp4":$html=$html."<img src='./img/iconos/mp4.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;  
                                case "aac":$html=$html."<img src='./img/iconos/acc.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "ai":$html=$html."<img src='./img/iconos/ai.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "avi":$html=$html."<img src='./img/iconos/avi.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "bmp":$html=$html."<img src='./img/iconos/bmp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "cda":$html=$html."<img src='./img/iconos/cda.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "cdr":$html=$html."<img src='./img/iconos/cdr.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "css":$html=$html."<img src='./img/iconos/css.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "db":$html=$html."<img src='./img/iconos/db.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "dmg":$html=$html."<img src='./img/iconos/dmg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "doc":$html=$html."<img src='./img/iconos/doc.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "docm":$html=$html."<img src='./img/iconos/docm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "dot":$html=$html."<img src='./img/iconos/dot.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "dotm":$html=$html."<img src='./img/iconos/dotm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "dotx":$html=$html."<img src='./img/iconos/dotx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "dwf":$html=$html."<img src='./img/iconos/dwf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "dwg":$html=$html."<img src='./img/iconos/dwg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "eps":$html=$html."<img src='./img/iconos/eps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "fla":$html=$html."<img src='./img/iconos/fla.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "flv":$html=$html."<img src='./img/iconos/flv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "gif":$html=$html."<img src='./img/iconos/gif.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "htm":$html=$html."<img src='./img/iconos/htm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "info":$html=$html."<img src='./img/iconos/info.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "ini":$html=$html."<img src='./img/iconos/ini.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "java":$html=$html."<img src='./img/iconos/java.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "js":$html=$html."<img src='./img/iconos/js.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "mid":$html=$html."<img src='./img/iconos/mid.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "mkv":$html=$html."<img src='./img/iconos/mkv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "mov":$html=$html."<img src='./img/iconos/mov.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "mp3":$html=$html."<img src='./img/iconos/mp3.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "mpg":$html=$html."<img src='./img/iconos/mpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "odp":$html=$html."<img src='./img/iconos/odp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ods":$html=$html."<img src='./img/iconos/ods.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "odt":$html=$html."<img src='./img/iconos/odt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "php":$html=$html."<img src='./img/iconos/php.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "pot":$html=$html."<img src='./img/iconos/pot.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "potm":$html=$html."<img src='./img/iconos/potm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "potx":$html=$html."<img src='./img/iconos/potx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "pps":$html=$html."<img src='./img/iconos/pps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ppsm":$html=$html."<img src='./img/iconos/ppsm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ppsx":$html=$html."<img src='./img/iconos/ppsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ppt":$html=$html."<img src='./img/iconos/ppt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "pptm":$html=$html."<img src='./img/iconos/pptm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "ppts":$html=$html."<img src='./img/iconos/ppts.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "pptx":$html=$html."<img src='./img/iconos/pptx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "ps":$html=$html."<img src='./img/iconos/ps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "psd":$html=$html."<img src='./img/iconos/psd.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "pub":$html=$html."<img src='./img/iconos/pub.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "rss":$html=$html."<img src='./img/iconos/rss.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "rtf":$html=$html."<img src='./img/iconos/rtf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "sb2":$html=$html."<img src='./img/iconos/sb2.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "skp":$html=$html."<img src='./img/iconos/skp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "swf":$html=$html."<img src='./img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "sys":$html=$html."<img src='./img/iconos/sys.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "tif":$html=$html."<img src='./img/iconos/tif.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "txt":$html=$html."<img src='./img/iconos/txt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "wav":$html=$html."<img src='./img/iconos/wav.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "wma":$html=$html."<img src='./img/iconos/wma.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "wmv":$html=$html."<img src='./img/iconos/wmv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xlsb":$html=$html."<img src='./img/iconos/xlsb.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xlsm":$html=$html."<img src='./img/iconos/xlsm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xlt":$html=$html."<img src='./img/iconos/xlt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xltm":$html=$html."<img src='./img/iconos/xltm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xltx":$html=$html."<img src='./img/iconos/xltx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                                case "xml":$html=$html."<img src='./img/iconos/xml.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "xts":$html=$html."<img src='./img/iconos/xts.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                case "zip":$html=$html."<img src='./img/iconos/zip.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                default:$html=$html."<img src='./img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;      
                            }
                        
                        $html=$html."</a></td>";

                        $ruta=$carpeta."/".$archivo;
                        $html.="<td style='text-align:right;'>".date("d/m/Y h:i a",filectime(utf8_decode($ruta)))."</td>";       
                        $html=$html.'<td style="width:5%;text-align:right;"><a href="javascript:eliminar(\''.$ruta.'\');" style="width:10%">';
                        $html=$html."<img src='./img/iconos/borrar.png' width='25' height='28'></a></td>";  
                        $html=$html.'<td style="width:5%;text-align:right;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                        $html=$html."<img src='./img/iconos/ren.png' width='25' height='28'></a></td></tr>";                            
                        } 
                     }  
                    closedir($dir);
                    }
            } 
        $html=$html."</tbody></table>";
        $html=$html."</div>";
        echo $html;
} 


public function listar_filtro(){ 
    $carpeta    = $_POST['ruta']; 
    $titulo     = $_POST['titulo']; 
    $filtro     = $_POST['filtro']; 
    $html='<div class="panel panel-primary">';        
    $html=$html.'<div class="panel-heading"><b><div id="titulo">'.$titulo.'</div></b></div>';
    $html=$html.'<div class="panel-body">';         
    $html=$html."<div class='row' id='migas'><input id='ruta' name='ruta' value=".htmlentities($carpeta)." type='hidden'/>";
    $html=$html."<input id='nombre' name='nombre' type='hidden'/>";
    $html=$html."<div class='col-lg-12' style='float:right;'>";        
    $html=$html."<a href='javascript:crear();' style='width:10%'>";
    $html=$html."<img src='./img/iconos/nueva_carpeta.png' width='32' height='32' alt='Nueva Carpeta' title='Nueva Carpeta'></a>&nbsp;";
    $html=$html."<a href='javascript:subir();' style='width:10%'>";
    $html=$html."<img src='./img/iconos/subir_archivo.png' width='32' height='32' alt='Subir Archivo' title='Subir Archivo'></a>&nbsp;"; 
    $html=$html."</div></div>";         
    $html=$html."<table style='width:100%;'><tbody><tr>";
    $i=0;
    $carpeta = string_to_folder_name($carpeta);
    if(is_dir($carpeta)){
        if($dir = opendir($carpeta)){
            while(($archivo = readdir($dir)) !== false){
                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                   if (is_dir($carpeta."/".$archivo)){
                       $ruta=$carpeta."/".$archivo;
                        $html=$html.'<td  style="width:50%; height:42px"><a href="javascript:submenu_doc(\''.$ruta.'\',\''.$archivo.'\')">';
                        $html=$html."<img src='./img/iconos/carpeta.png' width='35' height='30'>&nbsp;&nbsp;".utf8_encode($archivo);                                                        
                        $html=$html."</a></td>";  
                        $ruta=$carpeta."/".$archivo;
                        $html=$html.'<td style="width:5%;"><a href="javascript:elicar(\''.$ruta.'\');" style="width:10%">';
                        $html=$html."<img src='./img/iconos/borrar.png' width='25' height='28' alt='Eliminar Archivo' title='Eliminar Carpeta'></a></td>";  
                        $html=$html.'<td style="width:5%;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                        $html=$html."<img src='./img/iconos/ren.png' width='25' height='28' alt='Renombrar Archivo' title='Renombrar Carpeta'></a></td></tr>";                             
                    } 
                } 
            }
            closedir($dir);
        }
        $html=$html."<tr>";
        if($dir = opendir($carpeta)){
            while(($archivo = readdir($dir)) !== false){ 
                if(string_to_folder_name($carpeta."/".$archivo) && $archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && !is_dir($carpeta."/".$archivo)){

                foreach (glob("{".filtro."}") as $fichero) {

                    $ext = explode(".", $fichero);
                    $html=$html."<td  style='width:60%; height:42px'><a target='_blank' href='$carpeta/$archivo'>";
                        switch($ext[1]){
                            case "pdf":$html=$html."<img src='./img/iconos/pdf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "jpg":$html=$html."<img src='./img/iconos/jpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "png":$html=$html."<img src='./img/iconos/png.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;     
                            case "docx":$html=$html."<img src='./img/iconos/docx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;   
                            case "xlsx":$html=$html."<img src='./img/iconos/xlsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;                                      
                            case "jar":$html=$html."<img src='./img/iconos/jar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;  
                            case "html":$html=$html."<img src='./img/iconos/html.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;     
                            case "exe":$html=$html."<img src='./img/iconos/exe.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;        
                            case "rar":$html=$html."<img src='./img/iconos/rar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;                                            
                            case "mp4":$html=$html."<img src='./img/iconos/mp4.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;  
                            case "aac":$html=$html."<img src='./img/iconos/acc.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "ai":$html=$html."<img src='./img/iconos/ai.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "avi":$html=$html."<img src='./img/iconos/avi.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "bmp":$html=$html."<img src='./img/iconos/bmp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "cda":$html=$html."<img src='./img/iconos/cda.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "cdr":$html=$html."<img src='./img/iconos/cdr.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "css":$html=$html."<img src='./img/iconos/css.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "db":$html=$html."<img src='./img/iconos/db.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "dmg":$html=$html."<img src='./img/iconos/dmg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "doc":$html=$html."<img src='./img/iconos/doc.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "docm":$html=$html."<img src='./img/iconos/docm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "dot":$html=$html."<img src='./img/iconos/dot.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "dotm":$html=$html."<img src='./img/iconos/dotm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "dotx":$html=$html."<img src='./img/iconos/dotx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "dwf":$html=$html."<img src='./img/iconos/dwf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "dwg":$html=$html."<img src='./img/iconos/dwg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "eps":$html=$html."<img src='./img/iconos/eps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "fla":$html=$html."<img src='./img/iconos/fla.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "flv":$html=$html."<img src='./img/iconos/flv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "gif":$html=$html."<img src='./img/iconos/gif.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "htm":$html=$html."<img src='./img/iconos/htm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "info":$html=$html."<img src='./img/iconos/info.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "ini":$html=$html."<img src='./img/iconos/ini.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "java":$html=$html."<img src='./img/iconos/java.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "js":$html=$html."<img src='./img/iconos/js.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "mid":$html=$html."<img src='./img/iconos/mid.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "mkv":$html=$html."<img src='./img/iconos/mkv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "mov":$html=$html."<img src='./img/iconos/mov.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "mp3":$html=$html."<img src='./img/iconos/mp3.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "mpg":$html=$html."<img src='./img/iconos/mpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "odp":$html=$html."<img src='./img/iconos/odp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "ods":$html=$html."<img src='./img/iconos/ods.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "odt":$html=$html."<img src='./img/iconos/odt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "php":$html=$html."<img src='./img/iconos/php.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "pot":$html=$html."<img src='./img/iconos/pot.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "potm":$html=$html."<img src='./img/iconos/potm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "potx":$html=$html."<img src='./img/iconos/potx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "pps":$html=$html."<img src='./img/iconos/pps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "ppsm":$html=$html."<img src='./img/iconos/ppsm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "ppsx":$html=$html."<img src='./img/iconos/ppsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "ppt":$html=$html."<img src='./img/iconos/ppt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "pptm":$html=$html."<img src='./img/iconos/pptm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "ppts":$html=$html."<img src='./img/iconos/ppts.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "pptx":$html=$html."<img src='./img/iconos/pptx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "ps":$html=$html."<img src='./img/iconos/ps.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "psd":$html=$html."<img src='./img/iconos/psd.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "pub":$html=$html."<img src='./img/iconos/pub.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "rss":$html=$html."<img src='./img/iconos/rss.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "rtf":$html=$html."<img src='./img/iconos/rtf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "sb2":$html=$html."<img src='./img/iconos/sb2.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "skp":$html=$html."<img src='./img/iconos/skp.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "swf":$html=$html."<img src='./img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "sys":$html=$html."<img src='./img/iconos/sys.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "tif":$html=$html."<img src='./img/iconos/tif.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "txt":$html=$html."<img src='./img/iconos/txt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "wav":$html=$html."<img src='./img/iconos/wav.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "wma":$html=$html."<img src='./img/iconos/wma.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "wmv":$html=$html."<img src='./img/iconos/wmv.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "xlsb":$html=$html."<img src='./img/iconos/xlsb.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "xlsm":$html=$html."<img src='./img/iconos/xlsm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "xlt":$html=$html."<img src='./img/iconos/xlt.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "xltm":$html=$html."<img src='./img/iconos/xltm.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "xltx":$html=$html."<img src='./img/iconos/xltx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;
                            case "xml":$html=$html."<img src='./img/iconos/xml.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "xts":$html=$html."<img src='./img/iconos/xts.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            case "zip":$html=$html."<img src='./img/iconos/zip.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                            default:$html=$html."<img src='./img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;    
                        }                        
                    $html=$html."</a></td>";  
                    $ruta=$carpeta."/".$archivo;
                    $html=$html.'<td style="width:5%;"><a href="javascript:eliminar(\''.$ruta.'\');" style="width:10%">';
                    $html=$html."<img src='./img/iconos/borrar.png' width='25' height='28' alt='Subir Archivo' title='Eliminar Archivo'></a></td>";  
                    $html=$html.'<td style="width:5%;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                    $html=$html."<img src='./img/iconos/ren.png' width='25' height='28' alt='Subir Archivo' title='Renombrar Archivo'></a></td></tr>";                            
                    } 
                 }  
                closedir($dir);
                }
        }
    $html=$html."</tbody></table>";
    $html=$html."</div>";
    echo $html;
  }
}         
    
    public function co_areas(){  
        if($datos  = $this->Consultas_Model->con_areas()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }       
    public function co_docentes($filter = null){  
        if($datos  = $this->Consultas_Model->con_docentes($filter)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }   
    public function co_nodocentes(){  
        if($datos  = $this->Consultas_Model->con_nodocentes()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }     
    public function co_materias($area){  
        if($datos  = $this->Consultas_Model->con_materias($area)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }   
    public function cop_areas(){ 
        $cod        = $this->input->post("buscar");
        if($datos  = $this->Consultas_Model->conp_areas($cod)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    } 
    public function cop_materias($mat,$doc){  
        if($datos  = $this->Consultas_Model->conp_materias($mat,$doc)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }   
    public function con_materias($mat){  
        if($datos  = $this->Consultas_Model->conp_materias($mat,$doc)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");} 
    }     
    public function con_materia($mat){  
        if($datos  = $this->Consultas_Model->con_materia($mat)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }    
    public function con_usuario($usr){  
        if($datos  = $this->Consultas_Model->con_usuario($usr)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }    
    public function con_proyecto($mat){  
        if($datos  = $this->Consultas_Model->con_proyecto($mat)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }   
    public function con_proceso($pro){  
        if($datos  = $this->Consultas_Model->con_proceso($pro)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }      
    public function cop_materias_gen($mat){
        if(is_logged() && logged_user()['rol'] === 'Estudiante'){
            $datos  = $this->Estudiante_Model->groupGradeAsignature(logged_user()['id'], $mat);
            
            if($datos){                   
                echo json_encode($datos);
            }else{echo ("Error en consulta 1");}
        }else{
            if($datos  = $this->Consultas_Model->conp_materias_gen($mat)){                
                echo json_encode($datos);
            } 
            else{echo ("Error en consulta 2");}
		}
    }    
}