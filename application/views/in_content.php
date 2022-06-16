<div class="content-page">
    <div class="content">  
        <div class="container">
            <div class="row" id="migas"></div>  
            <div id="contenedor"></div>
        </div> <!-- container -->                               
    </div> <!-- content -->
</div>
<!-- Modals -->
<?php $this->load->view("foros/template/crear_foro_modal"); ?>
<?php $this->load->view("anuncios/crear_anuncio_modal"); ?>
<?php $this->load->view("actividades/crear_actividad_modal"); ?>
<?php $this->load->view("actividades/crear_respuesta_actividad_modal"); ?>
<?php $this->load->view("actividades/lista_respuestas_modal"); ?>
<!-- Ventana Modal Portada-->
<?php 
    if(!$this->session->userdata("logged_in")){
?>
    <div class="modal fade" id="portada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-colored">      
        <div class="modal-body">
                <img src="./img/<?= configuracion()["modal_principal"] ?>"  width="100%" height="100%">            
        </div>
        <div class="modal-footer">
            <form id="frmpersona" name="frmpersona" role="form">
                <table> 
                    <tr>
                    <td width='30%'></td>
                    <td width='30%'><h6></h6></td>
                    <td width='10%'></td>
                    <td width='20%'>                                                              
                    <!-- <input class="form-control" size="50" type="text" name="documento" id="documento">-->
                    </td>
                        
                    <td width='10%'><button style="margin-right: 15px;" type='button' class='btn btn-primary btn-sm w-sm waves-effect waves-light' data-dismiss="modal" onclick='prelogin();'>Ingresar</button></td>  
                    <td width='10%'></td>                              
                    <td width='10%'>
                        <button type='button' class='btn btn-dark btn-sm w-sm waves-effect waves-light' data-dismiss="modal" onclick='login_estudiante();'>Continuar como invitado</button>
                    </td>
                    </tr>                               
                </table>
            </form>        
        </div>        
        </div>
    </div>
    </div> 
<?php
    }
?>

<!-- Ventana Modal Creditos-->
<div class="modal fade" id="creditos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-colored">      
      <div class="modal-body">
                <img src="./img/creditos.png"  width="100%" height="100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>        
    </div>
  </div>
</div> 
<!-- Ventana Modal Crear-->
<div class="modal fade" id="creardir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear nuevo directorio</h4>
      </div>
      <div class="modal-body">
          <form id="frmavance" name="frmavance" role="form">
              <table> 
                  <tr><td width='10%'></td><td width='80%'>
                    <h6>Nombre del Directorio a crear</h6>                                           
                    <input class="form-control" size="50" type="text" name="nomdir" id="nomdir">
                </td></tr>                               
                </table>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btn-creardir" type="button" class="btn btn-primary" onclick="creadir();">Crear</button>
      </div>
    </div> 
  </div>
</div> 
<!-- Ventana Modal Renombrar-->
<div class="modal fade" id="renombrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Renombrar un Archivo</h4>
      </div>
      <div class="modal-body">
          <form id="frmavance" name="frmavance" role="form">
              <table>               
                  <tr><td width='10%'></td><td width='80%'>
                        <h6>Nuevo Nombre</h6>                    
                    <input class="form-control" size="50" name="nuevo" id="nuevo" required>
                    </td></tr>               
                </table>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="button-modal-renombrar" type="button" class="btn btn-primary" onclick="ren_archivo();">Renombrar</button>
      </div>
    </div>
  </div>
</div>  
<!-- Ventana Modal Subir Archivos-->
<div class="modal fade" id="subir_archivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir un Archivo</h4>
      </div>
      <div class="modal-body">
          <form id="frmsubir" name="frmsubir" enctype="multipart/form-data">
              <input id="archivo" name="archivo[]" multiple type="file"/>
              <input id="dir" name="dir" type="hidden"/>
          </form>
      </div>
      <div class="row center"><div class="col-md-9 col-md-offset-5" id="carga"></div>
      <div class="modal-footer" id="pie_carga"></div>      
      </div>
    </div>
  </div>
</div>
<!-- Ventana Modal Subir Actividad-->
<div class="modal fade" id="modsubiract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir un Archivo</h4>
      </div>
      <div class="modal-body">
          <form id="frmsubiract" name="frmsubiract" enctype="multipart/form-data">
              <input id="archivo" name="archivo" type="file"/>
              <input id="diract" name="diract" type="hidden"/>
              <input id="ubica" name="ubica" type="hidden"/>
          </form>
      </div>
        <div class="row center"><div class="col-md-9 col-md-offset-5" id="carga_acti"></div>
          <div class="modal-footer" id="pie_carga_acti"></div>    
      </div>
    </div>
  </div>
</div>
<!-- Modal Creación de Usuarios -->
<div class="modal fade" id="modal_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Creación de Usuarios</h4> 
            </div> 
            <form id="frmnuevo" name="frmnuevo" role="form">
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="ced" class="control-label">No. Cedula</label> 
                            <input class="form-control" id="ced" name="ced" placeholder="No. Cedula" type="text"> 
                        </div> 
                    </div>   
                </div>    
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="nombres" class="control-label">Nombres Completos</label> 
                            <input class="form-control" id="nombres" name="nombres" placeholder="Nombre Completo" type="text"> 
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="apellidos" class="control-label">Apellidos</label> 
                            <input class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" type="text"> 
                        </div> 
                    </div> 
                </div> 
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group"> 
                            <label for="cargo" class="control-label">Cargo</label> 
                            <input class="form-control" id="cargo" name="cargo" placeholder="Nombre del Cargo" type="text"> 
                        </div> 
                    </div> 
                </div> 
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="rol" class="control-label">Rol</label> 
                            <select class="form-control" id="rol" name="rol">
                                <option>Docente</option>
                                <option>Administrativo</option>
                            </select> 
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="cel" class="control-label">No. Celular</label> 
                            <input class="form-control" id="cel" name="cel" placeholder="No. Celular" type="text"> 
                        </div> 
                    </div> 
                </div> 
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="mail" class="control-label">Email</label> 
                            <input class="form-control" id="mail" name="mail" placeholder="Correo Electrónico" type="text"> 
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="pass" class="control-label">Password</label> 
                            <input class="form-control" id="pass" name="pass" placeholder="Password" type="password"> 
                        </div> 
                    </div> 
                </div> 
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button> 
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="creaUsuario();">Guardar</button> 
            </div>
        </form>         
        </div> 
    </div>
</div>    
<!-- Modal Asignacion de Materias -->
<div class="modal fade" id="modal_asigna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Estructura Académica</h4> 
            </div> 
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="docentes" class="control-label">Nombre del Docente</label>
                            <div id="lista_docentes">
                                <select class="form-control" id="docentes" name="docentes" onchange="lista_asg();">
                                    <?php 
                                    foreach($usua as $fila)
                                    { ?>
                                    <option value="<?=$fila->id?>"><?=$fila->nombres." ".$fila->apellidos." - ".$fila->rol?></option>
                                    <?php
                                    }?>                                    
                                </select>
                            </div>                             
                        </div>                
                    </div>                
                </div> 
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="materia" class="control-label">Asignaturas Disponibles</label>
                            <div id="lista_materias">
                                <select class="form-control" id="materia" name="materia"></select>
                            </div>
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="grupo" class="control-label">Grupo</label>
                            <select class="form-control" id="grupo" name="grupo">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>                        
                            </select>
                        </div> 
                    </div>                 
                </div> 
                <div class="row"> 
                    <div class="col-md-6">
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:val_asg();">Agregar</button> 
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:remover_asg();">Retirar</button>                         
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                        <label for="listado_asg" class="control-label">Asignaciones</label> 
                        <div id="lista_asignadas"></div>              
                        </div> 
                    </div>                 
                </div>                 
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button> 
            </div>        
        </div> 
    </div>      
</div>

<!-- Modal Ingreso de Areas -->
<div class="modal fade" id="modal_areas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Crear Nueva Area</h4> 
            </div> 
            <div class="modal-body"> 
            <form id="frmareas" name="frmareas" enctype="multipart/form-data">  
                <input id="icoarea-nueva-imagen" type="hidden" name="icoarea" value="null">
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="nomarea" class="control-label">Nombre del Area</label>
                            <input id='nomarea' name='nomarea'  class='form-control input-lg' required placeholder='Nombre del Area' type='text'>                            
                        </div>                
                    </div>                
                </div> 
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label for="archivo" class="control-label">Subir Icono/Imagen</label>
                            <input id="archivo" name="archivo" size="50" type="file"/>
                        </div> 
                    </div>                 
                </div> 
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label for="archivo" class="control-label">Elegir Icono/Imagen</label><br>
                            <a data-open="false" class="btn btn-sm btn-primary open-contenedor-imagenes-area">Ver imagenes</a>
                            <img id="selected-imagen-area" src="" class="" alt="" style="display-none;margin-top:10px;" width="250px">
                            <div id="contenedor-imagenes-area" style="display:none;">
                                <?php
                                $carpeta = './img/botones/areas';
                                if($dir = opendir($carpeta)){
                                    while(($archivo = readdir($dir)) !== false){ 
                                        if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                                            $ruta=$carpeta."/".$archivo;
                                            ?>
                                                <img data-url="<?= $ruta ?>" data-imagen="<?= $archivo ?>" class="set-imagen-area" src="<?= $carpeta ?>/<?= $archivo ?>" alt="<?= $archivo ?>">
                                            <?php                        
                                        } 
                                    }
                                    closedir($dir);
                                }
                                ?>
                            </div>
                        </div> 
                    </div>                 
                </div> 
            </form>    
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button> 
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal" onclick="crearArea();">Guardar</button> 
            </div>        
        </div> 
    </div>      
</div>
<!-- Modal Ingreso de Materias -->
<div class="modal fade" id="modal_materias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Crear Nueva Asignatura</h4> 
            </div> 
            <div class="modal-body"> 
            <form id="frmmaterias" name="frmmaterias" enctype="multipart/form-data">                    
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="areasmat" class="control-label">Nombre del Area</label>
                            <div id="lista_areas">
                                <select class="form-control" id="areasmat" name="areasmat">
                                <option>Seleccione</option>    
                                </select>
                            </div>
                        </div>                
                    </div>                
                </div> 
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="nommateria" class="control-label">Nombre de la Asignatura</label>
                            <input id='nommateria' name='nommateria'  class='form-control input-lg' required placeholder='Nombre de la Asignatura' type='text'>                            
                        </div>                
                    </div>                
                </div> 
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="grado" class="control-label">Grado</label>
                                <select class="form-control" id="grado" name="grado">
                                <option>Seleccione</option>    
                                <option value="0">Transición</option>  
                                <option value="1">Primero</option> 
                                <option value="2">Segundo</option>
                                <option value="3">Tercero</option>
                                <option value="4">Cuarto</option>
                                <option value="5">Quinto</option>
                                <option value="6">Sexto</option>
                                <option value="7">Séptimo</option>
                                <option value="8">Octavo</option>
                                <option value="9">Noveno</option>
                                <option value="10">Décimo</option>
                                <option value="11">Undécimo</option>
                                <option value="C1">Ciclo I</option>
                                <option value="C2">Ciclo II</option>
                                <option value="C3">Ciclo III</option>
                                <option value="C4">Ciclo IV </option>
                                <option value="C5">Ciclo V</option> 
                                <option value="C6">Ciclo VI</option>
                                <option value="P1">Pensar I</option>
                                <option value="P2">Pensar II</option>
                                <option value="P3">Pensar III</option> 
                                </select>
                        </div>                
                    </div>                      
                </div>                                
                <!-- <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label for="archivomat" class="control-label">Seleccionar Icono/Imagen</label>
                            <input id="archivomat" name="archivomat" type="file"/>
                        </div> 
                    </div>                 
                </div> -->
            </form>    
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button> 
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal" onclick="crearMateria();">Guardar</button> 
            </div>        
        </div> 
    </div>      
</div>
<!-- Modal Diferentes consultas -->
<div class="modal fade" id="modal_consultas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-whatever>
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <div id="con_titulo"></div> 
            </div> 
            <div class="modal-body">
                <div id="con_cuerpo"></div>    
            </div>   
            <div class="modal-footer"> 
                <div id="con_pie"></div>
            </div>        
        </div> 
    </div>      
</div>
<!-- Modal Diferentes ediciones -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <div id="edi_titulo"></div> 
            </div> 
            <div class="modal-body">
                <div id="edi_cuerpo"></div>    
            </div>   
            <div class="modal-footer"> 
                <div id="edi_pie"></div>
            </div>        
        </div> 
    </div>      
</div>
<!-- Modal Ingreso de Proyectos -->
<div class="modal fade" id="modal_proyectos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Crear Nuevo Proyecto Pedagógico</h4> 
            </div> 
            <div class="modal-body"> 
            <form id="frmProyecto" name="frmproyecto" enctype="multipart/form-data">
                <input id="icoproyecto-nueva-imagen" type="hidden" name="icoproyecto" value="null">      
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="nomproyecto" class="control-label">Nombre del Proyecto</label>
                            <input id='nomproyecto' name='nomproyecto'  class='form-control input-lg' required placeholder='Nombre del Proyecto' type='text'>                            
                        </div>                
                    </div>                
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label for="icopro" class="control-label">Subir Icono/Imagen</label>
                            <input id="icopro" name="icopro" size="50" type="file"/>
                        </div> 
                    </div>                 
                </div> 
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label for="archivo" class="control-label">Elegir Icono/Imagen</label><br>
                            <a data-open="false" class="btn btn-sm btn-primary open-contenedor-imagenes-proyecto">Ver imagenes</a>
                            <img id="selected-imagen-proyecto" src="" class="" alt="" style="display-none;margin-top:10px;" width="250px">
                            <div id="contenedor-imagenes-proyecto" style="display:none;">
                                <?php
                                $carpeta = './img/botones/proyectos';
                                if($dir = opendir($carpeta)){
                                    while(($archivo = readdir($dir)) !== false){ 
                                        if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                                            $ruta=$carpeta."/".$archivo;
                                            ?>
                                                <img data-url="<?= $ruta ?>" data-imagen="<?= $archivo ?>" class="set-imagen-proyecto" src="<?= $carpeta ?>/<?= $archivo ?>" alt="<?= $archivo ?>">
                                            <?php                        
                                        } 
                                    }
                                    closedir($dir);
                                }
                                ?>
                            </div>
                        </div> 
                    </div>                 
                </div> 
            </form>    
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button> 
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal" onclick="crearProyecto();">Guardar</button> 
            </div>        
        </div> 
    </div>      
</div>
<!-- Modal Ingreso de Procesos -->
<div class="modal fade" id="modal_procesos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Crear Nuevo Proceso Administrativo</h4> 
            </div> 
            <div class="modal-body"> 
            <form id="frmproceso" name="frmproceso" enctype="multipart/form-data">
            <input id="icoproceso-nueva-imagen" type="hidden" name="icoproceso" value="null">          
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="nomproc" class="control-label">Nombre del Proceso</label>
                            <input id='nomproc' name='nomproc' class='form-control input-lg' required placeholder='Nombre del Proceso' type='text'>                            
                        </div>                
                    </div>                
                </div> 
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label for="icoproc" class="control-label">Subir Icono/Imagen</label>
                            <input id="icoproc" name="icoproc" size="50" type="file"/>
                        </div> 
                    </div>                 
                </div>
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label for="archivo" class="control-label">Elegir Icono/Imagen</label><br>
                            <a data-open="false" class="btn btn-sm btn-primary open-contenedor-imagenes-proceso">Ver imagenes</a>
                            <img id="selected-imagen-proceso" src="" class="" alt="" style="display-none;margin-top:10px;" width="250px">
                            <div id="contenedor-imagenes-proceso" style="display:none;">
                                <?php
                                $carpeta = './img/botones/procesos';
                                if($dir = opendir($carpeta)){
                                    while(($archivo = readdir($dir)) !== false){ 
                                        if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                                            $ruta=$carpeta."/".$archivo;
                                            ?>
                                                <img data-url="<?= $ruta ?>" data-imagen="<?= $archivo ?>" class="set-imagen-proceso" src="<?= $carpeta ?>/<?= $archivo ?>" alt="<?= $archivo ?>">
                                            <?php                        
                                        } 
                                    }
                                    closedir($dir);
                                }
                                ?>
                            </div>
                        </div> 
                    </div>                 
                </div> 
            </form>    
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button> 
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal" onclick="crearProceso();">Guardar</button> 
            </div>        
        </div> 
    </div>      
</div>
<!-- Modal Asignacion de Proyectos -->
<div class="modal fade" id="modal_asignapro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Asignación de Proyectos Pedagógicos</h4> 
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="docentes" class="control-label">Nombre del Docente</label>
                            <div id="lista_prodocentes">
                                <select class="form-control" id="prodocentes" name="prodocentes" onchange="proyectos_asg();">
                                    <?php 
                                    foreach($usua as $fila)
                                    { ?>
                                    <option value="<?=$fila->id?>"><?=$fila->nombres." ".$fila->apellidos?></option>
                                    <?php
                                    }?>                                    
                                </select>
                            </div>                             
                        </div>                
                    </div>                
                </div> 
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="proyecto" class="control-label">Proyectos Disponibles</label>
                            <div id="lista_proyectos">
                                <select class="form-control" id="proyecto" name="proyecto"></select>
                            </div>
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                        <label for="listado_asg" class="control-label">Proyectos Asignados</label> 
                        <div id="lista_asignapro"></div>              
                        </div> 
                    </div>                 
                </div> 
                <div class="row"> 
                    <div class="col-md-6">
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:in_asignapro();">Agregar</button> 
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:remover_pro();">Retirar</button>                         
                    </div>                
                </div>                 
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button> 
            </div>        
        </div> 
    </div>      
