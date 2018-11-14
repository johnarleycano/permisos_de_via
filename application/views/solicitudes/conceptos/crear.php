<!-- Consulta de la solicitud -->
<?php $solicitud = $this->solicitud_model->obtener("solicitud", $id_solicitud); ?>

<form id="cont_concepto">
    <div class="uk-column-1-2@s">
		<div class="uk-margin">
        	<label class="uk-form-label" for="input_radicado_ani">Radicado ANI *</label>
	        <div class="uk-form-controls">
                <input class="uk-input" type="text" id="input_radicado_ani" title="Radicado ANI" autofocus>
	        </div>
	    </div>

		<div class="uk-margin">
        	<label class="uk-form-label" for="input_fecha_radicado_ani">Fecha *</label>
	        <div class="uk-form-controls">
                <input class="uk-input" type="date" id="input_fecha_radicado_ani" title="Fecha de emisión del radicado ANI">
	        </div>
	    </div>
	</div>

	<div class="uk-column-1-2@s">
		<div class="uk-margin">
        	<label class="uk-form-label" for="input_radicado_proyecto">Radicado <?php echo $solicitud->Proyecto; ?> *</label>
	        <div class="uk-form-controls">
                <input class="uk-input" type="text" id="input_radicado_proyecto" title="Radicado {proyecto}">
	        </div>
	    </div>

		<div class="uk-margin">
        	<label class="uk-form-label" for="input_fecha_radicado_proyecto">Fecha *</label>
	        <div class="uk-form-controls">
                <input class="uk-input" type="date" id="input_fecha_radicado_proyecto" title="Fecha de emisión del radicado de {proyecto}">
	        </div>
	    </div>
	</div>

	<div class="uk-column-1-1@s">
		<div class="uk-margin">
        	<label class="uk-form-label" for="input_fecha_asignacion">Fecha de asignación al área *</label>
	        <div class="uk-form-controls">
                <input class="uk-input" type="date" id="input_fecha_asignacion" title="Fecha de asignación">
	        </div>
	    </div>
	</div>

	<div class="uk-column-1-2@s">
		<div class="uk-margin">
        	<label class="uk-form-label" for="input_instrucciones">Instrucciones *</label>
            <textarea class="uk-textarea" id="input_instrucciones" rows="2" title="Instrucciones"></textarea>
	    </div>

		<div class="uk-margin">
        	<label class="uk-form-label" for="input_observaciones_concepto">Observaciones *</label>
            <textarea class="uk-textarea" id="input_observaciones_concepto" rows="2" title="Observaciones"></textarea>
	    </div>
	</div>

	<div class="uk-column-1-2@s">
		<div class="uk-margin">
        	<label class="uk-form-label" for="select_viable">Concepto de viabilidad *</label>
	        <div class="uk-form-controls">
                <select class="uk-select" id="select_viable" title="Sector">
	            	<option value="0">No viable</option>
	            	<option value="1">Viable</option>
	            </select>
	        </div>
	    </div>

		<div class="uk-margin">
        	<label class="uk-form-label" for="input_fecha_viabilidad">Fecha *</label>
	        <div class="uk-form-controls">
                <input class="uk-input" type="date" id="input_fecha_viabilidad" title="Fecha de emisión del concepto de viabilidad">
	        </div>
	    </div>
	</div>

    <button class="uk-button uk-button-default uk-modal-close" type="button" onClick="javascript:cerrar_interfaz()">Cancelar</button>
    <input class="uk-button uk-button-primary" type="submit" value="Agregar"/>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("form").on("submit", function(){
            guardar_concepto();

            return false;
        });
    });
</script>