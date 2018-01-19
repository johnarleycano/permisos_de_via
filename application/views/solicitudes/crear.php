<form class="uk-form-horizontal uk-margin-large">
	<div class="uk-margin-medium-top">
		<ul class="uk-flex-center" data-uk-tab="{connect:'#my-id'}" uk-tab>
			<li class="uk-active"><a href="#info_general">General</a></li>
	        <li><a href="#">Participantes</a></li>
	        <li><a href="#">Vía</a></li>
	        <li><a href="#">Documentación</a></li>
		</ul>
		<ul id="my-id" class="uk-switcher uk-margin">
				<li>
					<a href="#" id="autoplayer" data-uk-switcher-item="next"></a>
					
					<!-- <h4 class="uk-heading-line uk-text-right"><span>1. Lugar y fecha de la visita</span></h4> -->
					<div class="uk-column-1-2@m uk-column-divider">
					    <div class="uk-margin">
					        <label class="uk-form-label" for="select_proyecto">Proyecto *</label>
					        <div class="uk-form-controls">
					            <select class="uk-select" id="select_proyecto">
					                <option value="">Elija un proyecto</option>

					                <?php foreach($this->configuracion_model->obtener("proyectos") as $proyecto){ ?>
						                <option value="<?php echo $proyecto->Pk_Id; ?>"><?php echo $proyecto->Nombre; ?></option>
					                <?php } ?>
					            </select>
					        </div>
					    </div>

					    <div class="uk-margin">
					        <label class="uk-form-label" for="input_fecha">Fecha *</label>
					        <div class="uk-form-controls">
					            <input class="uk-input" type="date" id="input_fecha" title="Fecha">
					        </div>
					    </div>

					    <div class="uk-margin">
					        <label class="uk-form-label" for="select_municipio">Municipio *</label>
					        <div class="uk-form-controls">
					            <select class="uk-select" id="select_municipio">
					                <option value="">Elija un municipio</option>

					                <?php foreach($this->configuracion_model->obtener("municipios") as $municipio){ ?>
						                <option value="<?php echo $municipio->Pk_Id; ?>"><?php echo $municipio->Nombre; ?></option>
					                <?php } ?>
					            </select>
					        </div>
					    </div>

					    <div class="uk-margin">
					        <label class="uk-form-label" for="select_sector">Sector / Vereda / Barrio *</label>
					        <div class="uk-form-controls">
					            <select class="uk-select" id="select_sector" title="Sector">
					                <option value="">Elija primero un municipio</option>
					            </select>
					        </div>
					    </div>
					</div>

					<h4 class="uk-heading-line uk-text-right"><span>Información del permiso</span></h4>
					<div class="uk-column-1-2@m uk-column-divider">
					    <div class="uk-margin">
					        <label class="uk-form-label" for="input_objeto">Objeto *</label>
				            <textarea class="uk-textarea" id="input_objeto" rows="4"></textarea>
				        </div>

					    <div class="uk-margin">
					        <label class="uk-form-label" for="input_alcance">Alcance *</label>
				            <textarea class="uk-textarea" id="input_alcance" rows="4"></textarea>
				        </div>
					</div>

					<h4 class="uk-heading-line uk-text-right"><span>Identificación del peticionario</span></h4>
					<div class="uk-margin">
				        <label class="uk-form-label" for="input_peticionario">Nombre o razón social *</label>
				        <div class="uk-form-controls">
				            <input class="uk-input" type="input" id="input_peticionario" title="Nombre">
				        </div>
				    </div>

					<div class="uk-column-1-2@m uk-column-divider">
						<div class="uk-margin">
					        <label class="uk-form-label" for="input_cedula">Cédula de ciudadanía</label>
					        <div class="uk-form-controls">
					            <input class="uk-input" type="input" id="input_cedula" title="Cédula">
					        </div>
					    </div>

						<div class="uk-margin">
					        <label class="uk-form-label" for="input_nit">NIT</label>
					        <div class="uk-form-controls">
					            <input class="uk-input" type="input" id="input_nit" title="NIT">
					        </div>
					    </div>

						<div class="uk-margin">
					        <label class="uk-form-label" for="input_telefono">Número de teléfono fijo</label>
					        <div class="uk-form-controls">
					            <input class="uk-input" type="input" id="input_telefono" title="Celular">
					        </div>
					    </div>

						<div class="uk-margin">
					        <label class="uk-form-label" for="input_telefono">Número celular</label>
					        <div class="uk-form-controls">
					            <input class="uk-input" type="input" id="input_celular" title="Celular">
					        </div>
					    </div>

						<div class="uk-margin">
					        <label class="uk-form-label" for="input_direccion">Dirección</label>
					        <div class="uk-form-controls">
					            <input class="uk-input" type="input" id="input_direccion" title="Dirección">
					        </div>
					    </div>

						<div class="uk-margin">
					        <label class="uk-form-label" for="input_email">Correo electrónico *</label>
					        <div class="uk-form-controls">
					            <input class="uk-input" type="input" id="input_email" title="Correo electrónico">
					        </div>
					    </div>
					</div>
				</li>
				
				<li>
					<div class="uk-column-1-2@m uk-column-divider">
						Participantes
					</div>
				</li>

				<li>
					<div class="uk-column-1-2@m uk-column-divider">
						Datos de la vía
					</div>
				</li>

				<li>
					<div class="uk-column-1-2@m uk-column-divider">
						Documentos
					</div>
				</li>
		</ul>
	</div>

	<input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" value="Guardar">
	<button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom">Regresar</button>