</div>
<!-- Modal Asignacion de Procesos -->
<div class="modal fade" id="modal_asignaproc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Asignación de Procesos Administrativos</h4> 
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="docentes" class="control-label">Nombre del Usuario</label>
                            <div id="lista_nodocentes"></div>                             
                        </div>                
                    </div>                
                </div> 
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="proceso" class="control-label">Procesos Disponibles</label>
                            <div id="lista_procesos"></div>
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                        <label for="listado_asg" class="control-label">Procesos Asignados</label> 
                        <div id="lista_asignaproc"></div>              
                        </div> 
                    </div>                 
                </div> 
                <div class="row"> 
                    <div class="col-md-6">
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:in_asignaproc();">Agregar</button> 
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:remover_proc();">Retirar</button>                         
                    </div>                
                </div>                 
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button> 
            </div>        
        </div> 
    </div>      
</div>
<!-- Modal Configuración Menu principal -->
<div class="modal fade" id="modal_menupri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Configuración Adicionar Aplicación</h4> 
            </div> 
            <div class="modal-body"> 
            <form id="frm_menu" name="frm_menu" enctype="multipart/form-data">  
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="nombremenu" class="control-label">Nombre de la Opción Menú</label>
                            <input id='nombremenu' name='nombremenu'  class='form-control input-lg' required placeholder='Nombre de la Opción' type='text'>                            
                        </div>                
                    </div>                
                </div>                  
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="posicion" class="control-label">Posición</label>
                            <input id='posicion' name='posicion'  class='form-control input-lg' required placeholder='Posición' type='text'>                            
                        </div>                
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="tipoenlace" class="control-label">Tipo Enlace</label>
                            <select class="form-control" id="tipoenlace" name="tipoenlace" onchange="in_subnivel();">
                                <option>Seleccione Enlace</option>    
                                <option value="carpeta">Carpeta</option> 
                                <option value="aplica">Aplicación</option> 
                                <option value="funcion">Función</option> 
                                <option value="web">Abrir Web</option> 
                                </select>
                        </div>                
                    </div>                    
                </div>                  
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="enlace" class="control-label">Descripción del Enlace</label>
                            <input id='enlace' name='enlace'  class='form-control input-lg' required placeholder='Descripción Enlace' type='text'>                            
                        </div>                
                    </div>                
                </div>    
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="enlace" class="control-label">Filtrar por Áreas</label>
                            <input id='areas' name='areas'  class='form-control input-lg' required placeholder='Áreas de Filtrado' type='text'>                            
                        </div>                
                    </div>                
                </div>                    
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="enlace" class="control-label">Título de la Aplicación</label>
                            <input id='titulo' name='titulo'  class='form-control input-lg' required placeholder='Título Aplicación' type='text'>                            
                        </div>                
                    </div>                
                </div>                             
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label for="archivomenu" class="control-label">Seleccionar Icono/Imagen</label>
                            <input id="archivomenu" name="archivomenu" size="50" type="file"/>
                        </div> 
                    </div>                 
                </div> 
            </form>    
            </div>   
            <div class="modal-footer"> 
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button> 
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" onclick="consultas('menuad');">Consultar</button> 
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal" onclick="crearMenu();">Guardar</button> 
            </div>        
        </div> 
    </div>      
</div>
<!-- Ventana Modal Reportes-->
<div class="modal fade" id="modreportes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Generar Reporte Asistencia</h4>
      </div>
      <div class="modal-body">
          <form id="frmreportes" name="frmreportes" role="form">
              <table>               
                  <tr><td width='10%'></td><td width='80%'>
                        <h6>Ingrese Fecha a Procesar (aaaa-mm-dd)</h6>                    
                    <input class="form-control" size="50" name="ifecha" id="ifecha" required>
                    </td></tr>               
                </table>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="reporte_asistencia();">Generar</button>
      </div>
        <div class="row center"><div class="col-md-9 col-md-offset-5" id="carga_acti"></div>
          <div class="modal-footer" id="pie_carga_acti"></div>    
      </div>
    </div>
  </div>
</div>

<script>
var titulo;
var user = <?= json_encode($this->session->userdata("logged_in")) ?>;
function inicio(){ 
    if((user && !user.id) || !user){
        var ht = menupri();  
        $("#contenedor").html(ht);   
    }

    if(user && (user.id == user.clave)){
        cambio_clave();
    }
    $("#migas").html('');      
    $('#portada').modal('show'); 
    nobackbutton();
  }
function menu(){ 
    var ht = menupri();
    $("#migas").html('');    
    $("#contenedor").html(ht);     
  }  
function filtrar_menu(area){
    var fil1 = menupri_fil(area); 
    $("#migas").html('');    
    $("#contenedor").html('');
    $("#contenedor").html(fil1);     
  }

function creditos(){ $('#creditos').modal('show');}

function menupri(){   
  var url='<?=site_url();?>/config/co_menu';
    $.ajax({
           url:url,
           type:'POST',
           cache:false,
           async:false,
           contentType:false,
           processData:false,            
           success:function(respuesta){
             var registros = eval(respuesta);                                     
                  if(registros.length>0){ 
                      html="";
                      html+="<div class='row'>";
                      html+="<div class='col-md-12 col-sm-12 col-lg-12'>";
                      html+="<div class='mini-stat clearfix bx-shadow'>";
                      html+="<img src='./img/"+configuracion.banner_principal+"' width='100%' height='100%'></div></div></div>";                      
                      for (i=0; i<registros.length; i++) {                          
                        html+="<div class='col-md-6 col-sm-6 col-lg-3'>"; 
                        html+='<div class="mini-stat clearfix bx-shadow">';
                        html+='<a href="./principal/'+registros[i]["enlace"]+'" target="_blank">';
                        switch(registros[i]["tipo"]){
                            case 'carpeta':
                                html+="<a href='javascript:listado(\"" + "raiz" + "\",\"" + registros[i]["enlace"]+"\",\"" + "raiz" + "\",\"" + "raiz" + "\",\"" + registros[i]["descripcion"]+"\")'>";
                                break;
                            case 'aplica':
                                html+='<a href="./principal/'+registros[i]["enlace"]+'" target="_blank">';
                                break;
                            case 'funcion':
                                html+='<a href="javascript:'+registros[i]["enlace"]+'">';
                                break;    
                            case 'web':
                                html+='<a href="'+registros[i]["enlace"]+'" target="_blank">';
                                break;   
                            case 'submenu':
                                html+='<a href="javascript:'+registros[i]["enlace"]+'()">';
                                break;                                                              
                        }
                        html+='<img src="./img/botones/menu/'+registros[i]["icono"]+'" width="100%" height="100%"></a>';
                        html+='</div></div>';                          
                      }
                    html+='</div></div>';   
                  }
            }  
        });   
        return html; 
}  

function menuadd(){
  var url='<?=site_url();?>/config/co_menuadd';
    $.ajax({
           url:url,
           type:'POST',
           cache:false,
           async:false,
           contentType:false,
           processData:false,            
           success:function(respuesta){
             var registros = eval(respuesta);                                     
                  if(registros.length>0){ 
                      html="";
                      for (i=0; i<registros.length; i++) {
                        html+="<div class='col-md-6 col-sm-6 col-lg-3'>"; 
                        html+='<div class="mini-stat clearfix bx-shadow">';
                        html+='<a href="./principal/'+registros[i]["enlace"]+'" target="_blank">';
                        switch(registros[i]["tipo"]){
                            case 'carpeta':
                                html+="<a href='javascript:listado(\"" + "raiz" + "\",\"" + registros[i]["enlace"]+"\",\"" + registros[i]["enlace"]+"\")'>";
                                break;
                            case 'aplica':
                                html+='<a href="./principal/'+registros[i]["enlace"]+'" target="_blank">';
                                break;
                            case 'funcion':
                                html+='<a href="javascript:'+registros[i]["enlace"]+'">';
                                break;    
                            case 'web':
                                html+='<a href="'+registros[i]["enlace"]+'" target="_blank">';
                                break;   
                            case 'submenu':
                                html+='<a href="javascript:'+registros[i]["enlace"]+'()">';
                                break;                                                              
                        }
                        html+='<img src="./img/botones/menu/'+registros[i]["icono"]+'" width="100%" height="100%"></a>';
                        html+='</div></div>';                          
                      }
                    html+='</div></div>';   
                  }
            }  
        });   
        return html;   
}  
function biblioteca(){
  intext('#contenedor','<?=site_url()?>/container/biblioteca');
  listado('raiz','biblioteca','biblioteca','','BIBLIOTECA VIRTUAL');
}
function buscarBiblio(){
  var filtro = document.getElementById('bfiltro').value;
  listado_filtro('raiz','biblioteca','biblioteca',filtro,'','BIBLIOTECA VIRTUAL');
}
function menupri_fil(farea){
  var url='<?=site_url();?>/config/co_menupri_fil/'+farea;
    $.ajax({
           url:url,
           type:'POST',
           data:{filtro:farea},
           cache:false,
           async:false,
           contentType:false,
           processData:false,            
           success:function(respuesta){
             var registros = eval(respuesta);                                     
                  if(registros.length>0){ 
                      html="";
                      for (i=0; i<registros.length; i++) {
                        html+="<div class='col-md-6 col-sm-6 col-lg-3'>"; 
                        html+='<div class="mini-stat clearfix bx-shadow">';
                        html+='<a href="./principal/'+registros[i]["enlace"]+'" target="_blank">';
                        switch(registros[i]["tipo"]){
                            case 'carpeta':
                                html+="<a href='javascript:listado(\"" + "raiz" + "\",\"" + registros[i]["enlace"]+"\",\"" + "raiz" + "\",\"" + "raiz" + "\",\"" + registros[i]["descripcion"]+"\")'>";
                                break;
                            case 'aplica':
                                html+='<a href="./principal/'+registros[i]["enlace"]+'" target="_blank">';
                                break;
                            case 'funcion':
                                html+='<a href="javascript:'+registros[i]["enlace"]+'">';
                                break;    
                            case 'web':
                                html+='<a href="'+registros[i]["enlace"]+'" target="_blank">';
                                break;   
                            case 'submenu':
                                html+='<a href="javascript:'+registros[i]["enlace"]+'()">';
                                break;                                                              
                        }
                        html+='<img src="./img/botones/menu/'+registros[i]["icono"]+'" width="100%" height="100%"></a>';
                        html+='</div></div>';                          
                      }
                    html+='</div></div>';   
                  }
            }  
        });   
        return html; 
}  
function menuadd_fil(farea){
  var url='<?=site_url();?>/config/co_menuadd_fil/'+farea;
    $.ajax({
           url:url,
           type:'POST',
           data:{filtro:farea},
           cache:false,
           async:false,
           contentType:false,
           processData:false,            
           success:function(respuesta){
             var registros = eval(respuesta);                                     
                  if(registros.length>0){ 
                      html="";
                      for (i=0; i<registros.length; i++) {
                        html+="<div class='col-md-6 col-sm-6 col-lg-3'>"; 
                        html+='<div class="mini-stat clearfix bx-shadow">';
                        html+='<a href="./principal/'+registros[i]["enlace"]+'" target="_blank">';
                        switch(registros[i]["tipo"]){
                            case 'Carpeta':
                                html+="<a href='javascript:listado(\"" + "raiz" + "\",\"" + registros[i]["enlace"]+"\",\"" + registros[i]["enlace"]+"\")'>";
                                break;
                            case 'Aplica':
                                html+='<a href="./principal/'+registros[i]["enlace"]+'" target="_blank">';
                                break;
                            case 'funcion':
                                html+='<a href="javascript:'+registros[i]["enlace"]+'">';
                                break;    
                            case 'Web':
                                html+='<a href="'+registros[i]["enlace"]+'" target="_blank">';
                                break;                                
                        }
                        html+='<img src="./img/botones/menu/'+registros[i]["icono"]+'" width="100%" height="100%"></a>';
                        html+='</div></div>';                          
                      }
                    html+='</div></div>';   
                  }
            }  
        });   
        return html; 
}  

function in_subnivel(){
    var nivel = document.getElementById('nivel').value;
    if(nivel==='2'){ document.getElementById('subnivel').disabled= false;}
    else {document.getElementById('subnivel').disabled= true; }   
}
function conMenu(){
 var url='<?=site_url();?>/config/consultaMenu';
    $.ajax({
            url:url,
            type:'POST',
            cache:false,
            contentType:false,
            processData:false,              
            success:function(respuesta){
                alert(respuesta);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });    
}
function crearMenu(){
 var formData = new FormData($("#frm_menu")[0]);
 var url='<?=site_url();?>/config/nuevoMenu';
    $.ajax({
            url:url,
            type:'POST',
            data:formData,
            cache:false,
            contentType:false,
            processData:false,              
            success:function(respuesta){
                alert(respuesta);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });    
}

function StudentAreas(){
	var url = '<?=site_url();?>/estudiante/areas';
	$.ajax({
		url:url,
		type:'POST',
		success:function(respuesta){
			var registros = eval(respuesta);            
			var html="<div class='row'>";                    
				if(registros.length>0){ 
						for (i=0; i<registros.length; i++) { 
							html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
							if(registros[i]["tipo"]==='areas'){
							html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:StudentMaterias(" + registros[i]["codarea"]+")'>";
					}else{
							html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"areabase"'+",\"" + registros[i]["nomarea"]+"\",\"" + registros[i]["nomarea"]+"\")'>";
					}
							html+="<img src='./img/botones/areas/" + registros[i]["icoarea"]+"' width='100%' height='100%'></a></div></div>";                             
						}
							/* html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
							html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:subir_acti()'>";
							html+="<img src='./img/botones/actividades/actividades.png' width='100%' height='100%'></a></div></div>"; */                          
					}
					html+="</div>";    
			var migas="<div class='col-sm-12'>";
					migas+="<ol class='breadcrumb pull-right'>";
					migas+="<li><a href='javascript:menupri();'>Home</a></li>";
					migas+="<li><a class='active'>Areas</a></li>";
					migas+="</ol></div>";      
					//$("#migas").html(migas);
					$("#contenedor").html(html);  
		},
		error:function(){ alert("Error 400!");}                                   
	});  
}
function areas(){
  var url = '<?=site_url();?>/docente/co_areas';
        $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){
                 var registros = eval(respuesta);                 
                    var html="<div class='row'>";                    
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
                            if(registros[i]["tipo"]==='areas'){
                            html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:materias(" + registros[i]["codarea"]+")'>";
                        }else{
                            html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"areabase"'+",\"" + registros[i]["nomarea"]+"\",\"" + registros[i]["nomarea"]+"\")'>";
                        }
                            html+="<img src='./img/botones/areas/" + registros[i]["icoarea"]+"' width='100%' height='100%'></a></div></div>";                             
                          }
                            /* html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
                            html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:subir_acti()'>";
                            html+="<img src='./img/botones/actividades/actividades.png' width='100%' height='100%'></a></div></div>";  */                         
                        }
                        html+="</div>";    
                    var migas="<div class='col-sm-12'>";
                        migas+="<ol class='breadcrumb pull-right'>";
                        migas+="<li><a href='javascript:menupri();'>Home</a></li>";
                        migas+="<li><a class='active'>Areas</a></li>";
                        migas+="</ol></div>";      
                        //$("#migas").html(migas);
                        $("#contenedor").html(html);  
                },
               error:function(){ alert("Error 400!");}                                   
               });      
}

function StudentMaterias(area){
	$.ajax({
		url:'<?=site_url();?>/estudiante/materias/'+area,
		type:'POST',
		success:function(respuesta){ 
			var registros = eval(respuesta);                 
				html="<div class='row'>";                    
					if(registros.length>0){ 
							for (i=0; i<registros.length; i++) { 
								html+="<div class='col-md-6 col-sm-6 col-lg-4 col-xl-3'>";
								// html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"areas"'+",\"" + registros[i]["nomarea"]+"\",\"" + registros[i]["nommateria"]+registros[i]["grado"]+"\")'>";
								html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:enlace_mat_est(" + registros[i]["codmateria"]+")'>";
								//html+="<img src='./img/botones/materias/" + registros[i]["icomateria"]+"' width='100%' height='100%'>"
                                html += "<div style='background:"+colors_list[Math.floor(Math.random() * colors_list.length)]+"' class='contenedor-asignacion-docente'>"
                                html += "<h3>"+capitalizeTheFirstLetterOfEachWord(registros[i]["nommateria"])+"</h3>"
                                html += "<h1>"+registros[i]["grado"]+"</h1>"
                                html += "</div>"
                                "</a></div></div>";                             
							}                              
						}
						html+="</div>";    
						migas="<div class='col-sm-12'>";
						migas+="<ol class='breadcrumb pull-right'>";
						migas+="<li><a href='javascript:menupri();'>Home</a></li>";
						migas+="<li><a class='active'>Areas</a></li>";
						migas+="</ol></div>";      
						//$("#migas").html(migas);
						$("#contenedor").html(html);  
		},
		error:function(){ alert("Error 400!");}                                   
		});      
}

