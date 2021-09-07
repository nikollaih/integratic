<?php
  
   class Foros extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url', 'foros')); 
       $this->load->model('Foro_Model');
    }
    
    public function ver($id_foro){
        $data["foro"] = $this->Foro_Model->get($id_foro);
        $data["respuestas"] = $this->Foro_Model->get_answers($id_foro);
        $respuestas_dom = "";

        $respuestas_dom .= '<div class="row" style="margin-top:0px;margin-left:30px;">'.
                                '<div class="col-md-12" style="padding-left:20px;">'.
                                '<ul style="padding:0;">';
                                    if($data["respuestas"]){
                                        foreach ($data["respuestas"] as $r) {
                                            $respuestas = $this->Foro_Model->get_subanswers($r["id_respuesta"]);
                                            $count_answers = ($respuestas) ? count($respuestas) : 0;
                                            $respuestas_dom .=  load_answer($r, 0, "answer-".$r["id_respuesta"], $count_answers);
                                            $respuestas_dom .= $this->cargar_respuesta($r, $respuestas, 30, "answer-".$r["id_respuesta"]);
                                        }
                                    }
                                    $respuestas_dom .= '</ul>'.
                                    '</div>'.
                            '</div>';

        $data["dom"] = $respuestas_dom;
        $this->load->view("foros/ver", $data);
    }

    public function cargar_respuesta($respuesta, $respuestas, $margin, $id){
        $dom = "";

        if($respuestas){
            $dom .=  '<ul class="'.$id.' container-answers-foro" style="padding:0;margin:0px 0px 0px '.$margin.'px;">';
            foreach ($respuestas as $r) {
                $respuestas_temp = $this->Foro_Model->get_subanswers($r["id_respuesta"]);
                $count_answers = ($respuestas_temp) ? count($respuestas_temp) : 0;

                $dom .= load_answer($r, $margin, "answer-".$r["id_respuesta"], $count_answers);
                $dom .= $this->cargar_respuesta($r, $respuestas_temp, $margin, "answer-".$r["id_respuesta"]);
            }
            $dom .= '</ul>';

            return $dom;
        }
        else{
            return "";
        }
    }

    public function agregar_respuesta(){
        $id_foro = $this->input->post("id_foro");
        $id_respuesta = $this->input->post("id_respuesta");
        $tipo = $this->input->post("tipo");
        $mensaje = $this->input->post("mensaje");

        if($tipo == "foro"){
            $foro = $this->Foro_Model->get($id_foro);
        }

        $respuesta["id_foro"] = $id_foro;
        $respuesta["id_relacion_respuesta"] = $id_respuesta;
        $respuesta["created_by"] = logged_user()["id"];
        $respuesta["descripcion"] = $mensaje;

        if($this->Foro_Model->add_answer($respuesta)){
            json_response(null, true, "Respuesta creada exitosamente");
        }
        else{
            json_response(null, true, "Error al intentar crear la respuesta");
        }
    }

    // Crear un nuevo foro
    public function agregar_foro(){

        // Verifica que exista un usuario logueado
        if(isset(logged_user()["id"])){
            $data["materia"] = $this->input->post("materia");
            $data["grupo"] = $this->input->post("grupo");
            $data["descripcion"] = $this->input->post("descripcion");
            $data["titulo"] = $this->input->post("titulo");
            $data["created_by"] = logged_user()["id"];
            $data["created_at"] = date("Y-m-d H:i:s");

            if($data["materia"] && $data["grupo"] && $data["titulo"] != ""){
                $foro = $this->Foro_Model->add($data);
                if($foro){
                    json_response($foro, true, "Foro creado exitosamente");
                }
                else{
                    json_response(null, true, "Error al intentar crear el foro, por favor intente de nuevo más tarde");
                }
            }
            else{
                json_response(null, false, "Error al intentar crear el foro, campos requeridos!");
            }
        }
        else{
            json_response(null, false, "Error al intentar crear el foro, usuario no válido!");
        }
    }

} 