</form>

<script type="text/javascript">
	function guardar()
	{
		cerrar_notificaciones();
		imprimir_notificacion("<div uk-spinner></div> Guardando la solicitud...");

		campos_obligatorios = {
			"select_proyecto": $("#select_proyecto").val(),
			"input_fecha": $("#input_fecha").val(),
			"select_sector": $("#select_sector").val(),
			"input_objeto": $("#input_objeto").val(),
			"input_alcance": $("#input_alcance").val(),
			"input_peticionario": $("#input_peticionario").val(),
			// "input_email": $("#input_email").val(),
		}
		// imprimir(campos_obligatorios);

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)){
			return false;
		}

		datos = {
	    	"Fk_Id_Proyecto": $("#select_proyecto").val(),
	    	"Fecha_Solicitud": $("#input_fecha").val(),
	    	"Fk_Id_Sector": $("#select_sector").val(),
	    	"Objeto": $("#input_objeto").val(),
	    	"Alcance": $("#input_alcance").val(),
	    	"Peticionario": $("#input_peticionario").val(),
	    	"Cedula": $("#input_cedula").val(),
	    	"Nit": $("#input_nit").val(),
	    	"Telefono": $("#input_telefono").val(),
	    	"Celular": $("#input_celular").val(),
	    	"Direccion": $("#input_direccion").val(),
	    	"Email": $("#input_email").val(),
	    	"Fecha": "<?php echo date("Y-m-d h:i:s"); ?>",
	    	// "Fk_Id_Usuario": "<?php // echo $this->session->userdata('Pk_Id_Usuario'); ?>",
	    }
	    imprimir(datos);

	    id = ajax("<?php echo site_url('solicitud/insertar'); ?>", {"tipo": "solicitud", "datos": datos}, 'HTML');
        imprimir(id);

        cerrar_notificaciones();
		imprimir_notificacion("Los datos han sido guardados exitosamente", "success");


	}

	$(document).ready(function(){
		// Se ponen algunos valores por defecto
		select_por_defecto("select_proyecto", 1);
		$("#input_fecha").val("<?php echo date('Y-m-d'); ?>");

		$("form").on("submit", function(){
			guardar();

			return false;
		});

		// Cuando se elija el municipio, se cargan los sectores de ese municipio
		$("#select_municipio").on("change", function(){
			datos = {
				url: "<?php echo site_url('configuracion/obtener'); ?>",
				tipo: "sectores_municipios",
				id: $(this).val(),
				elemento_padre: $("#select_municipio"),
				elemento_hijo: $("#select_sector"),
				mensaje_padre: "Elija primero un municipio...",
				mensaje_hijo: "Elija el sector o corregimiento..."
			}
			cargar_lista_desplegable(datos);
		});
	});
</script>