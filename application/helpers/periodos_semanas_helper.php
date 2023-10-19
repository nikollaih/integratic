<?php
if(!function_exists('get_semanas_by_ids'))
{
    function get_semanas_by_ids($semanasIDs){
        $CI = &get_instance();
        $CI->load->model("SemanasPeriodo_Model");
        
        $semanas = $CI->SemanasPeriodo_Model->getByIDs($semanasIDs);
        return $semanas;
    }

}