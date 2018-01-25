<!-- Si tiene id de solicitud, la consulta -->
<?php $solicitud = ($id_solicitud > 0) ? $this->solicitud_model->obtener("solicitud", $id_solicitud) : null ; ?>

<form>
    <div class="uk-column-1-2@m uk-column-divider">
        <div class="uk-margin">
            <label class="uk-form-label" for="select_proyecto">Proyecto *</label>
            <div class="uk-form-controls">
                <select class="uk-select" id="select_proyecto" title="Proyecto">
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
                <input class="uk-input" type="date" id="input_fecha" title="Fecha" >
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
            <textarea class="uk-textarea" id="input_objeto" rows="4" title="Objeto"><?php echo ($solicitud) ? $solicitud->Objeto : "" ; ?></textarea>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="input_alcance">Alcance *</label>
            <textarea class="uk-textarea" id="input_alcance" rows="4" title="Alcance"><?php echo ($solicitud) ? $solicitud->Alcance : "" ; ?></textarea>
        </div>
    </div>

    <h4 class="uk-heading-line uk-text-right"><span>Identificación del peticionario</span></h4>
    <div class="uk-margin">
        <label class="uk-form-label" for="input_peticionario">Nombre o razón social *</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="input" id="input_peticionario" title="Nombre o razón social">
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

    <p>
    	<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" id="guardar" >Guardar</button>
    </p>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		// Se ponen algunos valores por defecto
		select_por_defecto("select_proyecto", 1);
		$("#input_fecha").val("<?php echo date('Y-m-d'); ?>");

        $("form").on("submit", function(){
            guardar_general();

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

<!-- Cuando tiene una solicitud -->
<?php if ($solicitud) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#input_fecha").val("<?php echo $solicitud->Fecha_Solicitud; ?>");
            $("#input_peticionario").val("<?php echo $solicitud->Peticionario; ?>");
            $("#input_cedula").val("<?php echo $solicitud->Cedula; ?>");
            $("#input_nit").val("<?php echo $solicitud->Nit; ?>");
            $("#input_telefono").val("<?php echo $solicitud->Telefono; ?>");
            $("#input_celular").val("<?php echo $solicitud->Celular; ?>");
            $("#input_direccion").val("<?php echo $solicitud->Direccion; ?>");
            $("#input_email").val("<?php echo $solicitud->Email; ?>");
            
            select_por_defecto("select_proyecto", <?php echo $solicitud->Fk_Id_Proyecto; ?>);
            select_por_defecto("select_municipio", <?php echo $solicitud->Fk_Id_Municipio; ?>);

            datos = {
                url: "<?php echo site_url('configuracion/obtener'); ?>",
                tipo: "sectores_municipios",
                id: "<?php echo $solicitud->Fk_Id_Municipio; ?>",
                elemento_padre: $("#select_municipio"),
                elemento_hijo: $("#select_sector"),
                mensaje_padre: "Elija primero un municipio...",
                mensaje_hijo: "Elija el sector o corregimiento..."
            }
            cargar_lista_desplegable(datos);
            select_por_defecto("select_sector", <?php echo $solicitud->Fk_Id_Sector; ?>);
        });
    </script>    
<?php } ?>