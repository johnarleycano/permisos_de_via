<?php $solicitudes = $this->solicitud_model->obtener("solicitudes"); ?>

<?php foreach ($solicitudes as $solicitud) { ?>
	<article class="uk-comment" onCLick="javascript:editar(<?php echo $solicitud->Pk_Id; ?>);">
	    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
	        <div class="uk-width-expand">
	            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" onCLick="#"><?php echo $solicitud->Peticionario; ?></a></h4>
	            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
	                <li><a onCLick="#"><?php echo $this->configuracion_model->obtener("formato_fecha", $solicitud->Fecha_Solicitud); ?></a></li>
	                <li><a onCLick="#">DETALLES</a></li>
	            </ul>
	        </div>
	    </header>
	    <div class="uk-comment-body">
	        <p><?php echo $solicitud->Objeto; ?></p>
	    </div>
	</article>

	<hr class="uk-divider-icon">
<?php } ?>