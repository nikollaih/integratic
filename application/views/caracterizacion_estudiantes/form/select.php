<?php
    $currentValue = "";
    $respuestasFiltradas = obtener_respuesta_caracterizacion($respuestas, $pregunta["id"]);

    if(is_array($respuestasFiltradas) && count($respuestasFiltradas) > 0) {
        $currentValue = $respuestasFiltradas['respuesta'];
    }
?>

<select <?= (!$editable) ? 'disabled' : '' ?> name="<?= $pregunta["id"] ?>" required="<?= ($pregunta["es_obligatoria"]) ? 'required' : '' ?>" class="form-control input-lg"  id="<?= $pregunta["id"] ?>">
    <option value="">Seleccionar</option>
    <?php
        $options = unserialize($pregunta["opciones"]);
        for($i = 0; $i < count($options); $i++){
            $selected = ($currentValue == $options[$i]) ? "selected" : "";
            echo '<option '.$selected.' value="'.$options[$i].'">'.$options[$i].'</option>';
        }
    ?>
</select>