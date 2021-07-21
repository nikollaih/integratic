<div class="row">	      	
  <div class="span12">      			       		
      <div class="widget ">	      			
          <div class="widget-header">
              <i class="icon-user"></i>
              <h3>Gestión de Consursos</h3>
          </div> <!-- /widget-header -->					
          <div class="widget-content"> 
          <div class="span6">    
              <div class="widget-header"> <i class="icon-list-alt"></i>
                  <h3>Datos Personales</h3>
              </div>
          <div class="widget-content">
            <div class="widget big-stats-container"> 
                <form id="frmconcursos" name="frmconcursos" role="form"> 
                <table class="span6">
                    <tr><td style="width:50%">
                            <div class="control-group">											
                                <label class="control-label" for="firstname">Codigo Concurso</label>
                                <div class="controls">
                                  <input class="span2" id="codigo" name="codigo" placeholder="Código" type="text"/>                                   
                                     
                                </div> <!-- /controls -->                                       
                           </div>                            
                        </td>
                    </tr></table>                
                <table class="span6">                   
                    <tr><td colspan="2">
                       <div class="control-group">											
                            <label class="control-label" for="nombre">Nombre del Concurso</label>
                            <div class="controls">
                                    <input class="span5" id="nombre" name="nombre" placeholder="Nombre completo del concurso" type="text">
                            </div> <!-- /controls -->				
                       </div>  
                    </td></tr>
                    <tr><td colspan="2">
                        <div class="control-group">											
                            <label class="control-label" for="premio">Descripción del premio</label>
                            <div class="controls">
                                    <input class="span5" id="premio" name="premio" placeholder="Descripción del premio" type="text">
                            </div> <!-- /controls -->				
                       </div>  
                    </td></tr> 
                    <tr><td>
                        <div class="control-group">											
                            <div class="controls">
                                <label class="control-label" for="cantidad">Cantidad de Premios</label>
                                <input class="span2" id="cantidad" name="cantidad" placeholder="Cantidad" type="text">                         
                            </div>
                        </div>   
                    </td>
                    <td><div class="control-group">											
                            <div class="controls">
                                <label class="control-label" for="Estado">Estado</label>
                                  <select class="span2" id="estado" name="estado">
                                      <option value="ac">Activo</option>
                                      <option value="ce">Cerrado</option>
                                      <option value="de">Descartado</option>
                                  </select>                          
                            </div>
                        </div>   
                    </td></tr>                     
                </table>                         
              </form> 
                <table class="span5"><tr><td style="text-align:center;" colspan="2">  
                    <div class="control-group align-center">											
                      <div class="controls align-center">
                          <div class="span3">&emsp;</div>
                          <button class="btn-small btn-success span2" onclick="guarda_concurso();">Guardar </button>
                      </div>	                               
                    </div> 
                </td></tr></table>               
            </div>
          </div>                                                      
          </div>                            	    
          <div class="span5">    
              <div class="widget-header"> <i class="icon-list-alt"></i>
                  <h3>Concursos Disponibles</h3>
              </div>
          <div class="widget-content">
              <div class="widget big-stats-container" id="tb_existe"> 
                  <table class="table table-striped table-bordered span4">
                      <thead>
                        <th style="width:5%;text-align:center;">Codigo</th>
                        <th style="width:50%;">Nombre del Concurso</th>
                        <th style="width:5%;text-align:center;">Estado</th>
                        <th style="width:20%;text-align:center;">Click</th>
                      </thead>
                    <?php 
                    foreach($concurso as $fila)
                    { ?>
                      <tr>
                          <td style="text-align:center;"><?=$fila->id?></td>
                          <td><?=$fila->nombre?></td>
                          <td style="text-align:center;"><?=$fila->estado?></td>
                          <td class="td-actions"style="text-align:center;">
                              <a href="javascript:con_concurso(<?=$fila->id?>);" class="btn btn-small btn-success "><i class="btn-icon-only icon-ok"></i></a>
                          </td>
                      </tr>                      
                    <?php
                    }?>                        
                  </table>
              </div>
          </div>   
          </div>    
          </div> <!-- /widget -->
      </div> <!-- /span8 -->  
</div></div>  
<script>
function con_concurso(id){
   var url='<?=site_url();?>/consulta/co_concurso/'+id;
    $.ajax({
            url:url,
            type:'POST',
            success:function(respuesta){
                 var registros = eval(respuesta);                   
                    if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {
                             document.getElementById("codigo").value= registros[i]["id"];
                             document.getElementById("nombre").value= registros[i]["nombre"];
                             document.getElementById("premio").value= registros[i]["descripcion"];
                             document.getElementById("cantidad").value= registros[i]["cantidad"];
                             document.getElementById("estado").value= registros[i]["estado"];
                            }
                    }                
            },
            error:function(respuesta){
                    alert("Error: "+respuesta);
            }                    
    });    

}  
function guarda_concurso(){
    var url='<?=site_url();?>/guardar/in_inscrito';
    $.ajax({
            url:url,
            data:$("#frmconcursos").serialize(),
            type:'POST',
            success:function(){
                intext('#contenido','<?=site_url()?>/principal/concursos');
            },
            error:function(respuesta){
                    alert("Error: "+respuesta);
            }                    
    });        
}
</script>
