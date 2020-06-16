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
class Sucursales{
	// VARIABLES DE GESTION
	private $Id_Sucursal;
	private $Cod_Sucursal;
	private $Nombre_Sucursal;
	private $Telefono_Sucursal;
	private $Direccion_Sucursal;
	private $Correo_Sucursal;

	// ID
	public function setIDSucursales($n){
		$this->Id_Sucursal=$n;
	}

	public function getIDSucursales(){
		return $this->Id_Sucursal;
	}

	// CODIGO
	public function setCODSucursales($n){
		$this->Cod_Sucursal=$n;
	}

	public function getCODSucursales(){
		return $this->Cod_Sucursal;
	}

	// NOMBRE
	public function setNOMBRESucursales($n){
		$this->Nombre_Sucursal=$n;
	}

	public function getNOMBRESucursales(){
		return $this->Nombre_Sucursal;
	}

	// TELEFONO
	public function setTELEFONOSucursales($n){
		$this->Telefono_Sucursal=$n;
	}

	public function getTELEFONOSucursales(){
		return $this->Telefono_Sucursal;
	}

	// DIRECCION
	public function setDIRECCIONSucursales($n){
		$this->Direccion_Sucursal=$n;
	}

	public function getDIRECCIONSucursales(){
		return $this->Direccion_Sucursal;
	}

	// CORREO
	public function setCORREOSucursales($n){
		$this->Correo_Sucursal=$n;
	}

	public function getCORREOSucursales(){
		return $this->Correo_Sucursal;
	}

	// CONSULTA ESPECIFICA UNA SUCURSAL POR REGISTROS {GESTIONAR SUCURSAL}
	public function ConsultarUnaSucursal($cnn,$Id_Sucursales){
		$resultado=mysqli_query($cnn,"CALL ConsultaSucursalesEspecifica('".$Id_Sucursales."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setCODSucursales($Usuarios['cod_sucursal']);
		$this->setNOMBRESucursales($Usuarios['nombre_suc']);
		$this->setTELEFONOSucursales($Usuarios['telefono']);
		$this->setDIRECCIONSucursales($Usuarios['direccion']);
		$this->setCORREOSucursales($Usuarios['correo']);
	}

	// CONSULTAR TODAS LAS SUCURSALES
	public function ConsultarTodasSucursales($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultarSucursales();");
		return $resultado;
	}

	// INSERTAR NUEVAS SUCURSALES
	public function InsertarNuevasSucursales($cnn,$IDSucursal,$CODSucursal,$NOMSucursal,$TELSucursal,$DIRSucursal,$CORREOSucursal)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarSucursalesNuevas('".$IDSucursal."','".$CODSucursal.
			"','".$NOMSucursal."','".$TELSucursal."','".$DIRSucursal."','".$CORREOSucursal."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoSucursal.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoSucursal.html');
		}	
	}
	// ELIMINAR CLIENTES
	public function EliminarSucursales($cnn,$Id_Sucursales)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarSucursalesSistema('".$Id_Sucursales."');");
		return $resultado;
	}

	// MODIFICAR CLIENTES
	public function ModificarSucursal($cnn,$CODSucursal,$NOMSucursal,$TELSucursal,$DIRSucursal,$CORREOSucursal)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarSucursalesSistema('".$CODSucursal."','".$NOMSucursal."','".$TELSucursal."','".$DIRSucursal."','".$CORREOSucursal."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoSucursales.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoSucursales.html');
		}	
	}
} // CIERRE DE CLASE SUCURSALES
?>