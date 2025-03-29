<?php
/**
 * @property $load
 * @property $Materias_Model
 * @property $input
 * @property $Participantes_Prueba_Model
 * @property $Realizar_Prueba_Model
 * @property $Temas_Model
 */
class Simulacros extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model(["Materias_Model", "Participantes_Prueba_Model", "Realizar_Prueba_Model", "Temas_Model"]);
    }

    public function index() {
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) === 'docente' || strtolower(logged_user()["rol"]) === 'coordinador'){
                $params["pruebas"] = [];
                $params["data_estudiante"] = false;
                if($this->input->post()){
                    $data = $this->input->post();
                    $materiaGrado = explode("&", $data["materia"]);
                    $params["data_estudiante"] = $data;
                    $params["data_estudiante"]["participante"] = $this->Participantes_Prueba_Model->get($data["estudiante"]);
                    $params["pruebas"] = $this->Realizar_Prueba_Model->get_by_participante_materia_tipo_temas($data["estudiante"], $materiaGrado[1], 4, $data["temas"]);

                    if($params["pruebas"]){
                        foreach ($params["pruebas"] as &$prueba) {
                            if (isset($prueba['materias'])) {
                                $prueba['materias'] = unserialize($prueba['materias']);
                            }
                            if (isset($prueba['temas'])) {
                                $prueba['temas'] = unserialize($prueba['temas']);
                            }
                            if (isset($prueba['dificultad'])) {
                                $prueba['dificultad'] = unserialize($prueba['dificultad']);
                            }
                        }
                    }

                    $params["data_estudiante"]["temas"] = $this->Temas_Model->getByIds($data["temas"]);
                }
                $params["materias"] = $this->Materias_Model->getMateriasDocente(logged_user()["id"], false, false);

                $this->load->view("pruebas/simulacros/index", $params);
            }
        }
        else header("Location: ".base_url());
    }
}
