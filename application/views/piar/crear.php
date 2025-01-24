<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row" id="migas"></div>
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= base_url() ?>Piar" class="btn btn-primary m-b-2">Lista de estudiantes</a>
                </div>
            </div>
            <form id="form-create-piar" action="" method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b><?= isset($estudiante["id_piar"]) ? "Modificar" : "Nuevo" ?> Plan Individual de Ajustes Razonables (P.I.A.R.)</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span><b>Documento: </b> <?= $estudiante["documento"] ?></span><br>
                                <span><b>Estudiante: </b> <?= $estudiante["nombre"] ?></span><br>
                                <span><b>Grado: </b> <?= $estudiante["grado"] ?></span><br>
                                <span><b>E-mail: </b> <?= $estudiante["email"] ?></span><br>
                                <span><b>E-mail acudiente: </b> <?= $estudiante["email_acudiente"] ?></span>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_docente_aula">Docente de aula</label>
                                    <select name="id_docente_aula" id="id_docente_aula" class="form-control">
                                        <option value="">- Seleccionar</option>
                                        <?php
                                            if($docentes){
                                                foreach($docentes as $doc){
                                                    $selected = $doc["id"] === $estudiante["id_docente_aula"] ? "selected" :  "";
                                                    echo '<option '.$selected.' value="' .$doc["id"].'">'.$doc["nombres"].' '.$doc["apellidos"].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_docente_apoyo">Docente de apoyo</label>
                                    <select name="id_docente_apoyo" id="id_docente_apoyo" class="form-control">
                                        <option value="">- Seleccionar</option>
                                        <?php
                                        if($docentes){
                                            foreach($docentes as $doc){
                                                $selected = $doc["id"] === $estudiante["id_docente_apoyo"] ? "selected" :  "";
                                                echo '<option '.$selected.' value="'.$doc["id"].'">'.$doc["nombres"].' '.$doc["apellidos"].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="richtext-entorno">Entorno personal</label>
                                    <textarea name="entorno_personal" id="richtext-entorno" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if(isset($message)){
                                    ?>
                                    <div class="alert alert-<?= $message["type"] ?> alert-dismissible show" role="alert">
                                        <?= $message["message"] ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row text-end" style="text-align:right;">
                            <div class="col-md-12 text-end">
                                <hr>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- container -->
    </div> <!-- content -->
</div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
<!-- PIAR -->
<script src="<?= base_url() ?>js/piar.js"></script>
<script>
    $( document ).ready(function() {
        editorEntornoPersonal.setContents(`<?= $estudiante['entorno_personal'] ?>`);
    })
</script>
</html>