<?php
    if(!function_exists('logged_user'))
    {
        function logged_user(){
            $CI = &get_instance();
            $CI->load->library('session');
            return $CI->session->userdata('logged_in');
        }
    
    }
?>