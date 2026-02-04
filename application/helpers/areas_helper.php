<?php
if(!function_exists('get_areas'))
{
    function get_areas(){
        $CI = &get_instance();
        $CI->load->model('Areas_Model');
        return $CI->Areas_Model->getall();
    }
}