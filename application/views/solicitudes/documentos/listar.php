<?php
// Se consultan los registros
$archivos = glob("./archivos/documentacion/$id_solicitud/*");

// Si no hay registros, se muestra mensaje
if(count($archivos) == 0){
	echo "No hay documentos todavía";
	exit();
}
?>
	
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
	        		<td><?php echo (filesize($nombre) / 1000)."KB"; ?></td>
	        		<td><?php  ?></td>
	        		<td></td>
	        	</tr>
			<?php } ?>
        </tbody>
    </table>
</div>