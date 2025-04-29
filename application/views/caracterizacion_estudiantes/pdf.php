<div class="general-content">
    <div class="row">
        <div class="col-md-12">
            <?php $logo = (configuracion()) ? configuracion()["logo_institucion"] : "" ?>
            <table id="table-header">
                <tbody>
                <tr>
                    <td class="td-image" rowspan="3"><img src="<?= base_url('img/'.$logo) ?>" alt="<?= (configuracion()) ? configuracion()["nombre_institucion"] : "Logo" ?>"></td>
                    <td><p class="small-text">FORMATO</p></td>
                </tr>
                <tr>
                    <td>
                        <h5><?= (configuracion()) ? strtoupper(configuracion()["nombre_institucion"]) : "" ?></h5>
                        <p class="small-text"><?= (configuracion()) ? strtoupper(configuracion()["ciudad"]) : "" ?></p>
                    </td>
                </tr>
                <tr>
                    <td><p class="small-text">CARACTERIZACIÓN PEDAGOGICA DE ESTUDIANTES <br><?= date("Y-m-d") ?></p></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($preguntas) && is_array($preguntas)): ?>
                <?php
                $categoria_actual = null;

                foreach ($preguntas as $index => $pregunta) {
                    $categoria = $pregunta["nombre_categoria"];

                    // Si cambia la categoría, cerramos la tabla anterior y abrimos una nueva
                    if ($categoria !== $categoria_actual) {
                        if ($categoria_actual !== null) {
                            // Cierra tabla y contenedor anterior
                            echo '</tbody></table></div>';
                        }

                        // Nuevo contenedor de categoría con su tabla
                        echo '<div class="categoria-bloque" style="padding: 10px 15px; border-radius: 10px; margin-bottom: 20px;">';
                        echo '<h4 class="titulo-categoria" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">' . strtoupper(htmlspecialchars($categoria)) . '</h4>';
                        echo '<table class="table">';
                        echo '<tbody>';

                        $categoria_actual = $categoria;
                    }

                    // Agregamos fila de pregunta y respuesta
                    echo '<tr>';
                    echo '<th style="width: 500px">' . htmlspecialchars($pregunta["pregunta"]);
                    if (!empty($pregunta["es_obligatoria"])) {
                        echo ' <span class="text-danger">*</span>';
                    }
                    echo '</th>';
                    echo '<td>' . obtenerRespuesta($preguntas, $respuestas, $pregunta["id"]) . '</td>';
                    echo '</tr>';
                }

                // Cierre final del último bloque si hubo categorías
                if ($categoria_actual !== null) {
                    echo '</tbody></table></div>';
                }
                ?>
            <?php endif; ?>
        </div>
    </div>

    <!--<div class="row">
        <div class="col-md-12">
            <h3>INFORMACIÓN BÁSICA</h3>
            <table>
                <tbody>
                    <tr>
                        <th>Tipo documento</th>
                        <th>Número documento</th>
                        <th>Nombre completo</th>
                        <th>Fecha de nacimiento</th>
                        <th>Edad</th>
                        <th>Teléfono</th>
                    </tr>
                    <tr>
                        <td>
                            <?= obtenerRespuesta($preguntas, $respuestas, 1)  ?>
                        </td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 2) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 59) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 7) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 10) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 36) ?></td>
                    </tr>
                    <tr>
                        <th colspan="3">Género</th>
                        <th>Zona</th>
                        <th>Dirección</th>
                        <th>Estrato</th>
                    </tr>
                    <tr>
                        <td colspan="3"><?= obtenerRespuesta($preguntas, $respuestas, 8) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 30) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 35) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 31) ?></td>
                    </tr>
                    <tr>
                        <th>EPS ó IPS</th>
                        <th>Sisben</th>
                        <th colspan="2">Servicios</th>
                        <th>Equipos</th>
                        <th>Conectividad</th>
                    </tr>
                    <tr>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 27) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 9) ?></td>
                        <td colspan="2"><?= obtenerRespuesta($preguntas, $respuestas, 32) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 33) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 34) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h3>INFORMACIÓN FAMILIAR</h3>
            <table>
                <tbody>
                <tr>
                    <th>Madre</th>
                    <th>Ocupación</th>
                    <th>Padre</th>
                    <th>Ocupación</th>
                    <th>Nº Hermanos</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 41) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 42) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 39) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 40) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 25) ?></td>
                </tr>
                <tr>
                    <th>Hermanos en la I.E.</th>
                    <th>Tipología familiar</th>
                    <th colspan="3">Con quien vive</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 26) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 53) ?></td>
                    <td colspan="3"><?= obtenerRespuesta($preguntas, $respuestas, 54) ?></td>
                </tr>
                <tr>
                    <th>Acudiente</th>
                    <th>Ocupación</th>
                    <th colspan="3">Contacto de emergencia</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 37) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 38) ?></td>
                    <td colspan="3"><?= obtenerRespuesta($preguntas, $respuestas, 43) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>INFORMACIÓN ACADÉMICA</h3>
            <table>
                <tbody>
                    <tr>
                        <th>Grado</th>
                        <th>Tipo de matricula</th>
                        <th>Años perdidos</th>
                        <th>Es repitente</th>
                    </tr>
                    <tr>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 5) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 6) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 47) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 48) ?></td>
                    </tr>
                    <tr>
                        <th>Es nuevo</th>
                        <th>Años desescolarizado</th>
                        <th>Familias en acción</th>
                        <th>Estrategia PAE</th>
                    </tr>
                    <tr>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 49) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 50) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 28) ?></td>
                        <td><?= obtenerRespuesta($preguntas, $respuestas, 29) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>INFORMACIÓN DE SALUD</h3>
            <table>
                <tbody>
                <tr>
                    <th colspan="3">Elementos</th>
                    <th>Tipo de sangre y RH</th>
                    <th>Estatura (cm)</th>
                    <th>Peso (kg)</th>
                </tr>
                <tr>
                    <td colspan="3"><?= obtenerRespuesta($preguntas, $respuestas, 3) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 11) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 12) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 13) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Barreras</th>
                    <th>Especialista</th>
                    <th colspan="2">Cual(es)</th>
                </tr>
                <tr>
                    <td colspan="3"><?= obtenerRespuesta($preguntas, $respuestas, 14) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 17) ?></td>
                    <td colspan="2"><?= obtenerRespuesta($preguntas, $respuestas, 18) ?></td>
                </tr>
                <tr>
                    <th>Medicamentos</th>
                    <th>Cuale(es)</th>
                    <th>Enfermedad</th>
                    <th colspan="2">cual(es)</th>
                    <th>Alergias</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 15) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 16) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 19) ?></td>
                    <td colspan="2"><?= obtenerRespuesta($preguntas, $respuestas, 20) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 23) ?></td>
                </tr>
                <tr>
                    <th>Limitación</th>
                    <th>Cual(es)</th>
                    <th>Sintomas</th>
                    <th>Esquema Covid 19</th>
                    <th>Grupos</th>
                    <th>Grupos poblacionales</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 21) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 22) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 24) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 44) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 45) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 46) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>INFORMACIÓN GENERAL</h3>
            <table>
                <tbody>
                <tr>
                    <th>Va solo a casa</th>
                    <th>Personas autorizadas</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 51) ?></td>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 52) ?></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <th>Información adicional del estudiante</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 55) ?></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <th>Que tema le gustaría recibir en las escuelas de padres</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 56) ?></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <th>Como padre de familia como podría aportar a la comunidad educativa</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 57) ?></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <th>Como padre de familia de que otra forma puede aportar a la comunidad educativa?</th>
                </tr>
                <tr>
                    <td><?= obtenerRespuesta($preguntas, $respuestas, 58) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>-->
</div>

<style>
    p {
        margin: 0;
        font-size: 12px;
    }

    th{
        background: #e2e2e2;
    }

    .header > div {
        display: inline-block;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        border-bottom: 1px solid;
    }

    tbody, th {
        color: #000 !important;
    }

    th, td {
        border: 1px solid black;
        border-bottom: 0;
        padding: 10px 10px;
        text-align: left;
        font-size: 13px;
    }

    #table-header th, #table-header td {
        padding: 8px;
    }

    td {
        vertical-align:top
    }

    .small-text {
        font-size: 11px;
        margin: 0 !important;
        text-align: center;
    }

    h5{
        margin: 0;
        text-align: center;
    }

    body {
        font-family: Elegance, sans-serif, arial !important;
        background: #fff !important;
        color: #000 !important;
    }

    .td-image {
        width:130px;
        text-align:center;
        height:100px !important;
        padding-bottom: 0 !important;
        position: relative;
    }

    .td-image > img{
        margin: 0 auto;
        height:110px;
        position: absolute;
        left: 20px;
        top: 7px;
    }

    h3 {
        margin-bottom: 5px;
        margin-top: 25px;
        font-size: 15px;
    }