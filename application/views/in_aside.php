<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <a href="<?= base_url() ?>">
                    <img src="<?= base_url() ?>img/<?= (configuracion()) ? configuracion()["logo_institucion"] : "" ?>" alt="<?= (configuracion()) ? configuracion()["nombre_institucion"] : "Logo" ?>" class="thumb-lg">
                </a>
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
                                    <a href="<?= base_url() ?>" class="menu-item-block">
                                        <i class="fa fa-bars"></i>
                                        <span>Menú principal</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="./principal/manuales/manual_integra.pdf" class="menu-item-block" target="_blank">
                                        <i class="fa fa-book"></i>
                                        <span>Manual usuario</span>
                                    </a>
                                </li>
                                <li>
                                    <a href='<?= base_url() ?>Usuarios/logout' onclick='javascript:logout()' class="menu-item-block">
                                        <i class="fa fa-close"></i>
                                        <span>Cerrar sesión</span>
                                    </a>
                                </li>
                            <?php
                        }

                        if(strtolower(logged_user()["rol"]) == "docente" || strtolower(logged_user()["rol"]) == "coordinador" || strtolower(logged_user()["rol"]) == "orientador" || strtolower(logged_user()["rol"]) == "docente de apoyo"){
                            ?>
                            <li>
                                <a href="javascript:history.back()" class="menu-item-block">
                                    <i class="fa fa-arrow-left"></i>
                                    <span>Volver</span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <li>
                            <a href="javascript:prelogin();" class="menu-item-block">
                                <i class="fa fa-right-to-bracket"></i>
                                <span>Ingresar</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:menu();" class="menu-item-block">
                                <i class="fa fa-home"></i>
                                <span>Aplicativos</span>
                            </a>
                        </li>
                        <!--<li>
                            <a href="./principal/aprender" target='_blank'>
                                <i><img src='<?= base_url() ?>img/iconos/aprender.png' width="50" height="50"></i><span>Aprender</span></a>
                        </li>-->
                        <!-- <li>
                            <a href="javascript:areas();" class=" ">
                                <i><img src='<?= base_url() ?>img/iconos/areas.png' width="50" height="50"></i><span>Areas</span></a>
                        </li>
                        <li>
                            <a href="javascript:subir_acti();" class=" ">
                                <i><img src='<?= base_url() ?>img/iconos/cargar.png' width="50" height="50"></i><span>Subir<br>Actividades</span></a>
                        </li>               
                        <li>
                            <a href="../moodle" class=" " target='_blank'>
                                <i><img src='<?= base_url() ?>img/iconos/moodle.png' width="50" height="50"></i><span> Moodle </span></a>
                        </li>
                        <li>
                            <a href="./principal/project" class=" " target='_blank'>
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