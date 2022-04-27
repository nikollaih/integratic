<div>
    <div style="background-color:#33aaff;border-radius:10px;" class="d-flex justify-between align-items-center m-b-1">
        <h3 class="title-container-foros">Actividades</h3>
        <i class="fa fa-chevron-up open-section" data-section="actividades"></i>
    </div>
    <ul style="padding:0" class="section-actividades">
        <?php 
        if($actividades){
            foreach ($actividades as $a) { ?>
                <li class='item-foro' id="actividad-<?= $a["id_actividad"] ?>">
                    <div class="d-flex justify-between align-items-center">
                        <h4 class='titulo-foro' style="border-bottom:0;"><a  style="color:#33aaff;"><?= $a["titulo_actividad"] ?></a></h4>
                        <?php
                            $respuesta_actividad = respuestas_actividad($a["id_actividad"], logged_user()["id"]);
                            if(strtolower(logged_user()["rol"]) == "estudiante"){
                                if($a["disponible_hasta"] > date("Y-m-d H:i:s")){
                                    if($respuesta_actividad == false) {
                                        ?>
                                        <a href="javascript:subir();" class="crear-respuesta-boton d-flex align-items-center" data-actividad="<?= $a["id_actividad"] ?>" data-toggle="modal" data-target="#agregar-respuesta-actividad"> 
                                            <img src="./img/iconos/subir.png" width="32" height="32" alt="Subir Archivo" title="Subir Archivo">
                                            <p style="margin:0px 0PX 0PX 10PX;">Subir respuesta</p>
                                        </a>
                            <?php
                                        }
                                        else{
                                            echo "<div style='text-align:right;'><p class='m-0 label label-success'>Completada</p><p class='m-0'>Calificacion: (".$respuesta_actividad["calificacion"].")</p></div>";
                                        }
                                }
                                else{
                                    if($respuesta_actividad == false) {
                                        echo "<p class='m-0 label label-danger'>Actividad no disponible</p>";
                                    }
                                    else{
                                        echo "<div style='text-align:right;'><p class='m-0 label label-success'>Completada</p><p class='m-0'>Calificacion: (".$respuesta_actividad["calificacion"].")</p></div>";
                                    }
                                }
                            }

                            if(strtolower(logged_user()["rol"]) == "docente"){
                                ?>
                                    <div class="d-flex">
                                        <a style="margin-right: 10px;background: #2e9177;" href="<?= base_url() ?>Exports/exportarActividadNotas/<?= $a["id_actividad"] ?>" target="_blank" class="small-btn crear-respuesta-boton d-flex align-items-center cargar-respuestas-boton"> 
                                            <i class="fa fa-file"></i>
                                            <p style="margin:0px 0PX 0PX 7PX;">Exportar calificaciones</p>
                                        </a>
                                        <a style="background: #33aaff;cursor:pointer;" class="small-btn crear-respuesta-boton d-flex align-items-center cargar-respuestas-boton" data-actividad="<?= $a["id_actividad"] ?>" data-toggle="modal" data-target="#lista-respuesta-actividad"> 
                                            <i class="fa fa-eye"></i>
                                            <p style="margin:0px 0PX 0PX 7PX;">Calificar</p>
                                        </a>
                                        <a style="background: #ff5c5c;cursor:pointer;" class="small-btn d-flex align-items-center button-eliminar-actividad" data-actividad="<?= $a["id_actividad"] ?>"> 
                                            <i class="fa fa-trash"></i>
                                            <p style="margin:0px 0PX 0PX 7PX;">Eliminar</p>
                                        </a>
                                    </div>
                                <?php

                            }
                        ?>
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