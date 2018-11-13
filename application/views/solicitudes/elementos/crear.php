<form id="cont_elemento" class="uk-form-width-large uk-align-center">
	<div class="uk-grid-small" uk-grid>
		<div class="uk-width-1-2@s">
	        <h4><center>Elemento</center></h4>
	    </div>
	    <div class="uk-width-1-4@s">
	        <h4><center>PR Inicial</center></h4>
	    </div>
	    <div class="uk-width-1-4@s">
	        <h4><center>PR Final</center></h4>
	    </div>

		<?php
		foreach ($this->configuracion_model->obtener("elementos") as $elemento) {
			// Se consulta el registro
			$registro = $this->solicitud_model->obtener("elemento_solicitud", array("Fk_Id_Solicitud" => $id_solicitud, "Fk_Id_Elemento" => $elemento->Pk_Id));
		?>
		    <div class="uk-width-1-2@s">
		        <h5 class="uk-heading-line"><span><?php echo $elemento->Nombre; ?></span></h5>
		    </div>
		    <div class="uk-width-1-4@s">
		        <input class="uk-input" data-tipo="abscisa_inicial" id="<?php echo $elemento->Pk_Id ?>" type="number" min="0" value="<?php echo (isset($registro->Abscisa_Inicial)) ? $registro->Abscisa_Inicial : ''; ?>">
		    </div>
		    <div class="uk-width-1-4@s">
		        <input class="uk-input" data-tipo="abscisa_final" id="<?php echo $elemento->Pk_Id ?>" type="number" min="0" value="<?php echo (isset($registro->Abscisa_Final)) ? $registro->Abscisa_Final : ''; ?>">
		    </div>
		<?php } ?>
	</div>
	<br>

	<button class="uk-button uk-button-default uk-modal-close" type="button" onClick="javascript:cerrar_interfaz()">Cancelar</button>
    <input class="uk-button uk-button-primary" type="submit" value="Actualizar"/>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("form").on("submit", function(){
            guardar_elemento();

            return false;
        });
    });
</script>