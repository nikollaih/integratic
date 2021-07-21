<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visor extends CI_Controller {

    function __construct()
    {
            parent::__construct();
             $this->load->model('visor_model');
    }
        
    function con_ordenes(){
        $datos = $this->visor_model->con_ordenes();
        echo json_encode($datos);       
    }  
    function con_nombre($ord){
     $datos = $this->visor_model->con_nombre($ord);
     echo json_encode($datos);       
    }     
    function con_rec($ord){
     $datos = $this->visor_model->con_rec($ord);
     echo json_encode($datos);       
    }    
    function con_plan($ord){
     $datos = $this->visor_model->con_plan($ord);
     echo json_encode($datos);       
    }   
    function con_cor($ord){
     $datos = $this->visor_model->con_corte($ord);
     echo json_encode($datos);       
    }     
    function con_lito($ord){
     $datos = $this->visor_model->con_lito($ord);
     echo json_encode($datos);       
    }   
    function con_ani($ord){
     $datos = $this->visor_model->con_ani($ord);
     echo json_encode($datos);       
    }   
    function con_bri($ord){
     $datos = $this->visor_model->con_bri($ord);
     echo json_encode($datos);       
    }     
    function con_ensa($ord){
     $datos = $this->visor_model->con_ensa($ord);
     echo json_encode($datos);       
    }     
    function con_esta($ord){
     $datos = $this->visor_model->con_esta($ord);
     echo json_encode($datos);       
    }     
    function con_gra($ord){
     $datos = $this->visor_model->con_gra($ord);
     echo json_encode($datos);       
    }     
    function con_inter($ord){
     $datos = $this->visor_model->con_inter($ord);
     echo json_encode($datos);       
    }     
    function con_pega($ord){
     $datos = $this->visor_model->con_pega($ord);
     echo json_encode($datos);       
    }     
    function con_ple($ord){
     $datos = $this->visor_model->con_ple($ord);
     echo json_encode($datos);       
    }         
    function con_plas($ord){
     $datos = $this->visor_model->con_plas($ord);
     echo json_encode($datos);       
    }    
    function con_rep($ord){
     $datos = $this->visor_model->con_rep($ord);
     echo json_encode($datos);       
    }     
    function con_tro($ord){
     $datos = $this->visor_model->con_tro($ord);
     echo json_encode($datos);       
    }     
    function con_etro($ord){
     $datos = $this->visor_model->con_etro($ord);
     echo json_encode($datos);       
    }   
    function con_esp($ord){
     $datos = $this->visor_model->con_esp($ord);
     echo json_encode($datos);       
    }     
    function con_laser($ord){
     $datos = $this->visor_model->con_laser($ord);
     echo json_encode($datos);       
    }
    function inicia_pro($ord){
     $datos = $this->visor_model->inicia_pro($ord);
     echo json_encode($datos);       
    }  
    function consulta_orden($ord){
     $datos = $this->visor_model->consulta_orden($ord);
     echo json_encode($datos);       
    }
    function consulta_orden_pla($ord){
     $datos = $this->visor_model->consulta_orden_pla($ord);
     echo json_encode($datos);       
    }    
    function consulta_orden_cor($ord){
     $datos = $this->visor_model->consulta_orden_cor($ord);
     echo json_encode($datos);       
    }  
    function asigna_op(){
        if ($this->input->is_ajax_request()) {
            $orden = $this->input->post("orden");  
            $num   = $this->input->post("sec");
            $tipo  = $this->input->post("tipo");  
            $op    =  $this->input->post("operario");
            $datos = $this->visor_model->asigna_operario($tipo,$orden,$num,$op);  
            echo json_encode($datos);   
        }    
    } 
    public function priorizar()
    {      
        if ($this->input->is_ajax_request()) {
                $orden = $this->input->post("orden");
                $pri   = $this->input->post("prioridad");                                
                $datos = $this->visor_model->priorizar_orden($orden,$pri);
                echo json_encode($datos);			
        }
    }    
}