function materias(area){
        $.ajax({
               url:'<?=site_url();?>/docente/co_materias/'+area,
               type:'POST',
               success:function(respuesta){ 
                 var registros = eval(respuesta);                 
                    html="<div class='row'>";                    
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
                           // html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"areas"'+",\"" + registros[i]["nomarea"]+"\",\"" + registros[i]["nommateria"]+registros[i]["grado"]+"\")'>";
                            html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:enlace_mat_est(" + registros[i]["codmateria"]+")'>";
                            html+="<img src='./img/botones/materias/" + registros[i]["icomateria"]+"' width='100%' height='100%'></a></div></div>";                             
                          }                              
                        }
                        html+="</div>";    
                        migas="<div class='col-sm-12'>";
                        migas+="<ol class='breadcrumb pull-right'>";
                        migas+="<li><a href='javascript:menupri();'>Home</a></li>";
                        migas+="<li><a class='active'>Areas</a></li>";
                        migas+="</ol></div>";      
                        //$("#migas").html(migas);
                        $("#contenedor").html(html);  
                },
               error:function(){ alert("Error 400!");}                                   
               });      
}
function enlace_mat_est(cod, menu_materia = "false"){
     url='./index.php/docente/cop_materias_gen/'+cod;
            $.ajax({
               url:url,
               type:'POST',
               async:false,
               success:function(respuesta){                         
                 var registros = eval(respuesta);
                    html='<div class="panel panel-primary">';        
                    html=html+'<div class="panel-heading text-capitalize"><b>Asignación Académica ..:  '+registros[0]["nommateria"]+'</b></div>';
                    html=html+'<div class="panel-body">';  
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {                             
                            var narea=registros[i]["nomarea"];
                            var nmateria=registros[i]["nommateria"];
                            var tipo=registros[i]["tipo"];
                            var grado=registros[i]["grado"];
                            var grupo=registros[i]["grupo"];
                            var idmateria=registros[i]["materia"];
                            if(grupo==='N'){
                                listardoc(tipo,narea,nmateria+grado,'N', menu_materia);
                            }else{
                                html=html+"<div class='col-md-6 col-sm-6 col-lg-3'>";
                                html=html+"<div class='mini-stat clearfix bx-shadow'>";
                                html=html+"<a href='javascript:listardoc(\"" + tipo+"\",\"" + narea+"\",\"" + nmateria+grado+"\",\"" + grado+grupo+"\",\"" + idmateria+"\",\"" + grupo+"\")'>";                                
                                html=html+"<img src='./img/botones/grupos/" + grado+grupo+".png' width='100%' height='100%'></a></div></div>";                               
                                if(menu_materia == "true" && (grado+grupo) == info_current_materia["grupo"]){
                                    listardoc(tipo,narea,nmateria+grado,grado+grupo,idmateria,grupo,"true");
                                }
                            }
                          }                              
                     html=html+"</div></div>";
                     html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                    $("#contenedor").html(html);
                    $("#rutas").html(materia);
            
                   }                      
               },
               error:function(){alert("Ocurrió un Error!");}        
       });  
}
function iungo(){
    html="<div class='row'>";
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="https://juegos.iungo.club/sections/PDHKQT" target="_blank">';
    html+='<img src="./img/botones/menu/iungo_mat_5A.png"  width="100%" height="100%"></a>';
    html+='</div></div>';   
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="https://juegos.iungo.club/sections/SVQRSK  " target="_blank">';
    html+='<img src="./img/botones/menu/iungo_comp_5A.png"  width="100%" height="100%"></a>';
    html+='</div></div>';     
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="https://juegos.iungo.club/sections/VRCXTS" target="_blank">';
    html+='<img src="./img/botones/menu/iungo_comp_6A.png"  width="100%" height="100%"></a>';
    html+='</div></div>';  
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="https://juegos.iungo.club/sections/KXVGRG" target="_blank">';
    html+='<img src="./img/botones/menu/iungo_comp_6B.png"  width="100%" height="100%"></a>';
    html+='</div></div>';      
    html+='</div>';   
    html+='<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>'; 
    $("#contenedor").html(html);     
}
function descartes(){
    html="<div class='row'>";
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/newton/index.htm" target="_blank">';
    html+='<img src="./img/botones/newton.png"  width="100%" height="100%"></a>';
    html+='</div></div>';   
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/juegos/index.html" target="_blank">';
    html+='<img src="./img/botones/juegos.png"  width="100%" height="100%"></a>';
    html+='</div></div>';     
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/uudd/index.htm" target="_blank">';
    html+='<img src="./img/botones/uudd.png"  width="100%" height="100%"></a>';
    html+='</div></div>';    
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/un_100/index.htm" target="_blank">';
    html+='<img src="./img/botones/un_100.png"  width="100%" height="100%"></a>';
    html+='</div></div>';         
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/miscelanea/index.htm" target="_blank">';
    html+='<img src="./img/botones/miscelanea.png"  width="100%" height="100%"></a>';
    html+='</div></div>';     
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/ingenieria/index.htm" target="_blank">';
    html+='<img src="./img/botones/ing_tecno.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/icartesilibri/index.htm" target="_blank">';
    html+='<img src="./img/botones/libros.png"  width="100%" height="100%"></a>';
    html+='</div></div>';         
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/geografica/index.htm" target="_blank">';
    html+='<img src="./img/botones/geografica.png"  width="100%" height="100%"></a>';
    html+='</div></div>';     
    /*html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/eecl/index.htm" target="_blank">';
    html+='<img src="./img/botones/eecl.png"  width="100%" height="100%"></a>';
    html+='</div></div>';     */
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/competencias/index.htm" target="_blank">';
    html+='<img src="./img/botones/competencias.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/canals/index.htm" target="_blank">';
    html+='<img src="./img/botones/canals.png"  width="100%" height="100%"></a>';
    html+='</div></div>';   
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/asipisa/index.htm" target="_blank">';
    html+='<img src="./img/botones/pisa.png"  width="100%" height="100%"></a>';
    html+='</div></div>';                      
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/descartes/aprendemx/index.htm" target="_blank">';
    html+='<img src="./img/botones/aprende.png"  width="100%" height="100%"></a>';
    html+='</div></div>';  
    html+='</div>';   
    html+='<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>'; 
    $("#contenedor").html(html);
}
function lab(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"labs"'+"," + '"labs"'+"," + '"biologia"'+")'>";
    html+="<img src='./img/botones/lab/biolab.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"labs"'+"," + '"labs"'+"," + '"fisica"'+")'>";
    html+="<img src='./img/botones/lab/fislab.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"labs"'+"," + '"labs"'+"," + '"matematicas"'+")'>";
    html+="<img src='./img/botones/lab/matlab.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"labs"'+"," + '"labs"'+"," + '"quimica"'+")'>";
    html+="<img src='./img/botones/lab/quimlab.png' width='100%' height='100%'></a></div></div>";      
    html+="</div>"; 
    html+='<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
    $("#contenedor").html(html);
}
function explora(){
    html="<div class='row'>";
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cmatematicas/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/matematicas.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cfisica/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/fisica.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cprogramacion/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/fun_programacion.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/canaproyectostic/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/anaproyectostic.png"  width="100%" height="100%"></a>';
    html+='</div></div>';     
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cprogramacionweb1/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/programacionweb1.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cambiente/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/ambiente.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cprogramadispo/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/programadispo.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/credes/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/redes.png"  width="100%" height="100%"></a>';
    html+='</div></div>'; 
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cprogramacionweb2/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/cprogramacionweb2.png"  width="100%" height="100%"></a>';
    html+='</div></div>';    
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cdesaweb/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/desaweb.png"  width="100%" height="100%"></a>';
    html+='</div></div>';            
    html+='<div class="col-md-6 col-sm-6 col-lg-3">';
    html+='<div class="mini-stat clearfix bx-shadow">';
    html+='<a href="./principal/explora/cproyetic/index.html" target="_blank">';
    html+='<img src="./img/botones/explora/proyetic.png"  width="100%" height="100%"></a>';
    html+='</div></div>';     
    html+="</div>"; 
    html+='<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
    $("#contenedor").html(html);
}
function artes_plasticas(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"artes"'+"," + '"artes"'+"," + '"Arte y Artistas"'+")'>";
    html+="<img src='./img/botones/artes/arte_artistas.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"artes"'+"," + '"artes"'+"," + '"Bases del Dibujo"'+")'>";
    html+="<img src='./img/botones/artes/bases_dibujo.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"artes"'+"," + '"artes"'+"," + '"Figura Humana"'+")'>";
    html+="<img src='./img/botones/artes/figura_humana.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"artes"'+"," + '"artes"'+"," + '"Muralismo"'+")'>";
    html+="<img src='./img/botones/artes/muralismo.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"artes"'+"," + '"artes"'+"," + '"Redes y Estructuras Modulares"'+")'>";
    html+="<img src='./img/botones/artes/modulares.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"artes"'+"," + '"artes"'+"," + '"Teoria del Color"'+")'>";
    html+="<img src='./img/botones/artes/color.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado(" + '"artes"'+"," + '"artes"'+"," + '"Perspectiva"'+")'>";
    html+="<img src='./img/botones/artes/perspectiva.png' width='100%' height='100%'></a></div></div>";                
    html+="</div>"; 
    html+='<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
    $("#contenedor").html(html);
}
function enlace_materia(doc,cod){
     url='./index.php/docente/cop_materias/'+cod+'/'+doc;
            $.ajax({
               url:url,
               type:'POST',
               async:false,
               success:function(respuesta){                         
                 var registros = eval(respuesta);
                    html='<div class="panel panel-primary">';        
                    html=html+'<div class="panel-heading text-capitalize"><b>Asignación Académica ..:  '+registros[0]["nommateria"]+'</b></div>';
                    html=html+'<div class="panel-body">'; 
                      if(registros.length>0){  
                          for (i=0; i<registros.length; i++) {                             
                            var narea=registros[i]["nomarea"];
                            var nmateria=registros[i]["nommateria"];
                            var tipo=registros[i]["tipo"];
                            var grado=registros[i]["grado"];
                            var grupo=registros[i]["grupo"];
                            var idmateria=registros[i]["materia"];
                            if(grupo==='N'){
                                listardoc(tipo,narea,nmateria+grado,'N',$idmateria,grupo);
                            }else{
                                html=html+"<div class='col-md-6 col-sm-6 col-lg-3'>";
                                html=html+"<div class='mini-stat clearfix bx-shadow'>";
                                html=html+"<a href='javascript:listardoc(\"" + tipo+"\",\"" + narea+"\",\"" + nmateria+grado+"\",\"" + grado+grupo+"\",\"" + idmateria+"\",\"" + grupo+"\")'>";                                
                                html=html+"<img src='./img/botones/grupos/" + grado+grupo+".png' width='100%' height='100%'></a></div></div>";                               
                            }
                          }                              
                     html=html+"</div></div>";
                     html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                    $("#materias").html(html);
                    $("#rutas").html(materia);                             
                   }                      
               },
               error:function(){alert("Ocurrió un Error!");}        
       });    
}

let info_current_materia = {};
function listardoc(tipo, carpeta, materia, grupo, idmateria=null, idgrupo=null, menu_materia = false){
    info_current_materia["materia"] = materia;
    info_current_materia["grupo"] = grupo;
    info_current_materia["idmateria"] = idmateria;
    info_current_materia["idgrupo"] = idgrupo;

    $("#nuevo-foro-materia").val(idmateria);
    $("#nuevo-foro-grupo").val(idgrupo);

    switch(tipo){
        case 'labs':
            titulo = "Laboratoria Virtual " + materia;
            ruta = "principal/labs/" + materia;
            break;
        case 'biblioteca':
            titulo = "Biblioteca Virtual"; 
            ruta="principal/" + carpeta;
            break;
        case 'saber':
            titulo = "Pruebas y Simulacros Saber"; 
            ruta="principal/" + carpeta;
            break;       
        case 'semilla':
            titulo = "Colección Semilla - Plan Nacional de Lectura y Escritura";  
            ruta="principal/" + carpeta;
            break; 
        case 'animat':
            titulo = "Animaciones Matemáticas";  
            ruta="principal/" + carpeta;
            break;   
        case 'animaingles': 
            titulo = "Animaciones Inglés";  
            ruta="principal/" + carpeta;
            break;     
        case 'mecanico':
            titulo = "Videos el universo mecánico";  
            ruta="principal/" + carpeta;
            break;    
        case 'areas':
            var gra = materia.replace(/\D/g,'');
            var mat = materia.replace(gra,'');            
            titulo = mat + " grado " + grupo;  
            ruta = (grupo==='N') ? "./principal/areas/" + carpeta + "/" + materia : "./principal/areas/" + carpeta + "/" + materia + "/" + grupo;
            document.getElementById("dir").value  =ruta;
            menu_materia = true;
            break;   
        case 'areabase':
            switch(carpeta){
                case 'economicas'   :  titulo = "Ciencias económicas"; break; 
                case 'politicas'    :  titulo = "Ciencias políticas"; break; 
                case 'preescolar'   :  titulo = "Educación preescolar"; break;  
                case 'actividades'  :  titulo = "Registro de actividades de estudiantes"; break; 
                case 'convivencia'  :  titulo = "Coordinación Convivencial"; break;  
                case 'academica'    :  titulo = "Coordinación Académica"; break;    
                case 'rectoria'     :  titulo = "Rectoría"; break;
                case 'orientacion'  :  titulo = "Orientación"; break;
                case 'apoyo'        :  titulo = "Aula de Apoyo"; break;    
                case 'pta'          :  titulo = "Programa Todos a Aprender"; break;        
            }                                        
            ruta = (grupo==='N') ? "./principal/areas/" + carpeta + "/" + materia : "./principal/areas/" + carpeta + "/" + materia + "/" + grupo;
            break;             
        case 'raiz': 
            switch(carpeta){
                case 'documentos'   : titulo = "Comunicación Institucional"; break; 
                case 'plan_area'    : titulo = "Planeación Académica Plan Area"; break; 
                case 'picc'         : titulo = "Programa Integración Componentes Curriculares"; break;  
                case 'verdetopia'   : titulo = "VerdeTopía"; break; 
                default 			: titulo = grupo; break;
            }             
            ruta = "principal/" + carpeta; 
            $("#contenedor").html('<div id="contenido" class="ir-arriba"></div><div id="listacon"></div>');
            break;
    }

    $("#rutas").html(titulo);
    document.getElementById("ubica").value=titulo;
    document.getElementById("dir").value=ruta;
    url= base_url + 'docente/listar/' + menu_materia;

    $.ajax({
        url:url,
        type:'POST',
        async:false,
        data:{ruta:ruta,titulo:titulo,materia:idmateria,grupo:idgrupo},
        success:function(respuesta){
            setTimeout(() => {
                $("#listacon").html(respuesta);
            }, 500); 
            $("#rutas").html(titulo);
        },
        error:function(e){
            alert("Ocurrió un Error!");
        }        
    });         
}

function listarpro(proy,tit){    
    titulo=tit;
    document.getElementById("ubica").value=tit;
    document.getElementById("dir").value="./principal/proyectos/" + proy;    
    proy="./principal/proyectos/" + proy;
    url='./index.php/docente/listarpro';
            $.ajax({
               url:url,
               type:'POST',
               data:{proy:proy,tit:tit},
               success:function(respuesta){                         
                        $("#listacon").html(respuesta);   
                        $("#rutas").html(tit);
               },
               error:function(){alert("Ocurrió un Error!");}        
       });        
}
function listarproc(proc,tit){ 
    document.getElementById("ubica").value=tit;
    document.getElementById("dir").value="./principal/procesos/" + proc;
    proc="./principal/procesos/" + proc;
    url='./index.php/docente/listarpro';
            $.ajax({
               url:url,
               type:'POST',
               data:{proy:proc,tit:tit},
               success:function(respuesta){                         
                        $("#listacon").html(respuesta);   
                        $("#rutas").html(tit);
               },
               error:function(){alert("Ocurrió un Error!");}        
       });        
}
function listar_arc(menu_materia = "false"){
    var ruta=document.getElementById("dir").value;
    var titulo=document.getElementById("ubica").value;
    //var modulo=document.getElementById("modulo").value;
    let modulo = 'DO';
    //alert(modulo);
    switch(modulo){      
      case 'DO': url = base_url + 'docente/listar/' + menu_materia; break;
      case 'AC': url = base_url + 'actividades/listar_act_doc'; break;
      default :  url = base_url + 'principal/listar'; break;
    }

    $.ajax({
        url: url,
        type: 'POST',
        data:{
            ruta:ruta,
            titulo:titulo,
            materia: info_current_materia.idmateria,
            grupo:info_current_materia.idgrupo
        },
        success:function(respuesta){
            $("#listacon").html(respuesta);
            $("#rutas").html(titulo);                 
        },
        error:function(){
            alert("Ocurrió un Error!");
        }        
    });    
}
    
function eliminar(nomarc, menu_materia){
    if(confirm("¿Desea Eliminar este Archivo?")){ 
    url='./index.php/docente/eliminar';
            $.ajax({
               url:url,
               type:'POST',
               data:{arc:nomarc},
               success:function(){ 
                   listar_arc(menu_materia);                   
               },
               error:function(){alert("Ocurrió un Error!");}        
       }); 
    }
  }

function eliminar_acti(nomarc){
    if(confirm("¿Desea Eliminar este Archivo?")){ 
    url='./index.php/docente/eliminar';
            $.ajax({
               url:url,
               type:'POST',
               data:{arc:nomarc},
               success:function(){ 
                   listar_acti();                   
               },
               error:function(){alert("Ocurrió un Error!");}        
       }); 
    }
  }
function elicar(nomarc, menu_materia = "false"){ 
    if(confirm("¿Desea Eliminar esta carpeta y todos los archivos internos?")){ 
    url= base_url + 'docente/eliminacar';
            $.ajax({
               url:url,
               type:'POST',
               data:{arc:nomarc},
               success:function(){ 
                   listar_arc(menu_materia);                   
               },
               error:function(){alert("Ocurrió un Error!");}        
       }); 
    }
  }  
    
function creadir(menu_materia = "false"){
    var ruta = document.getElementById("dir").value;
    var nomdir = document.getElementById("nomdir").value;

    if(confirm("¿Desea crear este directorio?")){
        url  =base_url + 'docente/crear';
        $.ajax({
            url:url,
            type:'POST',
            data:{
                ruta: ruta,
                nomdir: nomdir
            },
            success:function(data){
                $("#creardir").modal("hide");
                listar_arc(menu_materia);   
            },
            error:function(){
                alert("Ocurrió un Error!");
            }        
       }); 
    }
  }  

function subir(menu_materia="false"){
    var ruta=document.getElementById("dir").value; 
    $("#carga").html(''); 
    $("#pie_carga").html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-primary" onclick="subir_archivo('+menu_materia+')">Subir Archivo</button>');     
    $("#subir_archivo").modal("show");
    }
