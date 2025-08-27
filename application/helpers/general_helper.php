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
            return min(100, round(($current / $total) * 100));
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

if (!function_exists('get_years')) {
    /**
     * Diferencia en años entre dos fechas (solo años enteros).
     *
     * @param string $start_date Fecha inicio en formato Y-m-d (p.ej., "2021-02-05")
     * @param string $end_date   Fecha fin en formato Y-m-d (p.ej., "2025-08-27")
     * @param bool   $absolute   true = siempre positivo (por defecto), false = respeta el signo
     * @return int               Años de diferencia (enteros)
     *
     * @throws InvalidArgumentException Si el formato/fecha es inválido o los parámetros no son string.
     */
    function get_years($start_date, $end_date, $absolute = true)
    {
        // 1) Tipo y vacío
        if (!is_string($start_date) || !is_string($end_date)) {
            return 0;
        }
        $start_date = trim($start_date);
        $end_date   = trim($end_date);
        if ($start_date === '' || $end_date === '') {
            return 0;
        }

        // 2) Parseo estricto con createFromFormat y verificación de errores
        $start = DateTime::createFromFormat('Y-m-d', $start_date);
        $startErrors = DateTime::getLastErrors();

        $end = DateTime::createFromFormat('Y-m-d', $end_date);
        $endErrors = DateTime::getLastErrors();

        // 3) Validar formato exacto (incluye ceros a la izquierda) y fechas reales
        $isStartValid = $start instanceof DateTime
            && $startErrors['warning_count'] === 0
            && $startErrors['error_count'] === 0
            && $start->format('Y-m-d') === $start_date;

        $isEndValid = $end instanceof DateTime
            && $endErrors['warning_count'] === 0
            && $endErrors['error_count'] === 0
            && $end->format('Y-m-d') === $end_date;

        if (!$isStartValid) {
            return 0;
        }
        if (!$isEndValid) {
            return 0;
        }

        // 4) Diferencia en años (enteros)
        $diff = $start->diff($end);
        $years = (int) $diff->y;

        // 5) Signo opcional
        if (!$absolute && $diff->invert === 1) {
            $years = -$years;
        }

        return $years;
    }
}


if (!function_exists('tipos_documento')) {
    function tipos_documento(): array {
        return [
            'RC'   => "Registro Civil (RC)",
            'NIP'  => "Número de Identificación Personal (NIP)",
            'NUIP' => "Número Único de Identificación Personal (NUIP)",
            'TI'   => "Tarjeta de Identidad (TI)",
            'CC'   => "Cédula de Ciudadanía (CC)",
            'PEP'  => "Permiso Especial de Permanencia (PEP)",
            'PPT'  => "Permiso por Protección Temporal (PPT)",
            'Otro' => "Otro",
        ];
    }
}
?>