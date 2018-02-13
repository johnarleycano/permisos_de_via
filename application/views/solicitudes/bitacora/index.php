<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear_bitacora()" value="Agregar registro" type="button" id="btn_bitacora" />
<div id="cont_crear_bitacora"></div>
<hr>
<div id="cont_lista_bitacora"></div>

<script type="text/javascript">
	/**
	 * Cierra la ventana de creación
	 * y vuelve a poner el botón
	 * 
	 * @return {void}
	 */
	function cerrar_interfaz()
	{
		$(`#btn_bitacora`).show('slow');
		$(`#cont_registro`).hide('slow');
	}

	/**
	 * Interfaz para crear un registro
	 * 
	 * @return {void}
	 */
	function crear_bitacora()
	{
		// Si no se ha guardado la solicitud, no puede guardar el participante
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de crear un registro, por favor guarde la solicitud.", "danger");
			
			return false;
		}

		cargar_interfaz(`cont_crear_bitacora`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `bitacora_creacion`})
		
		$(`#btn_bitacora`).hide()
	}

	/**
	 * Envía a la base de datos la información del registro
	 * que se está creando
	 * 
	 * @return {int}
	 */
	function guardar_bitacora()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Creando registro...")

		const campos_obligatorios = {
			"input_fecha": $("#input_fecha").val(),
			"input_detalle": $("#input_detalle").val(),
			"input_radicado_bitacora": $("#input_radicado_bitacora").val(),
		}
		// imprimir(campos_obligatorios)

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)){
			return false;
		}

		const datos = {
			"Fk_Id_Solicitud": $("#id_solicitud").val(),
	    	"Fecha": "<?php echo date("Y-m-d h:i:s"); ?>",
			"Fecha_Registro": $("#input_fecha").val(),
			"Detalle": $("#input_detalle").val(),
			"Radicado": $("#input_radicado_bitacora").val(),
		}
		// imprimir(datos)

		// Inserción en base de datos vía Ajax
		ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "bitacora", "datos": datos}, 'HTML');
		
		cerrar_interfaz();

		cerrar_notificaciones();
		imprimir_notificacion(`El registro en bitácora se ha agregado correctamente.`, `success`);

		listar_bitacora();
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar_bitacora()
	{
		cargar_interfaz("cont_lista_bitacora", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "bitacora_listado", "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar_bitacora();
	});
</script>