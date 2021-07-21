    <div class="row">
    <fieldset>
        <legend align="center"><b> Gestión de Clientes</b></legend>             
    </fieldset>
</div>
<div style="margin-top: 1%"></div>

<div class="box box-default">
        <div class="box-header with-border">
          <h4 class="box-title">Clientes Existentes</h4>
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
                <th width="10%">Identificación</th>
                <th width="50%">Nombre/Razon Social</th>
                <th width="20%">Teléfono Fijo/Celular</th>
                <th width="20%">e-mail</th>
                <th width="10%" style="alignment-adjust: center">Consultar</th>         
        </tr></thead>
        <?php
            foreach($datos as $fila)
                { ?>
        <tr>
            <td align="center"><?=$fila->cli_nit?></td>
            <td><?=$fila->cli_razon?></td>  
            <td><?=$fila->cli_fijo."/".$fila->cli_movil?></td>
            <td><?=$fila->cli_email?></td>
            <td><a href="javascript:;" onclick="mostrarCliente(this)">
                    <img src="<?=base_url()?>img/ver.png" width="30" height="30" alt="consultar"/></a></td>
        </tr><?php }?>  
        </table></div></div>
</div><!-- /.box -->
</div>

<!-- Modal -->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Elemento Cliente</h4>
      </div>
      <div class="modal-body">
          <form id="frmnuevo" name="frmnuevo" role="form"> 
            <table>
                <tr><td style="width: 5%"></td><td>    
                <label for="id">No. Identificación</label>                
                    <div class="input-group">   
                        <input class="form-control" type="text" id="id" name="id"  size="30" required onkeypress="return solonum(event)">
                    </div></td></tr>
                <tr><td style="width: 5%"></td><td colspan="2">    
                    <label for="razon">Nombre/Razón Social</label>     
                    <div class="input-group">               
                        <input class="form-control" type="text" id="nombre" name="nombre"  maxlength="100" size="70" required>
                    </div></td></tr>
                <tr><td style="width: 5%"></td><td colspan="2">
                    <label for="dir">Dirección</label>     
                    <div class="input-group">               
                        <input class="form-control" type="text" id="dir" name="dir"  maxlength="100" size="70" required>
                    </div></td></tr>
                <tr><td style="width: 5%"></td><td>
                    <label for="fijo">Teléfono Fijo</label>     
                    <div class="input-group">               
                        <input class="form-control" type="text" id="fijo" name="fijo"  maxlength="25" size="30" required>
                    </div></td>
                <td>
                    <label for="movil">No. Movil</label>     
                    <div class="input-group">               
                        <input class="form-control" type="text" id="movil" name="movil"  maxlength="25" size="32" required>
                    </div></td></tr>              
                <tr><td style="width: 5%"></td><td colspan="2">
                    <label for="email">email</label>     
                    <div class="input-group">               
                        <input class="form-control" type="text" id="email" name="email"  maxlength="100" size="70" required>
                    </div></td></tr>                    
                <tr><td style="width: 5%"></td><td>
                    <label for="regimen">Ciudad</label>     
                    <div class="input-group">               
                        <select class="form-control select2" id="ciudad" name="ciudad" required>
                                <option value="" selected>Seleccione Ciudad</option>
                                <?php 
                                foreach($ciudad as $fila)
                                { ?>
                                    <option value="<?=$fila->ciu_codigo?>"><?=$fila->ciu_nombre?></option>
                                <?php
                                }?>
                            </select>
                    </div></td>                    
                <td><label for="regimen">Régimen Tributario</label>     
                    <div class="input-group">               
                        <select class="form-control select2" id="regimen" name="regimen" required>
                                <option value="" selected>Seleccione Régimen</option>
                                <option value="1"  >Régimen Común</option>
                                <option value="2"  >Régimen Simplificado</option>
                                <option value="3"  >Gran Contribuyente</option>
                            </select>
                    </div></td></tr>
                <tr><td style="width: 5%"></td><td>
                    <label for="contacto">Nombre Contacto</label>     
                    <div class="input-group">               
                        <input class="form-control" type="text" id="contacto" name="contacto" maxlength="50" size="30">
                    </div></td>
                    <td>
                        <label for="cargo">Cargo del Contacto</label>     
                        <div class="input-group">               
                            <input class="form-control" type="text" id="cargo" name="cargo" maxlength="50" size="32">
                        </div></td></tr> 
                <tr><td style="width: 5%"></td><td>
                    <label for="telcon">Telefono del Contacto</label>     
                    <div class="input-group">               
                        <input class="form-control" type="text" id="telcon" name="telcon" maxlength="25" size="30">
                    </div></td>
                    <td>    
                        <label for="mailcon">email del Contacto</label>     
                        <div class="input-group">               
                            <input class="form-control" type="text" id="mailcon" name="mailcon" maxlength="100" size="32">
                        </div></td></tr>
            </table>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="gcliente()">Agregar</button>
              </div>              
        </form>
      </div>
    </div>
  </div>
