<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller {

    	function __construct()
	{
		parent::__construct();
                 $this->load->helper('form');
                 $this->load->helper('html');
                 $this->load->helper('url');
                 $this->load->helper('date');
                 $this->load->model('cargar_model');
                 $this->load->model('guardar_model');
                 $this->load->library('form_validation');
	}

	public function guardar()
	{  
            $this->guardar_orden();
            $this->guardar_plancha();
            $this->guardar_corte();
            $this->guardar_litografia();
            $this->guardar_anillado();
            $this->guardar_brillo();
            $this->guardar_ensanduchado();
            $this->guardar_estampado();
            $this->guardar_grapado();
            $this->guardar_intercalado();
            $this->guardar_pegado();
            $this->guardar_plegado();
            $this->guardar_plastificado();
            $this->guardar_repujado();
            $this->guardar_troquelado();
            $this->guardar_etroquel();
            $this->guardar_especial();
            $this->guardar_laser();
        }
                
        public function gestionar_orden_plan(){
            echo("Entra Proc");
            $orden = $this->input->post('orden');
            echo ("....:"+$orden);
            if($this->input->is_ajax_request()){
                echo ("Entra Gestionar");
               $orden    =    $_POST["orden"];
               echo json_encode($this->cargar_model->con_plan($orden));
            }        
        }  
        
        public function gestionar_orden_acaba(){
            if(isset($_POST["orden"])){
               $orden    =    $_POST["orden"];
               $datos    =    $this->cargar_model->con_plan($orden);
               echo json_encode($datos);
            }        
        }
        
        public function guardar_orden()
        {
            date_default_timezone_set ('America/Bogota');
             if(isset ($_POST["num"])){
                $orden      = $_POST["num"];
                $cliente    = $_POST["cliente"];
                $fecha      = date('Y-m-d H:i:s');
                $estado     = 'ac';
                
                $datos_ord = array(
                    "ord_numero" => $orden,
                    "ord_cliente" => $cliente,
                    "ord_fecha_ing" => $fecha,
                    "ord_estado" => "re"
                 );
                
                if($this->guardar_model->ad_cfg("pro_orden",$datos_ord)==true){
                    echo ("Registro Guardado");}
                else { echo ("No se pudo guardar los datos");} 
             }
        }
        
        public function guardar_plancha()
	{      
            //Guardar Plancha   
            if(isset ($_POST["nomarc_pla"])){ 
               $res=$this->cargar_model->operario('PLA');
               foreach($res as $var){$op=$var->cedula;}
               if (!$op){$op='';}
               for($i=0;$i<count($_POST["nomarc_pla"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomarc_pla"][$i]; 
                    $npag       = $_POST["npag_pla"][$i];        
                    $color      = $_POST["colores_pla"][$i];
                    $tamano     = $_POST["tamano_pla"][$i];
                    $obse       = $_POST["obse_pla"][$i];
                    if (!isset($_POST["poly_pla"][$i])){$poly='0';}else{$poly=$_POST["poly_pla"][$i];} 
                    if (!isset($_POST["compuesto_pla"][$i])){$compuesto='0';}else{$compuesto=$_POST["compuesto_pla"][$i];}
                    if (!isset($_POST["color2_pla"][$i])){$color2='0';}else{$color2=$_POST["color2"][$i];}

                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s");
                    
                    //se arma el array de guardago
                    //(pla_orden,pla_secuencia,pla_nom_arc,pla_paginas,pla_poly,pla_color_5,pla_tamaño,pla_fechaini,pla_estado) "
                    $datos_pla = array(
                        "pla_orden" => $orden,
                        "pla_secuencia" => $num,
                        "pla_nom_arc" => $nombre,
                        "pla_paginas" => $npag,
                        "pla_poly" => $poly,
                        "pla_colores" => $color,
                        "pla_color_co" => $compuesto,
                        "pla_tamaño" => $tamano,
                        "pla_color_2" => $color2,
                        "pla_observacion" => $obse,
                        "pla_fechaini" => $fecha,
                        "pla_fechaasi" => $fecha,
                        "pla_operario" => $op,
                        "pla_estado" => "pe",
                        "pla_prioridad" => "3"
                        );
                    
                    if($this->guardar_model->ad_cfg("pro_plancha",$datos_pla)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}                     
               }
            }   
	}    
        
        public function guardar_litografia()
	{      
            //Guardar Plancha  
            if(isset ($_POST["nomarc_lito"])){
               for($i=0;$i<count($_POST["nomarc_lito"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomarc_lito"][$i]; 
                    $pliegos    = $_POST["pliegos_lito"][$i];        
                    $tfinal     = $_POST["tfinal_lito"][$i];
                    $macula     = $_POST["macula_lito"][$i];
                    $tintas     = $_POST["tintas_lito"][$i];
                    $tpapel     = $_POST["tpapel_lito"][$i];
                    $tcorte     = $_POST["tcorte_lito"][$i];
                    $obser      = $_POST["obser_lito"][$i];
                    if (!isset($_POST["origen"][$i])){$origen='1';}else{$origen=$_POST["origen_lito"][$i];} 
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    //(pla_orden,pla_secuencia,pla_nom_arc,pla_paginas,pla_poly,pla_color_5,pla_tamaño,pla_fechaini,pla_estado) "
                    $datos_lito = array(
                         "lito_orden" => $orden,
                         "lito_secuencia" => $num,
                         "lito_nombre" => $nombre,
                         "lito_pliegos" => $pliegos,
                         "lito_finales" => $tfinal,
                         "lito_macula" => $macula,
                         "lito_tintas" => $tintas,
                         "lito_tpapel" => $tpapel,
                         "lito_cli_papel" => $origen,
                         "lito_tamcorte" => $tcorte,
                         "lito_observa" => $obser,
                         "lito_fechaini" => $fecha,
                         "lito_estado" => "ac",
                         "lito_prioridad" => "3"
                        );                    
                    if($this->guardar_model->ad_cfg("pro_litografia",$datos_lito)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");} 
                    
                    $datos_cor = array(
                         "cor_orden" => $orden,
                         "cor_secuencia" => $num,
                         "cor_nombre" => $nombre,
                         "cor_pliegos" => $pliegos,
                         "cor_tpapel" => $tpapel,
                         "cor_cli_papel" => $origen,
                         "cor_tamcorte" => $tcorte,
                         "cor_observa" => $obser,
                         "cor_fechaini" => $fecha,
                         "cor_estado" => "ac",
                         "cor_prioridad" => "3"
                        );                    
                    if($this->guardar_model->ad_cfg("pro_corte",$datos_cor)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}                     
               } 
            }   
	} 

        public function guardar_corte()
	{      
            //Guardar corte  
            if(isset ($_POST["nomarc_cor"])){
               for($i=0;$i<count($_POST["nomarc_cor"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomarc_cor"][$i];
                    $pliegos    = $_POST["pliegos_cor"][$i];      
                    $tpapel     = $_POST["tpapel_cor"][$i];
                    $tcorte     = $_POST["tcorte_cor"][$i];
                    $obse       = $_POST["obse_cor"][$i];
                    $origen     = $_POST["opapel_cor"][$i]; 
                    $num        = $i+1;
                    $fecha = date('Y-m-d');

                    $datos_cor = array(
                         "cor_orden"        => $orden,
                         "cor_secuencia"    => $num,
                         "cor_nombre"       => $nombre,
                         "cor_pliegos"      => $pliegos,
                         "cor_tpapel"       => $tpapel,
                         "cor_cli_papel"    => $origen,
                         "cor_tamcorte"     => $tcorte,
                         "cor_observa"      => $obse,
                         "cor_fechaini"     => $fecha,
                         "cor_estado"       => "ac",
                         "cor_prioridad"    => "3"
                        );                    
                    if($this->guardar_model->ad_cfg("pro_corte",$datos_cor)==true){
                        echo ("Corte Guardado");}
                    else { echo ("No se pudo guardar corte");}  
               } 
            }   
	}         
        
        public function guardar_anillado()                                
	{                             
             if(isset ($_POST["nomtra_ani"])){
               for($i=0;$i<count($_POST["nomtra_ani"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_ani"][$i]; 
                    $cant       = $_POST["cant_ani"][$i];  
                    $tcorte     = $_POST["tcorte_ani"][$i]; 
                    $hojas      = $_POST["nhint_ani"][$i]; 
                    $color      = $_POST["color_ani"][$i];
                    $tiras      = $_POST["tiras_ani"][$i]; 
                    $obser      = $_POST["obser_ani"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "ani_orden" => $orden,
                        "ani_secuencia" => $num,
                        "ani_nombre" => $nombre,
                        "ani_cantidad" => $cant,
                        "ani_tcorte" => $tcorte,
                        "ani_hojasint" => $hojas,
                        "ani_color" => $color,
                        "ani_tipotiras" => $tiras,
                        "ani_obser" => $obser,
                        "ani_fechaini" => $fecha,
                        "ani_estado" => "ac",
                        "ani_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_anillado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	} 

        public function guardar_brillo()                                
	{                             
             if(isset ($_POST["nomtra_bri"])){
               for($i=0;$i<count($_POST["nomtra_bri"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_bri"][$i]; 
                    $cant       = $_POST["cant_bri"][$i];  
                    $tcorte     = $_POST["tcorte_bri"][$i]; 
                    $tipo       = $_POST["tipo_bri"][$i]; 
                    $caras      = $_POST["caras_bri"][$i]; 
                    $obser      = $_POST["obser_bri"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "bri_orden" => $orden,
                        "bri_secuencia" => $num,
                        "bri_nombre" => $nombre,
                        "bri_cantidad" => $cant,
                        "bri_tcorte" => $tcorte,
                        "bri_tipo" => $tipo,
                        "bri_caras" => $caras,
                        "bri_obser" => $obser,
                        "bri_fechaini" => $fecha,
                        "bri_estado" => "ac",
                        "bri_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_brillo",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	} 
        
        public function guardar_ensanduchado()                                
	{                             
             if(isset ($_POST["nomtra_ensa"])){
               for($i=0;$i<count($_POST["nomtra_ensa"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_ensa"][$i]; 
                    $cant       = $_POST["cant_ensa"][$i];  
                    $tcorte     = $_POST["tcorte_ensa"][$i]; 
                    $papel      = $_POST["tpr_ensa"][$i]; 
                    $obser      = $_POST["obser_ensa"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "ensa_orden" => $orden,
                        "ensa_secuencia" => $num,
                        "ensa_nombre" => $nombre,
                        "ensa_cantidad" => $cant,
                        "ensa_tcorte" => $tcorte,
                        "ensa_papelres" => $papel,
                        "ensa_obser" => $obser,
                        "ensa_fechaini" => $fecha,
                        "ensa_estado" => "ac",
                        "ensa_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_ensanduchado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	} 
        
        public function guardar_estampado()                                
	{                                        
             if(isset ($_POST["nomtra_esta"])){
               for($i=0;$i<count($_POST["nomtra_esta"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_esta"][$i]; 
                    $cant       = $_POST["cant_esta"][$i];  
                    $tcorte     = $_POST["tcorte_esta"][$i]; 
                    $color      = $_POST["color_esta"][$i]; 
                    $tipo       = $_POST["cinta_esta"][$i];
                    $obser      = $_POST["obser_esta"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "esta_orden" => $orden,
                        "esta_secuencia" => $num,
                        "esta_nombre" => $nombre,
                        "esta_cantidad" => $cant,
                        "esta_tcorte" => $tcorte,
                        "esta_color" => $color,
                        "esta_tipocinta" => $tipo,
                        "esta_obser" => $obser,
                        "esta_fechaini" => $fecha,
                        "esta_estado" => "ac",
                        "esta_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_estampado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	} 
        
        public function guardar_grapado()                                
	{                        
             if(isset ($_POST["nomtra_gra"])){
               for($i=0;$i<count($_POST["nomtra_gra"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_gra"][$i]; 
                    $cant       = $_POST["cant_gra"][$i];  
                    $tcorte     = $_POST["tcorte_gra"][$i]; 
                    $tipo       = $_POST["tipo_gra"][$i]; 
                    $obser      = $_POST["obser_gra"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "gra_orden" => $orden,
                        "gra_secuencia" => $num,
                        "gra_nombre" => $nombre,
                        "gra_cantidad" => $cant,
                        "gra_tcorte" => $tcorte,
                        "gra_tipo" => $tipo,
                        "gra_obser" => $obser,
                        "gra_fechaini" => $fecha,
                        "gra_estado" => "ac",
                        "gra_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_grapado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}         

        public function guardar_intercalado()                                
	{                        
             if(isset ($_POST["nomtra_inter"])){
               for($i=0;$i<count($_POST["nomtra_inter"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_inter"][$i]; 
                    $cant       = $_POST["cant_inter"][$i];  
                    $tcorte     = $_POST["tcorte_inter"][$i]; 
                    $nhojas       = $_POST["nhojas_inter"][$i]; 
                    $obser      = $_POST["obser_inter"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "inter_orden" => $orden,
                        "inter_secuencia" => $num,
                        "inter_nombre" => $nombre,
                        "inter_cantidad" => $cant,
                        "inter_tcorte" => $tcorte,
                        "inter_hojasint" => $nhojas,
                        "inter_obser" => $obser,
                        "inter_fechaini" => $fecha,
                        "inter_estado" => "ac",
                        "inter_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_intercalado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}         
                
        public function guardar_pegado()                                
	{                        
             if(isset ($_POST["nomtra_pega"])){
               for($i=0;$i<count($_POST["nomtra_pega"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_pega"][$i]; 
                    $cant       = $_POST["cant_pega"][$i];  
                    $tcorte     = $_POST["tcorte_pega"][$i]; 
                    $hint       = $_POST["hint_pega"][$i]; 
                    $obser      = $_POST["obser_pega"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "pega_orden" => $orden,
                        "pega_secuencia" => $num,
                        "pega_nombre" => $nombre,
                        "pega_cantidad" => $cant,
                        "pega_tcorte" => $tcorte,
                        "pega_hojasint" => $hint,
                        "pega_obser" => $obser,
                        "pega_fechaini" => $fecha,
                        "pega_estado" => "ac",
                        "pega_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_pegado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}   

        public function guardar_plegado()                                
	{                        
             if(isset ($_POST["nomtra_ple"])){
               for($i=0;$i<count($_POST["nomtra_ple"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_ple"][$i]; 
                    $cant       = $_POST["cant_ple"][$i];  
                    $tcorte     = $_POST["tcorte_ple"][$i]; 
                    $doble       = $_POST["dobles_ple"][$i];
                    $tpapel       = $_POST["tpapel_ple"][$i];
                    $obser      = $_POST["obser_ple"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "ple_orden" => $orden,
                        "ple_secuencia" => $num,
                        "ple_nombre" => $nombre,
                        "ple_cantidad" => $cant,
                        "ple_tcorte" => $tcorte,
                        "ple_dobleces" => $doble,
                        "ple_tpapel" => $tpapel,
                        "ple_obser" => $obser,
                        "ple_fechaini" => $fecha,
                        "ple_estado" => "ac",
                        "ple_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_plegado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}          

        public function guardar_plastificado()                                
	{                        
             if(isset ($_POST["nomtra_plas"])){
               for($i=0;$i<count($_POST["nomtra_plas"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_plas"][$i]; 
                    $cant       = $_POST["cant_plas"][$i];  
                    $tcorte     = $_POST["tcorte_plas"][$i]; 
                    $brillo     = $_POST["brillo_plas"][$i];
                    $caras      = $_POST["caras_plas"][$i];
                    $reserva    = $_POST["reserva_plas"][$i]; 
                    $obser      = $_POST["obser_plas"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "plas_orden" => $orden,
                        "plas_secuencia" => $num,
                        "plas_nombre" => $nombre,
                        "plas_cantidad" => $cant,
                        "plas_tcorte" => $tcorte,
                        "plas_brillo" => $brillo,
                        "plas_caras" => $caras,
                        "plas_reserva" => $reserva,
                        "plas_obser" => $obser,
                        "plas_fechaini" => $fecha,
                        "plas_estado" => "ac",
                        "plas_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_plastificado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}          

        public function guardar_repujado()                                
	{                        
             if(isset ($_POST["nomtra_rep"])){
               for($i=0;$i<count($_POST["nomtra_rep"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_rep"][$i]; 
                    $cant       = $_POST["cant_rep"][$i];  
                    $tcorte     = $_POST["tcorte_rep"][$i]; 
                    $obser      = $_POST["obser_rep"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago                   
                    $datos = array(
                        "rep_orden" => $orden,
                        "rep_secuencia" => $num,
                        "rep_nombre" => $nombre,
                        "rep_cantidad" => $cant,
                        "rep_tcorte" => $tcorte,
                        "rep_obser" => $obser,
                        "rep_fechaini" => $fecha,
                        "rep_estado" => "ac",
                        "rep_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_repujado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}  
        
        public function guardar_troquelado()                                
	{                        
             if(isset ($_POST["nomtra_tro"])){
               for($i=0;$i<count($_POST["nomtra_tro"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_tro"][$i]; 
                    $cant       = $_POST["cant_tro"][$i];  
                    $tcorte     = $_POST["tcorte_tro"][$i]; 
                    $ttro       = $_POST["tipo_tro"][$i];
                    $obser      = $_POST["obser_tro"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "tro_orden" => $orden,
                        "tro_secuencia" => $num,
                        "tro_nombre" => $nombre,
                        "tro_cantidad" => $cant,
                        "tro_tcorte" => $tcorte,
                        "tro_tipo" => $ttro,
                        "tro_obser" => $obser,
                        "tro_fechaini" => $fecha,
                        "tro_estado" => "ac",
                        "tro_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_troquelado",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}          

        public function guardar_etroquel()                                
	{                        
             if(isset ($_POST["nomtra_etro"])){
               for($i=0;$i<count($_POST["nomtra_etro"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_etro"][$i]; 
                    $cant       = $_POST["cant_etro"][$i];   
                    $obser      = $_POST["obser_etro"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    $hora= date("H:i:s"); 
                    //se arma el array de guardado
                    
                    $datos = array(
                        "etr_orden" => $orden,
                        "etr_secuencia" => $num,
                        "etr_nombre" => $nombre,
                        "etr_cantidad" => $cant,
                        "etr_obser" => $obser,
                        "etr_fechaini" => $fecha,
                        "etr_estado" => "ac",
                        "etr_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_etroquel",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}                  
        
        public function guardar_especial()                                
	{                        
             if(isset ($_POST["nomtra_esp"])){
               for($i=0;$i<count($_POST["nomtra_esp"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_esp"][$i]; 
                    $cant       = $_POST["cant_esp"][$i];   
                    $obser      = $_POST["obser_esp"][$i];
                    $num        = $i+1;
                    $fecha = date('Y-m-d'); 
                    //se arma el array de guardago
                    
                    $datos = array(
                        "esp_orden" => $orden,
                        "esp_secuencia" => $num,
                        "esp_nombre" => $nombre,
                        "esp_cantidad" => $cant,
                        "esp_obser" => $obser,
                        "esp_fechaini" => $fecha,
                        "esp_estado" => "ac",
                        "esp_prioridad" => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_especial",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }    
	}                          
        
        public function guardar_laser()
	{      
            //Guardar encuadernado  
            if(isset ($_POST["nomtra_laser"])){
               $res=$this->cargar_model->operario('LSR');
               foreach($res as $var){$op=$var->cedula;}
               if (!$op){$op='';}
               for($i=0;$i<count($_POST["nomtra_laser"]);$i++)
               {
                    $orden      = $_POST["num"];
                    $nombre     = $_POST["nomtra_laser"][$i]; 
                    $cant       = $_POST["cant_laser"][$i]; 
                    $tam        = $_POST["tam_laser"][$i]; 
                    $caras      = $_POST["caras_laser"][$i]; 
                    $papel      = $_POST["tpapel_laser"][$i]; 
                    $obser      = $_POST["obser_laser"][$i]; 
                    $num        = $i+1;
                    $fecha = date('Y-m-d');
                    //se arma el array de guardago
                    $datos = array(
                         "laser_orden"      => $orden,
                         "laser_secuencia"  => $num,
                         "laser_nombre"     => $nombre,
                         "laser_cantidad"   => $cant,
                         "laser_tamano"     => $tam,
                         "laser_caras"      => $caras,
                         "laser_tpapel"     => $papel,
                         "laser_obser"      => $obser,
                         "laser_fechaini"   => $fecha,
                         "laser_fechaasi"   => $fecha,
                         "laser_operario"   => $op,
                         "laser_estado"     => "pe",
                         "laser_prioridad"  => "3"
                        );                      
                    if($this->guardar_model->ad_cfg("pro_laser",$datos)==true){
                        echo ("Registro Guardado");}
                    else { echo ("No se pudo guardar los datos");}  
               }
            }   
	}    
        
    public function gestiona_traza()
    {      
        if ($this->input->is_ajax_request()) {
                $tipo  = $this->input->post("tipo");
                $orden = $this->input->post("orden");
                $sec   = $this->input->post("sec");
                $opera = $this->input->post("operario");              
                $datos = $this->guardar_model->gestiona_traza($tipo,$orden,$sec,$opera);
                $this->verifica_registros($orden);
                echo json_encode($datos);			
        }
    } 
    public function guardar_avance()
    {
        if ($this->input->is_ajax_request()) {
                $orden = $this->input->post("orden");
                $sec   = $this->input->post("sec");
                $fecha = $this->input->post("fecha");  
                $valor = $this->input->post("valor");
                    //se arma el array de guardago
                    $datos = array(
                         "pro_num"          => 0,
                         "pro_orden"        => $orden,
                         "pro_secuencia"    => $sec,
                         "pro_fecha"        => $fecha,
                         "pro_avance"       => $valor
                        );                      
                    $conn=$this->guardar_model->ad_cfg("pro_avances",$datos);
                     
            }else{echo("No Entra");}
        echo json_encode($conn);    
    }
    public function priorizar()
    {      
        if ($this->input->is_ajax_request()) {
                $tipo  = $this->input->post("tipo");
                $orden = $this->input->post("orden");
                $sec   = $this->input->post("sec");
                $pri   = $this->input->post("prioridad");  
                switch($tipo){
                    case "Plancha":         $tipo="pla"; break;                    
                    case "Anillado":        $tipo="ani"; break;   
                    case "Litografía":      $tipo="lito"; break;   
                    case "Brillo UV":       $tipo="bri"; break;   
                    case "Ensanduchado":    $tipo="ensa"; break;   
                    case "Estampado":       $tipo="esta"; break;   
                    case "Grapado":         $tipo="gra"; break;   
                    case "Intercalado":     $tipo="inter"; break;   
                    case "Pegado al Calor": $tipo="pega"; break;   
                    case "Plegado":         $tipo="ple"; break;   
                    case "Plastificado":    $tipo="plas"; break;   
                    case "Repujado":        $tipo="repu"; break;   
                    case "Troquelado":      $tipo="tro"; break;   
                    case "Impresión Laser": $tipo="laser"; break;   
                }
                              
                $datos = $this->guardar_model->priorizar_orden($tipo,$orden,$sec,$pri);
                echo json_encode($datos);			
        }
    }     
   
    public function termina_pro(){

            if ($this->input->is_ajax_request()) {
                    $orden  = $this->input->post("orden");
                    $sec    = $this->input->post("sec");
                    $tipo   = $this->input->post("tipo");
                    if($datos = $this->guardar_model->termina_orden($tipo,$orden,$sec)){
                        $result=$this->guardar_model->verifica_registros($orden);
                        echo json_encode($result);
                    }                       
                    //$this->verifica_registros($orden);                                       			
            }       
    }   
    public function procesa_pro(){
            if ($this->input->is_ajax_request()) {
                    $orden  = $this->input->post("orden");
                    $sec    = $this->input->post("sec");
                    $tipo   = $this->input->post("tipo");
                    if($datos = $this->guardar_model->procesar_orden($tipo,$orden,$sec)){
                        $result=$this->guardar_model->verifica_registros($orden);
                        echo json_encode($result);
                    }                       
                    //$this->verifica_registros($orden);                                       			
            }       
    }     
        public function termina_w(){
            if ($this->input->is_ajax_request()) {
                    $orden  = $this->input->post("orden");
                    $sec    = $this->input->post("sec");
                    $tipo   = $this->input->post("tipo");    
                    $final  = $this->input->post("final");   
                    $datos  = $this->guardar_model->termina_w($tipo,$orden,$sec,$final);
                    verifica_registros($orden);
                    echo json_encode($datos);			
            }       
    }
    
    public function verifica_registros($orden){
        //registros Plancha
        $plan_ac =$this->Consultas_Model->ac_plancha($orden);
        $plan_pe =$this->Consultas_Model->pe_plancha($orden);
        /*/*registros Litografia
        $ac_lito    =$this->Consultas_Model->ac_litografia($orden);
        $pe_lito    =$this->Consultas_Model->pe_litografia($orden);
        //Registros Acabados
        $ac_aca     =$this->Consultas_Model->ac_acabado($orden);
        $pe_aca     =$this->Consultas_Model->pe_acabado($orden);
        //Registros Encuadernado
        $ac_encu    =$this->Consultas_Model->pe_encuaderna($orden);
        $pe_encu    =$this->Consultas_Model->pe_encuaderna($orden);*/      
        foreach($plan_ac as $plan){ $ac_plan = $plan->nac; }
        foreach($plan_pe as $plan){ $pe_plan = $plan->nac; }
        $ac = $ac_plan;//+$ac_lito+$ac_aca+$ac_encu;
        $pe = $pe_plan;//+$pe_lito+$pe_aca+$pe_encu;

        if($ac==0 && $pe>0){
            $estado='pe';
        }elseif ($ac==0 && $pe==0) {
            $estado='fi';
        }
        if($estado){
            $this->guardar_model->act_estado($estado,$orden);
        }
    }
}