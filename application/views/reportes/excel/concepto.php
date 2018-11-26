<?php
// Fechas
$fecha = $this->configuracion_model->obtener("formato_fecha", date("Y-m-d"));
$numero = new NumerosALetras();
$dia_texto = strtolower($numero->traducir(date("d"), "numero"));
$dia = date("d");
$mes_texto = strtolower($fecha['mes_texto']);
$anio = date("Y");

$solicitud = $this->solicitud_model->obtener("solicitud", $id_solicitud);
$participantes = $this->solicitud_model->obtener("participantes", $id_solicitud);
$vias = $this->solicitud_model->obtener("vias", $id_solicitud);
$tipos_documentos = $this->solicitud_model->obtener("tipos_documentos");

// Si es un concepto específico
if ($id_concepto) {
	// Consulta de concepto
	$concepto = $this->solicitud_model->obtener("concepto", $id_concepto);
}

$objPHPExcel = new PHPExcel();

// Se establece la configuracion general
$objPHPExcel
	->getProperties()
	->setCreator("John Arley Cano Salinas - Devimed S.A.")
	->setLastModifiedBy("John Arley Cano Salinas")
	->setTitle("Sistema de administración de permisos de usos de vía - Generado el ".$fecha['dia']." de ".$fecha['mes_texto']." de ".$anio." - ".date('h:i A'))
	->setSubject("Concepto técnico de permiso de ocupación temporal")
	->setDescription("Formato de la ANI GSCP-F-196")
	->setKeywords("gestion proyectos infraestructura concepto tecnico operativo viabilidad permiso solicitud via acceso ocupacion temporal")
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

// Título de la hoja
$objPHPExcel->getActiveSheet()->setTitle("Concepto");

// Ocultar la cuadrícula:
// $objPHPExcel->getActiveSheet()->setShowGridlines(false);

// Pié de pagina
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' .$objPHPExcel->getProperties()->getTitle() . '&RPágina &P de &N');

/*
 * Definicion de la anchura de las columnas
 */
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(24);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8);

/**
 * Definición de altura de las filas
 */
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(42);
$objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(42);
$objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(5);
$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension(18)->setRowHeight(5);
$objPHPExcel->getActiveSheet()->getRowDimension(19)->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension(23)->setRowHeight(5);

/**
 * Estilos
 */
