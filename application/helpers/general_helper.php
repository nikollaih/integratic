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

                    $nombres = "";
                    $apellidos = "";
                    if(count($split_name) == 6){
                        $nombres = $split_name[4]." ".$split_name[5];
                        $apellidos = $split_name[0] . " " . $split_name[1]. " " . $split_name[2]. " " . $split_name[3];
                    }

                    if(count($split_name) == 5){
                        $nombres = $split_name[3] . " ". $split_name[4];
                        $apellidos = $split_name[0] . " " . $split_name[1]. " " . $split_name[2];
                    }

                    if(count($split_name) == 4){
                        $nombres = $split_name[2] . " " . $split_name[3];
                        $apellidos = $split_name[0] . " " . $split_name[1];
                    }

                    if(count($split_name) == 3){
                        $nombres = $split_name[2];
                        $apellidos = $split_name[0] . " " . $split_name[1];
                    }

                    if(count($split_name) == 2){
                        $nombres = $split_name[1];
                        $apellidos = $split_name[0];
                    }

                    $data["nombres"] = $nombres;
                    $data["apellidos"] = $apellidos;
                    $data["id"] = trim($e["documento"]);
                    $data["email"] = trim($e["email"]);
                    $data["cargo"] = "Estudiante";
                    $data["rol"] = "Estudiante";
                    $data["usuario"] = $e["documento"];
                    $data["clave"] =  trim($e["documento"]);
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

    // Print a json response for ajax calls
    if(!function_exists('string_to_folder_name'))
    {
        function string_to_folder_name($stringName){
            return strtr(utf8_decode($stringName), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
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

    if(!function_exists('configuracion'))
    {
        function configuracion(){
            $CI = &get_instance();
            $CI->load->model("Configuracion_Model");
            
            return $CI->Configuracion_Model->getConfiguracion();
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

    if(!function_exists('get_grados'))
    {
        function get_grados(){
            $CI = &get_instance();
            $CI->load->model("Estudiante_Model");

            return $CI->Estudiante_Model->getGrados();
        }
    }

    if(!function_exists('getPercentFromNumber'))
    {
        function getPercentFromNumber($current, $total){
            if ($total == 0) {
                return 0; // Avoid division by zero
            }
            return round(($current / $total) * 100);
        }
    }

    if(!function_exists('getNivelesEducativos'))
    {
        function getNivelesEducativos(){
            return ["Sin estudios", "Primaria", "Secundaria", "Técnico", "Tecnólogo", "Profesional", "Posgrado"];
        }
    }

    if(!function_exists('getParentescos'))
    {
        function getParentescos(){
            return ["Madre", "Padre", "Abuelo", "Abuela", "Tio", "Tia", "Profesional de salud", "Otro"];
        }
    }

    if(!function_exists('getGrados'))
    {
        function getGrados(){
            return ["Transición", "Primero", "Segundo", "Tercero", "Cuarto", "Quinto", "Sexto", "Septimo", "Octavo", "Noveno", "Décimo", "Once"];
        }
    }

    if(!function_exists('get_years'))
    {
        function get_years($start_date, $end_date) {
            $start = new DateTime($start_date);
            $end = new DateTime($end_date);
            $diff = $start->diff($end);
            return $diff->y;
        }
    }
?>