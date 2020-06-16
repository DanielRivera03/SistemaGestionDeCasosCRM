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
// CARGANDO MODELO DE PRODUCTOS
require('../Modelo/mProductosGestiones.php');
$Usuarios=new Productos();
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
    // CONSULTAR PRODUCTOS
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarProductos($cnn);
		  require('../Vista/BusquedaAvanzadaProductos.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarProductos($cnn);
            require('../Vista/Empleados/BusquedaAvanzadaProductos.php');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR PRODUCTOS {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroProductos.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }  
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVOS PRODUCTOS -> ENVIO A BASE DE DATOS     	
    case 3:
        if($_SESSION['vsTipo']=="Administrador"){ 
        	$IDPro=$_POST['IDProductos']; // ID DE PRODUCTOS
        	$CODPro=$_POST['CODIProductos']; // CODIGO DE PRODUCTOS
        	$NOMPro=$_POST['NOMBProductos']; // NOMBRE DE PRODUCTOS
        	$TIPPro=$_POST['TIPProductos']; // TIPO DE PRODUCTOS
        	$CANPro=$_POST['CANProductos']; // CANTIDAD DE PRODUCTOS
        	$MARPro=$_POST['MARProductos']; // MARCA DE PRODUCTOS
            $GARAPro=$_POST['GARProductos']; // GARANTIA DE PRODUCTOS
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDPro || $CODPro || $NOMPro || $TIPPro || $CANPro || $MARPro || $GARAPro)){
                header('location:../Controlador/cGestionarProductos.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->InsertarProductoSistema($cnn,$IDPro,$CODPro,$NOMPro,$TIPPro,$CANPro,$MARPro,$GARAPro); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR PRODUCTOS    
    case 4: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarProductos($cnn);
            require('../Vista/GestionarProductos.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR PRODUCTOS     
    case 5: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarProductos($cnn);
            require('../Vista/ExportarProductos.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarProductos($cnn);
            require('../Vista/Empleados/ExportarProductos.php');
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
    // ELIMINAR CLIENTES 
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Productos=$_GET['cod'];
            $consulta=$Usuarios->EliminarProductoSistema($cnn,$ID_Productos);
            header('location:cGestionarProductos.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION  
    break;
    //  MODIFICAR CLIENTES {FORMULARIO} 
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Productos=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnProducto($cnn,$ID_Productos);
            require('../Vista/ModificarProductos.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION  
    break; 
    // MODIFICAR CLIENTES -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IDPro=$_POST['IDProductos']; // ID DE PRODUCTOS
            $CODPro=$_POST['CODIProductos']; // CODIGO DE PRODUCTOS
            $NOMPro=$_POST['NOMBProductos']; // NOMBRE DE PRODUCTOS
            $TIPPro=$_POST['TIPProductos']; // TIPO DE PRODUCTOS
            $CANPro=$_POST['CANProductos']; // CANTIDAD DE PRODUCTOS
            $MARPro=$_POST['MARProductos']; // MARCA DE PRODUCTOS
            $GARAPro=$_POST['GARProductos']; // GARANTIA DE PRODUCTOS
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDPro || $CODPro || $NOMPro || $TIPPro || $CANPro || $MARPro || $GARAPro)){
                header('location:../Controlador/cGestionarProductos.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarProductoSistema($cnn,$IDPro,$CODPro,$NOMPro,$TIPPro,$CANPro,$MARPro,$GARAPro);
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    break;   
    // REPORTE {PDF}
    case 'reporteproducto':
        if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
            // CONSULTA Y ENVIO DE DATOS A REPORTES
            $resp=$Usuarios->ConsultarProductos($cnn);
            $_SESSION['resp']=$resp->fetch_all(MYSQLI_ASSOC);
            // GENERANDO REPORTE PDF FINAL
            header('location:../reportes/reporteproductos.php');
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