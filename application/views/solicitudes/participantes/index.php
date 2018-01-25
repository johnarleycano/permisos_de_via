<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear()" value="Agregar participante" />

<div id="cont_crear"></div>
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
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de crear participantes, por favor guarde la solicitud.", "danger");

			return false;
		}
		
        cargar_interfaz("cont_crear", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "participantes_creacion"});
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar_aprticipantes()
	{
        cargar_interfaz("cont_lista", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "participantes_listado", "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar_aprticipantes();
	});
</script>