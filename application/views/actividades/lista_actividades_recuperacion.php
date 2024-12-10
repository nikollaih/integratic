<div>
    <div style="background-color:#33b86c;border-radius:10px;" class="d-flex justify-between align-items-center m-b-1">
        <h3 class="title-container-foros">Actividades de recuperación</h3>
        <i class="fa fa-chevron-up open-section" data-section="recuperacion"></i>
    </div>
    <ul style="padding:0" class="section-recuperacion">
        <?php
        if($actividades){
            foreach ($actividades as $a) {
                if($a["es_recuperacion"] === "1"){
                ?>
                <li class='item-foro' id="actividad-<?= $a["id_actividad"] ?>">
                    <div class="d-flex justify-between align-items-center">
                        <h4 class='titulo-foro' style="border-bottom:0;margin:0;"><a  style="color:#33aaff;"><?= $a["titulo_actividad"] ?></a></h4>
                        <div class="text-right">
                            <p class="m-0 label label-primary">Periodo: <?= $a["periodo"] ?></p>
                            <?= $a["es_recuperacion"] === "1" ? '<p class="m-0 label label-success">Recuperación</p>' : '' ?>
                            <?php
                                $respuesta_actividad = respuestas_actividad($a["id_actividad"], logged_user()["id"]);
                                $estudiantes_habilitados = ($a["estudiantes_habilitados"]) ? unserialize($a["estudiantes_habilitados"]) : [];
                                if(strtolower(logged_user()["rol"]) == "estudiante"){
                                    if(($a["disponible_hasta"] > date("Y-m-d H:i:s")) || in_array(logged_user()["id"], $estudiantes_habilitados)){
                                        if($respuesta_actividad == false || ($respuesta_actividad == false && in_array(logged_user()["id"], $estudiantes_habilitados))) {
                                            ?>
                                            <a href="javascript:subir();" class="crear-respuesta-boton d-flex align-items-center" data-actividad="<?= $a["id_actividad"] ?>" data-toggle="modal" data-target="#agregar-respuesta-actividad">
                                                <img src="./img/iconos/subir_archivo.png" width="32" height="32" alt="Subir Archivo" title="Subir Archivo">
                                                <p style="margin:0px 0PX 0PX 10PX;">Subir respuesta</p>
                                            </a>
                                            <?php
                                        }
                                        else{
                                            echo "<p class='m-0 label label-success'>Completada</p><p title='".$respuesta_actividad["docente_notas"]."' class='m-0 pointer'><i onclick='alert(`Notas del docente:\n\n".$respuesta_actividad["docente_notas"]."`)' class='fas fa fa-solid fa-clipboard text-primary'></i> Calificacion: ".$respuesta_actividad["calificacion"]."</p>";
                                        }
                                    }
                                    else{
                                        if($respuesta_actividad == false) {
                                            echo "<p class='m-0 label label-danger'>Actividad no disponible</p>";
                                        }
                                        else{
                                            echo "<p class='m-0 label label-success'>Completada</p><p title='".$respuesta_actividad["docente_notas"]."' class='m-0 pointer'><i onclick='alert(`Notas del docente:\n\n".$respuesta_actividad["docente_notas"]."`)' class='fas fa fa-solid fa-clipboard text-primary'></i> Calificacion: ".$respuesta_actividad["calificacion"]."</p>";
                                        }
                                    }
                                }

                                if(strtolower(logged_user()["rol"]) == "docente"){
                                    ?>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-transparent dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item pointer text-dark" href="<?= base_url() ?>Exports/exportarActividadNotas/<?= $a["id_actividad"] ?>"><i class="fa fa-file"></i> Exportar calificaciones</a>
                                                <a class="dropdown-item cargar-respuestas-boton crear-respuestas-boton text-dark pointer" data-actividad="<?= $a["id_actividad"] ?>" data-toggle="modal" data-target="#lista-respuesta-actividad"><i class="fa fa-eye"></i> Calificar</a>
                                                <a class="dropdown-item button-editar-actividad pointer text-dark" data-actividad="<?= $a["id_actividad"] ?>"><i class="fa fa-edit"></i> Modificar</a>
                                                <div class="dropdown-divider"></div>
                                                <a data-actividad="<?= $a["id_actividad"] ?>" class="pointer dropdown-item button-eliminar-actividad text-danger"><i class="fa fa-trash"></i> Eliminar</a>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <p class='fecha-foro'> Disponible desde: <?= date("Y-m-d g:i a", strtotime($a["disponible_desde"])) ?> hasta: <?= date("Y-m-d g:i a", strtotime($a["disponible_hasta"])) ?></p>
                    <div class='descripcion-foro m-t-2'><?= $a["descripcion_actividad"] ?></div>
                    <?php
                        if($a["url_archivo"]){
                    ?>
                        <br>
                        <div>
                            <a style="margin-top: 10px;" target="_blank" href="<?= base_url() ?>uploads/actividades/<?= $a["url_archivo"] ?>">
                                <?= document_icon(get_file_format($a["url_archivo"]), $a["nombre_archivo"]) ?>
                            </a>
                        </div>
                    <?php
                        }
                    ?>
                </li>
            <?php  }
            }
        }
        ?>
    </ul>
</div>