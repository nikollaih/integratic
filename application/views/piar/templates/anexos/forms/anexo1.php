
        <form id="form-create-piar" action="" method="post" class="form-anexo-1">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="diagnostico">Diagn&oacute;stico</label>
                        <select name="diagnostico" id="diagnostico" class="form-control" required>
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["diagnostico"]) && $estudiante["diagnostico"] === "Discapacidad" ? "selected" : "" ?> value="Discapacidad">Discapacidad</option>
                            <option <?= isset($estudiante["diagnostico"]) && $estudiante["diagnostico"] === "Trastorno" ? "selected" : "" ?> value="Trastorno">Trastorno</option>
                            <option <?= isset($estudiante["diagnostico"]) && $estudiante["diagnostico"] === "Sin diagn&oacute;stico" ? "selected" : "" ?> value="Sin diagn&oacute;stico">Sin diagn&oacute;stico</option>
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
                        <label for="tipo_doc">Tipo de documento</label>
                        <select required name="tipo_doc" id="tipo_doc" class="form-control">
                            <option value="">- Seleccionar</option>
                            <?php foreach (tipos_documento() as $valor => $texto): ?>
                                <option value="<?= $valor ?>"
                                    <?= (isset($estudiante["tipo_doc"]) && $estudiante["tipo_doc"] === $valor) ? 'selected' : '' ?>>
                                    <?= $texto ?>
                                </option>
                            <?php endforeach; ?>
                             </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="num_identificacion">Número de documento</label>
                        <input class="form-control" type="text" name="num_identificacion" id="num_identificacion" value="<?= $estudiante["num_identificacion"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefono">Tel&eacute;fono</label>
                        <input class="form-control" type="number" name="telefono" id="telefono" value="<?= $estudiante["telefono"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="grupo_etnico">¿Se reconoce o pertenece a un grupo &eacute;tnico?</label>
                        <select required name="grupo_etnico" id="grupo_etnico" class="form-control">
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["grupo_etnico"]) && $estudiante["grupo_etnico"] === "1" ? "selected" : "" ?> value="1">Si</option>
                            <option <?= isset($estudiante["grupo_etnico"])  && $estudiante["grupo_etnico"] === "0" ? "selected" : "" ?> value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="eps">EPS</label>
                        <input class="form-control" type="text" name="eps" id="eps" value="<?= $estudiante["eps"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="diagnostico_medico">¿Tiene diagnostico m&eacute;dico?</label>
                        <select required name="diagnostico_medico" id="diagnostico_medico" class="form-control">
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["diagnostico_medico"]) && $estudiante["diagnostico_medico"] === "1" ? "selected" : "" ?> value="1">Si</option>
                            <option <?= isset($estudiante["diagnostico_medico"])  && $estudiante["diagnostico_medico"] === "0" ? "selected" : "" ?> value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="diagnostico_cual">¿Cúal?</label>
                        <input class="form-control" type="text" name="diagnostico_cual" id="diagnostico_cual" value="<?= $estudiante["diagnostico_cual"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="terapias">¿El niño esta asistiendo a terapias?</label>
                        <select required name="terapias" id="terapias" class="form-control">
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["terapias"]) && $estudiante["terapias"] === "1" ? "selected" : "" ?> value="1">Si</option>
                            <option <?= isset($estudiante["terapias"])  && $estudiante["terapias"] === "0" ? "selected" : "" ?> value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="terapias_cual">¿Cúal?</label>
                        <input class="form-control" type="text" name="terapias_cual" id="terapias_cual" value="<?= $estudiante["terapias_cual"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="medicamentos">¿El niño consume medicamentos?</label>
                        <select required name="medicamentos" id="medicamentos" class="form-control">
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["medicamentos"]) && $estudiante["medicamentos"] === "1" ? "selected" : "" ?> value="1">Si</option>
                            <option <?= isset($estudiante["medicamentos"])  && $estudiante["medicamentos"] === "0" ? "selected" : "" ?> value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="medicamentos_frec_horario">Frecuencia y horario</label>
                        <input class="form-control" type="text" name="medicamentos_frec_horario" id="medicamentos_frec_horario" value="<?= $estudiante["medicamentos_frec_horario"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="productos_apoyo">¿Cuenta con productos de apoyo para favorecer su movilidad, comunicaci&oacute;n e independencia?</label>
                        <input class="form-control" type="text" name="productos_apoyo" id="productos_apoyo" value="<?= $estudiante["productos_apoyo"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="madre_nombre">Nombre de la madre</label>
                        <input class="form-control" type="text" name="madre_nombre" id="madre_nombre" value="<?= $estudiante["madre_nombre"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="madre_ocupacion">Ocupaci&oacute;n de la madre</label>
                        <input class="form-control" type="text" name="madre_ocupacion" id="madre_ocupacion" value="<?= $estudiante["madre_ocupacion"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="padre_nombre">Nombre del padre</label>
                        <input class="form-control" type="text" name="padre_nombre" id="padre_nombre" value="<?= $estudiante["padre_nombre"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="padre_ocupacion">Ocupaci&oacute;n del padre</label>
                        <input class="form-control" type="text" name="padre_ocupacion" id="padre_ocupacion" value="<?= $estudiante["padre_ocupacion"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lugar_nacimiento">Lugar de nacimiento</label>
                        <input class="form-control" type="text" name="lugar_nacimiento" id="lugar_nacimiento" value="<?= $estudiante["lugar_nacimiento"] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lugar_nacimiento">Fecha de nacimiento</label>
                        <input class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $estudiante["fecha_nacimiento"] ?? '' ?>">
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="direccion">Direcci&oacute;n</label>
                        <input class="form-control" type="text" name="direccion" id="direccion" value="<?= $estudiante["direccion"] ?? '' ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="es_centro_proteccion">¿Est&aacute; en centro de protecci&oacute;n?</label>
                        <select required name="es_centro_proteccion" id="es_centro_proteccion" class="form-control" data-target="centro-proteccion" data-target-value="1">
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["es_centro_proteccion"]) && $estudiante["es_centro_proteccion"] === "1" ? "selected" : "" ?> value="1">Si</option>
                            <option <?= isset($estudiante["es_centro_proteccion"])  && $estudiante["es_centro_proteccion"] === "0" ? "selected" : "" ?> value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="centro_proteccion">¿D&oacute;nde? (Centro de protecci&oacute;n)</label>
                        <input class="form-control" type="text" name="centro_proteccion" id="centro_proteccion" value="<?= $estudiante["centro_proteccion"] ?? "" ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="es_victima_conflicto_armado">¿Se reconoce como v&iacute;ctima del conflicto armado? </label>
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
                        <label for="afiliacion_sistema_salud">¿Cuenta con afiliaci&oacute;n al sistema de salud? </label>
                        <select required name="afiliacion_sistema_salud" id="afiliacion_sistema_salud" class="form-control " data-target="tipo-afiliacion-sistema-salud" data-target-value="1">>
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["afiliacion_sistema_salud"]) && $estudiante["afiliacion_sistema_salud"] === "1" ? "selected" : "" ?> value="1">Si</option>
                            <option <?= isset($estudiante["afiliacion_sistema_salud"]) && $estudiante["afiliacion_sistema_salud"] === "0" ? "selected" : "" ?> value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tipo_afiliacion_sistema_salud">Tipo de afiliaci&oacute;n</label>
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
                        <label for="es_atendido_sector_salud">¿El niño est&aacute; siendo atendido por el sector salud?
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
                        <label for="recibe_tratamiento_enfermedad_particular">¿Actualmente recibe tratamiento m&eacute;dico por alguna enfermedad en particular?

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
                        <label for="telefono_cuidador">Tel&eacute;fono del cuidador</label>
                        <input class="form-control" type="number" name="telefono_cuidador" id="telefono_cuidador" value="<?= $estudiante["telefono_cuidador"] ?? "" ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="correo_electronico_cuidador">Correo electr&oacute;nico del cuidador</label>
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
                        <label for="quienes_apoyan_crianza">¿Qui&eacute;nes apoyan la crianza del estudiante? </label>
                        <input class="form-control" type="text" name="quienes_apoyan_crianza" id="quienes_apoyan_crianza" value="<?= $estudiante["quienes_apoyan_crianza"] ?? "" ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="esta_bajo_proteccion">¿Est&aacute; bajo protecci&oacute;n?</label>
                        <select required name="esta_bajo_proteccion" id="esta_bajo_proteccion" class="form-control">
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["esta_bajo_proteccion"]) && $estudiante["esta_bajo_proteccion"] === "1" ? "selected" : "" ?> value="1">Si</option>
                            <option <?= isset($estudiante["esta_bajo_proteccion"]) && $estudiante["esta_bajo_proteccion"] === "0" ? "selected" : "" ?> value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="recibe_subsidio_entidad">La familia recibe algún subsidio de alguna entidad o instituci&oacute;n</label>
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
                        <label for="es_vinculado_otra_institucion">¿Ha estado vinculado en otra instituci&oacute;n
                            educativa, fundaci&oacute;n o modalidad de educaci&oacute;n
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
                        <label for="es_vinculado_otra_institucion_cual">(Si - ¿Cúal?) (No - ¿Por qu&eacute;?)</label>
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
                        <label for="ultimo_grado_cursado_aprobo">¿Aprob&oacute;?</label>
                        <select required name="ultimo_grado_cursado_aprobo" id="ultimo_grado_cursado_aprobo" class="form-control">
                            <option value="">- Seleccionar</option>
                            <option <?= isset($estudiante["ultimo_grado_cursado_aprobo"]) && $estudiante["ultimo_grado_cursado_aprobo"] === "1" ? "selected" : "" ?> value="1">Si</option>
                            <option <?= isset($estudiante["ultimo_grado_cursado_aprobo"]) && $estudiante["ultimo_grado_cursado_aprobo"] === "0" ? "selected" : "" ?> value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ultimo_grado_cursado_observaciones">Observaci&oacute;nes</label>
                        <input required class="form-control" type="text" name="ultimo_grado_cursado_observaciones" id="ultimo_grado_cursado_observaciones" value="<?= $estudiante["ultimo_grado_cursado_observaciones"] ?? "" ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="recibe_informe_pedagogico">¿Se recibe informe pedag&oacute;gico cualitativo que
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
                        <label for="recibe_informe_pedagogico_institucion">¿De qu&eacute; instituci&oacute;n o modalidad proviene el informe?</label>
                        <input class="form-control" type="text" name="recibe_informe_pedagogico_institucion" id="recibe_informe_pedagogico_institucion" value="<?= $estudiante["recibe_informe_pedagogico_institucion"] ?? "" ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="asiste_programas_complementarios">¿Est&aacute; asistiendo en la actualidad a programas complementarios?</label>
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
                        <label for="medio_de_transporte">Medio que usar&aacute; el estudiante para transportarse
                            a la instituci&oacute;n educativa
                        </label>
                        <input class="form-control" type="text" name="medio_de_transporte" id="medio_de_transporte" value="<?= $estudiante["medio_de_transporte"] ?? "" ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="distancia_institucion_hogar">Distancia entre la instituci&oacute;n educativa o sede y el hogar
                            del estudiante (Tiempo)</label>
                        <input class="form-control" type="text" name="distancia_institucion_hogar" id="distancia_institucion_hogar" value="<?= $estudiante["distancia_institucion_hogar"] ?? "" ?>">
                    </div>
                </div>
            </div>

        <?php
        if(strtolower(logged_user()["rol"]) == "docente de apoyo" || strtolower(logged_user()["rol"]) == "coordinador"){
            ?>
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

        <?php } ?>

        <div class="row text-end" style="text-align:right;">
            <div class="col-md-12 text-end">
                <hr>
                <button type="submit" class="btn btn-primary">Guardar anexo 1</button>
            </div>
        </div>
    </form>

