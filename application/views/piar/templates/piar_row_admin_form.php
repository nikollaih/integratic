<?php
$_piar_objetivos_val = "";
$_piar_barreras_val = "";
$_piar_ajustes_val = "";

if ($item_piar) {
    $raw = $item_piar["objetivos"] ?? "";
    if (strpos($raw, 'a:') === 0) {
        $un = @unserialize($raw);
        if (is_array($un)) {
            if (isset($un['dbas']) && is_string($un['dbas'])) {
                $_piar_objetivos_val = $un['dbas'];
            } elseif (!empty($un['observaciones']) && is_string($un['observaciones'])) {
                $_piar_objetivos_val = $un['observaciones'];
            }
        }
    } else {
        $_piar_objetivos_val = $raw;
    }

    $raw = $item_piar["barreras"] ?? "";
    if (strpos($raw, 'a:') === 0) {
        $un = @unserialize($raw);
        if (is_array($un) && isset($un['barreras']) && is_string($un['barreras'])) {
            $_piar_barreras_val = $un['barreras'];
        }
    } else {
        $_piar_barreras_val = $raw;
    }

    $raw = $item_piar["ajustes_razonables"] ?? "";
    if (strpos($raw, 'a:') === 0) {
        $un = @unserialize($raw);
        if (is_array($un) && isset($un['ajustes_razonables']) && is_string($un['ajustes_razonables'])) {
            $_piar_ajustes_val = $un['ajustes_razonables'];
        }
    } else {
        $_piar_ajustes_val = $raw;
    }
}
?>

<?php
    if(strtolower(logged_user()["rol"]) !== 'orientador') {
        ?>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div style="background: #077b5d;" class="evidence-container">
                <h5>OBJETIVOS/PROPÓSITOS</h5>
                <div class="row">
                    <div class=" col-xs-12">
                        <div class="form-group">
                            <textarea name="objetivos" id="richtext-piar-1" cols="30" rows="4" class="form-control"><?= $_piar_objetivos_val ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>

<div class="col-md-6 col-sm-12 col-xs-12">
    <div style="background:#0171bb;" class="evidence-container">
        <h5>BARRERAS QUE SE EVIDENCIAN EN EL CONTEXTO SOBRE LAS QUE SE DEBEN TRABAJAR </h5>
        <div class="row">
            <div class=" col-xs-12">
                <div class="form-group">
                    <textarea name="barreras" id="richtext-piar-2" cols="30" rows="4" class="form-control"><?= $_piar_barreras_val ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12 col-xs-12">
    <div style="background:#e73031;" class="evidence-container">
        <h5>AJUSTES RAZONABLES</h5>
        <div class="row">
            <div class=" col-xs-12">
                <div class="form-group">
                    <textarea name="ajustes_razonables" id="richtext-piar-3" cols="30" rows="4" class="form-control"><?= $_piar_ajustes_val ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>