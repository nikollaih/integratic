<?php
  
   class Container extends CI_Controller {
	
    public function __construct() { 
       parent::__construct(); 
       $this->load->helper(array('form', 'url')); 
       $this->load->model('General_Model');
    }
    
    public function biblioteca()
    {     
        $this->load->view('biblioteca');
    }

} 
