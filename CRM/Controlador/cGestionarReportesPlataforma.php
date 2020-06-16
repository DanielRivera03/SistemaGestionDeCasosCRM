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
// CONEXION DE SISTEMA CRM -> IMPORTANDO ARCHIVO
require('../Modelo/conexion.php');
// CARGANDO MODELO DE REPORTES DE PROBLEMAS PLATAFORMA
require('../Modelo/mReportesPlataforma.php');
$Usuarios=new ReportesPlataforma();
// ACC -> ACCION CONTROLADOR {URL} 
if(isset($_GET['acc']))
{
	$accion=$_GET['acc'];  // ENVIO GET DE VALOR ACCION {URL}
}
else
{
	$accion=1; // VALOR POR DEFECTO
}
switch ($accion) 
{
    // CONSULTAR REPORTE PLATAFORMA
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarReportesPlataforma($cnn);
		  require('../Vista/BusquedaAvanzadaReportesPlataforma.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR REPORTE PLATAFORMA {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroReportesPlataforma.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            require('../Vista/Empleados/RegistroReportesPlataforma.php'); 
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVO REPORTE DE PROBLEMA PLATAFORMA -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
        	$IDDReportePlataforma=$_POST['IDReporteriaPlataforma']; // ID REPORTE
        	$IDUsuarioReportePlataforma=$_POST['CODReporteriaPlataforma']; // ID USUARIO
            $NombreUsuarioReportePlataforma=$_POST['NOMUSReporteriaPlataforma']; // NOMBRE REPORTE
        	$DetalleREReportePlataforma=$_POST['DETAPROReporteriaPlataforma']; // DETALLE REPORTE
        	$URGENCIAReportePlataforma=$_POST['NIVURReporteriaPlataforma']; // URGENCIA REPORTE
            $ESTADOReportePlataforma=$_POST['ESTReporteriaPlataforma']; // ESTADO REPORTE
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDDReportePlataforma || $IDUsuarioReportePlataforma || $NombreUsuarioReportePlataforma || $DetalleREReportePlataforma || $URGENCIAReportePlataforma || $ESTADOReportePlataforma)){
                header('location:../Controlador/cGestionarReportesPlataforma.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->InsertarReportesPlataforma($cnn,$IDDReportePlataforma,$IDUsuarioReportePlataforma,$NombreUsuarioReportePlataforma, $DetalleREReportePlataforma, $URGENCIAReportePlataforma, $ESTADOReportePlataforma);
            } 
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR REPORTE PLATAFORMA    
    case 4:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarReportesPlataforma($cnn);
            require('../Vista/GestionarReportesPlataforma.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR REPORTE PLATAFORMA     
    case 5: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarReportesPlataforma($cnn);
            require('../Vista/ExportarReportesPlataforma.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // REGRESAR AL INICIO DE LA APLICACION    
    case 6: 
        if($_SESSION['vsTipo']=="Administrador"){
            require('../Vista/AdministracionAdmin.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
    break; 
    // ELIMINAR REPORTES DE PLATAFORMA
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_ReporteSistema=$_GET['cod'];
            $consulta=$Usuarios->EliminarReportesSistema($cnn,$ID_ReporteSistema);
            header('location:cGestionarReportesPlataforma.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // MODIFICAR REPORTES DE PLATAFORMA {FORMULARIO}
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_ReporteSistema=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnReportePlataforma($cnn,$ID_ReporteSistema);
            require('../Vista/ModificarReportePlataforma.php');  
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // MODIFICAR REPORTES DE PLATAFORMA -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            // ID DE REPORTE PLATAFORMA
            $IDDReportePlataforma=$_POST['IDReporteriaPlataforma'];
            // ID USUARIO DE REPORTE PLATAFORMA
            $IDUsuarioReportePlataforma=$_POST['CODReporteriaPlataforma'];
            // NOMBRE USUARIO DE REPORTE PLATAFORMA
            $NombreUsuarioReportePlataforma=$_POST['NOMUSGSTReporteriaPlataforma']; 
            // NOMBRE USUARIO GESTIONANDO DE REPORTE PLATAFORMA
            $NombreUsuarioGestionandoReportePlataforma=$_POST['NOMUSReporteriaPlataforma'];
            // DETALLE DE REPORTE PLATAFORMA
            $DetalleREReportePlataforma=$_POST['DETAPROReporteriaPlataforma'];
            // URGENCIA DE REPORTE PLATAFORMA
            $URGENCIAReportePlataforma=$_POST['NIVURReporteriaPlataforma'];
            // ESTADO DE REPORTE PLATAFORMA
            $ESTADOReportePlataforma=$_POST['ESTReporteriaPlataforma'];
            // COMENTARIOS GESTION DE REPORTE PLATAFORMA
            $COMReportePlataforma=$_POST['COMFNReporteriaPlataforma'];
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDDReportePlataforma || $IDUsuarioReportePlataforma || $NombreUsuarioReportePlataforma || $DetalleREReportePlataforma || $URGENCIAReportePlataforma || $ESTADOReportePlataforma || $COMReportePlataforma)){
                header('location:../Controlador/cGestionarReportesPlataforma.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarReportesPlataforma($cnn,$IDDReportePlataforma,$IDUsuarioReportePlataforma,$NombreUsuarioReportePlataforma, $NombreUsuarioGestionandoReportePlataforma, $DetalleREReportePlataforma, $URGENCIAReportePlataforma, $ESTADOReportePlataforma,$COMReportePlataforma); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;              
    default: 
    	if($_SESSION['vsTipo']=="Administrador"){ 
           require ('../Vista/MensajesUsuarios/404.shtml');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
    	break;
    }
?>