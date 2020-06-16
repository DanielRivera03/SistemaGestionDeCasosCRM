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
// CARGANDO MODELO DE VENTAS
require('../Modelo/mVentasGestiones.php');
$Usuarios=new Ventas();
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
    // CONSULTAR FACTURAS
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarDetallesFacturas($cnn);
		  require('../Vista/BusquedaAvanzadaVentas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarDetallesFacturas($cnn);
          require('../Vista/Empleados/BusquedaAvanzadaVentas.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR FACTURAS {FORMULARIO DE REGISTRO}    
    case 2:
        if($_SESSION['vsTipo']=="Administrador"){ 
		  require('../Vista/RegistroVentas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVOS FACTURAS -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo']=="Administrador"){
        	$IDFacturacion=$_POST['IDFacturas']; // ID DE FACTURAS
        	$CODFacturacion=$_POST['CODFacturas']; // CODIGO DE FACTURAS
        	$MONTOFacturacion=$_POST['PAGOFacturas']; // MONTO DE FACTURAS
        	$MODELOFacturacion=$_POST['MODELFacturas']; // MODELO DE FACTURAS
            $LICENCIAFacturacion=$_POST['LICFacturas']; // LICENCIA DE FACTURAS
            $TIPOSIFacturacion=$_POST['TIPSIFacturas']; // TIPO SISTEMA DE FACTURAS
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDFacturacion || $CODFacturacion || $MONTOFacturacion || $MODELOFacturacion || $LICENCIAFacturacion || $TIPOSIFacturacion)){
                header('location:../Controlador/cGestionarFacturas.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		   $consulta=$Usuarios->InsertarFacturaciones($cnn,$IDFacturacion,$CODFacturacion,$MONTOFacturacion,$MODELOFacturacion,$LICENCIAFacturacion,$TIPOSIFacturacion);
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR FACTURAS    
    case 4: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarDetallesFacturas($cnn);
            require('../Vista/GestionarVentas.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR FACTURAS     
    case 5: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarDetallesFacturas($cnn);
            require('../Vista/ExportarVentas.php'); 
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
    // ELIMINAR REGISTROS DE FACTURAS
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_FacturacionClientes=$_GET['cod'];
            $consulta=$Usuarios->EliminarVentas($cnn,$ID_FacturacionClientes);
            header('location:cGestionarFacturas.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // MODIFICAR REGISTROS DE FACTURAS {FORMULARIO}
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_FacturacionClientes=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnaFacturacion($cnn,$ID_FacturacionClientes);
            require('../Vista/ModificarVentas.php');  
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;  
    // MODIFICAR REGISTROS DE FACTURAS -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IDFacturacion=$_POST['IDFacturas']; // ID DE FACTURAS
            $MONTOFacturacion=$_POST['PAGOFacturas']; // MONTO DE FACTURAS
            $MODELOFacturacion=$_POST['MODELFacturas']; // MODELO DE FACTURAS
            $LICENCIAFacturacion=$_POST['LICFacturas']; // LICENCIA DE FACTURAS
            $TIPOSIFacturacion=$_POST['TIPSIFacturas']; // TIPO SISTEMA DE FACTURAS
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDFacturacion || $MONTOFacturacion || $MODELOFacturacion || $LICENCIAFacturacion || $TIPOSIFacturacion)){
                header('location:../Controlador/cGestionarFacturas.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarFacturaciones($cnn,$IDFacturacion,$MONTOFacturacion,$MODELOFacturacion,$LICENCIAFacturacion,$TIPOSIFacturacion);
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // REPORTE {PDF}
    case 'reporteventas':
        if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
            // CONSULTA Y ENVIO DE DATOS A REPORTES
            $resp=$Usuarios->ConsultarDetallesFacturas($cnn);
            $_SESSION['resp']=$resp->fetch_all(MYSQLI_ASSOC); 
            // GENERANDO REPORTE PDF FINAL
            header('location:../reportes/reporteventas.php'); 
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