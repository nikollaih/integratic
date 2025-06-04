<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">

            <form action="<?= isset($ajuste) ? base_url('AjustesRazonables/actualizar/'.$ajuste->id_ajustes_razonables) : base_url('AjustesRazonables/guardar') ?>" method="POST">
                <div class="panel panel-primary">
                    <div class="panel-heading"><b><?= isset($ajuste) ? 'Editar' : 'Nuevo' ?> Ajuste Razonable</b></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Categoría</label>
                            <select name="id_categoria" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <?php foreach($categorias as $c): ?>
                                    <option value="<?= $c->id_categorias_ajustes_razonables ?>"
                                        <?= (isset($ajuste) && $ajuste->id_categoria == $c->id_categorias_ajustes_razonables) ? 'selected' : '' ?>>
                                        <?= $c->nombre_categoria ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control" required><?= isset($ajuste) ? $ajuste->descripcion : '' ?></textarea>
                        </div>
                        <div class="text-right m-t-10">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                            <a href="<?= base_url('AjustesRazonables') ?>" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>
