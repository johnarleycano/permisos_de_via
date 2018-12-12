<!-- Tabs de opciones -->
<div class="uk-width-1-6">
	<div id="cont_lista_conceptos"></div>
	<hr>
	
	<!-- Nuevo concepto -->
	<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" value="Nuevo concepto" type="button" id="btn_concepto" />

    <!-- Reporte -->
    <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" type="button" id="btn_reporte" onCLick="javascript:generar('concepto', <?php echo $id_solicitud; ?>)"><span class="uk-text-success">REPORTE</span></button>
</div>

<div class="uk-width-5-6">	
	<div id="cont_detalle_conceptos"></div>
</div>

<script type="text/javascript">
	/**
	 * Interfaz para crear un registro
	 * 
	 * @return {void}
	 */
	function crear(id = 0)
	{
		// Interfaz de detalle de los conceptos
        cargar_interfaz(`cont_detalle_conceptos`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `conceptos_crear`, "id_concepto": id, "id_solicitud": $("#id_solicitud").val()})

		return false

		// Si el concepto no se ha guardado
		if($("#id_concepto").val() == 0){
			cerrar_notificaciones()
			imprimir_notificacion("No puede crear un concepto nuevo. Primero debe guardar los cambios.", "danger")

			return false
		}

		// Interfaz de detalle de los conceptos
        cargar_interfaz(`cont_detalle_conceptos`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `conceptos_crear`, "id_concepto": id, "id_solicitud": $("#id_solicitud").val()})

		let id_concepto

		// Si no trae ningún id
		if(!id) {
			// Se consulta el último concepto creado para esta solicitud
			const concepto = ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "ultimo_concepto", "id": $("#id_solicitud").val()}, 'JSON')
			
			// Se almacena el id del concepto
			id_concepto = (concepto.Pk_Id) ? concepto.Pk_Id : 0

			// Interfaz de detalle de los conceptos
	        cargar_interfaz(`cont_detalle_conceptos`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `conceptos_crear`, "id_concepto": id_concepto, "id_solicitud": $("#id_solicitud").val()})

			return false
		}

		// Interfaz de detalle de los conceptos
        cargar_interfaz(`cont_detalle_conceptos`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `conceptos_crear`, "id_concepto": id, "id_solicitud": $("#id_solicitud").val()})
	}

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
		
		// Si el concepto no se ha guardado
		if($("#id_concepto").val() == 0){
	    	datos.Fecha = "<?php echo date("Y-m-d h:i:s"); ?>"

			// Inserción en base de datos vía Ajax
			id_concepto = ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "concepto", "datos": datos}, 'HTML')

			// Se pone el nuevo id del concepto
			$("#id_concepto").val(id_concepto)
		} else {
			// Actualización de registro en base de datos
		    ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "concepto", "datos": datos, "id_concepto": $("#id_concepto").val()}, 'HTML')
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
		// imprimir("Listando conceptos...")
		// imprimir(`ítem ${item}`)
		// Interfaz del listado de conceptos
        cargar_interfaz(`cont_lista_conceptos`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `conceptos_lista`, "id_solicitud": $("#id_solicitud").val()})
	}

	$(document).ready(function(){
		
		$("#btn_concepto").on("click", function(){
			// Se consulta el último concepto creado para esta solicitud
			const concepto = ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "ultimo_concepto", "id": $("#id_solicitud").val()}, 'JSON')

			// Si el concepto es viable
			if(concepto.Viable == 1){
				cerrar_notificaciones()
				imprimir_notificacion("Ya se ha dado concepto de viabilidad para este solicitud. No puede emitir más conceptos", "danger")

				return false
			}

			// Se muestra el nuevo ítem y se pone como activo
			$("li").removeClass("uk-active")
			$(`#item_${$("#ultimo_contador").val()}`).addClass("uk-active")
			$(`#item_${$("#ultimo_contador").val()}`).removeClass("uk-hidden")

			crear()
		})

		listar()
	})
</script>