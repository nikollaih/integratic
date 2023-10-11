<?php $this->load->view("in_head"); ?>

<div class="general-content">
    <div class="row">
        <div class="col-md-12">
        <?php $logo = (configuracion()) ? configuracion()["logo_institucion"] : "" ?>
            <table>
                <tr>
                    <td style="width:150px;" rowspan="3"><img src="<?= base_url('img/'.$logo) ?>" alt="<?= (configuracion()) ? configuracion()["nombre_institucion"] : "Logo" ?>" class="thumb-lg"></td>
                    <td><p class="small-text">FORMATO</p></td>
                    <td><p class="small-text">CÓDIGO</p></td>
                    <td style="width:150px;" rowspan="3"><img src="<?= base_url() ?>img/<?= (configuracion()) ? configuracion()["logo_institucion"] : "" ?>" alt="<?= (configuracion()) ? configuracion()["nombre_institucion"] : "Logo" ?>" class="thumb-lg"></td>
                </tr>
                <tr>
                    <td>
                        <h5>INSTITUCIÓN EDUCATIVA</h5>
                        <h5><?= (configuracion()) ? strtoupper(configuracion()["nombre_institucion"]) : "" ?></h5>
                        <p class="small-text"><?= (configuracion()) ? strtoupper(configuracion()["ciudad"]) : "" ?></p>
                    </td>
                    <td><p class="small-text">VERSION</p></td>
                </tr>
                <tr>
                    <td><p class="small-text">PLAN DE AULA</p></td>
                    <td><p class="small-text">FECHA: <?= date("Y-m-d", strtotime($plan_area["created_at"])) ?></p></td>
                </tr>
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
                            <b class="item-title">DOCENTE: <br> <?= strtoupper($area["nomarea"]) ?></b>
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
                            <p class="item-text"><b>DIAGNOSTICO: </b><?= $plan_area["diagnostico"] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <p class="item-text"><b>ESTADO ACTUAL: </b><?= $plan_area["estado_actual"] ?></p>
                        </td>
                        <td colspan="4">
                            <p class="item-text"><b>SITUACIÓN DESEADA: </b><?= $plan_area["situacion_deseada"] ?></p>
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
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>
                            <b class="item-title">SEMANA</b>
                        </th>
                        <th>
                            <b class="item-title">EVIDENCIA DE APRENDIZAJE</b>
                        </th>
                        <th>
                            <b class="item-title">MOTIVACIÓN Y EXPLORACIÓN SABERES PREVIOS</b>
                        </th>
                        <th>
                            <b class="item-title">ESTRUCTURACIÓN Y PRÁCTICA</b>
                        </th>
                        <th>
                            <b class="item-title">TRANSFERENCIA</b>
                        </th>
                        <th>
                            <b class="item-title">VALORACIÓN</b>
                        </th>
                        <th>
                            <b class="item-title">RECURSOS</b>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($evidencias){
                            foreach ($evidencias as $evidencia) { 
                                $semanas = implode(" - ", unserialize($evidencia["semanas"]));
                                ?>
                                <tr>
                                    <td><p class="item-text"><?= $semanas ?></p></td>
                                    <td colspan="<?= ($evidencia["is_only_row"]) ? 6 : 1 ?>"><p class="item-text"><?= $evidencia["evidencia_aprendizaje"] ?></p></td>
                                    <?php
                                        if($evidencia["is_only_row"] != 1){ ?>
                                    <td><p class="item-text"><?= $evidencia["exploracion"] ?></p></td>
                                    <td><p class="item-text"><?= $evidencia["estructuracion"] ?></p></td>
                                    <td><p class="item-text"><?= $evidencia["transferencia"] ?></p></td>
                                    <td><p class="item-text"><?= $evidencia["valoracion"] ?></p></td>
                                    <td><p class="item-text"><?= $evidencia["recursos"] ?></p></td>
                                        <?php }
                                    ?>
                                </tr>
                            <?php }
                        }
                    ?> 
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td colspan="8">
                            <p class="item-text"><b>OBSERVACIONES: </b><?= $plan_area["observaciones"] ?></p>
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

    th{ 
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

    .header {
        border: 1px solid #000;
    }

    .header > div {
        display: inline-block;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    td {
        vertical-align:top
    }

    .small-text {
        font-size: 11px;
        margin: 0;
        text-align: center;
    }

    h5{ 
        margin: 0;
        text-align: center;
    }

    @font-face {
        font-family: 'Elegance';
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
        src: url("http://eclecticgeek.com/dompdf/fonts/Elegance.ttf") format("truetype");
    }
    
    body {
        font-family: Elegance, sans-serif, arial !important;
    }
</style>