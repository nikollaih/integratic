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
                            <?php
                            // valores por defecto
                            $observaciones_barreras = "";
                            $barrerasRaw = null;
                            $seleccionadas = null;

                            if ($item_piar && isset($item_piar["barreras"])) {
                                $barrerasRaw = $item_piar["barreras"];

                                // Si es string y parece un serialized PHP, intentar unserialize
                                if (is_string($barrerasRaw) && (strpos($barrerasRaw, 'a:') === 0 || strpos($barrerasRaw, 's:') === 0)) {
                                    $un = @unserialize($barrerasRaw, ['allowed_classes' => false]);
                                    if ($un !== false && is_array($un)) {
                                        // Si la estructura es como a:2:{ s:8:"barreras"; ... }
                                        if (array_key_exists('barreras', $un)) {
                                            $seleccionadas = $un['barreras'];
                                        }
                                        if (array_key_exists('observaciones', $un)) {
                                            $observaciones_barreras = (string) $un['observaciones'];
                                        }
                                    } else {
                                        // intentar reinterpretar como JSON si acaso
                                        $maybeJson = json_decode($barrerasRaw, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($maybeJson)) {
                                            if (isset($maybeJson['barreras'])) $seleccionadas = $maybeJson['barreras'];
                                            if (isset($maybeJson['observaciones'])) $observaciones_barreras = (string)$maybeJson['observaciones'];
                                        } else {
                                            // si no se pudo unserialize ni json, lo dejamos como texto plano
                                            echo htmlspecialchars($barrerasRaw);
                                        }
                                    }
                                } elseif (is_array($barrerasRaw)) {
                                    // si ya es array (posible)
                                    $seleccionadas = $barrerasRaw;
                                } else {
                                    // si es string plano (por ejemplo "1,2,3" o texto)
                                    // si tiene comas, lo interpretamos como lista de ids
                                    if (is_string($barrerasRaw) && strpos($barrerasRaw, ',') !== false) {
                                        $seleccionadas = array_map('trim', explode(',', $barrerasRaw));
                                    } else {
                                        // texto libre: mostrarlo directamente
                                        echo htmlspecialchars((string)$barrerasRaw);
                                    }
                                }
                            }

                            // Si existe la propiedad barreras_seleccionadas en el origen, priorizarla
                            if ($item_piar && !empty($item_piar["barreras_seleccionadas"])) {
                                $seleccionadas = $item_piar["barreras_seleccionadas"];
                            }

                            // Ahora renderizamos las etiquetas si $seleccionadas es un array/iterable
                            if (!empty($seleccionadas) && (is_array($seleccionadas) || $seleccionadas instanceof Traversable)) {
                                foreach ($seleccionadas as $barrera) {
                                    // barrera puede ser objeto (con id_barreras y descripcion) o id simple o array asociativo
                                    $id = null;
                                    $desc = null;

                                    if (is_object($barrera)) {
                                        $id = $barrera->id_barreras ?? $barrera->id ?? null;
                                        $desc = $barrera->descripcion ?? (property_exists($barrera, 'descripcion') ? $barrera->descripcion : null);
                                    } elseif (is_array($barrera)) {
                                        $id = $barrera['id_barreras'] ?? $barrera['id'] ?? null;
                                        $desc = $barrera['descripcion'] ?? $barrera['label'] ?? null;
                                    } else {
                                        // valor escalar: lo tratamos como id (o texto)
                                        $id = $barrera;
                                    }

                                    // si no tenemos descripcion, podemos usar el id como texto
                                    $display = $desc !== null ? $desc : (string)$id;

                                    if ($display !== "") {
                                        $safeId = htmlspecialchars((string)$id);
                                        $safeDisplay = htmlspecialchars((string)$display);
                                        echo '<span data-id="' . $safeId . '" class="label-barrera badge bg-secondary m-r-5" id="label-' . $safeId . '">' . $safeDisplay . '</span>';
                                    }
                                }
                            } elseif (empty($seleccionadas) && empty($barrerasRaw) && $item_piar) {
                                // si no hay nada y no se imprimió antes, mostrar vacío
                                echo '[BARRERAS VACÍAS]';
                            }
                            ?>
                        </div>

                        <div id="barrerasHiddenInputs">
                            <?php
                            // Generar hidden inputs a partir de $seleccionadas
                            if (!empty($seleccionadas) && (is_array($seleccionadas) || $seleccionadas instanceof Traversable)) {
                                foreach ($seleccionadas as $barrera) {
                                    $barrera_id = null;
                                    if (is_object($barrera)) {
                                        $barrera_id = $barrera->id_barreras ?? $barrera->id ?? null;
                                    } elseif (is_array($barrera)) {
                                        $barrera_id = $barrera['id_barreras'] ?? $barrera['id'] ?? null;
                                    } else {
                                        $barrera_id = $barrera;
                                    }

                                    if ($barrera_id !== null && $barrera_id !== '') {
                                        $safeId = htmlspecialchars((string)$barrera_id);
                                        echo "<input type=\"hidden\" name=\"barreras[]\" value=\"{$safeId}\" id=\"barrera-hidden-{$safeId}\">";
                                    }
                                }
                            }
                            ?>
                        </div>

                        <div class="form-group text-left m-t-5">
                            <textarea name="observaciones_barreras" cols="30" rows="4" class="form-control"><?= htmlspecialchars($observaciones_barreras) ?></textarea>
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
                            <?php
                            // valores por defecto
                            $observaciones_ajustes_razonables = "";
                            $ajustesRazonablesRaw = null;
                            $seleccionadas = null;

                            if ($item_piar && isset($item_piar["ajustes_razonables"])) {
                                $ajustesRazonablesRaw = $item_piar["ajustes_razonables"];

                                // Si es string y parece un serialized PHP, intentar unserialize
                                if (is_string($ajustesRazonablesRaw) && (strpos($ajustesRazonablesRaw, 'a:') === 0 || strpos($ajustesRazonablesRaw, 's:') === 0)) {
                                    $un = @unserialize($ajustesRazonablesRaw, ['allowed_classes' => false]);
                                    if ($un !== false && is_array($un)) {
                                        // Si la estructura contiene claves esperadas
                                        if (array_key_exists('ajustes_razonables', $un)) {
                                            $seleccionadas = $un['ajustes_razonables'];
                                        }
                                        if (array_key_exists('observaciones', $un)) {
                                            $observaciones_ajustes_razonables = (string) $un['observaciones'];
                                        }
                                    } else {
                                        // intentar interpretar como JSON si acaso
                                        $maybeJson = json_decode($ajustesRazonablesRaw, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($maybeJson)) {
                                            if (isset($maybeJson['ajustes_razonables'])) $seleccionadas = $maybeJson['ajustes_razonables'];
                                            if (isset($maybeJson['observaciones'])) $observaciones_ajustes_razonables = (string)$maybeJson['observaciones'];
                                        } else {
                                            // si no se pudo interpretar, mostrar texto plano
                                            echo htmlspecialchars($ajustesRazonablesRaw);
                                        }
                                    }
                                } elseif (is_array($ajustesRazonablesRaw)) {
                                    // si ya es array
                                    $seleccionadas = $ajustesRazonablesRaw;
                                } else {
                                    // si es string plano (por ejemplo "1,2,3" o texto)
                                    if (is_string($ajustesRazonablesRaw) && strpos($ajustesRazonablesRaw, ',') !== false) {
                                        $seleccionadas = array_map('trim', explode(',', $ajustesRazonablesRaw));
                                    } else {
                                        // texto libre: mostrarlo directamente
                                        echo htmlspecialchars((string)$ajustesRazonablesRaw);
                                    }
                                }
                            }

                            // Si existe la propiedad ajustes_razonables_seleccionados en el origen, priorizarla
                            if ($item_piar && !empty($item_piar["ajustes_razonables_seleccionados"])) {
                                $seleccionadas = $item_piar["ajustes_razonables_seleccionados"];
                            }

                            // Renderizar etiquetas si $seleccionadas es iterable
                            if (!empty($seleccionadas) && (is_array($seleccionadas) || $seleccionadas instanceof Traversable)) {
                                foreach ($seleccionadas as $ajuste) {
                                    // ajuste puede ser objeto (con id_ajustes_razonables y descripcion) o id simple o array asociativo
                                    $id = null;
                                    $desc = null;

                                    if (is_object($ajuste)) {
                                        $id = $ajuste->id_ajustes_razonables ?? $ajuste->id ?? null;
                                        $desc = $ajuste->descripcion ?? (property_exists($ajuste, 'descripcion') ? $ajuste->descripcion : null);
                                    } elseif (is_array($ajuste)) {
                                        $id = $ajuste['id_ajustes_razonables'] ?? $ajuste['id'] ?? null;
                                        $desc = $ajuste['descripcion'] ?? $ajuste['label'] ?? null;
                                    } else {
                                        // valor escalar: lo tratamos como id (o texto)
                                        $id = $ajuste;
                                    }

                                    $display = $desc !== null ? $desc : (string)$id;

                                    if ($display !== "") {
                                        $safeId = htmlspecialchars((string)$id);
                                        $safeDisplay = htmlspecialchars((string)$display);
                                        echo '<span data-id="' . $safeId . '" class="label-ajuste-razonable badge bg-secondary m-r-5" id="label-ar' . $safeId . '">' . $safeDisplay . '</span>';
                                    }
                                }
                            } elseif (empty($seleccionadas) && empty($ajustesRazonablesRaw) && $item_piar) {
                                echo '[AJUSTES RAZONABLES VACÍOS]';
                            }
                            ?>
                        </div>

                        <div id="ajustesRazonablesHiddenInputs">
                            <?php
                            // Generar hidden inputs a partir de $seleccionadas
                            if (!empty($seleccionadas) && (is_array($seleccionadas) || $seleccionadas instanceof Traversable)) {
                                foreach ($seleccionadas as $ajuste) {
                                    $ajuste_id = null;
                                    if (is_object($ajuste)) {
                                        $ajuste_id = $ajuste->id_ajustes_razonables ?? $ajuste->id ?? null;
                                    } elseif (is_array($ajuste)) {
                                        $ajuste_id = $ajuste['id_ajustes_razonables'] ?? $ajuste['id'] ?? null;
                                    } else {
                                        $ajuste_id = $ajuste;
                                    }

                                    if ($ajuste_id !== null && $ajuste_id !== '') {
                                        $safeId = htmlspecialchars((string)$ajuste_id);
                                        echo "<input type=\"hidden\" name=\"ajustes_razonables[]\" value=\"{$safeId}\" id=\"ajuste-razonable-hidden-{$safeId}\">";
                                    }
                                }
                            }
                            ?>
                        </div>

                        <div class="form-group text-left m-t-5">
                            <textarea name="observaciones_ajustes_razonables" cols="30" rows="4" class="form-control"><?= htmlspecialchars($observaciones_ajustes_razonables) ?></textarea>
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