<!-- Si tiene id de solicitud, la consulta -->
<?php $solicitud = ($id_solicitud > 0) ? $this->solicitud_model->obtener("solicitud", $id_solicitud) : null ; ?>

<form>
    <div class="uk-column-1-2@m uk-column-divider">
        <div class="uk-margin">
            <label class="uk-form-label" for="select_tipo">Tipo de solicitud *</label>
            <div class="uk-form-controls">
                <select class="uk-select" id="select_tipo" title="Tipo de solicitud" autofocus>
                    <?php foreach($this->configuracion_model->obtener("tipos_solicitudes") as $tipo){ ?>
                        <option value="<?php echo $tipo->Pk_Id; ?>"><?php echo $tipo->Nombre; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

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

    <h4 class="uk-heading-line uk-text-right"><span>Otros datos</span></h4>
    <div class="uk-column-1-2@m uk-column-divider">
        <div>
            <label class="uk-form-label" for="input_instrucciones">Instrucciones *</label>
            <textarea class="uk-textarea" id="input_instrucciones" rows="4" title="Instrucciones" placeholder="Instrucciones para el mantenimiento y la rehabilitación de las obras objeto de permiso"><?php echo ($solicitud) ? $solicitud->Instrucciones : "" ; ?></textarea>
        </div>

        <div>
            <label class="uk-form-label" for="input_observaciones">Observaciones *</label>
            <textarea class="uk-textarea" id="input_observaciones" rows="4" title="Observaciones" placeholder="Observaciones y/o recomendaciones"><?php echo ($solicitud) ? $solicitud->Observaciones : "" ; ?></textarea>
        </div>
    </div>

    <p>
        <?php if($id_solicitud){ ?>
            <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" type="button" id="generar_reporte" onCLick="javascript:generar('concepto', <?php echo $id_solicitud; ?>)"><span class="uk-text-success">Generar reporte</span></button>
        <?php } ?>
    	<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" id="guardar" >Guardar</button>
    </p>
</form>

<script type="text/javascript">
    /**
     * Genera el reporte de acuerdo al tipo
     * 
     * @param  {string} tipo 
     * @param  {int} id   Id de la solicitud
     * 
     * @return {void}      
     */
    function generar(tipo, id)
    {
        cerrar_notificaciones();
        imprimir_notificacion("<div uk-spinner></div> Generando reporte...")

        redireccionar(`<?php echo site_url("reportes/excel/concepto/"); ?>${id}`)

        cerrar_notificaciones();
    }

	$(document).ready(function(){
		// Se ponen algunos valores por defecto
        select_por_defecto("select_proyecto", 1);

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
            $("#input_peticionario").val("<?php echo $solicitud->Peticionario; ?>");
            $("#input_cedula").val("<?php echo $solicitud->Cedula; ?>");
            $("#input_nit").val("<?php echo $solicitud->Nit; ?>");
            $("#input_telefono").val("<?php echo $solicitud->Telefono; ?>");
            $("#input_celular").val("<?php echo $solicitud->Celular; ?>");
            $("#input_direccion").val("<?php echo $solicitud->Direccion; ?>");
            $("#input_email").val("<?php echo $solicitud->Email; ?>");
            
            select_por_defecto("select_tipo", <?php echo $solicitud->Fk_Id_Tipo_Solicitud; ?>);
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