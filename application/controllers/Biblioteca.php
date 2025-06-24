<?php
  
   class Biblioteca extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model('General_Model');
    }

function listar_filtro(){ 
        $carpeta    = $_POST['ruta']; 
        $filtro     = $_POST['filtro'];            
        $html='<div class="panel panel-primary">';
        $html=$html.'<div class="panel-heading"><b><div id="rutas"></div></b></div>';
        $html=$html.'<div class="panel-body">';  
        $html=$html."<table style='width:80%;'><tbody><tr>";
        $i=0;
        $carpeta = string_to_folder_name($carpeta);
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                       if (is_dir($carpeta."/".$archivo)){
                            //solo si el archivo es un directorio, distinto que "." y ".."                           
                           $ruta=utf8_encode($carpeta."/".$archivo);
                            $html=$html.'<td  style="width:50%; height:42px"><a href="javascript:submenu(\''.$ruta.'\',\''.$archivo.'\')">';
                            $html=$html."<img src='./img/iconos/carpeta.png' width='35' height='30'>&nbsp;&nbsp;$archivo</td></tr>";
                        } 
                    } 
                }
                closedir($dir);
            }
            $html=$html."<tr>";
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){ 
                    if(string_to_folder_name($carpeta."/".$archivo) && $archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && !is_dir($carpeta."/".$archivo)){
                        $tfiltro = strtolower($filtro);
                        $tarchivo= strtolower($archivo);
                        if (fnmatch("*".$tfiltro."*", $tarchivo)) {
                            $i++;
                            $ext = explode(".", $archivo);
                            $html=$html."<td  style='width:40%; height:42px'><a target='_blank' href='$carpeta/$archivo'>";                                               
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
                                    case "zip":$html=$html."<img src='./img/iconos/xts.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                    default:$html=$html."<img src='./img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;    
                                }
                            }    
                        }                         
                        if($i%2==0){
                            $html=$html."</tr><tr>";
                            }    
                        }   
                    closedir($dir);
                    }
                $html=$html."</a></td>";                               
            } 
        $html=$html."</tr></tbody></table>";
        $html=$html."</div>";
        $html=$html."</div></div>";
        echo $html;
} 
      
    

} 
