<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear()" value="Agregar" />

<div id="cont_modal"></div>
<div id="cont_lista"></div>

<script type="text/javascript">
	/**
	 * Interfaz para crear un registro mediante
	 * una ventana emergente
	 * 
	 * @return {void}
	 */
	function crear()
	{
		// Si no se ha guardado la solicitud, no puede guardar el participante
		if (!$("#id_solicitud").val()) {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de crear participantes, por favor guarde la solicitud.", "danger");

			return false;
		}
		
        cargar_interfaz("cont_modal", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "participantes_creacion"});
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @param  {int} id_solicitud 		Id de la solicitud
	 * 
	 * @return {void}              
	 */
	function listar()
	{
        cargar_interfaz("cont_lista", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "participantes_listado", "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar($("#id_solicitud").val());
	});
</script>