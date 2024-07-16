<!-- Modal Asignacion de Proyectos -->
<div class="modal fade" id="modal_asignar_direccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Asignación de dirección de grupos</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="docentes" class="control-label">Nombre del Docente</label>
                            <div id="lista_direccion_docentes">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="docentes" class="control-label">Grupo</label>
                            <div id="lista_direccion_grupos">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:guardarDireccionGrupo();">Asignar</button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="table-direccion-grupo" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Docente</th>
                                    <th>Grupo</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button>
            </div>
        </div>
    </div>
</div>