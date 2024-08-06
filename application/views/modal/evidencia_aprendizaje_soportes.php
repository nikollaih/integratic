<!-- Modal observaciones plan aula -->
<div class="modal fade bd-example-modal-md" id="evidencia-aprendizaje-soportes-lista-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="">Soportes de la evidencia de aprendizaje</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="table-evidencias-aprendizaje-soportes" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Archivo</th>
                                    <th>Comentarios</th>
                                    <th style="width: 175px">Fecha</th>
                                    <?php
                                    if(strtolower(logged_user()["rol"]) == "docente") {
                                        echo '<th></th>';
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php
                    if(strtolower(logged_user()["rol"]) == "docente") {
                        echo '<button type="submit" class="btn btn-primary btn-agregar-evidencia-aprendizaje-soportes">Agregar</button>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>