<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("cursos/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b><?= $curso["nombre_curso"] ?></b></div>
                        <div class="panel-body">
                        <?php
                            if($archivos){ ?>
                                <h6>Archivos adjuntos</h6>
                                <div class="row d-flex gap">
                                    <?php foreach ($archivos as $archivo) { ?>
                                        <a target="_blank" href="<?= base_url() ?>uploads/cursos/<?= $curso["id_curso"].'/'.$archivo["slug_archivo"] ?>" class="pointer file-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="40px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                            <p><?= $archivo["nombre_archivo"] ?></p>
                                        </a>
                                    <?php }
                                echo '</div>';
                             }
                        ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12 m-t-2">
                                    <?= $curso["descripcion_curso"] ?>
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

<style>
    .file-item {
        display: inline;
        text-align: center;
        padding: 10px 20px;
        background: #f5f5f5;
        border-radius: 10px;
        color: #3d3d3d !important;
    }

    .file-item:hover{
        background: #dee8fb;
    }

    .gap {
        gap: 7px;
    }
</style>