<?php
    if(!function_exists('mover_estudiantes_usuarios'))
    {
        function mover_estudiantes_usuarios(){
            $CI = &get_instance();
            $CI->load->model(['Estudiante_Model', 'General_Model', 'Usuarios_Model']);
            
            $estudiantes = $CI->Estudiante_Model->getAll();
            
            if(is_array($estudiantes)){
                foreach ($estudiantes as $e) {
                    $temp_name = explode(" ", $e["nombre"]);
                    $split_name = [];
                    for ($i=0; $i < count($temp_name); $i++) { 
                        if(trim($temp_name[$i]) != ""){
                            array_push($split_name, $temp_name[$i]);
                        }
                    }

                    $data["nombres"] = (count($split_name) == 4) ? $split_name[2] . " " . $split_name[3] : $split_name[2];
                    $data["apellidos"] = $split_name[0] . " " . $split_name[1];
                    $data["id"] = $e["documento"];
                    $data["cargo"] = "Estudiante";
                    $data["rol"] = "Estudiante";
                    $data["usuario"] = $e["documento"];
                    $data["clave"] =  $e["documento"];
                    $data["estado"] = "ac";

                    $user = $CI->Usuarios_Model->get_user($e["documento"]);
                    if(!$user){
                        $CI->General_Model->insertar("usuarios", $data);
                    }
                }

                
            }
        }
    
    }

     // Print a json response for ajax calls
     if(!function_exists('json_response'))
     {
         function json_response($obj = null, $status = false, $text = ""){
             echo json_encode(array("object" => $obj, "status" => $status, "message" => $text));
             die();
         }
     
     }

    if(!function_exists('encrypt_string'))
    {
        function encrypt_string($string, $url_format = false){
            $CI = &get_instance();
            $CI->load->library("encryption");
            
            if($url_format){
                return urlencode($CI->encryption->encrypt($string));
            }
            else{
                return $CI->encryption->encrypt($string);
            }
        }
    
    }

    if(!function_exists('decrypt_string'))
    {
        function decrypt_string($string, $url_format = false){
            $CI = &get_instance();
            $CI->load->library("encryption");
            
            if($url_format){
                return $CI->encryption->decrypt(urldecode($string));
            }
            else{
                return $CI->encryption->decrypt($string);
            }
        }
    
    }
?>