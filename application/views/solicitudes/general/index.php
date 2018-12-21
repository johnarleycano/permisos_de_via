<!-- Tabs de opciones -->
<div class="uk-width-1-6">
	<ul class="uk-tab-left" id="cont_opciones" uk-tab>
		<li class="uk-active"><a onCLick="javascript:cargar('informacion')"> <span uk-icon="icon: home; ratio: 0.7"></span> General</a></li>
        <li><a onClick="javascript:cargar('peticionario');"><span uk-icon="icon: user; ratio: 0.7"></span> Peticionario</a></li>
        <li><a onClick="javascript:cargar('vias');"><span uk-icon="icon: location; ratio: 0.7"></span> Vías</a></li>
        <li><a onClick="javascript:cargar('participantes');"><span uk-icon="icon: users; ratio: 0.7"></span> Participantes</a></li>
        <li><a onClick="javascript:cargar('elementos');"><span uk-icon="icon: thumbnails; ratio: 0.7"></span> Elementos</a></li>
        <li><a onClick="javascript:cargar('chequeo');"><span uk-icon="icon: check; ratio: 0.7"></span> Chequeo</a></li>
        <li><a onClick="javascript:cargar('bitacora');"><span uk-icon="icon: list; ratio: 0.7"></span> Bitácora</a></li>
    </ul>
	<hr>

    <!-- Reporte -->
    <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" type="button" id="btn_reporte" onCLick="javascript:generar('concepto', <?php echo $id_solicitud; ?>)"><span class="uk-text-success">REPORTE</span></button>
    
    <!-- Guardar -->
	<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" onClick="javascript:guardar();">Guardar</button>
</div>

<div class="uk-width-5-6">
	<div id="cont_general"></div>
</div>

<script type="text/javascript">
    /**
     * Interfaz de carga
     * 
     * @param  {string}     tipo    [tipo de tab]
     * 
     * @return
     */
	function cargar(tipo)
	{
		// Si se va a cambiar de opción y no se ha guardado la solicitud
		if(tipo != "informacion" && $("#id_solicitud").val() == 0){
			cerrar_notificaciones()
			imprimir_notificacion("Antes de continuar, por favor guarde los cambios.", "danger")

			return false
		}

		// Carga de interfaz
    	$("#cont_general").load("<?php echo site_url('solicitud/cargar_interfaz'); ?>", {"tipo": `general_${tipo}`, "id_solicitud": $("#id_solicitud").val()})
	}

	/**
     * Genera el reporte de acuerdo al tipo
     * 
     * @param  {string} tipo 
     * @param  {int} id   Id de la solicitud
     * 
     * @return {void}      
     */
    function generar(tipo)
    {
        cerrar_notificaciones()
        imprimir_notificacion("<div uk-spinner></div> Generando reporte...")

        switch(tipo) {
            case 'concepto':
                redireccionar(`<?php echo site_url("reportes/excel/concepto/"); ?>${$("#id_solicitud").val()}`)
            break

            case 'observaciones':
                redireccionar(`<?php echo site_url("reportes/excel/observaciones/"); ?>${$("#id_solicitud").val()}`)
            break
        }

        cerrar_notificaciones()
    }

	$(document).ready(function(){
		// Se desactiva el botón para generar el reporte si no se ha guardado la solicitud
		if($("#id_solicitud").val() == 0) $("#btn_reporte").addClass("uk-disabled")

		cargar("informacion")
	})
</script>