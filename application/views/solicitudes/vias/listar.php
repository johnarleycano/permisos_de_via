<?php
// Se consultan los registros
$vias = $this->solicitud_model->obtener("vias", $id_solicitud);

// Si no hay registros, se muestra mensaje
if(count($vias) == 0){
	echo "No hay vias agregadas todavía";
	exit();
}
?>