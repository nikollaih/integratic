<div class="general-content">
    <div class="row">
        <div class="col-md-12">
            <?php $logo = (configuracion()) ? configuracion()["logo_institucion"] : "" ?>
            <table>
                <tbody>
                <tr>
                    <td class="td-image" rowspan="3">
                        <img width="100px" src="<?= base_url('img/'.$logo) ?>" alt="<?= (configuracion()) ? configuracion()["nombre_institucion"] : "Logo" ?>">
                    </td>
                    <td class="text-center"><p class="small-text text-center">FORMATO</p></td>
                </tr>
                <tr>
                    <td class="text-center">
                        <h5><?= (configuracion()) ? strtoupper(configuracion()["nombre_institucion"]) : "" ?></h5>
                        <p class="small-text"><?= (configuracion()) ? strtoupper(configuracion()["ciudad"]) : "" ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="text-center"><p class="small-text">PLAN DE AULA <br><?= date("Y-m-d", strtotime($plan_area["created_at"])) ?></p></td>
                </tr>
                </tbody>
            </table>

            <table style="margin-top: 20px;">
                <thead>
                <tr>
                    <th>
                        <b class="item-title">ÁREA: <br> <?= strtoupper($area["nomarea"]) ?></b>
                    </th>
                    <th>
                        <b class="item-title">ASIGNATURA: <br> <?= strtoupper($materia["nommateria"]) ?></b>
                    </th>
                    <th>
                        <b class="item-title">DOCENTE: <?= strtoupper($usuario["nombres"]." ".$usuario["apellidos"]) ?></b>
                    </th>
                    <th>
                        <b class="item-title">PERIODO: <br> <?= strtoupper($plan_area["periodo"]) ?></b>
                    </th>
                    <th>
                        <b class="item-title">GRADO: <br> <?= strtoupper($materia["grado"]) ?></b>
                    </th>
                    <th>
                        <b class="item-title">FECHA INICIO: <br> <?= strtoupper($plan_area["fecha_inicio"]) ?></b>
                    </th>
                    <th>
                        <b class="item-title">FECHA FIN: <br> <?= strtoupper($plan_area["fecha_fin"]) ?></b>
                    </th>
                    <th>
                        <b class="item-title">INTENSIDAD HORARIA: <br> <?= strtoupper($plan_area["intensidad_horaria"]) ?></b>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="8">
                        <p class="item-text"><b>CARACTERIZACIÓN DE LOS ESTUDIANTES: </b><?= $plan_area["diagnostico"] ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p class="item-text"><b>APRENDIZAJES POR MEJORAR: </b><?= $plan_area["situacion_deseada"] ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p class="item-text"><b>ESTANDAR BÁSICO DE COMPETENCIA:</b></p><br>
                        <?php
                        if(is_array($estandares)){
                            $selectedEstandares = unserialize($plan_area["estandares_basicos"]);
                            foreach ($estandares as $estandar) {
                                if (in_array($estandar["id_estandar"], $selectedEstandares)) {
                                    ?>
                                    <p class="item-text">- <?= $estandar["descripcion_estandar"] ?></p>
                                <?php }
                            }
                        }
                        ?>
                    </td>
                    <td colspan="4">
                        <p class="item-text"><b>DERECHOS BÁSICOS DE APRENDIZAJE:</b></p><br>
                        <?php
                        if(is_array($dbas)){
                            $selectedDBAS = unserialize($plan_area["dbas"]);
                            foreach ($dbas as $dba) {
                                if (in_array($dba["id_dba"], $selectedDBAS)) {
                                    ?>
                                    <p class="item-text">- <?= $dba["descripcion_dba"] ?></p>
                                <?php }
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p class="item-text"><b>ENCUADRE O PACTOS DE CLASE: </b><?= $plan_area["pactos_clase"] ?></p>
                    </td>
                </tr>
                </tbody>
            </table>

            <table>
                <thead>
                <tr>
                    <th>
                        <b class="item-title">SEMANA</b>
                    </th>
                    <?php
                    if($tipos_componentes_evidencia){
                        foreach ($tipos_componentes_evidencia as $tipo) {
                            echo '<th><b class="item-title">'.strtoupper($tipo["nombre"]).'</b></th>';
                        }
                    }
                    ?>
                    <th>
                        <b class="item-title">ESTADO</b>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if ($evidencias): ?>
                    <?php foreach ($evidencias as $evidencia): ?>
                        <?php
                        $semanas = unserialize($evidencia["semanas"]);
                        $listaSemanas = get_semanas_by_ids($semanas);
                        ?>
                        <tr>
                            <td style="width:90px;">
                                <?php if (is_array($listaSemanas)): ?>
                                    <?php foreach ($listaSemanas as $semana): ?>
                                        <div style="text-align:center;margin-bottom:10px;">
                                            <h5 class="m-b-0"><?= $semana["semana"] ?></h5>
                                            <span style="font-size:11px;color:#6d6d6d;"><?= $semana["fecha_inicio"] ?></span><br>
                                            <span style="font-size:11px;color:#6d6d6d;"><?= $semana["fecha_fin"] ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>

                            <?php if ($evidencia["is_only_row"] == 1): ?>
                                <?php
                                // Tomamos el primer tipo de componente
                                $primerTipo = reset($tipos_componentes_evidencia); // primer elemento
                                $contenido = '';
                                foreach ($evidencia['componentes'] as $componente) {
                                    if ($componente['id_tipo_componente'] == $primerTipo["id_tipo_componente"]) {
                                        $contenido = $componente["contenido"];
                                        break;
                                    }
                                }
                                ?>
                                <td colspan="<?= count($tipos_componentes_evidencia) ?>">
                                    <?= $contenido ?>
                                </td>
                            <?php else: ?>
                                <?php foreach ($tipos_componentes_evidencia as $tipo): ?>
                                    <?php
                                    $componenteContenido = '';
                                    foreach ($evidencia['componentes'] as $componente) {
                                        if ($componente['id_tipo_componente'] == $tipo["id_tipo_componente"]) {
                                            $componenteContenido = $componente["contenido"];
                                            break;
                                        }
                                    }
                                    ?>
                                    <td><?= $componenteContenido ?></td>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <td>
                                <p class="item-text">
                                    <b>
                                        <?php
                                        $estado = $evidencia["estado_completo"];
                                        echo ($estado == 3) ? "Completado" : (($estado == 2) ? "No Completado" : "Pendiente");
                                        ?>
                                    </b>
                                </p>
                                <p class="item-text"><?= $evidencia["observaciones_completo"] ?></p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>

            </table>

            <table>
                <tbody>
                <tr>
                    <td colspan="8">
                        <p class="item-text"><b>OTROS APRENDIZAJES POR FORTALECER: </b><?= $plan_area["observaciones"] ?></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    p {
        margin: 0;
        font-size: 12px;
    }

    th {
        background: #ccc;
    }

    .item-text {
        font-size: 12px;
        margin: 0;
    }

    .item-title {
        font-size: 11px;
        margin: 0;
    }

    .header > div {
        display: inline-block;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        page-break-inside: auto; /* Permite que la tabla se divida */
        table-layout: fixed; /* Ajusta el layout de la tabla */
    }

    thead {
        width: 100%;
    }

    tbody {
        page-break-inside: auto; /* Permite saltos de página dentro del tbody */
        page-break-after: auto;
    }

    tr {
        page-break-inside: auto; /* Permite saltos de página dentro de filas */
        page-break-after: auto;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        overflow-wrap: break-word; /* Permite que el texto se ajuste dentro de la celda */
        word-wrap: break-word;
        word-break: break-all;
        white-space: normal; /* Permite que el texto fluya y se divida correctamente */
        page-break-inside: avoid; /* Ajusta según el comportamiento de la celda */
    }

    span {
        word-break: break-all;
    }

    td {
        vertical-align: top;
        overflow-wrap: break-word; /* Ajusta el texto largo */
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal; /
    }

    h5 {
        margin: 0;
        text-align: center;
    }

    body {
        font-family: Elegance, sans-serif, Arial !important;
        background: #fff !important;
        color: #000 !important;
    }

    .td-image {
        width: 150px;
        text-align: center;
        height: 100px !important;
        padding-bottom: 0 !important;
        position: relative;
    }

    .td-image > img {
        width: 110px;
        height: 110px;
        position: absolute;
        left: 20px;
        top: 7px;
    }

    html, body {
        margin: 2px;
        padding: 0;
    }

    /* Estilos adicionales para evitar el corte de texto en tablas */
    td, th, p {
        line-height: 1.2; /* Ajusta la altura de línea para evitar cortes */
    }

    td, th {
        page-break-after: always; /* Permite saltos de página después de celdas largas */
        page-break-before: auto; /* Ajusta saltos de página antes de celdas */
        page-break-inside: avoid;
    }

    .text-center {
        text-align: center;
    }

</style>