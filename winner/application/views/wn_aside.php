
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- Sidebar Menu -->
     <?php  
     if($_SESSION['rol']!='OP'){              
     ?>
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/tablero')"><i class="fa fa-link"></i><span>Tablero</span></a></li>
        <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cliente')"><i class="fa fa-link"></i><span>Clientes</span></a></li>
        <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/proveedor')"><i class="fa fa-link"></i><span>Proveedores</span></a></li>        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Ordenes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/ordenes')">Nueva Orden</a></li> 
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/ordenes_priorizar')">Priorizar Orden</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/consulta_orden')">Consultar Orden</a></li>             
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/ordenes_traza')">Seguimiento Orden</a></li> 
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/ordenes_visor')">Visor de Producción</a></li> 
          </ul>
        </li> 
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Seguridad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_persona')">Personal</a></li>  
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_roles')">Roles</a></li>  
          </ul>
        </li>        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Configuración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_ciudad')">Ciudades</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tintas')">Tintas</a></li>  
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_colores')">Colores</a></li>              
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_brillo')">Brillo UV</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_troquel')">Troquelado</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_plasti')">Plastificados</a></li>                       
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tpapel')">Tipos de Papel</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_colani')">Color de Anillo</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tiras')">Tiras de Anillo</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_colestampa')">Color Estampado</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_cinta')">Cinta Estampado</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tpres')">Papel Respaldo</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_grapa')">Tipo Grapado</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tpple')">Tipo Papel plegado</a></li>
          </ul>       
        </li>     
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Tamaño Cortes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tclito')">Litografía</a></li>  
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_ani')">Anillado</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_bri')">Brillo</a></li>  
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_ensa')">Ensanduchado</a></li>              
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_esta')">Estampado</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_gra')">Grapado</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_inter')">Intercalado</a></li>                       
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_pega')">Pegado al Calor</a></li>            
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tplancha')">Planchas</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_plas')">Plastificado</a></li> 
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_ple')">Plegado</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_repu')">Repujado</a></li>  
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/cfg_tc_tro')">Troquelado</a></li>
          </ul>       
        </li>          
      </ul>
     <?php } 
     else {
     ?>
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>
        <!-- Optionally, you can add icons to the links -->        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Ordenes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">         
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/consulta_orden')">Consultar Orden</a></li>
            <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/ordenes_asig')">Seguimiento Orden</a></li> 
          </ul>
        </li>                     
      </ul>
     <?php } ?>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
<script>
    function intext(div,op){
        $.ajax({
              type: "POST",
              url: op,
              success: function(a) {
                  $(div).html('');
                  $(div).html(a);
              }
         });   
    }      
</script>