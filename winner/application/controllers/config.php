<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

    	function __construct()
	{
		parent::__construct();
                 $this->load->helper('form');
                 $this->load->helper('html');
                 $this->load->helper('url');
                 $this->load->helper('date');
                 $this->load->model('guardar_model');
                 $this->load->model('cargar_model');
                 $this->load->library('form_validation');
	}      
        
    public function nuevaPersona()
    {  
        if ($this->input->is_ajax_request()) {
            $tabla  = "cfg_empleado";
            $ced    = $this->input->post("cedula");
            $nom    = $this->input->post("nombre");  
            $cargo  = $this->input->post("cargo");
            $dir    = $this->input->post("dir");  
            $tel    = $this->input->post("tel"); 
            $rol    = $this->input->post("rol");
            $pro    = $this->input->post("pro");
            $usr    = $this->input->post("usr"); 
            $pass   = $this->input->post("clave"); 
            $fecha      = date('Y-m-d H:i:s');
            $datos = array(
                    "cedula"    => $ced,
                    "nombre"    => $nom,
                    "cargo"     => $cargo,
                    "direccion" => $dir,
                    "telefono"  => $tel,
                    "rol"       => $rol,
                    "proceso"   => $pro,
                    "usuario"   => $usr,
                    "clave"     => $pass,
                    "estado"    => 'ac',  
                    "fecha"     => $fecha,
                    );
            $conn=$this->guardar_model->ad_cfg($tabla,$datos); 
             echo json_encode($conn);  
        }
        else
        {
                echo"no entra ajax";
                show_404();
        }
    }

    public function editarPersona()
    {  
        if ($this->input->is_ajax_request()) {
            $ced    = $this->input->post("ucedula");
            $nom    = $this->input->post("unombre");  
            $cargo  = $this->input->post("ucargo");
            $dir    = $this->input->post("udir");  
            $rol    = $this->input->post("utel"); 
            $tel    = $this->input->post("urol");
            $fecha      = date('Y-m-d H:i:s');
            $datos = array(
                    "nombre"    => $nom,
                    "cargo"     => $cargo,
                    "direccion" => $dir,
                    "telefono"  => $tel,
                    "rol"       => $rol, 
                    "fecha"     => $fecha,
                    );
            $conn=$this->guardar_model->updatePersona($ced,$datos); 
             echo json_encode($conn);  
        }
        else
        {
                echo"no entra ajax";
                show_404();
        }
    }
    
    function mostrarColor(){
        if ($this->input->is_ajax_request()) {
                $buscar = $this->input->post("buscar");
                $datos = $this->Empleados_model->mostrar($buscar);
                echo json_encode($datos);

        }
    }

   public function nuevoCliente()
	{  
            if ($this->input->is_ajax_request()) {
                date_default_timezone_set ('America/Bogota');
                $tabla    = "cfg_cliente";
                $id       = $this->input->post("id");
                $nom      = $this->input->post("nombre");  
                $dir      = $this->input->post("dir");
                $fijo     = $this->input->post("fijo");  
                $movil    = $this->input->post("movil"); 
                $mail     = $this->input->post("email");
                $regi     = $this->input->post("regimen"); 
                $contac   = $this->input->post("contacto"); 
                $cargo    = $this->input->post("cargo"); 
                $mailcon  = $this->input->post("mailcon"); 
                $telcon   = $this->input->post("telcon"); 
                $ciudad   = $this->input->post("ciudad"); 
                $fecha      = date('Y-m-d H:i:s');
                $datos = array(
                        "cli_nit"           => $id,
                        "cli_razon"         => $nom,
                        "cli_direccion"     => $dir,
                        "cli_email"         => $mail,
                        "cli_fijo"          => $fijo,
                        "cli_movil"         => $movil,
                        "cli_tregimen"      => $regi,                        
                        "cli_contacto"      => $contac,
                        "cli_cargo"         => $cargo,
                        "cli_telcon"        => $telcon,
                        "cli_mailcon"       => $mailcon,
                        "cli_ciudad"        => $ciudad,
                        "cli_usuario"       => 'usr',
                        "cli_fecha"         => $fecha
                        );
                $conn=$this->guardar_model->ad_cfg($tabla,$datos); 
                 echo json_encode($conn);  
            }
            else
            {
                    show_404();
            }
	}

   public function editarCliente()
	{  
            if ($this->input->is_ajax_request()) {
                date_default_timezone_set ('America/Bogota');
                $id       = $this->input->post("uid");
                $nom      = $this->input->post("unombre");  
                $dir      = $this->input->post("udir");
                $fijo     = $this->input->post("ufijo");  
                $movil    = $this->input->post("umovil"); 
                $mail     = $this->input->post("uemail");
                $regi     = $this->input->post("uregimen"); 
                $contac   = $this->input->post("ucontacto"); 
                $cargo    = $this->input->post("ucargo"); 
                $mailcon  = $this->input->post("umailcon"); 
                $telcon   = $this->input->post("utelcon"); 
                $ciudad   = $this->input->post("uciudad"); 
                $fecha      = date('Y-m-d H:i:s');
                $datos = array(
                        "cli_nit"           => $id,
                        "cli_razon"         => $nom,
                        "cli_direccion"     => $dir,
                        "cli_email"         => $mail,
                        "cli_fijo"          => $fijo,
                        "cli_movil"         => $movil,
                        "cli_tregimen"      => $regi,                        
                        "cli_contacto"      => $contac,
                        "cli_cargo"         => $cargo,
                        "cli_telcon"        => $telcon,
                        "cli_mailcon"       => $mailcon,
                        "cli_ciudad"        => $ciudad,
                        "cli_usuario"       => 'usr',
                        "cli_fecha"         => $fecha
                        );
                $conn=$this->guardar_model->update_cliente($id,$datos); 
                 echo json_encode($conn);  
            }
            else{show_404();}
	}
        
   public function nuevoPro()
	{  
            if ($this->input->is_ajax_request()) {
                $tabla    = "cfg_proveedor";
                $id       = $this->input->post("id");
                $nom      = $this->input->post("nombre");  
                $dir      = $this->input->post("dir");
                $fijo     = $this->input->post("fijo");  
                $movil    = $this->input->post("movil"); 
                $mail     = $this->input->post("email");
                $ciudad   = $this->input->post("ciudad"); 
                $regi     = $this->input->post("regimen"); 
                $contac   = $this->input->post("contacto"); 
                $cargo    = $this->input->post("cargo"); 
                $mailcon  = $this->input->post("mailcon"); 
                $telcon   = $this->input->post("telcon"); 
                $cata     = $this->input->post("catalogo");
                $fecha    = date('d-m-Y H:m:s');
                $datos = array(
                        "pvd_nit"           => $id,
                        "pvd_razon"         => $nom,
                        "pvd_direccion"     => $dir,
                        "pvd_email"         => $mail,
                        "pvd_fijo"          => $fijo,
                        "pvd_movil"         => $movil,
                        "pvd_ciudad"        => $ciudad, 
                        "pvd_tregimen"      => $regi,                        
                        "pvd_contacto"      => $contac,
                        "pvd_cargo"         => $cargo,
                        "pvd_telcon"        => $telcon,
                        "pvd_mailcon"       => $mailcon,
                        "pvd_catalogo"      => $cata,
                        "pvd_estado"        => 'ac',
                        "pvd_usuario"       => 'usr',
                        "pvd_fecha"         => $fecha
                        );
                $conn=$this->guardar_model->ad_cfg($tabla,$datos); 
                 echo json_encode($conn);  
            }
            else{show_404();}
	}   
        
   public function editarPro()
	{  
            if ($this->input->is_ajax_request()) {
                date_default_timezone_set ('America/Bogota');
                $id       = $this->input->post("uid");
                $nom      = $this->input->post("unombre");  
                $dir      = $this->input->post("udir");
                $fijo     = $this->input->post("ufijo");  
                $movil    = $this->input->post("umovil"); 
                $mail     = $this->input->post("uemail");
                $regi     = $this->input->post("uregimen"); 
                $contac   = $this->input->post("ucontacto"); 
                $cargo    = $this->input->post("ucargo"); 
                $mailcon  = $this->input->post("umailcon"); 
                $telcon   = $this->input->post("utelcon"); 
                $ciudad   = $this->input->post("uciudad"); 
                $fecha      = date('Y-m-d H:i:s');
                $datos = array(
                        "pvd_nit"           => $id,
                        "pvd_razon"         => $nom,
                        "pvd_direccion"     => $dir,
                        "pvd_email"         => $mail,
                        "pvd_fijo"          => $fijo,
                        "pvd_movil"         => $movil,
                        "pvd_tregimen"      => $regi,                        
                        "pvd_contacto"      => $contac,
                        "pvd_cargo"         => $cargo,
                        "pvd_telcon"        => $telcon,
                        "pvd_mailcon"       => $mailcon,
                        "pvd_ciudad"        => $ciudad,
                        "pvd_usuario"       => 'usr',
                        "pvd_fecha"         => $fecha
                        );
                $conn=$this->guardar_model->update_Pro($id,$datos); 
                 echo json_encode($conn);  
            }
            else{show_404();}
	}

