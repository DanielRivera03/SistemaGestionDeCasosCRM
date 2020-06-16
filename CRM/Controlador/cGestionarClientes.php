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
// CARGANDO MODELO DE CLIENTES
require('../Modelo/mClientesGestiones.php');
$Usuarios=new Clientes();
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
    // CONSULTAR CLIENTES {BUSQUEDA AVANZADA}
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarClientes($cnn);
		  require('../Vista/BusquedaAvanzadaClientes.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarClientes($cnn);
            require('../Vista/Empleados/BusquedaAvanzadaClientes.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR CLIENTES {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroClientes.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION 
    	break;  
    // REGISTRAR NUEVOS CLIENTES -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo']=="Administrador"){
        	$IDCliente=$_POST['IdClientes']; // ID DE CLIENTE
        	$CodiCliente=$_POST['CodClientes']; // CODIGO DE CLIENTE
        	$NombCliente=$_POST['NombreClientes']; // NOMBRE DE CLIENTE
        	$ApelCliente=$_POST['ApellidoClientes']; // APELLIDO DE CLIENTE
        	$DUICliente=$_POST['DuiClientes']; // DUI DE CLIENTE
        	$TelCliente=$_POST['TelClientes']; // TELEFONO DE CLIENTE
            $CiuCliente=$_POST['CiudadClientes']; // CIUDAD DE CLIENTE
            $DirCliente=$_POST['DirClientes']; // DIRECCION DE CLIENTE
            $EmailCliente=$_POST['CorreoClientes']; // EMAIL DE CLIENTE
            $EstCliente=$_POST['EstadoClientes']; // ESTADO DE CLIENTE
            $EstFCliente=$_POST['EstadoFacturasClientes'];  // FACTURA ESTADO DE CLIENTE
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDCliente || $CodiCliente || $NombCliente || $ApelCliente || $DUICliente || $TelCliente || $CiuCliente || $DirCliente || $EmailCliente || $EstCliente || $EstFCliente)){
                header('location:../Controlador/cGestionarClientes.php?acc=4');
            }else{
            // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->InsertarNuevosClientes($cnn,$IDCliente,$CodiCliente,$NombCliente,$ApelCliente,$DUICliente,$TelCliente,$CiuCliente,$DirCliente,$EmailCliente,$EstCliente,$EstFCliente);
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR CLIENTES    
    case 4: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarClientes($cnn);
            require('../Vista/GestionarClientes.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarClientes($cnn);
            require('../Vista/Empleados/GestionarClientes.php');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR CLIENTES     
    case 5:
        if($_SESSION['vsTipo']=="Administrador"){ 
            $consulta=$Usuarios->ConsultarClientes($cnn);
            require('../Vista/ExportarClientes.php'); 
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
    // ELIMINAR CLIENTES 
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $ID_Clientes=$_GET['cod'];
            $consulta=$Usuarios->EliminarClientesSistema($cnn,$ID_Clientes);
            header('location:cGestionarClientes.php?acc=4');
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
            $ID_Clientes=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnCliente($cnn,$ID_Clientes);
            require('../Vista/ModificarClientes.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $ID_Clientes=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnCliente($cnn,$ID_Clientes);
            require('../Vista/Empleados/ModificarClientes.php');
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION  
    break; 
    // MODIFICAR CLIENTES -> ENVIO A BASE DE DATOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
            $IDCliente=$_POST['IdClientes']; // ID DE CLIENTE
            $CodiCliente=$_POST['CodClientes']; // CODIGO DE CLIENTE
            $NombCliente=$_POST['NombreClientes']; // NOMBRE DE CLIENTE
            $ApelCliente=$_POST['ApellidoClientes']; // APELLIDO DE CLIENTE
            $DUICliente=$_POST['DuiClientes']; // DUI DE CLIENTE
            $TelCliente=$_POST['TelClientes']; // TELEFONO DE CLIENTE
            $CiuCliente=$_POST['CiudadClientes']; // CIUDAD DE CLIENTE
            $DirCliente=$_POST['DirClientes']; // DIRECCION DE CLIENTE
            $EmailCliente=$_POST['CorreoClientes']; // EMAIL DE CLIENTE
            $EstCliente=$_POST['EstadoClientes']; // ESTADO DE CLIENTE
            $EstFCliente=$_POST['EstadoFacturasClientes']; // FACTURA ESTADO DE CLIENTE
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IDCliente || $CodiCliente || $NombCliente || $ApelCliente || $DUICliente || $TelCliente || $CiuCliente || $DirCliente || $EmailCliente || $EstCliente || $EstFCliente)){
                header('location:../Controlador/cGestionarClientes.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarClientesSistema($cnn,$IDCliente,$NombCliente,$ApelCliente,$DUICliente,$TelCliente,$CiuCliente,$DirCliente,$EmailCliente,$EstCliente,$EstFCliente);
            }
        }else{
            header ('location:../index.php');
        } 
        $cnn->close(); // CERRANDO CONEXION
    break;  
    // REPORTES CLIENTES PDF
    case 'reporteclientes':
    if($_SESSION['vsTipo']=="Administrador" || $_SESSION['vsTipo']=="Usuario"){
         // CONSULTA Y ENVIO DE DATOS A REPORTES
      $resp=$Usuarios->ConsultarClientes($cnn);
      $_SESSION['resp']=$resp->fetch_all(MYSQLI_ASSOC); 
      // GENERANDO REPORTE PDF FINAL
      header('location:../reportes/reporteclientes.php');
    }else{
        header ('location:../index.php');
    }
    break; 
    // OPCION NO VALIDA -> ENTONCES               
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