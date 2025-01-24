<?php
class RespuestasRealizarPruebaAbiertas_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_by_prueba_participante($id_prueba, $id_participante){
        $this->db->select("rrpa.id_pregunta");
        $this->db->from("realizar_prueba rp");
        $this->db->join("respuestas_realizar_prueba_abiertas rrpa", "rp.id_realizar_prueba = rrpa.id_realizar_prueba");
        $this->db->where("rp.id_prueba", $id_prueba);
        $this->db->where("rp.id_participante", $id_participante);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function get($id_realizar_prueba){
        $this->db->from("respuestas_realizar_prueba_abiertas rrpa");
        $this->db->join("preguntas_prueba pp", "rrpa.id_pregunta = pp.id_pregunta_prueba");
        $this->db->where("rrpa.id_realizar_prueba", $id_realizar_prueba);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function create($data){
        $this->db->insert("respuestas_realizar_prueba_abiertas", $data);
        return $this->db->insert_id();
    }

    function update($data){
        $this->db->where('id_respuesta_abierta', $data['id_respuesta_abierta']);
        return $this->db->update("respuestas_realizar_prueba_abiertas", $data);
    }
}