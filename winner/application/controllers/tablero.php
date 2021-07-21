<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tablero extends CI_Controller {

    function __construct()
    {
            parent::__construct();
             $this->load->model('tablero_model');
    }
        
    function con_ordenes(){
        $datos = $this->tablero_model->con_ordenes();
        echo json_encode($datos);       
    }   
    function num_ordenes(){
        $datos = $this->tablero_model->num_ordenes();
        echo json_encode($datos);       
    }    
    function con_avance(){
        $orden = $this->input->post("orden");
        $sec   = $this->input->post("sec");
        $datos = $this->tablero_model->con_avance($orden,$sec);
        echo json_encode($datos);       
    }     
}
