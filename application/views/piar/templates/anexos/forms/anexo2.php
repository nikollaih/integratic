

     <?php
        if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador"){
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

                <div class="row text-end" style="text-align:right;">
                    <div class="col-md-12 text-end">
                        <hr>
                        <button type="submit" class="btn btn-primary">Guardar Anexo 2</button>
                    </div>
                </div>
            </form>

      <?php
        }
 ?>


<?php $this->load->view('piar/templates/piar_row_form'); ?>

    <!-- ITEMS DEL PIAR -->
<?php
if((strtolower(logged_user()["rol"]) === "docente" || strtolower(logged_user()["rol"]) === "docente de apoyo" || strtolower(logged_user()["rol"]) === "coordinador") && isset($estudiante["id_piar"])) {
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading text-capitalize"><b>ITEMS DEL P.I.A.R.</b></div>
        <div class="panel-body">
            <div class="row text-end">
                <div class="col-md-12 text-end">
                    <div class="row">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>MATERIA</th>
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
                                            <td><?= $item["nomarea"] ?? "Otras" ?> <br>(<?= $item["nommateria"] ?>)</td>
                                            <td>
                                                <?php
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