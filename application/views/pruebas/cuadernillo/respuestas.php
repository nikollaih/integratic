<?php
// Opciones A…Q
$opcionesRespuesta = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q"];
$PREGS_POR_FILA = 4;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Cuadernillo de respuestas</title>
    <style>
        @page { margin: 12mm; }
        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #000;
            background: #fff;
            font-size: 11pt;
        }

        .hdr { text-align: center; margin: 0 0 6mm 0; }
        .hdr h1 { font-size: 14pt; margin: 0; font-weight: bold; }
        .hdr h2 { font-size: 11pt; margin: 2mm 0 0; font-weight: bold; }

        .datos { width: 100%; border-collapse: collapse; margin: 4mm 0 5mm; }
        .datos td { border: 1px solid #000; padding: 2mm; vertical-align: top; }
        .lbl { font-weight: bold; font-size: 10pt; margin-bottom: 1mm; display: block; }
        .linea { height: 8mm; border-bottom: 1px solid #000; }

        .inst {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 2mm 1mm;
            text-align: justify;
            font-size: 10pt;
            margin: 0 0 4mm 0;
        }

        .tabla-pregs { width: 100%; border-collapse: collapse; }
        .tabla-pregs td {
            width: <?php echo number_format(100 / $PREGS_POR_FILA, 4, '.', ''); ?>%;
            border: 1px solid #000;
            vertical-align: top;
            padding: 2mm;
            page-break-inside: avoid;
        }

        .num { font-weight: bold; font-size: 10pt; margin-bottom: 1.5mm; }

        .opt-tbl { border-collapse: collapse; width: 100%; }
        .opt-tbl td { padding: 0.8mm 1mm 0.8mm 0; vertical-align: middle; }
        .opt-letra { white-space: nowrap; width: 8mm; font-weight: bold; }

        .muted { color: #000; font-size: 9pt; }
    </style>
</head>
<body>

<div class="hdr">
    <h1>Cuadernillo de respuestas</h1>
    <h2><?= htmlspecialchars($prueba["nombre_prueba"] ?? "Prueba") ?></h2>
</div>

<table class="datos">
    <tr>
        <td>
            <span class="lbl">Nombre del estudiante</span>
            <br>
            &nbsp;
        </td>
        <td>
            <span class="lbl">Curso/Grupo</span>
        </td>
        <td>
            <span class="lbl">Fecha</span>
        </td>
    </tr>
</table>

<div class="inst">
    <strong>Instrucciones:</strong> Rellene completamente la burbuja correspondiente a su respuesta. Use lápiz de mina suave o
    esfero de tinta negra. No haga marcas fuera de las burbujas. Si cambia de respuesta, borre o tache muy bien la anterior.
    Verifique el número de pregunta antes de marcar. Las opciones válidas pueden ser A, B, C, D (o más, según la pregunta).
</div>

<?php if (!empty($preguntas)): ?>
    <table class="tabla-pregs">
        <tbody>
        <?php
        $total = count($preguntas);
        $porFila = $PREGS_POR_FILA;
        $n = 1;

        for ($i = 0; $i < $total; $i += $porFila):
            ?>
            <tr>
                <?php for ($c = 0; $c < $porFila; $c++): ?>
                    <?php
                    $idx = $i + $c;
                    if ($idx < $total):
                        $p = $preguntas[$idx];
                        $totalOpciones = isset($p["respuestas"]) ? count($p["respuestas"]) : 0;
                        ?>
                        <td>
                            <div class="num">Pregunta <?= $n ?></div>
                            <br>
                            <?php if ($totalOpciones > 0): ?>
                                <table class="opt-tbl">
                                    <tbody>
                                    <?php for ($k = 0; $k < $totalOpciones; $k++):
                                        $r = $p["respuestas"][$k]; // respuesta actual
                                        $letra = isset($opcionesRespuesta[$k]) ? $opcionesRespuesta[$k] : chr(65 + $k);

                                        // ---- REGLA: si $mostrarRespuesta es true y ESTA respuesta tiene tipo_respuesta == 1, rellenar ----
                                        $rellena = $mostrarRespuestas
                                            && isset($r["tipo_respuesta"])
                                            && (int)$r["tipo_respuesta"] == 1;
                                        ?>
                                        <tr>
                                            <td class="opt-letra">&nbsp;&nbsp;<?= $letra ?>.</td>
                                            <td>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <!-- Burbuja SVG compatible con DOMPDF -->
                                                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <circle cx="10" cy="10" r="9"
                                                            fill="<?= $rellena ? '#000000' : 'none' ?>"
                                                            stroke="#000000" stroke-width="1"/>
                                                </svg>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="muted">(Sin opciones definidas)</div>
                            <?php endif; ?>
                        </td>
                    <?php else: ?>
                        <td>&nbsp;</td>
                    <?php endif; ?>
                    <?php $n++; ?>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="muted">No hay preguntas para mostrar.</p>
<?php endif; ?>

</body>
</html>
