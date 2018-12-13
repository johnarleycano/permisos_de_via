<h1 class="uk-heading-line uk-text-center"><span>Normatividad</span></h1>

<!-- Recorrido de las normas -->
<?php foreach ($this->normatividad_model->obtener("normas") as $norma) { ?>
	<article class="uk-comment">
	    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
	        <div class="uk-width-expand">
	            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" onCLick="javascript:editar(<?php echo $norma->Pk_Id; ?>)"><?php echo "$norma->Numeral - $norma->Observacion"; ?></a></h4>
	            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
	                <li><a href="#"><?php echo "Resolución $norma->Resolucion"; ?></a></li>
	                <li><a onCLick="javascript:editar(<?php echo $norma->Pk_Id; ?>);">EDITAR</a></li>
	            </ul>
	        </div>
	    </header>
	    
	    <div class="uk-comment-body" style="cursor: pointer;" onCLick="javascript:editar(<?php echo $norma->Pk_Id; ?>);">
	        <p><?php echo $norma->Descripcion; ?></p>
	    </div>
	</article>

	<hr class="uk-divider-icon">
<?php } ?>

<script type="text/javascript">
	/**
	 * Modifica la información de la interfaz
	 * 
	 * @param  {int} id_norma 	Id de la norma
	 * 
	 * @return {void}
	 */
	function editar(id_norma)
	{
		redireccionar(`<?php echo site_url('normatividad/crear') ?>/${id_norma}`);
	}
</script>