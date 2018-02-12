<?php // $registro = $this->solicitud_model->obtener("valor_lista_chequeo", array("Fk_Id_Solicitud" => $id_solicitud, "Fk_Id_Tipo_Documento" => $tipo->Pk_Id)); ?>

<div id="modal_documento" class="modal" uk-modal>
    <div class="uk-modal-dialog">
        <form class="uk-form-horizontal uk-margin-large">
            <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Información del documento</h2>
                </div>

                <div class="uk-modal-body" uk-overflow-auto>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="text_observacion">Observaciones</label>
                        <textarea class="uk-textarea" id="text_observacion" rows="4" title="Objeto" autofocus><?php // echo $registro->Observacion; ?></textarea>
                    </div>

                </div>

            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                <button class="uk-button uk-button-primary" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        UIkit.modal("#modal_documento").show();

        $("form").on("submit", function(){
            guardar('observacion', <?php echo $id_tipo; ?>);

            return false;
        });
    });
</script>