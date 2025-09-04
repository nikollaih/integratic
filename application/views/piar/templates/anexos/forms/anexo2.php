

     <?php
        if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador" || strtolower(logged_user()["rol"]) == "orientador"){
            ?>
            <form id="form-create-piar-2" action="" method="post" class="form-anexo-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="richtext-entorno">Entorno personal</label>
                            <textarea name="entorno_personal" id="richtext-entorno" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="richtext-descripcion-general">Descripción general del estudiante con énfasis en gustos e intereses o aspectos que le desagradan,
                                expectativas del estudiante y la familia</label>
                            <textarea name="descripcion_general" id="richtext-descripcion-general" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="richtext-descripcion-que-hace">Descripción en términos de lo que hace, puede hacer o requiere apoyo el estudiante para favorecer su proceso
                                educativo. Indique las habilidades, competencias, cualidades, aprendizajes con las que cuenta el estudiante
                                para el grado en el que fue matriculado.</label>
                            <textarea name="descripcion_que_hace" id="richtext-descripcion-que-hace" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="">Recomendaciones para el plan de mejoramiento institucional para la eliminación de barreras y la
                            creación de procesos para la participación, el aprendizaje y el progreso de los estudiantes:</label>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td style="width: 200px"><strong>ACTORES</strong></td>
                                <td><strong>ACCIONES</strong></td>
                                <td><strong>ESTRATEGIAS A IMPLEMENTAR</strong></td>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td><strong>FAMILIA, CUIDADORES O
                                        CON QUIENES VIVE</strong></td>
                                <td>
                                <textarea class="form-control" placeholder="Escribir aqui..." name="acciones_familia"><?= !empty($estudiante["acciones_familia"])
                                        ? $estudiante["acciones_familia"]
                                        : "- Participar activamente en las reuniones de seguimiento.\n- Establecer rutinas en casa que refuercen hábitos escolares.\n- Reportar avances y dificultades del estudiante." ?></textarea>
                                </td>
                                <td>
                              <textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_familia"><?= !empty($estudiante["estrategias_familia"]) ? $estudiante["estrategias_familia"] :
                                      "- Escuela para padres sobre inclusión, neurodiversidad y apoyo en casa.\n" .
                                      "- Guía de apoyo con pictogramas o agendas visuales.\n" .
                                      "- Comunicación constante con el colegio (cuaderno viajero o grupos de WhatsApp)."
                                  ?> </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>DOCENTES</strong></td>
                                <td>
                                    <textarea class="form-control" placeholder="Escribir aqui..." name="acciones_docentes"><?= !empty($estudiante["acciones_docentes"]) ? $estudiante["acciones_docentes"] : "- Implementar ajustes razonables en el aula (tiempo extra, instrucciones visuales, recursos multisensoriales).\n- Adaptar evaluaciones.\n- Aplicar estrategias de enseñanza diferenciada." ?></textarea>
                                </td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_docentes"><?= trim(!empty($estudiante["estrategias_docentes"]) ? $estudiante["estrategias_docentes"] : "- Capacitación en Diseño Universal para el Aprendizaje (DUA) y educación inclusiva.\n- Co-docencia con apoyo del orientador o docente de apoyo.\n- Uso de TIC accesibles.") ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>DIRECTIVOS</strong></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="acciones_directivos"><?= trim(!empty($estudiante["acciones_directivos"]) ? $estudiante["acciones_directivos"] : "- Asegurar la implementación de los PIAR.\n- Promover espacios de formación permanente.\n- Garantizar recursos y tiempos para la inclusión") ?></textarea></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_directivos"><?= trim(!empty($estudiante["estrategias_directivos"]) ? $estudiante["estrategias_directivos"] : "- Crear un comité de inclusión escolar.\n- Incluir en el PEI objetivos de inclusión y seguimiento.\n- Facilitar tiempos de coordinación docente.") ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>ADMINISTRATIVOS</strong></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="acciones_administrativos"><?= trim(!empty($estudiante["acciones_administrativos"]) ? $estudiante["acciones_administrativos"] : "- Brindar atención adecuada a estudiantes con necesidades específicas (por ejemplo, facilitar acceso físico o atención en recepción).\n- Apoyar la gestión de recursos.") ?></textarea></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_administrativos"><?= trim(!empty($estudiante["estrategias_administrativos"]) ? $estudiante["estrategias_administrativos"] : "- Señalización accesible.\n- Capacitación básica en trato inclusivo y comunicación alternativa.\n- Protocolos de atención inclusiva.") ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>PARES</strong></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="acciones_companeros"><?= trim(!empty($estudiante["acciones_companeros"]) ? $estudiante["acciones_companeros"] : "- Fomentar la convivencia y apoyo mutuo.\n- Participar en actividades inclusivas y cooperativas.") ?></textarea></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_companeros"><?= trim(!empty($estudiante["estrategias_companeros"]) ? $estudiante["estrategias_companeros"] : "- Programa de tutoría entre pares.\n- Proyectos de aula sobre empatía y diversidad.\n- Campañas de sensibilización y prevención del bullying.") ?></textarea></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row text-end" style="text-align:right;">
                    <div class="col-md-12 text-end">
                        <hr>
                        <button type="submit" class="btn btn-primary">Guardar anexo 2</button>
                    </div>
                </div>
            </form>

      <?php
        }
 ?>


