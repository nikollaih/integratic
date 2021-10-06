<?php
    if(!function_exists('get_group_grade'))
    {
        function get_group_grade($documento){
            $CI = &get_instance();
            $CI->load->model('Estudiante_Model');
            $data["grupo"] = $CI->Estudiante_Model->getStudentGroupGrade($documento);
            $data["grado"] = $CI->Estudiante_Model->getStudentGrade($documento);
            
            return $data;
        }
    
    }

    if(!function_exists('obtener_contador_anuncios'))
    {
        function obtener_contador_anuncios(){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model('Estudiante_Model');

            $user = $CI->session->userdata('logged_in');

            if(isset($user["grado"])){
                $anuncios = $CI->Estudiante_Model->getAnuncios($user["grado"], $user["grupo"], $user["ultima_fecha_anuncios"]);
                return ($anuncios) ? count($anuncios) : 0;
            }

            return 0;
        }
    
    }
?>