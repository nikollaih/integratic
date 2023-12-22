<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <div class="row" id="migas"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading text-capitalize"><b>Calendario de actividades</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Materia</label>
                                        <select required name="id_area" id="area" class="form-control get-calendar-activities calendar-materia">
                                            <option value=null>Todas</option>
                                            <?php
                                                if($materias){
                                                    foreach ($materias as $materia) {
                                                        ?>
                                                            <option value="<?= $materia["codmateria"] ?>"><?= $materia["nommateria"] ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Periodo</label>
                                        <select required name="id_area" id="area" class="form-control get-calendar-activities calendar-periodo">
                                            <option value=null>Todos</option>
                                            <?php
                                                if($periodos){
                                                    foreach ($periodos as $periodo) {
                                                        ?>
                                                            <option value="<?= $periodo["id_periodo"] ?>"><?= $periodo["periodo"] ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-b-2">
                                <div class="col-md-12">
                                    <span class="badge badge-primary" style="background:#428cff;">&nbsp;No Disponible&nbsp;</span>
                                    <span class="badge badge-success" style="background:#0b6951;">&nbsp;Entregada&nbsp;</span>
                                    <span class="badge badge-warning" style="background:#ffb142;">&nbsp;Disponible&nbsp;</span>
                                    <span class="badge badge-danger" style="background:#ff424b;">&nbsp;Vencida&nbsp;</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
<script src="<?= base_url() ?>assets/fullcalendar/fullcalendar.min.js"></script>
<script src="<?= base_url() ?>js/calendario-actividades.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
</html>

<style>
    .calendar-tooltip-title {
        margin: 0;
        color: #fefefe;
        font-size:11px;
    }

    .calendar-tooltip-text {
        margin-bottom: 10px !important;
        font-size: 13px;
    }

    .fc-scroller.fc-scroller-liquid-absolute, .fc-scroller-harness.fc-scroller-harness-liquid{
        overflow: visible !important;
    }
</style>