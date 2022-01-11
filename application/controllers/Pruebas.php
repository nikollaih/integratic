<?php
  
   class Pruebas extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model(["Pruebas_Model"]);
    }
    
    public function index(){
        $params["pruebas"] = $this->Pruebas_Model->get_all();
        $this->load->view("pruebas/home", $params);
    }
} 
