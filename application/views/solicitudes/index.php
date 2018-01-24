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

	/**
	 * Modifica la información de la interfaz
	 * 
	 * @param  {int} id_solicitud 	Id de la solicitud
	 * 
	 * @return {void}
	 */
	function editar(id_solicitud)
	{
		redireccionar(`<?php echo site_url('solicitud/crear') ?>/${id_solicitud}`);
	}

	$(document).ready(function(){
		listar();
	});
</script>