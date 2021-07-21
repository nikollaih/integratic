<div class="row">	      	
  <div class="span12">      			      		
      <div class="widget ">	      			
          <div class="widget-header"> 
              <i class="icon-user"></i>
              <h3>Gestión de Consursantes</h3>
          </div> <!-- /widget-header -->					
          <div class="widget-content">  
          <div class="span6">    
              <div class="widget-header"> <i class="icon-list-alt"></i>
                  <h3>Datos Personales</h3>
              </div>
          <div class="widget-content">
            <div class="widget big-stats-container">                                                         
                  <div class="control-group">	                  										
                      <label class="control-label" for="firstname">No. Identificación</label>
                      <div class="controls">
                        <input class="span2" id="id" name="id" placeholder="Numero de Identificación" type="text"/> 
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <button class="btn-small btn-success" onclick="con_persona();">Consultar</button>   
                      </div> <!-- /controls -->                                       
                 </div>
                 <form id="frmpersona" name="frmpersona" role="form">
                  <input id="doc" name="doc" type="hidden"/>
                  <div class="control-group">											
                      <label class="control-label" for="firstname">Nombre Completo</label>
                      <div class="controls">
                              <input class="span5" id="nombre" name="nombre" placeholder="Nombre completo del concursante" type="text">
                      </div> <!-- /controls -->				
                 </div>
                  <div class="control-group">                     
                      <label class="control-label" for="genero">Género</label>
                      <div class="controls">
                          <select class="span5" id="genero" name="genero">
                              <option value="" selected>Seleccione Género</option>
                              <option value="M">Masculino</option>
                              <option value="F">Femenino</option>
                          </select>
                      </div> <!-- /controls -->       
                 </div>                   
                  <div class="control-group">											
                      <label class="control-label" for="firstname">Municipio</label>
                      <div class="controls">
                          <select class="span5" id="municipio" name="municipio" onchange="co_barrios();">
                              <option value="" selected>Seleccione Municipio</option>
                              <?php 
                              foreach($muni as $fila)
                              { ?>
                              <option value="<?=$fila->codigo?>"><?=$fila->nombre?></option>
                              <?php
                              }?>                                        
                          </select>
                      </div> <!-- /controls -->				
                 </div>                                   
                  <div class="control-group">											
                      <label class="control-label" for="barrio">Nombre del Barrio</label>
                      <div class="controls" id="selbarrios">
                          <select class="span5" id="barrio" name="barrio"><option>Seleccione Barrio</option></select>
                      </div> <!-- /controls -->				
                 </div>                              
                  <div class="control-group" id="creadir">											
                      <label class="control-label" for="direccion">Dirección Física</label>
                      <div class="controls">
                          <input class="span5" id="direccion" name="direccion" placeholder="Dirección Completa" type="text" disabled>
                      </div> <!-- /controls -->				
                 </div>
                  <div class="control-group">											
                      <label class="control-label" for="mail">Dirección e-mail</label>
                      <div class="controls">
                              <input class="span5" id="mail" name="mail" placeholder="Correo Electrónico" type="text">
                      </div> <!-- /controls -->				
                 </div>    
                  <div class="control-group">											
                      <div class="controls">
                          <label class="control-label" for="telefono">Teléfonos de contacto Fijo/Movil</label>
                          <input class="span25" id="telefono" name="telefono" placeholder="Telefono Fijo/Móvil" type="text">

                      </div>	                                
                 </div>
              </form>     
             <div class="control-group">											
                  <div class="controls" style="text-align:center;">
                      <button class="btn-small btn-success span2" onclick="guarda_persona();">Guardar</button>
                  </div>	                               
             </div>                              
            </div>
          </div>                                                      
          </div>                            	    
          <div class="span5">   
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3>Concursos Activos</h3>
            </div>   
              <div class="widget-content">
                  <select class="span4" id="concurso" name="concurso"><option selected disabled>Seleccione Concurso</option>
                      <?php 
                      foreach($concursoac as $fila)
                      { ?>
                        
                      <option value="<?=$fila->id?>"><?=$fila->nombre?></option>                                             
                      <?php
                      }?>  
                  </select>&emsp;&emsp;
                  <a href="javascript:agg_concurso();" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i></a>
              </div> 
              <br>  
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3>Concursos Inscritos</h3>
            </div>
            <div class="widget-content">
                <div class="widget big-stats-container" id="div_inscrito">
                    <table class="table table-striped table-bordered span4" id="tb_inscritos">
                        <thead>
                          <th style="width:10%;text-align:center;">Codigo</th>
                          <th style="width:70%;">Nombre del Concurso</th>
                          <th style="width:10%;text-align:center;">Remover</th>
                        </thead>                      
                    </table>                  
                </div>
            </div>   
          </div>    
          </div> <!-- /widget -->
      </div> <!-- /span8 -->  
