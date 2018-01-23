<div class="uk-container">
	<div id="cont_solicitudes"></div>
</div>

<script type="text/javascript">
	/**
	 * Listado de las solicitudes
	 * 
	 * @return [void]
	 */
	function listar()
	{
		cargar_interfaz("cont_solicitudes", "<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": "lista"});
	}

	$(document).ready(function(){
		listar();
	});
</script>