<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends CI_Controller {

    function __construct() 
    {
            parent::__construct();
             $this->load->model('Consultas_Model');
    }
    function co_municipios(){
        if ($this->input->is_ajax_request()) {
                $datos = $this->Consultas_Model->con_municipios();
                echo json_encode($datos);
        }
    }    
    function co_usuarios(){
        if ($this->input->is_ajax_request()) {
                $datos = $this->Consultas_Model->con_usuarios();
                echo json_encode($datos);
        }
    }         
    function co_barrio(){
        if ($this->input->is_ajax_request()) {
                $buscar = $this->input->post("bar");
                $datos = $this->Consultas_Model->con_barrio($buscar);
                echo json_encode($datos);
        }
    }    
     function co_barrios(){
        if ($this->input->is_ajax_request()) {
                $buscar = $this->input->post("mun");
                $datos = $this->Consultas_Model->con_barrios($buscar);
                echo json_encode($datos);
        }
    } 
    function co_persona($id){
        if ($this->input->is_ajax_request()) {
                $datos = $this->Consultas_Model->con_persona($id);
                echo json_encode($datos);
        }
    }
    function co_concurso($id){
        if ($this->input->is_ajax_request()) {
                $datos = $this->Consultas_Model->con_concurso($id);
                echo json_encode($datos);
        }
    }        
    function co_inscrito($id){
        if ($this->input->is_ajax_request()) {
                $datos = $this->Consultas_Model->con_inscrito($id);
                echo json_encode($datos);
        }
    }
    function co_posibles($con){
        if ($this->input->is_ajax_request()) {
                $datos = $this->Consultas_Model->con_posibles($id); 
                echo json_encode($datos);
        }
    }   
    function co_ganador($com,$est,$gen,$mun,$bar,$loc,$eda,$ocom,$oest,$ogen,$omun,$obar,$oloc,$oeda,$pcom,$pest,$pgen,$pmun,$pbar,$ploc,$peda){
        if ($this->input->is_ajax_request()) {
                $datos = $this->Consultas_Model->con_ganador($com,$est,$gen,$mun,$bar,$loc,$eda,$ocom,$oest,$ogen,$omun,$obar,$oloc,$oeda,$pcom,$pest,$pgen,$pmun,$pbar,$ploc,$peda); 
                echo json_encode($datos);
        }
    }               
}
