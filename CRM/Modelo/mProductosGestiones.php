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
	class Productos{
		// VARIABLES DE GESTION
	private $IdProducto;
	private $CodProducto;
	private $NombreProducto;
	private $TipoProducto;
	private $CantidadProducto;
	private $MarcaProducto;
	private $GarantiaProducto;

	// ID
	public function setIDProductos($n){
		$this->IdProducto=$n;
	}

	public function getIDProductos(){
		return $this->IdProducto;
	}

	// CODIGO
	public function setCodProductos($n){
		$this->CodProducto=$n;
	}

	public function getCodProductos(){
		return $this->CodProducto;
	}

	// NOMBRE
	public function setNombreProductos($n){
		$this->NombreProducto=$n;
	}

	public function getNombreProductos(){
		return $this->NombreProducto;
	}

	// TIPO
	public function setTipoProductos($n){
		$this->TipoProducto=$n;
	}

	public function getTipoProductos(){
		return $this->TipoProducto;
	}

	// CANTIDAD
	public function setCantidadProductos($n){
		$this->CantidadProducto=$n;
	}

	public function getCantidadProductos(){
		return $this->CantidadProducto;
	}

	// MARCA
	public function setMarcaProductos($n){
		$this->MarcaProducto=$n;
	}

	public function getMarcaProductos(){
		return $this->MarcaProducto;
	}

	// GARANTIA
	public function setGarantiaProductos($n){
		$this->GarantiaProducto=$n;
	}

	public function getGarantiaProductos(){
		return $this->GarantiaProducto;
	}

	// CONSULTA ESPECIFICA UN PRODUCTO POR REGISTROS {GESTIONAR PRODUCTOS}
	public function ConsultarUnProducto($cnn,$ID_Productos){
		$resultado=mysqli_query($cnn,"CALL ConsultaProductosEspecifica('".$ID_Productos."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setIDProductos($Usuarios['id_producto']);
		$this->setCodProductos($Usuarios['cod_producto']);
		$this->setNombreProductos($Usuarios['nombre']);
		$this->setTipoProductos($Usuarios['tipo']);
		$this->setCantidadProductos($Usuarios['Cantidad']);
		$this->setMarcaProductos($Usuarios['marca']);
		$this->setGarantiaProductos($Usuarios['garantia']);
	}

	// CONSULTAR PRODUCTOS
  public function ConsultarProductos($cnn)
  {
    $resultado=mysqli_query($cnn,"CALL ConsultarProductosRegistrados();");
    return $resultado;
  }

  // INSERTAR NUEVOS PRODUCTOS
	public function InsertarProductoSistema($cnn,$IDPro,$CODPro,$NOMPro,$TIPPro,$CANPro,$MARPro,$GARAPro)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarProductosSistema('".$IDPro."','".$CODPro.
			"','".$NOMPro."','".$TIPPro."','".$CANPro."','".$MARPro."','".$GARAPro."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoProductos.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoProductos.html');
		}	
	}
	// ELIMINAR CLIENTES
	public function EliminarProductoSistema($cnn,$ID_Productos)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarProductosSistema('".$ID_Productos."');");
		return $resultado;
	}

	// MODIFICAR CLIENTES
	public function ModificarProductoSistema($cnn,$IDPro,$CODPro,$NOMPro,$TIPPro,$CANPro,$MARPro,$GARAPro)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarProductosSistema('".$IDPro."','".$CODPro."','".$NOMPro."','".$TIPPro."','".$CANPro."','".$MARPro."','".$GARAPro."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoProductos.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoProductos.html');
		}	
	}
} // CIERRE DE CLASE PRODUCTOS
?>