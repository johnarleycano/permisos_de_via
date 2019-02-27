<?php
// Consulta de datos 
$solicitud = $this->solicitud_model->obtener("solicitud", $id_solicitud);
$observacion = $this->solicitud_model->obtener("observacion", $id_observacion);
?>

<!-- Input que almacena el id de la observación que se está trabajando -->
<input type="hidden" id="id_observacion">

<div class="uk-column-1-2@s">
	<div class="uk-margin">
    	<label class="uk-form-label" for="input_radicado_ani">Radicado ANI *</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" id="input_radicado_ani" title="Radicado ANI" autofocus>
        </div>
    </div>

	<div class="uk-margin">
    	<label class="uk-form-label" for="input_fecha_radicado_ani">Fecha *</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="date" id="input_fecha_radicado_ani" title="Fecha de emisión del radicado ANI">
        </div>
    </div>
</div>

<div class="uk-column-1-2@s">
	<div class="uk-margin">
    	<label class="uk-form-label" for="input_radicado_proyecto">Radicado <?php echo $solicitud->Proyecto; ?> *</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" id="input_radicado_proyecto" title="Radicado <?php echo $solicitud->Proyecto; ?>">
        </div>
    </div>

	<div class="uk-margin">
    	<label class="uk-form-label" for="input_fecha_radicado_proyecto">Fecha *</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="date" id="input_fecha_radicado_proyecto" title="Fecha de emisión del radicado del proyecto">
        </div>
    </div>
</div>

<div class="uk-column-1-1@s">
	<div class="uk-margin">
    	<label class="uk-form-label" for="input_fecha_asignacion">Fecha de asignación al área *</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="date" id="input_fecha_asignacion" title="Fecha de asignación">
        </div>
    </div>
</div>

<button class="uk-button uk-button-default uk-modal-close" type="button" onClick="javascript:cerrar_interfaz()">Cancelar</button>
<input class="uk-button uk-button-primary" type="button" onClick="javascript:guardar()" value="Guardar cambios"/>

<script type="text/javascript">
    // Id de la observación
    $("#id_observacion").val("<?php echo $id_observacion; ?> ")
</script>

<!-- Cuando tiene una solicitud -->
<?php if ($observacion) { ?>
	<script type="text/javascript">
    	// Valores por defecto
    	$("#input_radicado_ani").val("<?php echo $observacion->Radicado_ANI; ?>")
    	$("#input_fecha_radicado_ani").val("<?php echo $observacion->Fecha_Radicado_ANI; ?>")
    	$("#input_radicado_proyecto").val("<?php echo $observacion->Radicado_Proyecto; ?>")
    	$("#input_fecha_radicado_proyecto").val("<?php echo $observacion->Fecha_Radicado_Proyecto; ?>")
    	$("#input_fecha_asignacion").val("<?php echo $observacion->Fecha_Asignacion; ?>")
	</script> 
<?php } ?>