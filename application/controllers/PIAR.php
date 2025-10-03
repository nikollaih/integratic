<?php

use Mpdf\Mpdf;
use Dompdf\Dompdf;
use Dompdf\Options;


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
 * @property $Caracterizacion_DBA_Model
 * @property $Areas_Model
 * @property $Barreras_Model
 * @property $AjustesRazonables_Model
 */
class PIAR extends CI_Controller
{
    private $USER_ROL;

    /**
     * @throws \Mpdf\MpdfException
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(["AjustesRazonables_Model", "Barreras_Model", "Areas_Model", "Caracterizacion_DBA_Model", "DireccionGrupo_Model", "Periodos_Model", "PIAR_Item_Annual_Model", "PIAR_Actividad_Model", "Estudiante_Model", "Usuarios_Model", "PIAR_Model", "PIAR_Item_Model", "Materias_Model", "CaracterizacionEstudiantesPreguntas_Model", "CaracterizacionEstudiantesRespuestas_Model"]);
        $this->USER_ROL = (is_logged()) ? strtolower(logged_user()["rol"]) : "";

        $this->mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4', // A4 landscape orientation
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 40
        ]);
    }

    private function hasPermission(): bool
    {
        return ($this->USER_ROL === "docente" || $this->USER_ROL === "coordinador" || $this->USER_ROL === "docente de apoyo" || $this->USER_ROL === "orientador" || $this->USER_ROL === "super");
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
                    $params["barreras_categorias"] = $this->Barreras_Model->get_categorias();
                    $params["ajustes_razonables_categorias"] = $this->AjustesRazonables_Model->get_categorias();

                    if($params["item_piar"]){
                        $params["item_piar"] = $this->getItemPiarDBAs([$params["item_piar"]])[0];
                        $params["item_piar"]["barreras_seleccionadas"] = (!str_contains($params["item_piar"]["barreras"], "observaciones") && (strpos($params["item_piar"]["barreras"], 'a:') === 0)) ?
                            $this->Barreras_Model->get_by_ids(unserialize($params["item_piar"]["barreras"])) :
                            ((strpos($params["item_piar"]["barreras"], 'a:2:') === 0) ?
                                $this->Barreras_Model->get_by_ids(unserialize($params["item_piar"]["barreras"])["barreras"]) :
                            $params["item_piar"]["barreras"]);

                        $params["item_piar"]["ajustes_razonables_seleccionados"] = (!str_contains($params["item_piar"]["ajustes_razonables"], "observaciones") && strpos($params["item_piar"]["ajustes_razonables"], 'a:') === 0) ?
                            $this->AjustesRazonables_Model->get_by_ids(unserialize($params["item_piar"]["ajustes_razonables"])) :
                            ((strpos($params["item_piar"]["ajustes_razonables"], 'a:2:') === 0) ?
                                $this->AjustesRazonables_Model->get_by_ids(unserialize($params["item_piar"]["ajustes_razonables"])["ajustes_razonables"]) :
                            $params["item_piar"]["ajustes_razonables"]);
                    }

                    if($params["items_piar"]){
                        $params["items_piar"] = $this->getItemPiarDBAs($params["items_piar"]);
                        $params["items_piar"] = $this->getItemPiarBarrerasAjustesRazonables($params["items_piar"]);
                    }
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

    private function getItemPiarBarrerasAjustesRazonables($itemsPiar){
        if($itemsPiar){
            for ($i = 0; $i < count($itemsPiar); $i++) {
                $itemsPiar[$i]["barreras_seleccionadas"] = (!str_contains($itemsPiar[$i]["barreras"], "observaciones") && (strpos($itemsPiar[$i]["barreras"], 'a:') === 0)) ?
                    $this->Barreras_Model->get_by_ids(unserialize($itemsPiar[$i]["barreras"])) :
                    ((strpos($itemsPiar[$i]["barreras"], 'a:2:') === 0) ?
                        $this->Barreras_Model->get_by_ids(unserialize($itemsPiar[$i]["barreras"])["barreras"]) :
                    $itemsPiar[$i]["barreras"]);

                $itemsPiar[$i]["ajustes_razonables_seleccionados"] = (!str_contains($itemsPiar[$i]["ajustes_razonables"], "observaciones") && (strpos($itemsPiar[$i]["ajustes_razonables"], 'a:') === 0)) ?
                    $this->AjustesRazonables_Model->get_by_ids(unserialize($itemsPiar[$i]["ajustes_razonables"])) :
                    ((strpos($itemsPiar[$i]["ajustes_razonables"], 'a:2:') === 0) ?
                        $this->AjustesRazonables_Model->get_by_ids(unserialize($itemsPiar[$i]["ajustes_razonables"])["ajustes_razonables"]) :
                    $itemsPiar[$i]["ajustes_razonables"]);
            }
        }
        return $itemsPiar;

    }

    private function getItemPiarDBAs($itemsPiar) {
        if($itemsPiar){
            for ($i = 0; $i < count($itemsPiar); $i++) {
                if(isset($itemsPiar[$i]["id_materia"])){
                    $materia = $this->Materias_Model->getMateria($itemsPiar[$i]["id_materia"]);
                    if($materia){
                        $area = $this->Areas_Model->find($materia["area"]);

                        $itemsPiar[$i]["dbas"] = $this->Caracterizacion_DBA_Model->get_all_area_grado($area["caracterizacion_area"], $materia["grado"]);
                    }
                }
            }
        }
        return $itemsPiar;
    }

    public function view($piarId = null, $documentType = 1, $outputMode = 'stream', $savePath = null){
        // Seguridad / permisos
        if(!is_logged()){
            header("Location: ".base_url());
            return;
        }
        if(!$this->hasPermission()){
            header("Location: ".base_url());
            return;
        }

        // --- Carga de datos (igual que antes) ---
        $params["piar"] = $this->PIAR_Model->get($piarId);
        $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($params["piar"]["documento"]);
        $params["preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
        $params["respuestas"] = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($params["piar"]["documento"]);
        $params["items_piar"] = $this->PIAR_Item_Model->getAllByPiar($piarId);
        $params["items_piar_category"] = $this->PIAR_Item_Model->getAllByPiarCategories($piarId);
        $params["items_piar"] = array_merge($params["items_piar"], $params["items_piar_category"]);

        if($params["items_piar"]){
            $params["items_piar"] = $this->getItemPiarDBAs($params["items_piar"]);
            $params["items_piar"] = $this->getItemPiarBarrerasAjustesRazonables($params["items_piar"]);
        }

        $params["activities"] = $this->PIAR_Actividad_Model->getAllByPiar($piarId);
        $params["documentType"] = $documentType;

        // --- OJO: pedir la vista como string para NO imprimir nada en el buffer ---
        $html = $this->load->view("piar/view", $params, true); // retorna el HTML como string

        // --- Configuración mPDF ---
        // Asumo que $this->mpdf ya está inicializado en tu controller; si no,
        // créalo: $this->mpdf = new \Mpdf\Mpdf([...]);
        $this->mpdf->SetMargins(10, 10, 35); // Left, Top, Right
        $this->mpdf->SetAutoPageBreak(true, 20); // margen inferior
        $this->mpdf->shrink_tables_to_fit = 1;
        $this->mpdf->tableMinSizePriority = true;

        // Header y footer como HTML (devueltos por la vista)
        $header = $this->load->view('piar/templates/pdf_header', [], true);
        $footer = $this->load->view('piar/templates/pdf_footer', [], true);

        $this->mpdf->SetHTMLHeader($header);
        $this->mpdf->SetHTMLFooter($footer);

        // Escribir contenido (body)
        $this->mpdf->WriteHTML($html);

        // Nombre por defecto
        $fileName = 'anexo' . $documentType . '.pdf';

        // Normalizamos el modo
        $mode = strtolower(trim($outputMode));

        if($mode === 'save'){
            // savePath obligatorio para 'save'
            if(empty($savePath)){
                header("HTTP/1.1 500 Internal Server Error");
                return;
            }

            // Determinar path completo
            $isDir = (substr($savePath, -1) === DIRECTORY_SEPARATOR) || is_dir($savePath);
            if($isDir){
                $dir = rtrim($savePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
                $saveFullPath = $dir . $fileName;
            } else {
                $saveFullPath = $savePath;
                $dir = dirname($saveFullPath);
            }

            // Crear directorio si no existe
            if(!is_dir($dir)){
                if(!mkdir($dir, 0755, true)){
                    header("HTTP/1.1 500 Internal Server Error");
                    return;
                }
            }

            // Generar PDF a string y grabar en disco
            try {
                // Obtener contenido PDF en memoria (S -> retorna string)
                $pdfString = $this->mpdf->Output($fileName, 'S');
                $bytes = file_put_contents($saveFullPath, $pdfString);
                if($bytes === false){
                    header("HTTP/1.1 500 Internal Server Error");
                    return;
                }

                // Respuesta JSON con info de guardado
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode([
                    'success' => true,
                    'path' => $saveFullPath,
                    'bytes' => $bytes
                ]);
                return;
            } catch (\Mpdf\MpdfException $e){
                header("HTTP/1.1 500 Internal Server Error");
                return;
            }
        }

        if($mode === 'download'){
            // Forzar descarga al navegador
            $this->mpdf->Output($fileName, 'D'); // D => download
            return;
        }

        // Por defecto 'stream' => mostrar inline en el navegador
        $this->mpdf->Output($fileName, 'I'); // I => inline
        return;
    }


    public function viewDOM($piarId = null, $documentType = 1, $outputMode = 'stream', $savePath = null){
        if(!is_logged()){
            header("Location: ".base_url());
            return;
        }

        if(!$this->hasPermission()){
            header("Location: ".base_url());
            return;
        }

        // Carga de datos
        $params["piar"] = $this->PIAR_Model->get($piarId);
        $params["estudiante"] = $this->Estudiante_Model->getStudentUserByDocument($params["piar"]["documento"]);
        $params["preguntas"] = $this->CaracterizacionEstudiantesPreguntas_Model->getPreguntas();
        $params["respuestas"] = $this->CaracterizacionEstudiantesRespuestas_Model->getRespuestas($params["piar"]["documento"]);
        $params["items_piar"] = $this->PIAR_Item_Model->getAllByPiar($piarId);
        $params["items_piar_category"] = $this->PIAR_Item_Model->getAllByPiarCategories($piarId);
        $params["items_piar"] = array_merge($params["items_piar"], $params["items_piar_category"]);

        if($params["items_piar"]){
            $params["items_piar"] = $this->getItemPiarDBAs($params["items_piar"]);
            $params["items_piar"] = $this->getItemPiarBarrerasAjustesRazonables($params["items_piar"]);
        }

        $params["activities"] = $this->PIAR_Actividad_Model->getAllByPiar($piarId);
        $params["documentType"] = $documentType;

        // Carga la vista para obtener HTML
        $html = $this->load->view("piar/view", $params, true);

        // --- Opciones Dompdf ---
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'portrait');

        // header/footer (si los usas)
        $header = $this->load->view('piar/templates/pdf_header', [], true);
        $footer = $this->load->view('piar/templates/pdf_footer', [], true);

        $fullHtml = '
        <!doctype html>
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <style>
                          @page {
                              margin: 100px 20px 100px 20px; /* top right bottom left */
                              overflow: hidden;
                            }
                            
                            .no-margin {
                                margin: 0;
                            }
                            
                            .small-block * {
                                font-size: 10px !important;
                            }
                            
                            /* Básicos */
                            table { width:100%; border-collapse: collapse; margin-top: 8px; border: 1px solid #000; }
                            
                            header { position: fixed; top: -90px; left: 0; right: 0; height: 50px; }
                                                      footer { position: fixed; bottom: -100px; left: 0; right: 0; height: 60px; font-size: 10px; }
                            
                            /* Repetir encabezados */
                            thead { display: table-header-group;  }
                            tfoot { display: table-footer-group; }
                            
                            /* --- IMPORTANTE: permitir quiebres donde sea necesario --- */
                            /* No fuerces que toda la fila se mantenga junta; deja que Dompdf decida */
                            tr {
                              page-break-inside: auto;      /* PERMITIR quiebre entre filas */
                              break-inside: auto;
                              border: 1px solid #000;
                            }
                            
                            /* Por defecto, celdas con contenido corto no se deberían partir forzosamente.
                               Pero NO impedirás el rompimiento de contenido largo: eso lo controlamos con .allow-break */
                            td, th {
                              vertical-align: top;
                              padding: 6px;
                              border: 1px solid #000;
                              overflow-wrap: break-word;
                              word-wrap: break-word;
                              /* *No* usar page-break-inside: avoid globalmente aquí */
                            }
                            
                            /* Esta clase permite EXPLÍCITAMENTE que el contenido se rompa en varias páginas.
                               Aplícala al DIV dentro del TD cuyo contenido puede superar la altura de página. */
                            .allow-break {
                              display: block;               /* imprescindible para que Dompdf rompa el contenido */
                              page-break-inside: auto !important;
                              break-inside: auto !important;
                              -webkit-column-break-inside: auto !important;
                              overflow-wrap: break-word;
                              white-space: normal;
                            }
                            
                            .small-text { font-size: 8px }
                            
                            /* Si deseas evitar que ciertos elementos concretos se partan (pocos),
                               puedes añadir .no-break a su wrapper con page-break-inside: avoid */
                            .no-break {
                              page-break-inside: avoid !important;
                              break-inside: avoid !important;
                            }
                            
                            /* Evita elementos con position:absolute o floats dentro de celdas */
                            pre, code { white-space: pre-wrap; word-wrap: break-word; }
                        </style>
        </head>
        <body>
            <header>' . $header . '</header>
            <main>' . $html . '</main>
            <footer>' . $footer . '</footer>
        </body>
        </html>
    ';

        $dompdf->loadHtml($fullHtml);
        $dompdf->render();

        // Determinar nombre de archivo
        $fileName = 'anexo' . $documentType . '.pdf';

        if(strtolower($outputMode) === 'save'){
            if(empty($savePath)){
                // Si pediste 'save' pero no diste ruta, lanzamos error o hacemos fallback a stream
                // Aquí enviamos un 500 simple con mensaje (ajusta según tu manejo de errores)
                header("HTTP/1.1 500 Internal Server Error");
                echo "Save path no especificado.";
                return;
            }

            // Si $savePath es un directorio, añade el nombre del archivo; si es un archivo, úsalo tal cual
            $isDir = (substr($savePath, -1) === DIRECTORY_SEPARATOR) || is_dir($savePath);
            if($isDir){
                // aseguramos trailing slash
                $dir = rtrim($savePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
                $saveFullPath = $dir . $fileName;
            } else {
                // Se pasó una ruta/filename completa
                $saveFullPath = $savePath;
                $dir = dirname($saveFullPath);
            }

            // Crear directorio si no existe
            if(!is_dir($dir)){
                if(!mkdir($dir, 0755, true)){
                    header("HTTP/1.1 500 Internal Server Error");
                    echo "No se pudo crear el directorio: {$dir}";
                    return;
                }
            }

            // Escribir archivo
            $pdfOutput = $dompdf->output();
            $bytes = file_put_contents($saveFullPath, $pdfOutput);

            if($bytes === false){
                header("HTTP/1.1 500 Internal Server Error");
                echo "Error al guardar el PDF en: {$saveFullPath}";
                return;
            }

            // Opcional: devolver la ruta o redirigir; aquí devolvemos JSON con status
            header('Content-Type: application/json; charset=utf-8');
            return;
        }

        // Por defecto stream al navegador (inline). Si quieres forzar descarga, cambia Attachment => true
        $dompdf->stream($fileName, array("Attachment" => false));
        return;
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

    public function delete(){
        if(is_logged()){
            if($this->hasPermission()){
                $data = $this->input->post();
                if($data){
                    $deleted = $this->PIAR_Model->delete($data["id_piar"]);
                    if($deleted){
                        json_response(null, true, "P.I.A.R. eliminado exitosamente");
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
        $transformedData = $this->transformColumnsPIAR($data);

        if($piarItem){
            $created = $this->PIAR_Item_Model->update($transformedData["id_piar_item"], $transformedData);
            $message = "Registro modificado exitosamente";
        }
        else{
            unset($transformedData["id_piar_item"]);
            $created = $this->PIAR_Item_Model->create($transformedData);
            $message = "Registro creado exitosamente";
        }

        return $created ?
            array("status" => true, "id" => $created, "message" => $message) :
            array("status" => false, "type" => "danger", "message" => $message);
    }

    private function transformColumnsPIAR($data) {
        print_r($data);
        $data["objetivos"] = serialize(
            array(
                "dbas" => $data["objetivos"] ?? [],
                "observaciones" => $data["observaciones_dbas"]
            )
        );

        $data["barreras"] = serialize(
            array(
                "barreras" => $data["barreras"] ?? [],
                "observaciones" => $data["observaciones_barreras"]
            )
        );

        $data["ajustes_razonables"] = serialize(
            array(
                "ajustes_razonables" => $data["ajustes_razonables"] ?? [],
                "observaciones" => $data["observaciones_ajustes_razonables"]
            )
        );

        unset($data["observaciones_dbas"]);
        unset($data["observaciones_barreras"]);
        unset($data["observaciones_ajustes_razonables"]);

        return $data;
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

    public function saveLocalPDF($year = null, $grado = 0) {
        $year = $year ?? date("Y");

        // Ajustes para procesamiento largo
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $PIARs = $this->PIAR_Model->getByYear($year, $grado);

        $baseRel = 'principal/piar/PIAR ' . $year . '/';
        $baseFull = rtrim(FCPATH, '/\\') . '/' . trim($baseRel, '/\\') . '/';

        $piarList = array_values($PIARs);
        $chunkSize = 10;                // controla memoria/IO
        $docTypes  = [1,2,3];           // tipos a generar por PIAR
        $processed = 0;
        $errors    = [];

        foreach (array_chunk($piarList, $chunkSize) as $chunk) {
            foreach ($chunk as $item) {
                $processed++;

                // Extraer id_piar y id_estudiante de forma flexible
                if (is_array($item)) {
                    $piarId = $item['id_piar'] ?? $item['id'] ?? null;
                    $idEst  = $item['grado'] ?? $item['id_estudiante'] ?? $item['student_id'] ?? null;
                } else {
                    $piarId = $item->id_piar ?? $item->id ?? null;
                    $idEst  = $item->id_estudiante ?? $item->documento ?? $item->student_id ?? null;
                }

                if (empty($piarId)) {
                    $errors[] = "Índice {$processed}: faltó id_piar";
                    continue;
                }

                $folder = $idEst ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $idEst) : "piar_{$piarId}";
                $saveRel = rtrim($baseRel, '/\\') . '/' . $folder . '/'.$item["nombre"].'/';

                // Llamadas a viewDOM en modo 'save' manteniendo la firma original
                foreach ($docTypes as $type) {
                    try {
                        // viewDOM manejará la creación/validación de paths si lo necesita,
                        // pero aquí nos aseguramos que la carpeta exista por si viewDOM no la crea.
                        $saveFull = rtrim(FCPATH, '/\\') . '/' . trim($saveRel, '/\\') . '/';
                        if (!is_dir($saveFull) && !mkdir($saveFull, 0755, true)) {
                            throw new Exception("No se pudo crear carpeta {$saveFull}");
                        }

                        // Mantener exactamente la llamada a viewDOM como pediste
                        $this->viewDOM($piarId, $type, 'save', $saveRel);

                        // Pequeña pausa para aliviar I/O
                        usleep(40000); // 40ms
                    } catch (Exception $e) {
                        $msg = "Error PIAR {$piarId} type {$type}: " . $e->getMessage();
                        $errors[] = $msg;
                        // continuar con siguiente docType o PIAR
                    }
                }

                // Liberar ciclos de GC entre PIARs
                if (function_exists('gc_collect_cycles')) gc_collect_cycles();
                usleep(80000); // 80ms
            }
            // Pausa entre chunks
            usleep(200000); // 200ms
        }

        // Resultado
        json_response([
            'status' => empty($errors) ? 'ok' : 'partial',
            'processed' => $processed,
            'errors_count' => count($errors),
            'errors' => $errors,
            'base_path' => $baseFull
        ], true);
    }

}