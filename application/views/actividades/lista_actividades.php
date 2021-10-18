<div>
    <h3 class="title-container-foros" style="background-color:#33aaff;">Actividades</h3>
    <ul style="padding:0">
        <?php 
        if($actividades){
            foreach ($actividades as $a) { ?>
                <li class='item-foro'>
                    <div class="d-flex">
                        <h4 class='titulo-foro'><a  style="color:#33aaff;"><?= $a["titulo_actividad"] ?></a></h4>
                        <a href="javascript:subir();"> 
                                    <img src="./img/iconos/subir.png" width="32" height="32" alt="Subir Archivo" title="Subir Archivo">
                                    <label for="">Subir respuesta</label>
                                </a>
                    </div>
                    <p class='fecha-foro'> Disponible hasta: <?= date("F j, Y g:i a", strtotime($a["disponible_hasta"])) ?></p>
                    <p class='descripcion-foro'><?= $a["descripcion_actividad"] ?></p>
                    <?php
                        if($a["url_archivo"]){
                    ?>
                        <br>
                        <a style="margin-top: 10px;" target="_blank" href="<?= base_url() ?>uploads/actividades/<?= $a["url_archivo"] ?>">
                            <?= document_icon(get_file_format($a["url_archivo"]), $a["nombre_archivo"]) ?>
                        </a>
                    <?php
                        }
                    ?>
                </li>
            <?php  }
        }
        ?> 
    </ul>
</div> 