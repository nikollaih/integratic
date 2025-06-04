<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= base_url('AjustesRazonables/crear') ?>" class="btn btn-success m-b-2">Nuevo Ajuste</a>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading"><b>Ajustes Razonables</b></div>
                <div class="panel-body">
                    <form method="get" class="form-inline m-b-2">
                        <div class="form-group">
                            <label for="categoria">Filtrar por categoría:</label>
                            <select name="categoria" id="categoria" class="form-control" onchange="this.form.submit()">
                                <option value="">-- Todas --</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat->id_categorias_ajustes_razonables ?>" <?= ($categoria_actual == $cat->id_categorias_ajustes_razonables ? 'selected' : '') ?>>
                                        <?= $cat->nombre_categoria ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($ajustes as $a): ?>
                            <tr>
                                <td><?= $a->id_ajustes_razonables ?></td>
                                <td><?= $a->descripcion ?></td>
                                <td><?= $a->nombre_categoria ?></td>
                                <td><?= date("Y-m-d h:i a", strtotime($a->created_at)) ?></td>
                                <td>
                                    <a href="<?= base_url('AjustesRazonables/editar/'.$a->id_ajustes_razonables) ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="<?= base_url('AjustesRazonables/eliminar/'.$a->id_ajustes_razonables) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este ajuste?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
