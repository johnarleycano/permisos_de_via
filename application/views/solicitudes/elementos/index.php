<div id="cont_crear_elemento"></div>
<hr>
<div id="cont_lista_elementos"></div>

<script type="text/javascript">
	/**
	 * Envía a la base de datos la información del elemento
	 * que se está creando
	 * 
	 * @return {int}
	 */
	function guardar_elemento()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Actualizando información de los elementos...")

		const id_solicitud = $("#id_solicitud").val()

		// Si no se ha guardado la solicitud, no puede guardar el elemento
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de crear un registro, por favor guarde la solicitud.", "danger");
			
			return false;
		}

		const datos = []

		// Se recorren los campos
		$.each($("input[data-tipo^='abscisa']"), function(i, l){
			var id_elemento = $(this).attr('id')
			
			if($(this).val() != ""){

				var dato = {
					"Fk_Id_Solicitud": id_solicitud,
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

				cerrar_notificaciones();
				imprimir_notificacion("Los datos se actualizaron con éxito.", "success");
			}
		})
	}

	$(document).ready(function(){
		cargar_interfaz(`cont_crear_elemento`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `elementos_creacion`, "id_solicitud": "<?php echo $id_solicitud; ?>"})
	})
</script>