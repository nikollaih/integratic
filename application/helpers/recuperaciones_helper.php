<?php
if(!function_exists('notas_estudiante_recuperacion')) {
    function notas_estudiante_recuperacion($id_recuperacion, $id_estudiante)
    {
        $notas = [
            "actividades" => 0,
            "pruebas" => 0,
            "ponderado" => 0
        ];

        $CI = &get_instance();
        $CI->load->library('session');
        $CI->load->model(array("Pruebas_Model", "Participantes_Prueba_Model", "Respuestas_Realizar_Prueba_Model"));

        $coreParticipant = $CI->Participantes_Prueba_Model->get($id_estudiante);
        // Get the pruebas belongs to the process
        $pruebas = $CI->Pruebas_Model->getPruebasRecuperacion($id_recuperacion);
        if(is_array($pruebas) && count($pruebas) > 0) {
            for ($i = 0; $i < count($pruebas); $i++) {
                $divide_by = ($i === 0) ? 1 : 2;
                // Get the student qualification belongs to each test
                $respuesta = $CI->Respuestas_Realizar_Prueba_Model->get_note_by_prueba_participante( $pruebas[$i]["id_prueba"], $coreParticipant["id_participante_prueba"]);
                if($respuesta){
                    $notas["pruebas"] = ($notas["pruebas"] + $respuesta["nota"]) / $divide_by;
                }
            }
        }

        // Get the activities belongs to the process
        $actividades = $CI->Actividades_Model->getActivitiesRecuperacion($id_recuperacion);
        if(is_array($actividades) && count($actividades) > 0) {
            for ($i = 0; $i < count($actividades); $i++) {
                $divide_by = ($i === 0) ? 1 : 2;
                // Get the student qualification belongs to each activity
                $respuesta = $CI->Actividades_Model->get_activity_response($actividades[$i]["id_actividad"], $id_estudiante);

                if($respuesta){
                    $nota = get_percent_value_qualification($respuesta["calificacion"], configuracion()["calificacion_sobre"], $actividades[$i]["porcentaje"]);
                    $notas["actividades"] = $notas["actividades"] + $nota;
                }
            }
        }

        $notas["ponderado"] = ($notas["actividades"] + $notas["pruebas"]) / 2;

        return $notas;
    }
}