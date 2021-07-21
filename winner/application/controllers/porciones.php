<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Porciones extends CI_Controller {

    	function __construct()
	{
		parent::__construct();
                 $this->load->helper('form');
                 $this->load->helper('html');
                 $this->load->helper('url');
                 $this->load->helper('date');
                 $this->load->model('cargar_model');
                 $this->load->library('form_validation');                 
	}
	public function index()
	{
            $this->load->view('principal');
	}
        
        function tplancha(){
            $datos['color'] = $this->cargar_model->llena_select('cfg_colores');
            $datos['tam']   = $this->cargar_model->llena_select('cfg_dimension');
            $this->load->view('tplancha',$datos);
        }
        function tlitografia(){
            $datos['tinta'] = $this->cargar_model->llena_select('cfg_tintas');
            $datos['papel'] = $this->cargar_model->llena_select('cfg_tpapel');
            $datos['corte'] = $this->cargar_model->llena_select('cfg_cortes');
            $this->load->view('tlitografia',$datos);
        } 
        function tacabado(){
            $datos['corte'] = $this->cargar_model->llena_select('cfg_cortes');
            $datos['plasti'] = $this->cargar_model->llena_select('cfg_plastificado');
            $datos['brillo'] = $this->cargar_model->llena_select('cfg_brillo');
            $datos['troque'] = $this->cargar_model->llena_select('cfg_troquelado');
            $this->load->view('tacabado',$datos);
        }       
        function tencuaderna(){
            $this->load->view('tencuaderna');
        }     
        
        function porcion($a){
            $this->load->view($a);
        }  
}
