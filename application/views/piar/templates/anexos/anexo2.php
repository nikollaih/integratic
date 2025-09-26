<table class="margin-top">
    <tr>
        <td style="border: 0;" class="text-center" colspan="4">
            <p class="text-content title text-center">PLAN INDIVIDUAL DE AJUSTES RAZONABLES – PIAR (ANEXO 2)</p>
        </td>
    </tr>
    <tr>
        <td><strong>Fecha de elaboración:</strong><br><?= date("Y-m-d", strtotime($piar["fecha_elaboracion"])) ?></td>
        <td><strong>Institución educativa:</strong><br><?= configuracion()["nombre_institucion"] ?></td>
        <td><strong>Sede:</strong><br><?= configuracion()["nombre_institucion"] ?></td>
        <td><strong>Jornada:</strong><br><?= configuracion()["nombre_institucion"] ?></td>
    </tr>
    <tr>
        <td class="space-to-fill" colspan="4">
            <strong>Docentes que elaboran y cargo:</strong><br>
            <?php
            if ($items_piar) {
                $combinaciones_vistas = [];

                foreach ($items_piar as $item) {
                    if (isset($item["nombres"], $item["apellidos"], $item["nommateria"])) {
                        $clave = $item["nombres"] . '|' . $item["apellidos"] . '|' . $item["nommateria"];

                        if (!in_array($clave, $combinaciones_vistas)) {
                            $combinaciones_vistas[] = $clave;
                            echo $item["nombres"] . ' ' . $item["apellidos"] . ' (' . $item["nommateria"] . ')<br>';
                        }
                    }
                }
            }
            ?>
        </td>
    </tr>
</table>

<table class="margin-top">
    <tr>
        <td style="border: 0;" class="text-center" colspan="2">
            <p class="text-content subtitle text-center">DATOS DEL ESTUDIANTE</p>
        </td>
    </tr>
    <tr>
        <td><strong>Nombre del estudiante:</strong><br><?= $piar["nombre"] ?></td>
        <td><strong>Documento de identificación:</strong><br><?= obtenerRespuesta($preguntas, $respuestas, 2) ?></td>
    </tr>
    <tr>
        <td>
            <strong>Edad: </strong><?= get_years(obtenerRespuesta($preguntas, $respuestas, 7), date("Y-m-d")) ?>
        </td>
        <td><strong>Grado: </strong><?= $piar["grado"] ?></td>
    </tr>
</table>

<h5>1. Caracteristicas del estudiante</h5>
<table>
    <tr>
        <td><strong>Entorno personal.</strong><br><br><?= $piar["entorno_personal"] ?></td>
    </tr>
    <tr>
        <td><strong>Descripción general del estudiante con énfasis en gustos e intereses o aspectos que le
                desagradan, expectativas del estudiante y la familia.</strong><br><br><?= $piar["descripcion_general"] ?></td>
    </tr>
    <tr>
        <td><strong>Descripción en términos de lo que hace, puede hacer o requiere apoyo el estudiante para
                favorecer su proceso educativo.
                Indique las habilidades, competencias, cualidades, aprendizajes con las que cuenta el
                estudiante para el grado en el que fue matriculado.</strong><br><br><?= $piar["descripcion_que_hace"] ?></td>
    </tr>
</table>

