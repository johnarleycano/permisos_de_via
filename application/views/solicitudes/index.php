<div class="uk-container">
	<div id="cont_solicitudes"></div>
</div>

<script type="text/javascript">
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

		redireccionar(`<?php echo site_url("reportes/excel/concepto/"); ?>${id}`)

		cerrar_notificaciones();
	}

	/**
	 * Listado de las solicitudes
	 * 
	 * @return [void]
	 */
	function listar_solicitudes()
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
		listar_solicitudes();
	});
</script>