<h5 class="text-center">INFORME ANUAL DE COMPETENCIAS (PIAR):</h5>
<table>
    <tbody>
        <tr class="bg-gray">
            <td class="text-center">
                <strong>INFORME ANUAL POR COMPETENCIAS INCLUSIÓN ESCOLAR<br>
                DECRETO 1421 DE 2017 ARTÍCULO 2.3.3.5.2.3.7</strong>
            </td>
        </tr>
        <tr class="bg-gray">
            <td>
                Objetivo: Favorecer las transiciones de los estudiantes en su cambio de grado y / o nivel educativo; facilitar el diseño
                del PIAR del año siguiente y la garantia de la continuidad de los apoyos y ajustes requeridos por los estudiantes;
                dinamizar la toma de decisiones frente a la titulación del estudiante y los ajustes particulares en el proceso de
                evaluación de los aprendizajes. (Decreto 1421 de 29 de agosto de 2017)
            </td>
        </tr>
        <tr>
            <td><strong>Estudiante:</strong> <?= $estudiante["nombre"] ?></td>
        </tr>
        <tr>
            <td><strong>Documento:</strong> <?= $estudiante["documento"] ?></td>
        </tr>
        <tr>
            <td><strong>Grado:</strong> <?= $estudiante["grado"] ?></td>
        </tr>
        <tr class="bg-gray">
            <td class="text-center"><strong>Competencias, habilidades y destrezas obtenidas en el año escolar</strong></td>
        </tr>
        <?php
            if($items_piar && is_array($items_piar)){
                foreach($items_piar as $item){ ?>
                    <tr>
                        <td><strong><?= $item["nommateria"] ?>:</strong> <?= $item["destrezas_obtenidas"] ?></td>
                    </tr>
                <?php }
            }
        ?>
        <tr class="bg-gray">
            <td class="text-center"><strong>Aspectos en los que presentó dificultades</strong></td>
        </tr>
        <?php
        if($items_piar && is_array($items_piar)){
            foreach($items_piar as $item){ ?>
                <tr>
                    <td><strong><?= $item["nommateria"] ?>:</strong> <?= $item["dificultades"] ?></td>
                </tr>
            <?php }
        }
        ?>
        <tr class="bg-gray">
            <td class="text-center"><strong>Observaciones respecto a su comportamiento en el aula
                </strong></td>
        </tr>
        <?php
        if($items_piar && is_array($items_piar)){
            foreach($items_piar as $item){ ?>
                <tr>
                    <td><strong><?= $item["nommateria"] ?>:</strong> <?= $item["comportamiento"] ?></td>
                </tr>
            <?php }
        }
        ?>
        <tr class="bg-gray">
            <td class="text-center"><strong>Observaciones respecto al nivel de desempeño en las actividades del aula</strong></td>
        </tr>
        <?php
        if($items_piar && is_array($items_piar)){
            foreach($items_piar as $item){ ?>
                <tr>
                    <td><strong><?= $item["nommateria"] ?>:</strong> <?= $item["desempeno"] ?></td>
                </tr>
            <?php }
        }
        ?>
        <tr class="bg-gray">
            <td class="text-center"><strong>Recomendaciones para el siguiente grado escolar , técnico y/o universitario</strong></td>
        </tr>
        <?php
        if($items_piar && is_array($items_piar)){
            foreach($items_piar as $item){ ?>
                <tr>
                    <td><strong><?= $item["nommateria"] ?>:</strong> <?= $item["recomendaciones"] ?></td>
                </tr>
            <?php }
        }
        ?>
    </tbody>
</table>

<div style="height: 50px"></div>

<table style="margin-left: 80px; margin-right: 80px;">
    <tr style="border: 0;">
        <td style="width: 50%; border: 0; padding-right: 20px" class="text-center">
            <hr>
            <p class="text-center">Docente</p>
        </td>
        <td style="width: 50%; border: 0; padding-left: 20px" class="text-center">
            <hr>
            <p class="text-center">Coordinación Académica</p>
        </td>
    </tr>
    <tr style="border: 0;">
        <td style="width: 50%; border: 0; padding-right: 20px; padding-top: 30px;" class="text-center">
            <hr>
            <p class="text-center">Docente De Apoyo Pedagógico</p>
        </td>
        <td style="width: 50%; border: 0; padding-left: 20px; padding-top: 30px;" class="text-center">
            <hr>
            <p class="text-center">Coordinación Convivencia</p>
        </td>
    </tr>
    <tr style="border: 0;">
        <td style="width: 50%; border: 0; padding-right: 20px; padding-top: 30px;" class="text-center">
            <hr>
            <p class="text-center">Docente Orientadora</p>
        </td>
        <td style="width: 50%; border: 0; padding-left: 20px; padding-top: 30px;" class="text-center">
            <hr>
            <p class="text-center">Rector</p>
        </td>
    </tr>
    <tr style="border: 0;">
        <td style="width: 50%; border: 0; padding-right: 20px; padding-top: 30px;" class="text-center">
            <hr>
            <p class="text-center">Padre de familia o acudiente</p>
        </td>
    </tr>
</table>

<style>
    .bg-gray {
        background-color: #f1f1f1;
    }

    p {
        font-size: 13px;
    }

    body {
        font-family: Elegance, sans-serif, Arial !important;
        background: #fff !important;
        color: #0b0b0b !important;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
    td {
        border: 1px solid black;
        font-size: 13px;
        padding: 5px;
        vertical-align: top;
    }
    tr{
        border: 1px solid black;
    }
    img {
        width: auto; /* Adjust size as needed */
        height: 100px;
    }
    .text-content {
        font-size: 13px;
        font-weight: bold;
    }
    .text-center {
        text-align: center;
    }
    .margin-top {
        margin-top: 20px;
    }
    .title{
        font-size: 18px;
    }
    .subtitle{
        font-size: 14px;
    }
    .space-to-fill{
        padding-bottom: 30px;
    }
</style>