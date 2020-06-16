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
$pdf->cell(200,20,'Marcas Productos Registrados',0,0,'C');
$pdf->ln(5);
$pdf->setfont('times','I',13);
$pdf->cell(00,25,utf8_decode('Histórico de Marcas Productos Registrados'),0,0,'C');
$pdf->Cell(0,15,date("Y-m-d"),0,0,"R");
$pdf->Cell(0,25,date("H:i:s"),0,0,"R");
$pdf->ln(30);
//Encabezado
$pdf->settextcolor(0,0,0);
$pdf->setfont('times','I',16);  
$pdf->Cell(100,10,'Nombre Registro Marca',0,0,'L');
$pdf->Cell(100,10,'Tipo Registro Marca',0,0,'L');
$pdf->ln(10);
//Bucle para imprimir los datos
$pdf->setfont('times','',12);
foreach($resp as $columnas=>$fila)
{
	$pdf->Cell(100,10,utf8_decode($fila['marca']),0,0,'L');
	$pdf->Cell(100,10,utf8_decode($fila['tipo']),0,0,'L');
	$pdf->ln(10);
}
//Pie de pagina
$posicionY=(240-$pdf->GetY());
$pdf->ln($posicionY);
$pdf->cell(0,0,'Total de Marcas: '.count($resp),0,1,'R');
$pdf->cell(0,0,'Numero de Pagina: '.$pdf->PageNo(),0,0,'C');
$pdf->output();
?>