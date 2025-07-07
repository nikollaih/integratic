<?php $this->load->view("in_head"); ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("plan_aula/templates/in_aside") ?>
    <?php $this->load->view("plan_aula/templates/modal_completar_evidencia") ?>
    <?php $this->load->view("modal/observaciones_coordinador_plan_aula") ?>
    <?php $this->load->view("modal/evidencia_aprendizaje_soportes_agregar") ?>
    <?php $this->load->view("modal/evidencia_aprendizaje_soportes") ?>
    <?php $this->load->view("modal/user_evidencias_aprendizaje_incompletas") ?>
    <?php $this->load->view("modal/plan_aula_tooltip");

    $CARACTERIZACION_ESTUDIANTES_TEXT="Proceso de recopilar y analizar información relevante de los estudiantes como nivel académico, 
    intereses y estilos de aprendizaje, con el fin de adaptar la enseñanza a sus necesidades. 
    Se puede realizar mediante encuestas, observación en el aula, entrevistas, revisión de expedientes académicos y diálogo con padres y docentes. 
    Esto permite una enseñanza más efectiva y personalizada.";

    $ESTADO_ACTUAL_TEXT="El estado actual del grupo describe la situación académica de los estudiantes, basada en los resultados del 
    diagnóstico inicial o en el desempeño de períodos anteriores. Permite identificar las competencias que requieren fortalecimiento y 
    orienta la planificación de acciones específicas para atender las necesidades reales del grupo.";

    $APRENDIZAJE_MEJORAR_TEXT="A partir de la caracterización de los estudiantes y del análisis del proceso de aprendizaje del periodo académico anterior, 
    se identifican ciertos aprendizajes que requieren fortalecimiento. Entre ellos se encuentran aspectos relacionados con la comprensión de contenidos, 
    el desarrollo de habilidades cognitivas, la participación activa en clase y la autonomía en el aprendizaje. 
    Estas áreas de mejora responden a las necesidades y características del grupo, por lo que se propone ajustar las estrategias pedagógicas 
    para favorecer un aprendizaje más significativo y acorde con sus contextos.";

    $OTROS_APRENDIZAJE_MEJORAR_TEXT="Además de lo que los estudiantes ya están aprendiendo, hay ciertas habilidades o conocimientos que aún necesitan mejorar o 
    desarrollar más. Por ejemplo, saber pensar de manera crítica, expresarse bien al hablar o escribir, controlar sus emociones y trabajar bien con otros. 
    Estas son cosas importantes para que puedan aprender mejor y relacionarse bien con los demás.";

    $ENCUADRE_PACTOS_CLASE_TEXT="Acuerdos que se establecen al inicio del ciclo escolar o de un periodo de trabajo entre el docente y los estudiantes. 
    Sirven para definir de manera clara las normas de convivencia, las responsabilidades, las dinámicas de trabajo y las expectativas 
    mutuas dentro del aula.";

    ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <form action="" method="post" id="form-plan-aula">
                    <input type="hidden" name="plan[id_plan_area]" value="<?= (is_array($plan_area)) ? $plan_area["id_plan_area"] : "null" ?>">
                    <div class="row" id="migas">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="flex:1;">
                                    <h3><?= (!$editable) ? "" : (is_array($plan_area) ? "Modificar" : "Nuevo") ?> Plan de aula</h3>
                                    <p>Por favor ingrese todos los campos para poder generar el plan de aula, los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
                                </div>
                                <?php
                                    if(is_array($plan_area)){
                                        echo '<a target="_blank" class="btn btn-primary" href="'.base_url().'PlanAula/ver/'.$plan_area["id_plan_area"].'">Ver PDF</a>';
                                    }
                                ?>
                            </div>
                            <hr>
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

                            if ($this->session->flashdata('message')) {
                                ?>
                                <div class="alert alert-success alert-dismissible show" role="alert">
                                    <?= $this->session->flashdata('message') ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-12">
                            <div class="section-container">
                                <div class="section-header">
                                    <div>
                                        <span class="enumerator">PARTE 1 DE 4</span>
                                        <h4 class="section-title">Datos generales</h4>
                                    </div>
                                    <i data-parte="1" class="fa fa-solid fa-chevron-down open-close-parte"></i>
                                </div>
                                <div style="display:<?= (is_array($plan_area)) ? "none" : "block" ?>;" class="section-content" id="parte-1">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="plan[area]">Área / Asignatura <span class="text-danger">*</span></label>
                                                <select <?= (is_array($plan_area)) ? "disabled" : "" ?> required class="form-control" name="plan[area]" id="plan-area-area">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($areas){
                                                            foreach ($areas as $area) { ?>
                                                                <option <?= (is_array($plan_area) && $plan_area["area"] == $area["codarea"]) ? "selected" : "" ?> value="<?= $area["codarea"] ?>"><?= $area["nomarea"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Grado <span class="text-danger">*</span></label>
                                                <select <?= (is_array($plan_area)) ? "disabled" : "" ?> required class="form-control" name="plan[materia]" id="plan-area-materia">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($materias){
                                                            foreach ($materias as $materia) { ?>
                                                                <option <?= (is_array($plan_area) && $plan_area["materia"] == $materia["codmateria"]) ? "selected" : "" ?> value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"]. " - ".$materia["grado"]."°" ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Periodo <span class="text-danger">*</span></label>
                                                <select <?= (is_array($plan_area)) ? "disabled" : "" ?> required class="form-control" name="plan[periodo]" id="plan-area-periodo">
                                                    <option value="">- Seleccionar</option>
                                                    <?php
                                                        if($periodos){
                                                            foreach ($periodos as $periodo) { ?>
                                                                <option <?= (is_array($plan_area) && $plan_area["periodo"] == $periodo["id_periodo"]) ? "selected" : "" ?> value="<?= $periodo["id_periodo"] ?>"><?= $periodo["periodo"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Fecha inicio <span class="text-danger">*</span></label>
                                                <input readonly <?= (!$editable) ? "disabled" : "" ?> required type="date" name="plan[fecha_inicio]" class="form-control" id="plan-area-fecha-inicio" value="<?= (is_array($plan_area)) ? $plan_area["fecha_inicio"] : "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Fecha fin <span class="text-danger">*</span></label>
                                                <input readonly <?= (!$editable) ? "disabled" : "" ?> required type="date" name="plan[fecha_fin]" class="form-control" id="plan-area-fecha-fin" value="<?= (is_array($plan_area)) ? $plan_area["fecha_fin"] : "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Intensidad horaria (Semanal) <span class="text-danger">*</span></label>
                                                <input <?= (!$editable) ? "disabled" : "" ?> required type="number" placeholder="Ej. 2" name="plan[intensidad_horaria]" class="form-control" id="" value="<?= (is_array($plan_area)) ? $plan_area["intensidad_horaria"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ro">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-container">
                                <div class="section-header">
                                    <div>
                                        <span class="enumerator">PARTE 2 DE 4</span>
                                        <h4 class="section-title">Descripción</h4>
                                    </div>
                                    <i data-parte="2" class="fa fa-solid fa-chevron-down open-close-parte"></i>
                                </div>
                                <div style="display:<?= (is_array($plan_area)) ? "none" : "block" ?>;" class="section-content" id="parte-2">
                                    <hr>
                                    <div class="row">
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <i data-text="<?= $CARACTERIZACION_ESTUDIANTES_TEXT ?>" class="open-plan-aula-tooltip fa fa-info-circle m-r-5 text-info cursor-pointer"></i>
                                                <label for="">Caracterización de los estudiantes
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea <?= (!$editable) ? "disabled" : "" ?> name="plan[diagnostico]" id="richtext-1" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["diagnostico"] : "" ?></textarea>
                                            </div>
                                        </div>
                                        <!--<div class=" col-xs-12">
                                            <div class="form-group">
                                                <i data-text="<?= $ESTADO_ACTUAL_TEXT ?>" class="open-plan-aula-tooltip fa fa-info-circle m-r-5 text-info cursor-pointer"></i>
                                                <label for="">Estado actual <span class="text-danger">*</span></label>
                                                <textarea name="plan[estado_actual]" id="richtext-2" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["estado_actual"] : "" ?></textarea>
                                            </div>
                                        </div>-->
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <i data-text="<?= $APRENDIZAJE_MEJORAR_TEXT ?>" class="open-plan-aula-tooltip fa fa-info-circle m-r-5 text-info cursor-pointer"></i>
                                                <label for="">Aprendizajes por mejorar <span class="text-danger">*</span></label>
                                                <textarea name="plan[situacion_deseada]" id="richtext-3" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["situacion_deseada"] : "" ?></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <i data-text="<?= $OTROS_APRENDIZAJE_MEJORAR_TEXT ?>" class="open-plan-aula-tooltip fa fa-info-circle m-r-5 text-info cursor-pointer"></i>
                                                <label for="">Otros aprendizajes por fortalecer <span class="text-danger">*</span></label>
                                                <textarea name="plan[observaciones]" id="richtext-4" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["observaciones"] : "" ?></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <i data-text="<?= $ENCUADRE_PACTOS_CLASE_TEXT ?>" class="open-plan-aula-tooltip fa fa-info-circle m-r-5 text-info cursor-pointer"></i>
                                                <label for="">Encuadre o pactos de clase <span class="text-danger">*</span></label>
                                                <textarea name="plan[pactos_clase]" id="richtext-5" cols="30" rows="3" class="form-control"><?= (is_array($plan_area)) ? $plan_area["pactos_clase"] : "" ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ro">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-container">
                                <div class="section-header">
                                    <div>
                                        <span class="enumerator">PARTE 3 DE 4</span>
                                        <h4 class="section-title">Estandares básicos de competencia & DBAs</h4>
                                    </div>
                                    <i data-parte="3" class="fa fa-solid fa-chevron-down open-close-parte"></i>
                                </div>
                                <div style="display:<?= (is_array($plan_area)) ? "none" : "block" ?>;" class="section-content" id="parte-3">
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Estandar básico de competencia</label>
                                                <select <?= (!$editable) ? "disabled" : "" ?> name="plan[estandares_basicos][]" data-live-search="true" data-size="10" class="form-control select-2" multiple id="plan-area-estandar">
                                                    <?php
                                                        if($estandares){
                                                            foreach ($estandares as $estandar) { 
                                                                $estandaresSeleccionados = unserialize($plan_area["estandares_basicos"]);
                                                                ?>
                                                                <option <?= (in_array($estandar["id_estandar"], $estandaresSeleccionados)) ? "selected" : "" ?> value="<?= $estandar["id_estandar"] ?>"><?= $estandar["descripcion_estandar"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Derechos Básicos de Aprendizaje (DBA)</label>
                                                <select <?= (!$editable) ? "disabled" : "" ?> name="plan[dbas][]" data-live-search="true" data-size="10" class="form-control select-2" multiple id="plan-area-dba">
                                                    <?php
                                                        if($dbas){
                                                            foreach ($dbas as $dba) { 
                                                                $dbasSeleccionados = unserialize($plan_area["dbas"]);
                                                                ?>
                                                                <option <?= (in_array($dba["id_dba"], $dbasSeleccionados)) ? "selected" : "" ?> value="<?= $dba["id_dba"] ?>"><?= $dba["descripcion_dba"] ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        if(is_array($plan_area)) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-container">
                                        <div class="section-header">
                                            <div>
                                                <span class="enumerator">PARTE 4 DE 4</span>
                                            </div>
                                            <i data-parte="4" class="fa fa-solid fa-chevron-down open-close-parte"></i>
                                        </div>
                                        <div class="section-content" id="parte-4">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12" style="overflow-x: auto">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Semanas</th>
                                                            <?php if (!empty($tipos_componentes_evidencia)): ?>
                                                                <?php foreach ($tipos_componentes_evidencia as $tipo): ?>
                                                                    <th style="min-width: 200px; max-width: 200px;"><?= $tipo["nombre"] ?></th>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            <th style="width:130px;">Seguimiento y evaluación</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (!empty($evidencias)): ?>
                                                            <?php foreach ($evidencias as $evidencia): ?>
                                                                <?php
                                                                $selectedSemanas = unserialize($evidencia["semanas"]);
                                                                $listaSemanas = get_semanas_by_ids($selectedSemanas);
                                                                $estado = $evidencia["estado_completo"];
                                                                $completadoText = ($estado == 3) ? "Completado" : (($estado == 2) ? "No Completado" : "Completar");
                                                                $isOnlyRow = $evidencia["is_only_row"] == 1;
                                                                ?>
                                                                <tr>
                                                                    <td style="width:100px;">
                                                                        <?php if (is_array($listaSemanas)): ?>
                                                                            <?php foreach ($listaSemanas as $semana): ?>
                                                                                <div class="text-center">
                                                                                    <h5 class="m-b-0"><?= $semana["semana"] ?></h5>
                                                                                    <span class="text-muted" style="font-size:11px;"><?= $semana["fecha_inicio"] ?></span>
                                                                                    <span class="text-muted" style="font-size:11px;"><?= $semana["fecha_fin"] ?></span>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <?php if ($isOnlyRow): ?>
                                                                        <td colspan="<?= count($tipos_componentes_evidencia) ?>">
                                                                            <?php
                                                                            if (!empty($tipos_componentes_evidencia) && isset($tipos_componentes_evidencia[0])) {
                                                                                $tipoComponenteId = $tipos_componentes_evidencia[0]["id_tipo_componente"];
                                                                                foreach ($evidencia['componentes'] as $componente) {
                                                                                    if ($componente['id_tipo_componente'] == $tipoComponenteId) {
                                                                                        echo $componente["contenido"];
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    <?php else: ?>
                                                                        <?php
// 1. Preprocesar los contenidos por tipo
                                                                        $columnas = [];
                                                                        $maxFilas = 0;
                                                                        $titulos_columnas = [];

                                                                        foreach ($tipos_componentes_evidencia as $tipo) {
                                                                            $contenido = '';
                                                                            foreach ($evidencia['componentes'] as $componente) {
                                                                                if ($componente['id_tipo_componente'] == $tipo["id_tipo_componente"]) {
                                                                                    $contenido = $componente["contenido"];
                                                                                    break;
                                                                                }
                                                                            }

                                                                            if (strpos($contenido, '&-separator-$') !== false) {
                                                                                $partes = explode('&-separator-$', $contenido);
                                                                                array_pop($partes); // eliminar el separador final vacío
                                                                            } else {
                                                                                $partes = [$contenido];
                                                                            }

                                                                            $columnas[] = $partes;
                                                                            $maxFilas = max($maxFilas, count($partes));

                                                                            $titulos = isset($tipo["titulos_filas"]) ? @unserialize($tipo["titulos_filas"]) : [];
                                                                            $titulos_columnas[] = $titulos;
                                                                        }

// 2. Transponer columnas en filas internas
                                                                        $filaInterna = [];
                                                                        for ($i = 0; $i < $maxFilas; $i++) {
                                                                            $fila = [];
                                                                            foreach ($columnas as $col) {
                                                                                $fila[] = isset($col[$i]) ? $col[$i] : '';
                                                                            }
                                                                            $filaInterna[] = $fila;
                                                                        }
                                                                        ?>

                                                                        <!-- Renderizar cada fila interna con flex -->
                                                                        <td colspan="<?= count($tipos_componentes_evidencia) ?>">
                                                                            <?php foreach ($filaInterna as $rowIndex => $fila): ?>
                                                                                <div style="display: flex; margin: -9px -9px -9px -8px;">
                                                                                    <?php foreach ($fila as $colIndex => $celda): ?>
                                                                                        <?php
                                                                                        $titulo = isset($titulos_columnas[$colIndex][$rowIndex]) ? $titulos_columnas[$colIndex][$rowIndex] : '';
                                                                                        ?>
                                                                                        <div style="<?= (strlen($celda) > 5 && strlen($celda) < 300 && count($filaInterna) < 2) ? 'height: 260px;' : '' ?> <?= trim(strip_tags($celda)) !== '' ? 'border-top: 1px solid #ccc;' : '' ?> min-width: 200px; max-width: 200px; flex: 1; padding: 8px 8px 15px 8px; font-size: 11px; border-right: 1px solid #e0e0e0;">
                                                                                            <?php if ($titulo): ?>
                                                                                                <b><?= htmlspecialchars($titulo) ?>:</b><br>
                                                                                            <?php endif; ?>
                                                                                            <?= $celda ?>
                                                                                        </div>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </td>
                                                                    <?php endif; ?>

                                                                    <td class="text-center">
                                                                        <div>
                                                                            <input
                                                                                <?= $editable ? '' : 'disabled' ?>
                                                                                <?= $evidencia["is_completo"] ? 'checked' : '' ?>
                                                                                    data-id="<?= $evidencia["id_evidencia_aprendizaje"] ?>"
                                                                                    type="checkbox"
                                                                                    class="completar-evidencia-aprendizaje <?= $evidencia["is_completo"] ? 'checked' : 'unchecked' ?>">
                                                                            <?= $completadoText ?>
                                                                            <br><br>

                                                                            <?php if ($editable): ?>
                                                                                <a href="<?= base_url() ?>PlanAula/create/<?= $plan_area["id_plan_area"] ?>/<?= $evidencia["id_evidencia_aprendizaje"] ?>" class="btn btn-sm btn-info m-b-1">Editar</a>
                                                                                <button data-id="<?= $evidencia["id_evidencia_aprendizaje"] ?>" type="button" class="btn m-b-10 btn-sm btn-danger remove-evidencia-aprendizaje">Eliminar</button>
                                                                            <?php else: ?>
                                                                                <button data-id="<?= $evidencia["id_evidencia_aprendizaje"] ?>" type="button" class="btn m-b-10 btn-sm btn-info btn-agregar-observaciones-coordinador">Agregar observaciones</button>
                                                                            <?php endif; ?>

                                                                            <button data-id="<?= $evidencia["id_evidencia_aprendizaje"] ?>" type="button" class="btn btn-sm btn-primary btn-evidencias-aprendizaje-soportes">Evidencias</button>

                                                                            <div class="text-left m-t-10">
                                                                                <p><strong>Observaciones del coordinador: </strong><?= $evidencia["observaciones_coordinador"] ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ro">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>

                            <?php
                                if($editable){ ?>
                                    <div class="row" id="container-form-evidencia">
                                        <div class="col-md-12">
                                            <div class="section-container">
                                                <div class="section-header">
                                                    <div>
                                                        <span class="enumerator">PARTE 4 DE 4</span>
                                                        <h4 class="section-title"><?= (is_array($selectedEvidencia)) ? "Modificar" : "Nueva" ?> evidencia de aprendizaje</h4>
                                                    </div>
                                                </div>
                                                <div class="section-content">
                                                    <hr>
                                                    <div class="row">
                                                        <input type="hidden" name="evidencia[id_evidencia_aprendizaje]" value="<?= (is_array($selectedEvidencia)) ? $selectedEvidencia["id_evidencia_aprendizaje"] : "null" ?>">
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="">Semana(s)</label>
                                                                <select name="evidencia[semanas][]" class="form-control select-2 m-b-10" multiple id="create-plan-aula-semanas-select">
                                                                    <?php
                                                                    if($semanas){
                                                                        $selectedSemanas = [];
                                                                        if(is_array($selectedEvidencia)){
                                                                            $selectedSemanas = unserialize($selectedEvidencia["semanas"]);
                                                                        }
                                                                        foreach ($semanas as $semana) { ?>
                                                                            <option <?= (in_array($semana["id_semana_periodo"], $selectedSemanas)) ? "selected" : "" ?> value="<?= $semana["id_semana_periodo"] ?>"><?= $semana["semana"]. " - ( " . date("Y-m-d", strtotime($semana["fecha_inicio"])) . " - " . date("Y-m-d", strtotime($semana["fecha_fin"])) . " )" ?></option>
                                                                        <?php }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <a data-id="<?= (is_array($plan_area)) ? $plan_area["id_plan_area"] : "null" ?>" class="m-t-10 hidden pointer btn-mostrar-evidencias-aprendizaje-incompletos"><span>Seleccionar evidencia de aprendizaje no completada</span></a>
                                                            </div>
                                                        </div>
                                                        <!--<div class=" col-xs-12">
                                                            <div class="form-group">
                                                                <label for="">Evidencia de aprendizaje</label>
                                                                <textarea name="evidencia[evidencia_aprendizaje]" id="richtext-6" cols="30" rows="3" class="form-control"><?= (is_array($selectedEvidencia)) ? $selectedEvidencia["evidencia_aprendizaje"] : "" ?></textarea>
                                                            </div>
                                                        </div>-->
                                                        <div class=" col-xs-12">
                                                            <div class="form-group form-check">
                                                                <input name="evidencia[is_only_row]" type="checkbox" class="form-check-input" id="only-row-input" <?= (is_array($selectedEvidencia) && $selectedEvidencia["is_only_row"] == 1) ? "checked" : "" ?>>
                                                                <label class="form-check-label" for="exampleCheck1">Solo registrar un componente para esta(s) semana(s).</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="extra-info-evidenci" style="display:<?= (is_array($selectedEvidencia) && $selectedEvidencia["is_only_row"] == 1) ? "none;" : "block;" ?>">
                                                        <div class="row">
                                                            <?php
                                                            $hideRichTexts = [];
                                                            if ($tipos_componentes_evidencia) {
                                                                $x = 7;
                                                                foreach ($tipos_componentes_evidencia as $TCE) {

                                                                    $componenteBuscado = null;
                                                                    if (is_array($selectedEvidencia)) {
                                                                        foreach ($selectedEvidencia['componentes'] as $componente) {
                                                                            if ($componente['id_tipo_componente'] == $TCE["id_tipo_componente"]) {
                                                                                $componenteBuscado = $componente;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }

                                                                    $cantidad_filas   = isset($TCE["cantidad_filas"]) ? (int)$TCE["cantidad_filas"] : 1;
                                                                    $titulos_filas    = isset($TCE["titulos_filas"]) ? @unserialize($TCE["titulos_filas"]) : [];
                                                                    $contenido_total  = isset($componenteBuscado["contenido"]) ? $componenteBuscado["contenido"] : "";

                                                                    ?>
                                                                    <div class="col-md-4 col-sm-6 col-xs-12 <?= $x > 7 ? 'extra-info-evidencia' : '' ?>">
                                                                        <div style="background: #077b5d;" class="evidence-container">
                                                                            <h5><?= $TCE["nombre"] ?></h5>
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    <!-- ID componente -->
                                                                                    <input type="hidden" name="evidencia[<?= $TCE["id_tipo_componente"] ?>][id_componente]" value="<?= is_array($componenteBuscado) ? $componenteBuscado["id_componente"] : "" ?>">

                                                                                    <div class="form-group">
                                                                                        <label><?= $TCE["descripcion"] ?></label><br>

                                                                                        <?php if ($cantidad_filas <= 1): ?>
                                                                                            <!-- ✅ Modo normal: un solo textarea visible -->
                                                                                            <textarea
                                                                                                    name="evidencia[<?= $TCE["id_tipo_componente"] ?>][contenido]"
                                                                                                    id="richtext-<?= $x ?>"
                                                                                                    cols="30" rows="4"
                                                                                                    class="form-control"
                                                                                            ><?= htmlspecialchars($contenido_total) ?></textarea>
                                                                                        <?php else: ?>
                                                                                            <!-- ✅ Modo múltiple: varios textareas visibles -->
                                                                                            <?php for ($i = 0; $i < $cantidad_filas; $i++): ?>
                                                                                                <?php
                                                                                                $hideRichTexts[] = $x;
                                                                                                $titulo = isset($titulos_filas[$i]) ? $titulos_filas[$i] : "Fila " . ($i + 1);
                                                                                                $valores_fila = explode("&-separator-$", $contenido_total);
                                                                                                ?>
                                                                                                <label for="sub-textarea-<?= $TCE["id_tipo_componente"] ?>-<?= $i ?>"><?= $titulo ?></label>
                                                                                                <textarea
                                                                                                        class="form-control sub-textarea"
                                                                                                        data-main="#richtext-<?= $x ?>"
                                                                                                        data-index="<?= $i ?>"
                                                                                                        id="sub-textarea-<?= $TCE["id_tipo_componente"] ?>-<?= $i ?>"
                                                                                                        rows="3"
                                                                                                ><?= isset($valores_fila[$i]) && trim($valores_fila[$i]) !== "" ? htmlspecialchars($valores_fila[$i]) : '' ?> </textarea>
                                                                                            <?php endfor; ?>

                                                                                            <!-- ✅ Textarea oculto para concatenación final -->
                                                                                            <textarea
                                                                                                    name="evidencia[<?= $TCE["id_tipo_componente"] ?>][contenido]"
                                                                                                    id="richtext-<?= $x ?>"
                                                                                                    cols="30" rows="4"
                                                                                                    class="form-control"
                                                                                                    style="display: none !important;"
                                                                                            ><?= htmlspecialchars($contenido_total) ?></textarea>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $x++;
                                                                }
                                                            }
                                                            ?>

                                                            <!--<div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div style="background: #077b5d;" class="evidence-container">
                                                                    <h5>EXPLORACIÓN</h5>
                                                                    <div class="row">
                                                                        <div class=" col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="">Motivación y exploración de saberes previos</label>
                                                                                <textarea name="evidencia[exploracion]" id="richtext-7" cols="30" rows="4" class="form-control"><?= (is_array($selectedEvidencia)) ? $selectedEvidencia["exploracion"] : "" ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div style="background:#0171bb;" class="evidence-container">
                                                                    <h5>ESTRUCTURACIÓN</h5>
                                                                    <div class="row">
                                                                        <div class=" col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="">Momento estructuración y práctica</label>
                                                                                <textarea name="evidencia[estructuracion]" id="richtext-8" cols="30" rows="4" class="form-control"><?= (is_array($selectedEvidencia)) ? $selectedEvidencia["estructuracion"] : "" ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div style="background:#e73031;" class="evidence-container">
                                                                    <h5>TRANSFERENCIA</h5>
                                                                    <div class="row">
                                                                        <div class=" col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="">Momento de transferencia</label>
                                                                                <textarea name="evidencia[transferencia]" id="richtext-9" cols="30" rows="4" class="form-control"><?= (is_array($selectedEvidencia)) ? $selectedEvidencia["transferencia"] : "" ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div style="background:#ed7202;" class="evidence-container">
                                                                    <h5>VALORACIÓN</h5>
                                                                    <div class="row">
                                                                        <div class=" col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="">Momento de transferencia</label>
                                                                                <textarea name="evidencia[valoracion]" id="richtext-10" cols="30" rows="4" class="form-control"><?= (is_array($selectedEvidencia)) ? $selectedEvidencia["valoracion"] : "" ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div style="background:#ed7202;" class="evidence-container">
                                                                    <h5>RECURSOS</h5>
                                                                    <div class="row">
                                                                        <div class=" col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="">Recursos</label>
                                                                                <textarea name="evidencia[recursos]" id="richtext-11" cols="30" rows="4" class="form-control"><?= (is_array($selectedEvidencia)) ? $selectedEvidencia["recursos"] : "" ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               <?php }
                            ?>
                        <?php }
                    ?>

                    <?php
                        if($editable) {
                            ?>
                            <div class="row">
                                <div class="col-md-12 m-t-15 text-right">
                                    <button class="btn btn-primary m-t-15" type="submit">Guardar</button>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </form>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>
<style>
    span {
        word-break: break-all;
    }
</style>
<script>
    let allRichtext = [];
    let countComponentes = Number("<?= is_array($tipos_componentes_evidencia) ? count($tipos_componentes_evidencia) : 0 ?>");
    let forLength = 7 + countComponentes;
    let editEvidencia = "<?= (is_array($selectedEvidencia)) ? "true" : "false" ?>";

    $('.select-2').select2();

    let kothingParamsPlan = {
        fontSize: [8, 10, 12, 14, 16, 18, 20], // Lista de tamaños de letra
        defaultFontSize: 10, // Tamaño de letra predeterminado
        width: '100%',
        height: 'auto',
        toolbarItem: [
            ['undo', 'redo'],
            ['fontSize'],
            ['bold', 'underline', 'italic'],
            ['fontColor', 'hiliteColor'],
            ['outdent', 'indent', 'align', 'list', 'horizontalRule'],
            ['link', 'image', 'video'],
            ['fullScreen', 'showBlocks', 'codeView'],
            ['preview', 'print'],
        ],
        charCounter: true,
    }

    $( document ).ready(function() {
        let domElement = null;
        for (let i = 1; i < forLength; i++) {
            domElement = jQuery("#richtext-" + i);
            if(domElement.length > 0){
                let hideRichTexts = '<?=  json_encode($hideRichTexts ?? []) ?>';
                console.log(hideRichTexts)
                allRichtext[i] = KothingEditor.create('richtext-' + i, kothingParamsPlan);
                if(hideRichTexts.includes(i)){
                    allRichtext[i].getContext().element.topArea.style.display = 'none';
                }
                jQuery("#richtext-" + i).addClass("hide-textarea");
            }
        }

        $("#form-plan-aula").on('submit', function(e) {
            for (let i = 1; i < forLength; i++) {
                if(jQuery("#richtext-" + i).length) {
                    jQuery("#richtext-" + i).html(allRichtext[i].getContents());
                }
            }
        });

        if(editEvidencia == "true"){
            jQuery('html, body').animate({
                scrollTop: $("#container-form-evidencia").offset().top
            }, 2000);
        }
    })
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const subTextareas = document.querySelectorAll(".sub-textarea");

        subTextareas.forEach(function(sub) {
            sub.addEventListener("input", function () {
                const mainSelector = this.dataset.main;
                console.log(mainSelector)
                const mainTextarea = document.querySelector(mainSelector);

                if (mainTextarea) {

                    const related = document.querySelectorAll(`.sub-textarea[data-main='${mainSelector}']`);
                    let combined = "";

                    related.forEach(t => {
                        const value = t.value.trim();
                        combined += value + "&-separator-$";
                    });

                    mainTextarea.value = combined.trim();
                    for (let i = 0; i < allRichtext.length; i++) {
                        if(allRichtext[i]){
                            const textareaId = allRichtext[i].getContext().element.originElement.id;
                            if('#'+textareaId === mainSelector){
                                allRichtext[i].getContext().element.topArea.style.display = 'none';
                                allRichtext[i].setContents(combined.trim());
                            }
                        }

                    }
                }
            });
        });
    });
</script>