<!-- Modal Filtros Caracterización -->
<div class="modal fade" id="modal_filtrar_caracterizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Filtros avanzados</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <?php
                    $x = 1;
                    if (isset($preguntas) && is_array($preguntas)) {
                        foreach ($preguntas as $pregunta) {
                            if($pregunta["filtro"] == 1) { ?>
                            <div class="row m-b-30">
                                <div class="col-md-12">
                                    <label for=""><?= $x ?> - <?= $pregunta["pregunta"] ?></label><br>
                                    <?php
                                    switch ($pregunta["tipo_etiqueta"]) {
                                        case "input":
                                            $this->load->view("caracterizacion_estudiantes/form_filters/input", array("pregunta" => $pregunta, "filtros" => $filtros));
                                            break;

                                        case "checkbox":
                                            $this->load->view("caracterizacion_estudiantes/form_filters/checkbox", array("pregunta" => $pregunta, "filtros" => $filtros));
                                            break;

                                        case "select":
                                            $this->load->view("caracterizacion_estudiantes/form_filters/select", array("pregunta" => $pregunta, "filtros" => $filtros));
                                            break;
                                    } $x++;
                                    ?>
                                </div>
                            </div>
                        <?php }}
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a class="btn btn-secondary m-r-5" href="<?= base_url() ?>CaracterizacionEstudiantes/filtrar">Limpiar filtros</a>
                            <button class="btn btn-primary">Aplicar Filtros</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>