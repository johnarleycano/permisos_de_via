<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Título que viene desde el controlador de cada interfaz -->
<title><?php echo $titulo; ?> | Permisos de uso de vía</title>

<!-- Estilos -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/uikit.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/estilos.css" />


<script src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>

<?php if(ENVIRONMENT === 'development') { ?>
	<!-- Estilos -->

	<!-- Scripts -->
	<script src="<?php echo base_url(); ?>js/uikit.js"></script>
	<script src="<?php echo base_url(); ?>js/uikit-icons.js"></script>
<?php } ?>

<?php if(ENVIRONMENT === 'production') { ?>
	<!-- Estilos -->

	<!-- Scripts -->
	<script src="<?php echo base_url(); ?>js/uikit.min.js"></script>
	<script src="<?php echo base_url(); ?>js/uikit-icons.min.js"></script>
<?php } ?>

<script src="<?php echo base_url(); ?>js/funciones.js"></script>