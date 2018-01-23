<?php
// Se consultan los registros
$participantes = $this->solicitud_model->obtener("participantes", $id_solicitud);

// Si no hay registros, se muestra mensaje
if(count($participantes) == 0){
	echo "No hay participantes todavía";
	exit();
}
?>

<ul class="uk-list uk-list-divider">
	<?php foreach ($participantes as $participante) { ?>
    	<li><?php echo $participante->Pk_Id; ?></li>
	<?php } ?>
</ul>