$centrado_negrita = array( 'font' => array( 'bold' => true ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER ) );
$centrado = array( 'font' => array( 'bold' => false ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER ) );
$negrita = array( 'font' => array( 'bold' => true ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT ) );
$bordes = array( 'borders' => array( 'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array( 'argb' => '000000' ) ), ), );

// Celdas a combinar
$objPHPExcel->getActiveSheet()
	->mergeCells('A1:A3')
	->mergeCells('A4:L4')
	->mergeCells('A5:L5')
	->mergeCells('A6:B6')
	->mergeCells('A7:B7')
	->mergeCells('A8:L8')
	->mergeCells('A9:B9')
	->mergeCells('A10:B10')
	->mergeCells('A11:B11')
	->mergeCells('A12:B12')
	->mergeCells('A13:B13')
	->mergeCells('A14:B14')
	->mergeCells('A15:B15')
	->mergeCells('A16:B16')
	->mergeCells('A17:B17')
	->mergeCells('A19:L19')
	->mergeCells('A20:A22')
	->mergeCells('A24:L24')
	->mergeCells('A25:B25')
	->mergeCells('B20:C22')
	->mergeCells('C6:D6')
	->mergeCells('C7:D7')
	->mergeCells('C9:L9')
	->mergeCells('C10:L10')
	->mergeCells('C10:L10')
	->mergeCells('C11:L11')
	->mergeCells('C12:L12')
	->mergeCells('C13:L13')
	->mergeCells('C14:L14')
	->mergeCells('C15:L15')
	->mergeCells('C16:L16')
	->mergeCells('C17:L17')
	->mergeCells('B1:I1')
	->mergeCells('B2:C2')
	->mergeCells('B3:C3')
	->mergeCells('D2:I2')
	->mergeCells('D3:I3')
	->mergeCells('C25:D25')
	->mergeCells('E6:E7')
	->mergeCells('E22:L22')
	->mergeCells('F6:L6')
	->mergeCells('E25:F25')
	->mergeCells('G20:L20')
	->mergeCells('G21:H21')
	->mergeCells('J25:L25')
	->mergeCells('J21:L21')
	->mergeCells('G25:I25')
	->mergeCells('K1:L1')
	->mergeCells('K2:L2')
	->mergeCells('K3:L3')
	->mergeCells('K7:L7')
;

/**
 * Contenido
 */
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo de uso exclusivo de Precisión Metrológica');
$objDrawing->setPath("./img/logo_ani.png");
$objDrawing->setCoordinates('A1');
$objDrawing->setHeight(130);
$objDrawing->setOffsetX(5);
$objDrawing->setOffsetY(5);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Encabezados
$objPHPExcel->getActiveSheet()
	->setCellValue('B1', 'SISTEMA INTEGRADO DE GESTIÓN')
	->setCellValue('B2', 'PROCESO')
	->setCellValue('B3', 'FORMATO')
	->setCellValue('D2', 'GESTIÓN CONTRACTUAL Y SEGUIMIENTO DE PROYECTOS DE INFRAESTRUCTURA DE TRANSPORTE')
	->setCellValue('D3', 'CONCEPTO TÉCNICO, OPERATIVO Y DE VIABILIDAD A PERMISOS DE OCUPACIÓN TEMPORAL. RESOLUCIÓN No.716 DEL 28 DE Abril de 2015')
	->setCellValue('J1', 'CÓDIGO')
	->setCellValue('J2', 'VERSIÓN')
	->setCellValue('J3', 'FECHA')
	->setCellValue('K1', 'GCSP-F-196')
	->setCellValue('K2', '002')
	->setCellValue('K3', '2/02/2016')
	->setCellValue('A5', '1. INFORMACIÓN DE LUGAR Y FECHA DE LA VISITA')
	->setCellValue('A6', 'MUNICIPIO')
	->setCellValue('C6', 'CORREGIMIENTO')
	->setCellValue('F6', 'FECHA')
	->setCellValue('F7', 'DÍA:')
	->setCellValue('H7', 'MES:')
	->setCellValue('J7', 'AÑO:')
	->setCellValue('A8', '2. INFORMACIÓN GENERAL DEL PERMISO')
	->setCellValue('A9', 'MODO')
	->setCellValue('A10', 'NOMBRE DEL PROYECTO VIAL')
	->setCellValue('A11', 'CONCESIONARIO')
	->setCellValue('A12', 'INTERVENTORÍA')
	->setCellValue('A13', 'CONTRATO DE CONCESIÓN No.')
	->setCellValue('A14', 'CLASE DEL PERMISO')
	->setCellValue('A15', 'CONTRATO DE INTERVENTORÍA No.')
	->setCellValue('A16', 'OBJETO DEL PERMISO')
	->setCellValue('A17', 'ALCANCE')
	->setCellValue('A19', '3. IDENTIFICACIÓN DEL PETICIONARIO')
	->setCellValue('A20', 'NOMBRE O RAZÓN SOCIAL')
	->setCellValue('D20', 'CÉDULA')
	->setCellValue('D21', 'TELÉFONO')
	->setCellValue('D22', 'DIRECCIÓN')
	->setCellValue('F20', 'CORREO')
	->setCellValue('F21', 'CELULAR:')
	->setCellValue('I21', 'NIT')
	->setCellValue('A24', '4. PARTICIPANTES')
	->setCellValue('A25', 'NOMBRES Y APELLIDOS')
	->setCellValue('C25', 'PERTENECE A')
	->setCellValue('E25', 'IDENTIFICACIÓN')
	->setCellValue('G25', 'CARGO')
	->setCellValue('J25', 'FIRMA')
;

// Datos
$objPHPExcel->getActiveSheet()
	->setCellValue('A7', $solicitud->Municipio)
	->setCellValue('C7', $solicitud->Sector)
	->setCellValue('G7', date("d", strtotime($solicitud->Fecha)))
	->setCellValue('I7', date("m", strtotime($solicitud->Fecha)))
	->setCellValue('K7', date("Y", strtotime($solicitud->Fecha)))
	->setCellValue('C9', 'CARRETERO')
	->setCellValue('C10', $solicitud->Proyecto)
	->setCellValue('C11', $solicitud->Empresa)
	->setCellValue('C12', $solicitud->Interventoria)
	->setCellValue('C13', $solicitud->Numero_Contrato)
	->setCellValue('C14', $solicitud->Tipo)
	->setCellValue('C15', $solicitud->Numero_Contrato_Interventoria)
	->setCellValue('B20', $solicitud->Peticionario)
	->setCellValue('E20', $solicitud->Cedula)
	->setCellValue('E21', $solicitud->Telefono)
	->setCellValue('G20', $solicitud->Email)
	->setCellValue('G21', $solicitud->Celular)
	->setCellValue('J21', $solicitud->Nit)
	->setCellValue('E22', $solicitud->Direccion)
;

$objPHPExcel->getActiveSheet()->setDinamicSizeRow($solicitud->Objeto, 16, "C:L");
$objPHPExcel->getActiveSheet()->setDinamicSizeRow($solicitud->Alcance, 17, "C:L");

// Estilos
$objPHPExcel->getActiveSheet()->getStyle("A1:L3")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("B1")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("B2:B3")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("J1:J3")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("A5")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("A6:L6")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("F7")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("H7")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("J7")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("A8")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("A9:A17")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("A19")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("A20")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("D20:D22")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("F20:F21")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("I21")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("A24:J25")->applyFromArray($centrado_negrita);
$objPHPExcel->getActiveSheet()->getStyle("A1:L3")->applyFromArray($bordes);
$objPHPExcel->getActiveSheet()->getStyle("A5:L17")->applyFromArray($bordes);
$objPHPExcel->getActiveSheet()->getStyle("A19:L22")->applyFromArray($bordes);
$objPHPExcel->getActiveSheet()->getStyle("A19")->applyFromArray($centrado_negrita);

$fila = 26;
foreach ($participantes as $participante) {
	// Celdas a combinar
	$objPHPExcel->getActiveSheet()
		->mergeCells("A{$fila}:B{$fila}")
		->mergeCells("C{$fila}:D{$fila}")
		->mergeCells("E{$fila}:F{$fila}")
		->mergeCells("G{$fila}:I{$fila}")
		->mergeCells("J{$fila}:L{$fila}")
	;

	// Datos
	$objPHPExcel->getActiveSheet()
		->setCellValue("A{$fila}", $participante->Nombre)
		->setCellValue("E{$fila}", $participante->Documento)
		->setCellValue("G{$fila}", $participante->Cargo)
	;

	// Estilos
	$objPHPExcel->getActiveSheet()->getStyle("A24:L{$fila}")->applyFromArray($bordes);
	
	$fila++;
}

$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);
$fila++;
$fila_inicial = $fila;

$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:L{$fila}")
	->setCellValue("A{$fila}", '5. DATOS GENERALES')
	->getStyle("A{$fila}")->applyFromArray($centrado_negrita)
;

$fila++;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:F{$fila}")
	->mergeCells("G{$fila}:L{$fila}")
	->setCellValue("A{$fila}", 'IDENTIFICACIÓN DE LA VÍA')
	->setCellValue("G{$fila}", 'UBICACIÓN DEL PERMISO')
	->getStyle("A{$fila}:G{$fila}")->applyFromArray($centrado_negrita)
;

$fila++;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:F{$fila}")
	->mergeCells("I{$fila}:L{$fila}")
	->setCellValue("A{$fila}", 'NOMENCLATURA DE LA RED VIAL')
	->setCellValue("G{$fila}", 'PR INICIAL')
	->setCellValue("H{$fila}", 'PR FINAL')
	->setCellValue("I{$fila}", 'MARGEN')
	->getStyle("A{$fila}:I{$fila}")->applyFromArray($centrado_negrita)
;

$fila++;

// Si no tiene ningún registro, agrega una fila vacía
if(count($vias) == 0) $fila++;

foreach ($vias as $via) {
	// Márgenes
	$margen_derecha = ($via->Fk_Id_Tipo_Costado == 1) ? "X" : "" ;
	$margen_izquierda = ($via->Fk_Id_Tipo_Costado == 2) ? "X" : "" ;

	$objPHPExcel->getActiveSheet()
		->mergeCells("C{$fila}:D{$fila}")
		->mergeCells("E{$fila}:F{$fila}")
		->setCellValue("A{$fila}", 'CÓDIGO')
		->setCellValue("C{$fila}", 'CATEGORÍA')
		->setCellValue("I{$fila}", 'DERECHO')
		->setCellValue("K{$fila}", 'IZQUIERDO')
		->setCellValue("B{$fila}", $via->Codigo)
		->setCellValue("E{$fila}", $via->Categoria)
		->setCellValue("G{$fila}", $via->Abscisa_Inicial)
		->setCellValue("H{$fila}", $via->Abscisa_Final)
		->setCellValue("J{$fila}", $margen_derecha)
		->setCellValue("L{$fila}", $margen_izquierda)
	;

	$objPHPExcel->getActiveSheet()->getStyle("J{$fila}")->applyFromArray($centrado);
	$objPHPExcel->getActiveSheet()->getStyle("L{$fila}")->applyFromArray($centrado);

	$fila++;
}

// Estilos
$fila--;
$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);
$fila++;

