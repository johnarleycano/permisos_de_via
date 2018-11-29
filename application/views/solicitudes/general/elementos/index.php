<div id="cont_lista"></div>

<script type="text/javascript">
	/**
	 * Envía a la base de datos la información del elemento
	 * que se está creando
	 * 
	 * @return {int}
	 */
	function guardar()
	{
		cerrar_notificaciones()
		imprimir_notificacion("<div uk-spinner></div> Actualizando información de los elementos...")

		const datos = []

		// Se recorren los campos
		$.each($("input[data-tipo^='abscisa']"), function(i, l){
			// Id del elemento
			var id_elemento = $(this).attr('id')
			
			// Si hay información digitada
			if($(this).val() != ""){
				var dato = {
					"Fk_Id_Solicitud": $("#id_solicitud").val(),
					"Fk_Id_Elemento": id_elemento,
				}

				// Si el registro existe
				let registro = ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "elemento_solicitud", "id": dato}, 'JSON')

				// Abscisa inicial o final
				if($(this).attr("data-tipo") == "abscisa_inicial"){
					dato["Abscisa_Inicial"] = $(this).val()
				} else {
					dato["Abscisa_Final"] = $(this).val()
				}
				
				// Si existe el registro
				if(registro) {
					// Se actualiza
					ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "elemento_solicitud", "id": registro.Pk_Id, "datos": dato}, 'HTML')
				} else {
					// Se crea el registro
					ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "elemento_solicitud", "datos": dato}, 'HTML')
				}

				cerrar_notificaciones()
				imprimir_notificacion("Los datos se actualizaron con éxito.", "success")
			}
		})
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar(tipo)
	{
		cargar_interfaz(`cont_lista`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `general_elementos_crear`, "id_solicitud": $("#id_solicitud").val()})
	}

	$(document).ready(function(){
		listar()
	})
</script>