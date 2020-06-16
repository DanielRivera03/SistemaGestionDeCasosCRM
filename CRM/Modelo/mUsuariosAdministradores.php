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
class UsuariosAdmin{
	// VARIABLES DE GESTION
	private $ID_Admin;
	private $Cod_Admin;
	private $Nombre_Usuario;
	private $Contrasenias;
	private $Estado;
	private $TipoUsuarios;
	private $FotosPerfiles;

	// ID
	public function setID($n){
		$this->ID_Admin=$n;
	}

	public function getID(){
		return $this->ID_Admin;
	}

	// CODIGO
	public function setCod($n){
		$this->Cod_Admin=$n;
	}

	public function getCod(){
		return $this->Cod_Admin;
	}

	// NOMBRE DE USUARIO
	public function setNombreU($n){
		$this->Nombre_Usuario=$n;
	}

	public function getNombreU(){
		return $this->Nombre_Usuario;
	}

	// CONTRASEÑA
	public function setPass($n){
		$this->Contrasenias=$n;
	}

	public function getPass(){
		return $this->Contrasenias;
	}

	// ESTADO USUARIO
	public function setEstados($n){
		$this->Estado=$n;
	}

	public function getEstados(){
		return $this->Estado;
	}

	// TIPO USUARIO
	public function setTipoUser($n){
		$this->TipoUsuarios=$n;
	}

	public function getTipoUser(){
		return $this->TipoUsuarios;
	}

	// FOTO DE PERFIL USUARIOS ADMINISTRADORES
	public function setFotosUser($n){
		$this->FotosPerfiles=$n;
	}

	public function getFotosUser(){
		return $this->FotosPerfiles;
	}

	// CONSULTAR TODOS LOS USUARIOS -> ADMINISTRADORES
	public function ConsultarUsuariosAdmin($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultaUsuariosAdministradores();");
		return $resultado;
	}

	// CONSULTA ESPECIFICA UN ADMINISTRADOR POR REGISTROS {GESTIONAR USUARIOS ADMINISTRADORES}
	public function ConsultarUnAdministrador($cnn,$IDAdministrador){
		$resultado=mysqli_query($cnn,"CALL ConsultaAdministradoresEspecifica('".$IDAdministrador."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setCod($Usuarios['cod_admin']);
		$this->setNombreU($Usuarios['nombre_usuario']);
		$this->setPass($Usuarios['contrasenia']);
		$this->setEstados($Usuarios['estado']);
		$this->setTipoUser($Usuarios['tipo_usuario']);
		$this->setFotosUser($Usuarios['foto_perfil']);
	}

	// INSERTAR NUEVOS USUARIOS ADMINISTRADORES
	public function InsertarUsuarioAdministradores($cnn,$IdUsuario,$CodUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotoUsuarioAdmins)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarAdministradores('".$IdUsuario."','".$CodUsuario.
			"','".$NomUsuario."','".$PassUsuario."','".$EstadoUsuario."','".$TipoUsuario."','".$FotoUsuarioAdmins."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertado.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertado.html');
		}	
	}

	// MODIFICAR PERFIL USUARIOS ADMINISTRADORES {SIN FOTO DE PERFIL}
	public function ModificarPerfilUsuarioAdministradores($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarPerfilAdministradores('".$IdUsuario."','".$NomUsuario."','".$PassUsuario."','".$EstadoUsuario."','".$TipoUsuario."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoPerfilAdmins.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoPerfilAdmins.html');
		}	
	}

	// MODIFICAR PERFIL USUARIOS ADMINISTRADORES {CON FOTO DE PERFIL}
	public function ModificarPerfilUsuarioAdministradoresFotos($cnn,$IdUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotoUsuarioAdmins)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarPerfilAdministradoresFotoIncluida('".$IdUsuario."','".$NomUsuario."','".$PassUsuario."','".$EstadoUsuario."','".$TipoUsuario."','".$FotoUsuarioAdmins."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoPerfilAdmins.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoPerfilAdmins.html');
		}	
	}

	// ELIMINAR USUARIOS ADMINISTRADORES
	public function EliminarAdministradores($cnn,$IdUsuario)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarUsuariosAdministradores('".$IdUsuario."');");
		return $resultado;
	}	

	// MODIFICAR USUARIOS ADMINISTRADORES {FOTO DE PERFIL OBLIGATORIA}
	public function ModificarAdministradores($cnn,$IdUsuario,$CodUsuario,$NomUsuario,$PassUsuario,$EstadoUsuario,$TipoUsuario,$FotoUsuarioAdmins)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarUsuariosAdministradores('".$IdUsuario."','".$CodUsuario."','".$NomUsuario."','".$PassUsuario."','".$EstadoUsuario."','".$TipoUsuario."','".$FotoUsuarioAdmins."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoUsuariosAdmins.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoUsuariosAdmins.html');
		}	
	}
} // CIERRE DE CLASE USUARIOS ADMIN
?>