<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("reportes/templates/in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row" id="migas"></div>
            <div class="panel panel-primary">
                <div class="panel-heading text-capitalize"><b>Caracterización Estudiantil - <?= date("Y") ?> | <?= $estudiante["nombres"]. ' '. $estudiante["apellidos"].' '.$estudiante["grado"] ?></b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if(isset($message)){
                                ?>
                                <div class="alert alert-success alert-dismissible show" role="alert">
                                    <?= $message ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-b-30">
                            <p>
                                <b>Estimados padres de familia y/o acudientes:</b><br>
                                A continuación, encontrará una serie de preguntas relacionadas con la información personal y familiar del o la estudiante bajo su responsabilidad. Se solicita, por favor, responder con sinceridad y responsabilidad cada una de ellas. Es importante mencionar que, la información recopilada será tratada con estricta confidencialidad y utilizada únicamente para fines institucionales.

                            </p>
                        </div>
                    </div>
                    <form action="" method="post" id="caracterizacion-estudiante-form">
                        <?php
                        if (isset($preguntas) && is_array($preguntas)) {
                            $categoria_actual = null;

                        $contador_bloques = 1;
                        for ($x = 0; $x < count($preguntas); $x++) {
                            $pregunta = $preguntas[$x];
                            $categoria = $pregunta["nombre_categoria"];

                            if ($categoria !== $categoria_actual) {
                                if ($x !== 0) {
                                    echo '</div>'; // Cierre del contenedor de categoría anterior
                                    $contador_bloques++;
                                }

                                // Nuevo contenedor de categoría con ID dinámico
                                echo '<div class="categoria-bloque" id="bloque-' . $contador_bloques . '" style="background: #f0f0f0;padding: 10px 15px;border-radius: 10px;margin-bottom: 20px;' . ($contador_bloques > 1 ? 'display:none;' : '') . '">';
                                echo '<h4 class="titulo-categoria" style="border-bottom: 1px solid #ccc;padding-bottom: 10px;">' . htmlspecialchars($categoria) . '</h4>';
                                $categoria_actual = $categoria;

                                }
                                ?>

                                <div class="row m-b-30">
                                    <div class="col-md-12">
                                        <label for=""><?= $x + 1 . ' - ' . $pregunta["pregunta"] ?>
                                            <?= ($pregunta["es_obligatoria"]) ? "<span class='text-danger'> *</span>" : "" ?>
                                        </label><br>
                                        <?php
                                        switch ($pregunta["tipo_etiqueta"]) {
                                            case "input":
                                                $this->load->view("caracterizacion_estudiantes/form/input", array("pregunta" => $pregunta));
                                                break;

                                            case "textarea":
                                                $this->load->view("caracterizacion_estudiantes/form/textarea", array("pregunta" => $pregunta));
                                                break;

                                            case "checkbox":
                                                $this->load->view("caracterizacion_estudiantes/form/checkbox", array("pregunta" => $pregunta));
                                                break;

                                            case "select":
                                                $this->load->view("caracterizacion_estudiantes/form/select", array("pregunta" => $pregunta));
                                                break;
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php }

                            // Cerrar último contenedor de categoría
                            echo '</div>';
                        }
                        ?>
                        <?php if($editable): ?>
                            <div class="row m-t-20">
                                <div class="col-md-6 text-left">
                                    <button type="button" id="btnAnterior" class="btn btn-secondary" style="display:none;">Anterior</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" id="btnSiguiente" class="btn btn-primary">Siguiente</button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let bloqueActual = 1;
        const totalBloques = document.querySelectorAll('.categoria-bloque').length;

        const mostrarBloque = (num) => {
            for (let i = 1; i <= totalBloques; i++) {
                document.getElementById('bloque-' + i).style.display = (i === num) ? 'block' : 'none';
            }
            document.getElementById('btnAnterior').style.display = (num > 1) ? 'inline-block' : 'none';
            document.getElementById('btnSiguiente').innerText = (num === totalBloques) ? 'Guardar' : 'Siguiente';
        };

        const validarBloque = (num) => {
            const bloque = document.getElementById('bloque-' + num);
            const campos = bloque.querySelectorAll('input, select, textarea');
            for (const campo of campos) {
                if (!campo.checkValidity()) {
                    campo.reportValidity();
                    return false;
                }
            }
            return true;
        };

        document.getElementById('btnSiguiente').addEventListener('click', function () {
            if (!validarBloque(bloqueActual)) return;

            if (bloqueActual < totalBloques) {
                bloqueActual++;
                mostrarBloque(bloqueActual);
                // Scroll to the top of the page
                window.scrollTo(0, 0);
            } else {
                // Validamos todo el formulario antes de enviar (por seguridad extra)
                const form = jQuery("#caracterizacion-estudiante-form"); // Assuming jQuery is loaded
                if (form[0].checkValidity()) { // Access the native DOM element to call checkValidity
                    form.submit();
                } else {
                    form[0].reportValidity(); // Access the native DOM element to call reportValidity
                }
            }
        });

        document.getElementById('btnAnterior').addEventListener('click', function () {
            if (bloqueActual > 1) {
                bloqueActual--;
                mostrarBloque(bloqueActual);
                // Optional: Scroll to the top when going back as well
                window.scrollTo(0, 0);
            }
        });

        // Initial display of the first block
        mostrarBloque(bloqueActual);
    });
</script>


</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>