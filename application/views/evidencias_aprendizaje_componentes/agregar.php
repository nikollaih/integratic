<?php $this->load->view("in_head") ?>
<body>
<?php $this->load->view("in_header") ?>
<?php $this->load->view("in_aside") ?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row" id="migas"></div>
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= base_url() ?>EvidenciasAprendizajeComponentes" class="btn btn-primary m-b-2">Lista de componentes</a>
                </div>
            </div>
            <form action="" method="post">
                <input name="id_tipo_componente" class="form-control"  type="hidden" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["id_tipo_componente"] : "" ?>">

                <div class="panel panel-primary">
                    <div class="panel-heading"><b><?= (isset($componente["id_componente"])) ? "Modificar" : "Nuevo" ?> Componente</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="<?= (isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) ? 'col-md-3' : 'col-md-4'?>">
                                <div class="form-group">
                                    <label for="">Titulo</label>
                                    <input name="nombre" class="form-control" type="text" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["nombre"] : "" ?>">
                                </div>
                            </div>
                            <div class="<?= (isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) ? 'col-md-3' : 'col-md-4'?>">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <input name="descripcion" class="form-control" type="text" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["descripcion"] : "" ?>">
                                </div>
                            </div>
                            <div class="<?= (isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) ? 'col-md-3' : 'col-md-4'?>">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <select name="activo" id="" class="form-control">
                                        <option <?= (isset($componente["id_tipo_componente"]) && $componente["activo"] === "1") ? "selected" : "" ?> value="1">Activo</option>
                                        <option <?= (isset($componente["id_tipo_componente"]) && $componente["activo"] === "0") ? "selected" : "" ?> value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <?php if(isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) { ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Órden</label>
                                        <input name="orden" class="form-control" type="text" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["orden"] : "" ?>">
                                    </div>
                                </div>
                            <?php }
                            ?>
                            <div class="<?= (isset($componente["id_tipo_componente"]) && $componente["id_tipo_componente"] != 1) ? 'col-md-3' : 'col-md-4'?>">
                                <div class="form-group">
                                    <label for="">Cantidad de filas</label>
                                    <input name="cantidad_filas" class="form-control" type="number" max="10" id="" value="<?= (isset($componente["id_tipo_componente"])) ? $componente["cantidad_filas"] : "" ?>">
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
                                <hr>
                            </div>
                            <div id="contenedor-titulos-filas">
                                <!-- Aquí se agregarán dinámicamente los campos de título por cada fila -->
                            </div>
                        </div>

                        <div class="row text-end" style="text-align:right;">
                            <div class="col-md-12 text-end">
                                <hr>
                                <button class="btn btn-primary">Guardar</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        const inputCantidad = document.querySelector('input[name="cantidad_filas"]');
        const contenedorTitulos = document.getElementById("contenedor-titulos-filas");

        // Aquí traemos los valores desde PHP
        const titulosPrecargados = <?= isset($componente["titulos_filas_array"]) ? json_encode($componente["titulos_filas_array"]) : '[]' ?>;

        function generarCamposTitulos(cantidad) {
            if(inputCantidad.value > 1){
                contenedorTitulos.innerHTML = "";
                for (let i = 0; i < cantidad; i++) {
                    const titulo = titulosPrecargados[i] || ""; // Si hay título, lo ponemos
                    const col = document.createElement("div");
                    col.className = "col-md-4";
                    col.innerHTML = `
                <div class="form-group">
                    <label for="titulo_fila_${i + 1}">Título fila ${i + 1}</label>
                    <input type="text" name="titulos_filas[]" id="titulo_fila_${i + 1}" class="form-control" value="${titulo}" />
                </div>
            `;
                    contenedorTitulos.appendChild(col);
                }
            }
        }

        // Precargar si ya existe un valor
        if (inputCantidad.value) {
            generarCamposTitulos(parseInt(inputCantidad.value));
        }

        // Escuchar cambios dinámicos
        inputCantidad.addEventListener("input", function () {
            const cantidad = parseInt(this.value);
            if (!isNaN(cantidad) && cantidad > 1) {
                generarCamposTitulos(cantidad);
            } else {
                contenedorTitulos.innerHTML = "";
            }
        });
    });
</script>
