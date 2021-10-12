<div>
    <h3 class="title-container-foros" style="background-color:#33aaff;">Actividades</h3>
    <ul style="padding:0">
        <?php 
        if($actividades){
            foreach ($actividades as $a) { ?>
                <li class='item-foro'>
                <h4 class='titulo-foro'><a  style="color:#33aaff;" href='javascript:ver_foro(<?= $a["id_actividad"] ?>)'><?= $a["titulo_actividad"] ?></a></h4>
                <p class='fecha-foro'> Disponible hasta: <?= date("F j, Y g:i a", strtotime($a["disponible_hasta"])) ?></p>
                <p class='descripcion-foro'><?= $a["descripcion_actividad"] ?></p>
                </li>
            <?php  }
        }
        ?> 
    </ul>
</div> 