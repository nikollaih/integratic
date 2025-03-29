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
                    <a href="<?= base_url() ?>" class="menu-item-block">
                        <i class="fa fa-arrow-left"></i>
                        <span>Volver</span>
                    </a>
                </li>
                <?php
                    if(strtolower(logged_user()["rol"]) == "docente"){ ?>
                        <li>
                            <a href="<?= base_url() ?>PlanAula" class="menu-item-block">
                                <i class="fa fa-file-lines"></i>
                                <span>Ver todos</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>PlanAula/create" class="menu-item-block">
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