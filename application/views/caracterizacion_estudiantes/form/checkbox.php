<?php
    $currentValue = "";
    $respuestasFiltradas = obtener_respuesta_caracterizacion($respuestas, $pregunta["id"]);

    if(is_array($respuestasFiltradas) && count($respuestasFiltradas) > 0) {
        $currentValue = unserialize($respuestasFiltradas['respuesta']);
    }

    $options = unserialize($pregunta["opciones"]);
    $disabled = (!$editable) ? "disabled" : "";

    for($i = 0; $i < count($options); $i++){
        $checked = (is_array($currentValue) && in_array($options[$i], $currentValue)) ? "checked" : "";
        echo '<input '.$disabled.' '.$checked.' class="m-b-10" type="checkbox" name="'.$pregunta["id"].'[]" value="' . htmlspecialchars($options[$i]) . '"> ' . $options[$i] . '<br>';
    }

    if($pregunta["tiene_otro"]) {

        echo '<input '.$disabled.' name="'.$pregunta["id"].'[other]" placeholder="Otro(s)" class="form-control input-lg" type="text">';
    }