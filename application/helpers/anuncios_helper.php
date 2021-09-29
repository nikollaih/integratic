<?php
    if(!function_exists('anuncios_notificaciones'))
    {
        function anuncios_notificaciones($query = false){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(array("Estudiante_Model"));
            $user = $CI->session->userdata('logged_in');

            $notificaciones_dom = "";
            if(isset($user["grado"])){
                $anuncios = $CI->Estudiante_Model->getAnuncios($user["grado"], $user["grupo"], $user["ultima_fecha_anuncios"], $query);
       
                if($anuncios){
                   foreach ($anuncios as $anuncio) {
                      $notificaciones_dom .= $CI->load->view("anuncios/item_notificacion", $anuncio, TRUE);
                   }
                }
            }

            return $notificaciones_dom;
        }
    
    }
?>