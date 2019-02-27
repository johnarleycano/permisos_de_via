<?php
$fecha = $this->configuracion_model->obtener("formato_fecha", date("Y-m-d"));
$dia = date("d");
$mes_texto = strtolower($fecha['mes_texto']);
$anio = date("Y");

$lista = $this->solicitud_model->obtener("valores_lista_chequeo", array("Fk_Id_Solicitud" => $id_solicitud, "Cumple" => 0));
$solicitud = $this->solicitud_model->obtener("solicitud", $id_solicitud);
$pago = $this->solicitud_model->obtener("pago", $id_solicitud);
$vias = $this->solicitud_model->obtener("vias", $id_solicitud);

/******************************************************
 **************** Configuración general ***************
 *****************************************************/
$objPHPExcel = new PHPExcel();

// Se establece la configuracion general
$objPHPExcel
	->getProperties()
	->setCreator("John Arley Cano Salinas - Devimed S.A.")
	->setLastModifiedBy("John Arley Cano Salinas")
	->setTitle("Sistema de administración de permisos de usos de vía - Generado el ".$fecha['dia']." de ".$fecha['mes_texto']." de ".$anio." - ".date('h:i A'))
	->setSubject("Observaciones a la solicitud de permiso de ocupación temporal")
	->setDescription("Observaciones a la solicitud de permiso de ocupación temporal")
	->setKeywords("gestion proyectos infraestructura observacion operativo viabilidad permiso solicitud via acceso ocupacion temporal")
    ->setCategory("Reporte")
;

// Definicion de las configuraciones por defecto en todo el libro
$objPHPExcel->getDefaultStyle()->getFont()
	->setName('Calibri')
	->setSize(11)
;

$objPHPExcel->getDefaultStyle()->getAlignment()
	->setWrapText(true)
	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
;

// Se establece la configuracion de la pagina
$objPHPExcel->getActiveSheet()->getPageSetup()
	->setRowsToRepeatAtTopByStartAndEnd(3) //Se indica el rango de filas que se van a repetir en el momento de imprimir. (Encabezado del reporte)
	->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT)
	->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER)
	->setScale(65)
	->setHorizontalCentered() // Centrar página horizontalmente
;

//Se establecen las margenes
$objPHPExcel->getActiveSheet()->getPageMargins()
// 	->setTop(0,50) //Arriba
	->setRight(0.50) //Derecha
	->setLeft(0.50) //Izquierda
// 	->setBottom(0,50) //Abajo
;

// Ocultar la cuadrícula:
$objPHPExcel->getActiveSheet()->setShowGridlines(false);

// Pié de pagina
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' .$objPHPExcel->getProperties()->getTitle() . '&RPágina &P de &N');

/**
 * Estilos
 */
