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
class Clientes{
	// VARIABLES DE GESTION
	private $IdCliente;
	private $CodCliente;
	private $NombreCliente;
	private $ApellidoCliente;
	private $DuiCliente;
	private $TelefonoCliente;
	private $CiudadCliente;
	private $DireccionCliente;
	private $CorreoCliente;
	private $EstadoCliente;
	private $EstadoFacturaCliente;
	// ID
	public function setIDClientesGestiones($n){
		$this->IdCliente=$n;
	}

	public function getIDClientesGestiones(){
		return $this->IdCliente;
	}

	// CODIGO
	public function setCodClientesGestiones($n){
		$this->CodCliente=$n;
	}

	public function getCodClientesGestiones(){
		return $this->CodCliente;
	}

	// NOMBRE
	public function setNombreClientesGestiones($n){
		$this->NombreCliente=$n;
	}

	public function getNombreClientesGestiones(){
		return $this->NombreCliente;
	}

	// APELLIDO
	public function setApellidoClientesGestiones($n){
		$this->ApellidoCliente=$n;
	}

	public function getApellidoClientesGestiones(){
		return $this->ApellidoCliente;
	}

	// DUI
	public function setDuiClientesGestiones($n){
		$this->DuiCliente=$n;
	}

	public function getDuiClientesGestiones(){
		return $this->DuiCliente;
	}

	// TELEFONO
	public function setTelefonoClientesGestiones($n){
		$this->TelefonoCliente=$n;
	}

	public function getTelefonoClientesGestiones(){
		return $this->TelefonoCliente;
	}

	// CIUDAD
	public function setCiudadClientesGestiones($n){
		$this->CiudadCliente=$n;
	}

	public function getCiudadClientesGestiones(){
		return $this->CiudadCliente;
	}

	// DIRECCION
	public function setDireccionClientesGestiones($n){
		$this->DireccionCliente=$n;
	}

	public function getDireccionClientesGestiones(){
		return $this->DireccionCliente;
	}

	// CORREO
	public function setCorreoClientesGestiones($n){
		$this->CorreoCliente=$n;
	}

	public function getCorreoClientesGestiones(){
		return $this->CorreoCliente;
	}

	// ESTADO CLIENTE
	public function setEstadoClientesGestiones($n){
		$this->EstadoCliente=$n;
	}

	public function getEstadoClientesGestiones(){
		return $this->EstadoCliente;
	}

	// ESTADO FACTURA CLIENTE
	public function setEstadoFacturaClientesGestiones($n){
		$this->EstadoFacturaCliente=$n;
	}

	public function getEstadoFacturaClientesGestiones(){
		return $this->EstadoFacturaCliente;
	}

	// CONSULTA ESPECIFICA UN CLIENTE POR REGISTROS {GESTIONAR CLIENTES}
	public function ConsultarUnCliente($cnn,$ID_Clientes){
		$resultado=mysqli_query($cnn,"CALL ConsultaClientesEspecifica('".$ID_Clientes."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setCodClientesGestiones($Usuarios['cod_cliente']);
		$this->setNombreClientesGestiones($Usuarios['nombre']);
		$this->setApellidoClientesGestiones($Usuarios['apellido']);
		$this->setDuiClientesGestiones($Usuarios['DUI']);
		$this->setTelefonoClientesGestiones($Usuarios['telefono']);
		$this->setCiudadClientesGestiones($Usuarios['ciudad']);
		$this->setDireccionClientesGestiones($Usuarios['direccion']);
		$this->setCorreoClientesGestiones($Usuarios['correo']);
		$this->setEstadoClientesGestiones($Usuarios['estado']);
		$this->setEstadoFacturaClientesGestiones($Usuarios['EstadoFactura']);
	}

	// CONSULTAR TODOS LOS CLIENTES
	public function ConsultarClientes($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultarClientes();");
		return $resultado;
	}

	// INSERTAR CLIENTES
	public function InsertarNuevosClientes($cnn,$IDCliente,$CodiCliente,$NombCliente,$ApelCliente,$DUICliente,$TelCliente,$CiuCliente,$DirCliente,$EmailCliente,$EstCliente,$EstFCliente)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarClientes('".$IDCliente."','".$CodiCliente.
			"','".$NombCliente."','".$ApelCliente."','".$DUICliente."','".$TelCliente."','".$CiuCliente."','".$DirCliente."','".$EmailCliente."','".$EstCliente."','".$EstFCliente."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoClientes.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoClientes.html');
		}	
	}

	// ELIMINAR CLIENTES
	public function EliminarClientesSistema($cnn,$ID_Clientes)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarClientes('".$ID_Clientes."');");
		return $resultado;
	}

	// MODIFICAR CLIENTES
	public function ModificarClientesSistema($cnn,$IDCliente,$NombCliente,$ApelCliente,$DUICliente,$TelCliente,$CiuCliente,$DirCliente,$EmailCliente,$EstCliente,$EstFCliente)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarClientes('".$IDCliente."','".$NombCliente."','".$ApelCliente."','".$DUICliente."','".$TelCliente."','".$CiuCliente."','".$DirCliente."','".$EmailCliente."','".$EstCliente."','".$EstFCliente."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoClientes.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoClientes.html');
		}	
	}
} // CIERRE DE CLASE CLIENTES
?>