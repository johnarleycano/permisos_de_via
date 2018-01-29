<div id="cont_agregar_documento"></div>
<hr>
<div id="cont_lista_documentos"></div>

<script type="text/javascript">
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
			imprimir_notificacion("Antes de agregar un archivo, por favor guarde la solicitud.", "danger");

			return false;
		}
		
		$("input[type='button']").hide();
		
        cargar_interfaz("cont_agregar_documento", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "documentos_creacion"});
	}

	$(document).ready(function(){
		crear();
	});
</script>