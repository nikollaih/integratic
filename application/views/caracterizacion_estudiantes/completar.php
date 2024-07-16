<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
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
                            <p>Señor(a) padre/madre o acudiente
                                A continuación encontrará una serie de preguntas sobre información de su hijo(a) o del familiar del cual es acudiente, le solicitamos responder con sinceridad y responsabilidad cada una de las preguntas, para que la podamos recoger esta información que se requiere para los procesos institucionales. Toda la información aquí recolectada será tratada con privacidad.</p>
                        </div>
                    </div>
                    <form action="" method="post">
                        <?php
                        if (isset($preguntas) && is_array($preguntas)) {
                            foreach ($preguntas as $pregunta) { ?>
                                <div class="row m-b-30">
                                    <div class="col-md-12">
                                        <label for=""><?= $pregunta["orden"]. ' - ' .$pregunta["pregunta"] ?><?= ($pregunta["es_obligatoria"]) ? "<span class='text-danger'> *</span>" : "" ?></label><br>
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