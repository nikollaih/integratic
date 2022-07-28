<?php
    $estudiantes_habilitados = ($actividad["estudiantes_habilitados"]) ? unserialize($actividad["estudiantes_habilitados"]) : [];
    foreach ($estudiantes as $e) {
?>
        <tr>
            <td><?= $e["documento"] ?></td>
            <td><?= $e["nombre"] ?></td>
            <td><?= ($e["respuesta"] != null) ? date("d M, Y h:i a", strtotime($e["respuesta"]["created_at"])) : "" ?></td>
            <td><?= ($e["respuesta"] != null) ? $e["respuesta"]["estudiante_notas"] : "" ?></td>
            <td class="text-center">
                <?= ($e["respuesta"] != null) ? "<a href='".base_url()."uploads/actividades/respuestas/".$e["respuesta"]["url_archivo"]."' target='_blank'>Ver</a>" : "" ?>
            </td>
            <td class="text-center" style="width:60px;"><?= ($e["respuesta"] != null) ? '<input id="calificacion-respuesta-'.$e["respuesta"]["id_respuestas_actividades"].'" readonly="readonly" class="input no-calificar text-center" type="number" value="'.$e["respuesta"]["calificacion"] .'"/>' : "1" ?></td>
            <td class="text-center">
                <?= ($e["respuesta"] != null) ? '<button data-id="'.$e["respuesta"]["id_respuestas_actividades"].'" id="btn-modificar-calificacion-'.$e["respuesta"]["id_respuestas_actividades"].'" class="btn btn-warning btn-calificar btn-sm">Modificar calificación</button><button data-id="'.$e["respuesta"]["id_respuestas_actividades"].'" style="display:none;" id="btn-guardar-calificacion-'.$e["respuesta"]["id_respuestas_actividades"].'" class="btn btn-primary btn-guardar-calificar btn-sm">Guardar</button>': "" ?>
                <?= ($e["respuesta"] != null) ? '<button data-actividad="'.$e["respuesta"]["id_actividad"].'" data-id="'.$e["respuesta"]["id_respuestas_actividades"].'" id="btn-eliminar-respuesta-actividad-'.$e["respuesta"]["id_respuestas_actividades"].'" class="btn btn-danger btn-eliminar-respuesta-actividad btn-sm">Eliminar</button>': "" ?>
               <?php
                if($e["respuesta"] == null){
                    if(in_array($e["documento"], $estudiantes_habilitados)){
                        if(($e["respuesta"] == null)){
                        ?>
                            <button data-actividad="<?= $actividad["id_actividad"] ?>" data-estudiante="<?= $e["documento"] ?>" class="btn btn-danger btn-inhabilitar-actividad btn-sm">Inhabilitar</button>
                        <?php
                        }
                    }
                    else{ 
                        ?>
                            <button data-actividad="<?= $actividad["id_actividad"] ?>" data-estudiante="<?= $e["documento"] ?>" class="btn btn-primary btn-habilitar-actividad btn-sm">Habilitar</button>
                        <?php
                    }
                }
               ?>
            </td> 
        </tr>
<?php
    }
?>