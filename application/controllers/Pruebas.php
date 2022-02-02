<?php
  
   class Pruebas extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(["Pruebas_Model", "TipoPrueba_Model", "Consultas_Model", "AlcancePruebas_Model", "Materias_Model", "Preguntas_Model", "Asignacion_Preguntas_Prueba_Model"]);
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

            return array("type" => "success", "message" => "Prueba guardada exitosamente.", "success" => true);
        }
        else{
            return array("type" => "danger", "message" => "No se ha podido crear la prueba, intente de nuevo más tarde.", "success" => false);
        }
    }

    function ver($id_prueba){
        $params["prueba"] = $this->Pruebas_Model->get($id_prueba);
        $params["dificultad"] = unserialize($params["prueba"]["dificultad"]);
        $params["materias"] = $this->Materias_Model->getMateriaPrueba(unserialize($params["prueba"]["materias"]));
        $params["preguntas"] = $this->Preguntas_Model->get_preguntas_prueba($id_prueba);
        $this->load->view("pruebas/ver_prueba", $params);
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
} 
