<div class="js-upload uk-placeholder uk-text-center">
    <span uk-icon="icon: cloud-upload"></span>
    <span class="uk-text-middle">Adjunte archivos arrastrándolos aquí o</span>
    <div uk-form-custom>
        <input type="file" name="fileToUpload">
        <span class="uk-link">seleccione uno desde su equipo.</span>
    </div>
</div>

<progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>

<script>

    var bar = document.getElementById('js-progressbar');

    UIkit.upload('.js-upload', {

        url: `<?php echo site_url("solicitud/subir"); ?>/${$("#id_solicitud").val()}`,
        multiple: false,
        datatype: "html",

        beforeSend: function () {
            cerrar_notificaciones();
			imprimir_notificacion("<div uk-spinner></div> Preparando el archivo...");
        },
        beforeAll: function () {
            // console.log('beforeAll', arguments);
        },
        load: function () {
            cerrar_notificaciones();
			imprimir_notificacion("<div uk-spinner></div> Cargando el archivo...");
        },
        error: function () {
            // console.log('error', arguments);
        },
        complete: function () {
            // console.log('complete', arguments);
        },

        loadStart: function (e) {
            // console.log('loadStart', arguments);

            bar.removeAttribute('hidden');
            bar.max = e.total;
            bar.value = e.loaded;
        },

        progress: function (e) {
            // console.log('progress', arguments);
            cerrar_notificaciones();
			imprimir_notificacion("<div uk-spinner></div> Subiendo el archivo...");

            bar.max = e.total;
            bar.value = e.loaded;
        },

        loadEnd: function (e) {
            // console.log('loadEnd', arguments);

            // bar.max = e.total;
            // bar.value = e.loaded;
        	// imprimir(e)
        },

        completeAll: function (e) {
        	imprimir(e.response)
            // console.log('completeAll', arguments);
bar.setAttribute('hidden', 'hidden');

            // setTimeout(function () {
                
            // }, 1000);

            // alert('Upload Completed');
            cerrar_notificaciones();
			imprimir_notificacion("El archivo se subió correctamente.", "success");

			listar_documentos()
        }

    });

</script>