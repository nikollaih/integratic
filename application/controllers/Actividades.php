<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades extends CI_Controller {

    function __construct()
    {
        parent::__construct();
         $this->load->helper('form');
         $this->load->helper('html');
         $this->load->helper('url');
         $this->load->model(['Consultas_Model', 'Actividades_Model']);
         $this->load->library('upload');
    }

    public function guardar(){
        if(is_logged()){
            if(logged_user()["rol"] == "Docente"){
                $data = $this->input->post();
                $materia_grupo = $this->session->userdata("materia_grupo");
                $inserted_id = false;
    
                if($data["titulo"] != "" && $data["descripcion"] != "" && $data["disponible_desde"] != "" && $data["disponible_hasta"] != "" && $data["id_periodo"] != ""){
                    $actividad["titulo_actividad"] = $data["titulo"];
                    $actividad["id_periodo"] = $data["id_periodo"];
                    $actividad["porcentaje"] = $data["porcentaje"];
                    $actividad["descripcion_actividad"] = $data["descripcion"];
                    $actividad["disponible_desde"] = date("Y-m-d H:i:s", strtotime($data["disponible_desde"]));
                    $actividad["disponible_hasta"] = date("Y-m-d H:i:s", strtotime($data["disponible_hasta"]));
                    $actividad["materia"] = $materia_grupo["materia"];
                    $actividad["grupo"] = $materia_grupo["grupo"];
                    $actividad["created_by"] = logged_user()["id"];

                    $existsActividad = $this->Actividades_Model->get_actividad($data["id_actividad"]);

                    if($existsActividad){
                        $actividad["id_actividad"] = $data["id_actividad"];
                        $this->Actividades_Model->update($actividad);
                        $inserted_id = $data["id_actividad"];
                    }
                    else $inserted_id = $this->Actividades_Model->create($actividad);
                }
    
                if(isset($_FILES["userfile"]) && $inserted_id){
                    if(isset($_FILES['userfile']['name'])) {
                        $file_name = md5($inserted_id).".".get_file_format($_FILES['userfile']['name']);
                        $file_tmp =$_FILES['userfile']['tmp_name'];
                        move_uploaded_file($file_tmp,"uploads/actividades/".$file_name);
                        $this->Actividades_Model->update(array("id_actividad" => $inserted_id, "url_archivo" => $file_name, "nombre_archivo" => $_FILES['userfile']['name']));
                    }
                }
    
                if($inserted_id){
                    $text = ($existsActividad) ? "Actividad modificada exitosamente" : "Actividad creada exitosamente.";
                    json_response($actividad, true, $text);
                }
                else{
                    json_response(false, false, "Ha ocurrido un error, por favor intente de nuevo");
                }
            }
            else{
                json_response(false, false, "No tiene permisos para realizar esta acción");
            }
        }
    }

    public function guardar_respuesta(){
        if(is_logged()){
            if(logged_user()["rol"] == "Estudiante"){
                $data = $this->input->post();
                $inserted_id = false;
    
                if(isset($_FILES["userfile"])){
                    if(isset($_FILES['userfile']['name'])) {
                        if($data["id_actividad"]){
                            $actividad = $this->Actividades_Model->get_actividad($data["id_actividad"]);
                            $respuesta_previa = $this->Actividades_Model->get_activity_response($data["id_actividad"], logged_user()["id"]);
                            $estudiantes_habilitados = ($actividad["estudiantes_habilitados"]) ? unserialize($actividad["estudiantes_habilitados"]) : [];
                            if(strtotime(date("Y-m-d H:i:s")) < strtotime($actividad["disponible_hasta"]) || in_array(logged_user()["id"], $estudiantes_habilitados)){
                                if($respuesta_previa){
                                    json_response(false, false, "Error, No puede subir más de un archivo por actividad");
                                }
                                else{
                                    $respuesta["id_actividad"] = $data["id_actividad"];
                                    $respuesta["url_archivo"] = "";
                                    $respuesta["created_at"] = date("Y-m-d H:i:s");
                                    $respuesta["estudiante_notas"] = $data["notas"];
                                    $respuesta["created_by"] = logged_user()["id"];
                                    $inserted_id = $this->Actividades_Model->create_response($respuesta);
                                    if($inserted_id){
                                        $file_name = md5($inserted_id).".".get_file_format($_FILES['userfile']['name']);
                                        $file_tmp =$_FILES['userfile']['tmp_name'];
                                        move_uploaded_file($file_tmp,"uploads/actividades/respuestas/".$file_name);
                                        $respuesta["id_respuestas_actividades"] = $inserted_id;
                                        $respuesta["url_archivo"] = $file_name;
                                        $this->Actividades_Model->update_response($respuesta);
                                        json_response(true, true, "Respuesta creada exitosamente.");
                                    }
                                    else json_response(false, false, "Error, Ha ocurrido un error intente de nuevo más tarde");
                                }
                            }
                            else json_response(false, false, "Error, No es posible subir una respuesta en este momento");
                        }
                        else{
                            json_response(false, false, "Error, No se ha seleccionado una actividad");
                        }
                    }
                }
                else{
                    json_response(false, false, "Error, No se ha seleccionado un archivo");
                }
            }
            else{
                json_response(false, false, "Error, No tiene permisos para realizar esta acción");
            }
        }
    }

    public function actividades_respuestas(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $actividad = $this->input->post()["id_actividad"];
                $data_actividad = $this->Actividades_Model->get_actividad($actividad);
                $grupo_materia = $this->session->userdata("materia_grupo");
                $estudiantes = get_students_by_materia($grupo_materia["materia"], $grupo_materia["grupo"]);

                for ($i=0; $i < count($estudiantes); $i++) { 
                    $estudiantes[$i]["respuesta"] = $this->Actividades_Model->get_activity_response($actividad, $estudiantes[$i]["documento"]);
                }

                json_response($this->load->view("actividades/lista_estudiantes_respuestas", array("estudiantes" => $estudiantes, 'actividad' => $data_actividad), true), true, "Lista de estudiantes");
            }
        }
    }

    public function calificar_respuesta(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $data["id_respuestas_actividades"] = $this->input->post()["id"];
                $data["calificacion"] = $this->input->post()["calificacion"];
                $data["docente_notas"] = $this->input->post()["notas"];
                $data["fecha_calificacion"] = date("Y-m-d h:i:s");

                if($this->Actividades_Model->update_response($data)){
                    json_response(null, true, "Calificación actualizada correctamente");
                }
                else{
                    json_response(null, true, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                }
            }
            else{
                json_response(null, false, "No tiene permisos para realizar esta acción");
            }
        }
        else{
            json_response(null, false, "Por favor inicie sesion");
        }
    }

    public function habilitar(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $id_actividad = $this->input->post()["id_actividad"];
                $id_estudiante = $this->input->post()["id_estudiante"];
                $actividad = $this->Actividades_Model->get_actividad($id_actividad);
                if($actividad){
                    $estudiantes_habilitados = ($actividad["estudiantes_habilitados"]) ? unserialize($actividad["estudiantes_habilitados"]) : [];
                    if(!in_array($id_estudiante, $estudiantes_habilitados)){
                        array_push($estudiantes_habilitados, $id_estudiante);
                        $actividad["estudiantes_habilitados"] = serialize($estudiantes_habilitados);
                        if($this->Actividades_Model->update($actividad)){
                            json_response(null, true, "Estudiante habilitado exitosamente");
                        }
                        else json_response(null, false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                    }
                    else json_response(null, false, "El estudiante ya se encuentra habilitado para esta actividad");
                }
                else json_response(null, false, "La actividad seleccionada no existe");
            }
            else json_response(null, false, "No tiene permisos para realizar esta acción");
        }
        else json_response(null, false, "Por favor inicie sesion");
    }

    public function inhabilitar(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $id_actividad = $this->input->post()["id_actividad"];
                $id_estudiante = $this->input->post()["id_estudiante"];
                $actividad = $this->Actividades_Model->get_actividad($id_actividad);
                if($actividad){
                    $estudiantes_habilitados = ($actividad["estudiantes_habilitados"]) ? unserialize($actividad["estudiantes_habilitados"]) : [];
                    if(in_array($id_estudiante, $estudiantes_habilitados)){
                        array_splice($estudiantes_habilitados, array_search($id_estudiante, $estudiantes_habilitados), 1);
                        $actividad["estudiantes_habilitados"] = serialize($estudiantes_habilitados);
                        if($this->Actividades_Model->update($actividad)){
                            json_response(null, true, "Estudiante inhabilitado exitosamente");
                        }
                        else json_response(null, false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                    }
                    else json_response(null, false, "El estudiante ya se encuentra inhabilitado para esta actividad");
                }
                else json_response(null, false, "La actividad seleccionada no existe");
            }
            else json_response(null, false, "No tiene permisos para realizar esta acción");
        }
        else json_response(null, false, "Por favor inicie sesion");
    }
    
    public function asignacion($id){  
        if($datos  = $this->Consultas_Model->asignacion($id)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en asignacion");}
    }
    public function grupos(){  
        if($datos  = $this->Consultas_Model->grupos()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en asignacion");}
    }    
    public function materias(){  
        if($datos  = $this->Consultas_Model->materias()){                   
            echo json_encode($datos);
        } 
    }    
    public function materias_grupo($gra){  
        if($datos  = $this->Consultas_Model->materias_grupo($gra)){                   
            echo json_encode($datos);
        }  
    }     
    function renombrar(){
         $nombre    = $_POST['nombre'];
         $nuevo     = $_POST['nuevo'];
         
         if (file_exists($nombre)){
                rename($nombre,$nuevo);
                echo('Renombrado');
            } else { echo($nombre); }
    }
    function crear(){
        $ruta       = $_POST['ruta'];
        $nomdir     = $_POST['nomdir'];
        $dir=$ruta.'/'.$nomdir;
        
        if (string_to_folder_name($dir)) {
            mkdir(string_to_folder_name($dir), 0777);
            echo('Hecho! '.$dir);
        }else{echo('Error!');}    
}
  
    function eliminar(){
         $nomarc    = $_POST['arc'];
         if(unlink($nomarc)){
             echo("Archivo Eliminado!");
         }
         else{
             echo("Archivo no pudo ser eliminado!");
         }
                 listar_docente($id); 
    }  
    function eliminacar(){
        $nomdir    = $_POST['arc'];         

        $archivos = scandir($nomdir); //hace una lista de archivos del directorio
        $num = count($archivos); //los cuenta

        //Los borramos
        for ($i=0; $i<=$num; $i++) {
         unlink ($archivos[$i]); 
        }
        //borramos el directorio
        rmdir ($nomdir); 
        listar_docente($id);        
    }    

    function listar(){
        $mat    = $_POST['ruta']; 
        $tit    = $_POST['titulo'];                   
        $carpeta=$mat;            
        $html='<div class="panel panel-primary">';        
        $html=$html.'<div class="panel-heading text-capitalize"><b>'.$tit.'</b></div>';
        $html=$html.'<div class="panel-body">';         
        $html=$html."<div class='row' id='migas'><input id='ruta' name='ruta' value='$carpeta' type='hidden'/>";
        $html=$html."<input id='nombre' name='nombre' type='hidden'/>";
        $html=$html."</div>";         
        $html=$html."<table style='width:80%;'><tbody><tr>";
        if (string_to_folder_name($carpeta)) {
            mkdir(string_to_folder_name($carpeta), 0777);
        }
        $carpeta = string_to_folder_name($carpeta);
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                       if (is_dir($carpeta."/".$archivo)){
                           $ruta=$carpeta."/".$archivo;
                            $html=$html.'<td style="width:50%; height:42px"><a href="javascript:submenu_acti(\''.$ruta.'\',\''.$archivo.'\')">';
                            $html=$html."<img src='./img/iconos/carpeta.png' width='25' height='28'>&nbsp;&nbsp;$archivo";
                            $html=$html."</a></td></tr>";  
                            $ruta=$carpeta."/".$archivo;                            
                        } 
                    } 
                }
                closedir($dir);
            }
            $html=$html."<tr>";
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){ 
                    if(string_to_folder_name($carpeta."/".$archivo) && $archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && !is_dir($carpeta."/".$archivo) && !is_dir($carpeta."/".$archivo)){
                        $ext = explode(".", $archivo);
                        $html=$html."<td  style='width:60%; height:42px'>";                                               
                            switch($ext[1]){
                                case "pdf":$html=$html."<img src='./img/iconos/pdf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break; 
                                case "jpg":$html=$html."<img src='./img/iconos/jpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;
                                case "png":$html=$html."<img src='./img/iconos/png.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;     
                                case "docx":$html=$html."<img src='./img/iconos/docx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;   
                                case "xlsx":$html=$html."<img src='./img/iconos/xlsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;    
                                case "pptx":$html=$html."<img src='./img/iconos/pptx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;   
                                case "jar":$html=$html."<img src='./img/iconos/jar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;  
                                case "html":$html=$html."<img src='./img/iconos/html.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;  
                                case "swf":$html=$html."<img src='./img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;   
                                case "exe":$html=$html."<img src='./img/iconos/exe.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;        
                                case "rar":$html=$html."<img src='./img/iconos/rar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;       
                                case "swf":$html=$html."<img src='./img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;     
                                case "mp4":$html=$html."<img src='./img/iconos/mp4.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;                             
                                default:$html=$html."<img src='./img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;    
                            }
                        $ruta=$carpeta."/".$archivo;     
                        $html.="</td><td>".date("d/m/Y h:i a",filectime(utf8_decode($ruta)))."</td></tr>";                                                
                        } 
                     }  
                    closedir($dir);
                    }
            }   
    $html=$html."</tbody></table>";
    $html=$html."</div>";
    echo $html;
}
    function listar_docente($id){
        $mat    = $_POST['mat']; 
        $tit    = $_POST['titulo'];                    
            $carpeta=$tit;            
            $html='<div class="panel panel-primary">';        
            $html=$html.'<div class="panel-heading text-capitalize"><b>'.$tit.'</b></div>';
            $html=$html.'<div class="panel-body">';         
            $html=$html."<div class='row' id='migas'><input id='ruta' name='ruta' value='$carpeta' type='hidden'/>";
            $html=$html."<input id='nombre' name='nombre' type='hidden'/>";
            $html=$html."</div>";         
            $html=$html."<table style='width:80%;'><tbody><tr>";     
            $carpeta = string_to_folder_name($carpeta);       
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                       if (is_dir($carpeta."/".$archivo)){
                           $ruta=$carpeta."/".$archivo;
                            $html=$html.'<td  style="width:50%; height:42px"><a href="javascript:submenu_doc(\''.$ruta.'\',\''.$archivo.'\')">';
                            $html=$html."<img src='./img/iconos/carpeta.png' width='35' height='30'>&nbsp;&nbsp;$archivo";
                            
                            
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

    function listar_act_doc(){  
        $titulo     = $_POST['titulo']; 
        $carpeta    = $_POST['ruta'];
        $ref= $_POST['ruta']."/".$titulo;
        $ref=str_replace("/", "-", $carpeta);
        $ref=str_replace(" ", "~", $ref); 
        $ref=utf8_decode($ref);
        $nombre=str_replace(" ", "~", $titulo);                
        $html="<div class='panel panel-primary'>";        
        $html=$html."<div class='panel-heading text-capitalize'><b><div id='titulo'>".htmlentities($titulo)."</div></b></div>";
        $html=$html."<div class='panel-body'>";         
        $html=$html."<div class='row' id='migas'><input id='ruta' name='ruta' value=".htmlentities($carpeta)." type='hidden'/>";
        $html=$html."<input id='nombre' name='nombre' type='hidden'/>";
        $html=$html."<div class='col-lg-12' style='float:right;'>";        
        $html=$html."<a href='javascript:crear();' style='width:10%'>";
        $html=$html."<img src='./img/iconos/nueva_carpeta.png' width='32' height='32' alt='Nueva Carpeta' title='Nueva Carpeta'></a>&nbsp;";
        $html=$html.'<a href="./index.php/upload/bajar_carpeta/'.$ref; 
        $html=$html.'-/'.$nombre.'" style="width:10%">';
        $html=$html."<img src='./img/iconos/bajar.png' width='25' height='28' alt='Descargar Carpeta' title='Descargar Carpeta'></a>";        
        $html=$html."</div></div>";         
        $html=$html."<table style='width:100%;'><tbody>";
        if (string_to_folder_name($carpeta)) {mkdir(string_to_folder_name($carpeta), 0777);}
        $carpeta = string_to_folder_name($carpeta);
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                       if (is_dir($carpeta."/".$archivo)){                        
                            $ruta=$carpeta."/".$archivo;
                            $ref=str_replace("/", "-", $ruta);
                            $ref=str_replace(" ", "~", $ref);
                            $nombre=str_replace(" ", "~", $archivo);                            
                            $html=$html.'<tr><td  style="width:50%; height:42px"><a href="javascript:submenu_doc(\''.$ruta.'\',\''.$archivo.'\')">'; 
                            $html=$html."<img src='./img/iconos/carpeta.png' width='35' height='30'>&nbsp;&nbsp;$archivo";                                                        
                            $html=$html."</a></td>";  
                            $ruta=$carpeta."/".$archivo;
                            date_default_timezone_set ('America/Bogota');
                            setlocale(LC_ALL,"es_ES");
                            $html.="<td>".date("d/m/Y h:i a",filectime(utf8_decode($ruta)))."</td>";   
                            $html=$html.'<td style="width:5%;"><a href="javascript:elicar(\''.$ruta.'\');" style="width:10%">';
                            $html=$html."<img src='./img/iconos/borrar.png' width='25' height='28' alt='Eliminar Archivo' title='Eliminar Carpeta'></a></td>";  
                            $html=$html.'<td style="width:5%;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                            $html=$html."<img src='./img/iconos/ren.png' width='25' height='28' alt='Renombrar Archivo' title='Renombrar Carpeta'></a></td>"; 
                            $html=$html.'<td style="width:5%;"><a href="./index.php/upload/bajar_carpeta/'.$ref.'/'.$nombre.'" style="width:10%">';
                            
                            $html=$html."<img src='./img/iconos/bajar.png' width='25' height='28' alt='Descargar Carpeta' title='Descargar Carpeta'></a></td></tr>";                             
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
                                case "zip":$html=$html."<img src='./img/iconos/zip.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break; 
                                default:$html=$html."<img src='./img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";break;    
                            }                        
                        $html=$html."</a></td>";  
                        $ruta=$carpeta."/".$archivo;
                        $html.="<td>".date("d/m/Y h:i a",filectime(utf8_decode($ruta)))."</td>";                        
                        $html=$html.'<td style="width:5%;"><a href="javascript:eliminar(\''.$ruta.'\');" style="width:10%">';
                        $html=$html."<img src='./img/iconos/borrar.png' width='25' height='28' alt='Subir Archivo' title='Eliminar Archivo'></a></td>";  
                        $html=$html.'<td style="width:5%;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                        $html=$html."<img src='./img/iconos/ren.png' width='25' height='28' alt='Subir Archivo' title='Renombrar Archivo'></a></td>";   
                        $html=$html.'<td style="width:5%;"><a href="'.$carpeta."/".$archivo.'" style="width:10%" download>';
                        $html=$html."<img src='./img/iconos/bajar.png' width='25' height='28' alt='Subir Archivo' title='Descargar Archivo'></a></td></tr>";                                                   
                        } 
                     }  
                    closedir($dir);
                    }
            }
        $html.="</tbody></table>";
        $html.="</div>";
        $html.="<input id='modulo' name='modulo' value='AC' type='hidden'>";
        echo $html;
    } 
    function listar_docente1($id){
        if($datos  = $this->Consultas_Model->asignacion($id)){
            $html='';
            foreach ($datos as $row){
            $carpeta="./principal/areas/actividades/".$row->nommateria.$row->grado;
            $html=$html.'<div class="panel panel-primary">';        
            $html=$html.'<div class="panel-heading text-capitalize"><b>'.$row->nommateria.' '.$row->grado.'</b></div>';
            $html=$html.'<div class="panel-body">';         
            $html=$html."<div class='row' id='migas'><input id='ruta' name='ruta' value='$carpeta' type='hidden'/>";
            $html=$html."<input id='nombre' name='nombre' type='hidden'/>";
            $html=$html."</div>";         
            $html=$html."<table style='width:80%;'><tbody><tr>";            
            if (!is_dir(string_to_folder_name($carpeta))) {mkdir(string_to_folder_name($carpeta), 0777);}
            $carpeta = string_to_folder_name($carpeta);
            if(is_dir($carpeta)){
                if($dir = opendir($carpeta)){
                    while(($archivo = readdir($dir)) !== false){
                        if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                           if (is_dir($carpeta."/".$archivo)){
                               $ruta=$carpeta."/".$archivo;
                                $html=$html.'<td  style="width:50%; height:42px"><a href="javascript:submenu_doc(\''.$ruta.'\',\''.$archivo.'\')">';
                                $html=$html."<img src='./img/iconos/carpeta.png' width='25' height='28'>&nbsp;&nbsp;$archivo";
                                $html=$html."</a></td></tr>";  
                                $ruta=$carpeta."/".$archivo;                            
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
                                    case "pdf":
                                        $html=$html."<img src='./img/iconos/pdf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break; 
                                    case "jpg":
                                        $html=$html."<img src='./img/iconos/jpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;
                                    case "png":
                                        $html=$html."<img src='./img/iconos/png.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;     
                                    case "docx":
                                        $html=$html."<img src='./img/iconos/docx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;   
                                    case "xlsx":
                                        $html=$html."<img src='./img/iconos/xlsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;    
                                    case "pptx":
                                        $html=$html."<img src='./img/iconos/pptx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;   
                                    case "jar":
                                        $html=$html."<img src='./img/iconos/jar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;  
                                    case "html":
                                        $html=$html."<img src='./img/iconos/html.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;  
                                    case "swf":
                                        $html=$html."<img src='./img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;   
                                    case "exe":
                                        $html=$html."<img src='./img/iconos/exe.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;        
                                    case "rar":
                                        $html=$html."<img src='./img/iconos/rar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;       
                                    case "swf":
                                        $html=$html."<img src='./img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;     
                                    case "mp4":
                                        $html=$html."<img src='./img/iconos/mp4.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;                             
                                    default:
                                        $html=$html."<img src='./img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                    break;    
                                }
                            $html=$html."</a></td>";  
                            $ruta=$carpeta."/".$archivo;
                            $html=$html.'<td style="width:5%;"><a href="javascript:eliminar_acti(\''.$ruta.'\');" style="width:10%">';
                            $html=$html."<img src='./img/iconos/borrar.png' width='25' height='28'></a></td>";  
                            $html=$html.'<td style="width:5%;"><a href="javascript:renombrar(\''.$carpeta.'\',\''.$archivo.'\');" style="width:10%">';
                            $html=$html."<img src='./img/iconos/ren.png' width='25' height='28'></a></td></tr>";                          
                            } 
                         }  
                        closedir($dir);
                        }
                }
         $html=$html."</tbody></table>";
         $html=$html."</div>";                               
            }  
        }   
        echo $html;
    }
    
    function delete($id_actividad = null){
        if(is_logged()){
            if(logged_user()["rol"] == "Docente"){
                $actividad = $this->Actividades_Model->get_actividad($id_actividad);
                if($actividad){
                    if($actividad["created_by"] == logged_user()["id"]){
                        if($this->Actividades_Model->delete_responses($id_actividad)){
                            if($this->Actividades_Model->delete($id_actividad)){
                                json_response(array("error" => false), true, "Actividad eliminada correctamente");
                            }
                            else json_response(array("error" => "error"), false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                        }
                        else json_response(array("error" => "error"), false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                    }
                    else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
                }
                else  json_response(array("error" => "not_found"), false, "No se ha encontrado la actividad seleccionada");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }

    function deleteRespuesta($id_respuesta = null){
        if(is_logged()){
            if(logged_user()["rol"] == "Docente"){
                $actividad = $this->Actividades_Model->delete_response($id_respuesta);
                if($actividad){
                    json_response(array("error" => false), true, "Respuesta eliminada correctamente");
                }
                else  json_response(array("error" => "not_found"), false, "No se ha encontrado la actividad seleccionada");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }

    function getActividad($id_actividad = null){
        if(is_logged()){
            if(logged_user()["rol"] == "Docente"){
                $actividad = $this->Actividades_Model->get_actividad($id_actividad);
                if($actividad){
                    json_response($actividad, true, "Actividad");
                }
                else  json_response(array("error" => "not_found"), false, "No se ha encontrado la actividad seleccionada");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }
}