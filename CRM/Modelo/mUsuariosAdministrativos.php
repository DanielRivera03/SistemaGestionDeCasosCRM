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
class UsuariosAdministrativos{
	// VARIABLES DE GESTION
	private $ID_UsuarioGeneral;
	private $Cod_UsuarioGeneral;
	private $Nombre_UsuarioGeneral;
	private $Pass_UsuarioGeneral;
	private $Estado_UsuarioGeneral;
	private $Tipo_UsuarioGeneral;
	private $FotosPerfilesEmpleados;

	// ID
	public function setIDUsuarioGeneral($n){
		$this->ID_UsuarioGeneral=$n;
	}

	public function getIDUsuarioGeneral(){
		return $this->ID_UsuarioGeneral;
	}

	// CODIGO
	public function setCodUsuarioGeneral($n){
		$this->Cod_UsuarioGeneral=$n;
	}

	public function getCodUsuarioGeneral(){
		return $this->Cod_UsuarioGeneral;
	}

	// NOMBRE DE USUARIO
	public function setNombreDeUsuarioGeneral($n){
		$this->Nombre_UsuarioGeneral=$n;
	}

	public function getNombreDeUsuarioGeneral(){
		return $this->Nombre_UsuarioGeneral;
	}

	// CONTRASEÑA
	public function setContraseniaDeUsuarioGeneral($n){
		$this->Pass_UsuarioGeneral=$n;
	}

	public function getContraseniaDeUsuarioGeneral(){
		return $this->Pass_UsuarioGeneral;
	}

	// ESTADO
	public function setEstadoDeUsuarioGeneral($n){
		$this->Estado_UsuarioGeneral=$n;
	}

	public function getEstadoDeUsuarioGeneral(){
		return $this->Estado_UsuarioGeneral;
	}

	// TIPO DE USUARIO
	public function setTipoDeUsuarioGeneral($n){
		$this->Tipo_UsuarioGeneral=$n;
	}

	public function getTipoDeUsuarioGeneral(){
		return $this->Tipo_UsuarioGeneral;
	}

	// FOTO DE PERFIL EMPLEADOS ADMINISTRATIVOS
	public function setFotosEmpleados($n){
		$this->FotosPerfilesEmpleados=$n;
	}

	public function getFotosEmpleados(){
		return $this->FotosPerfilesEmpleados;
	}

	// CONSULTA ESPECIFICA UN EMPLEADO POR REGISTROS {GESTIONAR USUARIOS EMPLEADOS}
	public function ConsultarUnEmpleado($cnn,$IDEmpleados){
		$resultado=mysqli_query($cnn,"CALL ConsultaEmpleadosEspecifica('".$IDEmpleados."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setCodUsuarioGeneral($Usuarios['cod_cliente']);
		$this->setNombreDeUsuarioGeneral($Usuarios['nombreusuario']);
		$this->setContraseniaDeUsuarioGeneral($Usuarios['contrasenia']);
		$this->setEstadoDeUsuarioGeneral($Usuarios['estado']);
		$this->setTipoDeUsuarioGeneral($Usuarios['tipo_usuario']);
		$this->setFotosEmpleados($Usuarios['foto_perfil']);
	}

	// CONSULTAR TODOS LOS USUARIOS
	public function ConsultarUsuariosGeneral($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultarUsuariosGenerales();");
		return $resultado;
	}

	// INSERTAR NUEVOS USUARIOS ADMINISTRATIVOS {EMPLEADOS}
	public function InsertarNuevosUsuarios($cnn,$IdUsuario,$CodUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotosPerfilesEmpleados)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarUsuariosGenerales('".$IdUsuario."','".$CodUsuario.
			"','".$NomUsuario."','".$PassUsuario."','".$EstadoUsuario."','".$TipoUsuario."','".$FotosPerfilesEmpleados."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoUsuarios.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoUsuarios.html');
		}	
	}

	// ELIMINAR EMPLEADOS ADMINISTRATIVOS
	public function EliminarEmpleados($cnn,$ID_UsuarioGeneral)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarUsuariosGenerales('".$ID_UsuarioGeneral."');");
		return $resultado;
	}

	// MODIFICAR USUARIOS EMPLEADOS {FOTO DE PERFIL OBLIGATORIA}
	public function ModificarUsuariosEmpleados($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotosPerfilesEmpleados)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarUsuariosGenerales('".$IdUsuario."','".$NomUsuario."','".$PassUsuario."','".$EstadoUsuario."','".$TipoUsuario."','".$FotosPerfilesEmpleados."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoEmpleados.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoEmpleados.html');
		}	
	}	

	// MODIFICAR PERFIL USUARIOS ADMINISTRATIVOS {EMPLEADOS} [SIN FOTO DE PERFIL]
	public function ModificarPerfilUsuariosEmpleados($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarPerfilEmpleadosRegistrados('".$IdUsuario."','".$NomUsuario."','".$PassUsuario."','".$EstadoUsuario."','".$TipoUsuario."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoPerfilEmpleados.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoPerfilEmpleados.html');
		}	
	}

	// MODIFICAR PERFIL USUARIOS ADMINISTRATIVOS {EMPLEADOS} [CON FOTO DE PERFIL]
	public function ModificarPerfilUsuariosEmpleadosConFoto($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotosPerfilesEmpleados)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarPerfilEmpleadosRegistradosConFoto('".$IdUsuario."','".$NomUsuario."','".$PassUsuario."','".$EstadoUsuario."','".$TipoUsuario."','".$FotosPerfilesEmpleados."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoPerfilEmpleados.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoPerfilEmpleados.html');
		}	
	}
} // CIERRE DE CLASE USUARIOS ADMINISTRATIVOS
?>