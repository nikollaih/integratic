<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $Barreras_Model
 */
class Barreras extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Barreras_Model');

        // Validación común para todos los métodos del controlador
        if (!is_logged() || strtolower(logged_user()["rol"]) === "estudiante") {
            redirect(base_url());
        }
    }

    public function index() {
        $categoria = $this->input->get('categoria');
        $data['categorias'] = $this->Barreras_Model->get_categorias();
        $data['barreras'] = $this->Barreras_Model->get_all($categoria);
        $data['categoria_actual'] = $categoria;
        $this->load->view('barreras/index', $data);
    }

    public function crear() {
        $data['categorias'] = $this->Barreras_Model->get_categorias();
        $this->load->view('barreras/form', $data);
    }

    public function guardar() {
        $data = [
            'descripcion' => $this->input->post('descripcion'),
            'id_categoria' => $this->input->post('id_categoria')
        ];
        $this->Barreras_Model->insert($data);
        redirect('Barreras');
    }

    public function editar($id) {
        $data['barrera'] = $this->Barreras_Model->get($id);
        $data['categorias'] = $this->Barreras_Model->get_categorias();
        $this->load->view('barreras/form', $data);
    }

    public function actualizar($id) {
        $data = [
            'descripcion' => $this->input->post('descripcion'),
            'id_categoria' => $this->input->post('id_categoria')
        ];
        $this->Barreras_Model->update($id, $data);
        redirect('Barreras');
    }

    public function eliminar($id) {
        $this->Barreras_Model->delete($id);
        redirect('Barreras');
    }

    public function obtenerPorCategoria($idCategoria) {
        $barreras = $this->Barreras_Model->get_all($idCategoria);
        echo json_encode($barreras);
    }
}
