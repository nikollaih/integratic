<?php
$opcionesRespuesta = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cuadernillo de preguntas</title>
    <style>
        body {
            font-family: 'Elegance', sans-serif, Arial !important;
            background: #fff !important;
            color: #000 !important;
            margin: 2px;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            font-weight: bold;
        }

        h1 {
            font-size: 20px;
            margin-top: 10px;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .instrucciones {
            font-size: 12px;
            text-align: justify;
            margin: 10px 0;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 5px 0;
        }

        .pregunta {
            margin-bottom: 20px;
        }

        .numero-pregunta {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .descripcion {
            font-size: 13px;
            margin-bottom: 6px;
            display: block;
        }

        .opcion {
            display: block;
            font-size: 12px;
            margin-left: 15px;
            margin-bottom: 4px;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 5px 0;
        }

    </style>
</head>
<body>

<h1>Cuadernillo de evaluación</h1>
<h2><?= $prueba["nombre_prueba"] ?></h2>

<div class="instrucciones">
    <p><strong>Instrucciones:</strong> Lea cada pregunta con atenci&oacute;n. Escoja la opci&oacute;n correcta entre las alternativas A, B, C, D (o m&aacute;s si aplica). Algunas preguntas pueden tener una imagen asociada.</p>
    <p><?= $prueba["descripcion_prueba"] ?></p>
</div>

<?php
if($preguntas){
    $x = 1;
    foreach ($preguntas as $p){
        ?>
        <div class="pregunta">
            <div class="numero-pregunta">Pregunta <?= $x ?></div>
            <span class="descripcion"><?= $p["descripcion_pregunta"] ?></span>

            <?php if($p["archivo"]): ?>
                <img width="200px" src="<?= base_url() ?>uploads/preguntas/<?= $p["archivo"] ?>" alt="Imagen de la pregunta">
            <?php endif; ?>
            <br><br><br>
            <?php
            if($p["respuestas"]){
                for ($i = 0; $i < count($p["respuestas"]); $i++) {
                    ?>
                    <span class="opcion"><strong><?= $opcionesRespuesta[$i] ?>.</strong> <?= $p["respuestas"][$i]["descripcion_respuesta"] ?></span>
                    <br>
                    <?php if($p["respuestas"][$i]["archivo_respuesta"]): ?>
                        <img width="200px" src="<?= base_url() ?>uploads/respuestas/<?= $p["respuestas"][$i]["archivo_respuesta"] ?>" alt="Imagen de la respuesta">
                    <?php endif; ?>
                    <br><br>
                    <?php
                }
            }
            ?>
        </div>
        <?php
        $x++;
    }
}
?>

</body>
</html>
