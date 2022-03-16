<?php $this->load->view("in_head") ?>
<body>
    <?php $this->load->view("in_header") ?>
    <?php $this->load->view("pruebas/templates/in_aside") ?>
    <div class="content-page">
        <div class="content">  
            <div class="container">
                <form action="" method="post">
                    <input type="hidden" name="id_pregunta" value="<?= $pregunta["id_pregunta_prueba"] ?>">
                    <div class="row" id="migas"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 id="timer" class="text-center m-b-2">Tiempo disponible: -- minutos -- segundos</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading text-capitalize">
                                            <b>Pregunta <?= (info_prueba_realizada($prueba["id_prueba"], $id_participante)["parcial"] + 1)."/".$prueba["cantidad_preguntas"] ?> </b>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-lg-12">
                                                    <div class="subtitle-buttons">
                                                        <?= $pregunta["descripcion_pregunta"] ?>
                                                    </div>
                                                    <hr>
                                                    <?php
                                                        if($respuestas){
                                                            $x = 0;
                                                            shuffle($respuestas);
                                                            foreach ($respuestas as $respuesta) {
                                                    ?>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input required type="radio" class="form-check-input" name="id_respuesta" value="<?= $respuesta['id_respuesta_pregunta_prueba'] ?>"> <?= $respuesta["descripcion_respuesta"] ?>
                                                                    </label>
                                                                </div>
                                                    <?php
                                                                $x++;
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-end" style="text-align:right;">
                                        <div class="col-md-12 text-end">
                                            <button class="btn btn-primary">Guardar y continuar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- container -->                               
        </div> <!-- content -->
    </div>
</div>
</body>
<?php $this->load->view("in_footer") ?>
<?php $this->load->view("in_script") ?>
</html>

<script>
    const start = Date.parse("<?= $prueba_realizada["created_at"] ?>");
    const duration = "<?= $prueba["duracion"] * 60 ?>";
    let intervalTimer = setInterval(setTimer, 1000);

    function setTimer(){
        let timer_dom = "Tiempo disponible: ";
        let now = new Date();
        const diffTime = Math.abs(now - start);
        const diffDays = Math.ceil(diffTime / (1000)); 

        let missing_time =  toHHMMSS(duration - diffDays);

        if(missing_time.hours > 0)
            timer_dom += "<span class='text-danger'> " + missing_time.hours + " </span> horas ";
        if(missing_time.minutes > 0)
            timer_dom += "<span class='text-danger'> " + missing_time.minutes + " </span> minutos ";
        if(missing_time.seconds > 0)
            timer_dom += "<span class='text-danger'> " + missing_time.seconds + " </span> segundos ";

        $("#timer").html(timer_dom);
        if((duration - diffDays) <= 0){
            clearInterval(intervalTimer);
            cerrar_intento_prueba("<?= $prueba_realizada["id_realizar_prueba"] ?>");
        }
    }

    function toHHMMSS(totalNumberOfSeconds){
        var hours = parseInt( totalNumberOfSeconds / 3600 );
        var minutes = parseInt( (totalNumberOfSeconds - (hours * 3600)) / 60 );
        var seconds = Math.floor((totalNumberOfSeconds - ((hours * 3600) + (minutes * 60))));

        return {
            hours: hours,
            minutes: minutes,
            seconds: seconds
        }
    }

</script>