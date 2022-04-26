<div style="background-color:#ff9133;border-radius:10px;" class="d-flex justify-between align-items-center m-b-1">
    <h3 class="title-container-foros">Foros</h3>
    <i class="fa fa-chevron-up open-section" data-section="foros"></i>
</div>
<?php if($foros != false){ ?>
    <div>
        <ul style="padding:0" class="section-foros">
            <?php foreach ($foros as $foro) { 
                    $disponible = ((date("Y-m-d H:i") >= date("Y-m-d H:i", strtotime($foro["disponible_desde"]))) && (date("Y-m-d H:i") <= date("Y-m-d H:i", strtotime($foro["disponible_hasta"])))) ? true : false;
                ?>
                <li style="opacity: <?= ($disponible) ? 1 : 0.5 ?>;" class='item-foro'>
                    <h4 class='titulo-foro'><a href='<?= ($disponible) ? "javascript:ver_foro(".$foro['id_foro'].")" : "#" ?>'><?= $foro["titulo"] ?></a></h4>
                    <?php
                        if(!$disponible){
                            ?>
                                <p class='fecha-foro'>Disponible desde: <?= date("d/m/Y g:i a", strtotime($foro["disponible_desde"])) ?> - Hasta: <?= date("d/m/Y g:i a", strtotime($foro["disponible_hasta"])) ?></h4>
                            <?php
                        }
                    ?>
                    <p class='descripcion-foro'><?= $foro["descripcion"] ?></p>
                </li>
            <?php  } ?> 
        </ul>
    </div> 
<?php } ?>