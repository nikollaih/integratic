<?php
    $currentValue = "";
    $options = unserialize($pregunta["opciones"]);

    for($i = 0; $i < count($options); $i++){
        $checked = (isset($filtros[$pregunta["id"]]) && in_array($options[$i], $filtros[$pregunta["id"]])) ? "checked" : "";
        echo '<input '.$checked.' class="m-b-10" type="checkbox" name="'.$pregunta["id"].'[]" value="' . htmlspecialchars($options[$i]) . '"> ' . $options[$i] . '<br>';
    }