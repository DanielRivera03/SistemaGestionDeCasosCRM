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
// CARGANDO MODELO DE EMPRESAS
require('../Modelo/mEmpresasGestiones.php');
$Usuarios=new Empresa();
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
    // CONSULTAR EMPRESAS
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarEmpresas($cnn);
		  require('../Vista/BusquedaAvanzadaEmpresas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarEmpresas($cnn);
          require('../Vista/Empleados/BusquedaAvanzadaEmpresas.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR EMPRESAS {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroEmpresas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVAS EMPRESAS -> ENVIO A BASE DE DATOS     	
    case 3:
        if($_SESSION['vsTipo']=="Administrador"){ 
        	$IDEEmpresa=$_POST['IDEmpresa']; // ID DE EMPRESA
        	$CODIEmpresa=$_POST['CODEmpresa']; // CODIGO DE EMPRESA
        	$CODISUCEmpresa=$_POST['CODSUCREmpresa']; // CODIGO SUCURSAL DE EMPRESA
        	$MARCEmpresa=$_POST['NOMBMARCASEmpresa']; // MARCA DE EMPRESA
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDEEmpresa || $CODIEmpresa || $CODISUCEmpresa || $MARCEmpresa)){
                header('location:../Controlador/cGestionarEmpresas.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->InsertarEmpresasSistema($cnn,$IDEEmpresa,$CODIEmpresa,$CODISUCEmpresa,$MARCEmpresa);
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR EMPRESAS    
    case 4:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarEmpresas($cnn);
            require('../Vista/GestionarEmpresas.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR EMPRESAS     
    case 5:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarEmpresas($cnn);
            require('../Vista/ExportarEmpresas.php');
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
    // ELIMINAR EMPRESAS REGISTRADAS
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_EmpresaRegistro=$_GET['cod'];
            $consulta=$Usuarios->EliminarEmpresasRegistradas($cnn,$ID_EmpresaRegistro);
            header('location:cGestionarEmpresas.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR EMPRESAS {FORMULARIO}
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_EmpresaRegistro=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnaEmpresaSistema($cnn,$ID_EmpresaRegistro);
            require('../Vista/ModificarEmpresas.php');  
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR EMPRESAS -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IDEEmpresa=$_POST['IDEmpresa']; // ID DE EMPRESA
            $CODIEmpresa=$_POST['CODEmpresa']; // CODIGO DE EMPRESA
            $CODISUCEmpresa=$_POST['CODSUCREmpresa']; // CODIGO SUCURSAL DE EMPRESA
            $MARCEmpresa=$_POST['NOMBMARCASEmpresa']; // MARCA DE EMPRESA
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDEEmpresa || $CODIEmpresa || $CODISUCEmpresa || $MARCEmpresa)){
                header('location:../Controlador/cGestionarEmpresas.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarEmpresasRegistradas($cnn,$IDEEmpresa,$CODIEmpresa,$CODISUCEmpresa,$MARCEmpresa); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // REPORTE {PDF}
    case 'reporteempresas':
      if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
            // CONSULTA Y ENVIO DE DATOS A REPORTES
            $resp=$Usuarios->ConsultarEmpresas($cnn);
            $_SESSION['resp']=$resp->fetch_all(MYSQLI_ASSOC);
            // GENERANDO REPORTE PDF FINAL
            header('location:../reportes/reporteempresas.php'); 
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