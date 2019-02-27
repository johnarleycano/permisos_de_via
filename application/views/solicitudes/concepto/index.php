<!-- Tabs de opciones -->
<div class="uk-width-1-6">
    <!-- Reporte -->
    <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" type="button" id="btn_reporte" onCLick="javascript:generar('concepto', <?php echo $id_solicitud; ?>)"><span class="uk-text-success">REPORTE</span></button>
</div>

<div class="uk-width-5-6">	
	<div id="cont_lista"></div>
</div>

<script type="text/javascript">
	/**
	 * Envía a la base de datos la información del concepto
	 * que se está creando
	 * 
	 * @return {int}
	 */
	function guardar()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Guardando cambios...")

		let campos_obligatorios = {
			"input_radicado_ani": $("#input_radicado_ani").val(),
			"input_fecha_radicado_ani": $("#input_fecha_radicado_ani").val(),
			"input_radicado_proyecto": $("#input_radicado_proyecto").val(),
			"input_fecha_radicado_proyecto": $("#input_fecha_radicado_proyecto").val(),
			"input_fecha_asignacion": $("#input_fecha_asignacion").val(),
			"input_fecha_viabilidad": $("#input_fecha_viabilidad").val(),
		}
		// imprimir(campos_obligatorios)

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)) return false

		const datos = {
			"Fk_Id_Solicitud": $("#id_solicitud").val(),
			"Radicado_ANI": $("#input_radicado_ani").val(),
			"Radicado_Proyecto": $("#input_radicado_proyecto").val(),
			"Fecha_Radicado_ANI": $("#input_fecha_radicado_ani").val(),
			"Fecha_Radicado_Proyecto": $("#input_fecha_radicado_proyecto").val(),
			"Fecha_Asignacion": $("#input_fecha_asignacion").val(),
			"Instrucciones": $("#input_instrucciones").val(),
			"Observaciones": $("#input_observaciones").val(),
			"Viable": $("#select_viable").val(),
			"Fecha_Viabilidad": $("#input_fecha_viabilidad").val(),
		}
		// imprimir(datos)

		// Se consulta el concepto
		let concepto = ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "concepto", "id": $("#id_solicitud").val()}, 'JSON')

		// Si el concepto existe
		if(concepto){
			// Se actualiza el registro
			algo = ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "concepto", "datos": datos, "id_concepto": concepto.Pk_Id}, 'HTML')
		} else {
			// Se inserta el registro
			algo = ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "concepto", "datos": datos}, 'HTML')
		}
		// imprimir(algo)

		cerrar_notificaciones()
		imprimir_notificacion(`Los datos han sido actualizados correctamente.`, `success`)
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar(tipo)
	{
		cargar_interfaz(`cont_lista`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `concepto_crear`, "id_solicitud": $("#id_solicitud").val()})
	}

	$(document).ready(function(){
		listar()
	})
</script>