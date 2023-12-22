<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="reporte-actividades-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="">Seleccionar los parametros del reporte</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="">Materia</label>
                     <select required name="reporte-actividades-estudiante-materia" id="reporte-actividades-estudiante-materia" class="form-control">
                        <option value=null>Todas</option>
                        <?php
                           if($materias){
                               foreach ($materias as $materia) {
                                   ?>
                                    <option value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"] ?></option>
                                <?php
                                }
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="">Periodo</label>
                     <select required name="reporte-actividades-estudiante-periodo" id="reporte-actividades-estudiante-periodo" class="form-control">
                        <?php
                           if($periodos){
                               foreach ($periodos as $periodo) {
                                   ?>
                                        <option value="<?= $periodo["id_periodo"] ?>"><?= $periodo["periodo"] ?></option>
                                    <?php
                                }
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <input type="checkbox" id="reporte-actividades-estudiante-pruebas" name="reporte-actividades-estudiante-pruebas" /> Incluir pruebas
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button id="reporte-actividades-estudiante-generar" type="button" class="btn btn-primary">Generar</button>
         </div>
      </div>
   </div>
</div>