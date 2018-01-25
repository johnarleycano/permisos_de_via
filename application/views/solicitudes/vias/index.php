<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onCLick="javascript:crear()">Agregar vía</button>

<div id="cont_crear_via"></div>
<div id="cont_lista_vias"></div>

<script type="text/javascript">
	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar_vias()
	{
        cargar_interfaz("cont_lista_vias", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "vias_listado", "id_solicitud": $("#id_solicitud").val()});
	}

	$(document).ready(function(){
		listar_vias();
	});
</script>