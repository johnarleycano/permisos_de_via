<div id="cont_lista_chequeo"></div>
<hr>

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
		// Si no se ha guardado la solicitud, no puede guardar el participante
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de modificar, por favor guarde la solicitud.", "danger");

			return false;
		}
		
		// Si no se ha guardado la solicitud, no puede guardar el participante
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de modificar, por favor guarde la solicitud.", "danger");

			return false;
		}

		$(`#aplica${id_tipo}`).attr(`checked`, !$(`#aplica${id_tipo}`).attr(`checked`))

		// Si está chequeado
		if($(`#aplica${id_tipo}`).attr("checked")){
			// Se activan opciones
			$(`#cumple${id_tipo}`).removeAttr('disabled')
			$(`#documento${id_tipo}, #editar${id_tipo}`).removeAttr('hidden')

			guardar_lista("aplica", id_tipo)
		} else {
			$(`#documento${id_tipo}, #editar${id_tipo}`).attr('hidden', true)
			$(`#cumple${id_tipo}`).attr('disabled', true)

			eliminar(id_tipo)
		}

		listar_chequeo()
	}

	/**
	 * Guarda los cambios en base de datos
	 * 
	 * @param  {string} tipo 		[Tipo de dato a guardar]
	 * @param  {int} 	id_tipo 	[Id del tipo de documento]
	 * 
	 * @return {void}-
	 */
	function guardar_lista(tipo, id)
	{
		const cumple = ($(`#cumple${id}`).is(":checked")) ? 1 : 0

		let datos = {
			"Fk_Id_Solicitud": $("#id_solicitud").val(),
			"Fk_Id_Tipo_Documento": id,
		}

		if (tipo == "cumple"){
			ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "lista_chequeo", "datos": datos, valor: {"Cumple": cumple}}, 'html'),
			cerrar_notificaciones(),
			imprimir_notificacion(`Se ha actualizado el valor de cumplimiento`, `success`)
		}

		if (tipo == "observacion"){
			ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "lista_chequeo", "datos": datos, valor: {"Observacion": $("#text_observacion").val()}}, 'html')
			imprimir($("#text_observacion").val())
			cerrar_notificaciones()
			imprimir_notificacion(`Se ha modificado la observación correctamente.`, `success`)
        	UIkit.modal("#modal_documento").hide();
		}

		if (tipo == "aplica"){
			datos["Cumple"] = cumple
			ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "lista_chequeo", "datos": datos}, 'html')
			cerrar_notificaciones(),
			imprimir_notificacion(`Se ha agregado el documento como requerimiento`, `success`)
		}
		
		listar_chequeo()
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
        
        listar_chequeo()

        return false
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
		cerrar_notificaciones();

		let datos = {
			"Fk_Id_Tipo_Documento": id_tipo,
			"Fk_Id_Solicitud": $("#id_solicitud").val(),
		}
		ajax("<?php echo site_url('solicitud/eliminar'); ?>", {"tipo": "lista_chequeo", "datos": datos}, 'html')
		imprimir_notificacion(`Se ha eliminado el documento como requerimiento`, `success`)
	}

	/**
	 * Interfaz para crear un registro
	 * 
	 * @return {void}
	 */
	function modificar(tipo, id)
	{
		// Si no se ha guardado la solicitud, no puede guardar el participante
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de modificar, por favor guarde la solicitud.", "danger");

			return false;
		}

		const contenedor = (tipo == "observacion") ? `${tipo}${id}` : "cont_modal"

        cargar_interfaz(contenedor, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `lista_chequeo_${tipo}`, "id_tipo": id, "id_solicitud": $("#id_solicitud").val()});
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar_chequeo()
	{
        cargar_interfaz("cont_lista_chequeo", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "lista_chequeo_listado", "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		// crear();
		listar_chequeo();

		// $("input[type='checkbox']").on("click", actualizar($(this)))
	});
</script>