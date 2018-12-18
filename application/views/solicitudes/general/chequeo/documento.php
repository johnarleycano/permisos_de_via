<div id="modal_archivos" class="modal" uk-modal>
    <div class="uk-modal-dialog">
        <form class="uk-form-horizontal uk-margin-large">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Subir documento</h2>
            </div>

            <div class="uk-modal-body" uk-overflow-auto>
                <div class="js-upload uk-placeholder uk-text-center" id="cont_subir">
                    <span uk-icon="icon: cloud-upload"></span>
                    <span class="uk-text-middle">Adjunte el documento arrastrándolo aquí o</span>
                    <div uk-form-custom>
                        <input type="file" name="fileToUpload">
                        <span class="uk-link">seleccione uno desde su dispositivo.</span>
                    </div>
                </div>

                <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>

                <?php $archivos = glob("./archivos/documentacion/$id_solicitud/$id_tipo/*"); ?>

                <!-- Si no hay registros, se muestra mensaje -->
                <?php if(count($archivos) == 0){ ?>
                    <span>No hay documentos todavía</span>
                <?php } else { ?>
                    <div class="uk-overflow-auto">
                        <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                                <tr>
                                    <th class="uk-text-center">Archivo</th>
                                    <th class="uk-text-center">Tamaño</th>
                                    <th class="uk-text-center">Tipo</th>
                                    <th class="uk-text-center">Opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($archivos as $nombre) { ?>
                                    <tr>
                                        <td><?php echo basename($nombre); ?></td>
                                        <td class="uk-text-right"><?php echo (filesize($nombre) / 1000)." KB"; ?></td>
                                        <td><?php  ?></td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>

            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cerrar</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var bar = document.getElementById('js-progressbar');

    UIkit.upload('.js-upload', {
        url: `<?php echo site_url("solicitud/subir"); ?>/${$("#id_solicitud").val()}/${<?php echo $id_tipo; ?>}`,
        multiple: false,
        datatype: "html",
        beforeSend: function () {
            cerrar_notificaciones()
            imprimir_notificacion("<div uk-spinner></div> Subiendo el archivo...")
            // cerrar_notificaciones();
            // imprimir_notificacion("<div uk-spinner></div> Preparando el archivo...")
        },
        beforeAll: function () {
            // console.log('beforeAll', arguments)
        },
        load: function () {
            // cerrar_notificaciones();
            // imprimir_notificacion("<div uk-spinner></div> Cargando el archivo...")
        },
        error: function () {
            // console.log('error', arguments)
        },
        complete: function () {
            // console.log('complete', arguments)
        },

        loadStart: function (e) {
            // console.log('loadStart', arguments)

            bar.removeAttribute('hidden')
            bar.max = e.total
            bar.value = e.loaded
        },

        progress: function (e) {
            // console.log('progress', arguments)
            bar.max = e.total
            bar.value = e.loaded
        },

        loadEnd: function (e) {
            // console.log('loadEnd', arguments)

            bar.max = e.total
            bar.value = e.loaded
            // imprimir(e)
        },

        completeAll: function (e) {

            $("#cont_subir").hide()
            // console.log('completeAll', arguments)
            bar.setAttribute('hidden', 'hidden')

            // setTimeout(function () {
                
            // }, 1000);

            // alert('Upload Completed')
            cerrar_notificaciones()
            imprimir_notificacion("El archivo se subió correctamente.", "success")

            UIkit.modal("#modal_archivos").hide()
        }
    })

    $(document).ready(function(){
        UIkit.modal("#modal_archivos").show()
    })
</script>