<?php
  
   class Consultas extends CI_Controller {
	
    public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url')); 
         $this->load->helper('html');
         $this->load->model('Consultas_Model');
      }
 
    public function co_areas(){  
        if($datos  = $this->Consultas_Model->con_areas()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    } 

    public function co_menuad(){  
        if($datos  = $this->Consultas_Model->con_menuad()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }    
    public function con_menuad($id){  
        if($datos  = $this->Consultas_Model->consu_menuad($id)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    } 
    public function ingresos(){  
        $fecha    = $_POST['fecha'];      
        if($datos  = $this->Consultas_Model->ingresos($fecha)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }              
} 
