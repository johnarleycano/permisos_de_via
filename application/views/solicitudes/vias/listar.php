<?php
// Se consultan los registros
$vias = $this->solicitud_model->obtener("vias", $id_solicitud);

// Si no hay registros, se muestra mensaje
if(count($vias) == 0){
	echo "No hay vias agregadas todavía";
	exit();
}
?>

<ul class="uk-list uk-list-divider">
	<?php foreach ($vias as $via) { ?>
    	<li><?php echo "($via->Abscisa_Inicial - $via->Abscisa_Final): $via->Sector | $via->Via | $via->Costado"; ?></li>
	<?php } ?>
</ul>