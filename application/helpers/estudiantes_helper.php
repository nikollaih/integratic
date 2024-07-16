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

    if(!function_exists('get_students_by_materia'))
    {
        function get_students_by_materia($id_materia, $grupo = null){
            $CI = &get_instance();
            $CI->load->model(['Estudiante_Model', 'Materias_Model']);
            $materia = $CI->Materias_Model->getMateria($id_materia);
            $estudiantes = $CI->Estudiante_Model->getStudentsByMateriaGroup($materia["grado"].$grupo);
            return $estudiantes;
        }
    
    }

    if(!function_exists('get_students_by_grado'))
    {
        function get_students_by_grado($grado){
            $CI = &get_instance();
            $CI->load->model(['Estudiante_Model', 'Materias_Model']);
            return $CI->Estudiante_Model->getStudentsByGrado($grado);
        }
    
    }

if(!function_exists('get_student_by_document'))
{
    function get_student_by_document($documento){
        $CI = &get_instance();
        $CI->load->model(['Estudiante_Model']);
        return $CI->Estudiante_Model->getStudentUserByDocument($documento);
    }

}

    if(!function_exists('mover_estudiantes_participantes_prueba'))
    {
        function mover_estudiantes_participantes_prueba($estudiantes){
            $participantes = [];
            $CI = &get_instance();
            $CI->load->model(['Estudiante_Model', 'Participantes_Prueba_Model']);
            
            if(is_array($estudiantes)){
                foreach ($estudiantes as $e) {
                    if($e["documento"]){
                        $temp_name = explode(" ", $e["nombre"]);
                        $split_name = [];
                        for ($i=0; $i < count($temp_name); $i++) { 
                            if(trim($temp_name[$i]) != ""){
                                array_push($split_name, $temp_name[$i]);
                            }
                        }

                        if(count($split_name) == 4){
                            $apellidos = $split_name[2] . " " . $split_name[3];
                            $nombres = $split_name[0] . " " . $split_name[1];
                        }
                        else if(count($split_name) == 3){
                            $apellidos = $split_name[1] ." ".$split_name[2];
                            $nombres = $split_name[0];
                        }
                        else {
                            $nombres = $split_name[0];
                            $apellidos = $split_name[1];
                        }

                        $data["identificacion"] = $e["documento"];
                        $data["nombres"] = $nombres;
                        $data["apellidos"] = $apellidos;

                        $user = $CI->Participantes_Prueba_Model->get_participante_by_identificacion($e["documento"]);
                        if(!$user){
                            $data["telefono"] = "";
                            $data["email"] = "";
                            $data["institucion"] = configuracion()["nombre_institucion"];
                            $data["grado"] =  $e["grado"];
                            array_push($participantes, $CI->Participantes_Prueba_Model->create($data));
                        }
                        else{
                            array_push($participantes, $CI->Participantes_Prueba_Model->update($data));
                        }
                    }
                }
            }

            return $participantes;
        }
    }

    function getNombresApellidos($nombre){
        $nombres = "";
        $apellidos = "";
        $temp_name = explode(" ", $nombre);
        $split_name = [];
        for ($i=0; $i < count($temp_name); $i++) { 
            if(trim($temp_name[$i]) != ""){
                array_push($split_name, $temp_name[$i]);
            }
        }

        if(count($split_name) == 4){
            $nombres = $split_name[2] . " " . $split_name[3];
            $apellidos = $split_name[0] . " " . $split_name[1];
        }
        else if(count($split_name) == 3){
            $nombres = $split_name[2];
            $apellidos = $split_name[0] . " " . $split_name[1];
        }
        else {
            $nombres = $split_name[1];
            $apellidos = $split_name[0];
        }

        return array(
            "nombres" => $nombres,
            "apellidos" => $apellidos
        );
    }
?>