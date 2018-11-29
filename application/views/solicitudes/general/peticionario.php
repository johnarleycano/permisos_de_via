<!-- Si tiene id de solicitud, la consulta -->
<?php $solicitud = ($id_solicitud > 0) ? $this->solicitud_model->obtener("solicitud", $id_solicitud) : null ; ?>

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
        <label class="uk-form-label" for="input_email">Correo electrónico</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="input" id="input_email" title="Correo electrónico">
        </div>
    </div>
</div>

<script type="text/javascript">
    /**
     * Envía a la base de datos la información del elemento
     * que se está creando
     * 
     * @return {int}
     */
	function guardar()
	{
		cerrar_notificaciones()
		imprimir_notificacion("<div uk-spinner></div> Guardando datos del peticionario...")

        // Campos obligatorios
		let campos_obligatorios = {
			"input_peticionario": $("#input_peticionario").val(),
		}
		// imprimir(campos_obligatorios)

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)) return false

		let datos = {
	    	"Peticionario": $("#input_peticionario").val(),
	    	"Cedula": $("#input_cedula").val(),
	    	"Nit": $("#input_nit").val(),
	    	"Telefono": $("#input_telefono").val(),
	    	"Celular": $("#input_celular").val(),
	    	"Direccion": $("#input_direccion").val(),
	    	"Email": $("#input_email").val(),
		}
		// imprimir(datos, "tabla")

		// Se actualiza la solicitud
		ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "solicitud", "datos": datos, "id_solicitud": $("#id_solicitud").val()}, 'HTML')

		// Se activa el botón para generar el reporte
		$("#btn_reporte").removeClass("uk-disabled")

		cerrar_notificaciones()
		imprimir_notificacion("Los datos han sido guardados exitosamente", "success")
	}
</script>

<!-- Cuando tiene una solicitud -->
<?php if ($solicitud) { ?>
	<script type="text/javascript">
        $(document).ready(function(){
        	$("#input_peticionario").val("<?php echo $solicitud->Peticionario; ?>")
            $("#input_cedula").val("<?php echo $solicitud->Cedula; ?>")
            $("#input_nit").val("<?php echo $solicitud->Nit; ?>")
            $("#input_telefono").val("<?php echo $solicitud->Telefono; ?>")
            $("#input_celular").val("<?php echo $solicitud->Celular; ?>")
            $("#input_direccion").val("<?php echo $solicitud->Direccion; ?>")
            $("#input_email").val("<?php echo $solicitud->Email; ?>")
        })
    </script> 
<?php } ?>