<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Borrar extends CI_Controller {

    function __construct()
    {
            parent::__construct();
             $this->load->model('borrar_model');
    }
        
    function bo_inscrito($id,$con){
        if ($this->input->is_ajax_request()) {
            $this->borrar_model->bo_inscrito($id,$con);
        }
    }    
}
