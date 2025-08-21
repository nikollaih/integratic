<?php
use Mpdf\Mpdf;

/**
 * @property $Pruebas_Model
 * @property $Materias_Model
 * @property $TipoPrueba_Model
 * @property $AlcancePruebas_Model
 * @property $Periodos_Model
 * @property $input
 * @property $load
 * @property $Temas_Model
 * @property $Preguntas_Model
 * @property $Participantes_Prueba_Model
 * @property $Realizar_Prueba_Model
 * @property $RespuestasRealizarPruebaAbiertas_Model
 * @property $Respuestas_Realizar_Prueba_Model
 * @property $Asignacion_Participantes_Prueba_Model
 * @property $Estudiante_Model
 * @property $Asignacion_Preguntas_Prueba_Model
 * @property $output
 * @property $Respuestas_Preguntas_Model
 * @property $session
 */
class Pruebas extends CI_Controller {

    public function __construct() {
       parent::__construct();
       $this->load->helper(array('form', 'url'));
       $this->load->model(["Respuestas_Preguntas_Model", "Temas_Model", "RespuestasRealizarPruebaAbiertas_Model", "Estudiante_Model", "Respuestas_Realizar_Prueba_Model", "Realizar_Prueba_Model", "Pruebas_Model", "TipoPrueba_Model", "Consultas_Model", "AlcancePruebas_Model", "Materias_Model", "Preguntas_Model", "Asignacion_Preguntas_Prueba_Model", "Participantes_Prueba_Model", "Asignacion_Participantes_Prueba_Model", "Periodos_Model"]);

        $this->mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5
        ]);
    }

    public function index(){
        if(is_logged()){
            $params["pruebas"] = false;
            if(strtolower(logged_user()["rol"]) == "docente"){
                //$materias = array_column($this->Materias_Model->getMateriasDocente(logged_user()["id"], true), "materia");
                $params["pruebas"] = $this->Pruebas_Model->get_docente_all(logged_user()["id"]);
            }
            if(strtolower(logged_user()["rol"]) == "estudiante" || strtolower(logged_user()["rol"]) == "acudiente"){
                $params["pruebas"] = $this->Pruebas_Model->get_estudiante_all(logged_user()["id"]);
            }
            $this->load->view("pruebas/home", $params);
        }
        else{
            header("Location: ".base_url());
        }
    }

    public function crearPrueba($idPrueba = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $params["materias"] = $this->Materias_Model->getMateriasDocente(logged_user()["id"]);
                $params["tipo_pruebas"] = $this->TipoPrueba_Model->get_all();
                $params["alcance_prueba"] = $this->AlcancePruebas_Model->get_all();
                $params["periodos"] = $this->Periodos_Model->getAll();

                if($this->input->post()){
                    $params["message"] = $this->guardarPrueba($this->input->post());
                }

                $params["prueba"] = $this->Pruebas_Model->get($idPrueba);
                $this->load->view("pruebas/crear_prueba", $params);
            }
            else{
                header("Location: ".base_url()."Pruebas");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function guardarPrueba($post): array
    {
        $prueba = $post["prueba"];

        if(trim($prueba["id_prueba"]) == ""){
            $prueba["materias"] = serialize($prueba["materias"]);
            $prueba["temas"] = serialize($prueba["temas"]);
            $prueba["dificultad"] = serialize($prueba["dificultad"]);
            $prueba["created_by"] = logged_user()["id"];
        }
        else {
            unset($prueba["materias"]);
            unset($prueba["dificultad"]);
            unset($prueba["temas"]);
        }

        if(isset($prueba["mostrar_respuestas"]))
            $prueba["mostrar_respuestas"] = ($prueba["mostrar_respuestas"] == "on") ? 1 : 0;

        $existsPrueba = $this->Pruebas_Model->get($prueba["id_prueba"]);

        if($existsPrueba){
            $this->Pruebas_Model->update($prueba);
            $id_prueba = $prueba["id_prueba"];
        }
        else {
            unset($prueba["id_prueba"]);

            $id_prueba = $this->Pruebas_Model->create($prueba);
        }

        if($id_prueba){
            if($post["asignacion_preguntas"] == 1 && !isset($prueba["id_prueba"])){
                return asignar_preguntas_prueba($id_prueba);
            }
            else{
                header("Location: ".base_url()."Pruebas/asignarPreguntas/".$id_prueba);
            }

            return array("type" => "success", "message" => "Prueba guardada exitosamente.", "success" => true);
        }
        else{
            return array("type" => "danger", "message" => "No se ha podido crear la prueba, intente de nuevo más tarde.", "success" => false);
        }
    }

    function ver($id_prueba){
        if(is_logged()){
            //$id_prueba = decrypt_string($id_prueba, true);
            $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
            if($params["prueba"]["created_by"] == logged_user()["id"] || strtolower(logged_user()["rol"]) === 'coordinador'){
                $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
                $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
                $params["temas"] = $this->Temas_Model->getByIds(unserialize($params["prueba"]["temas"]));
                $params["preguntas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
                $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
                $this->load->view("pruebas/ver_prueba", $params);
            }
            else{
                header("Location: ".base_url()."Pruebas");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function empezar($id_prueba){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "estudiante"){
                //$id_prueba = decrypt_string($id_prueba, true);
                $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
                $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
                $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
                $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
                $this->load->view("pruebas/empezar_prueba", $params);
            }
            else{
                header("Location: ".base_url()."Pruebas");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function resumen($id_prueba, $id_participante = null){
        if(is_logged()){

            if(strtolower(logged_user()["rol"]) == "docente"){
                if($this->input->post()){
                    $data = $this->input->post();
                    $this->RespuestasRealizarPruebaAbiertas_Model->update($data);
                }
            }

            if($id_participante == null){
                $usuario = $this->Participantes_Prueba_Model->get(logged_user()["id"]);
                $id_participante = $usuario["id_participante_prueba"];
            }
            $params["prueba_realizada"] = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);
            $prueba_realizada = info_prueba_realizada($id_prueba, $id_participante);
            $this->Realizar_Prueba_Model->update(array("id_realizar_prueba" => $params["prueba_realizada"]["id_realizar_prueba"], "calificacion" => $prueba_realizada["porcentaje"], "nota" => $prueba_realizada["calificacion"]));
            $params["prueba_realizada"] = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);
            $params["id_participante"] = $id_participante;
            $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
            $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
            $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
            $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
            $params["respuestas"] = $this->Respuestas_Realizar_Prueba_Model->get($params["prueba_realizada"]["id_realizar_prueba"]);
            $params["respuestas_abiertas"] = $this->RespuestasRealizarPruebaAbiertas_Model->get($params["prueba_realizada"]["id_realizar_prueba"]);

            if($params["prueba_realizada"]){
                $this->load->view("pruebas/resumen_prueba", $params);
            }
            else{
                header("Location: " . base_url() . "Pruebas");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function resolver($id_prueba){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "estudiante"){
                $usuario = $this->Participantes_Prueba_Model->get(logged_user()["id"]);
                $id_participante = $usuario["id_participante_prueba"];
                $participante = $this->Asignacion_Participantes_Prueba_Model->get_participante($id_participante);
                $params["id_participante"] = $id_participante;
                $iniciado = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);

                if(!$iniciado){
                    if($id_prueba !== 0){
                        $iniciado = $this->Realizar_Prueba_Model->create(array("id_prueba" => $id_prueba, "id_participante" => $id_participante, "institucion" => $participante["institucion"], "grado" => $participante["grado"], "created_at" => date("Y-m-d H:i:s")));
                    }
                }

                if($this->input->post()){
                    if($iniciado){
                        $data = $this->input->post();

                        // Si la pregunta y la respuesta es de tipo abierta
                        if(isset($data["respuesta_abierta"])){
                            $this->RespuestasRealizarPruebaAbiertas_Model->create(array("id_realizar_prueba" => $iniciado["id_realizar_prueba"], "id_pregunta" => $data["id_pregunta"], "respuesta" => $data["respuesta_abierta"]));
                        }
                        else {
                            $this->Respuestas_Realizar_Prueba_Model->create(array("id_realizar_prueba" => $iniciado["id_realizar_prueba"], "id_pregunta" => $data["id_pregunta"], "id_respuesta" => $data["id_respuesta"]));
                        }
                    }
                }

                $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
                $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
                $params["prueba_realizada"] = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);;

                if($params["prueba"]["fecha_inicio"] < date("Y-m-d H:i:s") && $params["prueba"]["fecha_finaliza"] > date("Y-m-d H:i:s")){
                    if(is_array($iniciado)){
                        if($iniciado["is_closed"] == 1){
                            header("Location: ".base_url()."Pruebas/resumen/".$id_prueba);
                        }

                        $siguiente = siguiente_pregunta($id_prueba, $id_participante);
                        if(is_array($siguiente)){
                            $params["pregunta"] = $siguiente["pregunta"];
                            $params["respuestas"] = $siguiente["respuestas"];
                            $this->load->view("pruebas/resolver_prueba", $params);
                        }
                        else if($siguiente != false){
                            if(!$iniciado["finished_at"]){
                                $this->Realizar_Prueba_Model->update(array("id_realizar_prueba" => $iniciado["id_realizar_prueba"], "finished_at" => date("Y-m-d H:i:s"), "is_closed" => 1));
                            }
                            header("Location: ".base_url()."Pruebas/resumen/".$id_prueba);
                        }
                    }
                    else{
                        header("Location: ".base_url()."Pruebas/empezar/".$id_prueba);
                    }
                }
                else{
                    header("Location: ".base_url()."Pruebas/resumen/".$id_prueba);
                }
            }
            else{
                header("Location: " . base_url() . "Pruebas");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function participantes($id_prueba){
        if(is_logged()){
            $ids_materias = [];
            if($this->input->post()){
                if(isset($this->input->post()["estudiantes"])){
                    $estudiantes = $this->Estudiante_Model->getStudentsByDocuments($this->input->post()["estudiantes"]);
                    $participantes = mover_estudiantes_participantes_prueba($estudiantes);
                    $params["message"] = $this->asignarParticipantes($participantes, $id_prueba);
                }
                else{
                    $participantes = importar_participantes_pruebas($_FILES);
                    $params["message"] = $this->asignarParticipantes($participantes, $id_prueba);
                }
            }
            $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
            $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
            $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
            $params["temas"] = $this->Temas_Model->getByIds(unserialize($params["prueba"]["temas"]));
            $params["preguntas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
            $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
            $params["participantes"] = $this->Asignacion_Participantes_Prueba_Model->get_all($id_prueba);

            if(is_array($params["materias"])){
                for ($i=0; $i < count($params["materias"]); $i++) {
                    array_push($ids_materias, $params["materias"][$i]["codmateria"]);
                }
            }

            $params["grupos_materia"] = $this->Materias_Model->getGruposMateria($ids_materias);

            $this->load->view("pruebas/participantes", $params);
        }
        else{
            header("Location: ".base_url());
        }
    }

    function asignarParticipantes($participantes, $id_prueba){
        if(is_array($participantes)){
            foreach ($participantes as $participante) {
                $exists = $this->Participantes_Prueba_Model->get($participante["identificacion"]);
                if($exists){
                    $this->Participantes_Prueba_Model->update($participante);
                    $asignado["id_participante"] = $exists["id_participante_prueba"];
                    $asignado["id_prueba"] = $id_prueba;
                    if(!$this->Asignacion_Participantes_Prueba_Model->get($id_prueba, $exists["id_participante_prueba"])){
                        $this->Asignacion_Participantes_Prueba_Model->create($asignado);
                    }
                }
                else{
                    $id_participante["id_participante_prueba"] = $this->Participantes_Prueba_Model->create($participante);
                    $asignado["id_participante"] = $id_participante;
                    $asignado["id_prueba"] = $id_prueba;
                    if(!$this->Asignacion_Participantes_Prueba_Model->get($id_prueba, $id_participante)){
                        $this->Asignacion_Participantes_Prueba_Model->create($asignado);
                    }
                }
            }

            return array("type" => "success", "message" => "Participantes cargados satisfactoriamente.", "success" => true);
        }
        else{
            return array("type" => "danger", "message" => "No se han seleccionado los participantes.", "success" => false);
        }
    }

    function asignarPreguntas($id_prueba){
        $params["asignadas_ids"] = [];
        $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
        $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
        $params["temas"] = unserialize($params["prueba"]["temas"]);
        $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
        $params["temasSeleccionados"] = $this->Temas_Model->getByIds(unserialize($params["prueba"]["temas"]));
        $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $params["preguntas"] = obtener_preguntas(unserialize($params["prueba"]["materias"]), unserialize($params["prueba"]["dificultad"]), false, $params["temas"]);
        if($params["asignadas"]){
            for ($i=0; $i < count($params["asignadas"]); $i++) {
                array_push($params["asignadas_ids"], $params["asignadas"][$i]["id_pregunta_prueba"]);
            }
        }

        $this->load->view("pruebas/asignacion_preguntas", $params);
    }

    // Proceso para asignar o desasignar una pregunta a una prueba
    function asignarPreguntasProceso(){
        if($this->input->post()){
            $preguntas_ids = [];
            $id_pregunta = $this->input->post()["id_pregunta"];
            $prueba = $this->Pruebas_Model->get($this->input->post()["id_prueba"]);
            $is_asignada = $this->Preguntas_Model->get_preguntas_prueba($prueba["id_prueba"], $id_pregunta);
            $asignadas = $this->Preguntas_Model->get_preguntas_prueba($prueba["id_prueba"]);
            $preguntas = obtener_preguntas(unserialize($prueba["materias"]), unserialize($prueba["dificultad"]), true);


            if($preguntas){
                for ($i=0; $i < count($preguntas); $i++) {
                    array_push($preguntas_ids, $preguntas[$i]["id_pregunta_prueba"]);
                }
            }

            // Verifica si la pregunta seleccionada está dentro de las permitidas para la prueba
            if(!in_array($id_pregunta, $preguntas_ids)){
                json_response(null, false, "La pregunta seleccionada no puede ser asiganada a la prueba.");
            }
            else{
                if($is_asignada){
                    $eliminada = $this->Asignacion_Preguntas_Prueba_Model->delete($is_asignada["id_asignacion_pregunta_prueba"]);
                    if($eliminada){
                        json_response(array("id_pregunta" => "id_pregunta", "id_prueba" => $prueba["id_prueba"], "eliminado" => 1), true, "Pregunta removida correctamente.");
                    }
                    else{
                        json_response(null, false, "No ha sido posible remover la pregunta de la prueba, intente de nuevo más tarde.");
                    }
                }
                else{
                    if($asignadas){
                        if($prueba["cantidad_preguntas"] <= count($asignadas)){
                            json_response(null, false, "No puede asignar mas de ".$prueba["cantidad_preguntas"]." pregunta(s) a la prueba.");
                        }
                    }

                    $asignada = $this->Asignacion_Preguntas_Prueba_Model->create(array(0 => array("id_pregunta" => $id_pregunta, "id_prueba" => $prueba["id_prueba"])));
                    if($asignada){
                        json_response(array("id_pregunta" => "id_pregunta", "id_prueba" => $prueba["id_prueba"], "eliminado" => 0), true, "Pregunta asiganda correctamente.");
                    }
                    else{
                        json_response(null, false, "No ha sido posible asignar la pregunta de la prueba, intente de nuevo más tarde.");
                    }
                }
            }
        }
    }

    function cerrarIntentoPrueba(){
        if($this->input->post()){
            $id_realizar_prueba = $this->input->post()["id_realizar_prueba"];
            $realizar_prueba = $this->Realizar_Prueba_Model->get_by_id($id_realizar_prueba);

            if($realizar_prueba){
                if($realizar_prueba["is_closed"] != 1){
                    $realizar_prueba["is_closed"] = 1;
                    $realizar_prueba["finished_at"] = date("Y-m-d H:i:s");
                }
                if ($this->Realizar_Prueba_Model->update($realizar_prueba)){
                    json_response($realizar_prueba["id_prueba"], true, "");
                }
                else{
                    json_response(null, false, "");
                }
            }
            else{
                json_response(null, false, "");
            }
        }
    }

    function delete(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $id_prueba = $this->input->post()["id_prueba"];
                $prueba = $this->Pruebas_Model->get($id_prueba);

                if($prueba){
                    if($prueba["created_by"] == logged_user()["id"]){
                        if($this->Pruebas_Model->update(array("id_prueba" => $prueba["id_prueba"], "estado" => 2))){
                            json_response(array("error" => false), true, "Prueba eliminada correctamente");
                        }
                    }
                    else json_response(array("error" => "permissions"), false, "No tiene permisos para eliminar la prueba");
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado la prueba");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para eliminar la prueba");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }

    function deleteIntento(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $id_prueba = $this->input->post()["id_prueba"];
                $id_participante = $this->input->post()["id_participante"];
                $prueba = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);

                if($prueba){
                    if($this->Respuestas_Realizar_Prueba_Model->deleteRespuestas($prueba["id_realizar_prueba"])){
                        if($this->Realizar_Prueba_Model->delete($prueba["id_realizar_prueba"])){
                            json_response(array("error" => false), true, "Registro eliminado correctamente");
                        }
                        else json_response(array("error" => "general"), false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                    }
                    else json_response(array("error" => "general"), false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado la prueba");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }

    // Método principal que genera los datos con shuffle
    private function prepararDatosCuadernillo($idPrueba) {
        $params["prueba"] = $this->Pruebas_Model->get($idPrueba);
        $params["preguntas"] = $this->Preguntas_Model->get_preguntas_prueba($idPrueba);

        if($params["preguntas"]){
            // Primero obtenemos todas las respuestas
            for ($i = 0; $i < count($params["preguntas"]); $i++) {
                $params["preguntas"][$i]["respuestas"] = $this->Respuestas_Preguntas_Model->get_all($params["preguntas"][$i]["id_pregunta"]);

                // Hacer shuffle a las respuestas de cada pregunta
                if(!empty($params["preguntas"][$i]["respuestas"])) {
                    shuffle($params["preguntas"][$i]["respuestas"]);
                }
            }

            // Hacer shuffle a las preguntas
            shuffle($params["preguntas"]);
        }

        return $params;
    }

    // Método para generar cuadernillo de preguntas
    function cuadernillo($idPrueba){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){

                $params = $this->prepararDatosCuadernillo($idPrueba);

                // Guardar los datos en sesión para compartir con el método de respuestas
                $this->session->set_userdata('cuadernillo_data_' . $idPrueba, $params);

                $this->load->view("pruebas/cuadernillo/preguntas", $params);

                $html = $this->output->get_output();
                $this->mpdf->WriteHTML($html);
                $this->mpdf->Output('cuadernillo_preguntas.pdf', 'I');
            }
        }
    }

    // Método para generar cuadernillo de respuestas
    function cuadernilloRespuestas($idPrueba, $mostrarRespuestas = 1){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){

                // Intentar obtener los datos de la sesión primero
                $params = $this->session->userdata('cuadernillo_data_' . $idPrueba);

                // Si no existen en sesión, generarlos nuevamente
                if(!$params) {
                    echo "Primero debe generar el cuadernillo";
                    die();
                }

                $params["mostrarRespuestas"] = $mostrarRespuestas;

                $this->load->view("pruebas/cuadernillo/respuestas", $params);

                $html = $this->output->get_output();
                $this->mpdf->WriteHTML($html);
                $this->mpdf->Output('cuadernillo_respuestas.pdf', 'I');
            }
        }
    }
}
