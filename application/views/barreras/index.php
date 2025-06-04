<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= base_url('Barreras/crear') ?>" class="btn btn-success m-b-2">Nueva Barrera</a>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading"><b>Barreras</b></div>
                <div class="panel-body">
                    <form method="get" class="form-inline m-b-2">
                        <div class="form-group">
                            <label for="categoria">Filtrar por categoría:</label>
                            <select name="categoria" id="categoria" class="form-control" onchange="this.form.submit()">
                                <option value="">-- Todas --</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat->id_categoria_barrera ?>" <?= ($categoria_actual == $cat->id_categoria_barrera ? 'selected' : '') ?>>
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
                        <?php foreach($barreras as $b): ?>
                            <tr>
                                <td><?= $b->id_barreras ?></td>
                                <td><?= $b->descripcion ?></td>
                                <td><?= $b->nombre_categoria ?></td>
                                <td><?= date("Y-m-d h:i a", strtotime($b->created_at)) ?></td>
                                <td>
                                    <a href="<?= base_url('Barreras/editar/'.$b->id_barreras) ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="<?= base_url('Barreras/eliminar/'.$b->id_barreras) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta barrera?')">Eliminar</a>
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
