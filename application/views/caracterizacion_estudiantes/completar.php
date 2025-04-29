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
                    <form action="" method="post">
                        <?php
                        if (isset($preguntas) && is_array($preguntas)) {
                            $categoria_actual = null;

                            for ($x = 0; $x < count($preguntas); $x++) {
                                $pregunta = $preguntas[$x];
                                $categoria = $pregunta["nombre_categoria"];

                                // Si la categoría cambia (o es la primera vez), mostramos el encabezado
                                if ($categoria !== $categoria_actual) {
                                    if ($x !== 0) {
                                        // Si no es la primera pregunta, cerramos el contenedor anterior
                                        echo '</div>'; // Cierre del contenedor de categoría anterior
                                    }

                                    // Nuevo contenedor de categoría
                                    echo '<div class="categoria-bloque" style="background: #f0f0f0;padding: 10px 15px;border-radius: 10px;margin-bottom: 20px;">';
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
                        <?php
                        if($editable) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </form>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>