<?php

/**
 * @property $Configuracion_Model
 * @property $input
 */
class Configuracion extends CI_Controller {
    const UPLOAD_PATH = 'img/';

    public function __construct() {
        parent::__construct();
        $this->load->model(["Configuracion_Model"]);
    }

    public function index() {
        if (!is_logged() || strtolower(logged_user()["rol"]) !== "super") {
            return redirect(base_url());
        }

        $params["data"] = $this->Configuracion_Model->getConfiguracion();

        if ($this->input->post()) {
            $params["message"] = $this->modificarConfiguracion($this->input->post("data"), $_FILES);
            $params["data"] = $this->Configuracion_Model->getConfiguracion(); // Recargar config actualizada
        }

        $this->load->view("configuracion/index", $params);
    }

    private function modificarConfiguracion($data, $files) {
        $id_configuracion = $data["id_configuracion"];

        if ($id_configuracion !== "null") {
            $actualizado = $this->Configuracion_Model->updateConfiguracion($data);
        } else {
            $id_configuracion = $this->Configuracion_Model->addConfiguracion($data);
            $actualizado = $id_configuracion ? true : false;
        }

        if ($actualizado) {
            $this->handleUploads($files, $id_configuracion);
            return [
                "type" => "success",
                "message" => $data["id_configuracion"] !== "null"
                    ? "Información modificada satisfactoriamente."
                    : "Información creada satisfactoriamente.",
                "success" => true
            ];
        }

        return [
            "type" => "danger",
            "message" => "Ha ocurrido un error al intentar " .
                ($data["id_configuracion"] !== "null" ? "modificar" : "guardar") .
                " la información, por favor intente de nuevo más tarde.",
            "success" => false
        ];
    }

    private function handleUploads($files, $id_configuracion) {
        $map = [
            'logo' => ['field' => 'logo_institucion', 'rename' => 'logo'],
            'banner' => ['field' => 'banner_principal'],
            'modal' => ['field' => 'modal_principal'],
            'logo_min_educacion' => ['field' => 'logo_min_educacion', 'rename' => 'logo_min_educacion'],
            'logo_gobierno_colombia' => ['field' => 'logo_gobierno_colombia', 'rename' => 'logo_gobierno_colombia']
        ];

        foreach ($map as $inputName => $config) {
            $this->handleFileUpload(
                $files,
                $inputName,
                $id_configuracion,
                $config['field'],
                $config['rename'] ?? null
            );
        }
    }

    private function handleFileUpload($files, $inputName, $id_configuracion, $dbField, $rename = null) {
        if (
            isset($files[$inputName]['name']) &&
            $files[$inputName]['size'] > 0 &&
            isset($files[$inputName]['tmp_name'])
        ) {
            $fileTmp = $files[$inputName]['tmp_name'];
            $originalName = $files[$inputName]['name'];
            $fileName = $rename
                ? $rename . '.' . get_file_format($originalName)
                : $originalName;

            if (move_uploaded_file($fileTmp, self::UPLOAD_PATH . $fileName)) {
                $this->Configuracion_Model->updateConfiguracion([
                    "id_configuracion" => $id_configuracion,
                    $dbField => $fileName
                ]);
            }
        }
    }
}
