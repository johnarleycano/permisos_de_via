<?php
// Si es edición de un registro
if ($id != 0) {
    // Se consultan los datos
    $norma = $this->normatividad_model->obtener("norma", $id);

    // Input oculto
    echo '<input id="id_norma" type="hidden" value="'.$id.'">';
} // if
?>

<div class="uk-column-1-2@m">
	<div class="uk-margin">
        <label class="uk-form-label" for="select_resolucion">Resolución *</label>
        <div class="uk-form-controls">
            <select class="uk-select" id="select_resolucion" title="Resolución" autofocus>
            	<option value="">Seleccione</option>
            	
                <?php foreach($this->normatividad_model->obtener("resoluciones") as $resolucion){ ?>
                    <option value="<?php echo $resolucion->Pk_Id; ?>"><?php echo $resolucion->Numero; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

	<div class="uk-margin">
	    <label class="uk-form-label" for="input_numeral">Numeral *</label>
	    <div class="uk-form-controls">
	        <input class="uk-input" type="number" id="input_numeral" title="Numeral" value="<?php if(isset($norma->Numeral)){echo $norma->Numeral;} ?>">
	    </div>
	</div>
</div>

<div class="uk-column-1-2@m">
    <div class="uk-margin">
        <label class="uk-form-label" for="input_normativa">Normativa *</label>
        <textarea class="uk-textarea" id="input_normativa" rows="8" title="Normativa"><?php if(isset($norma->Descripcion)){echo $norma->Descripcion;} ?></textarea>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="input_observaciones">Observaciones *</label>
        <textarea class="uk-textarea" id="input_observaciones" rows="8" title="Observaciones"><?php if(isset($norma->Observacion)){echo $norma->Observacion;} ?></textarea>
    </div>
</div>

<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" onClick="javascript:guardar();">Guardar cambios</button>

<script type="text/javascript">
	/**
     * Envía a la base de datos la información 
     * del registro que se está creando
     * 
     * @return {int}
     */
	function guardar()
	{
    	let id_norma = $("#id_norma").val()
		
		cerrar_notificaciones()
		imprimir_notificacion("<div uk-spinner></div> Guardando norma...")

		// Campos obligatorios
		let campos_obligatorios = {
			"select_resolucion": $("#select_resolucion").val(),
			"input_numeral": $("#input_numeral").val(),
			"input_normativa": $("#input_normativa").val(),
			"input_observaciones": $("#input_observaciones").val(),
		}
		// imprimir(campos_obligatorios, "tabla")

		// Si existen campos obligatorios sin diligenciar
		if(validar_campos_obligatorios(campos_obligatorios)) return false

		let datos = {
    		"Fk_Id_Resolucion": $("#select_resolucion").val(),
    		"Numeral": $("#input_numeral").val(),
    		"Descripcion": $("#input_normativa").val(),
	    	"Observacion": $("#input_observaciones").val(),
	    	"Fk_Id_Usuario": "<?php echo $this->session->userdata('Pk_Id_Usuario'); ?>",
		}
		// imprimir(datos, "tabla")

		// Se verifica si guarda o actualiza el registro
	    if (id_norma){
	    	imprimir("actualizar")
	    	id = ajax("<?php echo site_url('normatividad/actualizar') ?>", {"tipo": "normatividad", "id": id_norma, "datos": datos}, "html")
	    } else {
    		datos.Fecha = "<?php echo date("Y-m-d h:i:s"); ?>",

	    	id = ajax("<?php echo site_url('normatividad/insertar') ?>", {"tipo": "normatividad", "datos": datos}, "html")
	    }
	    
	    // Redirección al listado
	    redireccionar("<?php echo site_url('normatividad/ver'); ?>")

    	cerrar_notificaciones()
		imprimir_notificacion("Los cambios se actualizaron correctamente.", "success")
	}
</script>

<!-- Cuando tiene una norma -->
<?php if ($id != 0) { ?>
	<script type="text/javascript">
        $(document).ready(function(){
        	select_por_defecto("select_resolucion", "<?php echo $norma->Fk_Id_Resolucion; ?>")
        })
    </script> 
<?php } ?>