<?php $this->load->view('piar/templates/piar_row_form'); ?>

    <!-- ITEMS DEL PIAR -->
<?php
if((strtolower(logged_user()["rol"]) === "docente" || strtolower(logged_user()["rol"]) === "docente de apoyo" || strtolower(logged_user()["rol"]) === "coordinador" || strtolower(logged_user()["rol"]) === "orientador") && isset($estudiante["id_piar"])) {
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading "><b>Items del P.I.A.R.</b></div>
        <div class="panel-body">
            <div class="row text-end">
                <div class="col-md-12 text-end">
                    <div class="row">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ÁREA/ASIGNATURA</th>
                                <th>OBJETIVOS/PROPÓSITOS</th>
                                <th>BARRERAS </th>
                                <th>AJUSTES RAZONABLES</th>
                                <th>EVALUACIÓN DE LOS AJUSTES</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($item_piar) && is_array($items_piar)){
                                foreach($items_piar as $item){
                                    if($item["id_docente"] == logged_user()["id"]){
                                        ?>
                                        <tr id="piar-item-<?= $item["id_piar_item"] ?>">
                                            <td><?= $item["nomarea"] ?? "Otras" ?></td>
                                            <td>
                                                <?php
                                                if(isset($item["nomarea"])){
                                                    if (strpos($item["objetivos"], 'a:2:') === 0) {
                                                        $objetivos = unserialize($item["objetivos"]);

                                                        if (!empty($objetivos['dbas']) && is_array($objetivos['dbas'])) {
                                                            foreach ($objetivos['dbas'] as $dba_id) {
                                                                // Buscar el dba correspondiente por ID
                                                                foreach ($item["dbas"] as $dba) {
                                                                    // Si $dba es un objeto
                                                                    if (is_array($dba) && $dba['id_dba'] == $dba_id) {
                                                                        echo "<div>- {$dba['descripcion_dba']}</div><br>";
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        // Mostrar observaciones, si existen
                                                        if (!empty($objetivos['observaciones'])) {
                                                            echo "<div><strong>Observaciones:</strong> {$objetivos['observaciones']}</div>";
                                                        }

                                                    } else {
                                                        echo $item["objetivos"];
                                                    }
                                                }
                                                else {
                                                    echo $item["nommateria"];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($item["barreras_seleccionadas"]) && strpos($item["barreras"], 'a:') === 0 && is_array($item["barreras_seleccionadas"])) {
                                                    foreach ($item["barreras_seleccionadas"] as $barrera) {
                                                        echo "<div>- {$barrera->descripcion}</div><br>";
                                                    }
                                                }
                                                else {
                                                    echo $item["barreras"];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($item["ajustes_razonables_seleccionados"]) && strpos($item["ajustes_razonables"], 'a:') === 0 && is_array($item["ajustes_razonables_seleccionados"])) {
                                                    foreach ($item["ajustes_razonables_seleccionados"] as $ajusteRazonable) {
                                                        echo "<div>- {$ajusteRazonable->descripcion}</div><br>";
                                                    }
                                                }
                                                else {
                                                    echo $item["ajustes_razonables"];
                                                }
                                                ?>
                                            </td>
                                            <td><?= $item["evaluacion"] ?></td>
                                            <td>
                                                <a href="<?= base_url() ?>PIAR/edit/<?= $estudiante["id_piar"].'/'.$item["id_piar_item"] ?>">Modificar</a>
                                                <span data-id="<?= $item["id_piar_item"] ?>" class="btn-delete-piar-item text-danger cursor-pointer">Eliminar</span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>