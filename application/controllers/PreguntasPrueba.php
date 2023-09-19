<?php
  
   class PreguntasPrueba extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(["Preguntas_Model", "Respuestas_Preguntas_Model", "Consultas_Model", "Materias_Model"]);
    }
    
    public function index($id_materia = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){ 
                $materias = array_column($this->Materias_Model->getMateriasDocente(logged_user()["id"], true), "materia");
                $params["id_materia"] = $id_materia;
                $params["preguntas"] = $this->Preguntas_Model->get_all($materias, $id_materia);
                $params["materias"] = $this->Consultas_Model->get_materias_diff_ids($materias);
                $this->load->view("pruebas/preguntas/lista_preguntas", $params);
            }
            else{
                header("Location: ".base_url()."/Pruebas");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    public function ver($id_pregunta = null){
        if($id_pregunta){
            $params["pregunta"] = $this->Preguntas_Model->get($id_pregunta);
            $params["respuestas"] = $this->Respuestas_Preguntas_Model->get_all($id_pregunta);
            $params["pruebas_pregunta"] = $this->Preguntas_Model->get_cantidad_pruebas($id_pregunta);
            $params["correctas"] = $this->Preguntas_Model->get_cantidad_correctas_incorrectas($id_pregunta);
            $params["incorrectas"] = $this->Preguntas_Model->get_cantidad_correctas_incorrectas($id_pregunta, 0);
            $this->load->view("pruebas/preguntas/ver_pregunta", $params);
        }
        else{
            header("Location: ".base_url()."PreguntasPrueba");
        }
    }

    function crearPregunta(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $params = [];
                $params["materias"] = $this->Materias_Model->getMateriasDocente(logged_user()["id"]);
                if($this->input->post()){
                    $params["message"] = $this->guardarPregunta($this->input->post());
                }

                $this->load->view("pruebas/preguntas/crear_pregunta", $params);
            }
            else{
                header("Location: ".base_url()."Pruebas");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function guardarPregunta($data){
        $pregunta = $data["pregunta"];
        $pregunta["created_by"] = logged_user()["id"];
        $pregunta["dificultad"] = serialize($pregunta["dificultad"]);
        $id_pregunta = $this->Preguntas_Model->create($pregunta);

        if($id_pregunta){
            if(isset($_FILES["pregunta_archivo"]) && $id_pregunta){
                if(isset($_FILES['pregunta_archivo']['name'])) {
                    if($_FILES['pregunta_archivo']['name']){
                        $file_name = md5($id_pregunta.rand(100000, 999999)).".".get_file_format($_FILES['pregunta_archivo']['name']);
                        $file_tmp =$_FILES['pregunta_archivo']['tmp_name'];
                        if (move_uploaded_file($file_tmp,"uploads/preguntas/".$file_name)){
                            $this->Preguntas_Model->update(array("id_pregunta_prueba" => $id_pregunta, "archivo" => $file_name, "nombre_archivo" => $_FILES['pregunta_archivo']['name']));
                        }
                    }
                }
            }

            $x = 1;
            while (isset($data["respuesta" . $x])) {
                $temp = $data["respuesta" . $x];
                $this->guardarRespuesta($temp, $id_pregunta, $x);
                $x++;
            }

            return array("type" => "success", "message" => "Pregunta guardada exitosamente.", "success" => true);
        }
        else{
            return array("type" => "danger", "message" => "Error al guardar la pregunta, intente de nuevo más tarde.", "success" => false);
        }
    }

    // Guardar respuesta
    function guardarRespuesta($data, $id_pregunta, $x){
        $archivo_imagen = "respuesta".$x;
        $data["id_pregunta"] = $id_pregunta;
        $id_respuesta = $this->Respuestas_Preguntas_Model->create($data);

        if(isset($_FILES[$archivo_imagen]) && $id_respuesta){
            if(isset($_FILES[$archivo_imagen]['name']['archivo_respuesta'])) {
                if($_FILES[$archivo_imagen]['name']['archivo_respuesta']){
                    $file_name = md5($id_pregunta.rand(100000, 999999)).".".get_file_format($_FILES[$archivo_imagen]['name']['archivo_respuesta']);
                    $file_tmp =$_FILES[$archivo_imagen]['tmp_name']['archivo_respuesta'];
                    if (move_uploaded_file($file_tmp,"uploads/respuestas/".$file_name)){
                        $this->Respuestas_Preguntas_Model->update(array("id_respuesta_pregunta_prueba" => $id_respuesta, "archivo_respuesta" => $file_name, "nombre_archivo_respuesta" => $_FILES[$archivo_imagen]['name']['archivo_respuesta']));
                    }
                }
            }
        }
    }

    function exportarPreguntas($materia, $id_preguntas){
        if($id_preguntas == "-1"){
            $preguntas = $this->Preguntas_Model->get_preguntas_exportar_by_materia($materia);
        }
        else{
            $id_preguntas = explode("-", $id_preguntas);
            $preguntas = $this->Preguntas_Model->get_preguntas_exportar($id_preguntas);
        }
        if(is_array($preguntas)){
            $materia = $this->Consultas_Model->get_materia($preguntas[0]["id_materia"]);
            exportarPreguntasExcel($preguntas, $materia);
        }
    }

    function exportarRespuestas($materia, $id_preguntas){
        if($id_preguntas == "-1"){
            $preguntas = $this->Preguntas_Model->get_preguntas_exportar_by_materia($materia);
        }
        else{
            $id_preguntas = explode("-", $id_preguntas);
            $preguntas = $this->Preguntas_Model->get_preguntas_exportar($id_preguntas);
        }

        if(is_array($preguntas)){
            $materia = $this->Consultas_Model->get_materia($preguntas[0]["id_materia"]);
            if($id_preguntas == "-1"){
                $respuestas = $this->Respuestas_Preguntas_Model->get_respuestas_exportar_by_materia($materia);
            }
            else{
                $respuestas = $this->Respuestas_Preguntas_Model->get_respuestas_exportar($id_preguntas);
            }
            exportarRespuestasExcel($respuestas, $materia);
        }
    }

    function importar($id_materia = null){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){ 
                $materias = array_column($this->Materias_Model->getMateriasDocente(logged_user()["id"], true), "materia");
                if($this->input->post()){
                    $params["message"] = $this->procesarImportar($this->input->post(), $_FILES);
                }

                $params["id_materia"] = $id_materia;
                $params["materias"] = $this->Consultas_Model->get_materias_diff_ids($materias);
                $this->load->view("pruebas/preguntas/importar_preguntas_respuestas", $params);
            }
            else{
                header("Location: ".base_url()."/Pruebas");
            }
        }
        else{
            header("Location: ".base_url());
        }
    }

    function procesarImportar($data, $FILES){
        if($FILES["archivo_preguntas"]){
            $preguntas = excel_preguntas_array($FILES);
            $respuestas = excel_respuestas_array($FILES);

            if(is_array($preguntas)){
                foreach ($preguntas as $pregunta) {

                    if(trim($pregunta["base64"]) != ""){
                        $mime = explode(".", $pregunta["archivo"]);
                        array_pop($mime);
                        $nombre_archivo = implode($mime);
                        save_base64_image($pregunta["base64"], $nombre_archivo, "./uploads/preguntas/");
                    }

                    $temp_id_pregunta = $pregunta["id_pregunta"];
                    unset($pregunta["id_pregunta"]);
                    unset($pregunta["base64"]);
                    $pregunta["id_materia"] = $data["id_materia"];
                    $id_pregunta = $this->Preguntas_Model->create($pregunta);

                    if(is_array($respuestas)){
                        $respuestas_pregunta = array_filter($respuestas, function ($var) use ($temp_id_pregunta) {
                            return ($var['id_pregunta'] == $temp_id_pregunta);
                        });

                        if(is_array($respuestas_pregunta)){
                            foreach ($respuestas_pregunta as $respuesta) {
                                if(trim($respuesta["base64"]) != ""){
                                    $mime = explode(".", $respuesta["archivo_respuesta"]);
                                    array_pop($mime);
                                    $nombre_archivo = implode($mime);
                                    save_base64_image($respuesta["base64"], $nombre_archivo, "./uploads/respuestas/");
                                }
                                unset($respuesta["base64"]);
                                $respuesta["id_pregunta"] = $id_pregunta;
                                $this->Respuestas_Preguntas_Model->create($respuesta);
                            }
                        }
                    }
                }

                return array("type" => "success", "message" => "Preguntas importadas correctamente.", "success" => true);
            }
            else{
                return array("type" => "danger", "message" => "No se han encontrado preguntas.", "success" => false);
            }
        }
        else{
            return array("type" => "danger", "message" => "Es necesario cargar un archivo de preguntas.", "success" => false);
        }
    }

    function delete($id_pregunta){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "docente"){
                $pregunta = $this->Preguntas_Model->get($id_pregunta);
                if($pregunta){
                    if($pregunta["created_by"] == logged_user()["id"]){
                        if($this->Preguntas_Model->update(array("id_pregunta_prueba" => $pregunta["id_pregunta_prueba"], "estado" => 0))){
                            json_response(array("error" => false), true, "Pregunta eliminada correctamente");
                        }
                    }
                    else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado la pregunta");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }
} 
