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
// CARGANDO MODELO DE CIUDADES
require('../Modelo/mCiudadesGestiones.php');
$Usuarios=new Ciudades();
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
    // CONSULTAR CIUDADES
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarCiudades($cnn);
		  require('../Vista/BusquedaAvanzadaCiudades.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarCiudades($cnn);
            require('../Vista/Empleados/BusquedaAvanzadaCiudades.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR CIUDADES {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroCiudades.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVAS CIUDADES -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo']=="Administrador"){
        	$IdCiu=$_POST['IdCiudad']; // ID DE CIUDAD
        	$CodCiu=$_POST['CodCiudad']; // CODIGO DE CIUDAD
        	$NomCiu=$_POST['NomCiudad']; // NOMBRE DE CIUDAD
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdCiu || $CodCiu || $NomCiu)){
                header('location:../Controlador/cGestionarCiudades.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		    $consulta=$Usuarios->InsertarCiudad($cnn,$IdCiu,$CodCiu,$NomCiu); 
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR CIUDADES    
    case 4:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarCiudades($cnn);
            require('../Vista/GestionarCiudades.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR CIUDADES     
    case 5:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarCiudades($cnn);
            require('../Vista/ExportarCiudades.php');
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
    // ELIMINAR CIUDADES 
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Ciudades=$_GET['cod'];
            $consulta=$Usuarios->EliminarCiudad($cnn,$ID_Ciudades);
            header('location:cGestionarCiudades.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION  
    break;
    //  MODIFICAR CIUDADES {FORMULARIO} 
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Ciudades=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnaCiudad($cnn,$ID_Ciudades);
            require('../Vista/ModificarCiudades.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION  
    break; 
    // MODIFICAR CIUDADES -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IdCiu=$_POST['IDC']; // ID DE CIUDAD
            $CodCiu=$_POST['CodCiudad']; // CODIGO DE CIUDAD
            $NomCiu=$_POST['NomCiudad']; // NOMBRE DE CIUDAD
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdCiu || $CodCiu || $NomCiu)){
                header('location:../Controlador/cGestionarCiudades.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarCiudad($cnn,$IdCiu,$CodCiu,$NomCiu);
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