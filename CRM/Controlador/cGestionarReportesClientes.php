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
// CARGANDO MODELO DE CASOS DE CLIENTES
require('../Modelo/mReportesGestiones.php');
$Usuarios=new ReportesClientes();
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
    // CONSULTAR CASOS CLIENTES
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarReportesClientes($cnn);
		  require('../Vista/BusquedaAvanzadaReportesClientes.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarReportesClientes($cnn);
          require('../Vista/Empleados/BusquedaAvanzadaReportesClientes.php');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR CASOS CLIENTES {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroReportesClientes.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            require('../Vista/Empleados/RegistroReportesClientes.php');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVOS CASOS CLIENTES -> ENVIO A BASE DE DATOS     	
    case 3:
        if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){ 
        	$IDDReportes=$_POST['IDReporteriaClientes']; // ID CASOS CLIENTES
        	$IDClienteReportes=$_POST['CODReporteriaClientes']; // ID CLIENTE CASOS CLIENTES
        	$NomClienteReportes=$_POST['NOMReporteriaClientes']; // NOMBRE EMPLEADO REGISTRO
            $NomEmpleadoRegistros=$_POST['NOMREmpleadoreporteriaClientes']; // EMPLEADO GESTIONA
        	$PRODReportes=$_POST['PRODReporteriaClientes']; // PRODUCTO CASOS CLIENTES
            $MARCAPRReportes=$_POST['MARCReporteriaClientes'];  // MARCA CASOS CLIENTES
            // CONVERSION DE FECHA MM/DD/YYYY -> YYYY/MM/DD
            $FECHAREGISTROReportes = DateTime::createFromFormat('d/m/Y', $_POST['FechaRegistroCasoCliente']); // FECHA CASOS CLIENTES
            $DetallePrReportes=$_POST['DETAPROReporteriaClientes']; // DETALLES CASOS CLIENTES
            $URGReportes=$_POST['NIVURReporteriaClientes']; // URGENCIA CASOS CLIENTES
            $EstReportes=$_POST['ESTReporteriaClientes']; // ESTADO CASOS CLIENTES
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDDReportes || $IDClienteReportes || $NomClienteReportes || $NomEmpleadoRegistros || $MARCAPRReportes || $FECHAREGISTROReportes || $DetallePrReportes || $URGReportes || $EstReportes)){
                header('location:../Controlador/cGestionarReportesClientes.php?acc=4');
            }else{
              // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
              $FechaConversionRegistro = $FECHAREGISTROReportes->format('Y/d/m'); // CONVERSION YYYY/DD/MM
    		  $consulta=$Usuarios->InsertarReportesClientesSistema($cnn,$IDDReportes,$IDClienteReportes,$NomClienteReportes, $NomEmpleadoRegistros, $PRODReportes, $MARCAPRReportes, $FechaConversionRegistro, $DetallePrReportes, $URGReportes, $EstReportes);  
            }
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR CASOS CLIENTES    
    case 4: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarReportesClientes($cnn);
            require('../Vista/GestionarReportesClientes.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarReportesClientes($cnn);
            require('../Vista/Empleados/GestionarReportesClientes.php'); 
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR CASOS CLIENTES     
    case 5: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarReportesClientes($cnn);
            require('../Vista/ExportarReportesClientes.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarReportesClientes($cnn);
            require('../Vista/Empleados/ExportarReportesClientes.php'); 
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
    // ELIMINAR CASOS DE CLIENTES 
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_CasosClientes=$_GET['cod'];
            $consulta=$Usuarios->EliminarCasosClientesSistema($cnn,$ID_CasosClientes);
            header('location:cGestionarReportesClientes.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // MODIFICAR CASOS DE CLIENTES {FORMULARIO}
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_CasosClientes=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnReportePlataforma($cnn,$ID_CasosClientes);
            require('../Vista/ModificarCasosClientes.php');  
        }else if($_SESSION['vsTipo']=="Usuario"){
            $ID_CasosClientes=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnReportePlataforma($cnn,$ID_CasosClientes);
            require('../Vista/Empleados/ModificarCasosClientes.php');  
        }
        else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR CASOS DE CLIENTES -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
            $IDDReportes=$_POST['IDReporteriaClientes']; // ID CASOS CLIENTES
            $IDClienteReportes=$_POST['CODReporteriaClientes']; // ID CLIENTE CASOS CLIENTES
            $NomClienteReportes=$_POST['NOMReporteriaClientes']; // NOMBRE CLIENTE CASOS CLIENTES
            $NomEmpleadoRegistros=$_POST['NOMREmpleadoreporteriaClientes']; // NOMBRE EMPLEADO R
            $NomEmpleadoGestiones=$_POST['NOMREmpleadoGestionandoreporteriaClientes']; // EMPLEADOG
            $PRODReportes=$_POST['PRODReporteriaClientes']; // PRODUCTO CASOS CLIENTES
            $MARCAPRReportes=$_POST['MARCReporteriaClientes'];  // MARCA CASOS CLIENTES
            $DetallePrReportes=$_POST['DETAPROReporteriaClientes']; // DETALLE CASOS CLIENTES
            $URGReportes=$_POST['NIVURReporteriaClientes']; // URGENCIA CASOS CLIENTES
            $EstReportes=$_POST['ESTReporteriaClientes']; // ESTADO CASOS CLIENTES
            // COMENTARIOS CASOS CLIENTES
            $ComentariosReportesEmpleados=$_POST['DETAPROComentariosEmpleadosReporteriaClientes'];
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDDReportes || $IDClienteReportes || $NomClienteReportes || $NomEmpleadoRegistros || $MARCAPRReportes || $DetallePrReportes || $URGReportes || $EstReportes || $ComentariosReportesEmpleados)){
                header('location:../Controlador/cGestionarReportesClientes.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarReportesClientesSistema($cnn,$IDDReportes,$IDClienteReportes,$NomClienteReportes, $NomEmpleadoRegistros, $NomEmpleadoGestiones, $PRODReportes, $MARCAPRReportes, $DetallePrReportes, $URGReportes, $EstReportes, $ComentariosReportesEmpleados);
            }
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // HISTORIAL CASOS DE CLIENTES REGISTRADOS
    case 10:
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarReportesClientes($cnn);
            require('../Vista/HistorialCasosReportesClientes.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarReportesClientes($cnn);
            require('../Vista/Empleados/HistorialCasosClientesEmpleados.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // REPORTE CASOS CLIENTES {PDF}
    case 'reportecasosclientes':
      if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
         // CONSULTA Y ENVIO DE DATOS A REPORTES
        $resp=$Usuarios->ConsultarReportesClientes($cnn);
        $_SESSION['resp']=$resp->fetch_all(MYSQLI_ASSOC);
        // GENERANDO REPORTE PDF FINAL
        header('location:../reportes/reportecasosclientes.php');
    }else{
        header ('location:../index.php');
    }   
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