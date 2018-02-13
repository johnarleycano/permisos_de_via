<!-- Se consulta el id de la solicitud, en caso de ser edición -->
<?php $id_solicitud = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ; ?>

<!-- Id de la solicitud (cuando se cree el registro) -->
<input type="hidden" id="id_solicitud" value="<?php echo $id_solicitud; ?>">

<form class="uk-form-horizontal uk-margin-large">
	<div class="uk-margin-medium-top">
		<ul class="uk-flex-center" data-uk-tab="{connect:'#my-id'}" uk-tab>
			<li class="uk-active"><a href="#info_general">General</a></li>
	        <li><a onClick="javascript:listar('vias');">Vías y participantes</a></li>
	        <li><a onClick="javascript:listar('lista_chequeo');">Lista de chequeo</a></li>
	        <li><a onClick="javascript:listar('conceptos');">Conceptos</a></li>
	        <li><a onClick="javascript:listar('bitacora');">Bitácora</a></li>
		</ul>
		<ul id="my-id" class="uk-switcher uk-margin">
			<li><div id="cont_general"></div></li>
			<li><div id="cont_vias"></div></li>
			<li><div id="cont_lista_chequeo"></div></li>
			<li><div id="cont_conceptos"></div></li>
			<li><div id="cont_bitacora"></div></li>
		</ul>
	</div>
</form>

<script type="text/javascript">
	/**
	 * Envía información a base de datos
	 * 
	 * @return {void}
	 */
	function guardar_general()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Guardando la solicitud...");

		campos_obligatorios = {
			"select_proyecto": $("#select_proyecto").val(),
			"select_sector": $("#select_sector").val(),
			"input_objeto": $("#input_objeto").val(),
			"input_alcance": $("#input_alcance").val(),
			"input_peticionario": $("#input_peticionario").val(),
		}
		// imprimir(campos_obligatorios);

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)){
			return false;
		}

		datos = {
	    	"Fk_Id_Proyecto": $("#select_proyecto").val(),
	    	"Fk_Id_Sector": $("#select_sector").val(),
	    	"Objeto": $("#input_objeto").val(),
	    	"Alcance": $("#input_alcance").val(),
	    	"Peticionario": $("#input_peticionario").val(),
	    	"Cedula": $("#input_cedula").val(),
	    	"Nit": $("#input_nit").val(),
	    	"Telefono": $("#input_telefono").val(),
	    	"Celular": $("#input_celular").val(),
	    	"Fk_Id_Tipo_Solicitud": $("#select_tipo").val(),
	    	"Direccion": $("#input_direccion").val(),
	    	"Email": $("#input_email").val(),
	    	"Fecha": "<?php echo date("Y-m-d h:i:s"); ?>",
	    	// "Fk_Id_Usuario": "<?php // echo $this->session->userdata('Pk_Id_Usuario'); ?>",
	    }
	    // imprimir(datos);
	    
	    // Se verifica si guarda o actualiza el registro
	    if ($("#id_solicitud").val() == "0") {
		    id = ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "solicitud", "datos": datos}, 'HTML');

		    // Se pone el id en un campo para validar la demás información que se la asocie
	    	$("#id_solicitud").val(id);
		} else {
		    ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "solicitud", "datos": datos, "id_solicitud": $("#id_solicitud").val()}, 'HTML');
		} 

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
        cargar_interfaz(`cont_${tipo}`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": tipo, "id_solicitud": <?php echo $id_solicitud; ?>});
	}

	$(document).ready(function(){
		listar("general");
	});
</script>