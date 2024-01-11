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
                <li>
                    <a href="<?= base_url() ?>" class=" ">
                        <i><img src='<?= base_url() ?>img/iconos/volver.png' width="50" height="50" class="rounded-img"></i><span>Volver</span></a>
                </li>
                <li>
                            <a href="<?= base_url() ?>Cursos" class=" ">
                                <i><img src='<?= base_url() ?>img/iconos/cursos.jpeg' width="50" height="50" class="rounded-img"></i><span>Ver todos</span>
                            </a>
                        </li>  
                <?php
                    if(strtolower(logged_user()["rol"]) != "estudiante"){ ?>
                        <li>
                            <a href="<?= base_url() ?>Cursos/create" class=" ">
                                <i><img src='<?= base_url() ?>img/iconos/nuevo_plan_aula.jpeg' width="50" height="50" class="rounded-img"></i><span>Nuevo</span>
                            </a>
                        </li>   
                    <?php }
                ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>