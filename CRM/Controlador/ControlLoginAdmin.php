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
require('../modelo/conexion.php');
// ACC -> ACCION CONTROLADOR {URL} 
if(isset($_GET['acc']))
{
	$accion=$_GET['acc'];  // ENVIO GET DE VALOR ACCION {URL}
}
else
{
	$accion=1;  // VALOR POR DEFECTO
}
switch ($accion) 
{
    case 1:
		require('../vista/LoginAdministradores.php');
    	break;	
    case 2:
    	// VALIDANDO INICIO DE SESION
    	$usuario=$con->login($cnn,$_POST['Usuario'],$_POST['Clave']);
		$login=mysqli_fetch_array($usuario);
		if($login)
		{
			// INICIALIZANDO VARIABLES DE SESION
			$_SESSION['vsUsuario']=$login['nombre_usuario'];		// NOMBRE DE USUARIO
			$_SESSION['vsTipo']=$login['tipo_usuario'];				// TIPO DE USUARIO {ROL}
			$_SESSION['vsCodigo']=$login['id_admin'];				// ID DE USUARIO {UNICO}
			$_SESSION['vsCodigoUs']=$login['cod_admin'];			// CODIGO DE USUARIO
			$_SESSION['vsFotosPerfilesUs']=$login['foto_perfil'];	// FOTO DE PERFIL DE USUARIO
			if($login['tipo_usuario']=='Administrador')
			{
				header ('location:../Vista/AdministracionAdmin.php?acc=1');
			}else{
				header ('location:../Vista/AdministracionAdmin.php?acc=2');	
			}
		}
		else
		{
				header ('location:../Vista/MensajeUsuarios.php');	
		}
    	break;
    	default:
    		header ('location:../Vista/MensajeUsuarios.php');
    	break;	
}
?>