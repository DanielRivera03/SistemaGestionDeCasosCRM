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
// CARGANDO MODELO DE VENDEDORES
require('../Modelo/mVendedoresGestiones.php');
$Usuarios=new Vendedores();
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
    // CONSULTAR VENDEDORES
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarTodosVendedores($cnn);
		  require('../Vista/BusquedaAvanzadaVendedores.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{  
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION 
    break;
    // REGISTRAR VENDEDORES {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroVendedores.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    break;  
    // REGISTRAR NUEVOS VENDEDORES -> ENVIO A BASE DE DATOS     	
    case 3:
        if($_SESSION['vsTipo']=="Administrador"){
        	$IDVendedores=$_POST['IDNVendedor'];  // ID DE VENDEDORES
        	$CODVendedores=$_POST['CODIVendedor']; // CODIGO DE VENDEDORES
        	$TIPOVendedores=$_POST['TIPVendedor']; // TIPO DE VENDEDORES
        	$NOMVendedores=$_POST['NOMBREVendedor']; // NOMBRE DE VENDEDORES
            $AREAVendedores=$_POST['AREAVendedor']; // AREA DE VENDEDORES
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDVendedores || $CODVendedores || $TIPOVendedores || $NOMVendedores || $AREAVendedores)){
                header('location:../Controlador/cGestionarVendedores.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    	       	$consulta=$Usuarios->InsertarNuevosVendedores($cnn,$IDVendedores,$CODVendedores,$TIPOVendedores,$NOMVendedores,$AREAVendedores); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION 
    break;
    // GESTIONAR VENDEDORES    
    case 4: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarTodosVendedores($cnn);
            require('../Vista/GestionarVendedores.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // EXPORTAR VENDEDORES     
    case 5:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarTodosVendedores($cnn);
            require('../Vista/ExportarVendedores.php');
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
    // ELIMINAR VENDEDORES
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Vendedores=$_GET['cod'];
            $consulta=$Usuarios->EliminarVendedoresSistema($cnn,$ID_Vendedores);
            header('location:cGestionarVendedores.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION  
    break;
    //  MODIFICAR VENDEDORES {FORMULARIO} 
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Vendedores=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnVendedor($cnn,$ID_Vendedores);
            require('../Vista/ModificarVendedores.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }  
        $cnn->close(); // CERRANDO CONEXION 
    break; 
    // MODIFICAR VENDEDORES -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $CODVendedores=$_POST['CODIVendedor']; // CODIGO DE VENDEDORES
            $TIPOVendedores=$_POST['TIPVendedor']; // TIPO DE VENDEDORES
            $NOMVendedores=$_POST['NOMBREVendedor']; // NOMBRE DE VENDEDORES
            $AREAVendedores=$_POST['AREAVendedor']; // AREA DE VENDEDORES
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($CODVendedores || $TIPOVendedores || $NOMVendedores || $AREAVendedores)){
                header('location:../Controlador/cGestionarVendedores.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarVendedor($cnn,$CODVendedores,$TIPOVendedores,$NOMVendedores,$AREAVendedores); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    break;   
     // REPORTE {PDF}
    case 'reportevendedores':
        if($_SESSION['vsTipo']=="Administrador"){
            // CONSULTA Y ENVIO DE DATOS A REPORTES
            $resp=$Usuarios->ConsultarTodosVendedores($cnn);
            $_SESSION['resp']=$resp->fetch_all(MYSQLI_ASSOC); 
            // GENERANDO REPORTE PDF FINAL
            header('location:../reportes/reportevendedores.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
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