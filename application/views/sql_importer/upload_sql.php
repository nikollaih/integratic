<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">

            <form action="<?= base_url().'SqlImporter/upload' ?>" method="POST" enctype="multipart/form-data">
                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Ejecución de archivos SQL</b></div>
                    <div class="panel-body">
                        <?php if ($this->session->flashdata('message')): ?>
                            <p><?= $this->session->flashdata('message') ?></p>
                        <?php endif; ?>
                        <br>
                        <div class="form-group">
                            <label>Archivo .sql</label>
                            <input type="file" name="sql_file" accept=".sql" required class="form-control" />
                        </div>
                        <div class="text-right m-t-10">
                            <button class="btn btn-primary" type="submit">Ejecutar SQL</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>
