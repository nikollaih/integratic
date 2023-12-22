<?php
   class Notificaciones extends CI_Controller { 

    public function __construct() {  
       parent::__construct();  
       $this->load->helper(array('form', 'url','html')); 
       $this->load->model('Anuncio_Model');
    }

    // Obtiene el número de notificaciones
	public function obtener_contador_notificaciones(){
		$contador = 0;

      if(strtolower(logged_user()["rol"]) == "estudiante"){
         $contador +=  obtener_contador_anuncios();
      }

      if(strtolower(logged_user()["rol"]) == "docente"){
         $contador += obtener_contador_notificaciones();
      }
      
		json_response($contador, true, "Notificaciones");
	}

   public function obtener_lista_notificaciones(){
      $notificaciones_dom = "";
      if(strtolower(logged_user()["rol"]) == "estudiante"){
         $notificaciones_dom .= anuncios_notificaciones(true);
      }

      if(strtolower(logged_user()["rol"]) == "docente"){
         $notificaciones_dom .= docente_notificaciones();
      }

      json_response($notificaciones_dom, true, "Notificaciones");
   } 
} 
