<script>  let editorImageRespuesta;</script>
<div class="row">
    <?php
        if($menu_materia == "true"){
            ?>
                <div class="col-md-4">
                    <div class="panel panel-primary">       
                        <div class="panel-heading">
                            <b><div id="">Anuncios</div></b>
                        </div>
                        <div class="panel-body">
                            <?php
                                if(logged_user()["rol"] == "Docente"){
                            ?>
                                <div class="row">
                                    <div class='col-lg-12'>    
                                        <a class="add-announcement-container btn-agregar-anuncio pointer">
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
            <div class="panel-heading">
                <b><div id="titulo"><?= $titulo ?></div></b>
            </div>
            <div class="panel-body">     
                <div class='row' id='migas'>
                    <input id='ruta' name='ruta' value=".htmlentities($carpeta)." type='hidden'/>
                    <input id='nombre' name='nombre' type='hidden'/>
                    <?php
                        if(logged_user()["rol"] != "Estudiante"){
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
                                        <a href="#" class="button-agregar-nueva-actividad"> 
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
                        $carpeta = string_to_folder_name($carpeta);
                        if(is_dir($carpeta)){
                            if($dir = opendir($carpeta)){
                                $carpeta_length = explode("/", $carpeta);
                                if(((count($carpeta_length) > 6) && $menu_materia) || 
                                    ($menu_materia != "true" && (isset($carpeta_length[2]) && $carpeta_length[2] == "proyectos") && (count($carpeta_length) > 4 && logged_user()["rol"] != "Estudiante")) || 
                                    ($menu_materia != "true" && ((isset($carpeta_length[2]) && $carpeta_length[1] == "documentos") || !isset($carpeta_length[2])) && (count($carpeta_length) > 2 && logged_user()["rol"] != "Estudiante")) || 
                                    ($menu_materia != "true" && ((isset($carpeta_length[2]) && $carpeta_length[2] != "proyectos") || !isset($carpeta_length[2])) && (count($carpeta_length) > 2 && logged_user()["rol"] != "Estudiante" && logged_user()["rol"] != "Administrativo")) || 
                                    ($menu_materia != "true" && ((isset($carpeta_length[2]) && $carpeta_length[2] != "proyectos") || !isset($carpeta_length[2])) && (count($carpeta_length) > 4 && (logged_user()["rol"] == "Administrativo")))
                                    )
                                {
                                    array_pop($carpeta_length);
                                    $title_back = $carpeta_length[count($carpeta_length) - 1];
                                    ?>
                                        <tr>
                                            <td  style="width:50%; height:42px">
                                                <a href="javascript:submenu_doc('<?= implode("/", $carpeta_length) ?>', '<?= $title_back ?>', '<?= $menu_materia ?>')">
                                                    <img src='./img/iconos/volver.png' width='30' height='30'>&nbsp;&nbsp;Atras                                            
                                                </a>
                                            </td>
                                            <td style="text-align: right;"></td>
                                        </tr>
                                    <?php
                                }
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
                                                   if (logged_user()["rol"] != "Estudiante"){
                                                ?>
                                                    <td style="width:5%; text-align: right;">
                                                        <a href="javascript:elicar('<?= $ruta ?>', '<?= $menu_materia ?>')" style="width:10%">
                                                            <img src='./img/iconos/borrar.png' width='25' height='28' alt='Eliminar Archivo' title='Eliminar Carpeta'>
                                                        </a>
                                                    </td>
                                                    <td style="width:5%;text-align: right;">
                                                        <a href="javascript:renombrar('<?= $carpeta ?>','<?= $archivo ?>', '<?= $menu_materia ?>')" style="width:10%">
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
                                    if(($carpeta."/".$archivo) && $archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && !is_dir($carpeta."/".$archivo) && !is_dir($carpeta."/".$archivo)){
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
                                            <?php 
                                                   if (logged_user()["rol"] != "Estudiante"){
                                                ?>    
                                                    <td style="width:5%;text-align: right;">
                                                        <a href="javascript:eliminar('<?= $ruta ?>', '<?= $menu_materia ?>')" style="width:10%">
                                                            <img src='./img/iconos/borrar.png' width='25' height='28' alt='Subir Archivo' title='Eliminar Archivo'>
                                                        </a>
                                                    </td>   
                                                    <td style="width:5%;text-align: right;">
                                                        <a href="javascript:renombrar('<?= $carpeta ?>', '<?= $archivo ?>', '<?= $menu_materia ?>')" style="width:10%">
                                                            <img src='./img/iconos/ren.png' width='25' height='28' alt='Subir Archivo' title='Renombrar Archivo'>
                                                        </a>
                                                    </td>
                                            <?php
                                                }
                                            ?>
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
                    $this->load->view("actividades/lista_actividades_recuperacion", $actividades);
                    $this->load->view("foros/template/lista_foros", $foros);
                }
            ?>    
        </div>
        <input id='modulo' name='modulo' value='DO' type='hidden'>
    </div>
</div>