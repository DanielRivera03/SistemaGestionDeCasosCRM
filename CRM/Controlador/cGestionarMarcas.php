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
// CARGANDO MODELO DE MARCAS
require('../Modelo/mMarcasGestiones.php');
$Usuarios=new Marcas();
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
    // CONSULTAR MARCAS
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
    		$consulta=$Usuarios->ConsultarDetalleMarca($cnn);
    		require('../Vista/BusquedaAvanzadaMarcasProductos.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarDetalleMarca($cnn);
            require('../Vista/Empleados/BusquedaAvanzadaMarcasProductos.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR MARCAS {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroMarcaProductos.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVOS MARCAS -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo']=="Administrador"){
        	$IDMarcas=$_POST['IDMarcas']; // ID DE MARCA
        	$CODMarcas=$_POST['CODIGOMarcas']; // CODIGO DE MARCA
        	$NOMMarcas=$_POST['NOMBREMarcas']; // NOMBRE DE MARCA
        	$TIPMarcas=$_POST['TIPOMarcas']; // TIPO DE MARCA
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDMarcas || $CODMarcas || $NOMMarcas || $TIPMarcas)){
                header('location:../Controlador/cGestionarMarcas.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->RegistroNuevosDetalleMarca($cnn,$IDMarcas,$CODMarcas,$NOMMarcas,$TIPMarcas); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR MARCAS    
    case 4:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarDetalleMarca($cnn);
            require('../Vista/GestionarMarcasProductos.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR MARCAS     
    case 5: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarDetalleMarca($cnn);
            require('../Vista/ExportarMarcasProductos.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarDetalleMarca($cnn);
            require('../Vista/Empleados/ExportarMarcasProductos.php');
        }else{
            header ('location:../index.php');
        }
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
    // ELIMINAR MARCAS 
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Marcas=$_GET['cod'];
            $consulta=$Usuarios->EliminarMarca($cnn,$ID_Marcas);
            header('location:cGestionarMarcas.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION  
    break;
    //  MODIFICAR MARCAS {FORMULARIO} 
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Marcas=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnaMarca($cnn,$ID_Marcas);
            require('../Vista/ModificarMarcas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }  
        $cnn->close(); // CERRANDO CONEXION 
    break; 
    // MODIFICAR MARCAS -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IDMarcas=$_POST['IDMarcas']; // ID DE MARCA
            $CODMarcas=$_POST['CODIGOMarcas']; // CODIGO DE MARCA
            $NOMMarcas=$_POST['NOMBREMarcas']; // NOMBRE DE MARCA
            $TIPMarcas=$_POST['TIPOMarcas']; // TIPO DE MARCA
            //Insertar en la Tabla
            $consulta=$Usuarios->ModificarMarca($cnn,$IDMarcas,$CODMarcas,$NOMMarcas,$TIPMarcas);
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    break;   
    // REPORTE {PDF}
    case 'reportemarcaproducto':
      if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
            // CONSULTA Y ENVIO DE DATOS A REPORTES
            $resp=$Usuarios->ConsultarDetalleMarca($cnn);
            $_SESSION['resp']=$resp->fetch_all(MYSQLI_ASSOC); 
            // GENERANDO REPORTE PDF FINAL
            header('location:../reportes/reportemarcasproductos.php'); 
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