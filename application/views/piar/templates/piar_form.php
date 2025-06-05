<form id="form-create-piar" action="" method="post">
    <div class="panel panel-primary">
        <div class="panel-heading text-capitalize"><b><?= isset($estudiante["id_piar"]) ? "Modificar" : "Nuevo" ?> Plan Individual de Ajustes Razonables (P.I.A.R.)</b></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <span><b>Documento: </b> <?= $estudiante["documento"] ?></span><br>
                    <span><b>Estudiante: </b> <?= $estudiante["nombre"] ?></span><br>
                    <span><b>Grado: </b> <?= $estudiante["grado"] ?></span><br>
                    <span><b>E-mail: </b> <?= $estudiante["email"] ?></span><br>
                    <span><b>E-mail acudiente: </b> <?= $estudiante["email_acudiente"] ?></span>
                </div>
            </div>
            <?php
            if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador" || $direccion_grupo){
                if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador"){
                ?>
                <div class="row">
                    <div class="col-md-12"><hr></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="diagnostico">Diagnóstico</label>
                            <select name="diagnostico" id="diagnostico" class="form-control" required>
                                <option value="">- Seleccionar</option>
                                <option <?= $estudiante["diagnostico"] === "Discapacidad" ? "selected" : "" ?> value="Discapacidad">Discapacidad</option>
                                <option <?= $estudiante["diagnostico"] === "Trastorno" ? "selected" : "" ?> value="Trastorno">Trastorno</option>
                                <option <?= $estudiante["diagnostico"] === "Sin diagnóstico" ? "selected" : "" ?> value="Sin diagnóstico">Sin diagnóstico</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_docente_apoyo">Docente de apoyo</label>
                            <select name="id_docente_apoyo" id="id_docente_apoyo" class="form-control">
                                <option value="">- Seleccionar</option>
                                <?php
                                if($apoyos){
                                    foreach($apoyos as $doc){
                                        $selected = $doc["id"] === $estudiante["id_docente_apoyo"] ? "selected" :  "";
                                        echo '<option '.$selected.' value="'.$doc["id"].'">'.$doc["nombres"].' '.$doc["apellidos"].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lugar_nacimiento">Lugar de nacimiento</label>
                            <input class="form-control" type="text" name="lugar_nacimiento" id="lugar_nacimiento" value="<?= isset($estudiante["lugar_nacimiento"]) ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="departamento">Departamento residencia</label>
                            <input class="form-control" type="text" name="departamento" id="departamento" value="<?= $estudiante["departamento"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="municipio">Municipio residencia</label>
                            <input class="form-control" type="text" name="municipio" id="municipio" value="<?= $estudiante["municipio"] ?? "" ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="es_centro_proteccion">¿Está en centro de protección?</label>
                            <select required name="es_centro_proteccion" id="es_centro_proteccion" class="form-control" data-target="centro-proteccion" data-target-value="1">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["es_centro_proteccion"]) && $estudiante["es_centro_proteccion"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["es_centro_proteccion"])  && $estudiante["es_centro_proteccion"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="centro_proteccion">¿Dónde? (Centro de protección)</label>
                            <input class="form-control" type="text" name="centro_proteccion" id="centro_proteccion" value="<?= $estudiante["centro_proteccion"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="es_victima_conflicto_armado">¿Se reconoce como víctima del conflicto armado? </label>
                            <select required name="es_victima_conflicto_armado" id="es_victima_conflicto_armado" class="form-control ">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["es_victima_conflicto_armado"]) && $estudiante["es_victima_conflicto_armado"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["es_victima_conflicto_armado"]) && $estudiante["es_victima_conflicto_armado"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="registro_victima_conflicto_armado">¿Cuenta con el respectivo registro? </label>
                            <select required name="registro_victima_conflicto_armado" id="registro_victima_conflicto_armado" class="form-control">
                                <option value="0">- Seleccionar</option>
                                <option <?= isset($estudiante["registro_victima_conflicto_armado"]) && $estudiante["registro_victima_conflicto_armado"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["registro_victima_conflicto_armado"]) && $estudiante["registro_victima_conflicto_armado"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="afiliacion_sistema_salud">¿Cuenta con afiliación al sistema de salud? </label>
                            <select required name="afiliacion_sistema_salud" id="afiliacion_sistema_salud" class="form-control " data-target="tipo-afiliacion-sistema-salud" data-target-value="1">>
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["afiliacion_sistema_salud"]) && $estudiante["afiliacion_sistema_salud"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["afiliacion_sistema_salud"]) && $estudiante["afiliacion_sistema_salud"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipo_afiliacion_sistema_salud">Tipo de afiliación</label>
                            <select required name="tipo_afiliacion_sistema_salud" id="tipo_afiliacion_sistema_salud" class="form-control">
                                <option value="subsidiado">- Seleccionar</option>
                                <option <?= isset($estudiante["tipo_afiliacion_sistema_salud"]) && $estudiante["tipo_afiliacion_sistema_salud"] === "contributivo" ? "selected" : "" ?> value="contributivo">Contributivo</option>
                                <option <?= isset($estudiante["tipo_afiliacion_sistema_salud"]) && $estudiante["tipo_afiliacion_sistema_salud"] === "subsidiado" ? "selected" : "" ?> value="subsidiado">Subsidiado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lugar_atencion_emergencia">Lugar donde lo atienden en caso de emergencia:</label>
                            <input class="form-control" type="text" name="lugar_atencion_emergencia" id="lugar_atencion_emergencia" value="<?= $estudiante["lugar_atencion_emergencia"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="es_atendido_sector_salud">¿El niño está siendo atendido por el sector salud?
                            </label>
                            <select required name="es_atendido_sector_salud" id="es_atendido_sector_salud" class="form-control " data-target="atendido-frecuencia" data-target-value="1">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["es_atendido_sector_salud"]) && $estudiante["es_atendido_sector_salud"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["es_atendido_sector_salud"]) && $estudiante["es_atendido_sector_salud"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="es_atendido_frecuencia">Frecuencia</label>
                            <input class="form-control" type="text" name="es_atendido_frecuencia" id="es_atendido_frecuencia" value="<?= $estudiante["es_atendido_frecuencia"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recibe_tratamiento_enfermedad_particular">¿Actualmente recibe tratamiento médico por alguna enfermedad en particular?

                            </label>
                            <select required name="recibe_tratamiento_enfermedad_particular" id="recibe_tratamiento_enfermedad_particular" class="form-control " data-target="tratamiento-enfermedad" data-target-value="1">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["recibe_tratamiento_enfermedad_particular"]) && $estudiante["recibe_tratamiento_enfermedad_particular"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["recibe_tratamiento_enfermedad_particular"]) && $estudiante["recibe_tratamiento_enfermedad_particular"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recibe_tratamiento_enfermedad_particular_cual">¿Cúal enfermedad?</label>
                            <input class="form-control" type="text" name="recibe_tratamiento_enfermedad_particular_cual" id="recibe_tratamiento_enfermedad_particular_cual" value="<?= $estudiante["recibe_tratamiento_enfermedad_particular_cual"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nivel_educativo_madre">Nivel educativo de la madre</label>
                            <select required name="nivel_educativo_madre" id="nivel_educativo_madre" class="form-control">
                                <option value="">- Seleccionar</option>
                                <?php
                                foreach (getNivelesEducativos() as $nivel) {
                                    $selected = ($nivel == $estudiante["nivel_educativo_madre"]) ? "selected" : "";
                                    echo "<option value='" . $nivel . "' " . $selected . ">" . $nivel . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nivel_educativo_padre">Nivel educativo del padre</label>
                            <select required name="nivel_educativo_padre" id="nivel_educativo_padre" class="form-control">
                                <option value="">- Seleccionar</option>
                                <?php
                                foreach (getNivelesEducativos() as $nivel) {
                                    $selected = ($nivel == $estudiante["nivel_educativo_padre"]) ? "selected" : "";
                                    echo "<option value='" . $nivel . "' " . $selected . ">" . $nivel . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre_cuidador">Nombre del cuidador</label>
                            <input class="form-control" type="text" name="nombre_cuidador" id="nombre_cuidador" value="<?= $estudiante["nombre_cuidador"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parentesco_cuidador">Parentesco cuidador</label>
                            <select required name="parentesco_cuidador" id="parentesco_cuidador" class="form-control">
                                <option value="">- Seleccionar</option>
                                <?php
                                foreach (getParentescos() as $nivel) {
                                    $selected = ($nivel == $estudiante["parentesco_cuidador"]) ? "selected" : "";
                                    echo "<option value='" . $nivel . "' " . $selected . ">" . $nivel . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nivel_educativo_cuidador">Nivel educativo del cuidador</label>
                            <select required name="nivel_educativo_cuidador" id="nivel_educativo_cuidador" class="form-control">
                                <option value="">- Seleccionar</option>
                                <?php
                                foreach (getNivelesEducativos() as $nivel) {
                                    $selected = ($nivel == $estudiante["nivel_educativo_cuidador"]) ? "selected" : "";
                                    echo "<option value='" . $nivel . "' " . $selected . ">" . $nivel . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono_cuidador">Teléfono del cuidador</label>
                            <input class="form-control" type="number" name="telefono_cuidador" id="telefono_cuidador" value="<?= $estudiante["telefono_cuidador"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="correo_electronico_cuidador">Correo electrónico del cuidador</label>
                            <input class="form-control" type="email" name="correo_electronico_cuidador" id="correo_electronico_cuidador" value="<?= $estudiante["correo_electronico_cuidador"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lugar_que_ocupa_hermanos">Lugar que ocupa entre hermanos</label>
                            <input class="form-control" type="number" name="lugar_que_ocupa_hermanos" id="lugar_que_ocupa_hermanos" value="<?= $estudiante["lugar_que_ocupa_hermanos"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quienes_apoyan_crianza">¿Quiénes apoyan la crianza del estudiante? </label>
                            <input class="form-control" type="text" name="quienes_apoyan_crianza" id="quienes_apoyan_crianza" value="<?= $estudiante["quienes_apoyan_crianza"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="esta_bajo_proteccion">¿Está bajo protección?</label>
                            <select required name="esta_bajo_proteccion" id="esta_bajo_proteccion" class="form-control">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["esta_bajo_proteccion"]) && $estudiante["esta_bajo_proteccion"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["esta_bajo_proteccion"]) && $estudiante["esta_bajo_proteccion"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recibe_subsidio_entidad">La familia recibe algún subsidio de alguna entidad o institución</label>
                            <select required name="recibe_subsidio_entidad" id="recibe_subsidio_entidad" class="form-control " data-target="subsidio-entidad" data-target-value="1">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["recibe_subsidio_entidad"]) && $estudiante["recibe_subsidio_entidad"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["recibe_subsidio_entidad"]) && $estudiante["recibe_subsidio_entidad"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recibe_subsidio_entidad_cual">¿Cúal subsidio?</label>
                            <input class="form-control" type="text" name="recibe_subsidio_entidad_cual" id="recibe_subsidio_entidad_cual" value="<?= $estudiante["recibe_subsidio_entidad_cual"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="es_vinculado_otra_institucion">¿Ha estado vinculado en otra institución
                                educativa, fundación o modalidad de educación
                                inicial?</label>
                            <select required name="es_vinculado_otra_institucion" id="es_vinculado_otra_institucion" class="form-control">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["es_vinculado_otra_institucion"]) && $estudiante["es_vinculado_otra_institucion"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["es_vinculado_otra_institucion"]) && $estudiante["es_vinculado_otra_institucion"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="es_vinculado_otra_institucion_cual">(Si - ¿Cúal?) (No - ¿Por qué?)</label>
                            <input required class="form-control" type="text" name="es_vinculado_otra_institucion_cual" id="es_vinculado_otra_institucion_cual" value="<?= $estudiante["es_vinculado_otra_institucion_cual"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ultimo_grado_cursado">Ultimo grado cursado</label>
                            <select required name="ultimo_grado_cursado" id="ultimo_grado_cursado" class="form-control">
                                <option value="">- Seleccionar</option>
                                <?php
                                foreach (getGrados() as $nivel) {
                                    $selected = ($nivel == $estudiante["ultimo_grado_cursado"]) ? "selected" : "";
                                    echo "<option value='" . $nivel . "' " . $selected . ">" . $nivel . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ultimo_grado_cursado_aprobo">¿Aprobó?</label>
                            <select required name="ultimo_grado_cursado_aprobo" id="ultimo_grado_cursado_aprobo" class="form-control">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["ultimo_grado_cursado_aprobo"]) && $estudiante["ultimo_grado_cursado_aprobo"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["ultimo_grado_cursado_aprobo"]) && $estudiante["ultimo_grado_cursado_aprobo"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ultimo_grado_cursado_observaciones">Observaciónes</label>
                            <input required class="form-control" type="text" name="ultimo_grado_cursado_observaciones" id="ultimo_grado_cursado_observaciones" value="<?= $estudiante["ultimo_grado_cursado_observaciones"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recibe_informe_pedagogico">¿Se recibe informe pedagógico cualitativo que
                                describa el proceso de desarrollo y aprendizaje del
                                estudiante y/o PIAR?</label>
                            <select required name="recibe_informe_pedagogico" id="recibe_informe_pedagogico" class="form-control " data-target="informe-pedagogico" data-target-value="1">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["recibe_informe_pedagogico"]) && $estudiante["recibe_informe_pedagogico"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["recibe_informe_pedagogico"]) && $estudiante["recibe_informe_pedagogico"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recibe_informe_pedagogico_institucion">¿De qué institución o modalidad proviene el informe?</label>
                            <input class="form-control" type="text" name="recibe_informe_pedagogico_institucion" id="recibe_informe_pedagogico_institucion" value="<?= $estudiante["recibe_informe_pedagogico_institucion"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="asiste_programas_complementarios">¿Está asistiendo en la actualidad a programas complementarios?</label>
                            <select required name="asiste_programas_complementarios" id="asiste_programas_complementarios" class="form-control " data-target="programas-complementarios" data-target-value="1">
                                <option value="">- Seleccionar</option>
                                <option <?= isset($estudiante["asiste_programas_complementarios"]) && $estudiante["asiste_programas_complementarios"] === "1" ? "selected" : "" ?> value="1">Si</option>
                                <option <?= isset($estudiante["asiste_programas_complementarios"]) && $estudiante["asiste_programas_complementarios"] === "0" ? "selected" : "" ?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="asiste_programas_complementarios_cuales">¿Cuales programas?</label>
                            <input class="form-control" type="text" name="asiste_programas_complementarios_cuales" id="asiste_programas_complementarios_cuales" value="<?= $estudiante["asiste_programas_complementarios_cuales"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="medio_de_transporte">Medio que usará el estudiante para transportarse
                                a la institución educativa
                            </label>
                            <input class="form-control" type="text" name="medio_de_transporte" id="medio_de_transporte" value="<?= $estudiante["medio_de_transporte"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="distancia_institucion_hogar">Distancia entre la institución educativa o sede y el hogar
                                del estudiante (Tiempo)</label>
                            <input class="form-control" type="text" name="distancia_institucion_hogar" id="distancia_institucion_hogar" value="<?= $estudiante["distancia_institucion_hogar"] ?? "" ?>">
                        </div>
                    </div>
                </div>

            <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="richtext-entorno">Entorno personal</label>
                            <textarea name="entorno_personal" id="richtext-entorno" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

            <?php
            if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador"){
            ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="richtext-descripcion-general">Descripción general del estudiante con énfasis en gustos e intereses o aspectos que le desagradan,
                                expectativas del estudiante y la familia</label>
                            <textarea name="descripcion_general" id="richtext-descripcion-general" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="richtext-descripcion-que-hace">Incluya aquí los compromisos específicos para implementar en el aula que requieran ampliación o detalle
                                adicional al incluido en el PIAR.</label>
                            <textarea name="compromisos_especificos" id="richtext-compromisos-especificos" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="richtext-descripcion-que-hace">Descripción en términos de lo que hace, puede hacer o requiere apoyo el estudiante para favorecer su proceso
                                educativo. Indique las habilidades, competencias, cualidades, aprendizajes con las que cuenta el estudiante
                                para el grado en el que fue matriculado.</label>
                            <textarea name="descripcion_que_hace" id="richtext-descripcion-que-hace" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if(isset($message)){
                            ?>
                            <div class="alert alert-<?= $message["type"] ?> alert-dismissible show" role="alert">
                                <?= $message["message"] ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td style="width: 200px"><strong>ACTORES</strong></td>
                                <td><strong>ACCIONES</strong></td>
                                <td><strong>ESTRATEGIAS A IMPLEMENTAR</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><strong>FAMILIA, CUIDADORES O
                                        CON QUIENES VIVE</strong></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="acciones_familia"><?= $estudiante["acciones_familia"] ?? "" ?></textarea></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_familia"><?= $estudiante["estrategias_familia"] ?? "" ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>DOCENTES</strong></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="acciones_docentes"><?= $estudiante["acciones_docentes"] ?? "" ?></textarea></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_docentes"><?= $estudiante["estrategias_docentes"] ?? "" ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>DIRECTIVOS</strong></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="acciones_directivos"><?= $estudiante["acciones_directivos"] ?? "" ?></textarea></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_directivos"><?= $estudiante["estrategias_directivos"] ?? "" ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>ADMINISTRATIVOS</strong></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="acciones_administrativos"><?= $estudiante["acciones_administrativos"] ?? "" ?></textarea></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_administrativos"><?= $estudiante["estrategias_administrativos"] ?? "" ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>PARES</strong></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="acciones_companeros"><?= $estudiante["acciones_companeros"] ?? "" ?></textarea></td>
                                <td><textarea class="form-control" placeholder="Escribir aqui..." name="estrategias_companeros"><?= $estudiante["estrategias_companeros"] ?? "" ?></textarea></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php } ?>

                <div class="row text-end" style="text-align:right;">
                    <div class="col-md-12 text-end">
                        <hr>
                        <button type="submit" class="btn btn-primary">Guardar formulario</button>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</form>

<style>
    #form-create-piar label {
        height: 34px !important;
        align-content: end;
    }
</style>