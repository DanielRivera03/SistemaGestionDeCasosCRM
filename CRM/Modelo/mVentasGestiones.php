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
class Ventas{
	// VARIABLES DE GESTION
	private $Id_Factura;
	private $Cod_Factura;
	private $Pago_Factura;
	private $Modelo_Factura;
	private $Licencia_Factura;
	private $TipoSi_Factura;

	// ID
	public function setIDFactura($n){
		$this->Id_Factura=$n;
	}

	public function getIDFactura(){
		return $this->Id_Factura;
	}

	// CODIGO
	public function setCODFactura($n){
		$this->Cod_Factura=$n;
	}

	public function getCODFactura(){
		return $this->Cod_Factura;
	}

	// PAGO
	public function setPagoFactura($n){
		$this->Pago_Factura=$n;
	}

	public function getPagoFactura(){
		return $this->Pago_Factura;
	}

	// MODELO
	public function setModeloFactura($n){
		$this->Modelo_Factura=$n;
	}

	public function getModeloFactura(){
		return $this->Modelo_Factura;
	}

	// LICENCIA
	public function setLicenciaFactura($n){
		$this->Licencia_Factura=$n;
	}

	public function getLicenciaFactura(){
		return $this->Licencia_Factura;
	}

	// TIPO SI FACTURA
	public function setTipoSIFactura($n){
		$this->TipoSi_Factura=$n;
	}

	public function getTipoSIFactura(){
		return $this->TipoSi_Factura;
	}

	// CONSULTA ESPECIFICA UNA FACTURACION POR REGISTROS {GESTIONAR VENTAS}
	public function ConsultarUnaFacturacion($cnn,$ID_FacturacionClientes){
		$resultado=mysqli_query($cnn,"CALL 	ConsultaEspecificaFacturaciones('".$ID_FacturacionClientes."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setIDFactura($Usuarios['id_factura']);
		$this->setCODFactura($Usuarios['cod_factura']);
		$this->setPagoFactura($Usuarios['pago']);
		$this->setModeloFactura($Usuarios['modelo']);
		$this->setLicenciaFactura($Usuarios['licencia']);
		$this->setTipoSIFactura($Usuarios['tipoSI']);
	}

	// CONSULTAR TODOS LOS DETALLES DE FACTURACIONES
	public function ConsultarDetallesFacturas($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultarDetallesVentas();");
		return $resultado;
	}

	// INSERTAR NUEVOS DETALLES DE FACTURACIONES
	public function InsertarFacturaciones($cnn,$IDFacturacion,$CODFacturacion,$MONTOFacturacion,$MODELOFacturacion,$LICENCIAFacturacion,$TIPOSIFacturacion)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarNuevasFacturas('".$IDFacturacion."','".$CODFacturacion."','".$MONTOFacturacion."','".$MODELOFacturacion."','".$LICENCIAFacturacion."','".$TIPOSIFacturacion."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoFacturas.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoFacturas.html');
		}	
	}

	// ELIMINAR REGISTROS DE FACTURACIONES
	public function EliminarVentas($cnn,$ID_FacturacionClientes)
	{
		$resultado=mysqli_query($cnn, "CALL EliminarDetalleVenta('".$ID_FacturacionClientes."');");
		return $resultado;
	}

	// MODIFICAR DETALLES DE FACTURACIONES
	public function ModificarFacturaciones($cnn,$IDFacturacion,$MONTOFacturacion,$MODELOFacturacion,$LICENCIAFacturacion,$TIPOSIFacturacion)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarDetalleVenta('".$IDFacturacion."','".$MONTOFacturacion."','".$MODELOFacturacion."','".$LICENCIAFacturacion."','".$TIPOSIFacturacion."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoVentas.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoVentas.html');
		}	
	}
} // CIERRE DE CLASE VENTAS
?>