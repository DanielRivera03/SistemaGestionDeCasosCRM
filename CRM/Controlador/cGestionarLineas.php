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
// CARGANDO MODELO DE LINEAS
require('../Modelo/mLineasGestiones.php');
$Usuarios=new Lineas();
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
    // CONSULTAR LINEAS
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarLineas($cnn);
		  require('../Vista/BusquedaAvanzadaLineas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarLineas($cnn);
          require('../Vista/Empleados/BusquedaAvanzadaLineas.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR LINEAS {FORMULARIO DE REGISTRO}    
    case 2:
        if($_SESSION['vsTipo']=="Administrador"){ 
		  require('../Vista/RegistroLineas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVAS LINEAS -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo']=="Administrador"){
        	$IDELineas=$_POST['IDDLineas']; // ID DE LINEA
        	$CODILineas=$_POST['CODDLineas']; // CODIGO DE LINEA
        	$TIPPLineas=$_POST['TIPOSLineas']; // TIPO DE LINEA
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDELineas || $CODILineas || $TIPPLineas)){
                header('location:../Controlador/cGestionarLineas.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->InsertarNuevasLineasSistema($cnn,$IDELineas,$CODILineas,$TIPPLineas); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION   
    	break;
    // GESTIONAR LINEAS    
    case 4:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarLineas($cnn);
            require('../Vista/GestionarLineas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR LINEAS     
    case 5:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarLineas($cnn);
            require('../Vista/ExportarLineas.php'); 
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
    // ELIMINAR REGISTROS DE LINEAS
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_LineasGestiones=$_GET['cod'];
            $consulta=$Usuarios->EliminarLineasGestiones($cnn,$ID_LineasGestiones);
            header('location:cGestionarLineas.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
     // MODIFICAR REGISTROS DE LINEAS {FORMULARIO}
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_LineasGestiones=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnaLineaRegistrada($cnn,$ID_LineasGestiones);
            require('../Vista/ModificarLineas.php');  
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;   
    // MODIFICAR REGISTROS DE LINEAS -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IDELineas=$_POST['IDDLineas']; // ID DE LINEA
            $TIPPLineas=$_POST['TIPOSLineas']; // TIPO DE LINEA
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDELineas || $TIPPLineas)){
                header('location:../Controlador/cGestionarLineas.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificaeLineasSistema($cnn,$IDELineas,$TIPPLineas); 
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