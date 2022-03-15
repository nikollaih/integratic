<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
    function __construct()
    {
        parent::__construct();
         $this->load->helper('form');
         $this->load->helper('html');
         $this->load->helper('url');
         $this->load->helper('date');
         $this->load->model('cargar_model');
         $this->load->model('Consultas_Model');
         $this->load->library('form_validation');
    }
    public function index()
    {
        //$datos['barrio']    = $this->cargar_model->llena_select('barrios');
        $datos['muni']      = $this->cargar_model->llena_select('municipios');
        $datos['usua']      = $this->cargar_model->llena_select('usuario');
        //$this->load->view('login');
        $this->load->view('wn_head');
        $this->load->view('wn_header');
        $this->load->view('wn_content',$datos);
        //$this->load->view('wn_footer'); 
        $this->load->view('wn_script');      
    }        
    public function login()
    {  
        $usr    = $this->input->post("usr");
        $pass   = $this->input->post("pass");
        if($datos['login']  = $this->cargar_model->login($usr,$pass)){                   
            $this->load->view('dg_head');
            $this->load->view('dg_header',$datos);
            $this->load->view('dg_aside');
            $this->load->view('dg_content');
            $this->load->view('dg_footer'); 
            $this->load->view('dg_script');
          }  
    }
    public function personas()
    {
        $datos['muni']          = $this->cargar_model->llena_select('municipios');
        $datos['concurso']      = $this->cargar_model->llena_select('concurso');
        $datos['concursoac']    = $this->Consultas_Model->concursoac();
        $this->load->view('wn_personas',$datos);
      
    } 
    public function concursos()
    {
        $datos['concurso']      = $this->cargar_model->llena_select('concurso');
        $this->load->view('wn_concursos',$datos);      
    }   
    public function ganadores()
    {
        $datos['concurso']      = $this->cargar_model->llena_select('concurso');
        $this->load->view('wn_ganadores',$datos);      
    }    
}