public function nuevaTinta()
     {  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tin_codigo"   => $id,
                     "tin_nombre"   => $nom,
                     "tin_estado"   => 'ac',
                     "tin_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nueva_tinta($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarTinta()
     {  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $datos = array(
                     "tin_nombre"         => $nom
                     );
             $con=$this->guardar_model->update_tinta($id,$datos); 
              echo json_encode($con);  
         }
         else{show_404();}
     }  

public function borrarTinta()
     {  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrar_tinta($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     } 
//Config Color
public function nuevoColor()
     {  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "color_codigo"   => $id,
                     "color_nombre"   => $nom,
                     "color_estado"   => 'ac',
                     "color_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevo_color($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarColor()
     {  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "color_nombre"         => $nom
                     );
             $conn=$this->guardar_model->update_color($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrarColor()
     {  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrar_color($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }    
//Config Ciudad
public function nuevaCiudad(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "ciu_codigo"   => $id,
                     "ciu_nombre"   => $nom,
                     "ciu_estado"   => 'ac',
                     "ciu_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nueva_ciudad($datos); 
             echo json_encode($conn);  
         }
     }         
        
public function editarCiudad(){  
         if ($this->input->is_ajax_request()) {
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $datos = array("ciu_nombre" => $nom);
             $conn=$this->guardar_model->update_ciudad($id,$datos);
             echo json_encode($conn);
            }
         else{show_404();}       
}
public function borrarCiudad(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrar_ciudad($id); 
              echo json_encode($conn);  
         }
     }
public function mostrarCiudad(){
    $conn=$this->cargar_model->mostrar_ciudad(); 
     echo json_encode($conn);     
} 
public function mostrarTintas(){
    $conn=$this->cargar_model->mostrar_tintas(); 
     echo json_encode($conn);     
} 
public function mostrarColores(){
    $conn=$this->cargar_model->mostrar_colores(); 
     echo json_encode($conn);     
} 
public function mostrarBrillo(){
    $conn=$this->cargar_model->mostrar_brillo(); 
     echo json_encode($conn);     
}
public function mostrarTroquel(){
    $conn=$this->cargar_model->mostrar_troquel(); 
     echo json_encode($conn);     
}
public function mostrarPlasti(){
    $conn=$this->cargar_model->mostrar_plasti(); 
     echo json_encode($conn);     
}
public function mostrarPapel(){
    $conn=$this->cargar_model->mostrar_papel(); 
     echo json_encode($conn);     
}
public function mostrarcolani(){
    $conn=$this->cargar_model->mostrar_colani(); 
     echo json_encode($conn);     
}
public function mostrartiras(){
    $conn=$this->cargar_model->mostrar_tiras(); 
     echo json_encode($conn);     
}
public function mostrarcolestampa(){
    $conn=$this->cargar_model->mostrar_colestampa(); 
     echo json_encode($conn);     
}
public function mostrartpres(){
    $conn=$this->cargar_model->mostrar_tpres(); 
     echo json_encode($conn);     
}
public function mostrarcinta(){
    $conn=$this->cargar_model->mostrar_cinta(); 
     echo json_encode($conn);     
}
public function mostrargrapa(){
    $conn=$this->cargar_model->mostrar_grapa(); 
     echo json_encode($conn);     
}
public function mostrartpple(){
    $conn=$this->cargar_model->mostrar_tpple(); 
     echo json_encode($conn);     
}
public function mostrartclito(){
    $conn=$this->cargar_model->mostrar_tclito(); 
     echo json_encode($conn);     
}
public function mostrarCorte_ani(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_ani'); 
     echo json_encode($conn);     
}
public function mostrarCorte_bri(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_bri'); 
     echo json_encode($conn);     
}
public function mostrarCorte_ensa(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_ensa'); 
     echo json_encode($conn);     
}
public function mostrarCorte_esta(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_esta'); 
     echo json_encode($conn);     
}   
public function mostrarCorte_gra(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_gra'); 
     echo json_encode($conn);     
} 
public function mostrarCorte_inter(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_inter'); 
     echo json_encode($conn);     
}
public function mostrarCorte_pega(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_pega'); 
     echo json_encode($conn);     
}
public function mostrarCorte_ple(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_ple'); 
     echo json_encode($conn);     
}
public function mostrarCorte_pla(){
    $conn=$this->cargar_model->mostrarCorte('cfg_dimension'); 
     echo json_encode($conn);     
}
public function mostrarCorte_plas(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_plas'); 
     echo json_encode($conn);     
}
public function mostrarCorte_rep(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_repu'); 
     echo json_encode($conn);     
}
public function mostrarCorte_tro(){
    $conn=$this->cargar_model->mostrarCorte('cfg_tcorte_tro'); 
     echo json_encode($conn);     
}
//ConfigBrillo
public function nuevoBrillo(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "cfg_bri_codigo"   => $id,
                     "cfg_bri_nombre"   => $nom,
                     "cfg_bri_estado"   => 'ac',
                     "cfg_bri_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoBrillo($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarBrillo(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "cfg_bri_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateBrillo($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrarBrillo(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarBrillo($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
     
//Config Troquel
public function nuevoTroquel(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tro_codigo"   => $id,
                     "tro_nombre"   => $nom,
                     "tro_estado"   => 'ac',
                     "tro_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoTroquel($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarTroquel(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tro_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateTroquel($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrarTroquel(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarTroquel($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }        

//Config Plastificado
public function nuevoPlasti(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "plasti_codigo"   => $id,
                     "plasti_nombre"   => $nom,
                     "plasti_estado"   => 'ac',
                     "plasti_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoPlasti($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarPlasti(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "plasti_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatePlasti($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrarPlasti(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarPlasti($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }
     
//Config Tipo Papel
public function nuevoPapel(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tp_codigo"   => $id,
                     "tp_nombre"   => $nom,
                     "tp_estado"   => 'ac',
                     "tp_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoPapel($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarPapel(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tp_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatePapel($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrarPapel(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarPapel($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  
     
//Config Color Anillo
public function nuevocolani(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "colani_codigo"   => $id,
                     "colani_nombre"   => $nom,
                     "colani_estado"   => 'ac',
                     "colani_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevocolani($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarcolani(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "colani_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatecolani($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrarcolani(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarcolani($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }        

//Config Tiras Anillo
public function nuevotiras(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tiras_codigo"   => $id,
                     "tiras_nombre"   => $nom,
                     "tiras_estado"   => 'ac',
                     "tiras_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevotiras($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editartiras(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tiras_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatetiras($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrartiras(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrartiras($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }        

//Config Color Estampado
public function nuevocolestampa(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "coles_codigo"   => $id,
                     "coles_nombre"   => $nom,
                     "coles_estado"   => 'ac',
                     "coles_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevocolestampa($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarcolestampa(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "coles_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatecolestampa($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrarcolestampa(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarcolestampa($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }        
    
//Config Papel Respaldo
public function nuevotpres(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tpr_codigo"   => $id,
                     "tpr_nombre"   => $nom,
                     "tpr_estado"   => 'ac',
                     "tpr_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevotpres($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editartpres(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tpr_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatetpres($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrartpres(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrartpres($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }   
     
//Config tipo Cinta
public function nuevocinta(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "cinta_codigo"   => $id,
                     "cinta_nombre"   => $nom,
                     "cinta_estado"   => 'ac',
                     "cinta_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevocinta($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editarcinta(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "cinta_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatecinta($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrarcinta(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarcinta($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }             

//Config tipo Grapado
public function nuevograpa(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "grapa_codigo"   => $id,
                     "grapa_nombre"   => $nom,
                     "grapa_estado"   => 'ac',
                     "grapa_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevograpa($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editargrapa(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "grapa_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updategrapa($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrargrapa(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrargrapa($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  
     
//Config tipo papel plegado
public function nuevotpple(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tpple_codigo"   => $id,
                     "tpple_nombre"   => $nom,
                     "tpple_estado"   => 'ac',
                     "tpple_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevotpple($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editartpple(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tpple_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatetpple($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrartpple(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrartpple($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }    
     
//Config tipo corte litografia
public function nuevotclito(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_codigo"   => $id,
                     "tc_nombre"   => $nom,
                     "tc_estado"   => 'ac',
                     "tc_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevotclito($datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }         
        
public function editartclito(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updatetclito($id,$datos); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }  

public function borrartclito(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrartclito($id); 
              echo json_encode($conn);  
         }
         else{show_404();}
     }           
     
//Config Tipo Cortes
public function nuevoCorte(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_codigo"   => $id,
                     "tc_nombre"   => $nom,
                     "tc_estado"   => 'ac',
                     "tc_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte($datos); 
              echo json_encode($conn);  
         }
     }   
     
public function nuevoCorte_ani(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_ani_codigo"   => $id,
                     "tc_ani_nombre"   => $nom,
                     "tc_ani_estado"   => 'ac',
                     "tc_ani_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_ani($datos); 
              echo json_encode($conn);  
         }
     }    
public function nuevoCorte_bri(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_bri_codigo"   => $id,
                     "tc_bri_nombre"   => $nom,
                     "tc_bri_estado"   => 'ac',
                     "tc_bri_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_bri($datos); 
              echo json_encode($conn);  
         }
     }    
public function nuevoCorte_ensa(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_ensa_codigo"   => $id,
                     "tc_ensa_nombre"   => $nom,
                     "tc_ensa_estado"   => 'ac',
                     "tc_ensa_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_ensa($datos); 
              echo json_encode($conn);  
         }
     }  
public function nuevoCorte_esta(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_esta_codigo"   => $id,
                     "tc_esta_nombre"   => $nom,
                     "tc_esta_estado"   => 'ac',
                     "tc_esta_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_esta($datos); 
              echo json_encode($conn);  
         }
     } 
public function nuevoCorte_gra(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_gra_codigo"   => $id,
                     "tc_gra_nombre"   => $nom,
                     "tc_gra_estado"   => 'ac',
                     "tc_gra_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_gra($datos); 
              echo json_encode($conn);  
         }
     }  
public function nuevoCorte_inter(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_inter_codigo"   => $id,
                     "tc_inter_nombre"   => $nom,
                     "tc_inter_estado"   => 'ac',
                     "tc_inter_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_inter($datos); 
              echo json_encode($conn);  
         }
     }      
public function nuevoCorte_pega(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_pega_codigo"   => $id,
                     "tc_pega_nombre"   => $nom,
                     "tc_pega_estado"   => 'ac',
                     "tc_pega_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_pega($datos); 
              echo json_encode($conn);  
         }
     }
public function nuevoCorte_ple(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_ple_codigo"   => $id,
                     "tc_ple_nombre"   => $nom,
                     "tc_ple_estado"   => 'ac',
                     "tc_ple_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_ple($datos); 
              echo json_encode($conn);  
         }
     }  
public function nuevoCorte_pla(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "dim_codigo"   => $id,
                     "dim_nombre"   => $nom
                     );
             $conn=$this->guardar_model->nuevoCorte_pla($datos); 
              echo json_encode($conn);  
         }
     }      
public function nuevoCorte_plas(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_plas_codigo"   => $id,
                     "tc_plas_nombre"   => $nom,
                     "tc_plas_estado"   => 'ac',
                     "tc_plas_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_plas($datos); 
              echo json_encode($conn);  
         }
     }   
public function nuevoCorte_rep(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_rep_codigo"   => $id,
                     "tc_rep_nombre"   => $nom,
                     "tc_rep_estado"   => 'ac',
                     "tc_rep_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_rep($datos); 
              echo json_encode($conn);  
         }
     }            
public function nuevoCorte_tro(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("codigo");
             $nom      = $this->input->post("desc");  
             $fecha    = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_tro_codigo"   => $id,
                     "tc_tro_nombre"   => $nom,
                     "tc_tro_estado"   => 'ac',
                     "tc_tro_fecha"    => $fecha
                     );
             $conn=$this->guardar_model->nuevoCorte_tro($datos); 
              echo json_encode($conn);  
         }
     }      
public function editarCorte(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte($id,$datos); 
              echo json_encode($conn);  
         }
     }  

public function editarCorte_ani(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_ani_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_ani($id,$datos); 
              echo json_encode($conn);  
         }
     } 
public function editarCorte_bri(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_bri_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_bri($id,$datos); 
              echo json_encode($conn);  
         }
     }   
public function editarCorte_ensa(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_ensa_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_ensa($id,$datos); 
              echo json_encode($conn);  
         }
     }     
public function editarCorte_esta(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_esta_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_esta($id,$datos); 
              echo json_encode($conn);  
         }
     }      
public function editarCorte_gra(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_gra_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_gra($id,$datos); 
              echo json_encode($conn);  
         }
     } 
public function editarCorte_inter(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_inter_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_inter($id,$datos); 
              echo json_encode($conn);  
         }
     }      
public function editarCorte_pega(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_pega_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_pega($id,$datos); 
              echo json_encode($conn);  
         }
     } 
public function editarCorte_ple(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_ple_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_ple($id,$datos); 
              echo json_encode($conn);  
         }
     }      
public function editarCorte_pla(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "dim_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_pla($id,$datos); 
              echo json_encode($conn);  
         }
     }
public function editarCorte_plas(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_plas_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_plas($id,$datos); 
              echo json_encode($conn);  
         }
     }    
public function editarCorte_rep(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_rep_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_rep($id,$datos); 
              echo json_encode($conn);  
         }
     }      