function down(){
    $("#bajar_archivo").modal("show");
    }
function fsubiract(){ 
    var ruta=document.getElementById("diract").value;
    document.getElementById("diract").value=ruta;
    $("#carga_acti").html(''); 
    $("#pie_carga_acti").html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-primary" onclick="subir_actividad()">Subir Archivo</button>');       
    $("#modsubiract").modal("show");
    }
function crear(menu_materia = "false"){
    $("#btn-creardir").attr("onClick", "creadir('"+menu_materia+"')");
    $("#creardir").modal("show");
}
function renombrar(ruta,archivo, menu_materia){
    document.getElementById("nombre").value=archivo;
    document.getElementById("ruta").value=ruta;
    $("#button-modal-renombrar").attr("onClick", "ren_archivo("+menu_materia+")");
    $("#renombrar").modal("show");
    }       
function ren_archivo(menu_materia="false"){
    var ruta=document.getElementById("ruta").value;
    var nuevo=ruta+'/'+document.getElementById("nuevo").value;
    var nombre=ruta+'/'+document.getElementById("nombre").value;

    url='./index.php/docente/renombrar';
            $.ajax({
               url:url,
               type:'POST',
               data:{nombre:nombre,nuevo:nuevo},
               success:function(){                  
                  $("#renombrar").modal("hide"); 
                   listar_arc(menu_materia);
               },
               error:function(){alert("Ocurrió un Error!");}        
       });    
}
    
function subir_archivo(menu_materia="false"){
    var ruta=document.getElementById("archivo").value; 
    var formData = new FormData($("#frmsubir")[0]);
    var url = base_url + 'upload/do_upload';
            $.ajax({
                url:url,
                type:'POST',
                data:formData,
                cache:false,
                contentType:false,
                processData:false,   
                beforeSend: function() {
                    $("#carga").html("<img src='img/cargando.gif' width='100' height='100'>"); 
                    $("#pie_carga").html(""); 
                  },                                 
                success:function(data){
                    data = JSON.parse(data);
                    $("#subir_archivo").modal("hide");
                    alert(data.message);
                    if(data.status){
                        listar_arc(menu_materia); 
                    } 
                },
                error:function(){alert("Ocurrió un Error!");}        
       });     
    }    
function bajar_archivo(ruta,archivo){ 
    var url = './index.php/upload/do_download';
            $.ajax({
                url:url,
                type:'POST',
                data:{ruta:ruta,archivo:archivo},              
                success:function(respuesta){
                    listar_act_doc(); 
                    $("#subir_archivo").modal("hide");
                },
                error:function(){alert("Ocurrió un Error!");}        
       });     
    }

function subir_actividad(){ 
    var combo   = document.getElementById("grupo");
    var gru     = combo.options[combo.selectedIndex].text; 
        combo   = document.getElementById("materia");
    var mat     = combo.options[combo.selectedIndex].text; 
    //document.getElementById("diract").value=mat+" " + gru;

    var formData = new FormData($("#frmsubiract")[0]);
    var url = './index.php/upload/do_upload_act';
            $.ajax({
                url:url,
                type:'POST',
                data:formData,
                cache:false,
                contentType:false,
                processData:false,    
                beforeSend: function() {
                    $("#carga_acti").html("<img src='img/cargando.gif' width='100' height='100'>"); 
                    $("#pie_carga_acti").html(""); 
                  },  
                success:function(){  
                   $("#modsubiract").modal("hide"); 
                    mostrar_contenidos();                    
                },
                error:function(){alert("Ocurrió un Error!");}        
       });     
    } 
    
function submenu(ruta,sub, menu_materia = "false"){
    document.getElementById("dir").value=ruta;
    url='./index.php/principal/listar';
            $.ajax({
                url:url,
                type:'POST',
                data:{
                    ruta:ruta,
                    titulo:sub,
                    materia: info_current_materia.idmateria,
                    grupo:info_current_materia.idgrupo
                },
                async:false,
                success:function(respuesta){                      
                        $("#listacon").html(respuesta);              
                },
               error:function(){alert("Ocurrió un Error!");}        
       });
       $("#rutas").html(sub);
}

function submenu_doc(ruta,sub, menu_materia = "false"){
    document.getElementById("ubica").value=sub;
    document.getElementById("dir").value=ruta;

    url= base_url + 'docente/listar/' + menu_materia;
    $.ajax({
        url:url,
        type:'POST',
        data:{
            ruta:ruta,
            titulo:sub,
            materia: info_current_materia.idmateria,
            grupo:info_current_materia.idgrupo
        },
        async:false,
        success:function(respuesta){                    
                $("#listacon").html(respuesta); 
        },
        error:function(){alert("Ocurrió un Error!");}        
    });
       
       $("#rutas").html(sub);
}
function submenu_acti(ruta,sub){
    document.getElementById("ubica").value=sub;
    document.getElementById("dir").value=ruta;
    document.getElementById("diract").value=ruta;
    titulo=document.getElementById("ubica").value;
    url='./index.php/actividades/listar';
            $.ajax({
               url:url,
               type:'POST',
               data:{ruta:ruta,titulo:sub},
               async:false,
               success:function(respuesta){                      
                        $("#listacon").html(respuesta); 
               },
               error:function(){alert("Ocurrió un Error!");}        
       });
       
       $("#rutas").html(sub);
}

function listado(tipo, carpeta, materia, grupo, descripcion, idmateria = null, idgrupo = null){
    let menu_materia = false;
    info_current_materia["materia"] = materia;
    info_current_materia["grupo"] = grupo;
    info_current_materia["idmateria"] = idmateria;
    info_current_materia["idgrupo"] = idgrupo;
    switch(tipo){
        case 'labs':
            titulo = "Laboratorio Virtual " + materia;
            ruta = "principal/labs/" + materia;
            break; 
        case 'artes':
            titulo = "Artes Plasticas - " + materia;
            ruta = "principal/artes_plasticas/" + materia;                        
            break;                 
        case 'areas':
            var gra = materia.replace(/\D/g,'');
            var mat = materia.replace(gra,'');            
            titulo = mat + " grado " + grupo;  
            menu_materia = true;
            if(grupo==='N'){
                ruta = "principal/areas/" + carpeta + "/" + materia;
            }
            else{
                ruta = "principal/areas/" + carpeta + "/" + materia + "/" + grupo;
            }
        break;   
        case 'areabase':
            titulo = descripcion;                                       
            if(grupo==='N'){
                ruta = "principal/areas/" + carpeta+"/" + materia;
            }
            else{
                ruta="principal/areas/" + carpeta + "/" + materia + "/" + grupo;
            }
            break;             
        case 'raiz':
            titulo = descripcion; 
            $("#contenedor").html('<div id="contenido" class="ir-arriba"></div><div id="listacon"></div>');
            ruta = "principal/" + carpeta;
            break;            
    }  

    document.getElementById("dir").value = ruta;
    document.getElementById("ubica").value = titulo;
    var rol = document.getElementById("rol").value; 

    if(rol==='Docente') {
        url = base_url + 'principal/listar';
    }
    else{
        url = base_url + 'docente/listar/' + menu_materia;
    }

    $.ajax({
        url:url,
        type:'POST',
        data:{
            ruta: ruta,
            titulo: titulo,
            materia: idmateria,
            grupo: idgrupo
        },
        success:function(respuesta){ 
            migas="<div class='col-sm-12'>";
            migas+="<ol class='breadcrumb pull-right'>";
            migas+="<li><a href='javascript:menupri();'>Home</a></li>";
            migas+="<li><a href='javascript:areas();'>Areas</a></li>";
            migas+="<li><a href='javascript:" + carpeta+"();'>" + carpeta+"</a></li>";
            migas+="<li><a class='active'>" + titulo+"</a></li>";
            migas+="</ol></div>";      
            //$("#migas").html(migas); 
            //$("#contenedor").html(respuesta);  
            $("#listacon").html(respuesta);  
            $("#rutas").html(titulo);
        },
        error:function(){alert("Ocurrió un Error!");}        
    });         
}

function listar_anuncios(tipo,carpeta,materia,grupo,descripcion){
    $("#contenedor").html('<div id="contenido" class="ir-arriba"></div><div id="listacon"></div>');
    ruta="./principal/anuncios";
    titulo = "Contenido Especial"; 
    url='./index.php/principal/listar';
    html="<div class='row'>";
    html+="<div class='col-md-12 col-sm-12 col-lg-12'>";
    html+="<div class='mini-stat clearfix bx-shadow'>";
    html+="<img src='./img/banner.png' width='100%' height='100%'></div></div></div>";
            $.ajax({
               url:url,
               type:'POST',
               data:{ruta:ruta,titulo:titulo},
               success:function(respuesta){  
                        html+=respuesta;
                        $("#listacon").html(html);  
                        $("#rutas").html(titulo);
               },
               error:function(){alert("Ocurrió un Error!");}        
       });         
}

function listado_filtro(tipo,carpeta,materia,grupo,filtro,descripcion){
    //$("#contenedor").html('<div id="listacon"></div>');
    switch(tipo){
        case 'labs':titulo = "Laboratorio Virtual " + materia;
                        ruta="principal/labs/" + materia;
            break; 
        case 'artes':titulo = "Artes Plasticas - " + materia;
                        ruta="principal/artes_plasticas/" + materia;                        
            break;                 
        case 'areas':
                var gra=materia.replace(/\D/g,'');
                var mat=materia.replace(gra,'');            
                titulo = mat+" grado " + grupo;  
                if(grupo==='N'){ruta="./principal/areas/" + carpeta+"/" + materia;}
                    else{ruta="./principal/areas/" + carpeta+"/" + materia+"/" + grupo;}
            break;   
        case 'areabase':
            switch(carpeta){
                case 'economicas':  titulo = "Ciencias económicas"; break; 
                case 'politicas':   titulo = "Ciencias políticas"; break; 
                case 'preescolar':  titulo = "Educación preescolar"; break;  
                case 'actividades': titulo = "Registro de actividades de estudiantes"; break; 
                case 'convivencia': titulo = "Coordinación Convivencial"; break;  
                case 'academica':   titulo = "Coordinación Académica"; break;    
                case 'rectoria':   titulo = "Rectoría"; break;
                case 'orientacion':   titulo = "Orientación"; break;
                case 'apoyo':   titulo = "Aula de Apoyo"; break;    
                case 'pta':   titulo = "Programa Todos a Aprender"; break;        
            }                                        
                if(grupo==='N'){ruta="./principal/areas/" + carpeta+"/" + materia;}
                    else{ruta="./principal/areas/" + carpeta+"/" + materia+"/" + grupo;}
            break;             
        case 'raiz':
            titulo = descripcion; 
            switch(carpeta){
                case 'animaingles': titulo = "Animaciones Inglés"; break;
                case 'animat':      titulo = "Animaciones Matemáticas"; break;
                case 'mecanico':    titulo = "Videos Física - El Universo Mecanico"; break;
                case 'bibliotecags':titulo = "Biblioteca Virtual"; break;
                case 'dpensar': titulo = "Aplicativos matematicas DPensar"; break;
                case 'semilla': titulo = "Colección Semilla - Plan Nacional de Lectura y Escritura"; break; 
                case 'plugins': titulo = "Plugins para Descargar"; break;
                case 'saber': titulo = "Material Pruebas Saber"; break;
                case 'animaingles': titulo = "Animaciones Inglés"; break;
                case 'reacciones': titulo = "Reacciones Químicas"; break; 
                case 'problematic': titulo = "Metamodelos TIC"; break;
                case 'materiales': titulo = "Videos Materiales y Materias Primas"; break;
                case 'artehistoria': titulo = "Videos Artehistoria"; break;    
                case 'documentos': titulo = "Documentos Institucionales"; break;   
                case 'docpta': titulo = "Documentos PTA"; break;
                case 'academiaplay': titulo = "AcademiaPlay"; break;
                case 'verdetopia': titulo = "Verdetopia"; break;
                case 'viviendopcc': titulo = "Viviendo el Paisaje Cultural Cafetero"; break;
                case 'seguimiento': titulo = "Seguimiento a Tablets"; break;
                case 'atlas': titulo = "Atlas de Geografía Universal"; break;
                case 'fisica_entretenida': titulo = "Física Entretenida"; break;
            } 
            break;            
    }   
    document.getElementById("dir").value=ruta;
    document.getElementById("ubica").value=titulo;
    var rol=document.getElementById("rol").value;
    var filtro = document.getElementById("bfiltro").value;
    url='./index.php/biblioteca/listar_filtro';
            $.ajax({
               url:url,
               type:'POST',
               data:{ruta:ruta,titulo:titulo,filtro:filtro},
               success:function(respuesta){ 
                        migas="<div class='col-sm-12'>";
                        migas+="<ol class='breadcrumb pull-right'>";
                        migas+="<li><a href='javascript:menupri();'>Home</a></li>";
                        migas+="<li><a href='javascript:areas();'>Areas</a></li>";
                        migas+="<li><a href='javascript:" + carpeta+"();'>" + carpeta+"</a></li>";
                        migas+="<li><a class='active'>" + titulo+"</a></li>";
                        migas+="</ol></div>";      
                        //$("#migas").html(migas); 
                        //$("#contenedor").html(respuesta);  
                        $("#listacon").html(respuesta);  
                        $("#rutas").html(titulo);
               },
               error:function(){alert("Ocurrió un Error!");}        
       });         
}
function prelogin(){
    titulo = "<h4>Ingreso a Docentes</h4>";
    html="<div class='wrapper-page'>";
    html=html+"<div class='panel panel-color panel-primary panel-pages'>";
    html=html+"<div class='panel-heading bg-img modal-colored'>";
    html=html+"<div class='bg-overlay'></div>";
    html=html+"<h3 class='text-center m-t-10 text-white'><strong></strong></h3></div>";
    html=html+"<div class='panel-body'>";
    html=html+"<form id='frmlogin' class='form-horizontal m-t-20'>";                    
    html=html+"<div class='form-group '>";
    html=html+"<div class='col-xs-12'>";
    html=html+"<input id='usr' name='usr'  class='form-control input-lg' required placeholder='Usuario' type='text'>";
    html=html+"</div> </div>";
    html=html+"<div class='form-group'>";
    html=html+"<div class='col-xs-12'>";
    html=html+"<input id='pass' name='pass' class='form-control input-lg' required placeholder='Contraseña' type='password'>";
    html=html+"</div></div>";
    html=html+"<div class='form-group '>";               
    html=html+"<div class='form-group text-center m-t-40'>";
    html=html+"<div class='col-xs-12'>";
    html=html+"<button type='button' class='btn btn-primary btn-lg w-lg waves-effect waves-light' onclick='login();'>Ingresar</button>";
    html=html+"</div></div></form></div></div></div>";  
                        $("#rutas").html(titulo);
                        $("#migas").html("");
                        $("#contenedor").html(html);              
}
function cambio_clave(){
    titulo = "<h4>Cambio de Contraseña</h4>";
    var usr= document.getElementById("usr_cambio").value;
    html="<div class='wrapper-page'>";
    html+="<div class='panel panel-color panel-primary panel-pages'>";
    html+="<div class='panel-heading bg-img2'>";
    html+="<div class='bg-overlay'></div>";
    html+="<h3 class='text-center m-t-10 text-white'><strong></strong></h3></div>";
    html+="<div class='panel-body'>";
    html+="<form id='frmcambio' class='form-horizontal m-t-20'>";                    
    html+="<div class='form-group '>";
    html+="<div class='col-xs-12'>";
    if(user.id == user.clave){
        html+="<p style='margin-bottom:20px;'>Su número de identificación y contraseña tienen los mismos valores, es recomendable cambiar la contraseña para efectos de seguridad.</p>";
    }
    html+="<input id='usr' name='usr' value='" + usr+"' type='hidden'>";
    html+="<input id='pass' name='pass'  class='form-control input-lg' required placeholder='Ingrese Clave Actual' type='password'>";
    html+="</div> </div>";
    html+="<div class='form-group '>";    
    html+="<div class='col-xs-12'>";
    html+="<input id='nueva' name='nueva'  class='form-control input-lg' required placeholder='Ingrese Nueva Clave' type='password'>";
    html+="</div> </div>";    
    html+="<div class='form-group '>";               
    html+="<div class='form-group text-center m-t-40'>";
    html+="<div class='col-xs-12'>";
    html+="<button type='button' class='btn btn-primary btn-lg w-lg waves-effect waves-light' onclick='cambiar_clave();'>Cambiar Clave</button>";
    html=html+"</div></div></form></div></div></div>";  
                        $("#rutas").html(titulo);
                        $("#migas").html("");
                        $("#contenedor").html(html);              
}
function cfg_docente(){         
    $("#contenedor").html('<div id="materias"></div><div id="proyectos"></div>'); 
    var rol=document.getElementById("rol").value;
    cambio_menu();
    listar_materias(document.getElementById("ced").value);
    if(rol==='Administrativo'){listar_procesos(document.getElementById("ced").value);}
        else{listar_materias(document.getElementById("ced").value);}
}    
function cfg_proyectos(){         
    $("#contenedor").html('<div id="proyectos"></div>'); 
    var rol=document.getElementById("rol").value;
    cambio_menu();
    if(rol==='Administrativo'){listar_tproyectos();}
        else{listar_proyectos(document.getElementById("ced").value);}
}
function cfg_comunicacion(){         
    $("#contenedor").html('<div id="comunica"></div>'); 
    var rol=document.getElementById("rol").value;
    cambio_menu();
    listar_comunica(document.getElementById("ced").value);
}
function cfg_planeacion(){         
    $("#contenedor").html('<div id="planeacion"></div>'); 
    var rol=document.getElementById("rol").value;
    cambio_menu();
    listar_planeacion();
}

