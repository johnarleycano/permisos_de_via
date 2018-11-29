<div id="cont_lista"></div>

<script type="text/javascript">
	/**
	 * Marca, desmarca y oculta o muestra opciones
	 * del listado
	 * 
	 * @param  {int} 	id_tipo 	[Id del tipo de documento]
	 * 
	 * @return {void}
	 */
	function aplica(id_tipo) {
		// Se marca o desmarca el check si aplica o no
		$(`#aplica${id_tipo}`).attr(`checked`, !$(`#aplica${id_tipo}`).attr(`checked`))

		// Si está chequeado
		if($(`#aplica${id_tipo}`).attr("checked")){
			// Se activan opciones
			$(`#cumple${id_tipo}`).removeAttr('disabled')
			$(`#documento${id_tipo}, #editar${id_tipo}`).removeAttr('hidden')

			// Se guarda el cambio
			guardar("aplica", id_tipo)
		} else {
			$(`#documento${id_tipo}, #editar${id_tipo}`).attr('hidden', true)
			$(`#cumple${id_tipo}`).attr('disabled', true)

			// Se elimina el registro
			eliminar(id_tipo)
		}

		listar()
	}

	/**
	 * Elimina registros en base de datos
	 * 
	 * @param  {int} 	id_tipo 	[Id del tipo de documento]
	 * 
	 * @return {void}
	 */
	function eliminar(id_tipo)
	{
		cerrar_notificaciones()

		let datos = {
			"Fk_Id_Tipo_Documento": id_tipo,
			"Fk_Id_Solicitud": $("#id_solicitud").val(),
		}
		
		// Se elimina el registro
		ajax("<?php echo site_url('solicitud/eliminar'); ?>", {"tipo": "lista_chequeo", "datos": datos}, 'html')
		
		imprimir_notificacion(`Lista de chequeo actualizada correctamente.`, `success`)
	}

	/**
	 * Guarda los cambios en base de datos
	 * 
	 * @param  {string} tipo 		[Tipo de dato a guardar]
	 * @param  {int} 	id_tipo 	[Id del tipo de documento]
	 * 
	 * @return {void}-
	 */
	function guardar(tipo, id)
	{
		const cumple = ($(`#cumple${id}`).is(":checked")) ? 1 : 0

		let datos = {
			"Fk_Id_Solicitud": $("#id_solicitud").val(),
			"Fk_Id_Tipo_Documento": id,
		}
		// imprimir(datos, "tabla")

		switch(tipo) {
		    case 'cumple':
		        ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "lista_chequeo", "datos": datos, valor: {"Cumple": cumple}}, 'html')
				cerrar_notificaciones()
				imprimir_notificacion(`Lista de chequeo actualizada correctamente.`, `success`)
	        break

	        case 'observacion':
		        ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "lista_chequeo", "datos": datos, valor: {"Observacion": $("#text_observacion").val()}}, 'html')
				imprimir($("#text_observacion").val())
				cerrar_notificaciones()
				imprimir_notificacion(`Se ha modificado la observación correctamente.`, `success`)
	        	// UIkit.modal("#modal_documento").hide()
	        break

	   		case 'aplica':
	   			datos["Cumple"] = cumple
				ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "lista_chequeo", "datos": datos}, 'html')
				cerrar_notificaciones(),
				imprimir_notificacion(`Lista de chequeo actualizada correctamente.`, `success`)
	   		break
		}

		listar()
	}

	/**
     * Guarda los cambios en base de datos
     * 
     * @param  {string} tipo        [Tipo de dato a guardar]
     * @param  {int}    id_tipo     [Id del tipo de documento]
     * 
     * @return {void}
     */
    function guardar_observacion(id_tipo)
    {
        var datos = {
            "Fk_Id_Solicitud": $("#id_solicitud").val(),
            "Fk_Id_Tipo_Documento": id_tipo,
        }

        ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "lista_chequeo", "datos": datos, valor: {"Observacion": $("#input_observacion").val()}}, 'html')
        // imprimir(datos, "tabla")
        
        cerrar_notificaciones()
        imprimir_notificacion(`Se ha modificado la observación correctamente.`, `success`)
        
        listar()
    }

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar()
	{
		// Carga de interfaz
        cargar_interfaz("cont_lista", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "general_chequeo_listado", "id_solicitud": $("#id_solicitud").val()})
	}

	/**
	 * Interfaz para crear un registro
	 * 
	 * @return {void}
	 */
	function modificar(tipo, id)
	{
		const contenedor = (tipo == "observacion") ? `${tipo}${id}` : "cont_modal"

		// Carga de interfaz
        cargar_interfaz(contenedor, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `general_chequeo_${tipo}`, "id_tipo": id, "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar()
	})
</script>