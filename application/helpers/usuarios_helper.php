<?php
    if(!function_exists('get_estudiante_materias'))
    {
        function get_estudiante_materias($id_usuario){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(["Usuarios_Model"]);
            $grupo_grado = get_group_grade($id_usuario);
        }
    }
?>

<?php
    if(!function_exists('get_docente_materias'))
    {
        function get_docente_materias($id_docente, $only_ids = false){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model(["Materias_Model"]);
            $ids = [];

            $materias = $CI->Materias_Model->getMateriasDocente($id_docente);

            if($only_ids){
                if($materias){
                    for ($i=0; $i < count($materias); $i++) { 
                        array_push($ids, $materias[$i]["materia"]);
                    }

                    return $ids;
                }
            }

            return $materias;
        }
    }
?>