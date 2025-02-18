<?php

use Mpdf\Mpdf;

/**
 * @property $load
 * @property $Estudiante_Model
 * @property $Usuarios_Model
 * @property $input
 * @property $PIAR_Model
 * @property $PIAR_Item_Model
 * @property $Materias_Model
 * @property Mpdf $mpdf
 * @property $CaracterizacionEstudiantesPreguntas_Model
 * @property $CaracterizacionEstudiantesRespuestas_Model
 */
class PIAR extends CI_Controller
{
    private $USER_ROL;

    /**
     * @throws \Mpdf\MpdfException
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(["Estudiante_Model", "Usuarios_Model", "PIAR_Model", "PIAR_Item_Model", "Materias_Model", "CaracterizacionEstudiantesPreguntas_Model", "CaracterizacionEstudiantesRespuestas_Model"]);
        $this->USER_ROL = (is_logged()) ? strtolower(logged_user()["rol"]) : "";

        $this->mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4', // A4 landscape orientation
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5
        ]);
    }

    private function hasPermission(): bool
    {
        return ($this->USER_ROL === "docente" || $this->USER_ROL === "coordinador" || $this->USER_ROL === "docente de apoyo");
    }

    public function index() {
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiantes"] = $this->PIAR_Model->getStudents();
                $this->load->view("piar/index", $params);
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function create($estudianteDocumento = null){
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($estudianteDocumento);

                if(is_array($params["estudiante"]) && $params["estudiante"]["nee"] === "1"){

                    $data = $this->input->post();
                    if($data){
                        $data["id_estudiante"] = $estudianteDocumento;
                        $params["message"] = $this->save($data);
                        if($params["message"]["status"]){
                            header("Location: ".base_url()."Piar/edit/".$params["message"]["id"]);
                        }
                    }
                    $grupo = $this->Estudiante_Model->getStudentGroupGrade($params["estudiante"]["id"]);
                    $grado = $this->Estudiante_Model->getStudentGrade($params["estudiante"]["id"]);
                    $params["materias"] = $this->Materias_Model->getMateriasGrupoGrado($grado, $grupo);

                    $params["docentes"] = $this->Usuarios_Model->get_by_role("docente");
                    $params["apoyos"] = $this->Usuarios_Model->get_by_role("Docente de apoyo");
                    $this->load->view("piar/crear", $params);
                }
                else header("Location: ".base_url()."Piar");
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function edit($piarId = null, $piarItemId = null, $isNew = false){
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiante"] = $this->PIAR_Model->get($piarId);

                if(is_array($params["estudiante"]) && $params["estudiante"]["nee"] === "1"){

                    $data = $this->input->post();
                    if($data){
                        $params["message"] = $this->update($piarId, $data);
                        $params["estudiante"] = $this->PIAR_Model->get($piarId);
                    }

                    if($isNew && !$data){
                        $params["message"] = array("status" => true, "type" => "success", "message" => "Formulario creado exitosamente!");
                    }

                    $grupo = $this->Estudiante_Model->getStudentGroupGrade($params["estudiante"]["documento"]);
                    $grado = $this->Estudiante_Model->getStudentGrade($params["estudiante"]["documento"]);
                    $params["materias"] = $this->Materias_Model->getMateriasGrupoGrado($grado, $grupo);
                    $params["docentes"] = $this->Usuarios_Model->get_by_role("docente");
                    $params["apoyos"] = $this->Usuarios_Model->get_by_role("Docente de apoyo");
                    $params["items_piar"] = $this->PIAR_Item_Model->getAllByPiar($piarId);
                    $params["items_piar_category"] = $this->PIAR_Item_Model->getAllByPiarCategories($piarId);
                    $params["items_piar"] = array_merge($params["items_piar"], $params["items_piar_category"]);
                    $params["item_piar"] = $this->PIAR_Item_Model->get($piarItemId);
                    $this->load->view("piar/crear", $params);
                }
                else header("Location: ".base_url()."Piar");
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function view($piarId = null){
        if(is_logged()){
            if($this->hasPermission()){
                $params["piar"] = $this->PIAR_Model->get($piarId);
                $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($params["piar"]["documento"]);
                $params["preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
                $params["respuestas"] = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($params["piar"]["documento"]);
                $params["items_piar"] = $this->PIAR_Item_Model->getAllByPiar($piarId);
                $params["items_piar_category"] = $this->PIAR_Item_Model->getAllByPiarCategories($piarId);
                $params["items_piar"] = array_merge($params["items_piar"], $params["items_piar_category"]);

                $this->load->view("piar/view", $params);
                // Cargar HTML en dompdf (puedes cargar tu vista aquí)
                $html = $this->output->get_output();

                // Set footer margin to create space
                $this->mpdf->SetMargins(10, 10, 35); // Left, Top, Right
                $this->mpdf->SetAutoPageBreak(true, 20); // Bottom margin of 30 units for spacing

                // Set footer
                $footer = $this->load->view('piar/templates/pdf_footer', [], true);
                $this->mpdf->SetHTMLFooter($footer);

                // Set header
                $header = $this->load->view('piar/templates/pdf_header', [], true);
                $this->mpdf->SetHTMLHeader($header);

                $this->mpdf->WriteHTML($html);
                $this->mpdf->Output('documento.pdf', 'I');
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function addItemPiar(){
        if(is_logged()){
            if($this->hasPermission()){
                $data = $this->input->post();
                if($data){
                    $piar = $this->PIAR_Model->get($data["id_piar"]);
                    if($piar){
                        $data["id_docente"] = logged_user()["id"];
                        $created = $this->saveItemPiar($data);
                        if(isset($created["id"])){
                            $this->session->set_flashdata('mensaje', '<div class="alert alert-success alert-dismissible show" role="alert">'.$created["message"].'</div>');
                        }
                        else {
                            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger alert-dismissible show" role="alert">Ha ocurrido un error, intente de nuevo más tarde</div>');
                        }

                        redirect(base_url()."Piar/edit/".$data["id_piar"]);
                    }
                    else {
                        header("Location: ".base_url()."Piar");
                    }
                }
                else {
                    header("Location: ".base_url()."Piar");
                }
            }
        }
    }

    public function deletePiarItem(){
        if(is_logged()){
            if($this->hasPermission()){
                $data = $this->input->post();
                if($data){
                    $deleted = $this->PIAR_Item_Model->delete($data["id_piar_item"]);
                    if($deleted){
                        json_response(null, true, "Item eliminado exitosamente");
                    }
                    else {
                        json_response(null, false, "Ha ocurrido un error, intente de nuevo más tarde");
                    }
                }
            }
        }
    }


    /* PRIVATE FUNCTIONS */

    private function save($data): array
    {
        $created = $this->PIAR_Model->create($data);

        return $created ?
            array("status" => true, "id" => $created) :
            array("status" => false, "type" => "danger", "message" => "No se ha podido crear el formulario");
    }

    private function saveItemPiar($data): array
    {
        $piarItem = $this->PIAR_Item_Model->get($data["id_piar_item"]);

        if($piarItem){
            $created = $this->PIAR_Item_Model->update($data["id_piar_item"], $data);
            $message = "Item modificado exitosamente";
        }
        else{
            unset($data["id_piar_item"]);
            $created = $this->PIAR_Item_Model->create($data);
            $message = "Item creado exitosamente";
        }

        return $created ?
            array("status" => true, "id" => $created, "message" => $message) :
            array("status" => false, "type" => "danger", "message" => "No se ha podido crear el formulario");
    }

    private function update($estudianteDocumento, $data): array
    {
        $created = $this->PIAR_Model->update($estudianteDocumento, $data);

        return $created ?
            array("status" => true, "type" => "success", "message" => "Formulario modificado exitosamente!") :
            array("status" => false, "type" => "danger", "message" => "No se ha podido modificar el formulario");
    }
}