<?php
  
   class Consultas extends CI_Controller {
	
    public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url')); 
         $this->load->helper('html');
         $this->load->model('consultas_model');
      }
 
    public function co_areas(){  
        if($datos  = $this->consultas_model->con_areas()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    } 

    public function co_menuad(){  
        if($datos  = $this->consultas_model->con_menuad()){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }    
    public function con_menuad($id){  
        if($datos  = $this->consultas_model->consu_menuad($id)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    } 
    public function ingresos(){  
        $fecha    = $_POST['fecha'];      
        if($datos  = $this->consultas_model->ingresos($fecha)){                   
            echo json_encode($datos);
        } 
        else{echo ("Error en consulta");}
    }              
} 
