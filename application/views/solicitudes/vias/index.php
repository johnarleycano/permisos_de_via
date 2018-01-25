<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear()" value="Agregar vía" type="button" />

<div id="cont_crear_via"></div>
<hr>
<div id="cont_lista_vias"></div>

<script type="text/javascript">
	/**
	 * Cierra la ventana de creación
	 * y vuelve a poner el botón
	 * 
	 * @return {void}
	 */
	function cerrar()
	{
		$("input[type='button']").show();
		$("#cont_via").hide();
	}

	/**
	 * Interfaz para crear un registro
	 * 
	 * @return {void}
	 */
	function crear()
	{
		$("input[type='button']").hide();

		// Si no se ha guardado la solicitud, no puede guardar el participante
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de agregar una vía, por favor guarde la solicitud.", "danger");

			return false;
		}
		
        cargar_interfaz("cont_crear_via", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "vias_creacion"});
	}

	/**
	 * Envía a la base de datos la información de la
	 * vía que se está creando
	 * 
	 * @return {int}
	 */
	function guardar()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Agregando la vía...");

		campos_obligatorios = {
			"select_costado": $("#select_costado").val(),
		}
		// imprimir(campos_obligatorios);

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)){
			return false;
		}

		datos = {
	    	"Fk_Id_Costado": $("#select_costado").val(),
	    	"Observaciones": $("#input_observaciones").val(),
	    	"Fk_Id_Solicitud": $("#id_solicitud").val(),
	    	"Abscisa_Inicial": $("#input_abscisa_inicial").val(),
	    	"Abscisa_Final": $("#input_abscisa_final").val(),
	    	"Fecha": "<?php echo date("Y-m-d h:i:s"); ?>",
	    	// "Fk_Id_Usuario": "<?php // echo $this->session->userdata('Pk_Id_Usuario'); ?>",
	    }
	    imprimir(datos);
	    
	    // Inserción en base de datos vía Ajax
	    ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "via", "datos": datos}, 'HTML');

		cerrar();

		cerrar_notificaciones();
		imprimir_notificacion(`El costado ${$("#select_costado option:selected").text()} de la vía ${$("#select_via option:selected").text()} se ha agregado correctamente.`, `success`);

		$("input[type='button']").show();

		listar_vias();
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar_vias()
	{
		imprimir("Entrando a listado")
        cargar_interfaz("cont_lista_vias", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "vias_listado", "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar_vias();
	});
</script>