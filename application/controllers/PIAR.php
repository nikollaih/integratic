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
 * @property $PIAR_Actividad_Model
 * @property $PIAR_Item_Annual_Model
 * @property $Periodos_Model
 * @property $DireccionGrupo_Model
 */
class PIAR extends CI_Controller
{
    private $USER_ROL;

    /**
     * @throws \Mpdf\MpdfException
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(["DireccionGrupo_Model", "Periodos_Model", "PIAR_Item_Annual_Model", "PIAR_Actividad_Model", "Estudiante_Model", "Usuarios_Model", "PIAR_Model", "PIAR_Item_Model", "Materias_Model", "CaracterizacionEstudiantesPreguntas_Model", "CaracterizacionEstudiantesRespuestas_Model"]);
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
        if (is_logged()) {
            if ($this->hasPermission()) {
                $diagnostico = $this->input->get('diagnostico');

                if ($this->USER_ROL === 'docente') {
                    $params["estudiantes"] = $this->PIAR_Model->getStudentsByDocente(logged_user()["id"], $diagnostico);
                } else {
                    $params["estudiantes"] = $this->PIAR_Model->getStudents($diagnostico);
                }

                $this->load->view("piar/index", $params);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function create($estudianteDocumento = null){
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($estudianteDocumento);
                $gradoGrupo = get_group_grade($params["estudiante"]["documento"]);

                if(is_array($params["estudiante"]) && $params["estudiante"]["nee"] === "1"){

                    $data = $this->input->post();
                    if($data){
                        $data["id_estudiante"] = $estudianteDocumento;
                        $params["message"] = $this->save($data);
                        if($params["message"]["status"]){
                            header("Location: ".base_url()."PIAR/edit/".$params["message"]["id"]);
                        }
                    }
                    $grupo = $this->Estudiante_Model->getStudentGroupGrade($params["estudiante"]["id"]);
                    $grado = $this->Estudiante_Model->getStudentGrade($params["estudiante"]["id"]);
                    $params["materias"] = $this->Materias_Model->getMateriasGrupoGrado($grado, $grupo, logged_user()["id"]);

                    $params["docentes"] = $this->Usuarios_Model->getDocentesByGradoGrupo($gradoGrupo["grado"], $gradoGrupo["grupo"]);
                    $params["apoyos"] = $this->Usuarios_Model->get_by_role("Docente de apoyo");
                    $this->load->view("piar/crear", $params);
                }
                else header("Location: ".base_url()."PIAR");
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function edit($piarId = null, $piarItemId = null, $isNew = 'false', $piarItemAnnualId = null){
        if(is_logged()){
            if($this->hasPermission()){
                $params["estudiante"] = $this->PIAR_Model->get($piarId);
                $gradoGrupo = get_group_grade($params["estudiante"]["documento"]);

                if(is_array($params["estudiante"]) && $params["estudiante"]["nee"] === "1"){
                    $data = $this->input->post();
                    if($data){
                        $params["message"] = $this->update($piarId, $data);
                        $params["estudiante"] = $this->PIAR_Model->get($piarId);
                    }

                    if($isNew != "false" && !$data){
                        $params["message"] = array("status" => true, "type" => "success", "message" => "Formulario creado exitosamente!");
                    }

                    $grupo = $this->Estudiante_Model->getStudentGroupGrade($params["estudiante"]["documento"]);
                    $grado = $this->Estudiante_Model->getStudentGrade($params["estudiante"]["documento"]);
                    $params["materias"] = $this->Materias_Model->getMateriasGrupoGrado($grado, $grupo, logged_user()["id"]);
                    $params["docentes"] = $this->Usuarios_Model->getDocentesByGradoGrupo($gradoGrupo["grado"], $gradoGrupo["grupo"]);
                    $params["apoyos"] = $this->Usuarios_Model->get_by_role("Docente de apoyo");
                    $params["items_piar"] = $this->PIAR_Item_Model->getAllByPiar($piarId);
                    $params["items_piar_category"] = $this->PIAR_Item_Model->getAllByPiarCategories($piarId);
                    $params["items_piar"] = array_merge($params["items_piar"], $params["items_piar_category"]);
                    $params["item_piar"] = $this->PIAR_Item_Model->get($piarItemId);
                    $params["items_piar_annual"] = $this->PIAR_Item_Annual_Model->getAllByPiar($piarId);
                    $params["item_piar_annual"] = $this->PIAR_Item_Annual_Model->get($piarItemAnnualId);
                    $params["activities"] = $this->PIAR_Actividad_Model->getAllByPiar($piarId);
                    $params["periodos"] = $this->Periodos_Model->getAll();
                    $params["direccion_grupo"] = $this->DireccionGrupo_Model->getByDocenteGrado(logged_user()["id"], $params["estudiante"]["grado"]);
                    $this->load->view("piar/crear", $params);
                }
                else header("Location: ".base_url()."PIAR");
            }
            else header("Location: ".base_url());
        }
        else header("Location: ".base_url());
    }

    public function view($piarId = null, $documentType = 1){
        if(is_logged()){
            if($this->hasPermission()){
                $params["piar"] = $this->PIAR_Model->get($piarId);
                $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($params["piar"]["documento"]);
                $params["preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
                $params["respuestas"] = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($params["piar"]["documento"]);
                $params["items_piar"] = $this->PIAR_Item_Model->getAllByPiar($piarId);
                $params["items_piar_category"] = $this->PIAR_Item_Model->getAllByPiarCategories($piarId);
                $params["items_piar"] = array_merge($params["items_piar"], $params["items_piar_category"]);
                $params["activities"] = $this->PIAR_Actividad_Model->getAllByPiar($piarId);
                $params["documentType"] = $documentType;

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

    public function viewAnnual($piarId = null){
        if(is_logged()){
            if($this->hasPermission()){
                $params["piar"] = $this->PIAR_Model->get($piarId);
                $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($params["piar"]["documento"]);
                $params["items_piar"] = $this->PIAR_Item_Annual_Model->getAllByPiar($piarId);

                $this->load->view("piar/view_annual", $params);
                // Cargar HTML en dompdf (puedes cargar tu vista aquí)
                $html = $this->output->get_output();

                // Set footer margin to create space
                $this->mpdf->SetMargins(10, 10, 40); // Left, Top, Right
                $this->mpdf->SetAutoPageBreak(true, 20); // Bottom margin of 30 units for spacing

                // Set header
                $header = $this->load->view('piar/templates/pdf_annual_header', [], true);
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
                            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger alert-dismissible show" role="alert">'.$created["message"].'</div>');
                        }

                        redirect(base_url()."PIAR/edit/".$data["id_piar"]);
                    }
                    else {
                        header("Location: ".base_url()."PIAR");
                    }
                }
                else {
                    header("Location: ".base_url()."PIAR");
                }
            }
        }
    }

    public function addItemAnnualPiar(){
        if(is_logged()){
            if($this->hasPermission()){
                $data = $this->input->post();
                if($data){
                    $piar = $this->PIAR_Model->get($data["id_piar"]);
                    if($piar){
                        $data["id_docente"] = logged_user()["id"];
                        $created = $this->saveItemAnnualPiar($data);
                        if(isset($created["id"])){
                            $this->session->set_flashdata('mensaje', '<div class="alert alert-success alert-dismissible show" role="alert">'.$created["message"].'</div>');
                        }
                        else {
                            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger alert-dismissible show" role="alert">Ha ocurrido un error, intente de nuevo más tarde</div>');
                        }

                        redirect(base_url()."PIAR/edit/".$data["id_piar"]);
                    }
                    else {
                        header("Location: ".base_url()."PIAR");
                    }
                }
                else {
                    header("Location: ".base_url()."PIAR");
                }
            }
        }
    }

    public function saveActivity() {
        if(is_logged()){
            if($this->hasPermission()){
                $data = $this->input->post();
                if($data){
                    $created = $this->PIAR_Actividad_Model->create($data);
                    if(isset($created)){
                        $this->session->set_flashdata('mensaje', '<div class="alert alert-success alert-dismissible show" role="alert">Actividad creada exitosamente</div>');
                    }
                    else {
                        $this->session->set_flashdata('mensaje', '<div class="alert alert-danger alert-dismissible show" role="alert">Ha ocurrido un error, intente de nuevo más tarde</div>');
                    }

                    redirect(base_url()."PIAR/edit/".$data["id_piar"]);
                }
                else {
                    header("Location: ".base_url()."PIAR");
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

    public function deletePiarAnnualItem(){
        if(is_logged()){
            if($this->hasPermission()){
                $data = $this->input->post();
                if($data){
                    $deleted = $this->PIAR_Item_Annual_Model->delete($data["id_piar_annual_item"]);
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

    public function addComments(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) === "coordinador"){
                $data = $this->input->post();
                if($data){
                    $updated = $this->PIAR_Model->update($data["id_piar"], $data);
                    if($updated){
                        $this->session->set_flashdata('mensaje', '<div class="alert alert-success alert-dismissible show" role="alert">Observaciones agregadas exitosamente</div>');
                    }
                    else {
                        $this->session->set_flashdata('mensaje', '<div class="alert alert-danger alert-dismissible show" role="alert">Ha ocurrido un error, intente de nuevo más tarde</div>');
                    }
                }

                header("Location: ".base_url()."PIAR");
            }
        }
    }

    public function deletePiarActivity(){
        if(is_logged()){
            if($this->hasPermission()){
                $data = $this->input->post();
                if($data){
                    $deleted = $this->PIAR_Actividad_Model->delete($data["id_piar_actividad"]);
                    if($deleted){
                        json_response(null, true, "Actividad eliminada exitosamente");
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
        $message = "No se ha podido crear el formulario";

        if($piarItem){
            $created = $this->PIAR_Item_Model->update($data["id_piar_item"], $data);
            $message = "Registro modificado exitosamente";
        }
        else{
            $exists = $this->PIAR_Item_Model->getByDocenteMateriaPeriodo($data["id_docente"], $data["id_materia"], $data["id_periodo"]);

            if($exists){
                $created = false;
                $message = "Ya existe un registro que coincide con la materia y el periodo, solo puede crear un registro por periodo.";
            }
            else {
                unset($data["id_piar_item"]);
                $created = $this->PIAR_Item_Model->create($data);
                $message = "Registro creado exitosamente";
            }
        }

        return $created ?
            array("status" => true, "id" => $created, "message" => $message) :
            array("status" => false, "type" => "danger", "message" => $message);
    }

    private function saveItemAnnualPiar($data): array
    {
        $piarItem = $this->PIAR_Item_Annual_Model->get($data["id_piar_item_anual"]);

        if($piarItem){
            $created = $this->PIAR_Item_Annual_Model->update($data["id_piar_item_anual"], $data);
            $message = "Item modificado exitosamente";
        }
        else{
            unset($data["id_piar_item_anual"]);
            $created = $this->PIAR_Item_Annual_Model->create($data);
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

    function find($idPiar){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) == "coordinador"){
                $evidencia = $this->PIAR_Model->get($idPiar);
                if($evidencia) json_response($evidencia, true, "PIAR");
                else json_response(array("error" => "404"), false, "No se ha encontrado el PIAR");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }
}