$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$fila_inicial = $fila;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:L{$fila}")
	->setCellValue("A{$fila}", 'ELEMENTOS DE LA RED VIAL CARRETERA O FERREA ALEDAÑOS A LA OBRA A EJECUTAR -  PR. INICIAL Y FINAL')
	->getStyle("A{$fila}")->applyFromArray($centrado_negrita)
;

$elementos = $this->configuracion_model->obtener("elementos");

$fila++;
$objPHPExcel->getActiveSheet()
	->mergeCells("C{$fila}:D{$fila}")
	->mergeCells("E{$fila}:F{$fila}")
	->mergeCells("G{$fila}:H{$fila}")
	->mergeCells("I{$fila}:J{$fila}")
	->mergeCells("K{$fila}:L{$fila}")
	->setCellValue("A{$fila}", $elementos[0]->Nombre)
	->setCellValue("B{$fila}", $elementos[1]->Nombre)
	->setCellValue("C{$fila}", $elementos[2]->Nombre)
	->setCellValue("E{$fila}", $elementos[3]->Nombre)
	->setCellValue("G{$fila}", $elementos[4]->Nombre)
	->setCellValue("I{$fila}", $elementos[5]->Nombre)
	->setCellValue("K{$fila}", $elementos[6]->Nombre)
	->getStyle("A{$fila}:K{$fila}")->applyFromArray($centrado)