function cfg_cambio_clave(){   
    $("#contenedor").html('<div id="cambios"></div>'); 
    var rol=document.getElementById("rol").value;
    cambio_menu();
    cambio_clave();
}
function login(){
    var url = "./index.php/principal/login";   
        $.ajax({
               url:url,
               type:'POST',
               data:$("#frmlogin").serialize(),
               success:function(respuesta){
               if(respuesta!=0){ 
                 var registros = JSON.parse(respuesta); 
                 user = registros; 
                      if(Object.keys(registros).length>0){ 
                               var html = '<label>Hola, '+registros.nombres+" " + registros.apellidos+'</label>';
                               html=html+'<form><input type="hidden" id="ced" name="ced" value="'+registros.id+'"/>';
                               html=html+'<input class="form-control input-sm" type="hidden" id="usr_cambio" name="usr_cambio" value="usr"/>'; 
                               html=html+'<input type="hidden" id="rol" name="rol" value="'+registros.rol+'"/></form>';
                               $("#nomusuario").html(html);
                               var nomusr=registros.usuario;

                               html='<br><a href="javascript:prelogin();" class="dropdown-toggle profile">';
                               if(registros.foto==='S'){
                               html=html+'<img src="./fotos/'+registros.id+'.png" alt="user-img" class="img-circle"></a>';
                                }else{
                                  html=html+'<img src="./fotos/user.png" alt="user-img" class="img-circle"></a>';  
                                }                                    
                           
                               $("#foto").html(html);
                               $("#contenedor").html('');
                               document.getElementById("usr_cambio").value=nomusr;

                                cambio_menu();
                                if(user.id == user.clave){
                                    cambio_clave();
                                }
                                else{
                                    location.reload();
                                }
                               /*if(registros.rol == "Docente"){
                                location.reload();
                                //cfg_docente();
                               }

                               if(registros.rol == "Estudiante"){
                                location.reload();
                                //StudentAreas();
                                //actualizar_notificaciones();
                               }*/
                                }          
                      
                    } 
                    else{alert("Error Usuario/Contraseña!")}                    
                },
               error:function(){ alert("Error!");}                                   
               });
}
function login_estudiante(){ 
    var url = "./index.php/principal/login_estudiante";    
        $.ajax({
               url:url,
               type:'POST',
               data:$("#frmpersona").serialize(),
               success:function(respuesta){
               if(respuesta!=0){   
                 var registros = eval(respuesta); 
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                               var html = '<label><h5><font color="FFFFFF">Hola, '+registros[i]["nombre"]+'</font></h5></label>';
                          }      
                       }
                     } 
                    else{
                      var html = '<label><h5><font color="FFFFFF">Hola, Invitado</font></h5></label>';
                      alert("Usuario No Registrado, Ingresará como invitado")}   
                   $("#nomusuario").html(html);                     
                },
               error:function(){ alert("Error!");}                                   
               });
}
function cambiar_clave(){
    var url = base_url + "principal/cambio_clave"; 
    $.ajax({
        url:url,
        type:'POST',
        data:$("#frmcambio").serialize(),
        success:function(respuesta){
            data = JSON.parse(respuesta);
            $("#contenedor").html('');  
        },
        error:function(){ 
            alert("Error!");
        }                                   
    });
}
function listar_materias(id){ 
var rol = document.getElementById("rol").value;
    var url = "./index.php/docente/asignacion/" + id; 
        $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){ 
                 var registros = eval(respuesta);
                    html='<div class="panel panel-primary">';        
                    html=html+'<div class="panel-heading text-capitalize"><b>Asignación Académica</b></div>';
                    html=html+'<div class="panel-body">';  
                    html=html+'<div class="row">';  
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {
                            var area=registros[i]["nomarea"];
                            var materia=registros[i]["nommateria"];
                            var grado=registros[i]["grado"];
                            var icono=registros[i]["icomateria"];
                            html=html+"<div class='col-md-6 col-sm-6 col-lg-4 col-xl-3'>";
                            html=html+"<div class='mini-stat clearfix bx-shadow'>";
                            html=html+"<a href='javascript:enlace_materia(" + id+",\"" + registros[i]["codmateria"]+"\")'>";
                            html += "<div style='background:"+colors_list[Math.floor(Math.random() * colors_list.length)]+"' class='contenedor-asignacion-docente'>"
                            html += "<h3>"+capitalizeTheFirstLetterOfEachWord(materia)+"</h3>"
                            html += "<h1>"+grado+"</h1>"
                            html += "</div>"
                            html=html+"</a></div></div>"; 
                          } 
                    if(rol!=='admin' && rol!=='apoyo'){
                        /* html=html+"<div class='col-md-6 col-sm-6 col-lg-3'>";
                         html=html+"<div class='mini-stat clearfix bx-shadow'>";
                         html=html+"<a href='javascript:docente_acti(" + id+")'>";
                         html=html+"<img src='./img/botones/actividades/actividades.png' width='100%' height='100%'></a></div></div>"; */
                     }     
                   }
                     html=html+"</div></div></div>";
                     html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                $("#materias").html(html);
                $("#rutas").html(materia);
                },
               error:function(){ alert("Error de asignación!");}                                   
               });
}
function listar_procesos(id){ 
var rol = document.getElementById("rol").value;
    var url = "./index.php/docente/asigna_procesos/" + id; 
        $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){ 
                 var registros = eval(respuesta);
                    html='<div class="panel panel-primary">';        
                    html=html+'<div class="panel-heading text-capitalize"><b>Asignación de Procesos</b></div>';
                    html=html+'<div class="panel-body">';  
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {
                            var materia=registros[i]["nomproceso"];
                            var icono=registros[i]["icono"];
                            var tipo='procesos';
                            var proceso='proceso';
                            html=html+"<div class='col-md-6 col-sm-6 col-lg-3'>";
                            html=html+"<div class='mini-stat clearfix bx-shadow'>";
                            html=html+"<a href='javascript:listarproc(\"" + registros[i]["nomproceso"]+"\",\"" + registros[i]["nomproceso"]+"\");'>";
                            html=html+"<img src='./img/botones/procesos/" + icono+"' width='100%' height='100%'></a></div></div>"; 
                          }     
                   }
                     html=html+"</div></div>";
                     html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                $("#materias").html(html);
                $("#rutas").html(materia);
                },
               error:function(){ alert("Error de asignación!");}                                   
               });
}
function listar_proyectos(id){
    var url = "./index.php/docente/proyectos/" + id; 
        $.ajax({
               url:url,
               type:'POST',
               async:false,
               cache:false,
               success:function(respuesta){
                 var registros = eval(respuesta);
                    html='<div class="panel panel-primary">';        
                    html=html+'<div class="panel-heading text-capitalize"s><b>Proyectos Pedagógicos</b></div>';
                    html=html+'<div class="panel-body">'; 
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            var icono=registros[i]["icono"].toLowerCase();
                            html=html+"<div class='col-md-6 col-sm-6 col-lg-3'>";
                            html=html+"<div class='mini-stat clearfix bx-shadow'>";
                            html=html+"<a href='javascript:listarpro(\"" + registros[i]["nomproyecto"]+"\",\"" + registros[i]["nomproyecto"]+"\")'>";
                            html=html+"<img src='./img/botones/proyectos/" + icono+"' width='100%' height='100%'></a></div></div>"; 
                            titulo = registros[i]["nomproyecto"];
                          }          
                      }
                    html=html+"</div></div>"; 
                    html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                $("#proyectos").html(html);  
                },
               error:function(){ alert("Usuario o Contraseña Invalidos!");}                                   
               });
}

function listar_tproyectos(){
    var url = "./index.php/docente/tproyectos"; 
        $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){ 
                 var registros = eval(respuesta);
                    html='<div class="panel panel-primary">';        
                    html=html+'<div class="panel-heading text-capitalize"><b>Proyectos Pedagógicos</b></div>';
                    html=html+'<div class="panel-body">';  
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            var icono=registros[i]["icono"].toLowerCase();
                            html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
                            html+="<div class='mini-stat clearfix bx-shadow'>";
                            html+="<a href='javascript:listarpro(\"" + registros[i]["nomproyecto"]+"\",\"" + registros[i]["nomproyecto"]+"\")'>";
                            html+="<img src='./img/botones/proyectos/" + icono+"' width='100%' height='100%'></a></div></div>"; 
                            titulo = registros[i]["nomproyecto"];
                          }          
                      }
                    html+="</div></div>";   
                    html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                $("#proyectos").html(html);  
                },
               error:function(){ alert("Usuario o Contraseña Invalidos!");}                                   
               });
}

function listar_comunica(){
    html='<div class="panel panel-primary">';        
    html+='<div class="panel-heading text-capitalize"><b>Comunicación Institucional</b></div>';
    html+='<div class="panel-body">';  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'>";
    if(rol==='Docente'){html+="<a href='javascript:listardoc(\"raiz\",\"documentos\",\"documentos\")'>";}
    else{html+="<a href='javascript:listado(\"raiz\",\"documentos\",\"documentos\",\"documentos Institucionales\",\"documentos Institucionales\")'>";}
    html+="<img src='./img/botones/documentos/documentos.png' width='100%' height='100%'></a></div></div>";                      
    html+="</div></div>";     
    html+='<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
    $("#comunica").html(html);  
}
function listar_planeacion(){
    var url = base_url + "docente/planeacion";
        $.ajax({
               url:url, 
               type:'POST',
               async:false,
               cache:false,
               success:function(respuesta){
                 var registros = eval(respuesta);
                    if(!respuesta.hasOwnProperty("status")){
                        html='<div class="panel panel-primary">';        
                        html=html+'<div class="panel-heading text-capitalize"s><b>Planeación Institucional</b></div>';
                        html=html+'<div class="panel-body">'; 
                        if(registros.length>0){ 
                            for (i=0; i<registros.length; i++) { 
                                var icono=registros[i]["icono"].toLowerCase();
                                html=html+"<div class='col-md-6 col-sm-6 col-lg-3'>";
                                html=html+"<div class='mini-stat clearfix bx-shadow'>";
                                html=html+"<a href='javascript:listardoc(\"" + registros[i]["tipo"]+"\",\"" + registros[i]["enlace"]+"\",\"" + registros[i]["enlace"]+"\",\"" + registros[i]["descripcion"]+"\")'>";

                                //html=html+"<a href='javascript:listardoc(\"" + tipo+"\",\"" + narea+"\",\"" + nmateria+grado+"\",\"" + grado+grupo+"\")'>"; 
                            //	listardoc(tipo,carpeta,materia,grupo)

                                html=html+"<img src='./img/botones/menu/" + icono+"' width='100%' height='100%'></a></div></div>"; 
                                titulo = registros[i]["descripcion"];
                            }          
                        }
                        html=html+"</div></div>"; 
                        html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                        $("#planeacion").html(html);  
                    }
                    else{
                        location.reload();
                    }
                },
               error:function(){ alert("Usuario o Contraseña Invalidos!");}                                   
               });

}
function listar_acti(){ 
var ced=document.getElementById("ced").value;
    var url = "./index.php/actividades/listar_docente/" + ced; 
        $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){ 
                    $("#contenedor").html(respuesta);  
                },
               error:function(){ alert("Usuario o Contraseña Invalidos!");}                                   
        });
}

function cambio_menu(){
		var rol=document.getElementById("rol").value;    
    if (rol!=='super'){ 
        html="<ul>";
        //html+="<li><a href='javascript:cfg_docente();'>";
        //html+="<i><img src='./img/iconos/menu.png' width='60' height='40'></i><span>Administrar</span></a></li>";  
        html+="<li><a href='" + base_url+"Pruebas' class='waves-effect'>";
        html+="<i><img src='./img/iconos/pruebas.png' width='50' height='50'></i><span>Pruebas</span></a></li>";   
        html+="<li><a href='javascript:cfg_docente();' class='waves-effect'>";
        html+="<i><img src='./img/iconos/asignacion.png' width='50' height='50'></i><span>Asignación</span></a></li>";
        html+="<li><a href='javascript:cfg_proyectos();' class='waves-effect'>";
        html+="<i><img src='./img/iconos/proyectos.png' width='50' height='50'></i><span>Proyectos</span></a></li>";    
        html+="<li><a href='javascript:cfg_comunicacion();' class='waves-effect'>";
        html+="<i><img src='./img/iconos/comunicacion.png' width='50' height='50'></i><span>Comunicación</span></a></li>";    
        html+="<li><a href='javascript:cfg_planeacion();' class='waves-effect'>";
        html+="<i><img src='./img/iconos/planeacion.png' width='50' height='50'></i><span>Planeación</span></a></li>"; 
        html+="<li><a href='javascript:cfg_cambio_clave();' class='waves-effect'>";
        html+="<i><img src='./img/iconos/clave.png' width='50' height='50'></i><span>Cambio Clave</span></a></li>";             
        html+="<li><a href='javascript:logout();'>";
        html+="<i><img src='./img/iconos/cerrar.png' width='50' height='50'></i><span>Cerrar Sesión</span></a></li>";  
        html+="</ul>";
        $("#sidebar-menu").html(html); 
    }
    if (rol==='super'){
        administrar();
    }
		if(rol=== 'Estudiante'){
			menuForStudents();
		}
}

function menuForStudents(){
	html="<ul>";
    html+="<li><a href='" + base_url+"Pruebas' class='waves-effect'>";
    html+="<i><img src='./img/iconos/pruebas.png' width='50' height='50'></i><span>Pruebas</span></a></li>"; 
	html+="<li><a href='javascript:StudentAreas();'>";
	html+="<i><img src='./img/iconos/areas.png' width='50' height='50'></i><span>Areas</span></a></li>";             
	html+="<li><a href='javascript:cfg_cambio_clave();' class='waves-effect'>";
	html+="<i><img src='./img/iconos/clave.png' width='50' height='50'></i><span>Cambio Clave</span></a></li>";             
	html+="<li><a href='javascript:logout();'>";
	html+="<i><img src='./img/iconos/cerrar.png' width='50' height='50'></i><span>Cerrar Sesión</span></a></li>";  
	html+="</ul>";
	$("#sidebar-menu").html(html); 
}


function logout(){
    var url = "./index.php/principal/logout";   
    $.ajax({
			url:url,
			type:'POST',
			data:$("#frmcambio").serialize(),
			success:function(respuesta){
				window.location.replace("");
			},
			error:function(){ alert("error al intentar hacer logout");}                                   
		});
}
function administrar(){
        html='<div class="panel panel-primary">';        
        html=html+'<div class="panel-heading text-capitalize"><b>Administrar IntegraTIC</b></div>';
        html=html+'<div class="panel-body">';  
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:consultas(" + '"areas"'+");'>";
        html=html+"<img src='./img/botones/menu/cons_areas.png' width='100%' height='100%'></a></div></div>";   
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:consultas(" + '"materias"'+");'>";
        html=html+"<img src='./img/botones/menu/cons_materias.png' width='100%' height='100%'></a></div></div>"; 
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:consultas(" + '"proyectos"'+");'>";
        html=html+"<img src='./img/botones/menu/cons_proyectos.png' width='100%' height='100%'></a></div></div>";   
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:consultas(" + '"procesos"'+");'>";
        html=html+"<img src='./img/botones/menu/cons_procesos.png' width='100%' height='100%'></a></div></div>";          
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:consultas(" + '"usuarios"'+");'>";
        html=html+"<img src='./img/botones/menu/cons_usuarios.png' width='100%' height='100%'></a></div></div>";   
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:cfg_areas();'>";
        html=html+"<img src='./img/botones/menu/crear_areas.png' width='100%' height='100%'></a></div></div>"; 
        html=html+"<br><br><br><br><br><br><br>";
       
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:cfg_materias();'>";
        html=html+"<img src='./img/botones/menu/crear_materias.png' width='100%' height='100%'></a></div></div>"; 
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:cfg_proyecto();'>";
        html=html+"<img src='./img/botones/menu/crear_proyectos.png' width='100%' height='100%'></a></div></div>";         
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:cfg_usuario();'>";
        html=html+"<img src='./img/botones/menu/crear_usuarios.png' width='100%' height='100%'></a></div></div>";  
        
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:cfg_procesos();'>";
        html=html+"<img src='./img/botones/menu/crear_procesos.png' width='100%' height='100%'></a></div></div>";         
        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";

        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:asg_procesos();'>";
        html=html+"<img src='./img/botones/menu/asg_procesos.png' width='100%' height='100%'></a></div></div>"; 


        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:modasigna();'>";
        html=html+"<img src='./img/botones/menu/asg_academica.png' width='100%' height='100%'></a></div></div>";   

        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:proasigna();'>";
        html=html+"<img src='./img/botones/menu/asg_proyectos.png' width='100%' height='100%'></a></div></div>";  

        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:export_DB();'>";
        html=html+"<img src='./img/botones/menu/descargar_bd.png' width='100%' height='100%'></a></div></div>"; 

        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='javascript:reportes();'>";
        html=html+"<img src='./img/botones/menu/reporte.png' width='100%' height='100%'></a></div></div>";

        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='"+base_url+"Configuracion'>";
        html=html+"<img src='./img/botones/menu/conf_apariencia.png' width='100%' height='100%'></a></div></div>"; 

        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='"+base_url+"Estudiante/verTodos'>";
        html=html+"<img src='./img/botones/menu/bd_estudiantes.png' width='100%' height='100%'></a></div></div>"; 

        html=html+"<div class='col-md-3 col-sm-3 col-lg-3'>";
        html=html+"<div class='mini-stat clearfix bx-shadow'>";
        html=html+"<a href='"+base_url+"Caracterizacion'>";
        html=html+"<img src='./img/botones/menu/caracterizar_contenido.png' width='100%' height='100%'></a></div></div>"; 

        html+="</div></div>";   
        html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
        $("#contenedor").html(html);   
        
        html="<ul>";    
        html+="<li><a href='javascript:administrar()' onclick='javascript:administrar()'>";
        html+="<i><img src='./img/iconos/menu.png' width='50' height='50'></i><span>Menú<br>Principal</span></a></li>";                       
        html+="<li><a href='./principal/manuales/manual_integra.pdf' target='_blank'>";
        html+="<i><img src='./img/iconos/manual.png' width='50' height='50'></i><span>Manual<br> Usuario</span></a></li>";          
        html+="<li><a href='javascript:logout()' onclick='javascript:logout()'>";
        html+="<i><img src='./img/iconos/cerrar.png' width='50' height='50'></i><span>Cerrar<br> Sesión</span></a></li>";         
        html+="</ul>";
        $("#sidebar-menu").html(html); 
}
function cfg_menupri(){
$('#modal_menupri').modal('show');
}

