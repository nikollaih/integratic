<?php $this->load->view("in_head"); echo logged_user()["id"]; ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url() ?>Temas/create" class="btn btn-primary m-b-2">Agregar tema</a>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Lista de temas</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <table id="tabla-temas" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Materia</th>
                                            <th>Fecha de creación</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($temas){
                                                for ($i=0; $i < count($temas); $i++) { 
                                                    $tema = $temas[$i];
                                        ?>
                                                    <tr id="tema-<?= $tema["id_tema"] ?>">
                                                        <td>
                                                            <?= $tema["nombre_tema"] ?>
                                                            <?php
                                                                if($tema["dba"] > 0) echo "<span class='badge badge-success'>DBA</span>";
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($tema["materias"]){
                                                                    for ($j=0; $j < count($tema["materias"]); $j++) { 
                                                                        echo "- ".$tema["materias"][$j]["nommateria"]." ".$tema["materias"][$j]["grado"]."<br>";
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?= date("Y-m-d h:i a", strtotime($tema["created_at"])) ?></td>
                                                        <td style="width: 150px;">
                                                            <a class="btn btn-success" href="<?= base_url() ?>Temas/update/<?= $tema["id_tema"] ?>">Editar</a>
                                                            <a class="btn btn-danger button-eliminar-tema" class="button-eliminar-tema" data-tema="<?= $tema["id_tema"] ?>">Eliminar</a>
                                                        </td>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
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