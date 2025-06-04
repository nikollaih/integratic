<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjustesRazonables extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AjustesRazonables_Model');

        // Validación común para todos los métodos del controlador
        if (!is_logged() || strtolower(logged_user()["rol"]) !== "super") {
            redirect(base_url());
        }
    }

    public function index() {
        $categoria = $this->input->get('categoria');
        $data['categorias'] = $this->AjustesRazonables_Model->get_categorias();
        $data['ajustes'] = $this->AjustesRazonables_Model->get_all($categoria);
        $data['categoria_actual'] = $categoria;
        $this->load->view('ajustes_razonables/index', $data);
    }

    public function crear() {
        $data['categorias'] = $this->AjustesRazonables_Model->get_categorias();
        $this->load->view('ajustes_razonables/form', $data);
    }

    public function guardar() {
        $data = [
            'descripcion' => $this->input->post('descripcion'),
            'id_categoria' => $this->input->post('id_categoria')
        ];
        $this->AjustesRazonables_Model->insert($data);
        redirect('AjustesRazonables');
    }

    public function editar($id) {
        $data['ajuste'] = $this->AjustesRazonables_Model->get($id);
        $data['categorias'] = $this->AjustesRazonables_Model->get_categorias();
        $this->load->view('ajustes_razonables/form', $data);
    }

    public function actualizar($id) {
        $data = [
            'descripcion' => $this->input->post('descripcion'),
            'id_categoria' => $this->input->post('id_categoria')
        ];
        $this->AjustesRazonables_Model->update($id, $data);
        redirect('AjustesRazonables');
    }

    public function eliminar($id) {
        $this->AjustesRazonables_Model->delete($id);
        redirect('AjustesRazonables');
    }
}
