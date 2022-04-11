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
                    <a href="<?= base_url() ?>" class="waves-effect">
                        <i><img src='<?= base_url() ?>img/iconos/volver.png' width="50" height="50"></i><span>Volver</span></a>
                </li>
                <li>
                    <a href="<?= base_url() ?>Pruebas" class="waves-effect">
                        <i><img src='<?= base_url() ?>img/iconos/lista_pruebas.png' width="50" height="50"></i><span>Lista pruebas</span></a>
                </li>   
                <?php
                    if(strtolower(logged_user()["rol"]) == "docente"){ 
                        ?>
                            <li>
                                <a href="<?= base_url() ?>PreguntasPrueba" class="waves-effect">
                                    <i><img src='<?= base_url() ?>img/iconos/lista_preguntas.png' width="50" height="50"></i><span>Lista preguntas</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>PreguntasPrueba/crearPregunta">
                                    <i><img src='<?= base_url() ?>img/iconos/crear_pregunta.png' width="50" height="50"></i><span>Crear pregunta</span></a>
                            </li>             
                            <li>
                                <a href="<?= base_url() ?>Pruebas/crearPrueba">
                                    <i><img src='<?= base_url() ?>img/iconos/crear_prueba.png' width="50" height="50"></i><span>Crear prueba</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>EstadisticasPruebas/ver">
                                    <i><img src='<?= base_url() ?>img/iconos/estadisticas.png' width="50" height="50"></i><span>Estadisticas</span></a>
                            </li>
                        <?php
                    }
                ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>