<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-capitalize"><b>Pregunta</b></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <p><label for=""><b>Materia: </b></label> <?= $pregunta["nommateria"] ?></p>
                                                <p><?= $pregunta["descripcion_pregunta"] ?></p>
                                                <?php
                                                    if($pregunta["archivo"] && $pregunta["nombre_archivo"]){
                                                ?>
                                                        <p><?= $pregunta["nombre_archivo"] ?></p>
                                                        <img src="<?= base_url() ?>uploads/preguntas/<?= $pregunta["archivo"] ?>" alt="" srcset="" width="200">
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            if($respuestas){
                                $x = 1;
                                foreach ($respuestas as $r) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading text-capitalize" style="background-color: #0d6e85;"><b>Respuesta <?= $x; ?></b></div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                            <b><?= ($r["tipo_respuesta"] == "0") ? "<label  class='text-danger'>Incorrecta</label>" : "<label  class='text-success'>Correcta</label>" ?></b>
                                                            <p><?= $r["descripcion_respuesta"] ?></p>
                                                            <?php
                                                                if($r["archivo_respuesta"] && $r["nombre_archivo_respuesta"]){
                                                            ?>
                                                                    <p><?= $r["nombre_archivo_respuesta"] ?></p>
                                                                    <img src="<?= base_url() ?>uploads/respuestas/<?= $r["archivo_respuesta"] ?>" alt="" srcset="" width="200">
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $x++;
                                }
                            }
                        ?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-capitalize"><b>Estadisticas</b></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>Cantidad de veces utilizada en pruebas</td>
                                                            <td>98</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cantidad de veces respondida correctamente</td>
                                                            <td>50</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cantidad de veces respondida de manera incorrecta</td>
                                                            <td>48</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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