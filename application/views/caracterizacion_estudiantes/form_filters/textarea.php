<?php
$currentValue = "";
$respuestasFiltradas = obtener_respuesta_caracterizacion($respuestas, $pregunta["id"]);

if(is_array($respuestasFiltradas) && count($respuestasFiltradas) > 0) {
    $currentValue = $respuestasFiltradas['respuesta'];
}
?>
<textarea
    rows="5"
    class="form-control input-lg"
    type="<?= $pregunta['tipo_input'] ?>"
    name="<?= $pregunta['id'] ?>"
    id="<?= $pregunta['id'] ?>"
    placeholder="<?=$pregunta['placeholder'] ?>"
    ><?= $currentValue ?></textarea>