$centrado_negrita = array( 'font' => array( 'bold' => true ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER ) );
$negrita = array( 'font' => array( 'bold' => true ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT ) );
$borde_externo = array( 'borders' => array( 'outline' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN ) ) );
$centrado = array( 'font' => array( 'bold' => false ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER ) );
$bordes = array( 'borders' => array( 'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array( 'argb' => '000000' ) ), ), );


/******************************************************
 **************** Hoja de observaciones ***************
 *****************************************************/
// Título de la hoja
$objPHPExcel->getActiveSheet()->setTitle("Observaciones");

/*
 * Definicion de la anchura de las columnas
 */
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(4);

/**
 * Definición de altura de las filas
 */
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);

// Celdas a combinar
$objPHPExcel->getActiveSheet()
	->mergeCells('A1:J1')
	->mergeCells('B2:J2')
	->mergeCells('B3:J3')
	->mergeCells('B4:J4')
;

/**
 * Contenido
 */
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo de uso exclusivo de Devimed S.A.');
$objDrawing->setPath("./img/logo.png");
$objDrawing->setCoordinates('H4');
$objDrawing->setHeight(60);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Encabezados
$objPHPExcel->getActiveSheet()
	->setCellValue("A1", "RESOLUCIÓN 716 DE 2015")
	->setCellValue("A2", strtoupper("PETICIONARIO:"))
	->setCellValue("B2", $solicitud->Peticionario)
	->setCellValue("A3", strtoupper("Expediente ANI:"))
	->setCellValue("B3", $solicitud->Expediente_ANI)
	->setCellValue("A4", strtoupper("Radicado $solicitud->Proyecto:"))
	->setCellValue("B4", $solicitud->Radicado_Solicitud)
;

$fila = 5;

// Se recorren las vías
foreach ($vias as $via) {
	// Celdas a combinar
	$objPHPExcel->getActiveSheet()->mergeCells("B$fila:J$fila");

	$objPHPExcel->getActiveSheet()
		->setCellValue("A$fila", "TRAMO")
		->setCellValue("B$fila", "$via->Tramo ($via->Municipio)")
	;

	$fila++;

	// Celdas a combinar
	$objPHPExcel->getActiveSheet()->mergeCells("B$fila:J$fila");

	$objPHPExcel->getActiveSheet()
		->setCellValue("A$fila", "ABSCISAS")
		->setCellValue("B$fila", "Desde $via->Abscisa_Inicial hasta $via->Abscisa_Final")
	;

	$fila++;
}
$fila--;

$objPHPExcel->getActiveSheet()->getStyle("A2:J$fila")->applyFromArray($borde_externo);
$objPHPExcel->getActiveSheet()->getStyle("A2:A$fila")->applyFromArray($negrita);
$fila++;
$fila++;
$fila_inicial = $fila;

$objPHPExcel->getActiveSheet()->mergeCells("A$fila:J$fila");
$objPHPExcel->getActiveSheet()->setCellValue("A$fila", "OBSERVACIÓN");
$fila++;
$objPHPExcel->getActiveSheet()->getStyle("A$fila_inicial:J$fila")->applyFromArray($centrado_negrita);

$objPHPExcel->getActiveSheet()->mergeCells("E$fila:J$fila");

// Encabezados
$objPHPExcel->getActiveSheet()
	->setCellValue("A$fila", "REQUISITO")
	->setCellValue("B$fila", "CUMPLE")
	->setCellValue("C$fila", "NO CUMPLE")
	->setCellValue("D$fila", "ANOTACIONES ADICIONALES")
	->setCellValue("E$fila", "OBSERVACIONES")
;

$fila++;


// Estilos
$objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("B:C")->applyFromArray($centrado);

// Recorrido de los registros
foreach ($lista as $registro) {
	$requisito = $this->solicitud_model->obtener("tipo_documento", array("Pk_Id" => $registro->Fk_Id_Tipo_Documento));

	// Contenido
	$objPHPExcel->getActiveSheet()
		->setCellValue("A{$fila}", $requisito->Nombre)
		->setCellValue("C{$fila}", "X")
		->setCellValue("D{$fila}", $registro->Observacion)
	;

	// Columna inicial para los numerales de las normas
	$columna = "E";

	// Se recorren las normas asociadas a este tipo de documento
	foreach ($this->solicitud_model->obtener("lista_chequeo_normatividad", array("Fk_Id_Solicitud" => $id_solicitud, "Fk_Id_Tipo_Documento" => $registro->Fk_Id_Tipo_Documento)) as $norma) {
		// Contenido
		$objPHPExcel->getActiveSheet()->setCellValue("{$columna}{$fila}", $norma->Numeral);

		// Se aumenta la columna
		$columna++;
	}

	// Estilos
	$objPHPExcel->getActiveSheet()->getStyle("E{$fila}:J{$fila}")->applyFromArray($borde_externo);

	// Aumento de fila
	$fila++;
}

$fila--;
$objPHPExcel->getActiveSheet()->getStyle("A$fila_inicial:J$fila")->applyFromArray($bordes);

/******************************************************
 ******************* Hoja de normas *******************
 *****************************************************/
$hoja_normas = $objPHPExcel->createSheet()->setTitle("Normatividad");

/*
 * Definicion de la anchura de las columnas
 */
$hoja_normas->getColumnDimension('A')->setWidth(10);
$hoja_normas->getColumnDimension('B')->setWidth(70);
$hoja_normas->getColumnDimension('C')->setWidth(70);

/**
 * Definición de altura de las filas
 */
$hoja_normas->getRowDimension(1)->setRowHeight(50);

// Celdas a combinar
$hoja_normas
	->mergeCells('A1:C1')
;

/**
 * Contenido
 */
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo de uso exclusivo de Devimed S.A.');
$objDrawing->setPath("./img/logo.png");
$objDrawing->setCoordinates('C1');
$objDrawing->setOffsetX(400);
$objDrawing->setOffsetY(5);
$objDrawing->setHeight(60);
$objDrawing->setWorksheet($hoja_normas);

// Encabezados
$hoja_normas
	->setCellValue("A1", "RESOLUCIÓN 716 DE 2015")
	->setCellValue("A2", "NUMERAL")
	->setCellValue("B2", "OBSERVACIONES")
	->setCellValue("C2", "NORMATIVA")
;

$fila = 4;

// echo $this->solicitud_model->obtener("solicitud_normas"); exit();

// Se recorren las normas que aplican para esta solicitud
foreach ($this->solicitud_model->obtener("solicitud_normas", $id_solicitud) as $norma) {
	// Contenido
	$hoja_normas
		->setCellValue("A{$fila}", $norma->Numeral)
		->setCellValue("B{$fila}", $norma->Observacion)
		->setCellValue("C{$fila}", $norma->Descripcion)
	;

	$fila++;
}

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Observaciones $solicitud->Peticionario.xlsx");

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>