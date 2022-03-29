<div style="background-color:#ff9133;border-radius:10px;" class="d-flex justify-between align-items-center m-b-1">
    <h3 class="title-container-foros">Foros</h3>
    <i class="fa fa-chevron-up open-section" data-section="foros"></i>
</div>
<?php if($foros != false){ ?>
    <div>
        <ul style="padding:0" class="section-foros">
            <?php foreach ($foros as $foro) { ?>
                <li class='item-foro'>
                <h4 class='titulo-foro'><a href='javascript:ver_foro(<?= $foro["id_foro"] ?>)'><?= $foro["titulo"] ?></a></h4>
                <p class='fecha-foro'><?= date("F j, Y g:i a", strtotime($foro["created_at"])) ?></h4>
                <p class='descripcion-foro'><?= $foro["descripcion"] ?></p>
                </li>
            <?php  } ?> 
        </ul>
    </div> 
<?php } ?>