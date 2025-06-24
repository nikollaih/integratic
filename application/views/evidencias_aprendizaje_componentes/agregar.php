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
                    <a href="<?= base_url() ?>EvidenciasAprendizajeComponentes" class="btn btn-primary m-b-2">Lista de componentes</a>
                </div>
            </div>
            <form action="" method="post">
                <input name="id_tipo_componente" class="form-control"  type="hidden" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["id_tipo_componente"] : "" ?>">

                <div class="panel panel-primary">
                    <div class="panel-heading"><b><?= (isset($componente["id_componente"])) ? "Modificar" : "Nuevo" ?> Componente</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="<?= (isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) ? 'col-md-3' : 'col-md-4'?>">
                                <div class="form-group">
                                    <label for="">Titulo</label>
                                    <input name="nombre" class="form-control" type="text" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["nombre"] : "" ?>">
                                </div>
                            </div>
                            <div class="<?= (isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) ? 'col-md-3' : 'col-md-4'?>">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <input name="descripcion" class="form-control" type="text" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["descripcion"] : "" ?>">
                                </div>
                            </div>
                            <div class="<?= (isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) ? 'col-md-3' : 'col-md-4'?>">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <select name="activo" id="" class="form-control">
                                        <option <?= (isset($componente["id_tipo_componente"]) && $componente["activo"] === "1") ? "selected" : "" ?> value="1">Activo</option>
                                        <option <?= (isset($componente["id_tipo_componente"]) && $componente["activo"] === "0") ? "selected" : "" ?> value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <?php if(isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) { ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Órden</label>
                                        <input name="orden" class="form-control" type="text" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["orden"] : "" ?>">
                                    </div>
                                </div>
                            <?php }
                            ?>

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
                                <button class="btn btn-primary">Guardar</button>
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
</html>