;
$fila++;

$objPHPExcel->getActiveSheet()
	->mergeCells("C{$fila}:D{$fila}")
	->mergeCells("E{$fila}:F{$fila}")
	->mergeCells("G{$fila}:H{$fila}")
	->mergeCells("I{$fila}:J{$fila}")
	->mergeCells("K{$fila}:L{$fila}")
;

// Arreglo de celdas
$celdas = array("A", "B", "C", "E", "G", "I", "K");

for ($i=0; $i < count($celdas); $i++) { 
	$registro = $this->solicitud_model->obtener("elemento_solicitud", array("Fk_Id_Solicitud" => $id_solicitud, "Fk_Id_Elemento" => $elementos[$i]->Pk_Id));
	if(isset($registro->Abscisa_Inicial)){
		$objPHPExcel->getActiveSheet()->setCellValue("{$celdas[$i]}{$fila}", "PR $registro->Abscisa_Inicial a PR $registro->Abscisa_Final");
	}
}

// Estilos
$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:L{$fila}")
	->setCellValue("A{$fila}", '6. DOCUMENTACIÓN ENTREGADA POR EL PETICIONARIO')
	->getStyle("A{$fila}")->applyFromArray($centrado_negrita)
;

$fila_inicial = $fila;
$fila++;
$fila2 = $fila+1;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:B{$fila2}")
	->mergeCells("C{$fila}:D{$fila}")
	->mergeCells("E{$fila}:L{$fila2}")
	->setCellValue("A{$fila}", 'RELACIÓN DE DOCUMENTOS')
	->setCellValue("C{$fila}", 'CUMPLE')
	->setCellValue("C{$fila2}", 'SI')
	->setCellValue("D{$fila2}", 'NO')
	->setCellValue("E{$fila}", 'OBSERVACIONES SOBRE LA DOCUMENTACIÓN')
	->getStyle("A{$fila}:L{$fila2}")->applyFromArray($centrado_negrita)
;

$valor_recuperacion_via = 0;

