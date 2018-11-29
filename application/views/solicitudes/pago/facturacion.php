<!-- Datos del pago -->
<?php $pago = $this->solicitud_model->obtener("pago", $id_solicitud); ?>

<form>
	<div class="uk-column-1-2@m">
		<div class="uk-margin">
            <label class="uk-form-label" for="select_requiere_pago">¿Requiere pago? *</label>
            <select class="uk-select" id="select_requiere_pago" title="Tipo de solicitud" autofocus>
                <option value="0">No</option>
                <option value="1">Si</option>
            </select>
        </div>
    </div><br>
	
	<div id="cont_datos_pago">
		<hr>
	    <div class="uk-column-1-2@m">
			<!-- Anuncion del cobro -->
			<div class="uk-margin">
		    	<label for="input_fecha_anuncio">Fecha de anuncio del cobro</label>
	            <input class="uk-input" type="date" id="input_fecha_anuncio" title="Fecha de anuncio del cobro">
	        </div>

			<div class="uk-margin">
		    	<label for="input_radicado_anuncio">Radicado</label>
	            <input class="uk-input" type="text" id="input_radicado_anuncio" title="Número de radicado de anuncio del cobro">
		    </div>
		</div>

	    <div class="uk-column-1-2@m">
			<!-- Aceptación del cobro -->
		    <div class="uk-margin">
		    	<label for="input_fecha_aceptacion">Fecha de aceptación del cobro</label>
	            <input class="uk-input" type="date" id="input_fecha_aceptacion" title="Fecha de aceptación del cobro">
	        </div>

			<div class="uk-margin">
		    	<label for="input_radicado_aceptacion">Radicado</label>
	            <input class="uk-input" type="text" id="input_radicado_aceptacion" title="Número de radicado de aceptación del cobro">
		    </div>
		</div>
			
	    <div class="uk-column-1-2@m">
			<!-- Factura -->
		    <div class="uk-margin">
		    	<label for="input_fecha_oficio">Fecha del oficio con la factura</label>
	            <input class="uk-input" type="date" id="input_fecha_oficio" title="Fecha de oficio con la factura">
	        </div>

			<div class="uk-margin">
		    	<label for="input_radicado_oficio">Radicado</label>
	            <input class="uk-input" type="text" id="input_radicado_oficio" title="Número de radicado del oficio con factura">
		    </div>
	    </div>
    </div>
</form>

<script type="text/javascript">
	function guardar()
	{
		cerrar_notificaciones()
		imprimir_notificacion("<div uk-spinner></div> Guardando datos del pago...")

		var campos_obligatorios = {}

		// Si requiere pago
		if($("#select_requiere_pago").val()){
			// Si tiene la fecha de aceptación del cobro
			if($("#input_fecha_aceptacion").val() != ""){
				// Es obligatorio la fecha de anuncio del cobro
				campos_obligatorios["input_fecha_anuncio"] = $("#input_fecha_anuncio").val()
				campos_obligatorios["input_radicado_anuncio"] = $("#input_radicado_anuncio").val()

				// Si la fecha de aceptación es menor a la fecha de anuncio del cobro
				if($("#input_fecha_aceptacion").val() < $("#input_fecha_anuncio").val()){
					cerrar_notificaciones()
					imprimir_notificacion("La fecha de aceptación del cobro debe ser mayor o igual a la fecha de anuncio", "danger")

					return false
				}
			}

			// Si tiene la fecha del oficio
			if($("#input_fecha_oficio").val() != ""){
				// Es obligatorio también la fecha de aceptación del cobro
				campos_obligatorios["input_fecha_aceptacion"] = $("#input_fecha_aceptacion").val()
				campos_obligatorios["input_radicado_aceptacion"] = $("#input_radicado_aceptacion").val()

				// Si la fecha de oficio es menor a la fecha de aceptación del cobro
				if($("#input_fecha_oficio").val() < $("#input_fecha_aceptacion").val()){
					cerrar_notificaciones()
					imprimir_notificacion("La fecha del oficio de la factura debe ser mayor o igual a la fecha de acpetación del cobro", "danger")

					return false
				}
			}

			// Si existen campos obligatorios sin diligenciar
			if(validar_campos_obligatorios(campos_obligatorios)) return false

			let datos = {
	    		"Fecha_Anuncio": $("#input_fecha_anuncio").val(),
	    		"Radicado_Anuncio": $("#input_radicado_anuncio").val(),
	    		"Fecha_Aceptacion": $("#input_fecha_aceptacion").val(),
	    		"Radicado_Aceptacion": $("#input_radicado_aceptacion").val(),
	    		"Fecha_Oficio": $("#input_fecha_oficio").val(),
	    		"Radicado_Oficio": $("#input_radicado_oficio").val(),
	    		"Fk_Id_Solicitud": $("#id_solicitud").val(),
			}
			// imprimir(datos, "tabla")

			// Elimina el registro de pago
			ajax("<?php echo site_url('solicitud/eliminar'); ?>", {"tipo": "pago", datos: {"Fk_Id_Solicitud": $("#id_solicitud").val()}}, 'HTML')

			// Si requiere pago, inserta el registro
			if($("#select_requiere_pago").val() == 1) ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "pago", "datos": datos}, 'HTML')

			cerrar_notificaciones()
			imprimir_notificacion("Los datos han sido guardados exitosamente", "success")
		}
	}

	$(document).ready(function(){
		($("#select_requiere_pago").val() == 1) ? $("#cont_datos_pago").show() : $("#cont_datos_pago").hide()

		$("#select_requiere_pago").on("change", function(){
			($("#select_requiere_pago").val() == 1) ? $("#cont_datos_pago").show() : $("#cont_datos_pago").hide()
		})
	})
</script>

<!-- Si tiene un pago -->
<?php if ($pago) { ?>
	<script type="text/javascript">
        $(document).ready(function(){
        	select_por_defecto("select_requiere_pago", "1")
        	$("#cont_datos_pago").show()

        	$("#input_fecha_anuncio").val("<?php echo $pago->Fecha_Anuncio; ?>")
            $("#input_radicado_anuncio").val("<?php echo $pago->Radicado_Anuncio; ?>")
        	$("#input_fecha_aceptacion").val("<?php echo $pago->Fecha_Aceptacion; ?>")
            $("#input_radicado_aceptacion").val("<?php echo $pago->Radicado_Aceptacion; ?>")
        	$("#input_fecha_oficio").val("<?php echo $pago->Fecha_Oficio; ?>")
            $("#input_radicado_oficio").val("<?php echo $pago->Radicado_Oficio; ?>")

        })
    </script> 
<?php } ?>