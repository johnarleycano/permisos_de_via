<?php
// Recorrido de las solicitudes
foreach ($this->solicitud_model->obtener("solicitudes") as $solicitud) {
	// Fecha
	$fecha = $this->configuracion_model->obtener("formato_fecha", $solicitud->Fecha);
?>
	<article class="uk-comment">
	    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
	        <div class="uk-width-expand">
	            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" onCLick="javascript:editar(<?php echo $solicitud->Pk_Id; ?>);"><?php echo $solicitud->Peticionario; ?></a></h4>
	            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
	                <li><a href="<?php echo site_url('solicitud/index/').$solicitud->Pk_Id; ?>"><?php echo "{$fecha['mes_texto']} {$fecha['dia']}, {$fecha['anio']}"; ?></a></li>
	                <li><a onCLick="javascript:editar(<?php echo $solicitud->Pk_Id; ?>);">VER</a></li>
	                <li><a onCLick="javascript:generar_reporte('concepto', <?php echo $solicitud->Pk_Id; ?>)" class="uk-text-success"><i class="fas fa-file-excel"></i> CONCEPTO TÉCNICO</a></li>
	                <li><a onCLick="javascript:generar_reporte('observaciones', <?php echo $solicitud->Pk_Id; ?>)" class="uk-text-success"><i class="fas fa-file-excel"></i> OBSERVACIONES</a></li>
	            </ul>
	        </div>
	    </header>
	    
	    <div class="uk-comment-body" style="cursor: pointer;" onCLick="javascript:editar(<?php echo $solicitud->Pk_Id; ?>);">
	        <p><?php echo $solicitud->Objeto; ?></p>
	    </div>
	</article>

	<hr class="uk-divider-icon">
<?php } ?>

<script type="text/javascript">
	/**
	 * Modifica la información de la interfaz
	 * 
	 * @param  {int} id_solicitud 	Id de la solicitud
	 * 
	 * @return {void}
	 */
	function editar(id_solicitud)
	{
		redireccionar(`<?php echo site_url('solicitud/index') ?>/${id_solicitud}`);
	}

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

		switch(tipo) {
			case 'concepto':
				redireccionar(`<?php echo site_url("reportes/excel/concepto/"); ?>${id}`)
		    break

		    case 'observaciones':
				redireccionar(`<?php echo site_url("reportes/excel/observaciones/"); ?>${id}`)
		    break
		}

		cerrar_notificaciones()
	}
</script>