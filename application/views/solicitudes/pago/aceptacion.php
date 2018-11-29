<!-- Si tiene id de solicitud, la consulta -->
<?php $solicitud = ($id_solicitud > 0) ? $this->solicitud_model->obtener("solicitud", $id_solicitud) : null ; ?>

<form>
    <div class="uk-column-1-2@m">
		<!-- Anuncion del cobro -->
		<div class="uk-margin">
	    	<label for="input_fecha_soporte_aceptacion">Fecha de soporte de pago o aceptación de solicitud *</label>
            <input class="uk-input" type="date" id="input_fecha_soporte_aceptacion" title="Fecha de soporte / aceptación">
        </div>

		<div class="uk-margin">
	    	<label for="input_radicado_soporte_aceptacion">Radicado</label>
            <input class="uk-input" type="text" id="input_radicado_soporte_aceptacion" title="Número de radicado de soporte / aceptación">
	    </div>
	</div>
</form>

<script type="text/javascript">
	function guardar()
	{
		cerrar_notificaciones()
		imprimir_notificacion("<div uk-spinner></div> Guardando información de la aceptación del pago...")

		let campos_obligatorios = {
			"input_fecha_soporte_aceptacion": $("#input_fecha_soporte_aceptacion").val(),
			"input_radicado_soporte_aceptacion": $("#input_radicado_soporte_aceptacion").val(),
		}
		// imprimir(campos_obligatorios, "tabla")

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)) return false

		let datos = {
    		"Fecha_Soporte_Aceptacion": $("#input_fecha_soporte_aceptacion").val(),
    		"Radicado_Soporte_Aceptacion": $("#input_radicado_soporte_aceptacion").val(),
		}
		// imprimir(datos, "tabla")

		// Se actualiza la solicitud
		ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "solicitud", "datos": datos, "id_solicitud": $("#id_solicitud").val()}, 'HTML')

		cerrar_notificaciones()
		imprimir_notificacion("Los datos han sido guardados exitosamente", "success")

	}
</script>

<!-- Cuando tiene una solicitud -->
<?php if ($solicitud) { ?>
	<script type="text/javascript">
        $(document).ready(function(){
        	$("#input_fecha_soporte_aceptacion").val("<?php echo $solicitud->Fecha_Soporte_Aceptacion; ?>")
            $("#input_radicado_soporte_aceptacion").val("<?php echo $solicitud->Radicado_Soporte_Aceptacion; ?>")
        })
    </script> 
<?php } ?>