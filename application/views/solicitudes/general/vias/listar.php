<?php
// Se consultan los registros
$vias = $this->solicitud_model->obtener("vias", $id_solicitud);

// Si no hay registros, se muestra mensaje
if(count($vias) == 0){
	echo "No hay vias agregadas todavía";
	exit();
}
?>

<div class="uk-overflow-auto">
    <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
        <thead>
            <tr>
                <th class="uk-text-center">Tramo</th>
            	<th class="uk-text-center">Municipio</th>
            	<th class="uk-text-center">Abscisa Inicial</th>
            	<th class="uk-text-center">Abscisa Final</th>
            	<th class="uk-text-center">Opciones</th>
        	</tr>
        </thead>
        <tbody>
        	<?php foreach ($vias as $via) { ?>
	        	<tr>
                    <td><?php echo $via->Tramo; ?></td>
					<td><?php echo $via->Municipio; ?></td>
					<td class="uk-text-right"><?php echo $via->Abscisa_Inicial; ?></td>
					<td class="uk-text-right"><?php echo $via->Abscisa_Final; ?></td>
					<td>
                        <a onClick="javascript:eliminar(<?php echo $via->Pk_Id; ?>)" class="uk-link-muted">
                            <div uk-tooltip="title: Eliminar <?php echo $via->Tramo; ?>">
                                <span uk-icon="close"></span>
                            </div>
                        </a>               
                    </td>
				</tr>
			<?php } ?>
    	</tbody>
    </table>
</div>