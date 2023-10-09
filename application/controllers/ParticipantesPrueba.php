<?php
  
   class ParticipantesPrueba extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(["Asignacion_Participantes_Prueba_Model", "Municipios_Model", "Participantes_Prueba_Model", "Estudiante_Model", "Usuarios_Model"]);
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

    public function importar(){
        if(is_logged()){
			if(strtolower(logged_user()["rol"]) == "docente"){
				$params = [];
                $params["municipios"] = $this->Municipios_Model->get_all();
				if(isset($_FILES["participantes"])){
					$participantes = importar_participantes_pruebas($_FILES);
					if($participantes){
						$data = $this->input->post();
						$participantesList = $this->prepareImportedPaerticipants($participantes, $data);

						if ($this->saveImportedParticipants($participantesList)){
							$params["message"]["message"] = "Participantes importados correctamente";
							$params["message"]["type"] = "success";
						}
						else{
							$params["message"]["message"] = "No se han podido importar los participantes";
							$params["message"]["type"] = "error";
						}
					}
					else{
						$params["message"]["message"] = "No se han podido importar los participantes";
						$params["message"]["type"] = "error";
					}
				}

				$this->load->view('pruebas/importar_participantes', $params);
			}
			else header("Location: ".base_url());
		}
		else header("Location: ".base_url());
    }

	function saveImportedParticipants($participants){
		foreach ($participants as $participant) {
			$student = array(
				"documento" => $participant["identificacion"],
				"nombre" => $participant["nombres"] . " " . $participant["apellidos"],
				"grado" => $participant["grado"]
			);

			$user = array(
				"id" => $participant["identificacion"],
				"nombres" => $participant["nombres"],
				"apellidos" => $participant["nombres"],
				"cargo" => "Estudiante",
				"rol" => "Estudiante",
				"nocel" => $participant["telefono"],
				"usuario" => $participant["identificacion"],
				"clave" => $participant["identificacion"]
			);

			$exists = $this->Participantes_Prueba_Model->get_participante_by_identificacion($participant["identificacion"]);
			if($exists) {
				$this->Estudiante_Model->update($student);
				$this->Usuarios_Model->update_user($user);
				$this->Participantes_Prueba_Model->update($participant);
			}
			else {
				$this->Estudiante_Model->add($student);
				$this->Usuarios_Model->add($user);
				$this->Participantes_Prueba_Model->create($participant);
			}
		}

		return true;
	}

	function prepareImportedPaerticipants($participantes, $data){
		for ($i=0; $i < count($participantes); $i++) { 
			$participantes[$i]["grado"] = $data["grado"];
			$participantes[$i]["municipio"] = $data["municipio"];
			$participantes[$i]["institucion"] = $data["institucion"];
		}
		return $participantes;
	}

	public function getParticipantsByGrade($grade){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $participants = $this->Participantes_Prueba_Model->get_participante_by_param("grado", $grade);
                json_response($participants, true, "Lista de items.");
            }
            else json_response(null, false, "No tiene permiso para realizar esta acción.");
        }
        else json_response(null, false, "Inicie sesión para continuar.");
    }
} 
