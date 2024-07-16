<?php

class CaracterizacionEstudiantes extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(["CaracterizacionEstudiantesPreguntas_Model", "CaracterizacionEstudiantesRespuestas_Model", "Estudiante_Model", "DireccionGrupo_Model"]);
    }

    public function completar($idEstudiante = null) {
        if(is_logged()) {
            $id_estudiante = ($idEstudiante) ? $idEstudiante : logged_user()["id"];
            $estudiante = get_student_by_document($id_estudiante);

            if(!$estudiante) {
                header("Location: ".base_url());
            }

            // Recibe las respuestas almacenadas por el usuario y las envia a la función de guardar.
            if($this->input->post()) {
                $this->guardar($this->input->post(), $id_estudiante);
                $params["message"] = "Información actualizada exitosamente.";
            }

            $params["estudiante"] = $estudiante;
            $params["editable"] = (!$idEstudiante);
            $params["preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
            $params["respuestas"] = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($estudiante["documento"]);

            $this->load->view("caracterizacion_estudiantes/completar", $params);
        }
        else header("Location: ".base_url());
    }

    private function guardar($respuestas, $idEstudiante) {
        $model = $this->CaracterizacionEstudiantesRespuestas_Model;

        foreach ($respuestas as $index => $respuesta) {
            $userRespuesta = $respuesta;
            $userRespuestaOtro = "";

            // Procesar respuestas que son arrays (como opciones múltiples)
            if (is_array($respuesta)) {
                if (array_key_exists("other", $respuesta)) {
                    $userRespuestaOtro = $respuesta["other"];
                    unset($respuesta["other"]);
                }
                $userRespuesta = (count($respuesta) > 0) ? serialize($respuesta) : "";
            }

            // Preparar nueva respuesta
            $newRespuesta = [
                "id_estudiante" => $idEstudiante,
                "id_pregunta" => $index,
                "respuesta" => $userRespuesta,
                "respuesta_otro" => $userRespuestaOtro
            ];

            // Verificar si ya existe la respuesta
            $existsRespuesta = $model->existsRespuesta($idEstudiante, $index);

            // Actualizar o insertar la respuesta
            if ($existsRespuesta) {
                $model->updateRespuesta($idEstudiante, $index, $newRespuesta);
            } else {
                if($newRespuesta["respuesta"] != "" || $newRespuesta["respuesta_otro"] != ""){
                    $model->setRespuesta($newRespuesta);
                }
            }
        }
    }

    public function filtrar() {
        if(is_logged() && strtolower(logged_user()['rol']) != 'estudiante'){
            $params["filtros"]["grado"] = "";
            $params["grados"] = $this->Estudiante_Model->getGrados();

            // Si el usuario logueado es un docente, se aplicará el filtro de dirección de grupo
            // para traer unicamente los estudiantes que pertenezcan a su grupo.
            if(strtolower(logged_user()['rol']) == 'docente'){
                $params["direccion_grupo"] = $this->DireccionGrupo_Model->getByDocente(logged_user()["id"]);
                if($params["direccion_grupo"]) {
                    $params["filtros"]["grado"] = $params["direccion_grupo"]["grado"];
                }
            }

            // Si viene algún filtro estos será aplicados
            if($this->input->post()){
                if(strtolower(logged_user()['rol']) != 'docente') {
                    $params["filtros"]["grado"] = $this->input->post("grado");
                }
            }

            $params["estudiantes"] = $this->Estudiante_Model->getCaracterizacionEstudiantes($params["filtros"]);
            $params["cantidad_preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
            $this->load->view("caracterizacion_estudiantes/filtrar", $params);
        }
        else{
            header("Location: ".base_url());
        }
    }
}