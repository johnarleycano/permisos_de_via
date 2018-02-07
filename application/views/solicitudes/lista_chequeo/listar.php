<div id="cont_modal"></div>

<div class="uk-overflow-auto">
    <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
        <thead>
            <tr>
                <th class="uk-text-center">#</th>
                <th class="uk-text-center">Tipo de documento</th>
                <th class="uk-text-center">Observación</th>
                <th class="uk-text-center">Aplica</th>
                <th class="uk-text-center">Cumple</th>
                <th class="uk-text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->solicitud_model->obtener("tipos_documentos") as $tipo) { ?>
                <?php $registro = $this->solicitud_model->obtener("valor_lista_chequeo", array("Fk_Id_Solicitud" => $id_solicitud, "Fk_Id_Tipo_Documento" => $tipo->Pk_Id)); ?>
                <tr>
                    <td class="uk-text-right"><?php echo $tipo->Orden; ?></td>
                    <td><?php echo $tipo->Nombre; ?></td>
                    <td><?php echo (isset($registro)) ? $registro->Observacion : "" ?></td>
                    <td class="uk-text-center">
                        <!-- Aplica -->
                        <label><input class="uk-radio" type="checkbox" id="aplica<?php echo $tipo->Pk_Id; ?>" onClick="javascript:aplica(<?php echo $tipo->Pk_Id; ?>)" <?php echo (isset($registro)) ? "checked" : ""; ?>></label>
                    </td>
                    <td class="uk-text-center">
                        <!-- Cumple -->
                        <label><input class="uk-radio" type="checkbox" id="cumple<?php echo $tipo->Pk_Id; ?>" onClick="javascript:guardar('cumple', <?php echo $tipo->Pk_Id; ?>)" <?php echo (isset($registro) && $registro->Cumple == 1) ? "checked" : ""; ?> <?php echo (isset($registro)) ? "" : "disabled"; ?>></label>
                    </td>
                    <td class="uk-text-center">
                        <!-- Observación -->
                        <a onCLick="javascript:modificar('informacion', <?php echo $tipo->Pk_Id; ?>)" uk-icon="icon: file-edit" title="Editar información" uk-tooltip="pos: bottom-left" id="informacion<?php echo $tipo->Pk_Id; ?>" <?php echo (isset($registro)) ? "" : "hidden"; ?>></a>

                        <a onCLick="javascript:modificar('documento', <?php echo $tipo->Pk_Id; ?>)" uk-icon="icon: upload" title="Subir documento" uk-tooltip="pos: bottom-left" id="documento<?php echo $tipo->Pk_Id; ?>" <?php echo (isset($registro)) ? "" : "hidden"; ?>></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>