public function editarCorte_tro(){  
         if ($this->input->is_ajax_request()) {
             date_default_timezone_set ('America/Bogota');
             $id       = $this->input->post("ucodigo");
             $nom      = $this->input->post("udesc");  
             $fecha      = date('Y-m-d H:i:s');
             $datos = array(
                     "tc_tro_nombre"         => $nom
                     );
             $conn=$this->guardar_model->updateCorte_tro($id,$datos); 
              echo json_encode($conn);  
         }
     }      
public function borrarCorte(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte($id); 
              echo json_encode($conn);  
         }
     }     
      
public function borrarCorte_ani(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_ani($id); 
              echo json_encode($conn);  
         }
     }    
public function borrarCorte_bri(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_bri($id); 
              echo json_encode($conn);  
         }
     }  
public function borrarCorte_ensa(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_ensa($id); 
              echo json_encode($conn);  
         }
     } 
public function borrarCorte_esta(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_esta($id); 
              echo json_encode($conn);  
         }
     } 
public function borrarCorte_gra(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_gra($id); 
              echo json_encode($conn);  
         }
     }     
public function borrarCorte_inter(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_inter($id); 
              echo json_encode($conn);  
         }
     }  
public function borrarCorte_pega(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_pega($id); 
              echo json_encode($conn);  
         }
     }   
public function borrarCorte_ple(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_ple($id); 
              echo json_encode($conn);  
         }
     }    
public function borrarCorte_pla(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_pla($id); 
              echo json_encode($conn);  
         }
     }  
public function borrarCorte_plas(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_plas($id); 
              echo json_encode($conn);  
         }
     }    
public function borrarCorte_rep(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_rep($id); 
              echo json_encode($conn);  
         }
     }      
public function borrarCorte_tro(){  
         if ($this->input->is_ajax_request()) {
             $id = $this->input->post("id");
             $conn=$this->guardar_model->borrarCorte_tro($id); 
              echo json_encode($conn);  
         }
     }      
}     
