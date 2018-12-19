<!-- Si tiene id de solicitud, la consulta -->
<?php $solicitud = ($id_solicitud > 0) ? $this->solicitud_model->obtener("solicitud", $id_solicitud) : null ; ?>

<form>
	<div class="uk-column-1-2@m">
		<div class="uk-margin">
            <label class="uk-form-label" for="select_realizo_pago">¿Realizó el pago? *</label>
            <select class="uk-select" id="select_realizo_pago" title="Tipo de solicitud" autofocus>
                <option value="0">No</option>
                <option value="1">Si</option>
            </select>
        </div>
    </div><br>

	<div id="cont_datos_realizo_pago">
		<hr>
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
	</div>
</form>

<script type="text/javascript">
	function guardar()
	{
		cerrar_notificaciones()
		imprimir_notificacion("<div uk-spinner></div> Guardando información de la aceptación del pago...")

		// Si realizó el pago
		if($("#select_realizo_pago").val() == 1){
			let campos_obligatorios = {
				"input_fecha_soporte_aceptacion": $("#input_fecha_soporte_aceptacion").val(),
				"input_radicado_soporte_aceptacion": $("#input_radicado_soporte_aceptacion").val(),
			}
			// imprimir(campos_obligatorios, "tabla")
			
			// Si existen campos obligatorios sin diligenciar
			if(validar_campos_obligatorios(campos_obligatorios)) return false
		}

		let datos = {
			"Realizo_Pago": $("#select_realizo_pago").val(),
    		"Fecha_Soporte_Aceptacion": ($("#select_realizo_pago").val() == 1) ? $("#input_fecha_soporte_aceptacion").val() : null,
    		"Radicado_Soporte_Aceptacion": ($("#select_realizo_pago").val() == 1) ? $("#input_radicado_soporte_aceptacion").val() : null,
		}
		// imprimir(datos, "tabla")

		// Se actualiza la solicitud
		ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "solicitud", "datos": datos, "id_solicitud": $("#id_solicitud").val()}, 'HTML')

		cerrar_notificaciones()
		imprimir_notificacion("Los datos han sido guardados exitosamente", "success")
	}

	$(document).ready(function(){
		$("#cont_datos_realizo_pago").hide()
		select_por_defecto("select_realizo_pago", "<?php echo $solicitud->Realizo_Pago; ?>")

		if($("#select_realizo_pago").val() == 1) $("#cont_datos_realizo_pago").show()
		
		$("#select_realizo_pago").on("change", function(){
			($(this).val() == 1) ? $("#cont_datos_realizo_pago").show() : $("#cont_datos_realizo_pago").hide()
		})

     	$("#input_fecha_soporte_aceptacion").val("<?php echo $solicitud->Fecha_Soporte_Aceptacion; ?>")
        $("#input_radicado_soporte_aceptacion").val("<?php echo $solicitud->Radicado_Soporte_Aceptacion; ?>")
	})
</script>

