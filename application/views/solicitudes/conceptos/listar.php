<?php
// Se consultan los registros
$conceptos = $this->solicitud_model->obtener("conceptos", $id_solicitud);

$cont = 1;
?>
<ul class="uk-tab-left" id="cont_opciones_conceptos" uk-tab>
	<?php
	$id = null;

	// Recorrido de conceptos
	foreach ($conceptos as $concepto) {
		$id = $concepto->Pk_Id;
	?>
 		<!-- Concepto -->
 		<li id="item_<?php echo $cont; ?>"><a onClick="javascript:crear(<?php echo $concepto->Pk_Id; ?>)"> Concepto <?php echo $cont; ?></a></li>
	<?php $cont++; } ?>
	
	<li class="uk-hidden" id="item_<?php echo $cont; ?>"><a onClick="javascript:crear()"> Concepto <?php echo $cont; ?></a></li>
</ul>

<input type="hidden" id="ultimo_contador" value="<?php echo $cont; ?>">

<script type="text/javascript">
	$(document).ready(function(){
		$("li").removeClass("uk-active")

		
		var total_conceptos = "<?php echo count($conceptos); ?>"
		
		// Si no hay conceptos
		if(total_conceptos == 0){
			// Se carga la interfaz del último concepto
	    	crear()

	    	// Se muestra el nuevo ítem
			$(`li`).removeClass("uk-hidden")
		} else {
			// Se carga el concepto
			crear("<?php echo $id; ?>")

			// Se marca activo
			$(`#item_${total_conceptos}`).addClass("uk-active")
		}
	})	
</script>