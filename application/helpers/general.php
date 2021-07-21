<?php
    if(!function_exists('mover_estudiantes_usuarios'))
    {
        function mover_estudiantes_usuarios(){
            $CI = &get_instance();
            $CI->load->model('Estudiante_Model');
            
            $estudiantes = $CI->Estudiante_Model->getAll();
            print($estudiantes);
        }
    
    }
?>