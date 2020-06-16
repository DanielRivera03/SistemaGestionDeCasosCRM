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
// CARGANDO MODELO DE USUARIOS ADMINISTRADORES
require('../Modelo/mUsuariosAdministradores.php');
$Usuarios=new UsuariosAdmin();
// ACC -> ACCION CONTROLADOR {URL} 
if(isset($_GET['acc']))
{
	$accion=$_GET['acc']; // ENVIO GET DE VALOR ACCION {URL}
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
		  $consulta=$Usuarios->ConsultarUsuariosAdmin($cnn);
		  require('../Vista/BusquedaAvanzadaUsuariosAdmin.php');
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
		  require('../Vista/RegistroAdministradores.php'); 
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
        	$IdUsuario=$_POST['IdAd']; // ID DE USUARIO
        	$CodUsuario=$_POST['CodAd']; // CODIGO DE USUARIO
        	$NomUsuario=$_POST['NomAd']; // NOMBRE USUARIO
        	$PassUsuario=$_POST['PassAd']; // CONTRASEÑA USUARIO
        	$EstadoUsuario=$_POST['EstadoAd']; // ESTADO USUARIO
        	$TipoUsuario=$_POST['TipoUAd']; // TIPO DE USUARIO
            //Capturar el nombre del archivo
            $FotoUsuarioAdmins=$_FILES['FotoPerfilAdmins']['name'];
            $destino='../Vista/dist/fotosperfiles/'.$FotoUsuarioAdmins;
            $typ=$_FILES['FotoPerfilAdmins']['type']; //Captura la extension del archivo
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdUsuario || $CodUsuario || $NomUsuario || $PassUsuario || $EstadoUsuario || $TipoUsuario || $FotoUsuarioAdmins)){
                header('location:../Controlador/cUsuariosAdministradores.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->InsertarUsuarioAdministradores($cnn,$IdUsuario,$CodUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotoUsuarioAdmins);
                //Subir la imagen al servidor
                copy($_FILES['FotoPerfilAdmins']['tmp_name'],$destino); 
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
            $consulta=$Usuarios->ConsultarUsuariosAdmin($cnn);
            require('../Vista/GestionarUsuariosAdmin.php'); 
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
            $consulta=$Usuarios->ConsultarUsuariosAdmin($cnn);
            require('../Vista/ExportarUsuariosAdmin.php'); 
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
        $cnn->close(); // CERRANDO CONEXION
        break;
    // PERFIL DE USUARIO      
    case 7:
        if($_SESSION['vsTipo']=="Administrador"){
            $consulta=$Usuarios->ConsultarUsuariosAdmin($cnn);
            require ('../Vista/PerfilUsuario.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // CIERRE DE SESION
    case 8:
        if($_SESSION['vsTipo']=="Administrador"){
            session_start(); 
            session_destroy(); 
            header('location: ../index.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;  
    // MODIFICAR PERFIL DE USUARIO ADMINISTRADORES
    case 9:
        if($_SESSION['vsTipo']=="Administrador"){
            $IdUsuario=$_POST['IdAd']; // ID USUARIO
            $NomUsuario=$_POST['NomAd']; // NOMBRE USUARIO
            $PassUsuario=$_POST['PassAd']; // CONTRASEÑA USUARIO
            $EstadoUsuario=$_POST['EstadoAd']; // ESTADO USUARIO
            $TipoUsuario=$_POST['TipoUAd']; // TIPO USUARIO
            $FotoUsuarioAdmins=$_FILES['FotoPerfilAdmins']['name']; // FOTO DE PERFIL
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdUsuario || $NomUsuario || $PassUsuario || $EstadoUsuario || $TipoUsuario)){
                    header('location:../Controlador/cUsuariosAdministradores.php?acc=7');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                if(empty($FotoUsuarioAdmins)){
                    // SI USUARIO NO INGRESA FOTO NUEVA, LLAMA SP NORMAL SIN ENVIO DE FOTO
                    $consulta=$Usuarios->ModificarPerfilUsuarioAdministradores($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario);
                }else{// CASO CONTRARIO, LLAMA SP PERSONALIZADO CON ENVIO DE FOTO
                    // NOMBRE DE FOTO A SUBIR
                    $FotoUsuarioAdmins=$_FILES['FotoPerfilAdmins']['name'];
                    $destino='../Vista/dist/fotosperfiles/'.$FotoUsuarioAdmins;
                    $typ=$_FILES['FotoPerfilAdmins']['type']; // EXTENSION ARCHIVO
                    $consulta=$Usuarios->ModificarPerfilUsuarioAdministradoresFotos($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotoUsuarioAdmins);
                    copy($_FILES['FotoPerfilAdmins']['tmp_name'],$destino);
                    // ACTUALIZAR VARIABLE DE SESION CON NUEVA FOTO DE PERFIL INSERTADA
                    $_SESSION['vsFotosPerfilesUs']=$FotoUsuarioAdmins;
                }
            }// CIERRE if(empty($FotoUsuarioAdmins))
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // ELIMINAR USUARIOS ADMINISTRADORES
    case 10:
        if($_SESSION['vsTipo']=="Administrador"){
            $IdUsuario=$_GET['cod'];
            $consulta=$Usuarios->EliminarAdministradores($cnn,$IdUsuario);
            header('location:cUsuariosAdministradores.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;  
    // MODIFICAR USUARIOS ADMINISTRADORES {FORMULARIO}
    case 11:
        if($_SESSION['vsTipo']=="Administrador"){
            $IDAdministrador=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnAdministrador($cnn,$IDAdministrador);
            require('../Vista/ModificarAdministradores.php');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR USUARIOS ADMINISTRADORES -> ENVIO A BASE DE DATOS
    case 12:
        if($_SESSION['vsTipo']=="Administrador"){
            $IdUsuario=$_POST['IdAd']; // ID DE USUARIO
            $CodUsuario=$_POST['CodAd']; // CODIGO DE USUARIO        
            $NomUsuario=$_POST['NomAd']; // NOMBRE DE USUARIO
            $PassUsuario=$_POST['PassAd']; // CONTRASEÑA DE USUARIO
            $EstadoUsuario=$_POST['EstadoAd']; // ESTADO DE USUARIO
            $TipoUsuario=$_POST['TipoUAd']; // TIPO DE USUARIO
            $FotoUsuarioAdmins=$_FILES['FotoPerfilAdmins']['name'];     // FOTO DE PERFIL
            $destino='../Vista/dist/fotosperfiles/'.$FotoUsuarioAdmins; // DESTINO {RUTA}
            $typ=$_FILES['FotoPerfilAdmins']['type']; //Captura la extension del archivo
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdUsuario ||$CodUsuario || $NomUsuario || $PassUsuario || $EstadoUsuario || $TipoUsuario || $FotoUsuarioAdmins)){
                header('location:../Controlador/cUsuariosAdministradores.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarAdministradores($cnn,$IdUsuario,$CodUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotoUsuarioAdmins); 
            }
            //Subir la imagen al servidor
            copy($_FILES['FotoPerfilAdmins']['tmp_name'],$destino); // ENVIO RUTA A BASE DE DATOS
            /*
                -> ACA NO SE ACTUALIZARA VARIABLE DE SESION, SI USUARIO MODIFICADO ES EL MISMO
                    AL QUE HA INICIADO SESION, LOS NUEVOS CAMBIOS EN SU FOTO DE PERFIL LOS PODRA
                    VER CUANDO INGRESE NUEVAMENTE
            */
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