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
                        <i><img src='<?= base_url() ?>img/iconos/volver.png' width="50" height="50"></i><span>Volver</span></a>
                </li>
                <li>
                    <a href="<?= base_url() ?>PlanAula" class=" ">
                        <i><img src='<?= base_url() ?>img/iconos/lista_pruebas.png' width="50" height="50"></i><span>Ver todos</span></a>
                </li>   
                <li>
                    <a href="<?= base_url() ?>PlanAula/create" class=" ">
                        <i><img src='<?= base_url() ?>img/iconos/lista_pruebas.png' width="50" height="50"></i><span>Nuevo</span></a>
                </li>   
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>