<?php
  
   class PreguntasPrueba extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(["Preguntas_Model", "Respuestas_Preguntas_Model", "Consultas_Model"]);
    }
    
    public function index($id_materia = null){
        $params["preguntas"] = $this->Preguntas_Model->get_all($id_materia);
        $params["materias"] = $this->Consultas_Model->get_materias_diff();
        $params["id_materia"] = $id_materia;
        $this->load->view("pruebas/preguntas/lista_preguntas", $params);
    }

    public function ver($id_pregunta = null){
        if($id_pregunta){
            $params["pregunta"] = $this->Preguntas_Model->get($id_pregunta);
            $params["respuestas"] = $this->Respuestas_Preguntas_Model->get_all($id_pregunta);
            $this->load->view("pruebas/preguntas/ver_pregunta", $params);
        }
        else{
            header("Location: ".base_url()."PreguntasPrueba");
        }
    }

    function crearPregunta(){
        $params = [];
        $params["materias"] = $this->Consultas_Model->get_materias_diff();
        if($this->input->post()){
            $params["message"] = $this->guardarPregunta($this->input->post());
        }

        $this->load->view("pruebas/preguntas/crear_pregunta", $params);
    }

    function guardarPregunta($data){
        $pregunta = $data["pregunta"];
        $id_pregunta = $this->Preguntas_Model->create($pregunta);

        if($id_pregunta){
            if(isset($_FILES["pregunta_archivo"]) && $id_pregunta){
                if(isset($_FILES['pregunta_archivo']['name'])) {
                    if($_FILES['pregunta_archivo']['name']){
                        $file_name = md5($id_pregunta).".".get_file_format($_FILES['pregunta_archivo']['name']);
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
        print_r($data);
    }

    // Guardar respuesta
    function guardarRespuesta($data, $id_pregunta, $x){
        $archivo_imagen = "respuesta".$x;
        $data["id_pregunta"] = $id_pregunta;
        $id_respuesta = $this->Respuestas_Preguntas_Model->create($data);

        if(isset($_FILES[$archivo_imagen]) && $id_respuesta){
            if(isset($_FILES[$archivo_imagen]['name']['archivo_respuesta'])) {
                if($_FILES[$archivo_imagen]['name']['archivo_respuesta']){
                    $file_name = md5($id_pregunta.$x).".".get_file_format($_FILES[$archivo_imagen]['name']['archivo_respuesta']);
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
} 
