<?php
if(!function_exists('get_grupos_docente'))
{
    function get_grupos_docente($id_docente){
        $CI = &get_instance();
        $CI->load->model(["Materias_Model"]);
        $materiasDocente = $CI->Materias_Model->getMateriasDocente($id_docente);
        $query = [];
        if(is_array($materiasDocente)){
            foreach ($materiasDocente as $materiaDocente) {
                $materia["materia"] = $materiaDocente["codmateria"];
                $materia["grado"] = $materiaDocente["grado"].$materiaDocente["grupo"];
                array_push($query, $materia);
            }
        }
        
        return $query;
    }

}