<?php
   class Imports extends CI_Controller { 

    public function __construct() {  
       	parent::__construct();  
       	$this->load->helper(array('form', 'url','html')); 
       	$this->load->model('Anuncio_Model');
    }

    public function import_students(){
		
	}
} 
