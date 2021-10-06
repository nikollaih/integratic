<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
         $this->load->helper('form');
         $this->load->helper('html');
         $this->load->helper('url');
         $this->load->model('Estudiante_Model');
    }

      
    public function areas(){
      	if(is_logged() && logged_user()['rol'] === 'Estudiante'){
        	if($datos  = $this->Estudiante_Model->getAreas(logged_user()['id'])){                   
            	echo json_encode($datos);
			}
			else
			{
				echo ("Error en consulta");
			}
      	}
    }  
    
    public function materias($area_id){
      	if(is_logged() && logged_user()['rol'] === 'Estudiante'){
        	if($datos  = $this->Estudiante_Model->getMaterias(logged_user()['id'], $area_id)){                   
            	echo json_encode($datos);
       		}else{
          		echo ("Error en consulta");
        	}
      	}
    }
	
	public function mover(){
		mover_estudiantes_usuarios();
	}
}