<h5>2. Ajustes razonables</h5>
<table>
    <thead>
    <tr>
        <td class="text-center"><strong>Áreas</td>
        <td class="text-center"><strong>OBJETIVOS/PROPÓSITOS <br>(Estas son para todo el grado, de acuerdo con los EBC y los DBA)</td>
        <td class="text-center"><strong>BARRERAS QUE SE EVIDENCIAN EN EL CONTEXTO SOBRE LAS QUE SE DEBEN TRABAJAR</td>
        <td class="text-center"><strong>AJUSTES RAZONABLES <br> (Apoyos/estrategias</td>
        <td class="text-center"><strong>EVALUACIÓN DE LOS AJUSTES</td>
    </tr>
    </thead>
    <tbody>
    <?php
    if($items_piar){
        foreach($items_piar as $item){
            if((strtolower(logged_user()["rol"]) == "coordinador") || (strtolower(logged_user()["rol"]) == "docente de apoyo") || (logged_user()["id"] == $item["id_docente"]) || $item["id_materia"] == ""){
                ?>
                <tr>
                    <td>
                        <?= $item["nomarea"] ?? "Otras" ?>
                    </td>
                    <td>
                        <?php
                            if(isset($item["nomarea"])){
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
                            }
                            else {
                                echo $item["nommateria"];
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                        $barreras = [];
                        if (strpos($item["barreras"], 'a:') === 0 && is_array($item["barreras_seleccionadas"])) {
                            if (str_contains($item["barreras"], "observaciones")){
                                $barreras = unserialize($item["barreras"]);
                            }

                            foreach ($item["barreras_seleccionadas"] as $barrera) {
                                echo "<div>- {$barrera->descripcion}</div><br>";
                            }
                        }
                        else {
                            echo $item["barreras"];
                        }

                        // Mostrar observaciones, si existen
                        if (!empty($barreras['observaciones'])) {
                            echo "<div>{$barreras['observaciones']}</div>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strpos($item["ajustes_razonables"], 'a:') === 0 && is_array($item["ajustes_razonables_seleccionados"])) {
                            if (str_contains($item["ajustes_razonables"], "observaciones")) {
                                $ajustes_razonables = unserialize($item["ajustes_razonables"]);
                            }

                            foreach ($item["ajustes_razonables_seleccionados"] as $ajusteRazonable) {
                                echo "<div>- {$ajusteRazonable->descripcion}</div><br>";
                            }
                        }
                        else {
                            echo $item["ajustes_razonables"];
                        }

                        // Mostrar observaciones, si existen
                        if (!empty($ajustes_razonables['observaciones'])) {
                            echo "<div>{$ajustes_razonables['observaciones']}</div>";
                        }
                        ?>
                    </td>
                    <td><?= $item["evaluacion"] ?></td>
                </tr>
                <?php
            }
        }
    }
    ?>
    </tbody>
</table>

<p><strong>Nota: Para educación inicial y Preescolar, los propósitos se orientarán de acuerdo con las bases curriculares para la
        educación inicial y los DBA de transición, que no son por áreas ni asignaturas.</strong></p>
<p><strong>Las instituciones educativas podrán ajustar de acuerdo con los avances en educación inclusiva y con el SIEE</strong></p>
</div>

<h5>5. RECOMENDACIONES PARA EL PLAN DE MEJORAMIENTO INSTITUCIONAL PARA LA ELIMINACIÓN
    DE BARRERAS Y LA CREACIÓN DE PROCESOS PARA LA PARTICIPACIÓN, EL APRENDIZAJE Y EL
    PROGRESO DE LOS ESTUDIANTES:</h5>

<table>
    <thead>
    <tr>
        <td style="width: 200px" class="text-center"><strong>ACTORES</strong></td>
        <td class="text-center"><strong>ACCIONES</strong></td>
        <td class="text-center"><strong>ESTRATEGIAS A IMPLEMENTAR</strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><strong>FAMILIA, CUIDADORES O CON QUIENES VIVE</strong></td>
        <td><?= $piar["acciones_familia"] ?></td>
        <td><?= $piar["estrategias_familia"] ?></td>
    </tr>
    <tr>
        <td><strong>DOCENTES</strong></td>
        <td><?= $piar["acciones_docentes"] ?></td>
        <td><?= $piar["estrategias_docentes"] ?></td>
    </tr>
    <tr>
        <td><strong>DIRECTIVOS</strong></td>
        <td><?= $piar["acciones_directivos"] ?></td>
        <td><?= $piar["estrategias_directivos"] ?></td>
    </tr>
    <tr>
        <td><strong>ADMINISTRATIVOS</strong></td>
        <td><?= $piar["acciones_administrativos"] ?></td>
        <td><?= $piar["estrategias_administrativos"] ?></td>
    </tr>
    <tr>
        <td><strong>PARES (Compañeros)</strong></td>
        <td><?= $piar["acciones_companeros"] ?></td>
        <td><?= $piar["estrategias_companeros"] ?></td>
    </tr>
    </tbody>
</table>
<p><strong>Firma y cargo de quienes realizan el proceso de valoración:</strong> Docentes, coordinadores, docente de apoyo u otro
    profesional etc.</p>

<p style="color: darkgrey">Si existen varios docentes a cargo en un mismo curso, es importante que cada uno aporte una valoración
    del desempeño del estudiante en su respectiva área y los ajustes planteados</p>

<table class="margin-top">
    <tbody>
    <tr>
        <td class="space-to-fill">Nombre y firma</td>
        <td class="space-to-fill">Nombre y firma</td>
        <td class="space-to-fill">Nombre y firma</td>
    </tr>
    <tr>
        <td class="space-to-fill">Área</td>
        <td class="space-to-fill">Área</td>
        <td class="space-to-fill">Área</td>
    </tr>
    </tbody>
</table>