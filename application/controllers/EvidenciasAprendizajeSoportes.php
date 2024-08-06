<?php

class EvidenciasAprendizajeSoportes extends CI_Controller
{
    private $uploadPath = "uploads/evidencias_aprendizaje/soportes";
    private $currentTime;
    public function __construct()
    {
        parent::__construct();
        $this->currentTime = time();
        $this->load->model(["EvidenciasAprendizajeSoportes_Model", "EvidenciasAprendizaje_Model"]);
    }

    // Agrega nuevos soportes a la evidencia de aprendizaje, (imagenes, pdf, docs, etc)
    public function create() {
        // Verifica si hay un usuario logueado
        if(is_logged()) {
            // Verifica si el usuario logueado es un docente
            if(strtolower(logged_user()["rol"]) == "docente") {
                // Obtiene los datos por POST
                $data = $this->input->post();
                $planAula = $this->EvidenciasAprendizaje_Model->find($data["id_evidencia_aprendizaje"]);
                // Crea el directorio de carga de los archivos en caso de que no exista
                createDirectory($this->uploadPath);

                if(count($_FILES["files"]["name"]) > 0) {
                    $uploadedFiles = $this->uploadFiles($_FILES);
                    for ($i = 0; $i < count($_FILES["files"]["name"]); $i++) {
                        echo $_FILES['files']['name'][$i];
                        if(isset($_FILES['files']['name'][$i])) {
                            $file_name = $_FILES['files']['name'][$i];
                            $newData["id_evidencia_aprendizaje"] = $data["id_evidencia_aprendizaje"];
                            $newData["comentarios"] = $data["evidencia_aprendizaje_comentarios"];
                            $newData["titulo_archivo"] = $file_name;
                            $newData["nombre_archivo"] = $uploadedFiles[$i];

                            $this->EvidenciasAprendizajeSoportes_Model->create($newData);
                        }
                    }
                }

                $this->session->set_flashdata('message', 'Soportes cargados exitosamente!');
                header("Location: " . base_url()."PlanAula/create/".$planAula["id_plan_area"]);
            }
            else {
                header("Location: " . base_url());
            }
        }
        else {
            header("Location: " . base_url());
        }
    }

    // Carga un array de archivos al servidor
    private function uploadFiles($FILES): array
    {
        $uploadedFiles = [];
        // Verifica que si exista por lo menos un archivo
        if(count($FILES["files"]["name"]) > 0) {
            // Recorre el array de archivos
            for ($i = 0; $i <= count($FILES["files"]["name"]); $i++) {
                if(isset($FILES['files']['name'][$i])) {
                    // Genera un nuevo nombre con el cual será guardado el archivo
                    $file_name = md5($this->currentTime . "_" . $FILES['files']['name'][$i]).".".pathinfo($FILES['files']['name'][$i], PATHINFO_EXTENSION);;
                    $file_tmp =$FILES['files']['tmp_name'][$i];
                    // Sube el archivo
                    move_uploaded_file($file_tmp, $this->uploadPath . "/" . $file_name);
                    $uploadedFiles[$i] = $file_name;
                }
            }
        }

        // Retorna un array con los nombres de los archivos subidos
        return $uploadedFiles;
    }

    // Obtiene la lista de soportes para la evidencia de aprendizaje
    // $idEvidenciaAprendizaje: Int -> ID de la evidencia de aprendizaje para consultar sus soportes
    public function getAll($idEvidenciaAprendizaje) {
        // Verifica que haya un usuario logueado y que no sea un estudiante
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                // Obtiene la lista de soportes
                $soportes = $this->EvidenciasAprendizajeSoportes_Model->getAll($idEvidenciaAprendizaje);

                // Retorna la lista de soportes o un error 404 en caso de no encontrar
                if($soportes) json_response(array("soportes" => $soportes, "rol" => strtolower(logged_user()["rol"])), true, "Soportes de evidencia de aprendizaje");
                else json_response(array("error" => "404"), false, "No se han encontrado soportes de la evidencia de aprendizaje");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }

    // Elimina un registro de soporte de la evidencia de aprendizaje
    // $idSoporteEvidenciaAprendizaje: Int -> ID del soporte de la evidencia de aprendizaje
    function remove($idSoporteEvidenciaAprendizaje){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) != "estudiante"){
                $soporte = $this->EvidenciasAprendizajeSoportes_Model->find($idSoporteEvidenciaAprendizaje);

                if($soporte){
                    if($this->EvidenciasAprendizajeSoportes_Model->delete($idSoporteEvidenciaAprendizaje)){
                        json_response(array("error" => false), true, "Registro eliminado correctamente");
                    }
                    else json_response(array("error" => "general"), false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
                }
                else json_response(array("error" => "404"), false, "No se ha encontrado la evidencia de aprendizaje");
            }
            else json_response(array("error" => "permissions"), false, "No tiene permisos para realizar esta acción");
        }
        else json_response(array("error" => "auth"), false, "Debe iniciar sesión para realizar esta acción");
    }
}