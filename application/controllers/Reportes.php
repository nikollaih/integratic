<?php
use Dompdf\Dompdf;
use Dompdf\Options;
class Reportes extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model(['Actividades_Model', 'Materias_Model', 'Periodos_Model']);
    }

    // Shows the activities calendar
    function index(){
        if(is_logged()){
            $grado = $this->session->userdata()["logged_in"]["grado"];
            $grupo = $this->session->userdata()["logged_in"]["grupo"];

            $params["materias"] = $this->Materias_Model->getMateriasGrupoGrado($grado, $grupo);
            $params["periodos"] = $this->Periodos_Model->getAll();
            $this->load->view("reportes/index", $params);
        }
        else header("Location: ".base_url());

    }

    function actividadesEstudiante($materia = null, $periodo = null){
        if(is_logged()){
            $grado = $this->session->userdata()["logged_in"]["grado"];
            $grupo = $this->session->userdata()["logged_in"]["grupo"];
            
            if($this->input->post()){
                $materia = $this->input->post("id_materia");
                $periodo = $this->input->post("id_periodo");
            }

            $params["periodo"] = $this->Periodos_Model->find($periodo);
            if($materia != null && $materia != "null"){
                $params["materias"][0] = $this->Materias_Model->getMateria($materia);
            }
            else{
                $params["materias"] = $this->Materias_Model->getMateriasGrupoGrado($grado, $grupo);
            }

            if(is_array($params["materias"])){
                for ($i=0; $i < count($params["materias"]); $i++) { 
                    $params["materias"][$i]["actividades"] = $this->Actividades_Model->get_all_for_students($params["materias"][$i]["codmateria"], $periodo, $grupo);
                }
            }

            $params["actividades"] = $this->Actividades_Model->get_all_for_students($materia, $periodo, $grupo, $grado);
            $this->load->view("reportes/actividades_estudiante", $params);

            // Cargar HTML en dompdf (puedes cargar tu vista aquí)
            $html = $html = $this->output->get_output();

            // Configurar opciones de dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
        

            // Inicializar dompdf
            $dompdf = new Dompdf($options);
            // Configurar orientación a horizontal
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->set_option('defaultMediaType', 'all');
            $dompdf->set_option('isFontSubsettingEnabled', true);
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->set_option('isRemoteEnabled', TRUE);
            
            $dompdf->loadHtml($html);

            // Renderizar PDF
            $dompdf->render();

            // Mostrar el PDF en el navegador o descargarlo
            $dompdf->stream('documento.pdf', array('Attachment' => false));
        }
        else header("Location: ".base_url());
    }
}

?>