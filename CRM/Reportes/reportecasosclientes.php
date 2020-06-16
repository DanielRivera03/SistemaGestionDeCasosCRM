<?php
/*  
    ------------------------------------------------
          INFORMACION TECNICA DEL SISTEMA
    ------------------------------------------------
        -> Autor: Daniel Rivera  
            https://github.com/DanielRivera03
    
        -> Sistema gestion de Casos [CRM]
            PHP Puro / MVC
        
        -> Inspirado bajo el software de codigo
            abierto VTiger Real, este sistema no
            tiene ninguna relacion directa con 
            el sistema mencionado previamente

        -> Creditos logo: https://www.vtiger.com/
    ---------------------------------------------------
    COMPARTIDO Y LIBERADO CON FINES ACADEMICOS 
    ---------------------------------------------------   
*/
session_start();
if(!isset($_SESSION['vsTipo']))
{
	header('location:../index.php');
}
$resp=$_SESSION['resp'];
require('../reportes/fpdf/fpdf.php');
// ZONA HORARIA LOCAL -> EL SALVADOR [SV]
date_default_timezone_set('America/El_Salvador');
$pdf=new FPDF('P','mm','LETTER');
$pdf->addpage('P');
$pdf->setfont('times','I',18);
$pdf->image('../Vista/dist/images/Logo1A.jpg',10,10,20,20);
$pdf->settextcolor(139,0,139);
$pdf->cell(200,20,'Casos de Clientes',0,0,'C');
$pdf->ln(5);
$pdf->setfont('times','I',13);
$pdf->cell(00,25,'Registros de todos los casos',0,0,'C');
$pdf->Cell(0,15,date("Y-m-d"),0,0,"R");
$pdf->Cell(0,25,date("H:i:s"),0,0,"R");
$pdf->ln(30);
//Encabezado
$pdf->settextcolor(0,0,0);
$pdf->setfont('times','I',8);
$pdf->Cell(50,10,'Nombre del Cliente',0,0,'L');
$pdf->Cell(80,10,'Producto',0,0,'L');
$pdf->Cell(50,10,'Marca de Producto',0,0,'L');
$pdf->Cell(15,10,'Estado',0,0,'L');
$pdf->ln(10);
//Bucle para imprimir los datos
$pdf->setfont('times','',8);
foreach($resp as $columnas=>$fila)
{
	$pdf->Cell(50,10,utf8_decode($fila['Nombre_cliente']),0,0,'L');
	$pdf->Cell(80,10,utf8_decode($fila['Producto']),0,0,'L');
	$pdf->Cell(50,10,utf8_decode($fila['Marca']),0,0,'L');
	// CASOS EN PROCESO
	if($fila['Estado_de_reporte']=="en proceso"){
		$pdf->settextcolor(0, 184, 148);
		$pdf->Cell(15,10,utf8_decode($fila['Estado_de_reporte']),0,0,'L');
	// CASOS PENDIENTES	
	}else if($fila['Estado_de_reporte']=="pendiente"){
		$pdf->settextcolor(214, 48, 49);
		$pdf->Cell(15,10,utf8_decode($fila['Estado_de_reporte']),0,0,'L');
	// CASOS CERRADOS	
	}else if($fila['Estado_de_reporte']=="cerrado"){
		$pdf->settextcolor(45, 52, 54);
		$pdf->Cell(15,10,utf8_decode($fila['Estado_de_reporte']),0,0,'L');
	}
	$pdf->settextcolor(0,0,0);
	$pdf->ln(10);
}
//Pie de pagina
$posicionY=(240-$pdf->GetY());
$pdf->ln($posicionY);
$pdf->cell(0,0,'Total de Casos Registrados: '.count($resp),0,1,'R');
$pdf->cell(0,0,'Numero de Pagina: '.$pdf->PageNo(),0,0,'C');
$pdf->output();
?>