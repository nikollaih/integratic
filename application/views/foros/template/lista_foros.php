<?php if($foros != false){ ?>
    <div>
        <h3 style="background: #718fc8;padding-left: 9px;font-size: 18px;color:#fff;">Foros</h3>
        <ul style="padding:0">
            <?php foreach ($foros as $foro) { ?>
                <li class='item-foro'>
                <h4 class='titulo-foro'><a href='javascript:ver_foro(".$foro["id_foro"].")'><?= $foro["titulo"] ?></a></h4>
                <p class='fecha-foro'><?= date("Y-m-d, h:i a", strtotime($foro["created_at"])) ?></h4>
                <p class='descripcion-foro'><?= $foro["descripcion"] ?></p>
                </li>
            <?php  } ?> 
        </ul>
    </div> 
<?php } ?>