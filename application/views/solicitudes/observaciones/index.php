<!-- Tabs de opciones -->
<div class="uk-width-1-6">
	<div id="cont_lista_observaciones"></div>
	<hr>
	
	<!-- Nueva observación -->
	<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" value="Crear" type="button" id="btn_observacion" />

    <!-- Reporte -->
    <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" type="button" id="btn_reporte" onCLick="javascript:generar('concepto', <?php echo $id_solicitud; ?>)"><span class="uk-text-success">REPORTE</span></button>
</div>

<div class="uk-width-5-6">	
	<div id="cont_detalle_observaciones"></div>
</div>

<script type="text/javascript">
	/**
	 * Interfaz para crear un registro
	 * 
	 * @return {void}
	 */
	function crear(id = 0)
	{
		// Interfaz de detalle de las observaciones
        cargar_interfaz(`cont_detalle_observaciones`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `observaciones_crear`, "id_observacion": id, "id_solicitud": $("#id_solicitud").val()})

		// Si la observación no se ha guardado
		if($("#id_observacion").val() == 0){
			cerrar_notificaciones()
			imprimir_notificacion("No puede crear una nueva observación. Primero debe guardar los cambios.", "danger")

			return false
		}

		// Interfaz de detalle de las observaciones
        cargar_interfaz(`cont_detalle_observaciones`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `observaciones_crear`, "id_observacion": id, "id_solicitud": $("#id_solicitud").val()})
	}

	/**
	 * Envía a la base de datos la información de la observación
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
		}
		// imprimir(datos)
		
		// Si la observación no se ha guardado
		if($("#id_observacion").val() == 0){
	    	datos.Fecha = "<?php echo date("Y-m-d h:i:s"); ?>"
	    	datos.Fk_Id_Usuario = "<?php echo $this->session->userdata('Pk_Id_Usuario'); ?>"

			// Inserción en base de datos vía Ajax
			ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "observacion", "datos": datos}, 'HTML')

			// Se pone el nuevo id de la observación
			$("#id_observacion").val(id_observacion)
		} else {
			// Actualización de registro en base de datos
		    ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "observacion", "datos": datos, "id_observacion": $("#id_observacion").val()}, 'HTML')
		}

		listar()

		cerrar_notificaciones()
		imprimir_notificacion(`Los datos han sido actualizados correctamente.`, `success`)
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar()
	{
		// Interfaz del listado de observaciones
        cargar_interfaz(`cont_lista_observaciones`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `observaciones_lista`, "id_solicitud": $("#id_solicitud").val()})
	}

	$(document).ready(function(){
		$("#btn_observacion").on("click", function(){
			// Se muestra el nuevo ítem y se pone como activo
			$("li").removeClass("uk-active")
			$(`#item_${$("#ultimo_contador").val()}`).addClass("uk-active")
			$(`#item_${$("#ultimo_contador").val()}`).removeClass("uk-hidden")

			crear()
		})

		listar()
	})
</script>