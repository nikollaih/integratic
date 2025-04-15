<!-- ========== Left Sidebar Start ========== -->
<?php
$menuItems = [
    [
        "title" => "Volver",
        "icon" => "fa fa-arrow-left",
        "path" => 'javascript:history.back()'
    ],
    [
        "title" => "Lista pruebas",
        "icon" => "fa fa-file-circle-question",
        "path" => base_url()."Pruebas"
    ]
];

$menuDocente = [
    [
        "title" => "Crear prueba",
        "icon" => "fa fa-circle-plus",
        "path" => base_url()."Pruebas/crearPrueba"
    ],
    [
        "title" => "Lista preguntas",
        "icon" => "fa fa-circle-question",
        "path" => base_url()."PreguntasPrueba"
    ],
    [
        "title" => "Crear pregunta",
        "icon" => "fa fa-circle-plus",
        "path" => base_url()."PreguntasPrueba/crearPregunta"
    ],
    [
        "title" => "Temas",
        "icon" => "fa fa-tags",
        "path" => base_url()."Temas"
    ],
    [
        "title" => "Est. Simulacros",
        "icon" => "fa fa-chart-pie",
        "path" => base_url()."Simulacros"
    ],
];

$menuDepartamental = [
    [
        "title" => "Est. Municipios",
        "icon" => "fa fa-line-chart",
        "path" => base_url()."EstadisticasPruebas/municipios"
    ],
    [
        "title" => "Est. Areas",
        "icon" => "fa fa-chart-pie",
        "path" => base_url()."EstadisticasPruebas/areas/0"
    ],
    [
        "title" => "Importar participantes",
        "icon" => "fa fa-upload",
        "path" => base_url()."ParticipantesPrueba/importar"
    ],
]
?>
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
                    foreach ($menuItems as $item) { ?>
                        <li>
                            <a href="<?= $item["path"] ?>" class="menu-item-block">
                                <i class="<?= $item["icon"] ?>"></i>
                                <span><?= $item["title"] ?></span>
                            </a>
                        </li>
                   <?php }
                ?>
                <?php
                    if(strtolower(logged_user()["rol"]) == "docente"){
                        foreach ($menuDocente as $item) { ?>
                            <li>
                                <a href="<?= $item["path"] ?>" class="menu-item-block">
                                    <i class="<?= $item["icon"] ?>"></i>
                                    <span><?= $item["title"] ?></span>
                                </a>
                            </li>
                        <?php }
                        ?>
                            <?php
                                if(configuracion()["departamental"] == 1){
                                    foreach ($menuDepartamental as $item) { ?>
                                        <li>
                                            <a href="<?= $item["path"] ?>" class="menu-item-block">
                                                <i class="<?= $item["icon"] ?>"></i>
                                                <span><?= $item["title"] ?></span>
                                            </a>
                                        </li>
                                    <?php }
                                }
                                else { ?>
                                    <li>
                                        <a href="<?= base_url() ?>EstadisticasPruebas/ver" class="menu-item-block">
                                            <i class="fa fa-line-chart"></i>
                                            <span>Estadisticas</span>
                                        </a>
                                    </li>
                                <?php }
                    }
                ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>