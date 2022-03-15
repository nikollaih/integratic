<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardar extends CI_Controller {

    function __construct() 
    {
            parent::__construct(); 
             $this->load->helper('form');
             $this->load->helper('html');
             $this->load->helper('url');
             $this->load->helper('date');             
             $this->load->model('guardar_model'); 
             $this->load->model('Consultas_Model'); 
             $this->load->library('form_validation');
    }        
    function in_persona(){
        if ($this->input->is_ajax_request()) {
            $tabla  = "persona";
            $datos = array(
                "documento" => $this->input->post("doc"),
                "nombre"    => $this->input->post("nombre"),
                "genero"    => $this->input->post("genero"),
                "direccion" => $this->input->post("dire"),
                "barrio"    => $this->input->post("barrio"),
                "municipio" => $this->input->post("municipio"),
                "fingreso"  => date('Y-m-d'),
                "telefono"  => $this->input->post("telefono"),
                "mail"      => $this->input->post("mail")
                );                      
                $conn=$this->guardar_model->insertar($tabla,$datos); 
             echo json_encode($conn);   
        }else{echo json_encode("No Entra!");}
    }    
    function in_concurso(){
        if ($this->input->is_ajax_request()) {
            $tabla  = "concurso";
            $datos = array(
                "id"          => $this->input->post("codigo"),
                "nombre"      => $this->input->post("nombre"),
                "descripcion" => $this->input->post("premio"),
                "cantidad"    => $this->input->post("cantidad"),
                "estado"      => 'ac'
                );                      
                $conn=$this->guardar_model->insertar($tabla,$datos); 
             echo json_encode("conn");   
        }else{echo json_encode("No Entra!");}
    }    
    function in_inscrito(){
        if ($this->input->is_ajax_request()) {
            $tabla  = "inscritos";
            $datos = array(
                "documento"   => $this->input->post("id"),
                "concurso"    => $this->input->post("cod"),
                "fecha"       => date('d-m-Y'),
                "usuario"     =>'adm',
                "estado"      => 'ac'
                );                      
                $conn=$this->guardar_model->insertar($tabla,$datos); 
             echo json_encode($datos);   
        }else{echo json_encode("No Entra!");}
    }     
}
