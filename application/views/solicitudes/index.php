<!-- Se consulta el id de la solicitud, en caso de ser edición -->
<?php $id_solicitud = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ; ?>

<!-- Id de la solicitud (cuando se cree el registro) -->
<input type="hidden" id="id_solicitud" value="<?php echo $id_solicitud; ?>">

<!-- Tabs de módulos -->
<div class="uk-form-horizontal">
	<ul class="uk-flex-center" data-uk-tab="{connect:'#modulos'}" uk-tab>
		<li class="uk-active"><a onCLick="javascript:cargar_modulo('general')">1. DATOS GENERALES</a></li>
        <li><a onClick="javascript:cargar_modulo('pago');">2. DATOS DEL PAGO</a></li>
        <li><a onClick="javascript:cargar_modulo('observaciones');">3. OBSERVACIONES</a></li>
        <li><a onClick="javascript:cargar_modulo('concepto');">4. CONCEPTO</a></li>
	</ul>

	<div id="cont_contenido" uk-grid></div>
</div>

<div class="uk-container">
	<div id="cont_solicitudes"></div>
</div>

<script type="text/javascript">
	/**
	 * Carga de la interfaz de acuerdo al módulo seleccionado
	 * 
	 * @param  {string} tipo [Tipo de módulo]
	 * 
	 * @return
	 */
	function cargar_modulo(tipo = "general")
	{
		// Id de la solicitud
		let id_solicitud = $("#id_solicitud").val()

		// Consulta de la solicitud
		let solicitud = ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "solicitud", "id": id_solicitud}, 'JSON')

		// Si se va a cambiar de opción y no se ha guardado la solicitud
		if(tipo != "general" && $("#id_solicitud").val() == 0){
			cerrar_notificaciones()
			imprimir_notificacion("Antes de continuar, por favor guarde los cambios.", "danger")

			return false
		}

		// Si va a entrar al concepto, si hizo el pago, pero no tiene radicado de aceptación del pago
		if(tipo == "concepto" && solicitud.Realizo_Pago == 1 && $.trim(solicitud.Radicado_Soporte_Aceptacion) == ""){
			cerrar_notificaciones()
			imprimir_notificacion("Antes de emitir el concepto, por favor indique los datos de aceptación del pago.", "danger")

			return false
		}

		// Si va a entrar a las observaciones, si hizo el pago, pero no tiene radicado de aceptación del pago
		if(tipo == "observaciones" && solicitud.Realizo_Pago == 1 && $.trim(solicitud.Radicado_Soporte_Aceptacion) == ""){
			cerrar_notificaciones()
			imprimir_notificacion("Antes de crear observaciones, por favor indique los datos de aceptación del pago.", "danger")

			return false
		}

		// Carga de interfaz
		switch(tipo) {
		    case 'general':
		    	$("#cont_contenido").load("<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": tipo, "id_solicitud": id_solicitud})
	        break;

		    case 'pago':
		    	$("#cont_contenido").load("<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": tipo, "id_solicitud": id_solicitud})
	        break;

		    case 'observaciones':
		    	$("#cont_contenido").load("<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": tipo, "id_solicitud": id_solicitud})
	        break;

		    case 'concepto':
		    	$("#cont_contenido").load("<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": tipo, "id_solicitud": id_solicitud})
	        break;
		}
	}

	/**
	 * Genera el reporte de acuerdo al tipo
	 * 
	 * @param  {string} tipo 
	 * @param  {int} id   Id de la solicitud
	 * 
	 * @return {void}      
	 */
	function generar_reporte(tipo, id)
	{
		cerrar_notificaciones();
        imprimir_notificacion("<div uk-spinner></div> Generando reporte...")

		switch(tipo) {
			case 'concepto':
				redireccionar(`<?php echo site_url("reportes/excel/concepto/"); ?>${id}`)
		    break

		    case 'observaciones':
				redireccionar(`<?php echo site_url("reportes/excel/observaciones/"); ?>${id}`)
		    break
		}

		cerrar_notificaciones()
	}

	$(document).ready(function(){
		cargar_modulo()
	})
</script>