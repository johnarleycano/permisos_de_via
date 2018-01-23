<!-- Id de la solicitud (cuando se cree el registro) -->
<input type="hidden" id="id_solicitud">

<form class="uk-form-horizontal uk-margin-large">
	<div class="uk-margin-medium-top">
		<ul class="uk-flex-center" data-uk-tab="{connect:'#my-id'}" uk-tab>
			<li class="uk-active"><a href="#info_general">General</a></li>
	        <li><a onCLick="javascript:listar('participantes')">Participantes</a></li>
	        <li><a onCLick="javascript:listar('via')">Vía</a></li>
	        <li><a onCLick="javascript:listar('documentos')">Documentación</a></li>
		</ul>
		<ul id="my-id" class="uk-switcher uk-margin">
			<li>
				<!-- <a href="#" id="autoplayer" data-uk-switcher-item="next"></a> -->
				<div id="cont_general"></div>
			</li>
			
			<li>
				<div id="cont_participantes"></div>
			</li>

			<li>
				<div class="uk-column-1-2@m uk-column-divider">
					<div id="cont_via"></div>
				</div>
			</li>

			<li>
				<div class="uk-column-1-2@m uk-column-divider">
					<div id="cont_documentos"></div>
				</div>
			</li>
		</ul>
	</div>
</form>

<script type="text/javascript">
	/**
	 * Envía información a base de datos
	 * 
	 * @return {void}
	 */
	function guardar()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Guardando la solicitud...");

		campos_obligatorios = {
			"select_proyecto": $("#select_proyecto").val(),
			"input_fecha": $("#input_fecha").val(),
			"select_sector": $("#select_sector").val(),
			"input_objeto": $("#input_objeto").val(),
			"input_alcance": $("#input_alcance").val(),
			"input_peticionario": $("#input_peticionario").val(),
			// "input_email": $("#input_email").val(),
		}
		// imprimir(campos_obligatorios);

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)){
			return false;
		}

		datos = {
	    	"Fk_Id_Proyecto": $("#select_proyecto").val(),
	    	"Fecha_Solicitud": $("#input_fecha").val(),
	    	"Fk_Id_Sector": $("#select_sector").val(),
	    	"Objeto": $("#input_objeto").val(),
	    	"Alcance": $("#input_alcance").val(),
	    	"Peticionario": $("#input_peticionario").val(),
	    	"Cedula": $("#input_cedula").val(),
	    	"Nit": $("#input_nit").val(),
	    	"Telefono": $("#input_telefono").val(),
	    	"Celular": $("#input_celular").val(),
	    	"Direccion": $("#input_direccion").val(),
	    	"Email": $("#input_email").val(),
	    	"Fecha": "<?php echo date("Y-m-d h:i:s"); ?>",
	    	// "Fk_Id_Usuario": "<?php // echo $this->session->userdata('Pk_Id_Usuario'); ?>",
	    }
	    // imprimir(datos);

	    id = ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "solicitud", "datos": datos}, 'HTML');

	    // Se pone el id en un campo para validar la demás información que se la asocie
	    $("#id_solicitud").val(id);

        cerrar_notificaciones();
		imprimir_notificacion("Los datos han sido guardados exitosamente", "success");

		return false;
	}
	
	/**
	 * Listado de las opciones en la creación
	 * de las solicitudes
	 * 
	 * @param  {string} tipo [tipo de información a cargar]
	 * 
	 * @return {void}
	 */
	function listar(tipo)
	{
        cargar_interfaz(`cont_${tipo}`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": tipo});
	}

	$(document).ready(function(){
		listar("general");
	});
</script>