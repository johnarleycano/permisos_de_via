<div class="uk-width-1-6">
	<ul class="uk-tab-left" id="cont_opciones" uk-tab>
		<li class="uk-active"><a onCLick="javascript:cargar('solicitud')"><span uk-icon="icon: receiver; ratio: 0.7"></span> Solicitud</a></li>
        <li><a onClick="javascript:cargar('facturacion');"><span uk-icon="icon: credit-card; ratio: 0.7"></span> Facturación</a></li>
        <li><a onClick="javascript:cargar('aceptacion');"><span uk-icon="icon: check; ratio: 0.7"></span> Aceptación</a></li>
    </ul>
	<hr>

    <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" type="button" id="btn_reporte" onCLick="javascript:generar('concepto', <?php echo $id_solicitud; ?>)"><span class="uk-text-success">REPORTE</span></button>
    
	<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" onClick="javascript:guardar();">Guardar</button>
</div>

<div class="uk-width-5-6">
	<div id="cont_pago"></div>
</div>

<script type="text/javascript">
	function cargar(tipo = "solicitud")
	{
		// Si se va a cambiar de opción y no se ha diligenciado la fecha de la solicitud
		if(tipo != "solicitud" && ($("#input_fecha_solicitud").val() == 0 || $("#input_radicado_solicitud").val() == 0)){
			cerrar_notificaciones()
			imprimir_notificacion("Antes de continuar, por favor adicione la fecha y radicado de la solicitud.", "danger")

			return false
		}

		if(tipo == "aceptacion"){
			// Se consulta si hay pago registrado para esa solicitud y la solicitud
			let pago = ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "pago", "id": $("#id_solicitud").val()}, 'JSON')
			let solicitud = ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "solicitud", "id": $("#id_solicitud").val()}, 'JSON')

			// Si tiene pago registrado
			if(pago){
				// Si no tiene radicado de oficio con factura
				if($.trim(pago.Radicado_Oficio) == ""){
					// No se puede configurar la aceptación
					cerrar_notificaciones()
					imprimir_notificacion("Antes de continuar, por favor indique los datos de la faturación.", "danger")

					return false
				}
			} else {
				// Si no tiene fecha de oficio de la solicitud
				if($.trim(solicitud.Radicado_Solicitud) == ""){
					// No se puede configurar la aceptación
					cerrar_notificaciones()
					imprimir_notificacion("Antes de continuar, por favor indique los datos de la solicitud del permiso.", "danger")

					return false
				}
			}
		}

		// Carga de interfaz
    	$("#cont_pago").load("<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `pago_${tipo}`, "id_solicitud": $("#id_solicitud").val()})
	}


	$(document).ready(function(){
		// Se desactiva el botón para generar el reporte si no se ha guardado la solicitud
		if($("#id_solicitud").val() == 0) $("#btn_reporte").addClass("uk-disabled")

		cargar()
	})
</script>