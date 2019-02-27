<?php
// Se consultan los registros
$observaciones = $this->solicitud_model->obtener("observaciones", $id_solicitud);

$cont = 1;
?>
<ul class="uk-tab-left" uk-tab>
	<?php
	$id = null;

	// Recorrido de observaciones
	foreach ($observaciones as $observacion) {
		$id = $observacion->Pk_Id;
	?>
 		<!-- Observacion -->
 		<li id="item_<?php echo $cont; ?>"><a onClick="javascript:crear(<?php echo $observacion->Pk_Id; ?>)"> Observación <?php echo $cont; ?></a></li>
	<?php
		$cont++;
	} ?>
	
	<li class="uk-hidden" id="item_<?php echo $cont; ?>"><a onClick="javascript:crear()"> Observación <?php echo $cont; ?></a></li>
</ul>

<input type="hidden" id="ultimo_contador" value="<?php echo $cont; ?>">

<script type="text/javascript">
	$(document).ready(function(){
		$("li").removeClass("uk-active")
		
		var total_observaciones = "<?php echo count($observaciones); ?>"
		
		// Si no hay observaciones
		if(total_observaciones == 0){
			// Se carga la interfaz de la última observación
	    	crear()

	    	// Se muestra el nuevo ítem
			$(`li`).removeClass("uk-hidden")
		} else {
			// Se carga el la observación
			crear("<?php echo $id; ?>")

			// Se marca activo
			$(`#item_${total_observaciones}`).addClass("uk-active")
		}
	})	
</script>