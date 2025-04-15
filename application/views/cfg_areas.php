<?php $t=time(); ?> 
<div class="row">
    <fieldset>
        <legend align="center"><b> Configuración - Areas</b></legend>             
    </fieldset>
</div>
<div style="margin-top: 1%"></div>

<div class="box box-default">
        <div class="box-header with-border">
          <h4 class="box-title">Registros Existentes</h4>
          <div class="box-tools pull-right">              
            <div class="has-feedback">
                <button class="btn btn-block btn-primary" type="button" data-toggle="modal" data-target="#agregar">Agregar Nuevo</button>
            </div>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class='box-header'>
        <div class='box-body'>
        <div id="listado">    
        <table id='tb_planchas' class='table table-bordered table-hover'>
        <thead><tr style='background-color: #F6CED8'>
                <th width="20%">Código</th>
                <th width="60%">Nombre del Área</th>
                <th width="10%">Eliminar</th>
                <th width="10%">Editar</th>            
        </tr></thead>
        <?php
            foreach($datos as $fila)
                { ?>
        <tr>
            <td align="center"><?=$fila->cfg_bri_codigo?></td>
            <td><?=$fila->cfg_bri_nombre?></td>  
            <td><a href="javascript:;" onclick="borrarArea(this)">
            <img src="<?=base_url();?>img/delete.png" width="20" height="20" /></a></td>
            <td><a href="javascript:;" onclick="editarArea(this)">
            <img src="<?=base_url();?>img/editar.png" width="20" height="20"/></a></td>
        </tr><?php }?>  
        </table></div></div>
</div><!-- /.box -->

<!-- Modal Agregar-->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ingresar Nueva Área</h4>
      </div>
      <div class="modal-body">
            <form id="frmnuevo" name="frmnuevo" role="form">         
              <label for="codigo">No. Código</label>                
              <div class="input-group">   
                  <input class="form-control" type="text" id="codigo" name="codigo" placeholder="No. Código" maxlength="5" required>
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
              </div>
              <label for="desc">Nombre del Área</label>     
              <div class="input-group">               
                  <input class="form-control" type="text" id="desc" name="desc" placeholder="Descripción" maxlength="20" required>
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button id="btnnuevo" type="submit" class="btn btn-primary" name="enviar" onclick="nuevaArea()">Agregar</button>
                </div>              
          </form>
      </div>
    </div>
  </div>
</div> 

<!-- Modal Actualizar-->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Nombre del Área</h4>
      </div>
        <div class="modal-body">
            <div id="diveditar"></div>
        </div>
    </div>
  </div>
</div> 
<script> 

    function nuevoArea(){
    if(document.getElementById("codigo").value !== "" &&
       document.getElementById("desc").value !== ""){  
       $("#agregar").modal("hide");
       $.ajax({
               url:"<?=site_url();?>/config/nuevoArea",
               type:"POST",
               data:$("#frmnuevo").serialize(),
               success:function(respuesta){
                       alert(respuesta);
               }
        });
        }  
    }
    function borrarArea(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;

        $.ajax({
                url:"<?=site_url();?>/config/borrarBrillo",
                type:"POST",
                data:{id:campo},
                success:function(respuesta){
                        alert(respuesta);
                }
        });
    }
    
    function editarArea(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;

         $.ajax({
            url:"<?=site_url();?>/consulta/consultaBrillo",
            type:"POST",
            data:{buscar:campo},
            success:function(respuesta){
               var registros = eval(respuesta); 
                 for (i=0; i<registros.length; i++) { 
                    html="<form id='frmeditar' name='frmeditar' role='form'>"+         
                            "<label for='codigo'>No. Código</label>"+                
                            "<div class='input-group'>"+  
                            "<input class='form-control' type='text' id='ucodigo' name='ucodigo' value='"+registros[i]["bri_codigo"]+"'  placeholder='No. Código' maxlength='5' readonly>"+
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>"+
                            "<label for='desc'>Descripción</label>"+     
                            "<div class='input-group'>"+               
                            "<input class='form-control' type='text' id='udesc' name='udesc' value='"+registros[i]["bri_nombre"]+"' placeholder='Descripción' maxlength='50'>"+
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>"+
                            "<div class='modal-footer'>"+
                            "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>"+
                            "<button id='btneditar' type='submit' class='btn btn-primary' name='enviar' onclick='updateBrillo()'>Guardar</button>"+
                            "</div></form>";   
                 $("#diveditar").html(html);
                 $("#editar").modal("show");
                   }
                }   
           });
 
    }

     function updateArea(){
        if(document.getElementById("ucodigo").value !== "" &&
           document.getElementById("udesc").value !== ""){
           $("#editar").modal("hide");
            $.ajax({
                    url:'<?=site_url();?>/config/editarBrillo',
                    type:'POST',
                    data:$("#frmeditar").serialize(),
                    success:function(respuesta){
                            alert(respuesta);
                    }
            });
        }
    } 
</script>