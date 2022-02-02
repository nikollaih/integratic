<?php
  
   class ParticipantesPrueba extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(["Asignacion_Participantes_Prueba_Model"]);
    }
    
    public function delete(){
        if($this->input->post()){
			$id_prueba = $this->input->post("id_prueba");
			$id_participante = $this->input->post("id_participante");

			if($this->Asignacion_Participantes_Prueba_Model->delete($id_prueba, $id_participante)){
                json_response(null, true, "Participante eliminado exitosamente.");
            }
            else{
                json_response(null, false, "No ha sido posible eliminar el participante.");
            }
		}
    }
} 
