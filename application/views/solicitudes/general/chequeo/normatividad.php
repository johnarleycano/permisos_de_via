<?php
// Arreglo que almacenará las normas creadas
$normas = array();

// Se recorren las normas existentes para este tipo de documento y solicitud
foreach ($this->solicitud_model->obtener("lista_chequeo_normatividad", array("Fk_Id_Solicitud" => $id_solicitud, "Fk_Id_Tipo_Documento" => $id_tipo)) as $norma) {
    // Se agrega cada registro en el arreglo
    array_push($normas, $norma->Fk_Id_Norma);
}
?>

<div id="modal_normatividad" class="modal" uk-modal>
    <div class="uk-modal-dialog">
        <form class="uk-form-horizontal uk-margin-large">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Normatividad aplicable a este ítem</h2>
            </div>

            <div class="uk-modal-body" uk-overflow-auto>
				<p>Seleccione las normas correspondientes a este ítem</p>

				<!-- Recorrido de las resoluciones -->
				<?php foreach ($this->normatividad_model->obtener("resoluciones") as $resolucion) { ?>
					<h5 class="uk-heading-divider"><?php echo "Resolución $resolucion->Numero"; ?></h5>
						
					<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
						<div uk-grid>
							<!-- Recorrido de la normatividad de la resolución -->
							<?php foreach ($this->normatividad_model->obtener("normas", $resolucion->Pk_Id) as $norma) { ?>
								<div class="uk-width-1-6@m">
				            		<label title="<?php echo $norma->Descripcion; ?>" uk-tooltip="pos: bottom-left">
				            			<input class="uk-checkbox" type="checkbox" name="normatividad" value="<?php echo $norma->Pk_Id; ?>" <?php echo (in_array($norma->Pk_Id, $normas)) ? "checked" : "" ; ?>> <?php echo $norma->Numeral; ?>
				            		</label>
								</div>
							<?php } ?>
						</div>
		        	</div>
				<?php } ?>
        	</div>

            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cerrar</button>
				<button class="uk-button uk-button-primary" type="button" onClick="javascript:guardar('normatividad', '<?php echo $id_tipo; ?>');">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
        $("#modal_normatividad").addClass('uk-open').show()
    })
</script>