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

if(!function_exists('get_periodos'))
{
    function get_periodos(){
        $CI = &get_instance();
        $CI->load->model("Periodos_Model");
        
        $semanas = $CI->Periodos_Model->getAll();
        return $semanas;
    }

}
