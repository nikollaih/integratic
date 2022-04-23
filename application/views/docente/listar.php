<script>  let editorImageRespuesta;</script>
<div class="row">
    <?php
        if($menu_materia == "true"){
            ?>
                <div class="col-md-4">
                    <div class="panel panel-primary">       
                        <div class="panel-heading text-capitalize">
                            <b><div id="">Anuncios</div></b>
                        </div>
                        <div class="panel-body">
                            <?php
                                if(logged_user()["rol"] == "Docente"){
                            ?>
                                <div class="row">
                                    <div class='col-lg-12'>    
                                        <a data-toggle='modal' data-target='#agregar-nuevo-anuncio' href='javascript:crear();' class="add-announcement-container">
                                            <img src='./img/iconos/crear_anuncio.png' height='32' alt='Nueva Carpeta' title='Nueva Carpeta'>
                                            <p>Crear Anuncio</p>
                                        </a>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <?php
                                if($anuncios){
                                    foreach ($anuncios as $anuncio) {
                                        $this->load->view("anuncios/item_anuncio", array("anuncio" => $anuncio));
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
        }
    ?>
    <div class="col-md-<?= ($menu_materia == "true") ? '8' : '12' ?>">
        <div class="panel panel-primary">       
            <div class="panel-heading text-capitalize">
                <b><div id="titulo"><?= $titulo ?></div></b>
            </div>
            <div class="panel-body">       
                <div class='row' id='migas'>
                    <input id='ruta' name='ruta' value=".htmlentities($carpeta)." type='hidden'/>
                    <input id='nombre' name='nombre' type='hidden'/>
                    <?php
                        if(logged_user()["rol"] == "Docente"){
                    ?>
                        <div class="col-md-12">
                            <div class='add-announcement-container'>  
                                  
                                <a href='javascript:crear("<?= $menu_materia ?>");'>
                                    <img src='./img/iconos/nueva_carpeta.png' height='32' alt='Nueva Carpeta' title='Nueva Carpeta'>
                                </a>&nbsp;
                                <a href='javascript:subir("<?= $menu_materia ?>");'> 
                                    <img src='./img/iconos/subir_archivo.png' height='32' alt='Subir Archivo' title='Subir Archivo'>
                                </a>&nbsp;
                                <?php
                                    if($menu_materia == "true"){
                                        ?>
                                        <a href="#"  data-toggle='modal' data-target='#agregar-nuevo-foro'> 
                                            <img src='./img/iconos/crear_foro.png'  height='32' alt='Crear foro' title='Crear foro'>
                                        </a>&nbsp;
                                        <a href="#"  data-toggle='modal' data-target='#agregar-nueva-actividad'> 
                                            <img src='./img/iconos/crear_actividad.png'  height='32' alt='Crear actividad' title='Crear actividad'>
                                        </a>&nbsp;
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            <table style='width:100%;margin-bottom:20px;'>
                <tbody>
                    <?php
                        $i=0;
                        if(is_dir($carpeta)){
                            if($dir = opendir($carpeta)){
                                while(($archivo = readdir($dir)) !== false){
                                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                                        
                                        if (is_dir($carpeta."/".$archivo)){
                                            $ruta=$carpeta."/".$archivo; ?>
                                            <tr>
                                                <td  style="width:50%; height:42px">
                                                    <a href="javascript:submenu_doc('<?= $ruta ?>', '<?= $archivo ?>', '<?= $menu_materia ?>')">
                                                        <img src='./img/iconos/carpeta.png' width='35' height='30'>&nbsp;&nbsp;<?= $archivo ?>                                                      
                                                    </a>
                                                </td>
                                                <td style="text-align: right;"><?= date("d/m/Y h:i a",filectime(($ruta))) ?></td>
                                                <?php 
                                                   if (logged_user()["rol"] == "Docente"){
                                                ?>
                                                    <td style="width:5%; text-align: right;">
                                                        <a href="javascript:elicar('<?= $ruta ?>', '<?= $menu_materia ?>')" style="width:10%">
                                                            <img src='./img/iconos/borrar.png' width='25' height='28' alt='Eliminar Archivo' title='Eliminar Carpeta'>
                                                        </a>
                                                    </td>
                                                    <td style="width:5%;text-align: right;">
                                                        <a href="javascript:renombrar('<?= $carpeta ?>','<?= $archivo ?>')" style="width:10%">
                                                            <img src='./img/iconos/ren.png' width='25' height='28' alt='Renombrar Archivo' title='Renombrar Carpeta'>
                                                        </a>
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                            </tr>
                                        <?php
                                        } 
                                    } 
                                }
                                closedir($dir);
                            }
                            if($dir = opendir($carpeta)){
                                while(($archivo = readdir($dir)) !== false){ 
                                    if(!is_dir($carpeta."/".$archivo) && $archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                                        $ext = explode(".", $archivo);
                                        $ruta=$carpeta."/".$archivo;
                                        ?>
                                        <tr>
                                            <td  style='width:60%; height:42px'>
                                                <a target='_blank' href='<?= $carpeta ?>/<?= $archivo ?>'>                                           
                                                    <?= document_icon($ext[1], $ext[0]) ?>         
                                                </a>
                                            </td>
                                            <td style="text-align: right;"><?= date("d/m/Y h:i a",filectime(($ruta))) ?></td>     
                                            <td style="width:5%;text-align: right;">
                                                <a href="javascript:eliminar('<?= $ruta ?>')" style="width:10%">
                                                    <img src='./img/iconos/borrar.png' width='25' height='28' alt='Subir Archivo' title='Eliminar Archivo'>
                                                </a>
                                            </td>   
                                            <td style="width:5%;text-align: right;">
                                                <a href="javascript:renombrar('<?= $carpeta ?>', '<?= $archivo ?>')" style="width:10%">
                                                    <img src='./img/iconos/ren.png' width='25' height='28' alt='Subir Archivo' title='Renombrar Archivo'>
                                                </a>
                                            </td>
                                        </tr>   
                                        <?php                        
                                    } 
                                }  
                                closedir($dir);
                            }
                        }
                        ?>
                </tbody>
            </table>
            <?php
                if($menu_materia == "true"){
                    $this->load->view("actividades/lista_actividades", $actividades);
                    $this->load->view("foros/template/lista_foros", $foros);
                }
            ?>    
        </div>
        <input id='modulo' name='modulo' value='DO' type='hidden'>
    </div>
</div>