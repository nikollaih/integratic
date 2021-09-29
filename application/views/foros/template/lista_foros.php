<?php if($foros != false){ ?>
    <div>
        <h3 class="title-container-foros">Foros</h3>
        <ul style="padding:0">
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