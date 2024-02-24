<div class="general-content">
    <div class="row">
        <div class="col-md-12">
        <?php $logo = (configuracion()) ? configuracion()["logo_institucion"] : "" ?>
            <table>
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
                        <td><p class="small-text">PLAN DE AULA <br><?= date("Y-m-d", strtotime($plan_area["created_at"])) ?></p></td>
                    </tr>
                </tbody>
            </table>

            <div>
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
                        <tr>
                            <td colspan="8">
                                <p class="item-text"><b>ENCUADRE O PACTOS DE CLASE: </b><?= $plan_area["pactos_clase"] ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="width: 100%;">
                <div class="row-title">
                     <div><h5>SEMANA</h5></div>
                     <div><h5>EVIDENCIA DE APRENDIZAJE</h5></div>
                     <div><h5>MOTIVACIÓN Y EXPLORACIÓN SABERES PREVIOS</h5></div>
                     <div><h5>ESTRUCTURACIÓN Y PRÁCTICA</h5></div>
                     <div><h5>TRANSFERENCIA</h5></div>
                     <div><h5>VALORACIÓN</h5></div>
                     <div><h5>RECURSOS</h5></div>
                     <div><h5>ESTADO</h5></div>
                </div>
            </div>

            <div style="width: 100%;">
                    <?php
                        if($evidencias){
                            foreach ($evidencias as $evidencia) {
                                $semanas = unserialize($evidencia["semanas"]);
                                $listaSemanas = get_semanas_by_ids($semanas);
                                ?>
                                <div class="row-content" style="background-color:red;">
                                    <div>
                                        <?php
                                            if(is_array($listaSemanas)){
                                                for ($i=0; $i < count($listaSemanas); $i++) { ?>
                                                    <div style="text-align:center;margin-bottom:10px;">
                                                        <h5 class="m-b-0"><?= $listaSemanas[$i]["semana"] ?></h5>
                                                        <span style="font-size:11px;color:#6d6d6d;"><?= $listaSemanas[$i]["fecha_inicio"] ?></span><br>
                                                        <span style="font-size:11px;color:#6d6d6d;"><?= $listaSemanas[$i]["fecha_fin"] ?></span>
                                                    </div>
                                                <?php }
                                            }
                                        ?>
                                    </div>
                                    <div colspan="<?= ($evidencia["is_only_row"]) ? 6 : 1 ?>"><p class="item-text"><?= $evidencia["evidencia_aprendizaje"] ?></p></div>
                                    <?php
                                        if($evidencia["is_only_row"] != 1){ ?>
                                    <div><p class="item-text"><?= $evidencia["exploracion"] ?></p></div>
                                    <div><p class="item-text"><?= $evidencia["estructuracion"] ?></p></div>
                                    <div><p class="item-text"><?= $evidencia["transferencia"] ?></p></div>
                                    <div><p class="item-text"><?= $evidencia["valoracion"] ?></p></div>
                                    <div><p class="item-text"><?= $evidencia["recursos"] ?></p></div>
                                        <?php }
                                    ?>
                                    <div>
                                        <p class="item-text"><b><?= ($evidencia["estado_completo"] == 3) ? "Completado" : (($evidencia["estado_completo"] == 2) ? "No Completado" : "Pendiente") ?></b></p>
                                        <p class="item-text"><?= $evidencia["observaciones_completo"] ?></p>
                                    </div>
                                </div>
                            <?php }
                        }
                    ?>
            </div>

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
    .row-title {
        height: 50px;
        border: 1px solid black;
        padding-top: 15px;
        background: #ccc;
    }

    .row-title > div, .row-content > div {
        display: inline-block;
        width: 140px;
        border-right: 1px solid black;
        height: 63px;
    }

    .row-title > div > h5 {
        margin: 0;
        margin-top: 8px;
        font-size: 12px;
    }

    .row-title > div:first-child, .row-content > div:first-child {
        width: 80px;
    }

    .row-title > div:last-child, .row-content > div:last-child {
        width: 70px;
        border-right: 0px;
    }

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

    tbody, th {
        color: #000 !important;
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
        margin: 0 !important;
        text-align: center;
        margin-bottom: 0 !important;
        margin-top: 0 !important;
    }

    h5{ 
        margin: 0;
        text-align: center;
    }
    
    body {
        font-family: Elegance, sans-serif, arial !important;
        background: #fff !important;
        color: #000 !important;
        padding: 0;
        margin: 0;
    }

    .td-image {
        width:150px;
        text-align:center;
        height:100px !important;
        padding-bottom: 0 !important;
        position: relative;
    }

    .td-image > img{
        width: 110px;
        height:110px;
        position: absolute;
        left: 20;
        top: 7;
    }
</style>