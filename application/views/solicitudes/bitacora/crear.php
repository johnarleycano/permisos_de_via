<form id="cont_registro">
	<div class="uk-column-1-2@s">
		<div class="uk-margin">
			<div class="uk-margin">
		    	<label class="uk-form-label" for="input_fecha">Fecha *</label>
		        <div class="uk-form-controls">
		            <input class="uk-input" type="date" id="input_fecha" title="Fecha" autofocus>
		        </div>
		    </div>

        	<label class="uk-form-label" for="input_radicado_bitacora">Radicado</label>
	        <div class="uk-form-controls">
                <input class="uk-input" type="text" id="input_radicado_bitacora" title="Radicado">
	        </div>
	    </div>
    </div>

	<div class="uk-margin">
    	<!-- <label class="uk-form-label" for="input_detalle">Detalle *</label> -->
        <textarea class="uk-textarea" id="input_detalle" rows="2" title="Detalle" placeholder="Detalle del registro"></textarea>
    </div>

	<button class="uk-button uk-button-default uk-modal-close" type="button" onClick="javascript:cerrar_interfaz()">Cancelar</button>
    <input class="uk-button uk-button-primary" type="submit" value="Guardar"/>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("form").on("submit", function(){
            guardar_bitacora();

            return false;
        });
    });
</script>