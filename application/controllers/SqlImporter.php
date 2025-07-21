<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SqlImporter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('sql_importer/upload_sql');
    }

    public function upload() {
        // Verifica si hay archivo subido
        if (!isset($_FILES['sql_file']['name']) || $_FILES['sql_file']['name'] == '') {
            $this->session->set_flashdata('message', 'No se seleccionó ningún archivo.');
            redirect('SqlImporter');
        }

        // Configuración de carga
        $config['upload_path'] = './uploads/';
        $config['max_size'] = 5000; // en KB

        $this->load->library('upload', $config);

        // Verifica carpeta
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        if (!$this->upload->do_upload('sql_file')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect('SqlImporter');
        }

        // Leer y ejecutar el SQL
        $upload_data = $this->upload->data();
        $file_path = $upload_data['full_path'];

        $sql = file_get_contents($file_path);

        if (!$sql) {
            $this->session->set_flashdata('message', 'No se pudo leer el archivo.');
            redirect('SqlImporter');
        }

        // Ejecutar múltiples sentencias
        $queries = explode(';', $sql);
        $this->db->trans_start(); // inicia transacción
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $this->db->query($query);
            }
        }
        $this->db->trans_complete(); // termina transacción

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', 'Error al ejecutar el script SQL.');
        } else {
            $this->session->set_flashdata('message', 'Script SQL ejecutado con éxito.');
        }

        // Eliminar archivo subido
        unlink($file_path);

        redirect('SqlImporter');
    }
}
