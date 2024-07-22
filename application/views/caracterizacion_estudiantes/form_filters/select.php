<?php $currentValue = (isset($filtros[$pregunta["id"]])) ? $filtros[$pregunta["id"]] : ''; ?>

<select name="<?= $pregunta["id"] ?>" class="form-control input-lg"  id="<?= $pregunta["id"] ?>">
    <option value="">Seleccionar</option>
    <?php
        $options = unserialize($pregunta["opciones"]);
        for($i = 0; $i < count($options); $i++){
            $selected = ($currentValue == $options[$i]) ? "selected" : "";
            echo '<option '.$selected.' value="'.$options[$i].'">'.$options[$i].'</option>';
        }
    ?>
</select>