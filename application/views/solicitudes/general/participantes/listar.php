<?php
// Se consultan los registros
$participantes = $this->solicitud_model->obtener("participantes", $id_solicitud);

// Si no hay registros, se muestra mensaje
if(count($participantes) == 0){
	echo "No hay participantes todavía";
	exit();
}
?>

<div class="uk-overflow-auto">
    <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
        <thead>
            <tr>
                <th class="uk-text-center">Funcionario</th>
            	<th class="uk-text-center">Opciones</th>
        	</tr>
        </thead>
        <tbody>
            <!-- Recorrido de los registros -->
        	<?php foreach ($participantes as $participante) { ?>
	        	<tr>
					<td><?php echo $participante->Nombre; ?></td>
                    <td>
                        
                    </td>
				</tr>
			<?php } ?>
    	</tbody>
    </table>
</div>