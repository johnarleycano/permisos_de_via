<?php
// Se consultan los registros
$bitacora = $this->solicitud_model->obtener("bitacora", $id_solicitud);

$num = 1;

// Si no hay registros, se muestra mensaje
if(count($bitacora) == 0){
	echo "No hay registros creados, todavía";
	exit();
}
?>

<div class="uk-overflow-auto">
    <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
        <thead>
            <tr>
            	<th class="uk-text-center">#</th>
            	<th class="uk-text-center">Fecha</th>
            	<th class="uk-text-center">Radicado</th>
            	<th class="uk-text-center">Detalle</th>
            	<th class="uk-text-center">Opciones</th>
        	</tr>
        </thead>
        <tbody>
        	<?php
            foreach ($bitacora as $registro) {
                $fecha = $this->configuracion_model->obtener("formato_fecha", $registro->Fecha_Registro);
            ?>
	        	<tr>
					<td class="uk-text-right"><?php echo $num++; ?></td>
					<td><?php echo "{$fecha['mes_texto']} {$fecha['dia']}, {$fecha['anio']}"; ?></td>
					<td><?php echo $registro->Radicado; ?></td>
					<td><?php echo $registro->Detalle; ?></td>
					<td>
						
					</td>
				</tr>
			<?php } ?>
    	</tbody>
    </table>
</div>