$fila += 2;
foreach ($tipos_documentos as $documento) {
	$lista_chequeo = $this->solicitud_model->obtener("valor_lista_chequeo", Array("Fk_Id_Tipo_Documento" => $documento->Pk_Id, "Fk_Id_Solicitud" => $id_solicitud));
	$observacion = (isset($lista_chequeo)) ? $lista_chequeo->Observacion : "N/A" ;

	$objPHPExcel->getActiveSheet()
		->mergeCells("A{$fila}:B{$fila}")
		->mergeCells("E{$fila}:L{$fila}")
	;

	$objPHPExcel->getActiveSheet()->setDinamicSizeRow("$documento->Orden - $documento->Nombre", $fila, "A:B");

	// Si el ítem es presupuesto de obra
	if(isset($lista_chequeo) && $valor_recuperacion_via == 0 & strpos($documento->Nombre, "Presupuesto") !== false){
		// Se extraen los decimales del presupuesto	
		$presupuesto = explode(",", $observacion);

		// Se extrae cualquier cadena no numérica del valor
		$valor = filter_var($presupuesto[0], FILTER_SANITIZE_NUMBER_INT) . PHP_EOL;

		// Se calcula el 30% del valor del presupuesto
		$valor_recuperacion_via = number_format(($valor * 30) / 100, 2, ',', '.');
	}

	// Si existe el registro en la lista de chequeo
	if(isset($lista_chequeo)) {
		($lista_chequeo->Cumple == 1) ? $objPHPExcel->getActiveSheet()->setCellValue("C{$fila}", "X") : $objPHPExcel->getActiveSheet()->setCellValue("D{$fila}", "X") ;
	}

	$objPHPExcel->getActiveSheet()->setDinamicSizeRow($observacion, $fila, "E:L");

	$fila++;
}

$fila--;
$objPHPExcel->getActiveSheet()->getStyle("C{$fila_inicial}:D{$fila}")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);
$fila++;

$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$objPHPExcel->getActiveSheet()->setDinamicSizeRow("VALOR ESTIMADO DE RECUPERACIÓN DE LA VÍA (no podrá ser superior al 30% del valor total de las obras objeto del permiso ni inferior a 50 SMMLV y se debe anexar respectiva metodología)", $fila, "A:D");
$objPHPExcel->getActiveSheet()->setCellValue("E{$fila}", "$ $valor_recuperacion_via");

$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:D{$fila}")
	->mergeCells("E{$fila}:L{$fila}")
	->getStyle("A{$fila}")->applyFromArray($negrita)
;
$objPHPExcel->getActiveSheet()->getStyle("A{$fila}:L{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:D{$fila}")
	->mergeCells("E{$fila}:L{$fila}")
	->setCellValue("A{$fila}", 'COSTO ANUAL DE OPERACIÓN DEL PASO FERREO A NIVEL')
	->setCellValue("E{$fila}", 'N/A')
	->getStyle("A{$fila}")->applyFromArray($negrita)
;
$objPHPExcel->getActiveSheet()->getStyle("A{$fila}:L{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$fila_inicial = $fila;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:L{$fila}")
	->setCellValue("A{$fila}", '7. INSTRUCCIONES PARA EL MANTENIMIENTO Y LA REHABILITACIÓN DE LAS OBRAS OBJETO DE PERMISO')
	->getStyle("A{$fila}")->applyFromArray($centrado_negrita)
;

$fila++;
$objPHPExcel->getActiveSheet()->mergeCells("A{$fila}:L{$fila}");

// Si es un concepto específico
$objPHPExcel->getActiveSheet()->setDinamicSizeRow($solicitud->Instrucciones, $fila, "A:K");

$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$fila_inicial = $fila;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:L{$fila}")
	->setCellValue("A{$fila}", '8. PERMISOS OTORGADOS POR LA ENTIDAD RELACIONADOS CON LAS OBRAS OBJETO DE PERMISO')
	->getStyle("A{$fila}")->applyFromArray($centrado_negrita)
;

/**
 * Recorrido de los permisos anteriores
 */
$fila++;
$objPHPExcel->getActiveSheet()
	->mergeCells("C{$fila}:F{$fila}")
	->mergeCells("G{$fila}:L{$fila}")
	->setCellValue("A{$fila}", 'PERMISO OTORGADO No.')
	->setCellValue("B{$fila}", 'FECHA RESOLUCIÓN')
	->setCellValue("C{$fila}", 'PETICIONARIO')
	->setCellValue("G{$fila}", 'ESTADO ACTUAL DEL PERMISO RELACIONADO')
	->getStyle("A{$fila}:L{$fila}")->applyFromArray($centrado_negrita)
