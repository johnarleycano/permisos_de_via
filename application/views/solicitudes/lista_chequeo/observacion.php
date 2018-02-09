<?php $solicitud = $this->solicitud_model->obtener("valor_lista_chequeo", array("Fk_Id_Solicitud" => $id_solicitud, "Fk_Id_Tipo_Documento" => $id_tipo)); ?>

<textarea class="uk-textarea" id="input_observacion" rows="4" title="Observación" autofocus><?php echo $solicitud->Observacion; ?></textarea>

<div class="uk-align-center">
    <button class="uk-button uk-button-primary" type="submit" onClick="javascript:guardar_observacion(<?php echo $id_tipo; ?>);">Guardar</button>
</div>
