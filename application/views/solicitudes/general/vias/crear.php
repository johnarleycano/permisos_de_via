<div class="uk-column-1-3@m">
	<div class="uk-margin">
        <label class="uk-form-label" for="select_sector">Sector *</label>
        <select class="uk-select" id="select_sector" title="Sector" >
        	<option value="">Elija...</option>
        	<?php foreach ($this->configuracion_model->obtener("sectores_activos") as $sector) { ?>
                <option value="<?php echo $sector->Pk_Id ?>"><?php echo $sector->Codigo; ?></option>
        	<?php } ?>
        </select>
	</div>

	<div class="uk-margin">
    	<label class="uk-form-label" for="select_via">Vía *</label>
        <select class="uk-select" id="select_via" title="Vía">
        	<option value="">Elija primero un sector...</option>
        </select>
	</div>

	<div class="uk-margin">
    	<label class="uk-form-label" for="select_costado">Costado *</label>
        <select class="uk-select" id="select_costado" title="Costado">
        	<option value="">Elija primero una vía...</option>
        </select>
    </div>
</div>

<div class="uk-column-1-2@s">
	<div class="uk-margin">
    	<label class="uk-form-label" for="input_abscisa_inicial">PR Inicial</label>
        <input class="uk-input" type="number" id="input_abscisa_inicial" title="Abscisa inicial" min="0">
    </div>

	<div class="uk-margin">
    	<label class="uk-form-label" for="input_abscisa_final">PR Final</label>
        <input class="uk-input" type="number" id="input_abscisa_final" title="Abscisa inicial" min="0">
    </div>
</div>

<div class="uk-column-1-1@s">
	<label class="uk-form-label" for="input_observaciones">Observaciones</label>
    <textarea class="uk-textarea" id="input_observaciones" rows="2" title="Observaciones"></textarea>
</div>

<p>
	<button class="uk-button uk-button-default uk-modal-close" type="button" onClick="javascript:cerrar_interfaz()">Cancelar</button>
	<input class="uk-button uk-button-primary" type="submit" value="Agregar" onClick="javascript:guardar()"/>
</p>

<script type="text/javascript">
	$(document).ready(function(){
		// Cuando se elija el sector, se cargan las vías de ese sector
		$("#select_sector").on("change", function(){
			datos = {
				url: "<?php echo site_url('configuracion/obtener'); ?>",
				tipo: "vias",
				id: $(this).val(),
				elemento_padre: $("#select_sector"),
				elemento_hijo: $("#select_via"),
				mensaje_padre: "Elija primero un sector",
				mensaje_hijo: "Elija una vía"
			}
			cargar_lista_desplegable(datos)
			select_por_defecto("select_costado", "")
		})

		// Cuando se elija la vía, se cargan los costados de esa vía
		$("#select_via").on("change", function(){
			datos = {
				url: "<?php echo site_url('configuracion/obtener'); ?>",
				tipo: "costados",
				id: $(this).val(),
				elemento_padre: $("#select_via"),
				elemento_hijo: $("#select_costado"),
				mensaje_padre: "Elija primero una vía",
				mensaje_hijo: "Elija un costado"
			}
			cargar_lista_desplegable(datos)
		})
	})
</script>