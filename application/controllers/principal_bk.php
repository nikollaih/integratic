<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

    function __construct()
    {
        parent::__construct();
         $this->load->helper('form');
         $this->load->helper('html');
         $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('in_head');
        $this->load->view('in_header');
        $this->load->view('in_aside');
        $this->load->view('in_content');
        $this->load->view('in_footer'); 
        $this->load->view('in_script');       
    }
    
    function listar($tipo,$carpeta,$subcarpeta){
        switch($tipo){
            case 'areas': $carpeta="principal/areas/".$carpeta."/".$subcarpeta;
                break;
            case 'areabase': $carpeta="principal/areas/".$carpeta;
                break;            
            case 'labs':  $carpeta="principal/labs/".$subcarpeta;
                break;   
            default:  $carpeta="principal/".$carpeta;
                break;             
        }       
        $html="<div class='col-md-1'></div><div class='row'>";
        $html=$html."<table><tbody><tr>";
        $i=0;
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                        $ext = explode(".", $archivo);
                        //$html=$html.'<li><a target="_blank" href='.$carpeta.'/'.$archivo.'>'.$archivo.'</a></li>';
                        $html=$html."<td  style='width:40%; height:42px'><a target='_blank' href='$carpeta/$archivo'>";                                               
                            switch($ext[1]){
                                case "pdf":
                                    $html=$html."<img src='".base_url()."img/iconos/pdf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break; 
                                case "jpg":
                                    $html=$html."<img src='".base_url()."img/iconos/jpg.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;
                                case "png":
                                    $html=$html."<img src='".base_url()."img/iconos/png.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;     
                                case "docx":
                                    $html=$html."<img src='".base_url()."img/iconos/docx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;   
                                case "xlsx":
                                    $html=$html."<img src='".base_url()."img/iconos/xlsx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;    
                                case "pptx":
                                    $html=$html."<img src='".base_url()."img/iconos/pptx.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;   
                                case "jar":
                                    $html=$html."<img src='".base_url()."img/iconos/jar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;  
                                case "html":
                                    $html=$html."<img src='".base_url()."img/iconos/html.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;  
                                case "swf":
                                    $html=$html."<img src='".base_url()."img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;   
                                case "exe":
                                    $html=$html."<img src='".base_url()."img/iconos/exe.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;        
                                case "rar":
                                    $html=$html."<img src='".base_url()."img/iconos/rar.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;       
                                case "swf":
                                    $html=$html."<img src='".base_url()."img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;     
                                case "mp4":
                                    $html=$html."<img src='".base_url()."img/iconos/mp4.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;                             
                                default:
                                    $html=$html."<img src='".base_url()."img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$ext[0]";
                                break;    
                            }                       
                        $html=$html."</a></td>";
                        $i++;        
                        if($i%2==0){
                            $html=$html."</tr><tr>";
                            } 
                    }        
                }
                closedir($dir);
            }
        } 
        $html=$html."</tr></tbody></table>";
        $html=$html."</div>";
        echo $html;
} 

function prelogin(){
    $html="<div class='wrapper-page'>";
    $html=$html+"<div class='panel panel-color panel-primary panel-pages'>";
    $html=$html+"<div class='panel-heading bg-img'>";
    $html=$html+"<div class='bg-overlay'></div>";
    $html=$html+"<h3 class='text-center m-t-10 text-white'> Sign In to <strong>Moltran</strong> </h3></div>";
    $html=$html+"<div class='panel-body'>";
    $html=$html+"<form class='form-horizontal m-t-20' action='index.html'>";                    
    $html=$html+"<div class='form-group '>";
    $html=$html+"<div class='col-xs-12'>";
    $html=$html+"<input class='form-control input-lg ' required placeholder='Username' type='text'>";
    $html=$html+"</div> </div>";
    $html=$html+"<div class='form-group'>";
    $html=$html+"<div class='col-xs-12'>";
    $html=$html+"<input class='form-control input-lg' required placeholder='Password' type='password'>";
    $html=$html+"</div></div>";
    $html=$html+"<div class='form-group '>";
    $html=$html+"<div class='col-xs-12'>";
    $html=$html+"<div class='checkbox checkbox-success'>";
    $html=$html+"<input id='checkbox-signup' type='checkbox'>";
    $html=$html+"<label for='checkbox-signup'>Remember me</label></div></div></div>";                 
    $html=$html+"<div class='form-group text-center m-t-40'>";
    $html=$html+"<div class='col-xs-12'>";
    $html=$html+"<button class='btn btn-success btn-lg w-lg waves-effect waves-light' type='submit'>Log In</button>";
    $html=$html+"</div></div>";
    $html=$html+"<div class='form-group m-t-30'>";
    $html=$html+"<div class='col-sm-7'>";
    $html=$html+"<a href='recoverpw.html'><i class='fa fa-lock m-r-5'></i> Forgot your password?</a></div>";
    $html=$html+"<div class='col-sm-5 text-right'>";
    $html=$html+"<a href='register.html'>Create an account</a></div></div></form></div></div></div>";  
    echo $html;
}
//echo listar_archivos('c:\wamp\www\miweb');
}