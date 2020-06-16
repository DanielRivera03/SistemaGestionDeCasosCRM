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
// CARGANDO MODELO DE SUCURSALES
require('../Modelo/mGestionarSucursales.php');
$Usuarios=new Sucursales();
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
    // CONSULTAR SUCURSALES
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarTodasSucursales($cnn);
		  require('../Vista/BusquedaAvanzadaSucursales.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarTodasSucursales($cnn);
          require('../Vista/Empleados/BusquedaAvanzadaSucursales.php');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR SUCURSALES {FORMULARIO DE REGISTRO}    
    case 2:
        if($_SESSION['vsTipo']=="Administrador"){ 
		  require('../Vista/RegistroSucursales.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVAS SUCURSALES -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo']=="Administrador"){
        	$IDSucursal=$_POST['IDSucursales']; // ID DE SUCURSALES
        	$CODSucursal=$_POST['CODISucursales']; // CODIGO DE SUCURSALES
        	$NOMSucursal=$_POST['NOMBRSucursales']; // NOMBRE DE SUCURSALES
        	$TELSucursal=$_POST['TELESucursales']; // TELEFONO DE SUCURSALES
            $DIRSucursal=$_POST['DIRESucursales']; // DIRECCION DE SUCURSALES
            $CORREOSucursal=$_POST['CORRSucursales']; // CORREO DE SUCURSALES
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDSucursal || $CODSucursal || $NOMSucursal || $TELSucursal || $DIRSucursal || $CORREOSucursal)){
                header('location:../Controlador/cGestionarSucursales.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    	       	$consulta=$Usuarios->InsertarNuevasSucursales($cnn,$IDSucursal,$CODSucursal,$NOMSucursal,$TELSucursal,$DIRSucursal,$CORREOSucursal); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR SUCURSALES    
    case 4: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarTodasSucursales($cnn);
            require('../Vista/GestionarSucursales.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR SUCURSALES     
    case 5: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarTodasSucursales($cnn);
            require('../Vista/ExportarSucursales.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarTodasSucursales($cnn);
            require('../Vista/Empleados/ExportarSucursales.php'); 
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
    // ELIMINAR SUCURSAL
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $Id_Sucursales=$_GET['cod'];
            $consulta=$Usuarios->EliminarSucursales($cnn,$Id_Sucursales);
            header('location:cGestionarSucursales.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }  
        $cnn->close(); // CERRANDO CONEXION 
    break;              
    //  MODIFICAR SUCURSALES {FORMULARIO} 
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $Id_Sucursales=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnaSucursal($cnn,$Id_Sucursales);
            require('../Vista/ModificarSucursales.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION   
    break; 
    // MODIFICAR SUCURSALES -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $CODSucursal=$_POST['CODISucursales']; // CODIGO DE SUCURSALES
            $NOMSucursal=$_POST['NOMBRSucursales']; // NOMBRE DE SUCURSALES
            $TELSucursal=$_POST['TELESucursales']; // TELEFONO DE SUCURSALES
            $DIRSucursal=$_POST['DIRESucursales']; // DIRECCION DE SUCURSALES
            $CORREOSucursal=$_POST['CORRSucursales']; // CORREO DE SUCURSALES
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($CODSucursal || $NOMSucursal || $TELSucursal || $DIRSucursal || $CORREOSucursal)){
                header('location:../Controlador/cGestionarSucursales.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarSucursal($cnn,$CODSucursal,$NOMSucursal,$TELSucursal,$DIRSucursal,$CORREOSucursal); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION 
    break;   
     // REPORTE {PDF}
    case 'reportesucursal':
        if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
            // CONSULTA Y ENVIO DE DATOS A REPORTES
             $resp=$Usuarios->ConsultarTodasSucursales($cnn);
            $_SESSION['resp']=$resp->fetch_all(MYSQLI_ASSOC);
            // GENERANDO REPORTE PDF FINAL
            header('location:../reportes/reportesucursales.php');
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