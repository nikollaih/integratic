<div style="background-color:#ff9133;border-radius:10px;" class="d-flex justify-between align-items-center m-b-1">
    <h3 class="title-container-foros">Foros</h3>
    <i class="fa fa-chevron-up open-section" data-section="foros"></i>
</div>
<?php if($foros != false){ ?>
    <div>
        <ul style="padding:0" class="section-foros">
            <?php foreach ($foros as $foro) { 
                    $disponible = ((strtolower(logged_user()["rol"] != "estudiante") || (date("Y-m-d H:i") >= date("Y-m-d H:i", strtotime($foro["disponible_desde"]))) && (date("Y-m-d H:i") <= date("Y-m-d H:i", strtotime($foro["disponible_hasta"]))))) ? true : false;
                ?>
                <li class='item-foro' id="foro-<?= $foro["id_foro"] ?>">
                    <div style="border-bottom: 1px solid #efefef;" class="d-flex justify-between align-items-center">
                        <h4 style="opacity: <?= ($disponible) ? 1 : 0.5 ?>;border-bottom: 0;" class='titulo-foro'><a <?= ($disponible) ? 'href=javascript:ver_foro('.$foro["id_foro"].')' : '' ?>><?= $foro["titulo"] ?></a></h4>
                        <div class="d-flex">
                            <?php
                                if(!$disponible){
                                    ?>
                                        <a style="background: #ff9133;cursor:pointer;" class="small-btn d-flex align-items-center" > 
                                            <i class="fa fa-calendar"></i>
                                            <p style="margin:0px 0PX 0PX 7PX;">No disponible</p>
                                        </a>
                                    <?php
                                }
                            ?>
                            <?php
                                if($foro["created_by"] == logged_user()["id"]){
                                    ?>
                                        <a style="background: #ff5c5c;cursor:pointer;" class="small-btn d-flex align-items-center button-eliminar-foro" data-foro="<?= $foro["id_foro"] ?>"> 
                                            <i class="fa fa-trash"></i>
                                            <p style="margin:0px 0PX 0PX 7PX;">Eliminar</p>
                                        </a>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                        if(!$disponible){
                            ?>
                                <p class='fecha-foro m-t-1'>Disponible desde: <?= date("d/m/Y g:i a", strtotime($foro["disponible_desde"])) ?> - Hasta: <?= date("d/m/Y g:i a", strtotime($foro["disponible_hasta"])) ?></h4>
                            <?php
                        }
                    ?>
                    <p class='descripcion-foro'><?= $foro["descripcion"] ?></p>
                </li>
            <?php  } ?> 
        </ul>
    </div> 
<?php } ?>