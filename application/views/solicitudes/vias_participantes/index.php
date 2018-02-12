<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear('via')" value="Agregar vía" type="button" id="btn_via" />
<div id="cont_crear_via"></div>
<div id="cont_lista_vias"></div>

<hr>

<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear('participante')" value="Agregar participante" type="button" id="btn_participante" />
<div id="cont_crear_participante"></div>
<div id="cont_lista_participantes"></div>

<script type="text/javascript">
	/**
	 * Cierra la ventana de creación
	 * y vuelve a poner el botón
	 * 
	 * @return {void}
	 */
	function cerrar_interfaz(tipo)
	{
		$(`#btn_${tipo}`).show();
		$(`#cont_${tipo}`).hide('slow');
	}

	/**
	 * Interfaz para crear un registro
	 * 
	 * @return {void}
	 */
	function crear(tipo)
	{
		// Si no se ha guardado la solicitud, no puede guardar el participante
		if ($("#id_solicitud").val() == "0") {
			cerrar_notificaciones();
			imprimir_notificacion("Antes de crear un registro, por favor guarde la solicitud.", "danger");
			
			return false;
		}

		cargar_interfaz(`cont_crear_${tipo}`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `${tipo}s_creacion`})
		
		$(`#btn_${tipo}`).hide();
	}

	/**
	 * Envía a la base de datos la información de la
	 * vía que se está creando
	 * 
	 * @return {int}
	 */
	function guardar_registro(tipo)
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Creando registro...");

		switch(tipo) {
		    case 'via':
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
	        break;

		    case 'participante':
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
	        break;
		}

		// Inserción en base de datos vía Ajax
		ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": tipo, "datos": datos}, 'HTML');

		cerrar_interfaz(tipo);

		cerrar_notificaciones();
		imprimir_notificacion(`El registro se ha agregado correctamente.`, `success`);

		$(`#btn_${tipo}`).show();

		listar_registros(tipo);
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar_registros(tipo)
	{
        cargar_interfaz(`cont_lista_${tipo}s`, "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `${tipo}s_listado`, "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar_registros('via');
		listar_registros('participante');
	});
</script>