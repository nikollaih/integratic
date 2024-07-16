<?php
    $currentValue = "";
    $respuestasFiltradas = obtener_respuesta_caracterizacion($respuestas, $pregunta["id"]);

    if(is_array($respuestasFiltradas) && count($respuestasFiltradas) > 0) {
        $currentValue = $respuestasFiltradas['respuesta'];
    }
?>
<input <?= (!$editable) ? 'disabled' : '' ?>  value="<?= $currentValue ?>" <?= ($pregunta['es_obligatoria'] == 1) ? 'required' : '' ?> class="form-control input-lg" type="<?= $pregunta['tipo_input'] ?>" name="<?= $pregunta['id'] ?>" id="<?= $pregunta['id'] ?>" placeholder="<?=$pregunta['placeholder'] ?>">