<form class="uk-form-horizontal uk-margin-large" id="cont_participante">
    <!-- <h2 class="uk-modal-title">Participante</h2> -->
	<div class="uk-margin">
        <label class="uk-form-label" for="select_funcionario">Funcionario *</label>
        <div class="uk-form-controls">
            <select class="uk-select" id="select_funcionario" title="Funcionario" autofocus>
            	<option value="">Seleccione...</option>
            	<?php foreach($this->configuracion_model->obtener("funcionarios") as $funcionario){ ?>
	                <option value="<?php echo $funcionario->Pk_Id; ?>"><?php echo $funcionario->Nombre; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <button class="uk-button uk-button-default uk-modal-close" type="button" onClick="javsacript:cerrar()">Cancelar</button>
    <input class="uk-button uk-button-primary" type="button" value="Agregar" onClick="javascript:guardar();" />
</form>

<script type="text/javascript">
	/**
	 * Envía a la base de datos la información del
	 * participante que se está creando
	 * 
	 * @return {int}
	 */
	function guardar()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Agregando el participante...");

		campos_obligatorios = {
			"select_funcionario": $("#select_funcionario").val(),
		}
		imprimir(campos_obligatorios);

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
	    
	    ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "participante", "datos": datos}, 'HTML');
        
		$("#cont_participante").hide();
		 
	    cerrar_notificaciones();
		imprimir_notificacion(`Se ha agregado como participante correctamente.`, `success`);

		listar_participantes();
	}

	function cerrar()
	{
		$("#cont_participante").hide();
	}
</script>