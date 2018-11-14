<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear_bitacora()" value="Agregar registro" type="button" id="btn_bitacora" />
<div id="cont_crear_bitacora"></div>
<hr>
<div id="cont_lista_bitacora"></div>

<!-- Modal eliminar -->
<div id="modal_eliminar" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Advertencia</h2>
        <p>¿Está seguro de eliminar el registro en bitácora?</p>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button" onClick="javascript:eliminar()">Eliminar</button>
        </p>
        <input type="hidden" id="id_bitacora">
    </div>
</div>

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

	function eliminar(id = null)
	{
		if(id){
			$("#id_bitacora").val(id)
			UIkit.modal("#modal_eliminar").show()
			return false
		}

		cerrar_notificaciones();
		imprimir_notificacion(`<div uk-spinner></div> Eliminando registro ${$("#id_bitacora").val()}...`)

		// Se elimina el registro
		let eliminar = ajax("<?php echo site_url('solicitud/eliminar'); ?>", {"tipo": "bitacora", "datos": {"Pk_Id": $("#id_bitacora").val()}}, 'HTML')
		
		// Si se elimina
		if(eliminar){
			listar_bitacora()
			UIkit.modal("#modal_eliminar").hide()

			cerrar_notificaciones();
			imprimir_notificacion(`Registro eliminado con éxito`, `success`)
		}
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