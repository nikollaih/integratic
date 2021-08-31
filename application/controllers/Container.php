<?php
  
   class Container extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model('general_model');
    }
    
    public function biblioteca()
    {     
        $this->load->view('biblioteca');
    }

} 
