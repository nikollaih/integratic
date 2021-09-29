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
		$contador +=  obtener_contador_anuncios();
		json_response($contador, true, "Notificaciones");
	}

   public function obtener_lista_notificaciones(){
      $notificaciones_dom = "";
      $notificaciones_dom .= anuncios_notificaciones(true);
      json_response($notificaciones_dom, true, "Notificaciones");
   }
     
} 
