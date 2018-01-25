<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear()" value="Agregar participante" type="button" />

<div id="cont_crear"></div>
<hr>
<div id="cont_lista"></div>

<script type="text/javascript">
	/**
	 * Cierra la ventana de creación
	 * y vuelve a poner el botón
	 * 
	 * @return {void}
	 */
	function cerrar_participante()
	{
		imprimir("cerrando participante")
		$("input[type='button']").show();
		$("#cont_participante").hide();
	}

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
			imprimir_notificacion("Antes de crear participantes, por favor guarde la solicitud.", "danger");

			return false;
		}
		
		$("input[type='button']").hide();
		
        cargar_interfaz("cont_crear", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "participantes_creacion"});
	}

	/**
	 * Envía a la base de datos la información del
	 * participante que se está creando
	 * 
	 * @return {int}
	 */
	function guardar_participante()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Agregando el participante...");

		campos_obligatorios = {
			"select_funcionario": $("#select_funcionario").val(),
		}
		// imprimir(campos_obligatorios);

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)){
			return false;
		}

		// Si ya existe el participante en esa solicitud, no se puede agregar.
		existe = ajax("<?php echo site_url('solicitud/obtener'); ?>", {"tipo": "participante", "id_solicitud": $("#id_solicitud").val(), "id_funcionario": $("#select_funcionario").val()}, 'JSON');

		if (existe) {
			cerrar_notificaciones();
			imprimir_notificacion( `Ya es participante de esta solicitud. No se puede agregar nuevamente.`, "danger");

			return false;
		}
		
		datos = {
	    	"Fk_Id_Funcionario": $("#select_funcionario").val(),
	    	"Fk_Id_Solicitud": $("#id_solicitud").val(),
	    	"Fecha": "<?php echo date("Y-m-d h:i:s"); ?>",
	    	// "Fk_Id_Usuario": "<?php // echo $this->session->userdata('Pk_Id_Usuario'); ?>",
	    }
	    // imprimir(datos);
	    
	    // Inserción en base de datos vía Ajax
	    ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "participante", "datos": datos}, 'HTML');
        
		cerrar_participante();
		 
	    cerrar_notificaciones();
		imprimir_notificacion(`${$("#select_funcionario option:selected").text()} Se ha agregado como participante correctamente.`, `success`);

		$("input[type='button']").show();

		listar_participantes();
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar_participantes()
	{
        cargar_interfaz("cont_lista", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "participantes_listado", "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar_participantes();
	});
</script>