</div> 
<div class='modal fade' id='consultar' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'></div>
<div class='modal fade' id='editar' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'></div>    
<script>
    function solonum(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key);
       numeros="0123456789";
       especiales = "8-37-39-46";

       tecla_especial = false;
       for(var i in especiales){
            if(key === especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(numeros.indexOf(tecla)===-1 && !tecla_especial){
            return false;
        }
    }
    
    function gcliente(){
        if(document.getElementById("id").value !== "" &&
           document.getElementById("nombre").value !== "" &&
           document.getElementById("fijo").value !== "" &&
           document.getElementById("movil").value !== "" &&
           document.getElementById("email").value !== "" &&
           document.getElementById("regimen").value !== "" &&
           document.getElementById("contacto").value !== "" &&
           document.getElementById("cargo").value !== "" &&
           document.getElementById("telcon").value !== "" &&
           document.getElementById("ciudad").value !== "" &&
           document.getElementById("mailcon").value !== ""){
           $("#agregar").modal("hide");
            $.ajax({
                    url:'<?=site_url();?>/config/nuevoCliente',
                    type:'POST',
                    data:$("#frmnuevo").serialize(),
                    success:function(){
                            alert("Registro Guardado!");
                    }
            });
        }
    }
    
     function updateCliente(){
        if(document.getElementById("uid").value !== "" &&
           document.getElementById("unombre").value !== "" &&
           document.getElementById("ufijo").value !== "" &&
           document.getElementById("umovil").value !== "" &&
           document.getElementById("uemail").value !== "" &&
           document.getElementById("uregimen").value !== "" &&
           document.getElementById("ucontacto").value !== "" &&
           document.getElementById("ucargo").value !== "" &&
           document.getElementById("utelcon").value !== "" &&
           document.getElementById("uciudad").value !== "" &&
           document.getElementById("umailcon").value !== ""){
           $("#editar").modal("hide");
            $.ajax({
                    url:'<?=site_url();?>/config/editarCliente',
                    type:'POST',
                    data:$("#frmEditar").serialize(),
                    success:function(){
                            alert("Registro Actualizado!");
                    }
            });
        }
    }   
        
    function mostrarCliente(nodo){  
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;
           $.ajax({
            url:"<?=site_url();?>/consulta/consulta_cliente",
            type:"POST",
            data:{buscar:campo},
            success:function(respuesta){
               var registros = eval(respuesta);                       
                 for (i=0; i<registros.length; i++) { 
                     if(registros[i]["cli_tregimen"]==='1'){var reg="Régimen Simplificado";}
                     else if (registros[i]["cli_tregimen"]==='2') {reg="Regimen Común";}
                     else {reg="Gran Contribuyente";}
                     html ="<div class='modal-dialog' role='document'>"+
                             "<div class='modal-content'>"+
                             "<div class='modal-header'>"+
                             "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+ 
                             "<h4 class='modal-title' id='myModalLabel'>Consultar Cliente</h4>"+
                             "</div>"+
                             "<div class='modal-body'>"+
                             "<table>"+ 
                             "<tr><td style='width: 5%'></td><td>"+    
                             "<label for='id'>No. Identificación</label>"+                
                             "<div class='input-group'>"+   
                             "<input class='form-control' type='text' value='"+registros[i]["cli_nit"]+"' Readonly>"+ 
                             "</div></td></tr>"+
                             "<tr><td style='width: 5%'></td><td colspan='2'>"+     
                             "<label for='razon'>Nombre/Razón Social</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_razon"]+" size='70' readonly>"+ 
                             "</div></td></tr>"+
                              "<tr><td style='width: 5%'></td><td colspan='2'>"+     
                             "<label for='razon'>Dirección</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_direccion"]+" size='70' readonly>"+ 
                             "</div></td></tr>"+
                             "<tr><td style='width: 5%'></td><td>"+
                             "<label for='fijo'>Teléfono Fijo</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_fijo"]+" readonly>"+
                             "</div></td>"+
                             "<td><label for='movil'>No. Movil</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_movil"]+" readonly>"+
                             "</div></td></tr>"+              
                             "<tr><td style='width: 5%'></td><td colspan='2'>"+     
                             "<label for='razon'>email</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_email"]+" size='70' readonly>"+ 
                             "</div></td></tr>"+                   
                             "<tr><td style='width: 5%'></td><td>"+
                             "<label for='regimen'>Ciudad</label>"+    
                             "<div class='input-group'>"+   
                             "<input class='form-control' type='text' value="+registros[i]["ciu_nombre"]+" readonly>"+
                             "</div></td>"+                    
                             "<td><label>Regimen Tributario</label>"+    
                             "<div class='input-group'>"+   
                             "<input class='form-control' type='text' value="+reg+" readonly>"+
                             "</div></td>"+ 
                             "<tr><td style='width: 5%'></td><td>"+
                             "<label for='contacto'>Nombre Contacto</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_contacto"]+" readonly>"+
                             "</div></td>"+
                             "<td>"+
                             "<label for='cargo'>Cargo del Contacto</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_cargo"]+" readonly>"+
                             "</div></td></tr>"+ 
                             "<tr><td style='width: 5%'></td><td>"+
                             "<label for='telcon'>Telefono del Contacto</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_telcon"]+" readonly>"+
                             "</div></td>"+
                             "<td><label for='mailcon'>email del Contacto</label>"+     
                             "<div class='input-group'>"+               
                             "<input class='form-control' type='text' value="+registros[i]["cli_mailcon"]+" readonly>"+
                             "</div></td></tr></table>"+                              
                             "<div class='modal-footer'>"+
                             "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>"+
                             "<button type='button' class='btn btn-primary' onclick='editarCliente("+registros[i]["cli_nit"]+")'>Editar</button>"+
                             "</div></div></div></div>"; 
                 }
                 $("#consultar").html(html);
                 $("#consultar").modal("show");
                }   
           });
   }
   ///Revisar
    function editarCliente(orden){  
        $("#consultar").modal("hide");
           $.ajax({
            url:"<?=site_url();?>/consulta/consulta_cliente",
            type:"POST",
            data:{buscar:orden},
            success:function(respuesta){
               var registros = eval(respuesta); 
                 for (i=0; i<registros.length; i++) { 
                     if(registros[i]["cli_tregimen"]==='1'){var reg="Régimen Simplificado";}
                     else if (registros[i]["cli_tregimen"]==='2') {reg="Regimen Común";}
                     else {reg="Gran Contribuyente";}
                        html ="<div class='modal-dialog' role='document'>"+
                              "<div class='modal-content'>"+
                              "<div class='modal-header'>"+
                              "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+ 
                              "<h4 class='modal-title' id='myModalLabel'>Consultar Cliente</h4>"+
                              "</div>"+
                              "<div class='modal-body'>"+
                              "<form id='frmEditar' name='frmEditar' role='form'>"+
                              "<table>"+ 
                              "<tr><td style='width: 5%'></td><td>"+    
                              "<label for='id'>No. Identificación</label>"+                
                              "<div class='input-group'>"+   
                              "<input class='form-control' type='text' id='uid' name='uid' value='"+registros[i]["cli_nit"]+"' size='30' required onkeypress='return solonum(event)'>"+ 
                              "</div></td></tr>"+
                              "<tr><td style='width: 5%'></td><td colspan='2'>"+     
                              "<label for='razon'>Nombre/Razón Social</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='unombre' name='unombre' value="+registros[i]["cli_razon"]+" maxlength='100' size='70' required>"+ 
                              "</div></td></tr>"+
                              "<tr><td style='width: 5%'></td><td colspan='2'>"+ 
                              "<label for='dir'>Dirección</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='udir' name='udir' value="+registros[i]["cli_direccion"]+" maxlength='100' size='70' required>"+
                              "</div></td></tr>"+
                              "<tr><td style='width: 5%'></td><td>"+
                              "<label for='fijo'>Teléfono Fijo</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='ufijo' name='ufijo' value="+registros[i]["cli_fijo"]+" maxlength='25' size='30' required>"+
                              "</div></td>"+
                              "<td><label for='movil'>No. Movil</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='umovil' name='umovil' value="+registros[i]["cli_movil"]+" maxlength='25' size='32' required>"+
                              "</div></td></tr>"+              
                              "<tr><td style='width: 5%'></td><td colspan='2'>"+
                              "<label for='email'>email</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='uemail' name='uemail' value="+registros[i]["cli_email"]+" maxlength='100' size='70' required>"+
                              "</div></td></tr>"+                    
                              "<tr><td style='width: 5%'></td><td>"+
                              "<label for='regimen'>Ciudad</label>"+     
                              "<div class='input-group'>"+               
                              "<select class='form-control select2' id='uciudad' name='uciudad' required>"+
                              "<option value="+registros[i]["ciu_nombre"]+"  selected>"+registros[i]["ciu_nombre"]+"</option>"+                          
                              "<td><label for='regimen'>Régimen Tributario</label>"+     
                              "<div class='input-group'>"+               
                              "<select class='form-control select2' id='uregimen' name='uregimen' required>"+
                              "<option value="+registros[i]["cli_tregimen"]+"  selected>"+reg+"</option>"+
                              "<option value='1'  >Régimen Común</option>"+
                              "<option value='2'  >Régimen Simplificado</option>"+
                              "<option value='3'  >Gran Contribuyente</option>"+
                              "</select></div></td></tr>"+
                              "<tr><td style='width: 5%'></td><td>"+
                              "<label for='contacto'>Nombre Contacto</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='ucontacto' name='ucontacto' value="+registros[i]["cli_contacto"]+" maxlength='50' size='30' required>"+
                              "</div></td>"+
                              "<td>"+
                              "<label for='cargo'>Cargo del Contacto</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='ucargo' name='ucargo' value="+registros[i]["cli_cargo"]+" maxlength='50' size='32' required>"+
                              "</div></td></tr>"+ 
                              "<tr><td style='width: 5%'></td><td>"+
                              "<label for='telcon'>Telefono del Contacto</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='utelcon' name='utelcon' value="+registros[i]["cli_telcon"]+" maxlength='25' size='30' required>"+
                              "</div></td>"+
                              "<td><label for='mailcon'>email del Contacto</label>"+     
                              "<div class='input-group'>"+               
                              "<input class='form-control' type='text' id='umailcon' name='umailcon' value="+registros[i]["cli_mailcon"]+" maxlength='100' size='32' required>"+
                              "</div></td></tr></table>"+                              
                              "<div class='modal-footer'>"+
                              "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>"+
                              "<button class='btn btn-primary' onclick='updateCliente()'>Guardar</button>"+
                              "</div></form></div></div></div>";
                  }
                 $("#editar").html(html);
                 $("#editar").modal("show");
                   
                }   
           });
   }
   
    function borrar(){
            cod = $(this).attr("href");
            alert(cod);
            $.ajax({
                    url:"<?=site_url();?>/principal/borrar_color",
                    type:"POST",
                    data:{id:cod},
                    success:function(){
                            alert("Registro Eliminado!");
                    }
            });
    }
</script>

