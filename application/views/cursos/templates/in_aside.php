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
                <li>
                    <a href="javascript:history.back()" class="menu-item-block">
                        <i class="fa fa-arrow-left"></i>
                        <span>Volver</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>Cursos" class="menu-item-block">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Ver todos</span>
                    </a>
                </li>
                <?php
                    if(strtolower(logged_user()["rol"]) != "estudiante"){ ?>
                        <li>
                            <a href="<?= base_url() ?>Cursos/create" class="menu-item-block">
                                <i class="fa fa-circle-plus"></i>
                                <span>Nuevo</span>
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