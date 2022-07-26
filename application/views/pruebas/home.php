<?php $this->load->view("in_head"); echo logged_user()["id"]; ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                    <div class="panel panel-primary">
                        <div class="panel-heading text-capitalize"><b>Lista de pruebas</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <table id="tabla-pruebas" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Alcance</th>
                                                <th>Tipo</th>
                                                <th>Cantidad de preguntas</th>
                                                <th>Duración</th>
                                                <th>Disponibilidad</th>
                                                <th>Estado</th>
                                                <?php
                                                    if(strtolower(logged_user()["rol"]) == "estudiante"){
                                                        ?>
                                                            <th>Calificación</th>
                                                        <?php
                                                    }
                                                ?>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($pruebas != false){
                                                    foreach ($pruebas as $p) {
                                                        ?>
                                                            <tr id="prueba-<?= $p["id_prueba"] ?>">
                                                                <td><?= $p["nombre_prueba"] ?></td>
                                                                <td><?= $p["alcance_prueba"] ?></td>
                                                                <td><?= $p["tipo_prueba"] ?></td>
                                                                <td><?= $p["cantidad_preguntas"] ?></td>
                                                                <td><?= $p["duracion"] ?> Minutos</td>
                                                                <td>
                                                                    <b>Desde:</b> <?= $fechaHoraDesde = date("d F Y h:i a", strtotime($p["fecha_inicio"])) ?><br>
                                                                    <b>Hasta:</b>  <?= $fechaHoraHasta = date("d F Y h:i a", strtotime($p["fecha_finaliza"])) ?>
                                                                </td>   
                                                                <td>  
                                                                <?php     
                                                                    //Se obtiene la fecha del equipo                          
                                                                    $fechaHoraActual = date('d F Y h:i a', time());  

                                                                    //Comparamos si la fecha y hora estan en el rango de tiempo de la fecha y hora actual
                                                                    if(strtotime($fechaHoraActual) > strtotime($fechaHoraDesde) && strtotime($fechaHoraActual) < strtotime($fechaHoraHasta)) {
                                                                        echo "<label class='text-success'>Disponible</label>";
                                                                    }   
                                                                    else{
                                                                        echo "<label class='text-danger'>No Disponible</label>";
                                                                    }                                                          
                                                                ?>
                                                                </td>

                                                                <?php
                                                                    if(strtolower(logged_user()["rol"]) == "estudiante"){
                                                                        ?>
                                                                            <td><?= (info_prueba_realizada($p["id_prueba"], $p["id_participante_prueba"])["porcentaje"] != null) ? info_prueba_realizada($p["id_prueba"], $p["id_participante_prueba"])["calificacion"] : "Sin presentar" ?></td>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                <td class="text-center">
                                                                    <?php
                                                                        if(strtolower(logged_user()["rol"]) == "estudiante" && $p["estado"] == 1){
                                                                    ?>
                                                                        <a class="btn btn-success" href="<?= base_url() ?>Pruebas/empezar/<?= $p["id_prueba"] ?>">Ver</a>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                    <?php
                                                                        if(strtolower(logged_user()["rol"]) == "docente"){
                                                                    ?>
                                                                        <a class="btn btn-success" href="<?= base_url() ?>Pruebas/ver/<?= $p["id_prueba"] ?>">Ver</a>
                                                                        <a class="btn btn-danger button-eliminar-prueba" class="button-eliminar-prueba" data-prueba="<?= $p["id_prueba"] ?>">Eliminar</a>
                                                                    <?php
                                                                        }
                                                                    ?>
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