<!-- Si tiene id de solicitud, la consulta -->
<?php $solicitud = ($id_solicitud > 0) ? $this->solicitud_model->obtener("solicitud", $id_solicitud) : null ; ?>

<form>
	<div class="uk-column-1-2@m">
		<div class="uk-margin">
	    	<label for="input_fecha_solicitud">Fecha del oficio de la solicitud de la ANI *</label>
            <input class="uk-input" type="date" id="input_fecha_solicitud" title="Fecha" autofocus>
        </div>

		<div class="uk-margin">
	    	<label for="input_radicado_solicitud">Radicado</label>
            <input class="uk-input" type="text" id="input_radicado_solicitud" title="Número de radicado *">
	    </div>
    </div>
</form>

<script type="text/javascript">
	function guardar()
	{
		cerrar_notificaciones()
		imprimir_notificacion("<div uk-spinner></div> Guardando datos de la solicitud...")

		let campos_obligatorios = {
			"input_fecha_solicitud": $("#input_fecha_solicitud").val(),
			"input_radicado_solicitud": $("#input_radicado_solicitud").val(),
		}
		// imprimir(campos_obligatorios, "tabla")

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)) return false

		let datos = {
    		"Fecha_Solicitud": $("#input_fecha_solicitud").val(),
    		"Radicado_Solicitud": $("#input_radicado_solicitud").val(),
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
        	$("#input_fecha_solicitud").val("<?php echo $solicitud->Fecha_Solicitud; ?>")
            $("#input_radicado_solicitud").val("<?php echo $solicitud->Radicado_Solicitud; ?>")
        })
    </script> 
<?php } ?>