</div></div> 
<script>
    function con_persona(){
        document.getElementById("nombre").value= '';
        document.getElementById("municipio").value= '';
        document.getElementById("barrio").value= '';
        document.getElementById("direccion").value= '';
        document.getElementById("mail").value= '';
        document.getElementById("telefono").value= '';
        document.getElementById("doc").value=document.getElementById("id").value;
        var id = document.getElementById("id").value;
        $.ajax({
            url:'<?=site_url();?>/consulta/co_persona/'+id,
            type:'POST',
            success:function(respuesta){
                 var registros = eval(respuesta);                   
                    if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {
                             document.getElementById("nombre").value= registros[i]["nombre"];
                             document.getElementById("municipio").value= registros[i]["municipio"];
                             co_barrios();
                             document.getElementById("barrio").value= registros[i]["barrio"];
                             document.getElementById("direccion").value= registros[i]["direccion"];
                             document.getElementById("mail").value= registros[i]["mail"];
                             document.getElementById("telefono").value= registros[i]["telefono"];
                            }
                    }
            }
        });
         $("#div_inscrito").html(''); 
        co_inscritos(id);      
    }
    function crea_direccion(){
        var combo = document.getElementById("barrio");
        var bar = combo.options[combo.selectedIndex].value; 
        var url='<?=site_url();?>/consulta/co_barrio';
        $.ajax({
                url:url,
                data:{bar:bar},
                type:'POST',
                success:function(respuesta){
                    var registros = eval(respuesta);                   
                          if(registros.length>0){ 
                              for (i=0; i<registros.length; i++) {
                                 html='<div class="control-group" id="creadir">'; 
                                 html+='<select class="span2" id="tiponom" onchange="dir_segunda();">';
                                 html+='<option>Seleccione</opction>';
                                 html+='<option value="1">Mz.</opction>';
                                 html+='<option value="2">Cra.</opction>';
                                 html+='<option value="3">Clle.</opction>';
                                 html+='<option value="4">Blq.</opction>';
                                 html+='<option value="5">Casa</opction>';
                                 html+='</select>';;
                                 html+='</div>'; 
                              }     
                       }                
                    $("#creadir").html(html);
                },
                error:function(respuesta){
                        alert("Error: "+respuesta);
                }                    
        });        				
        $("#creadir").html(html);
    }   
    function dir_segunda(){
        var combo = document.getElementById("tiponom");
        var tipo = combo.options[combo.selectedIndex].value;  
        var nom = combo.options[combo.selectedIndex].text;
        var dir1 = document.getElementById("dir1");
        var html='';
        switch(tipo){
            case '1':
                html+='&nbsp;Mz.&nbsp;<input class="span1" id="dir1" name="dir1" type="text">';
                html+='&nbsp;Cs.&nbsp;<input class="span1" id="dir2" name="dir2"/>';
                html+='<label>Información Adicional</label><input class="span5" id="dir3" name="dir3"/>';
                break;              
            case '2':
                html+='&nbsp;Cra.&nbsp;<input class="span1" id="dir1" name="dir1" type="text">';
                html+='&nbsp;No.&nbsp;<input class="span1" id="dir2" name="dir2"/>-<input class="span1" id="dir2a" name="dir2a"/>';
                html+='<label>Información Adicional</label><input class="span5" id="dir3" name="dir3"/>';
                break;
            case '3':
                html+='&nbsp;Clle.&nbsp;<input class="span1" id="dir1" name="dir1" type="text">';
                html+='&nbsp;No.&nbsp;<input class="span1" id="dir2" name="dir2">-<input class="span1" id="dir2a" name="dir2a">';
                html+='<label>Información Adicional</label><input class="span5" id="dir3" name="dir3"/>';
                break;    
            case '4':
                html+='&nbsp;Blq.&nbsp;<input class="span1" id="dir1" name="dir1" type="text">';
                html+='&nbsp;Apto.&nbsp;<input class="span1" id="dir2" name="dir2"/>';                
                html+='<label>Información Adicional</label><input class="span5" id="dir3" name="dir2"/>';
                break;   
            case '5':
                html+='&nbsp;Casa No.&nbsp;<input class="span1" id="dir1" name="dir1" type="text">';               
                html+='<label>Información Adicional</label><input class="span5" id="dir2" name="dir2"/>';
                break;                 
        }
        html+='<input id="tipo" name="tipo" value="'+tipo+'" type="hidden"/>';
        html+='<input id="dire" name="dire" type="hidden"/>';
        $("#creadir").html(html);
    }
    function guarda_persona(){
        var tipo = document.getElementById("tipo").value;
        var dir1 = document.getElementById("dir1").value;
        var dir2 = document.getElementById("dir2").value;
        var dir3 = document.getElementById("dir3").value;
        var dire='';
        switch(tipo){
            case'1':dire="Mz. "+dir1+" Cs. "+dir2+" "+dir3;break;
            case'2':dire="Cra. "+dir1+" No. "+dir2+"-"+document.getElementById("dir2a").value+" "+dir3;break;
            case'3':dire="Clle. "+dir1+" No. "+dir2+"-"+document.getElementById("dir2a").value+" "+dir3;break; 
            case'4':dire="Blq. "+dir1+" Apto. "+dir2+" "+dir3;break;  
            case'5':dire="Casa No. "+dir1+" Cs. "+dir2;break;    
        }
        document.getElementById("dire").value=dire;
        var url='<?=site_url();?>/guardar/in_persona';
        $.ajax({
                url:url,
                data:$("#frmpersona").serialize(),
                type:'POST',
                success:function(respuesta){alert(respuesta);},
                error:function(respuesta){alert("Error: "+respuesta);}                    
        });        
    }
