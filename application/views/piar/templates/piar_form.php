
    <div class="panel panel-primary">
        <div class="panel-heading text-capitalize"><b>Información general</b></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <span><b>Documento: </b> <?= $estudiante["documento"] ?></span><br>
                    <span><b>Estudiante: </b> <?= $estudiante["nombre"] ?></span><br>
                    <span><b>Grado: </b> <?= $estudiante["grado"] ?></span><br>
                    <span><b>E-mail: </b> <?= $estudiante["email"] ?></span><br>
                    <span><b>E-mail acudiente: </b> <?= $estudiante["email_acudiente"] ?></span><br>
                    <span><b>Diagnóstico: </b> <?= $estudiante["diagnostico"] ?? "N/A" ?></span><br>
                    <span><b>Entorno personal: </b> <?= $estudiante["entorno_personal"] ?? "N/A" ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading text-capitalize accordion-toggle">
            <b>INFORMACIÓN GENERAL DEL ESTUDIANTE - ANEXO 1</b>
            <span class="accordion-icon">[-]</span>
        </div>
        <div class="panel-body" style="display: block;">
            <?php include "anexos/forms/anexo1.php" ?>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading text-capitalize accordion-toggle">
            <b>PLAN INDIVIDUAL DE AJUSTES RAZONABLES – PIAR - ANEXO 2</b>
            <span class="accordion-icon">[+]</span>
        </div>
        <div class="panel-body" style="display: none;">
            <?php include "anexos/forms/anexo2.php" ?>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading text-capitalize accordion-toggle">
            <b>ACTA DE ACUERDO - ANEXO 3</b>
            <span class="accordion-icon">[+]</span>
        </div>
        <div class="panel-body" style="display: none;">
            <?php include "anexos/forms/anexo3.php" ?>
        </div>
    </div>

<style>
    #form-create-piar label {
        height: 34px !important;
        align-content: end;
    }

    .accordion-icon {
        float: right;
        font-size: 16px;
        cursor: pointer;
    }
</style>