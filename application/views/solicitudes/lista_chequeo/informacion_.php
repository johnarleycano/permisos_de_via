<?php // $registro = $this->solicitud_model->obtener("valor_lista_chequeo", array("Fk_Id_Solicitud" => $id_solicitud, "Fk_Id_Tipo_Documento" => $tipo->Pk_Id)); ?>

<!-- Modal HTML embedded directly into document -->
<div id="ex1" class="modal">
    <form class="uk-form-horizontal uk-margin-large">
        <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Información del documento</h2>
            </div>

            <div class="uk-modal-body" uk-overflow-auto>
                <div class="uk-margin">
                    <label class="uk-form-label" for="text_observacion">Observaciones</label>
                    <textarea class="uk-textarea" id="text_observacion" rows="4" title="Observación" autofocus><?php // echo $registro->Observacion; ?></textarea>
                </div>
            </div>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="submit" onClick="javascript:guardar_observacion();">Guardar</button>
        </div>
    </form>
</div>
    <a href="#" rel="modal:close">Close</a>
</div>

<script type="text/javascript">
    /**
     * Guarda los cambios en base de datos
     * 
     * @param  {string} tipo        [Tipo de dato a guardar]
     * @param  {int}    id_tipo     [Id del tipo de documento]
     * 
     * @return {void}
     */
    function guardar_observacion()
    {
        imprimir($("#text_observacion").val());
        return false;
        const id = <?php echo $id_tipo; ?>

        let datos = {
            "Fk_Id_Solicitud": $("#id_solicitud").val(),
            "Fk_Id_Tipo_Documento": <?php echo $id_tipo; ?>,
        }
        imprimir(datos)

        ajax("<?php echo site_url('solicitud/actualizar'); ?>", {"tipo": "lista_chequeo", "datos": datos, valor: {"Observacion": $("#text_observacion").val()}}, 'html')
        cerrar_notificaciones()
        imprimir_notificacion(`Se ha modificado la observación correctamente.`, `success`)
        UIkit.modal("#modal_observacion").hide();
        
        listar_chequeo()

        return false
    }

    $(document).ready(function(){
        UIkit.modal("#modal_observacion").show();

        // $("form").on("submit", function(){
        //     guardar('observacion', <?php //echo $id_tipo; ?>);

        //     return false;
        // });
        // 
        $("#ex1").modal({
          fadeDuration: 100,
          closeClass: 'icon-remove',
            closeText: '!'
        });
    });
</script>