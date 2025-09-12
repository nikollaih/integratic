<div class="row m-t-10 piar-container">
    <div class="col-sm-12">
        <div class="col-xs-12">
            <div style="background:#0171bb;" class="m-b-30 evidence-container">
                <h5>OBJETIVOS/PROPOSITOS (DBA)</h5>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group text-left">
                        <label for="objetivos">Seleccionar DBA's</label>
                        <select name="objetivos[]" data-live-search="true" data-size="10" class="form-control select-2" multiple id="piar-dba-select">
                            <?php
                            $observaciones_dbas = "";
                            if ($item_piar) {
                                $selectedDBAS = [];
                                if (strpos($item_piar["objetivos"], 'a:2:') === 0) {
                                    $objetivos = unserialize($item_piar["objetivos"]);
                                    $selectedDBAS = $objetivos['dbas'] ?? [];
                                    $observaciones_dbas = $objetivos['observaciones']?? "";
                                }
                                if (is_array($item_piar["dbas"])) {
                                    foreach ($item_piar["dbas"] as $dba) {
                                        $selected = in_array($dba["id_dba"], $selectedDBAS) ? 'selected' : '';
                                        echo "<option value=\"{$dba["id_dba"]}\" $selected>{$dba["descripcion_dba"]}</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group text-left">
                        <label for="">Observaciones</label>
                        <textarea name="observaciones_dbas" cols="30" rows="4" class="form-control"><?= $observaciones_dbas ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 m-b-30">
            <div style="background:#0171bb;" class="evidence-container m-b-10">
                <h5>BARRERAS </h5>
            </div>
            <div class="row">
                <div class=" col-xs-12 text-left">
                    <button type="button" class="btn btn-primary m-b-5" data-toggle="modal" data-target="#modalBarreras">
                        Seleccionar Barreras
                    </button>
                    <!-- Resumen y valores ocultos que sí se envían -->
                    <div class="mt-3">
                        <label>Barreras seleccionadas</label>
                        <div id="barrerasResumen" class="form-control" style="background-color: #e9ecef; min-height: 38px; height: auto;">
                            <?php if ($item_piar && !empty($item_piar["barreras"])): ?>
                                <?php
                                $barrerasRaw = $item_piar["barreras"];
                                $seleccionadas = $item_piar["barreras_seleccionadas"];

                                // Verificar si es string serializado que empieza por 'a:1' (o cualquier array)
                                if (is_string($barrerasRaw) && strpos($barrerasRaw, 'a:') === 0) {
                                    if (is_array($seleccionadas)) {
                                        foreach ($seleccionadas as $barrera) {
                                            if($barrera->descripcion) {
                                                echo '<span data-id="'.$barrera->id_barreras.'" class="label-barrera badge bg-secondary m-r-5" id="label-' . htmlspecialchars($barrera->id_barreras) . '">' . htmlspecialchars($barrera->descripcion) . '</span>';
                                            }
                                        }
                                    } else {
                                        echo '[BARRERAS VACÍAS]';
                                    }
                                } else {
                                    // Mostrar directamente lo que haya en barreras (por si ya es un texto)
                                    echo htmlspecialchars((string) $barrerasRaw);
                                }
                                ?>
                            <?php endif; ?>
                        </div>

                        <div id="barrerasHiddenInputs">
                            <?php
                            if ($item_piar && !empty($item_piar["barreras_seleccionadas"])) {
                                $barrerasSeleccionadas = $item_piar["barreras_seleccionadas"];

                                if (is_array($barrerasSeleccionadas)) {
                                    foreach ($barrerasSeleccionadas as $barrera) {
                                        // Si es un objeto, accede a su propiedad
                                        $barrera_id = is_object($barrera) ? $barrera->id_barreras : $barrera;

                                        echo "<input type=\"hidden\" name=\"barreras[]\" value=\"{$barrera_id}\" id=\"barrera-hidden-{$barrera_id}\">";
                                    }
                                }
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JUSTES RAZONABLES -->
        <div class="col-xs-12 m-b-30">
            <div style="background:#0171bb;" class="evidence-container m-b-10">
                <h5>AJUSTES RAZONABLES</h5>
            </div>
            <div class="row">
                <div class=" col-xs-12 text-left">
                    <button type="button" class="btn btn-primary m-b-5" data-toggle="modal" data-target="#modalAjustesRazonables">
                        Seleccionar Ajustes Razonables
                    </button>
                    <!-- Resumen y valores ocultos que sí se envían -->
                    <div class="mt-3">
                        <label>Ajustes razonables seleccionados</label>
                        <div id="ajustesRazonablesResumen" class="form-control" style="background-color: #e9ecef; min-height: 38px; height: auto;">
                            <?php if ($item_piar && !empty($item_piar["ajustes_razonables"])): ?>
                                <?php
                                $ajustesRazonablesRaw = $item_piar["ajustes_razonables"];
                                $seleccionadas = $item_piar["ajustes_razonables_seleccionados"];

                                // Verificar si es string serializado que empieza por 'a:1' (o cualquier array)
                                if (is_string($ajustesRazonablesRaw) && strpos($ajustesRazonablesRaw, 'a:') === 0) {
                                    if (is_array($seleccionadas)) {
                                        foreach ($seleccionadas as $ajusteRazonable) {
                                            if($ajusteRazonable->descripcion) {
                                                echo '<span data-id="'.$ajusteRazonable->id_ajustes_razonables.'" class="label-ajuste-razonable badge bg-secondary m-r-5" id="label-ar' . htmlspecialchars($ajusteRazonable->id_ajustes_razonables) . '">' . htmlspecialchars($ajusteRazonable->descripcion) . '</span>';
                                            }
                                        }
                                    } else {
                                        echo '[AJUESTES RAZONABLES VACÍOS]';
                                    }
                                } else {
                                    // Mostrar directamente lo que haya en barreras (por si ya es un texto)
                                    echo htmlspecialchars((string) $ajustesRazonablesRaw);
                                }
                                ?>
                            <?php endif; ?>
                        </div>

                        <div id="ajustesRazonablesHiddenInputs">
                            <?php
                            if ($item_piar && !empty($item_piar["ajustes_razonables_seleccionados"])) {
                                $ajustesRazonablesSeleccionadas = $item_piar["ajustes_razonables_seleccionados"];

                                if (is_array($ajustesRazonablesSeleccionadas)) {
                                    foreach ($ajustesRazonablesSeleccionadas as $ajusteRazonable) {
                                        // Si es un objeto, accede a su propiedad
                                        $ajuste_razonable_id = is_object($ajusteRazonable) ? $ajusteRazonable->id_ajustes_razonables : $ajusteRazonable;

                                        echo "<input type=\"hidden\" name=\"ajustes_razonables[]\" value=\"{$ajuste_razonable_id}\" id=\"ajuste-razonable-hidden-{$ajuste_razonable_id}\">";
                                    }
                                }
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$barrerasSeleccionadas = [];
$ajustesRazonablesSeleccionadas = [];
if(isset($item_piar["barreras"])){
    $barrerasSeleccionadas = (strpos($item_piar["barreras"], 'a:') === 0)
        ? array_map(function ($item) {
            return is_object($item) ? $item->id_barreras : $item['id_barreras'];
        }, $item_piar["barreras_seleccionadas"])
        : [];
}

if(isset($item_piar["ajustes_razonables"])){
    $ajustesRazonablesSeleccionadas = (strpos($item_piar["ajustes_razonables"], 'a:') === 0)
        ? array_map(function ($item) {
            return is_object($item) ? $item->id_ajustes_razonables : $item['id_ajustes_razonables'];
        }, $item_piar["ajustes_razonables_seleccionados"])
        : [];
}

?>

<script>
    $(document).ready(function () {
        $('.select-2').select2();
    });
</script>

<script>
    const barrerasSeleccionadas = <?= json_encode($barrerasSeleccionadas) ?>;
    const ajustesRazonablesSeleccionadas = <?= json_encode($ajustesRazonablesSeleccionadas) ?>;

    $(document).ready(function () {

        // AJAX por categoría
        $('#categoriaBarreraSelect').on('change', function () {
            const categoriaId = $(this).val();
            const $container = $('#barrerasContainer');
            $container.html('');

            if (!categoriaId) return;

            $.ajax({
                url: base_url + "Barreras/obtenerPorCategoria/" + categoriaId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (!data.length) {
                        $container.html('<p>No hay barreras para esta categoría.</p>');
                        return;
                    }

                    data.forEach(function (barrera) {
                        const checkbox = $(`
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${barrera.id_barreras}" id="barrera-${barrera.id_barreras}">
                                <label class="form-check-label" for="barrera-${barrera.id_barreras}">
                                    ${barrera.descripcion}
                                </label>
                            </div>
                        `);

                        // Marcar checkbox si ya fue seleccionada
                        if (barrerasSeleccionadas.includes(barrera.id_barreras)) {
                            checkbox.find('input').prop('checked', true);
                        }

                        // Eventos al hacer check/uncheck
                        checkbox.find('input').on('change', function () {
                            if (this.checked) {
                                if (!$('#label-' + barrera.id_barreras).length) {
                                    const label = $('<span>')
                                        .text(barrera.descripcion)
                                        .addClass('label-barrera badge bg-secondary m-r-5')
                                        .attr('data-id', barrera.id_barreras)
                                        .attr('id', 'label-' + barrera.id_barreras);
                                    $('#barrerasResumen').append(label);
                                }

                                if (!$('#barrera-hidden-' + barrera.id_barreras).length) {
                                    const input = $('<input>')
                                        .attr('type', 'hidden')
                                        .attr('name', 'barreras[]')
                                        .attr('value', barrera.id_barreras)
                                        .attr('id', 'barrera-hidden-' + barrera.id_barreras);
                                    $('#barrerasHiddenInputs').append(input);
                                }
                            } else {
                                $('#label-' + barrera.id_barreras).remove();
                                $('#barrera-hidden-' + barrera.id_barreras).remove();
                            }
                        });

                        $container.append(checkbox);
                    });
                },
                error: function () {
                    $container.html('<p>Error al cargar barreras.</p>');
                }
            });
        });


        // AJUSTES RAZONABLES
        // AJAX por categoría
        $('#categoriaAjustesRazonablesSelect').on('change', function () {
            const categoriaId = $(this).val();
            const $container = $('#ajustesRazonablesContainer');
            $container.html('');

            if (!categoriaId) return;

            $.ajax({
                url: base_url + "AjustesRazonables/obtenerPorCategoria/" + categoriaId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (!data.length) {
                        $container.html('<p>No hay ajustes razonables para esta categoría.</p>');
                        return;
                    }

                    data.forEach(function (ajusteRazonable) {
                        const checkbox = $(`
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${ajusteRazonable.id_ajustes_razonables}" id="ajuste-razonable-${ajusteRazonable.id_ajustes_razonables}">
                                <label class="form-check-label" for="ajuste-razonable-${ajusteRazonable.id_ajustes_razonables}">
                                    ${ajusteRazonable.descripcion}
                                </label>
                            </div>
                        `);

                        // Marcar checkbox si ya fue seleccionada
                        if (ajustesRazonablesSeleccionadas.includes(ajusteRazonable.id_ajustes_razonables)) {
                            checkbox.find('input').prop('checked', true);
                        }

                        // Eventos al hacer check/uncheck
                        checkbox.find('input').on('change', function () {
                            if (this.checked) {
                                if (!$('#label-' + ajusteRazonable.id_ajustes_razonables).length) {
                                    const label = $('<span>')
                                        .text(ajusteRazonable.descripcion)
                                        .addClass('badge bg-secondary m-r-5 label-ajuste-razonable')
                                        .attr('data-id', ajusteRazonable.id_ajustes_razonables)
                                        .attr('id', 'label-ar' + ajusteRazonable.id_ajustes_razonables);
                                    $('#ajustesRazonablesResumen').append(label);
                                }

                                if (!$('#ajuste-razonable-hidden-' + ajusteRazonable.id_ajustes_razonables).length) {
                                    const input = $('<input>')
                                        .attr('type', 'hidden')
                                        .attr('name', 'ajustes_razonables[]')
                                        .attr('value', ajusteRazonable.id_ajustes_razonables)
                                        .attr('id', 'ajuste-razonable-hidden-' + ajusteRazonable.id_ajustes_razonables);
                                    $('#ajustesRazonablesHiddenInputs').append(input);
                                }
                            } else {
                                $('#label-ar' + ajusteRazonable.id_ajustes_razonables).remove();
                                $('#ajuste-razonable-hidden-' + ajusteRazonable.id_ajustes_razonables).remove();
                            }
                        });

                        $container.append(checkbox);
                    });
                },
                error: function () {
                    $container.html('<p>Error al cargar ajustes razonables.</p>');
                }
            });
        });

        <?php if (!empty($categoriaSeleccionada)) : ?>
        $('#categoriaBarreraSelect').val('<?= $categoriaSeleccionada ?>').trigger('change');
        <?php endif; ?>
    });
</script>

<style>
    .piar-container span {
        text-wrap: auto;
        text-align: left;
    }
</style>