function subir_acti(){
    html='<div class="panel panel-primary">';
    html=html+'<div class="panel-heading text-capitalize"><b>Cargue de Actividades académicas</b></div>';
    html=html+'<div class="panel-body">'; 
    html=html+'<div class="form-group">';
    html=html+'<div class="row">';
    html=html+"<div class='col-xs-2'>";
    html=html+'<select class="form-control" name="grupo" id="grupo" onchange="javascript:mostrar_materias();">';
    html=html+'<option value="" selected disabled>Seleccione Grupo</option>';
    var url = "./index.php/actividades/grupos"; 
        $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){
                 var registros = eval(respuesta);
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {
                              var grupo = registros[i]["grupo"];
                              if (grupo==='N'){grupo='';}
                            html=html+'<option value="'+registros[i]["grado"]+grupo+'">'+registros[i]["grado"]+grupo+'</option>';
                          }   
                          html=html+'</select></div><div id="sel_materias" class="col-xs-6"></div><div class="col-xs-2">';
                          html=html+'<button type="button" class="btn btn-primary btn-sm w-lg waves-effect waves-light" onclick="javascript:fsubiract();">Subir Archivo</button>';
                          html=html+'</div><div class="col-xs-2"></div></div></div></div></div>';
                          html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                          $("#contenedor").html(html);     
                      }                 
                }                              
               });               
    }   
function docente_acti(id){
var html='<div class="panel panel-primary">';
    html+='<div class="panel-heading text-capitalize"><b>Actividades académicas presentadas</b></div>';
    html+='<div class="panel-body">'; 
    html+='<div class="form-group">';
    html+='<div class="row">';
    html+="<div class='col-xs-8'>";
    html+='<select class="form-control" name="materia_acti" id="materia_acti" onclick="javascript:mostrar_acti();">';
    html+='<option selected disabled>Seleccione Asignatura</option>';
    var url = "./index.php/docente/asignadoc/" + id; 
        $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){
                 var registros = eval(respuesta);
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {
                            html+='<option value="">'+registros[i]["nommateria"]+' '+registros[i]["grado"]+registros[i]["grupo"]+'</option>';
                          }   
                          html+='</select>';
                          html=html+'</div><div class="col-xs-2"></div></div></div></div></div>';
                          html=html+'<div id="contenido"><div class="panel-body"><div id="listacon"></div></div></div>';
                          $("#contenedor").html(html);     
                      }                 
                }                              
               });            
    }   
function mostrar_materias(){ 
  var grado=document.getElementById("grupo").value; 
  if(grado){
    var tam = grado.length-1;
    var gra = grado.substring(0,tam);
  }else{gra=grado;}
    html='<select class="form-control" name="materia" id="materia" onchange="javascript:mostrar_conte();">';
    html+='<option value="" selected disabled>Seleccione Asignatura</option>';
    var url = "./index.php/actividades/materias_grupo/" + gra; 
        $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){
                 var registros = eval(respuesta);
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {
                            html+='<option value="'+registros[i]["codmateria"]+'">'+registros[i]["nommateria"]+'</option>';
                          }   
                          html+='</select>';
                          $("#sel_materias").html(html);     
                      }                 
                }                              
               });               
    }   
function mostrar_conte(){ 
    var mat=document.getElementById("materia").value;
    if(mat){
        var combo = document.getElementById("materia");
        var materia=combo.options[combo.selectedIndex].text; 
            combo = document.getElementById("grupo");
        var grupo=combo.options[combo.selectedIndex].text; 
        var ruta ="./principal/areas/actividades/" + materia+" " + grupo;
        document.getElementById("diract").value=ruta;
        mostrar_contenidos();
    }
}
function mostrar_contenidos(){
    var combo = document.getElementById("materia");
    var materia=combo.options[combo.selectedIndex].text; 
        combo = document.getElementById("grupo");
    var grupo=combo.options[combo.selectedIndex].text; 
    var titulo=materia+" " + grupo;
  var ruta =document.getElementById("diract").value;
  $("#contenido").html('<div class="panel-body"><div id="listacon"></div></div>');
    url='./index.php/actividades/listar';
            $.ajax({
               url:url,
               type:'POST',
               data:{ruta:ruta,titulo:titulo},
               success:function(respuesta){ 
                        $("#listacon").html(respuesta);  
                        $("#rutas").html(titulo);                        
               },
               error:function(){alert("Ocurrió un Error!");}        
       });     
}
function mostrar_acti(){
  var combo = document.getElementById("materia_acti");
  var materia=combo.options[combo.selectedIndex].text; 
  var titulo="principal/areas/actividades/" + materia;
  document.getElementById("dir").value=titulo;
  document.getElementById("nomdir").value=materia;
  document.getElementById("ubica").value=materia;
  if(materia !== 'Seleccione Asignatura'){ 
  var url='./index.php/actividades/listar_act_doc';
            $.ajax({
               url:url,
               type:'POST',
               data:{ruta:titulo,titulo:materia},
               success:function(respuesta){
                        $("#listacon").html(respuesta);  
                        $("#rutas").html(titulo);                        
               },
               error:function(){alert("Ocurrió un Error!");}        
       });
    }        
}   
function cfg_asignacion(){
    $('#modal_asigna').modal('show');
}
function creaUsuario() {
 if(document.getElementById("ced").value !== "" &&
    document.getElementById("mail").value !== "" &&
    document.getElementById("pass").value !== "") {

    $.ajax({
            url:'<?=site_url();?>/usuarios/nuevo',
            type:'POST',
            data:$("#frmnuevo").serialize(),
            success:function(){
                $('#modal_usuario').modal('hide');
            },
            error:function(respuesta){
                    alert("Error al crear el usuario!");
            }                    
    });
    }else{alert("Verifique Datos!");}
}  

