<!-- Modal Asignacion de Materias -->
<div class="modal fade" id="modal-completar-evidencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Completar evidencia de aprendizaje</h4> 
            </div> 
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Estado</label>
                            <select name="" class="form-control" id="estado-completar-evidencia">
                                <option disabled value="1">Pendiente</option>
                                <option value="2">No Completado</option>
                                <option value="3">Completado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="" id="id-completar-evidencia">
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            <textarea name="" class="form-control" id="observaciones-completar-evidencia" cols="30" rows="10" placeholder="Escribir las observaciones..."></textarea>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-primary waves-effect" id="btn-completar-evidencia">Guardar</button> 
            </div>        
        </div> 
    </div>      
</div>