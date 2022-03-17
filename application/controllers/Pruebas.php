<?php
  
   class Pruebas extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(["Respuestas_Realizar_Prueba_Model", "Realizar_Prueba_Model", "Pruebas_Model", "TipoPrueba_Model", "Consultas_Model", "AlcancePruebas_Model", "Materias_Model", "Preguntas_Model", "Asignacion_Preguntas_Prueba_Model", "Participantes_Prueba_Model", "Asignacion_Participantes_Prueba_Model"]);
    }
    
    public function index(){
        $params["pruebas"] = $this->Pruebas_Model->get_all();
        $this->load->view("pruebas/home", $params);
    }

    public function crearPrueba(){
        $params["tipo_pruebas"] = $this->TipoPrueba_Model->get_all();
        $params["alcance_prueba"] = $this->AlcancePruebas_Model->get_all();
        $params["materias"] = $this->Consultas_Model->get_materias_diff();

        if($this->input->post()){
            $params["message"] = $this->guardarPrueba($this->input->post());
        }

        $this->load->view("pruebas/crear_prueba", $params);
    }

    function guardarPrueba($post){
        $prueba = $post["prueba"];
        $prueba["materias"] = serialize($prueba["materias"]);
        $prueba["dificultad"] = serialize($prueba["dificultad"]);

        $id_prueba = $this->Pruebas_Model->create($prueba);

        if($id_prueba){
            if($post["asignacion_preguntas"] == 1){
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
        $id_prueba = decrypt_string($id_prueba, true);
        $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
        $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
        $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
        $params["preguntas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $this->load->view("pruebas/ver_prueba", $params);
    }

    function empezar($id_prueba){
        $id_prueba = decrypt_string($id_prueba, true);
        $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
        $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
        $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
        $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $this->load->view("pruebas/empezar_prueba", $params);
    }

    function resumen($id_prueba, $id_participante = null){
        // TODO cambiar
        if($id_participante == null){
            $id_participante = 1;
        }
        $params["prueba_realizada"] = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);
        if($params["prueba_realizada"]["calificacion"] == null){
            $this->Realizar_Prueba_Model->update(array("id_realizar_prueba" => $params["prueba_realizada"]["id_realizar_prueba"], "calificacion" => info_prueba_realizada($id_prueba, $id_participante)["porcentaje"]));
            $params["prueba_realizada"] = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);
        }
        $params["id_participante"] = $id_participante;
        $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
        $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
        $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
        $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $params["respuestas"] = $this->Respuestas_Realizar_Prueba_Model->get($params["prueba_realizada"]["id_realizar_prueba"]);

        if($params["prueba_realizada"]){
            $this->load->view("pruebas/resumen_prueba", $params);
        }
        else{
            header("Location: " . base_url() . "Pruebas");
        }
    }

    function resolver($id_prueba){
        // TODO cambiar
        $id_participante = 1;
        $participante = $this->Asignacion_Participantes_Prueba_Model->get_participante($id_participante);
        $params["id_participante"] = $id_participante;
        $iniciado = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);
        if(!$iniciado){
            $iniciado = $this->Realizar_Prueba_Model->create(array("id_prueba" => $id_prueba, "id_participante" => $id_participante, "institucion" => $participante["institucion"], "grado" => $participante["grado"], "created_at" => date("Y-m-d H:i:s")));
        }

        if($this->input->post()){
            if($iniciado){
                $data = $this->input->post();
                $this->Respuestas_Realizar_Prueba_Model->create(array("id_realizar_prueba" => $iniciado["id_realizar_prueba"], "id_pregunta" => $data["id_pregunta"], "id_respuesta" => $data["id_respuesta"]));
            }
        }

        $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
        $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $params["prueba_realizada"] = $this->Realizar_Prueba_Model->get($id_prueba, $id_participante);;

        if($params["prueba"]["fecha_inicio"] < date("Y-m-d H:i:s") && $params["prueba"]["fecha_finaliza"] > date("Y-m-d H:i:s")){
            if($iniciado){
                if($iniciado["is_closed"] == 1){
                    header("Location: ".base_url()."Pruebas/resumen/".$id_prueba);
                }
    
                $siguiente = siguiente_pregunta($id_prueba, $id_participante);
                if($siguiente == false){
    
                }
                else if(is_array($siguiente)){
                    $params["pregunta"] = $siguiente["pregunta"];
                    $params["respuestas"] = $siguiente["respuestas"];
    
                    $this->load->view("pruebas/resolver_prueba", $params);
                }
                else{
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

    function participantes($id_prueba){
        if($this->input->post()){
            $participantes = importar_participantes_pruebas($_FILES);
            $params["message"] = $this->asignarParticipantes($participantes, $id_prueba);
        }
        $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
        $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
        $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
        $params["preguntas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $params["participantes"] = $this->Asignacion_Participantes_Prueba_Model->get_all($id_prueba);
        $this->load->view("pruebas/participantes", $params);
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
                    $id_participante = $this->Participantes_Prueba_Model->create($participante);
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
        $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
        $params["asignadas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $params["preguntas"] = obtener_preguntas(unserialize($params["prueba"]["materias"]), unserialize($params["prueba"]["dificultad"]));

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
} 
