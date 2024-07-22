<?php $currentValue = (isset($filtros[$pregunta["id"]])) ? $filtros[$pregunta["id"]] : ''; ?>

<input value="<?= $currentValue ?>" class="form-control input-lg" type="<?= $pregunta['tipo_input'] ?>" name="<?= $pregunta['id'] ?>" id="<?= $pregunta['id'] ?>" placeholder="<?=$pregunta['placeholder'] ?>">