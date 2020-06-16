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
// CARGANDO MODELO DE USUARIOS ADMINISTRATIVOS ESTRICTAMENTE
require('../Modelo/mUsuariosAdministrativos.php');
$Usuarios=new UsuariosAdministrativos();
// ACC -> ACCION CONTROLADOR {URL} 
if(isset($_GET['acc']))
{
	$accion=$_GET['acc'];   // ENVIO GET DE VALOR ACCION {URL}
}
else
{
	$accion=1; // VALOR POR DEFECTO
}
switch ($accion) 
{
    // CONSULTAR USUARIOS
    case 1:
        if($_SESSION['vsTipo']=="Administrador"){
		  $consulta=$Usuarios->ConsultarUsuariosGeneral($cnn);
		  require('../Vista/BusquedaAvanzadaUsuarios.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR USUARIOS {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']=="Administrador"){
		  require('../Vista/RegistroUsuarios.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVOS USUARIOS -> ENVIO A BASE DE DATOS     	
    case 3:
        if($_SESSION['vsTipo']=="Administrador"){
        	$IdUsuario=$_POST['IDUsuario']; // ID DE USUARIO
        	$CodUsuario=$_POST['CodigoUsuario']; // CODIGO DE USUARIO
        	$NomUsuario=$_POST['NombreUsuario']; // NOMBRE DE USUARIO
        	$PassUsuario=$_POST['PassUsuario']; // CONTRASEÑA DE USUARIO
        	$EstadoUsuario=$_POST['EstadoUsuario']; // ESTADO DE USUARIO
        	$TipoUsuario=$_POST['TipoUsuario']; // TIPO DE USUARIO
            // NOMBRE DEL ARCHIVO A SUBIR
            $FotosPerfilesEmpleados=$_FILES['FotoPerfilEmpleados']['name'];
            $destino='../Vista/dist/fotosperfiles/'.$FotosPerfilesEmpleados;
            $typ=$_FILES['FotoPerfilEmpleados']['type']; // EXTENSION DEL ARCHIVO A SUBIR
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdUsuario || $CodUsuario || $NomUsuario || $PassUsuario || $EstadoUsuario || $TipoUsuario || $FotosPerfilesEmpleados)){
                header('location:../Controlador/cUsuariosAdministrativos.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		    $consulta=$Usuarios->InsertarNuevosUsuarios($cnn,$IdUsuario,$CodUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotosPerfilesEmpleados); 
                // SUBIR IMAGEN {CADENA} Y GUARDARLA EN RUTA ASIGNADA
                copy($_FILES['FotoPerfilEmpleados']['tmp_name'],$destino);
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR USUARIOS    
    case 4: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarUsuariosGeneral($cnn);
            require('../Vista/GestionarUsuarios.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR USUARIOS     
    case 5: 
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarUsuariosGeneral($cnn);
            require('../Vista/ExportarUsuarios.php'); 
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
    // VERL PERFIL DE USUARIOS EMPLEADOS
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else if($_SESSION['vsTipo']=="Usuario"){
            $consulta=$Usuarios->ConsultarUsuariosGeneral($cnn);
            require('../Vista/Empleados/PerfilEmpleados.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // CERRAR SESION
    case 8:
        if($_SESSION['vsTipo']=="Usuario"){
            session_start(); 
            session_destroy(); 
            header('location: ../index.php');
        }else if($_SESSION['vsTipo']=="Administrador"){
            header ('location:../Vista/AdministracionAdmin.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // ELIMINAR EMPLEADOS
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IdUsuario=$_GET['cod'];
            $consulta=$Usuarios->EliminarEmpleados($cnn,$IdUsuario);
            header('location:cUsuariosAdministrativos.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // MODIFICAR EMPLEADOS {FORMULARIO}
    case 10:
        if($_SESSION['vsTipo']=="Administrador"){
            $IDEmpleados=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnEmpleado($cnn,$IDEmpleados);
            require('../Vista/ModificarUsuarios.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR EMPLEADOS -> ENVIO A BASE DE DATOS
    case 11:
        if($_SESSION['vsTipo']=="Administrador"){
            $IdUsuario=$_POST['IDUsuario']; // ID DE USUARIO
            $CodUsuario=$_POST['CodigoUsuario']; // CODIGO DE USUARIO
            $NomUsuario=$_POST['NombreUsuario']; // NOMBRE DE USUARIO
            $PassUsuario=$_POST['PassUsuario']; // CONTRASEÑA DE USUARIO
            $EstadoUsuario=$_POST['EstadoUsuario']; // ESTADO DE USUARIO
            $TipoUsuario=$_POST['TipoUsuario']; // TIPO DE USUARIO
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdUsuario || $CodUsuario || $NomUsuario || $PassUsuario || $EstadoUsuario || $TipoUsuario || $FotosPerfilesEmpleados)){
                header('location:../Controlador/cUsuariosAdministrativos.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $FotosPerfilesEmpleados=$_FILES['FotoPerfilEmpleados']['name'];   // FOTO DE USUARIO
                $destino='../Vista/dist/fotosperfiles/'.$FotosPerfilesEmpleados;  // DESTINO {RUTA}
                $typ=$_FILES['FotoPerfilEmpleados']['type']; // NOMBRE DEL ARCHIVO A SUBIR
                $consulta=$Usuarios->ModificarUsuariosEmpleados($cnn,$CodUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotosPerfilesEmpleados); 
                // ENVIO NOMBRE FOTO A BASE DE DATOS
                copy($_FILES['FotoPerfilEmpleados']['tmp_name'],$destino);
            }
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR PERFIL DE USUARIOS EMPLEADOS ADMINISTRATIVOS
    case 12:
        if($_SESSION['vsTipo']=="Usuario"){
            $IdUsuario=$_POST['IDUsuario']; // ID DE USUARIO
            $NomUsuario=$_POST['NomEmp']; // NOMBRE DE USUARIO
            $PassUsuario=$_POST['PassEmp'];  // CONTRASEÑA DE USUARIO
            $EstadoUsuario=$_POST['EstadoEmp']; // ESTADO DE USUARIO
            $TipoUsuario=$_POST['TipoUEmp']; // TIPO DE USUARIO
            // NOMBRE DEL ARCHIVO A SUBIR
            $FotosPerfilesEmpleados=$_FILES['FotoPerfilEmpleados']['name'];
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdUsuario || $NomUsuario || $PassUsuario || $EstadoUsuario || $TipoUsuario)){
                    header('location:../Controlador/cUsuariosAdministrativos.php?acc=7');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                if(empty($FotosPerfilesEmpleados)){
                    // SI USUARIO NO INGRESA FOTO NUEVA, LLAMA SP NORMAL SIN ENVIO DE FOTO
                     $consulta=$Usuarios->ModificarPerfilUsuariosEmpleados($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario);
                }else{// CASO CONTRARIO, LLAMA SP PERSONALIZADO CON ENVIO DE FOTO
                    // CAPTURAR EL NOMBRE DEL ARCHIVO
                    $FotosPerfilesEmpleados=$_FILES['FotoPerfilEmpleados']['name']; // FOTO USUARIO
                    $destino='../Vista/dist/fotosperfiles/'.$FotosPerfilesEmpleados;// DESTINO
                    $typ=$_FILES['FotoPerfilEmpleados']['type']; // NOMBRE DE ARCHIVO
                    $consulta=$Usuarios->ModificarPerfilUsuariosEmpleadosConFoto($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotosPerfilesEmpleados); 
                    // SUBIR IMAGEN {CADENA} Y GUARDARLA EN RUTA ASIGNADA
                    copy($_FILES['FotoPerfilEmpleados']['tmp_name'],$destino);
                    $_SESSION['vsFotosPerfilesEm']=$FotosPerfilesEmpleados;
                } // CIERRE if(empty($FotosPerfilesEmpleados))
            }
        }else if($_SESSION['vsTipo']=="Administrador"){
            header ('location:../Vista/AdministracionAdmin.php?acc=1');
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