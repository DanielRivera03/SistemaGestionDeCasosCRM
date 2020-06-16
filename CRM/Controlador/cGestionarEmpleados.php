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
// CARGANDO MODELO DE EMPLEADOS
require('../Modelo/mEmpleadosGestiones.php');
$Usuarios=new Empleados();
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
    // CONSULTAR EMPLEADOS
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarEmpleados($cnn);
		  require('../Vista/BusquedaAvanzadaEmpleados.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR EMPLEADOS {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroEmpleados.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVOS EMPLEADOS -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo']=="Administrador"){
        	$IDEmpleado=$_POST['IDEmpleados']; // ID DE EMPLEADO
        	$CODEmpleado=$_POST['CODEmpleados']; // CODIGO DE EMPLEADO 
        	$NOMBEmpleado=$_POST['NOMEmpleados']; // NOMBRE DE EMPLEADO
        	$APELEmpleado=$_POST['APEEmpleados']; // APELLIDO DE EMPLEADO
            $DUIEmpleado=$_POST['DUIEmpleados']; // DUI DE EMPLEADO
            $TELEmpleado=$_POST['TELEmpleados']; // TELEFONO DE EMPLEADO  
            $DIREmpleado=$_POST['DIREmpleados']; // DIRECCION DE EMPLEADO
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDEmpleado || $CODEmpleado || $NOMBEmpleado || $APELEmpleado || $DUIEmpleado || $TELEmpleado || $DIREmpleado)){
                header('location:../Controlador/cGestionarEmpleados.php?acc=4');
            }else{
            // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->InsertarNuevosEmpleados($cnn,$IDEmpleado,$CODEmpleado,$NOMBEmpleado,$APELEmpleado,$DUIEmpleado,$TELEmpleado,$DIREmpleado); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR EMPLEADOS    
    case 4: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarEmpleados($cnn);
            require('../Vista/GestionarEmpleados.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION   
        break; 
    // EXPORTAR EMPLEADOS     
    case 5: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarEmpleados($cnn);
            require('../Vista/ExportarEmpleados.php');
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
    // ELIMINAR EMPLEADOS SISTEMA
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_EmpleadosSistema=$_GET['cod'];
            $consulta=$Usuarios->EliminarEmpleadosSistema($cnn,$ID_EmpleadosSistema);
            header('location:cGestionarEmpleados.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR EMPLEADOS SISTEMA {FORMULARIO}
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_EmpleadosSistema=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnEmpleadoSistema($cnn,$ID_EmpleadosSistema);
            require('../Vista/ModificarEmpleados.php');  
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR EMPLEADOS SISTEMA -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IDEmpleado=$_POST['IDEmpleados']; // ID DE DE EMPLEADO
            $NOMBEmpleado=$_POST['NOMEmpleados']; // NOMBRE DE EMPLEADO
            $APELEmpleado=$_POST['APEEmpleados']; // APELLIDO DE EMPLEADO
            $DUIEmpleado=$_POST['DUIEmpleados']; // DUI DE EMPLEADO
            $TELEmpleado=$_POST['TELEmpleados']; // TELEFONO DE EMPLEADO
            $DIREmpleado=$_POST['DIREmpleados']; // DIRECCION DE EMPLEADO
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDEmpleado || $NOMBEmpleado || $APELEmpleado || $DUIEmpleado || $TELEmpleado || $DIREmpleado)){
                header('location:../Controlador/cGestionarEmpleados.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarEmpleadosSistema($cnn,$IDEmpleado,$NOMBEmpleado,$APELEmpleado,$DUIEmpleado,$TELEmpleado,$DIREmpleado); 
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