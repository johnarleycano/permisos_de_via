<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear()" value="Agregar concepto" type="button" id="btn_concepto" />
<div id="cont_crear_concepto"></div>
<hr>
<div id="cont_lista_conceptos"></div>

<script type="text/javascript">
	/**
	 * Cierra la ventana de creación
	 * y vuelve a poner el botón
	 * 
	 * @return {void}
	 */
	function cerrar_interfaz(tipo)
	{
		$(`#btn_concepto`).show('slow');
		$(`#cont_concepto`).hide('slow');
	}

	/**
	 * Interfaz para crear un registro
	 * 
	 * @return {void}
	 */
	function crear()
	{
		// Si no se ha guardado la solicitud, no puede guardar el participante
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de crear un registro, por favor guarde la solicitud.", "danger");
			
			return false;
		}

		// Se consulta la cantidad de conceptos emitidos para la solicitud
		conceptos =  ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "conceptos", "id": $("#id_solicitud").val()}, 'JSON')

		// Si el último concepto concepto agregado fue viable, no se puede agregar otro concepto
		// imprimir(conceptos.pop.Viable)

		// Si la cantidad es 3, no se pueden emitir más conceptos
		if (conceptos.length == 3) {
			cerrar_notificaciones();
			imprimir_notificacion("Ha superado el máximo de conceptos emitidos para esta solicitud.", "danger");
			
			return false;
		}

		cargar_interfaz(`cont_crear_concepto`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `conceptos_creacion`})
		
		$(`#btn_concepto`).hide()
	}

	/**
	 * Envía a la base de datos la información del concepto
	 * que se está creando
	 * 
	 * @return {int}
	 */
	function guardar_concepto()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Creando concepto...")

		campos_obligatorios = {
			"input_radicado_ani": $("#input_radicado_ani").val(),
			"input_fecha_radicado_ani": $("#input_fecha_radicado_ani").val(),
			"input_radicado_proyecto": $("#input_radicado_proyecto").val(),
			"input_fecha_radicado_proyecto": $("#input_fecha_radicado_proyecto").val(),
			"input_fecha_asignacion": $("#input_fecha_asignacion").val(),
			"input_instrucciones": $("#input_instrucciones").val(),
			"input_observaciones": $("#input_observaciones").val(),
			"input_fecha_viabilidad": $("#input_fecha_viabilidad").val(),
		}
		// imprimir(campos_obligatorios)

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)){
			return false;
		}

		const datos = {
			"Fk_Id_Solicitud": $("#id_solicitud").val(),
			"Radicado_ANI": $("#input_radicado_ani").val(),
			"Radicado_Proyecto": $("#input_radicado_proyecto").val(),
	    	"Fecha": "<?php echo date("Y-m-d h:i:s"); ?>",
			"Fecha_Radicado_ANI": $("#input_fecha_radicado_ani").val(),
			"Fecha_Radicado_Proyecto": $("#input_fecha_radicado_proyecto").val(),
			"Fecha_Asignacion": $("#input_fecha_asignacion").val(),
			"Instrucciones": $("#input_instrucciones").val(),
			"Observaciones": $("#input_observaciones").val(),
			"Viable": $("#select_viable").val(),
			"Fecha_Viabilidad": $("#input_fecha_viabilidad").val(),
		}
		// imprimir(datos)

		// Inserción en base de datos vía Ajax
		ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "concepto", "datos": datos}, 'HTML');
		
		cerrar_interfaz();

		cerrar_notificaciones();
		imprimir_notificacion(`El concepto se ha agregado correctamente.`, `success`);

		$(`#btn_concepto`).show();

		listar_conceptos();
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar_conceptos()
	{
        cargar_interfaz(`cont_lista_conceptos`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `conceptos_listado`, "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar_conceptos()
	});
</script>