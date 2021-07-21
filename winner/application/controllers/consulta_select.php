<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta_select extends CI_Controller {
    
    	function __construct()
	{
		parent::__construct();
                $this->load->model('cargar_model');
	}

	public function index()
	{
		$this->load->view('principal');
	}
        
function conselect($dato){
    $result = $this->cargar_model->llena_select($dato);
}
}
