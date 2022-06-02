<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="<?= base_url() ?>img/<?= (configuracion()) ? configuracion()["logo_institucion"] : "" ?>" alt="<?= (configuracion()) ? configuracion()["nombre_institucion"] : "Logo" ?>" class="thumb-lg">
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <?php
                    if(is_logged()){
                        if(strtolower(logged_user()["rol"]) == "super"){
                            ?>
                                <li>
                                    <a href='<?= base_url() ?>'>
                                        <i><img src='<?= base_url() ?>img/iconos/menu.png' width='50' height='50'></i><span>Menú<br>Principal</span>
                                    </a>
                                </li>                      
                                <li>
                                    <a href='./principal/manuales/manual_integra.pdf' target='_blank'>
                                        <i><img src='<?= base_url() ?>img/iconos/manual.png' width='50' height='50'></i><span>Manual<br> Usuario</span>
                                    </a>
                                </li>       
                                <li>
                                    <a href='<?= base_url() ?>Usuarios/logout' onclick='javascript:logout()'>
                                        <i><img src='<?= base_url() ?>img/iconos/cerrar.png' width='50' height='50'></i><span>Cerrar<br> Sesión</span>
                                    </a>
                                </li>   
                            <?php
                        }

                        if(strtolower(logged_user()["rol"]) == "docente"){
                            ?>
                                <li>
                                    <a href='<?= base_url() ?>'>
                                        <i><img src='<?= base_url() ?>img/iconos/volver.png' width='50' height='50'></i><span>Volver</span>
                                    </a>
                                </li>  
                            <?php
                        }
                    }
                    else{
                        ?>
                        <li>
                            <a href="javascript:prelogin();" class="waves-effect">
                                <i><img src='<?= base_url() ?>img/iconos/login.png' width="50" height="50"></i><span>Ingresar</span></a>
                        </li>   
                        <li>
                            <a href="javascript:menu();" class="waves-effect">
                                <i><img src='<?= base_url() ?>img/iconos/aplicativos.png' width="50" height="50"></i><span>Aplicativos</span></a>
                        </li>                         
                        <!--<li>
                            <a href="./principal/aprender" target='_blank'>
                                <i><img src='<?= base_url() ?>img/iconos/aprender.png' width="50" height="50"></i><span>Aprender</span></a>
                        </li>-->
                        <!-- <li>
                            <a href="javascript:areas();" class="waves-effect">
                                <i><img src='<?= base_url() ?>img/iconos/areas.png' width="50" height="50"></i><span>Areas</span></a>
                        </li>
                        <li>
                            <a href="javascript:subir_acti();" class="waves-effect">
                                <i><img src='<?= base_url() ?>img/iconos/cargar.png' width="50" height="50"></i><span>Subir<br>Actividades</span></a>
                        </li>               
                        <li>
                            <a href="../moodle" class="waves-effect" target='_blank'>
                                <i><img src='<?= base_url() ?>img/iconos/moodle.png' width="50" height="50"></i><span> Moodle </span></a>
                        </li>
                        <li>
                            <a href="./principal/project" class="waves-effect" target='_blank'>
                                <i><img src='<?= base_url() ?>img/iconos/claseweb.ico' width="50" height="50"></i><span>ClaseWeb</span></a>
                        </li>-->  
                        <?php
                    }
                ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End --> 
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