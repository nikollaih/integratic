<?php
use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * Class CaracterizacionEstudiantes
 *
 * Controlador para gestionar la caracterización de estudiantes.
 * @property $Estudiante_Model
 * @property $input
 * @property $CaracterizacionEstudiantesPreguntas_Model
 * @property $CaracterizacionEstudiantesRespuestas_Model
 * @property $DireccionGrupo_Model
 * @property $load
 * @property $output
 */
class CaracterizacionEstudiantes extends CI_Controller
{
    /**
     * CaracterizacionEstudiantes constructor.
     *
     * Carga los modelos necesarios para la caracterización de estudiantes.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(["CaracterizacionEstudiantesPreguntas_Model", "CaracterizacionEstudiantesRespuestas_Model", "Estudiante_Model", "DireccionGrupo_Model"]);
    }

    /**
     * Método para completar la caracterización de un estudiante.
     *
     * @param int|null $idEstudiante ID del estudiante (opcional).
     */
    public function completar($idEstudiante = null) {
        if(is_logged()) {
            $id_estudiante = ($idEstudiante) ? $idEstudiante : logged_user()["id"];
            $estudiante = get_student_by_document($id_estudiante);

            if(!$estudiante) {
                header("Location: ".base_url());
                exit;
            }

            // Procesa las respuestas enviadas por el usuario.
            if($this->input->post()) {
                $this->guardar($this->input->post(), $id_estudiante);
                $params["message"] = "Información actualizada exitosamente.";
            }

            $params["estudiante"] = $estudiante;
            $params["editable"] = (!$idEstudiante);
            $params["preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
            $params["respuestas"] = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($estudiante["documento"]);

            $this->load->view("caracterizacion_estudiantes/completar", $params);
        } else {
            header("Location: ".base_url());
        }
    }

    /**
     * Método privado para guardar las respuestas de la caracterización.
     *
     * @param array $respuestas Respuestas del estudiante.
     * @param int $idEstudiante ID del estudiante.
     */
    private function guardar($respuestas, $idEstudiante) {
        $model = $this->CaracterizacionEstudiantesRespuestas_Model;

        foreach ($respuestas as $index => $respuesta) {
            $userRespuesta = $respuesta;
            $userRespuestaOtro = "";

            // Procesa respuestas que son arrays (como opciones múltiples).
            if (is_array($respuesta)) {
                if (array_key_exists("other", $respuesta)) {
                    $userRespuestaOtro = $respuesta["other"];
                    unset($respuesta["other"]);
                }
                $userRespuesta = (count($respuesta) > 0) ? serialize($respuesta) : "";
            }

            // Prepara nueva respuesta.
            $newRespuesta = [
                "id_estudiante" => $idEstudiante,
                "id_pregunta" => $index,
                "respuesta" => $userRespuesta,
                "respuesta_otro" => $userRespuestaOtro
            ];

            // Verifica si ya existe la respuesta.
            $existsRespuesta = $model->existsRespuesta($idEstudiante, $index);

            // Actualiza o inserta la respuesta.
            if ($existsRespuesta) {
                $model->updateRespuesta($idEstudiante, $index, $newRespuesta);
            } else {
                if($newRespuesta["respuesta"] != "" || $newRespuesta["respuesta_otro"] != ""){
                    $model->setRespuesta($newRespuesta);
                }
            }
        }
    }

    /**
     * Método para filtrar los estudiantes según criterios especificados.
     */
    public function filtrar() {
        if(is_logged() && strtolower(logged_user()['rol']) != 'estudiante' && strtolower(logged_user()['rol']) != 'acudiente'){
            $params["filtros"] = [];
            $params["grado"] = "";

            // Aplica filtros si se han enviado.
            if($this->input->post()){
                if(strtolower(logged_user()['rol']) != 'docente') {
                    $params["filtros"] = $this->input->post();
                }
            }

            // Aplica el filtro de dirección de grupo si el usuario es docente.
            if(strtolower(logged_user()['rol']) == 'docente'){
                $direccion_grupo = $this->DireccionGrupo_Model->getByDocente(logged_user()["id"]);

                if($direccion_grupo) {
                    $grado = $direccion_grupo["grado"];
                    $params["grado"] = $grado;
                    $params["estudiantes"] =  $this->Estudiante_Model->getCaracterizacionEstudiantes($params["grado"]);
                }
                else {
                    $params["estudiantes"] =  false;
                }


            }
            else {
                $params["estudiantes"] = (!empty($params["filtros"]))
                    ? $this->Estudiante_Model->getCaracterizacionEstudiantesFilters($params["filtros"])
                    : $this->Estudiante_Model->getCaracterizacionEstudiantes();
            }

            $params["cantidad_preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
            $this->load->view("caracterizacion_estudiantes/filtrar", $params);
        } else {
            header("Location: ".base_url());
        }
    }

    public function pdf($idEstudiante = null) {
        if(is_logged() && strtolower(logged_user()['rol']) != 'estudiante' && strtolower(logged_user()['rol']) != 'acudiente') {
            $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($idEstudiante);
            $params["preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
            $params["respuestas"] = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($idEstudiante);
            $this->load->view('caracterizacion_estudiantes/pdf', $params);

            // Cargar HTML en dompdf (puedes cargar tu vista aquí)
            $html = $this->output->get_output();

            // Configurar opciones de dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);


            // Inicializar dompdf
            $dompdf = new Dompdf($options);
            // Configurar orientación a horizontal
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->set_option('defaultMediaType', 'all');
            $dompdf->set_option('isFontSubsettingEnabled', true);
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->set_option('isRemoteEnabled', TRUE);

            $dompdf->loadHtml($html);

            // Renderizar PDF
            $dompdf->render();

            $filename = $params["estudiante"]["nombres"]." ".$params["estudiante"]["apellidos"]." - ".$params["estudiante"]["grado"].".pdf";

            // Mostrar el PDF en el navegador o descargarlo
            $dompdf->stream($filename, array('Attachment' => false));
        }
    }
}