function modasigna(){
    $('#modal_asigna').modal('show');
    $("#lista_asignadas").html(''); 
    con_materias();
    con_docentes();
    lista_asg();
}
function proasigna(){
    $('#modal_asignapro').modal('show');
    $("#lista_asignadas").html(''); 
    con_proyectos();
    con_prodocentes();
    proyectos_asg();
}
function asg_procesos(){
    $('#modal_asignaproc').modal('show');
    $("#lista_asignadas").html(''); 
    con_procesos();
    con_nodocentes();      
    procesos_asg();
}
function con_materias(){
    $.ajax({
            url:'<?=site_url();?>/docente/tmaterias',
            type:'POST',
            success:function(respuesta){
                var registros = eval(respuesta);
                html='<select class="form-control" id="materia" name="materia">';
                if(registros.length>0){ 
                    for (i=0; i<registros.length; i++) {
                      html+='<option value="'+registros[i]["codmateria"]+'">'+registros[i]["nommateria"]+' '+registros[i]["grado"]+'</option>';
                    }
                }   
                html+='</select>'; 
                $("#lista_materias").html(html);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    }); 
}
function con_proyectos(){
    $.ajax({
            url:'<?=site_url();?>/docente/tproyectos',
            type:'POST',
            success:function(respuesta){
                var registros = eval(respuesta);
                html='<select class="form-control" id="proyecto" name="proyecto">';
                if(registros.length>0){ 
                    for (i=0; i<registros.length; i++) {
                      html+='<option value="'+registros[i]["codpro"]+'">'+registros[i]["nomproyecto"]+'</option>';
                    }
                }   
                html+='</select>'; 
                $("#lista_proyectos").html(html);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    }); 
}
function con_procesos(){
    $.ajax({
            url:'<?=site_url();?>/docente/tprocesos',
            type:'POST',
            success:function(respuesta){
                var registros = eval(respuesta);
                html='<select class="form-control" id="proceso" name="proceso">';
                if(registros.length>0){ 
                    for (i=0; i<registros.length; i++) {
                      html+='<option value="'+registros[i]["codpro"]+'">'+registros[i]["nomproceso"]+'</option>';
                    }
                }   
                html+='</select>'; 
                $("#lista_procesos").html(html);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    }); 
}
function con_docentes(){
 $.ajax({
            url:'<?=site_url();?>/docente/co_docentes',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                html='<select class="form-control" id="docentes" name="docentes" onchange="lista_asg();">';
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            html+='<option value="'+registros[i]["id"]+'">'+registros[i]["nombres"]+' '+registros[i]["apellidos"]+'</option>';
                          }     
                   }                
                html+='</select>'; 
                $("#lista_docentes").html(html);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });     
}
function con_prodocentes(){
 $.ajax({
            url:'<?=site_url();?>/docente/co_docentes',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                html='<select class="form-control" id="prodocentes" name="prodocentes" onchange="proyectos_asg();">';
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            html+='<option value="'+registros[i]["id"]+'">'+registros[i]["nombres"]+' '+registros[i]["apellidos"]+'</option>';
                          }     
                   }                
                html+='</select>'; 
                $("#lista_prodocentes").html(html);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });     
}
function con_nodocentes(){
 $.ajax({
            url:'<?=site_url();?>/docente/co_nodocentes',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                html='<select class="form-control" id="nodoc" name="nodoc" onchange="procesos_asg();">';
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            html+='<option value="'+registros[i]["id"]+'">'+registros[i]["nombres"]+' '+registros[i]["apellidos"]+'</option>';
                          }     
                   }                
                html+='</select>'; 
                $("#lista_nodocentes").html(html);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });     
}
function lista_asg(){
 var id=document.getElementById("docentes").value;
 $("#lista_asignadas").html('');
        $.ajax({
               url:'<?=site_url();?>/docente/asignadoc/'+id,
               type:'POST',
               success:function(respuesta){ 
                 var registros = eval(respuesta);
                      html='<select multiple class="form-control" id="listado_asg" name ="listado_asg" size="10">'; 
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            var gru=registros[i]["grupo"];  
                            if(gru==='N'){gru='';}
                            html+='<option value="'+registros[i]["codmateria"]+'">'+registros[i]["nommateria"]+' '+registros[i]["grado"]+gru+'</option>';
                          }     
                   }
                      html+='</select></form>'; 
                $("#lista_asignadas").html(html);
                },
               error:function(){ alert("Error!");}                                   
               });
}
function proyectos_asg(){
 var id=document.getElementById("prodocentes").value;
 $("#lista_asignapro").html('');
        $.ajax({
               url:'<?=site_url();?>/docente/asignapro/'+id,
               type:'POST',
               success:function(respuesta){
                 var registros = eval(respuesta);
                      html='<select multiple class="form-control" id="pro_asg" name ="pro_asg" size="10">'; 
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            html+='<option value="'+registros[i]["codpro"]+'">'+registros[i]["nomproyecto"]+'</option>';   
                        }  
                   }
                      html+='</select></form>'; 
                $("#lista_asignapro").html(html);
                },
               error:function(){ alert("Error!");}                                   
               });
}
function procesos_asg(){
 var id=document.getElementById("nodoc").value;
 $("#lista_asignaproc").html('');
        $.ajax({
               url:'<?=site_url();?>/docente/asignaproc/'+id,
               type:'POST',
               success:function(respuesta){ 
                 var registros = eval(respuesta);
                      html='<select multiple class="form-control" id="proc_asg" name ="proc_asg" size="10">'; 
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            html+='<option value="'+registros[i]["codpro"]+'">'+registros[i]["nomproceso"]+'</option>';   
                        }  
                   }
                      html+='</select></form>'; 
                $("#lista_asignaproc").html(html);
                },
               error:function(){ alert("Error!");}                                   
               });
} 
function add_asg() {

    var combo = document.getElementById("materia");
    var nom = combo.options[combo.selectedIndex].text;    
    var x = document.getElementById("listado_asg");
    var option = document.createElement("option");
    var cmat = document.getElementById("materia").value;
    option.value = cmat;
    option.text = nom;
    x.add(option);    
}
function remover_asg(){
    var ced= document.getElementById("docentes").value;
    var combo = document.getElementById("listado_asg");
    var mat = combo.options[combo.selectedIndex].value;
    var combo = document.getElementById("listado_asg");
    var gru = combo.options[combo.selectedIndex].text;
    var tam = gru.length-1;
    var let=gru.substring(tam,tam+1);
        let=let.trim();
    var url='<?=site_url();?>/asignacion/bo_asigna';
    $.ajax({
            url:url,
            type:'POST',
            datatype:'json',
            data:{ced:ced,mat:mat,gru:let},
            success:function(){
                lista_asg();
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                      
    });    
}
function in_asg(){
 var ced= document.getElementById("docentes").value;
 var cmat=document.getElementById("materia").value;
 var gru=document.getElementById("grupo").value;
 var url='<?=site_url();?>/asignacion/in_asigna';
 //alert(url);
    $.ajax({
            url:url,
            type:'POST',
            data:{ced:ced,mat:cmat,gru:gru},
            success:function(){
                lista_asg();
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });
} 
function val_asg(){
 var ced= document.getElementById("docentes").value;
 var cmat=document.getElementById("materia").value;
 var gru=document.getElementById("grupo").value;
 var url = '<?=site_url();?>/asignacion/val_asigna';
     $.ajax({
            url:url,
            type:'POST',
            data:{mat:cmat,gru:gru},
            async:false,
            cache:true,
            success:function(respuesta){
            if(respuesta!=='0'){                                              
                   if(confirm("YA Asignada a" + respuesta+"Asignar de todas formas?")){                  
                      $.ajax({
                              url:'<?=site_url();?>/asignacion/in_asigna',
                              type:'POST',
                              data:{ced:ced,mat:cmat,gru:gru},
                              success:function(){
                                  lista_asg();
                              },
                              error:function(respuesta){
                                      alert("Error: No hay Registros!");
                              }                    
                      });
                  }
              }
              else{
                      $.ajax({
                              url:'<?=site_url();?>/asignacion/in_asigna',
                              type:'POST',
                              data:{ced:ced,mat:cmat,gru:gru},
                              success:function(){
                                  lista_asg();
                              },
                              error:function(respuesta){
                                      alert("Error: No hay Registros!");
                              }                    
                      });                
              }

            },
            error:function(respuesta){
                    alert("Error 801: " + respuesta);
            }                    
    });
;
}
function in_asignapro(){
 var ced= document.getElementById("prodocentes").value;
 var pro=document.getElementById("proyecto").value;
    $.ajax({
            url:'<?=site_url();?>/asignacion/in_asignapro',
            type:'POST',
            data:{ced:ced,pro:pro},
            success:function(){
                proyectos_asg();
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });
}
function in_asignaproc(){
 var ced= document.getElementById("nodoc").value;
 var pro=document.getElementById("proceso").value;
 

    $.ajax({
            url:'<?=site_url();?>/asignacion/in_asignaproc',
            type:'POST',
            data:{ced:ced,pro:pro},
            success:function(){
                procesos_asg();
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });
}
function remover_pro(){
 var ced= document.getElementById("docentes").value;
 var pro=document.getElementById("pro_asg").value;
    $.ajax({
            url:'<?=site_url();?>/asignacion/bo_asignapro',
            type:'POST',
            datatype:'json',
            data:{ced:ced,pro:pro},
            success:function(){
                proyectos_asg();
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });    
}
function remover_proc(){
 var ced= document.getElementById("nodoc").value;
 var pro=document.getElementById("proc_asg").value;
    $.ajax({
            url:'<?=site_url();?>/asignacion/bo_asignaproc',
            type:'POST',
            datatype:'json',
            data:{ced:ced,pro:pro},
            success:function(){
                procesos_asg();
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });     
}
function crearArea(){
 var formData = new FormData($("#frmareas")[0]);
 var url='<?=site_url();?>/config/nuevoArea';
    $.ajax({
            url:url,
            type:'POST',
            data:formData,
            cache:false,
            contentType:false,
            processData:false,              
            success:function(respuesta){
                $("#icoarea-nueva-imagen").val(null);
                $(".set-imagen-area").removeClass("selected");
                $("#selected-imagen-area").attr("src", "");
                $("#selected-imagen-area").css("display", "none");
                $("#frmareas").trigger("reset");
                alert(respuesta);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });    
}
function crearMateria(){
 var formData = new FormData($("#frmmaterias")[0]);
 var url='<?=site_url();?>/config/nuevoMateria';
    $.ajax({
            url:url,
            type:'POST',
            data:formData,
            cache:false,
            contentType:false,
            processData:false,              
            success:function(respuesta){
                alert(respuesta);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });    
}
function crearProyecto(){
 var formData = new FormData($("#frmProyecto")[0]);
 var url= base_url + 'config/nuevoProyecto';
    $.ajax({
            url:url,
            type:'POST',
            data:formData,
            cache:false,
            contentType:false,
            processData:false,              
            success:function(respuesta){
                alert(respuesta);
                $("#frmProyecto").trigger("reset");
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    });    
}
function crearProceso(){
 var formData = new FormData($("#frmproceso")[0]);
 var url='<?=site_url();?>/config/nuevoProceso';
    $.ajax({
            url:url,
            type:'POST',
            data:formData,
            cache:false,
            contentType:false,
            processData:false,              
            success:function(respuesta){
                alert(respuesta);
                $("#frmproceso").trigger("reset");
            },
            error:function(respuesta){alert("Error: " + respuesta);}                    
    });    
}
function cfg_usuario(){$('#modal_usuario').modal('show');}
function cfg_areas(){
    document.getElementById("nomarea").value='';
    document.getElementById("archivo").value='';
        $('#modal_areas').modal('show'); 
}
function cfg_materias(){
    $.ajax({
            url:'<?=site_url();?>/docente/co_areas',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                html='<select class="form-control" id="areasmat" name="areasmat">';
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                            html+='<option value="'+registros[i]["codarea"]+'">'+registros[i]["nomarea"]+'</option>';
                          }     
                   }                
                html+='</select>'; 
                $("#lista_areas").html(html);
            },
            error:function(respuesta){
                    alert("Error: " + respuesta);
            }                    
    }); 
    $('#modal_materias').modal('show');  
}
function cfg_proyecto(){
        $('#modal_proyectos').modal('show'); 
}
function cfg_procesos(){
        $('#modal_procesos').modal('show'); 
}
function consultas(tipo){
    $("#con_titulo").html('');
    $("#con_cuerpo").html('');
    $("#con_pie").html('');
    $('#modal_menupri').modal('hide'); 
    switch(tipo){
        case 'areas':   con_areas(); break;
        case 'materias':consu_materias(); break;
        case 'usuarios':con_usuarios(); break;
        case 'proyectos':consu_proyectos(); break;   
        case 'procesos':consu_procesos(); break;  
        case 'menuad':consu_menuad(); break;    
    }
    $('#modal_consultas').modal('show');  
}

function con_areas(){
    $.ajax({
            url:'<?=site_url();?>/docente/co_areas',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                    var html='<table class="table table-bordered table-hover">';
                        html+='<thead><tr style="background-color: #229678">';
                        html+='<th class="text-white text-center" width="20%">Código</th>';
                        html+='<th class="text-white text-center" width="60%">Descripción</th>';
                        html+='<th class="text-white text-center" width="60%">Tipo</th>';
                        html+='<th class="text-white text-center" width="60%">Icono</th>';
                        html+='<th class="text-white text-center" width="10%">Eliminar</th>';
                        html+='<th class="text-white text-center" width="10%">Editar</th>';            
                        html+="</tr></thead>";
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                                    html+='<tr>';
                                    html+='<td align="center">'+registros[i]["codarea"]+'</td>';
                                    html+='<td>'+registros[i]["nomarea"]+'</td>'; 
                                    html+='<td>'+registros[i]["tipo"]+'</td>';
                                    html+='<td>'+registros[i]["icoarea"]+'</td>';
                                    html+='<td class="text-center"><a href="javascript:borrarArea(this);" onclick="borrarArea(this)">';
                                    html+='<img src="<?=base_url();?>img/delete.png" width="20" height="20"/></a></td>';
                                    html+='<td class="text-center"><a href="javascript:editarArea(this);" onclick="editarArea(this)">';
                                    html+='<img src="<?=base_url();?>img/editar.png" width="20" height="20"/></a></td>';
                                    html+='</tr>';
                          }     
                   }                
                html+='</table>'; 
                $("#con_cuerpo").html(html);
            },
            error:function(respuesta){alert("No hay Areas Registradas!");
            }                    
    });    
    titulo='<h4 class="modal-title">Consulta de Areas Existentes</h4> ';
    pie='<button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button>';      
    $("#con_titulo").html(titulo);
    $("#con_pie").html(pie);
}
function consu_materias(){
    $.ajax({
            url:'<?=site_url();?>/docente/tmaterias',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                    var html='<table class="table table-bordered table-hover">';
                        html+='<thead><tr style="background-color: #229678">';
                        html+='<th class="text-white text-center" width="20%">Código</th>';
                        html+='<th class="text-white text-center" width="60%">Asignatura</th>';
                        html+='<th class="text-white text-center" width="60%">Grado</th>';
                        html+='<th class="text-white text-center" width="10%">Eliminar</th>';
                        html+='<th class="text-white text-center" width="10%">Editar</th>';            
                        html+="</tr></thead>";
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                                    html+='<tr>';
                                    html+='<td align="center">'+registros[i]["codmateria"]+'</td>';
                                    html+='<td>'+registros[i]["nommateria"]+'</td>';  
                                    html+='<td>'+registros[i]["grado"]+'</td>';  
                                    html+='<td class="text-center"><a href="javascript:borrarMateria(this);" onclick="borrarMateria(this)">';
                                    html+='<img src="<?=base_url();?>img/delete.png" width="20" height="20"/></a></td>';
                                    html+='<td class="text-center"><a href="javascript:editarMateria(this);" onclick="editarMateria(this)">';
                                    html+='<img src="<?=base_url();?>img/editar.png" width="20" height="20"/></a></td>';
                                    html+='</tr>';
                          }     
                   }                
                html+='</table>'; 
                $("#con_cuerpo").html(html);
            },
            error:function(respuesta){alert("No hay Asignaciones Registradas!");
            }                    
    });    
    titulo='<h4 class="modal-title">Consulta de Asignaturas Existentes</h4> ';
    pie='<button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button>';      
    $("#con_titulo").html(titulo);
    $("#con_pie").html(pie);
}
function consu_proyectos(){
    $.ajax({
            url:'<?=site_url();?>/docente/tproyectos',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                    var html='<table class="table table-bordered table-hover">';
                        html+='<thead><tr style="background-color: #229678">';
                        html+='<th class="text-white text-center" width="20%">Código</th>';
                        html+='<th class="text-white text-center" width="60%">Proyecto</th>';
                        html+='<th class="text-white text-center" width="10%">Eliminar</th>';
                        html+='<th class="text-white text-center" width="10%">Editar</th>';            
                        html+="</tr></thead>";
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                                    html+='<tr>';
                                    html+='<td align="center">'+registros[i]["codpro"]+'</td>';
                                    html+='<td>'+registros[i]["nomproyecto"]+'</td>';  
                                    html+='<td><a href="javascript:borrarMateria(this);" onclick="borrarProyecto(this)">';
                                    html+='<img src="<?=base_url();?>img/delete.png" width="20" height="20"/></a></td>';
                                    html+='<td><a href="javascript:editarMateria(this);" onclick="editarProyecto(this)">';
                                    html+='<img src="<?=base_url();?>img/editar.png" width="20" height="20"/></a></td>';
                                    html+='</tr>';
                          }     
                   }                
                html+='</table>'; 
                $("#con_cuerpo").html(html);
            },
            error:function(respuesta){alert("No hay Proyectos Registrados!");
            }                    
    });    
    titulo='<h4 class="modal-title">Consulta de Proyectos Existentes</h4> ';
    pie='<button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button>';      
    $("#con_titulo").html(titulo);
    $("#con_pie").html(pie);
}
function consu_procesos(){
    $.ajax({
            url:'<?=site_url();?>/docente/tprocesos',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                    var html='<table class="table table-bordered table-hover">';
                        html+='<thead><tr style="background-color: #229678;">';
                        html+='<th class="text-white text-center" width="10%">Código</th>';
                        html+='<th class="text-white text-center" width="70%">Proceso</th>';
                        html+='<th class="text-white text-center" width="10%">Eliminar</th>';
                        html+='<th class="text-white text-center" width="10%">Editar</th>';            
                        html+="</tr></thead>";
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                                    html+='<tr>';
                                    html+='<td align="center">'+registros[i]["codpro"]+'</td>';
                                    html+='<td>'+registros[i]["nomproceso"]+'</td>';  
                                    html+='<td class="text-center"><a href="javascript:borrarProceso(this);" onclick="borrarProceso(this)">';
                                    html+='<img src="<?=base_url();?>img/delete.png" width="20" height="20"/></a></td>';
                                    html+='<td class="text-center"><a href="javascript:editarProceso(this);" onclick="editarProceso(this)">';
                                    html+='<img src="<?=base_url();?>img/editar.png" width="20" height="20"/></a></td>';
                                    html+='</tr>';
                          }     
                   }                
                html+='</table>'; 
                $("#con_cuerpo").html(html);
            },
            error:function(respuesta){alert("No hay Procesos Registrados!");
            }                    
    });    
    titulo='<h4 class="modal-title">Consulta de Procesos Existentes</h4> ';
    pie='<button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button>';      
    $("#con_titulo").html(titulo);
    $("#con_pie").html(pie);
}
function con_usuarios(){
    $.ajax({
            url:'<?=site_url();?>/docente/co_docentes/all',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                console.log(registros);
                    var html='<table class="table table-bordered table-hover">';
                        html+='<thead><tr style="background-color: #229678">';
                        html+='<th class="text-white text-center" width="20%">Código</th>';
                        html+='<th class="text-white text-center" width="60%">Nombre Completo</th>';
                        html+='<th class="text-white text-center" width="60%">E-mail</th>';
                        html+='<th class="text-white text-center" width="60%">Rol</th>';
                        html+='<th class="text-white text-center" width="10%">Eliminar</th>';
                        html+='<th class="text-white text-center" width="10%">Editar</th>';            
                        html+="</tr></thead>";
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                                    html+='<tr>';
                                    html+='<td align="center">'+registros[i]["id"]+'</td>';
                                    html+='<td>'+registros[i]["nombres"]+' '+registros[i]["apellidos"]+'</td>';  
                                    html+='<td>'+registros[i]["usuario"]+'</td>';  
                                    html+='<td>'+registros[i]["rol"]+'</td>'; 
                                    html+='<td class="text-center"><a href="javascript:borrarUsr(this);" onclick="borrarUsr(this)">';
                                    html+='<img src="<?=base_url();?>img/delete.png" width="20" height="20"/></a></td>';
                                    html+='<td class="text-center"><a href="javascript:editarUsr(this);" onclick="editarUsr(this)">';
                                    html+='<img src="<?=base_url();?>img/editar.png" width="20" height="20"/></a></td>';
                                    html+='</tr>';
                          }     
                   }                
                html+='</table>'; 
                $("#con_cuerpo").html(html);
            },
            error:function(respuesta){alert("No hay Usuarios Registrados!");
            }                    
    });    
    titulo='<h4 class="modal-title">Consulta de Usuarios Existentes</h4> ';
    pie='<button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button>';      
    $("#con_titulo").html(titulo);
    $("#con_pie").html(pie);
}
function consu_menuad(){
    $.ajax({
            url:'<?=site_url();?>/consultas/co_menuad',
            type:'POST',
            cache:false,
            async:false,
            dataType:'json',
            success:function(respuesta){
                var registros = eval(respuesta);
                    var html='<table class="table table-bordered table-hover">';
                        html+='<thead><tr style="background-color: #229678">';
                        html+='<th class="text-white text-center" width="5%">Código</th>';
                        html+='<th class="text-white text-center" width="5%">Orden</th>';
                        html+='<th class="text-white text-center" width="10%">Nombre</th>';
                        html+='<th class="text-white text-center" width="10%">Tipo</th>';
                        html+='<th class="text-white text-center" width="30%">Enlace</th>';  
                        html+='<th class="text-white text-center" width="5%">Eliminar</th>';
                        html+='<th class="text-white text-center" width="5%">Editar</th>';            
                        html+="</tr></thead>";
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) { 
                                    html+='<tr>';
                                    html+='<td align="center">'+registros[i]["id"]+'</td>';
                                    html+='<td align="center">'+registros[i]["orden"]+'</td>';                                    
                                    html+='<td>'+registros[i]["nombre"]+'</td>';  
                                    html+='<td>'+registros[i]["tipo"]+'</td>';  
                                    html+='<td>'+registros[i]["enlace"]+'</td>';  
                                    html+='<td class="text-center"><a href="javascript:borrarMenu(this);" onclick="borrarMenu(this)">';
                                    html+='<img src="<?=base_url();?>img/delete.png" width="20" height="20"/></a></td>';
                                    html+='<td class="text-center"><a href="javascript:editarMenu(this);" onclick="editarMenu(this)">';
                                    html+='<img src="<?=base_url();?>img/editar.png" width="20" height="20"/></a></td>';
                                    html+='</tr>';
                          }     
                   }                
                html+='</table>'; 
                $("#con_titulo").html('Consulta Aplicaciones Adicionales');
                $("#con_cuerpo").html(html);
            },
            error:function(respuesta){alert("Error: 128 " + respuesta);
            }                    
    });    
    titulo='<h4 class="modal-title">Consulta de Asignaturas Existentes</h4> ';
    pie='<button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Terminar</button>';      
    $("#con_titulo").html(titulo);
    $("#con_pie").html(pie);
}

    function borrarArea(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;
        $.ajax({
                url:"<?=site_url();?>/config/bo_area",
                type:"POST",
                data:{id:campo},
                success:function(respuesta){
                          alert(respuesta);
                          consultas('areas')},
                error:function(respuesta){alert(respuesta);}
               
        });
    }
    function borrarMateria(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;
        $.ajax({
                url:"<?=site_url();?>/config/bo_materia",
                type:"POST",
                data:{id:campo},
                success:function(){consultas('materias');
                }
        });
    }   
    function borrarMenu(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;
        $.ajax({
                url:"<?=site_url();?>/config/bo_menuad",
                type:"POST",
                data:{id:campo},
                success:function(){consultas('menuad');}
        });
    }      
    function borrarProyecto(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;

        $.ajax({
                url:"<?=site_url();?>/config/bo_proyecto",
                type:"POST",
                data:{id:campo},
                success:function(){
                        consultas('proyectos');
                }
        });
    }     
    function borrarProceso(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;

        $.ajax({
                url:"<?=site_url();?>/config/bo_proceso",
                type:"POST",
                data:{id:campo},
                success:function(){
                        consultas('procesos');
                }
        });
    }     
    function borrarUsr(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;

        $.ajax({
                url:"<?=site_url();?>/config/bo_usr",
                type:"POST",
                data:{id:campo},
                success:function(){
                        consultas('usuarios');
                }
        });
    }     
    function editarArea(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;

         $.ajax({
            url:"<?=site_url();?>/docente/cop_areas",
            type:"POST",
            data:{buscar:campo},
            success:function(respuesta){
               var registros = eval(respuesta); 
                 for (i=0; i<registros.length; i++) { 
                    html="<form id='frmeditar' name='frmeditar' enctype='multipart/form-data'>" +          
                            "<label for='codigo'>No. Código</label>" +                 
                            "<div class='input-group'>" +   
                            "<input class='form-control' type='text' id='ucodarea' name='ucodarea' value='" + registros[i]["codarea"]+"'  placeholder='Código de Area' maxlength='5' readonly>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='desc'>Descripción</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unomarea' name='unomarea' value='" + registros[i]["nomarea"]+"' placeholder='Nombre de Area' maxlength='50'/>" + 
                            "<input class='form-control' type='hidden' id='unomareant' name='unomareant' value='" + registros[i]["nomarea"]+"' />" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='uicoarea'>Cambiar Imagen</label>" +                                 
                            "<input id='uicoarea' name='uicoarea' size='50' type='file'/>" +                            
                            "<div class='modal-footer'>" + 
                            "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>" + 
                            "<button type='button' class='btn btn-primary' onclick='updateArea()'>Guardar</button>" + 
                            "</div></form>";  
                    var titulo='<h4 class="modal-title">Actualización de Areas</h4> ';
                    $("#edi_titulo").html(titulo);   
                    $("#edi_cuerpo").html(html);
                    $("#modal_consultas").modal('hide');
                    $("#modal_editar").modal('show');
                   }
                }   
           }); 
    }
