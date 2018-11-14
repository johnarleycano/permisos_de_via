<?php
// Consulta de la solicitud
$solicitud = $this->solicitud_model->obtener("solicitud", $id_solicitud);

// Se consultan los registros
$conceptos = $this->solicitud_model->obtener("conceptos", $id_solicitud);

$num = 1;

// Si no hay registros, se muestra mensaje
if(count($conceptos) == 0){
	echo "No hay conceptos emitidos, todavía";
	exit();
}
?>

<div class="uk-overflow-auto">
    <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
        <thead>
            <tr>
            	<th class="uk-text-center">#</th>
            	<th class="uk-text-center">Radicado ANI</th>
            	<th class="uk-text-center">Radicado <?php echo $solicitud->Proyecto; ?></th>
            	<th class="uk-text-center">Concepto emitido</th>
            	<th class="uk-text-center">Fecha de emisión</th>
            	<th class="uk-text-center">Opciones</th>
        	</tr>
        </thead>
        <tbody>
        	<?php
            foreach ($conceptos as $concepto) {
                $fecha = (isset($concepto->Fecha_Viabilidad)) ? $this->configuracion_model->obtener("formato_fecha", $concepto->Fecha_Viabilidad) : null;
            ?>
	        	<tr>
					<td class="uk-text-right"><?php echo $num++; ?></td>
					<td><?php echo $concepto->Radicado_ANI; ?></td>
					<td><?php echo $concepto->Radicado_Proyecto; ?></td>
					<td><?php echo ($concepto->Viable == 1) ? "Viable" : "No viable" ; ?></td>
					<td><?php if($fecha) echo "{$fecha['mes_texto']} {$fecha['dia']}, {$fecha['anio']}"; ?></td>
					<td>
						
					</td>
				</tr>
			<?php } ?>
    	</tbody>
    </table>
</div>