;

$fila++;
$objPHPExcel->getActiveSheet()
	->mergeCells("C{$fila}:F{$fila}")
	->mergeCells("G{$fila}:L{$fila}")
;

$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$objPHPExcel->getActiveSheet()->mergeCells("A{$fila}:L{$fila}");

$fila_inicial = $fila;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:L{$fila}")
	->setCellValue("A{$fila}", '9. OBSERVACIONES Y/O RECOMENDACIONES')
	->getStyle("A{$fila}")->applyFromArray($centrado_negrita)
;

$fila++;
$objPHPExcel->getActiveSheet()->mergeCells("A{$fila}:L{$fila}");

$objPHPExcel->getActiveSheet()->setDinamicSizeRow($solicitud->Observaciones, $fila, "A:K");
$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:B{$fila}")
	->setCellValue("A{$fila}", 'CONCEPTO DE VIABILIDAD:')
	->setCellValue("C{$fila}", 'VIABLE:')
	->setCellValue("E{$fila}", 'NO VIABLE:')
	->getStyle("A{$fila}")->applyFromArray($centrado_negrita)
;

$objPHPExcel->getActiveSheet()->getStyle("C{$fila_inicial}:F{$fila}")->applyFromArray($centrado);

// Si es un concepto específico
if (isset($concepto)) {
	if ($concepto->Viable == 1) {
		$objPHPExcel->getActiveSheet()->setCellValue("D{$fila}", 'X');
	} else {
		$objPHPExcel->getActiveSheet()->setCellValue("F{$fila}", 'X');
	}
}
$objPHPExcel->getActiveSheet()->getStyle("A{$fila}:F{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$fila_inicial = $fila;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:L{$fila}")
	->setCellValue("A{$fila}", '10. REGISTRO FOTOGRÁFICO')
	->getStyle("A{$fila}")->applyFromArray($centrado_negrita)
;

$fila++;
$objPHPExcel->getActiveSheet()->mergeCells("A{$fila}:L{$fila}");
$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:L{$fila}")
	->getStyle("A{$fila}")->applyFromArray($centrado)
;

$objPHPExcel->getActiveSheet()->setDinamicSizeRow("Para constancia de lo anterior, se firma la presente acta bajo la responsabilidad expresa de los que intervienen en ella de conformidad con las funciones y/u obligaciones desempeñadas por cada uno de los mismos de acuerdo con lo estipulado en la resolución 716 de 2015, a los $dia_texto ($dia) días del mes de {$mes_texto} de $anio.", $fila, "A:L");
$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);

$fila++;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(5);

$fila++;
$fila_inicial = $fila;
$objPHPExcel->getActiveSheet()
	->mergeCells("A{$fila}:C{$fila}")
	->mergeCells("D{$fila}:I{$fila}")
	->mergeCells("J{$fila}:L{$fila}")
	->setCellValue("A{$fila}", 'INTERVINIENTES')
	->setCellValue("D{$fila}", 'NOMBRE')
	->setCellValue("J{$fila}", 'FIRMA')
	->getStyle("A{$fila}:L{$fila}")->applyFromArray($centrado_negrita)
;

$fila++;
foreach ($participantes as $participante) {
	$objPHPExcel->getActiveSheet()
		->mergeCells("A{$fila}:C{$fila}")
		->mergeCells("D{$fila}:I{$fila}")
		->mergeCells("J{$fila}:L{$fila}")
		->setCellValue("D{$fila}", $participante->Nombre)
		->setCellValue("J{$fila}", '')
	;
	$objPHPExcel->getActiveSheet()->setDinamicSizeRow(($participante->Fk_Id_Empresa) ? "CONCESIONARIO Y/O ADMINISTRADOR DE LA INFRAESTRUCTURA FÉRREA" : "INTERVENTORÍA", $fila, "A:C");

	$fila++;
}

$fila--;
$objPHPExcel->getActiveSheet()->getStyle("A{$fila_inicial}:L{$fila}")->applyFromArray($bordes);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename='Solicitud $solicitud->Peticionario.xlsx'");

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>