function editarMateria(nodo){
var nodoTd = nodo.parentNode; //Nodo TD
var nodoTr = nodoTd.parentNode; //Nodo TR
var nodosEnTr = nodoTr.getElementsByTagName('td');
var campo = nodosEnTr[0].textContent;
 $.ajax({
    url:"<?=site_url();?>/docente/con_materia/" + campo,
    type:"POST",
    success:function(respuesta){
       var registros = eval(respuesta); 
         for (i=0; i<registros.length; i++) { 
            html="<form id='frmeditar' name='frmeditar' enctype='multipart/form-data'>" +          
                    "<label for='codigo'>No. Código</label>" +                 
                    "<div class='input-group'>" +   
                    "<input class='form-control' type='text' id='ucodmat' name='ucodmat' value='" + registros[i]["codmateria"]+"'  placeholder='Código de Area' maxlength='5' readonly>" + 
                    "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                    "<label for='desc'>Descripción</label>" +      
                    "<div class='input-group'>" +                
                    "<input class='form-control' type='text' id='unommat' name='unommat' value='" + registros[i]["nommateria"]+"' placeholder='Nombre de Area' maxlength='50'/>" + 
                    "<input class='form-control' type='hidden' id='unomarea' name='unomarea' value='" + registros[i]["nomarea"]+"'/>" +                      
                    "<input class='form-control' type='hidden' id='unommatant' name='unommatant' value='" + registros[i]["nommateria"]+"'/>" +                     
                    "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                    "<label for='desc'>Grado</label>" + 
                    "<div class='input-group'>" +                
                    "<input class='form-control' type='text' id='ugramat' name='ugramat' value='" + registros[i]["grado"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                    "<input class='form-control' type='hidden' id='ugramatant' name='ugramatant' value='" + registros[i]["grado"]+"' placeholder='Nombre de Area' maxlength='50'>" +                     
                    "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +                             
                    "<label for='uicomat'>Cambiar Imagen</label>" +                                 
                    "<input id='uicomat' name='uicomat' size='50' value='" + registros[i]["icomat"]+"' type='file'/>" +                            
                    "<div class='modal-footer'>" + 
                    "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>" + 
                    "<button type='button' class='btn btn-primary' onclick='updateMateria()'>Guardar</button>" + 
                    "</div></form>";  
            titulo='<h4 class="modal-title">Actualización de Asignaturas</h4> ';
            $("#edi_titulo").html(titulo);   
            $("#edi_cuerpo").html(html);
            $("#modal_consultas").modal('hide');
            $("#modal_editar").modal('show');
           }
        },
    error:function(){alert("No hay Registros!");}        
   });
}
    function editarProyecto(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;

         $.ajax({
            url:"<?=site_url();?>/docente/con_proyecto/" + campo,
            type:"POST",
            success:function(respuesta){
               var registros = eval(respuesta); 
                 for (i=0; i<registros.length; i++) { 
                    html="<form id='frmeditar' name='frmeditar' enctype='multipart/form-data'>" +          
                            "<label for='codigo'>No. Código</label>" +                 
                            "<div class='input-group'>" +   
                            "<input class='form-control' type='text' id='ucodigo' name='ucodigo' value='" + registros[i]["codpro"]+"'  placeholder='Código de Area' maxlength='5' readonly>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='desc'>Descripción</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unombre' name='unombre' value='" + registros[i]["nomproyecto"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                            "<input class='form-control' type='hidden' id='unombreant' name='unombreant' value='" + registros[i]["nomproyecto"]+"'>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='uicoarea'>Cambiar Imagen</label>" +                                 
                            "<input id='uicono' name='uicono' size='50' type='file'/>" +                            
                            "<div class='modal-footer'>" + 
                            "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>" + 
                            "<button type='button' class='btn btn-primary' onclick='updateProyecto()'>Guardar</button>" + 
                            "</div></form>";  
                    titulo='<h4 class="modal-title">Actualización de Proyectos</h4> ';
                    $("#edi_titulo").html(titulo);   
                    $("#edi_cuerpo").html(html);
                    $("#modal_consultas").modal('hide');
                    $("#modal_editar").modal('show');
                   }
                }   
           }); 
    }
    function editarProceso(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;

         $.ajax({
            url:"<?=site_url();?>/docente/con_proceso/" + campo,
            type:"POST",
            success:function(respuesta){
               var registros = eval(respuesta); 
                 for (i=0; i<registros.length; i++) { 
                    html="<form id='frmeditar' name='frmeditar' enctype='multipart/form-data'>" +          
                            "<label for='codigo'>No. Código</label>" +                 
                            "<div class='input-group'>" +   
                            "<input class='form-control' type='text' id='ucodigo' name='ucodigo' value='" + registros[i]["codpro"]+"'  placeholder='Código de Area' maxlength='5' readonly>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='desc'>Descripción</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unombre' name='unombre' value='" + registros[i]["nomproceso"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                            "<input class='form-control' type='hidden' id='unombreant' name='unombreant' value='" + registros[i]["nomproceso"]+"'>" +                             
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='uicoarea'>Cambiar Imagen</label>" +                                 
                            "<input id='uicono' name='uicono' size='50' type='file'/>" +                            
                            "<div class='modal-footer'>" + 
                            "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>" + 
                            "<button type='button' class='btn btn-primary' onclick='updateProceso()'>Guardar</button>" + 
                            "</div></form>";  
                    titulo='<h4 class="modal-title">Actualización de Proyectos</h4> ';
                    $("#edi_titulo").html(titulo);   
                    $("#edi_cuerpo").html(html);
                    $("#modal_consultas").modal('hide');
                    $("#modal_editar").modal('show');
                   }
                }   
           }); 
    }    
    function editarUsr(nodo){
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodosEnTr = nodoTr.getElementsByTagName('td');
        var campo = nodosEnTr[0].textContent;
         $.ajax({
            url:"<?=site_url();?>/docente/con_usuario/" + campo,
            type:"POST",
            data:{buscar:campo},
            success:function(respuesta){
               var registros = eval(respuesta); 
                 for (i=0; i<registros.length; i++) { 
                    html="<form id='frmeditar' name='frmeditar' enctype='multipart/form-data'>" + 
                            "<label for='codigo'>No. Código</label>" +                 
                            "<div class='input-group'>" +   
                            "<input class='form-control' type='text' id='ucod' name='ucod' value='" + registros[i]["id"]+"'  placeholder='Código de Area' maxlength='5' readonly>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='desc'>Nombres</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unom' name='unom' value='" + registros[i]["nombres"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='desc'>Apellidos</label>" +      
                            "<div class='input-group'>" +                                 
                            "<input class='form-control' type='text' id='uape' name='uape' value='" + registros[i]["apellidos"]+"' placeholder='Nombre de Area' maxlength='50'>" +                                                     
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +    
                            "<label for='desc'>Cargo</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unom' name='ucar' value='" + registros[i]["cargo"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +                             
                            "<label for='desc'>Rol</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unom' name='urol' value='" + registros[i]["rol"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                            "<label for='desc'>No. Celular</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unom' name='ucel' value='" + registros[i]["nocel"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +                             
                            "<label for='desc'>mail/Usuario</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unom' name='uusr' value='" + registros[i]["usuario"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +   
                            "<label for='desc'>Clave</label>" +      
                            "<div class='input-group'>" +                
                            "<input class='form-control' type='text' id='unom' name='upas' value='" + registros[i]["clave"]+"' placeholder='Nombre de Area' maxlength='50'>" + 
                            "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +                                                         
                            "<div class='modal-footer'>" + 
                            "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>" + 
                            "<button type='button' class='btn btn-primary' onclick='updateUsr()'>Guardar</button>" + 
                            "</div></form>";  
                    titulo='<h4 class="modal-title">Actualización de Usuarios</h4> ';
                    $("#edi_titulo").html(titulo);   
                    $("#edi_cuerpo").html(html);
                    $("#modal_consultas").modal('hide');
                    $("#modal_editar").modal('show');
                   }
                }   
           }); 
    }
function editarMenu(nodo){
var nodoTd = nodo.parentNode; //Nodo TD
var nodoTr = nodoTd.parentNode; //Nodo TR
var nodosEnTr = nodoTr.getElementsByTagName('td');
var campo = nodosEnTr[0].textContent;
 $.ajax({
    url:"<?=site_url();?>/consultas/con_menuad/" + campo,
    type:"POST",
    success:function(respuesta){
       var registros = eval(respuesta); 
         for (i=0; i<registros.length; i++) { 
            html="<form id='frmeditar' name='frmeditar' enctype='multipart/form-data'>" +          
                    "<label for='codigo'>Id</label>" +                 
                    "<div class='input-group'>" +   
                    "<input class='form-control' type='text' id='uid' name='uid' value='" + registros[i]["id"]+"'  placeholder='Código de Area' maxlength='5' readonly>" + 
                    "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" + 
                    "<label for='desc'>Orden</label>" +   
                    "<div class='input-group'>" +                
                    "<input class='form-control' type='text' id='uorden' name='uorden' value='" + registros[i]["orden"]+"' placeholder='Orden' maxlength='50'>" + 
                    "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +                      
                    "<label for='desc'>Nombre</label>" +      
                    "<div class='input-group'>" +                
                    "<input class='form-control' type='text' id='unombre' name='unombre' value='" + registros[i]["nombre"]+"' placeholder='Nombre' maxlength='50'>" + 
                    "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +  
                    "<label for='desc'>Tipo</label>" +   
                    "<div class='input-group'>" +                
                            '<select class="form-control" id="utipo" name="utipo">'+
                                '<option value="'+registros[i]["tipo"]+'">'+registros[i]["tipo"]+'</option>'+    
                                '<option value="Carpeta">Carpeta</option>'+ 
                                '<option value="Aplica">Aplicación</option>'+ 
                                '<option value="funcion">Función</option>'+ 
                                '<option value="Web">Abrir Web</option>'+ 
                                '</select>'+
                    "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +                     
                    "<label for='desc'>Parámetro/Enlace</label>" +   
                    "<div class='input-group'>" +                
                    "<input class='form-control' type='text' id='ulink' name='ulink' value='" + registros[i]["enlace"]+"' placeholder='Parámetro' maxlength='50'>" + 
                    "<span class='input-group-addon'><i class='fa fa-check'></i></span></div>" +                                               
                    "<label for='uicomat'>Cambiar Imagen</label>" +                                 
                    "<input id='uicono' name='uicono' size='50' value='" + registros[i]["icono"]+"' type='file'/>" +                            
                    "<div class='modal-footer'>" + 
                    "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>" + 
                    "<button type='button' class='btn btn-primary' onclick='updateMenu()'>Guardar</button>" + 
                    "</div></form>";  
            titulo='<h4 class="modal-title">Actualización de Aplicaciones Adicionales</h4> ';
            $("#edi_titulo").html(titulo);   
            $("#edi_cuerpo").html(html);
            $("#modal_consultas").modal('hide');
            $("#modal_editar").modal('show');
           }
        },
    error:function(){alert("No hay Registros!");}        
   });

}    

     function updateArea(){
        if(document.getElementById("ucodarea").value !== '' &&
           document.getElementById("unomarea").value !== ''){
           $("#modal_editar").modal("hide");
           var formData = new FormData($("#frmeditar")[0]);
           //ruta =  document.getElementById("ruta").value;
           ruta = "./principal/areas/";
           anterior =  ruta+document.getElementById("unomareant").value;
           nuevo    =  ruta+document.getElementById("unomarea").value;
            $.ajax({
                    url:'<?=site_url();?>/config/up_area',
                    type:'POST',
                    data:formData,
                    cache:false,
                    async:false,
                    contentType:false,
                    processData:false,  
                    success:function(){
                            url='./index.php/docente/renombrar';
                                    $.ajax({
                                       url:url,
                                       type:'POST',
                                       data:{nombre:anterior,nuevo:nuevo},
                                       error:function(){alert("Ocurrió un Error!");}        
                               });
                            $("#modal_editar").modal('hide');
                            consultas('areas');
                    }
            });
        }
    }
     function updateMateria(){
        if(document.getElementById("ucodmat").value !== '' &&
           document.getElementById("unommat").value !== ''){
           $("#modal_editar").modal("hide");
           var formData = new FormData($("#frmeditar")[0]);           
           area     =  document.getElementById("unomarea").value;
           ruta     = "./principal/areas/" + area+"/";
           grado    =  document.getElementById("ugramat").value; 
           gradoant =  document.getElementById("ugramatant").value; 
           anterior =  ruta+document.getElementById("unommatant").value+gradoant;
           nuevo    =  ruta+document.getElementById("unommat").value+grado;                    
            $.ajax({
                    url:'<?=site_url();?>/config/up_materia',
                    type:'POST',
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,  
                    success:function(){
                            url='./index.php/docente/renombrar';
                                    $.ajax({
                                       url:url,
                                       type:'POST',
                                       data:{nombre:anterior,nuevo:nuevo},
                                       error:function(){alert("Ocurrió un Error!");}        
                               });                      
                            $("#modal_editar").modal('hide');
                            consultas('materias');
                    }
            });
        }
    }    
     function updateProyecto(){
        if(document.getElementById("ucodigo").value !== '' &&
           document.getElementById("unombre").value !== ''){
           $("#modal_editar").modal("hide");
           var formData = new FormData($("#frmeditar")[0]);
           ruta = "./principal/proyectos/";
           anterior =  ruta+document.getElementById("unombreant").value;
           nuevo    =  ruta+document.getElementById("unombre").value;           
            $.ajax({
                    url:'<?=site_url();?>/config/up_proyecto',
                    type:'POST',
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,  
                    success:function(){
                            url='./index.php/docente/renombrar';
                                    $.ajax({
                                       url:url,
                                       type:'POST',
                                       data:{nombre:anterior,nuevo:nuevo},
                                       error:function(){alert("Ocurrió un Error!");}        
                               }); 
                            $("#modal_editar").modal('hide');
                            consultas('proyectos');
                    }
            });
        }
    }  
     function updateProceso(){
        if(document.getElementById("ucodigo").value !== '' &&
           document.getElementById("unombre").value !== ''){
           $("#modal_editar").modal("hide");
           var formData = new FormData($("#frmeditar")[0]);
           ruta = "./principal/procesos/";
           anterior =  ruta+document.getElementById("unombreant").value;
           nuevo    =  ruta+document.getElementById("unombre").value;             
            $.ajax({
                    url:'<?=site_url();?>/config/up_proceso',
                    type:'POST',
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,  
                    success:function(){
                            url='./index.php/docente/renombrar';
                                    $.ajax({
                                       url:url,
                                       type:'POST',
                                       data:{nombre:anterior,nuevo:nuevo},
                                       error:function(){alert("Ocurrió un Error!");}        
                               });                       
                            $("#modal_editar").modal('hide'); 
                            consultas('procesos');
                    }
            });
        }
    }     
     function updateUsr(){
        if(document.getElementById("ucod").value !== '' &&
           document.getElementById("unom").value !== ''){
           $("#modal_editar").modal("hide");
           var formData = new FormData($("#frmeditar")[0]);
            $.ajax({
                    url:'<?=site_url();?>/config/up_usuario',
                    type:'POST',
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,  
                    success:function(){alert("Usuario Actualizado!");
                            $("#modal_editar").modal('hide');
                            consultas('usuarios');
                    }
            });
        }
    }  
     function updateMenu(){
        if(document.getElementById("uid").value !== '' &&
           document.getElementById("uorden").value !== ''){
           $("#modal_editar").modal("hide");
           var formData = new FormData($("#frmeditar")[0]);
            $.ajax({
                    url:'<?=site_url();?>/config/up_menu',
                    type:'POST',
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,  
                    success:function(){alert("Menú Actualizado!");
                            $("#modal_editar").modal('hide');
                            consultas('menuad');
                    }
            });
        }
    }        
function descargar(){
    var carpeta=document.getElementById("ubica").value;
    var ruta=document.getElementById("dir").value;
    //$("#moddescarga").modal("show");
        $.ajax({
                url:'<?=site_url();?>/docente/descarga_acti',
                type:'POST',
                data:{carpeta:carpeta,ruta:ruta},
                success:function(respuesta){
                        //$("#modal_editar").modal('hide');
                        //consultas('areas');
                        alert(respuesta);
                }
        });    
}
function intext(div,op){
    $.ajax({
          type: "POST",
          url: op,
          success: function(a) {
              $(div).html('');
              $(div).html(a);
          }
     });   
}     
function nobackbutton(){
  window.location.hash="no-back-button";
  window.location.hash="Again-No-back-button" //chrome
  window.onhashchange=function(){window.location.hash="no-back-button";}
}
function bajar_carpeta_js(carpeta){
  window.location='';
}
function export_DB(){
  $.ajax({
          url:'<?=site_url();?>/upload/backup_bd',
          type:'POST',
          success:function(respuesta){alert('Backup generado con Exito!');},
          error:function(respuesta){alert('Se presentó un error!');}
  });    
}
function bk_dir(){
  $.ajax({
          url:'<?=site_url();?>/upload/backup_dir',
          type:'POST',
          success:function(respuesta){alert('Backup generado con Exito!');},
          error:function(respuesta){alert('Se presentó un error!');}
  });    
}
function reportes(){ $('#modreportes').modal('show'); }

function reporte_asistencia(){
var ifecha=document.getElementById("ifecha").value;
html='<div class="row">';
html+='<div class="col-sm-12">';
html+='<h4 class="pull-left page-title">Reporte de Ingresos a IntegraTic</h4>';
html+='</div>';
html+='</div>';
html+='<div class="row">';
html+='<div class="col-md-12">';
html+='<div class="panel panel-default">';
html+='<div class="panel-body">';
html+='<div class="clearfix">';
html+='<div class="pull-left">';
html+='<h4 class="text-right"><img src="./img/<?= (configuracion()) ? configuracion()["logo_institucion"] : "" ?>" alt="<?= (configuracion()) ? configuracion()["nombre_institucion"] : "Logo" ?>" width="100" height="100"></h4>';                        
html+='</div>';
html+='<div class="pull-right">';
html+='<h4>INSTITUCION EDUCATIVA GENERAL SANTANDER<br>';
html+='<strong>Calarcá Quindío</strong>';
html+='</h4>';
html+='</div>';
html+='</div>';
html+='<hr>';
html+='<div class="row">';
html+='<div class="col-md-12">';
html+='<div class="table-responsive">';
html+='<table class="table m-t-30">';
html+='<thead>';
html+='<tr><th></th>';
html+='<th>Grado</th>';
html+='<th>Documento</th>';
html+='<th>Nombre Estudiante</th>';
html+='<th>Hora</th>';
html+='</tr></thead>';
html+='<tbody>';
         $.ajax({
            url:"<?=site_url();?>/consultas/ingresos",
            type:"POST",
            data:{fecha:ifecha},
            async:false,
            success:function(respuesta){
               var registros = eval(respuesta); 
                 for (i=0; i<registros.length; i++) { 
                      html+='<tr>';
                      html+='<td></td>';
                      html+='<td>'+registros[i]["grado"]+'</td>';
                      html+='<td>'+registros[i]["documento"]+'</td>';
                      html+='<td>'+registros[i]["nombre"]+'</td>';
                      html+='<td>'+registros[i]["hora"]+'</td>';
                      html+='</tr>';                           
                   }
                }   
           }); 
html+='</tbody>';
html+='</table>';
html+='</div>';
html+='</div>';
html+='</div>';
html+='<div class="row" style="border-radius: 0px;">';
html+='<div class="col-md-3 col-md-offset-9">';
html+='<hr>';
html+='<h4 class="text-right">No. Ingresos Estudiantes : '+i+' </h4>';
html+='</div>';
html+='</div>';
html+='<hr>';
html+='<div class="hidden-print">';
html+='<div class="pull-right">';
html+='<a href="javascript:imp_ingresos()" class="btn btn-inverse waves-effect waves-light">';
html+='<i class="fa fa-print"></i></a>';
html+='</div>';
html+='</div>';
html+='</div>';
html+='</div>';
html+='</div>';
html+='</div>';
html+='</div>';   
$("#contenedor").html(html);                             
}
function imp_ingresos(){
  var mywindow = window.open('', 'PrintWindow', 'height=400,width=600');
  mywindow.document.write(html);
  mywindow.document.close();
  mywindow.focus(); 
  mywindow.print();
  mywindow.close(); 
}
</script>