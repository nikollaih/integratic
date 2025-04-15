<?php

/**
 * @property $Consultas_Model
 */
class Recuperaciones extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model(['Usuarios_Model', 'Respuestas_Realizar_Prueba_Model', 'Asignacion_Participantes_Prueba_Model', 'Estudiante_Model', 'Participantes_Prueba_Model', 'RecuperacionEstudiante_Model', 'Materias_Model', 'RecuperacionPruebas_Model', 'Pruebas_Model', 'Recuperacion_Model', 'Estudiante_Model', 'Materias_Model', 'Consultas_Model', 'Periodos_Model', 'Actividades_Model', 'RecuperacionActividades_Model']);
        $this->load->library(['Mailer']);
    }

    public function index() {
        if(is_logged()) {
            $userId = logged_user()["id"];
            $params["docente_id"] = "";
            if(strtolower(logged_user()["rol"]) === "docente"){
                $params["recuperaciones"] = $this->Recuperacion_Model->getAll($userId);
            }

            if(strtolower(logged_user()["rol"]) === "coordinador"){
                $params["docente_id"] = $this->input->post('docente_id');
                $params["recuperaciones"] = $this->Recuperacion_Model->getAll($params["docente_id"]);
            }

            if(strtolower(logged_user()["rol"]) === "estudiante" || strtolower(logged_user()["rol"]) === "acudiente"){
                $params["recuperaciones"] = $this->Recuperacion_Model->getAllByStudent($userId);
            }

            $params["docentes"] = $this->Usuarios_Model->get_by_role("docente");
            $this->load->view("recuperaciones/index", $params);
        }
        else{
            header("Location: ".base_url());
        }
    }

    // Carga el formulario para crear una nueva recuperación
    function create(){
        // Verifica si existe un usuario logueado
        if(is_logged()){
            $userId = logged_user()["id"];
            if($this->input->post()){
                $data = $this->input->post();
                $params["message"] = $this->save($data["recuperacion"]);
            }
            $params["materias"] = $this->Materias_Model->getMateriasDocente($userId);
            $params["grupos"] = $this->Consultas_Model->allDistinctGrupos($userId);
            $params["periodos"] = $this->Periodos_Model->getAll();
            $this->load->view("recuperaciones/create", $params);
        }
        else header("Location: ".base_url());
    }

    function edit($idRecuperacion = null){
        // Verifica si existe un usuario logueado
        if(is_logged()){
            $userId = logged_user()["id"];
            if($this->input->post()){
                $data = $this->input->post();
                $params["message"] = $this->save($data["recuperacion"]);
            }
            $params["materias"] = $this->Materias_Model->getMateriasDocente($userId);
            $params["grupos"] = $this->Consultas_Model->allDistinctGrupos($userId);
            $params["periodos"] = $this->Periodos_Model->getAll();
            $params["recuperacion"] = $this->Recuperacion_Model->find($idRecuperacion);
            $this->load->view("recuperaciones/create", $params);
        }
        else header("Location: ".base_url());
    }

    // Guarda la información de una nueva recuperación
    private function save($recuperacion){
        $recuperacion["created_by"] = logged_user()["id"];
        $existsRecuperacion = $this->Recuperacion_Model->find($recuperacion["id_recuperacion"]);

        if(!$existsRecuperacion){
            unset($recuperacion["id_recuperacion"]);
            $this->Recuperacion_Model->create($recuperacion);
            return array("type" => "success", "message" => "Recuperación creada exitosamente.", "success" => true);
        }
        else{
            $this->Recuperacion_Model->update($recuperacion["id_recuperacion"], $recuperacion);
            return array("type" => "success", "message" => "Recuperación modificada exitosamente.", "success" => true);
        }
    }

    function view($idRecuperacion = null){
        if(is_logged()){
            $params["recuperacion"] = $this->Recuperacion_Model->find($idRecuperacion);
            if($params["recuperacion"]) {
                $materia = $this->Materias_Model->getMateria($params["recuperacion"]["materia"]);
                $params["actividades"] = $this->Recuperacion_Model->getActivities($idRecuperacion);
                $params["pruebas"] = $this->Recuperacion_Model->getPruebas($idRecuperacion);
                $params["estudiantes"] = $this->RecuperacionEstudiante_Model->getAll($idRecuperacion);
                $params["actividades_disponibles"] = $this->Actividades_Model->getActivitiesRecuperaciones($params["recuperacion"]["materia"], $params["recuperacion"]["grupo"]);
                $params["pruebas_disponibles"] = $this->Pruebas_Model->getPruebasRecuperaciones($params["recuperacion"]["materia"]);
                $params["estudiantes_disponibles"] = $this->Estudiante_Model->getStudentsByMateriaGroup($materia["grado"].$params["recuperacion"]["grupo"]);
                $this->load->view("recuperaciones/view", $params);
            }
            else header("Location: ".base_url().'Recuperaciones');
        }
        else header("Location: ".base_url());
    }

    function asignar_actividad_recuperacion() {
        if(is_logged()){
            if($this->input->post()){
                $data = $this->input->post();
                $existsRecuperacion = $this->Recuperacion_Model->find($data["id_recuperacion"]);
                if(is_array($data["actividades"]) && count($data["actividades"]) > 0 && $existsRecuperacion) {
                    $actividadRecuperacion["id_recuperacion"] = $data["id_recuperacion"];
                    foreach($data["actividades"] as $actividad) {
                        $actividadRecuperacion["id_actividad"] = $actividad;
                        $existsRecuperacionActividad = $this->RecuperacionActividades_Model->get($actividadRecuperacion["id_recuperacion"], $actividadRecuperacion["id_actividad"]);
                        if(!$existsRecuperacionActividad) {
                            $this->RecuperacionActividades_Model->create($actividadRecuperacion);
                        }
                    }

                    header("Location: ".base_url()."Recuperaciones/view/".$actividadRecuperacion["id_recuperacion"]);
                }
                else {
                    header("Location: ".base_url()."Recuperaciones");
                }
            }
            else {
                header("Location: ".base_url()."Recuperaciones");
            }
        }
        else header("Location: ".base_url());
    }

    function asignar_prueba_recuperacion() {
        if(is_logged()){
            if($this->input->post()){
                $data = $this->input->post();
                $existsRecuperacion = $this->Recuperacion_Model->find($data["id_recuperacion"]);
                if(is_array($data["pruebas"]) && count($data["pruebas"]) > 0 && $existsRecuperacion) {
                    $actividadRecuperacion["id_recuperacion"] = $data["id_recuperacion"];
                    foreach($data["pruebas"] as $prueba) {
                        $actividadRecuperacion["id_prueba"] = $prueba;
                        $existsRecuperacionActividad = $this->RecuperacionPruebas_Model->get($actividadRecuperacion["id_recuperacion"], $actividadRecuperacion["id_prueba"]);
                        if(!$existsRecuperacionActividad) {
                            $this->RecuperacionPruebas_Model->create($actividadRecuperacion);
                        }
                    }

                    header("Location: ".base_url()."Recuperaciones/view/".$actividadRecuperacion["id_recuperacion"]);
                }
                else {
                    header("Location: ".base_url()."Recuperaciones");
                }
            }
            else {
                header("Location: ".base_url()."Recuperaciones");
            }
        }
        else header("Location: ".base_url());
    }

    function asignar_estudiante_recuperacion() {
        if(is_logged()){
            if($this->input->post()){
                $data = $this->input->post();
                $existsRecuperacion = $this->Recuperacion_Model->find($data["id_recuperacion"]);
                if(is_array($data["estudiantes"]) && count($data["estudiantes"]) > 0 && $existsRecuperacion) {
                    // Get the activities belongs to the process
                    $actividades = $this->Actividades_Model->getActivitiesRecuperacion($data["id_recuperacion"]);
                    $pruebas = $this->Pruebas_Model->getPruebasRecuperacion($data["id_recuperacion"]);
                    $estudianteRecuperacion["id_recuperacion"] = $data["id_recuperacion"];
                    foreach($data["estudiantes"] as $estudiante) {
                        $estudianteRecuperacion["id_estudiante"] = $estudiante;
                        $existsRecuperacionEstudiante = $this->RecuperacionEstudiante_Model->get($estudianteRecuperacion["id_recuperacion"], $estudianteRecuperacion["id_estudiante"]);
                        if(!$existsRecuperacionEstudiante) {
                            $this->RecuperacionEstudiante_Model->create($estudianteRecuperacion);
                            $this->sendEmail($estudiante, $existsRecuperacion);
                        }
                        // Add the student to activity participants
                        $this->agregar_estudiante_actividad($actividades, $estudianteRecuperacion["id_estudiante"] );
                        // Add the student to pruebas participants
                        $this->agregar_estudiante_prueba($pruebas, $estudianteRecuperacion["id_estudiante"] );
                    }

                    header("Location: ".base_url()."Recuperaciones/view/".$estudianteRecuperacion["id_recuperacion"]);
                }
                else {
                    header("Location: ".base_url()."Recuperaciones");
                }
            }
            else {
                header("Location: ".base_url()."Recuperaciones");
            }
        }
        else header("Location: ".base_url());
    }

    function sendEmail($estudianteId, $recuperacion){
        $estudiante = $this->Estudiante_Model->getStudentUserByDocument($estudianteId);

        $data["recuperacion"] = $recuperacion;
        if($estudiante){
            if(trim($estudiante["email"]) != ""){
                $data["estudiante"] = $estudiante["nombre"];
                $email_body = $this->load->view('email/recuperacion', $data, true);
                $this->mailer->send($email_body, 'Nueva recuperación', $estudiante["email"], $estudiante["email_acudiente"]);
            }
        }
    }

    function agregar_estudiante_actividad ($actividades, $idEstudiante) {
        if(is_logged()){
            // Verifica que no sea un estudiante quien hace la petición
            if(strtolower(logged_user()["rol"]) !== "estudiante"){
                if(is_array($actividades) && count($actividades) > 0) {
                    foreach($actividades as $actividad) {
                        $estudiantes_habilitados = ($actividad["estudiantes_habilitados"]) ? unserialize($actividad["estudiantes_habilitados"]) : [];
                        if(!in_array($idEstudiante, $estudiantes_habilitados)) {
                            array_push($estudiantes_habilitados, $idEstudiante);
                            $this->Actividades_Model->update(array("id_actividad" => $actividad["id_actividad"], "estudiantes_habilitados" => serialize($estudiantes_habilitados)));
                        }
                    }
                }
            }
        }
    }

    function agregar_estudiante_prueba ($pruebas, $idEstudiante) {
        if(is_logged()){
            // Verifica que no sea un estudiante quien hace la petición
            if(strtolower(logged_user()["rol"]) !== "estudiante"){
                if(is_array($pruebas) && count($pruebas) > 0) {
                    foreach($pruebas as $prueba) {
                        $coreParticipant = $this->Participantes_Prueba_Model->get($idEstudiante);
                        if(!$coreParticipant) {
                            $coreParticipant = $this->agregar_participante_pruebas($idEstudiante);
                        }

                        if(is_array($coreParticipant)){
                            $estudiantes_habilitados = $this->Pruebas_Model->getPruebaParticipants($prueba["id_prueba"]);
                            if(is_array($estudiantes_habilitados) && count($estudiantes_habilitados) > 0) {
                                // Use array_column to get all 'id_participante' values and in_array to check for the value
                                $id_participants = array_column($estudiantes_habilitados, 'id_participante');
                                if(!in_array($coreParticipant["id_participante_prueba"], $id_participants)) {
                                    $newPruebaParticipant["id_prueba"] = $prueba["id_prueba"];
                                    $newPruebaParticipant["id_participante"] = $coreParticipant["id_participante_prueba"];
                                }
                            }
                            else {
                                $newPruebaParticipant["id_prueba"] = $prueba["id_prueba"];
                                $newPruebaParticipant["id_participante"] = $coreParticipant["id_participante_prueba"];
                            }

                            if(isset($newPruebaParticipant["id_prueba"])){
                                $this->Asignacion_Participantes_Prueba_Model->create($newPruebaParticipant);
                            }
                        }
                    }
                }
            }
        }
    }

    function agregar_participante_pruebas($idEstudiante){
        $estudiante = $this->Estudiante_Model->getStudentUserByDocument($idEstudiante);

        if($estudiante) {
            $newParticipant["identificacion"] = $estudiante["id"];
            $newParticipant["nombres"] = $estudiante["nombres"];
            $newParticipant["apellidos"] = $estudiante["apellidos"];
            $newParticipant["telefono"] = $estudiante["nocel"];
            $newParticipant["email"] = $estudiante["email"];
            $newParticipant["grado"] = $estudiante["grado"];
            return $this->Participantes_Prueba_Model->create($newParticipant);
        }
        return false;
    }

    // Si un estudiante es eliminado de una recuperación, este metodo se encarga de eliminarlo de las actividades que pertenecen a esa recuperación
    function eliminar_estudiante_actividad($idRecuperacion, $idEstudiante) {
        if(is_logged()) {
            // Verifica que no sea un estudiante quien hace la petición
            if(strtolower(logged_user()["rol"]) !== "estudiante"){
                $existsRecuperacion = $this->Recuperacion_Model->find($idRecuperacion);
                if($existsRecuperacion) {
                    // Get the activities belongs to the process
                    $actividades = $this->Actividades_Model->getActivitiesRecuperacion($idRecuperacion);
                    if(is_array($actividades) && count($actividades) > 0) {
                        foreach($actividades as $actividad) {
                            $estudiantes_habilitados = ($actividad["estudiantes_habilitados"]) ? unserialize($actividad["estudiantes_habilitados"]) : [];
                            if(in_array($idEstudiante, $estudiantes_habilitados)) {
                                $estudiantes_habilitados =  array_diff($estudiantes_habilitados, [$idEstudiante]);
                                $this->Actividades_Model->update(array("id_actividad" => $actividad["id_actividad"], "estudiantes_habilitados" => serialize($estudiantes_habilitados)));
                            }
                        }
                    }
                }

            }
        }
    }

    // Si un estudiante es eliminado de una recuperación, este metodo se encarga de eliminarlo de las pruebas que pertenecen a esa recuperación
    function eliminar_estudiante_prueba($idRecuperacion, $idEstudiante) {
        if(is_logged()) {
            // Verifica que no sea un estudiante quien hace la petición
            if(strtolower(logged_user()["rol"]) !== "estudiante"){
                $existsRecuperacion = $this->Recuperacion_Model->find($idRecuperacion);
                if($existsRecuperacion) {
                    // Get the pruebas belongs to the process
                    $pruebas = $this->Pruebas_Model->getPruebasRecuperacion($idRecuperacion);
                    if(is_array($pruebas) && count($pruebas) > 0) {
                        foreach($pruebas as $prueba) {
                            $estudiantes_habilitados = $this->Pruebas_Model->getPruebaParticipants($prueba["id_prueba"]);
                            if(is_array($estudiantes_habilitados) && count($estudiantes_habilitados) > 0) {
                                // Use array_column to get all 'id_participante' values and in_array to check for the value
                                $id_participants = array_column($estudiantes_habilitados, 'id_participante');
                                // Get the participan information by document id
                                $participant = $this->Participantes_Prueba_Model->get_participante_by_identificacion($idEstudiante);
                                // In case the participant belongs to the prueba, it will delete the relationship
                                if(in_array($participant["id_participante_prueba"], $id_participants)) {
                                    $this->Asignacion_Participantes_Prueba_Model->delete($prueba["id_prueba"], $participant["id_participante_prueba"]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function delete(){
        if(is_logged()) {
            // Verifica que no sea un estudiante quien hace la petición
            if(strtolower(logged_user()["rol"]) !== "estudiante"){
                $data = $this->input->post();
                // Verifica que el type sea correcto
                if(isset($data["type"]) && ($data["type"] === "actividad" || $data["type"] === "prueba" || $data["type"] === "estudiante")) {
                    $type = $data["type"];

                    // Si es una actividad entonces asigna el modelo de actividades, de lo contrario asigna el de pruebas
                    if($type === "actividad") {
                        $model = $this->RecuperacionActividades_Model;
                    }
                    if($type === "prueba") {
                        $model = $this->RecuperacionPruebas_Model;
                    }
                    if($type === "estudiante") {
                        $model = $this->RecuperacionEstudiante_Model;
                    }


                    // Elimina el registro
                    $deleted = $model->delete($data["id_recuperacion"], $data["id_fk"]);

                    // Verifica que el registro haya sido eliminado
                    if($deleted) {
                        if($type === "estudiante") {
                            $this->eliminar_estudiante_actividad($data["id_recuperacion"], $data["id_fk"]);
                            $this->eliminar_estudiante_prueba($data["id_recuperacion"], $data["id_fk"]);
                        }
                        json_response($data, true, $type." eliminada exitosamente");
                    }
                    else {
                        json_response(null, false, "No se pudo eliminar el registro");
                    }
                }
                else json_response($data, false, "La información recibida no es correcta");
            }
            else json_response(null, false, "No tiene permisos para realizar esta acción");
        }
        else json_response(null, false, "Inicie sessión para continuar");
    }

    function estudiante($documento, $idRecuperacion) {
        if(is_logged()) {
            if($this->input->post()){
                $params["message"] = $this->add_comments($documento, $idRecuperacion, $this->input->post());
            }

            $coreParticipant = $this->Participantes_Prueba_Model->get($documento);
            // Get the pruebas belongs to the process
            $params["pruebas"] = $this->Pruebas_Model->getPruebasRecuperacion($idRecuperacion);
            if(is_array($params["pruebas"]) && count($params["pruebas"]) > 0) {
                for ($i = 0; $i < count($params["pruebas"]); $i++) {
                    // Get the student qualification belongs to each test
                    $params["pruebas"][$i]["respuesta"] = $this->Respuestas_Realizar_Prueba_Model->get_note_by_prueba_participante( $params["pruebas"][$i]["id_prueba"], $coreParticipant["id_participante_prueba"]);
                }
            }

            // Get the activities belongs to the process
            $params["actividades"] = $this->Actividades_Model->getActivitiesRecuperacion($idRecuperacion);
            if(is_array($params["actividades"]) && count($params["actividades"]) > 0) {
                for ($i = 0; $i < count($params["actividades"]); $i++) {
                    // Get the student qualification belongs to each activity
                    $params["actividades"][$i]["respuesta"] = $this->Actividades_Model->get_activity_response($params["actividades"][$i]["id_actividad"], $documento);
                }
            }

            $params["recuperacion"] = $this->RecuperacionEstudiante_Model->get($idRecuperacion, $documento);
            $this->load->view("recuperaciones/estudiante/view", $params);
        }
    }

    function add_comments($documento, $idRecuperacion, $data) {
        $this->RecuperacionEstudiante_Model->update($idRecuperacion, $documento, $data);
        return array("type" => "success", "message" => "Observaciones agregadas exitosamente.", "success" => true);
    }
}