function co_barrios(){
        var combo = document.getElementById("municipio");
        var mun = combo.options[combo.selectedIndex].value; 
        var url='<?=site_url();?>/consulta/co_barrios';
        $.ajax({
                url:url,
                data:{mun:mun},
                type:'POST',
                success:function(respuesta){
                    var registros = eval(respuesta);                   
                          if(registros.length>0){ 
                              html='<select class="span5" id="barrio" name="barrio" onchange="crea_direccion();">';
                              html+='<option value="" selected>Seleccione Barrio</option>';
                              for (i=0; i<registros.length; i++) {
                                html+='<option value="'+registros[i]["id"]+'">'+registros[i]["nombre"]+'</option>';                                                                        
                              }  
                              html+='</select>';
                       }                
                    $("#selbarrios").html(html);
                },
                error:function(respuesta){
                        alert("Error: "+respuesta);
                }                    
        });        				
}   
function agg_concurso(){
  id=document.getElementById("id").value;
  cod=document.getElementById("concurso").value;
  if(id){
    var url='<?=site_url();?>/guardar/in_inscrito';
    $.ajax({
            url:url,
            data:{id:id,cod:cod},
            type:'POST',
            success:function(){
              co_inscritos(id);               
            },
            error:function(respuesta){
                    alert("Error: "+respuesta);
            }                    
    }); 
   } else{alert("Ingrese Consursante!")}
}
function co_inscritos(id){
          $.ajax({
            url:'<?=site_url();?>/consulta/co_inscrito/'+id,
            type:'POST',
            success:function(respuesta){
                 var registros = eval(respuesta);                   
                    if(registros.length>0){ 
                              html='<table class="table table-striped table-bordered span4" id="tb_inscritos">';
                              html+='<thead><th style="width:10%;text-align:center;">Codigo</th>';
                              html+='<th style="width:70%;">Nombre del Concurso</th>';
                              html+='<th style="width:10%;text-align:center;">Remover</th>';
                              html+='</thead>';                      
                          for (i=0; i<registros.length; i++) {
                              html+='<tr><td style="width:10%;text-align:center;">'+registros[i]["concurso"]+'</td>';
                              html+='<td style="width:70%;">'+registros[i]["nombre"]+'</td>';
                              html+='<td style="width:10%;text-align:center;">';
                              html+='<a href="javascript:bo_inscrito('+id+','+registros[i]["concurso"]+');" class="btn btn-small btn-danger"><i class="btn-icon-only icon-remove"></i></a></td>';
                              html+='</tr>';
                            }
                            html+='</table';
                            $("#div_inscrito").html(html);                            
                    }
            },
                error:function(respuesta){alert("Error: "+respuesta);}           
        });  
}
function bo_inscrito(id,con){
          $.ajax({
            url:'<?=site_url();?>/borrar/bo_inscrito/'+id+'/'+con,
            type:'POST',
            success:function(respuesta){co_inscritos(id);},
            error:function(respuesta){alert("Error: "+respuesta);}           
        });   
}
</script>