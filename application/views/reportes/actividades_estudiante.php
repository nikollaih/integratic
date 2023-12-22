<div class="general-content">
    <div class="row">
        <div class="col-md-12">
        <?php $logo = (configuracion()) ? configuracion()["logo_institucion"] : "";  ?>
            <table>
                <tbody>
                    <tr>
                        <td class="td-image" style="border: 0;">
                            <img src="<?= base_url('img/'.$logo) ?>" alt="<?= (configuracion()) ? configuracion()["nombre_institucion"] : "Logo" ?>"><br>
                            <h5><?= (configuracion()) ? strtoupper(configuracion()["nombre_institucion"]) : "" ?></h5>
                            <p class="small-text"><?= date("Y-m-d h:i a") ?></p>
                            <h5><?= (is_logged()) ? strtoupper($this->session->userdata()["logged_in"]["grado"].$this->session->userdata()["logged_in"]["grupo"]) : "" ?></h5>
                            <h5><?= (is_logged()) ? strtoupper($this->session->userdata()["logged_in"]["nombres"]." ".$this->session->userdata()["logged_in"]["apellidos"]) : "" ?></h5>
                            <p class="small-text">REPORTE DE ACTIVIDADES PERIODO <?= $periodo["periodo"] ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php
                if(is_array($materias)){
                    foreach ($materias as $materia) { 
                        ?>
                        <table style="margin-top:50px;">
                            <thead>
                                <tr class="header-container">
                                    <th style="text-align:center;" colspan="6"><p><?= $materia["nommateria"] ?></p></th>
                                </tr>
                                <tr class="header-container">
                                    <th><p>Actividad</p></th>
                                    <th><p>Disponibilidad</p></th>
                                    <th><p>Estado</p></th>
                                    <th><p>Calificación</p></th>
                                    <th><p>Porcentaje</p></th>
                                    <th><p>Nota porcentual</p></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $notaFinal = 0;
                                    if(is_array($materia["actividades"])){
                                        foreach ($materia["actividades"] as $actividad) { 
                                            $calificacion = ($actividad["calificacion"]) ? $actividad["calificacion"] : 0;
                                            $notaPorcentual = (($calificacion / configuracion()["calificacion_sobre"]) * ($actividad["porcentaje"] / 100) * 100);
                                            $notaFinal += $notaPorcentual;
                        ?>
                                            <tr>
                                                <td><p><?= $actividad["titulo_actividad"] ?></p></td>
                                                <td>
                                                    <p style="margin-bottom:0;"><b>Desde:</b> <?= date("Y-m-d h:i a", strtotime($actividad["disponible_desde"])) ?></p><br>
                                                    <p style="margin-top:0;"><b>Hasta:</b> <?= date("Y-m-d h:i a", strtotime($actividad["disponible_hasta"])) ?></p>
                                                </td>
                                                <td><p><?= getActivityStatus($actividad) ?></p></td>
                                                <td><p><?= ($calificacion) ? $calificacion : "--" ?></p></td>
                                                <td><p><?= $actividad["porcentaje"] ?>%</p></td>
                                                <td><p><?= configuracion()["calificacion_sobre"] * ($notaPorcentual / 100) ?></p></td>
                                            </tr>
                                        <?php }
                                    }
                                ?>
                                <tr>
                                    <td colspan="5"><p><b>Nota final</b></p></td>
                                    <td><p><b><?= ($notaFinal / 100) * configuracion()["calificacion_sobre"] ?></b></p></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php }
                }
            ?>

            <?php
                if($incluir_pruebas){ ?>
                <table style="margin-top:50px;">
                    <thead>
                        <tr class="header-container">
                            <th style="text-align:center;" colspan="6"><p>Pruebas</p></th>
                        </tr>
                        <tr class="header-container">
                            <th><p>Nombre</p></th>
                            <th><p>Disponibilidad</p></th>
                            <th><p>Materias</p></th>
                            <th><p>Tipo</p></th>
                            <th><p>Duración</p></th>
                            <th><p>Calificación</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($pruebas){
                                foreach ($pruebas as $prueba) { 
                                    $calificacion = info_prueba_realizada($prueba["id_prueba"], $this->session->userdata()["logged_in"]["participante_prueba"]["id_participante_prueba"]);
                                    ?>
                                    <tr>
                                        <td><p><?= $prueba["nombre_prueba"] ?></p></td>
                                        <td>
                                            <p style="margin-bottom:0;"><b>Desde:</b> <?= date("Y-m-d h:i a", strtotime($prueba["fecha_inicio"])) ?></p><br>
                                            <p style="margin-top:0;"><b>Hasta:</b> <?= date("Y-m-d h:i a", strtotime($prueba["fecha_finaliza"])) ?></p>
                                        </td>
                                        <td>
                                            <?php
                                                if($prueba["materias"]){
                                                    echo "<ul style='margin-top: 10px;padding-left: 25px;'>";
                                                    foreach ($prueba["materias"] as $materia) {
                                                        echo "<li style='font-size:12px;'>".$materia["nommateria"]." - ".$materia["grado"]."°</li>";
                                                    }
                                                    echo "</ul>";
                                                }
                                            ?>
                                        </td>
                                        <td><p><?= $prueba["tipo_prueba"] ?></p></td>
                                        <td><p><?= $prueba["duracion"] ?>min</p></td>
                                        <td><p><?= ($calificacion["porcentaje"] != null) ? $calificacion["calificacion"] : "--" ?></p></td>
                                    </tr>
                                <?php }
                            }
                        ?>      
                    </tbody>
                </table>
            <?php 
                }
            ?>
        </div>
    </div>
</div>
<style>
    p {
        margin: 0 !important;
        margin-bottom: 0 !important;
        font-size: 12px;
    }

    th{ 

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
        margin-top: 10px;
    }
    
    body {
        font-family: Elegance, sans-serif, arial !important;
        background: #fff !important;
        color: #000 !important;
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
        margin-bottom:10px;
    }

    .header-container {
        background-color: #ccc;
    }
</style>