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
class Marcas{
	// VARIABLES DE GESTION
	private $ID_Marcas;
	private $CODMarcas;
	private $NOMMarcas;
	private $TIPMarcas;

	// ID
	public function setIDMarcas($n){
		$this->ID_Marcas=$n;
	}

	public function getIDMarcas(){
		return $this->IDMarcas;
	}

	// CODIGO
	public function setCodigoMarcas($n){
		$this->CODMarcas=$n;
	}

	public function getCodigoMarcas(){
		return $this->CODMarcas;
	}

	// DETALLE
	public function setDetalleMarcas($n){
		$this->NOMMarcas=$n;
	}

	public function getDetalleMarcas(){
		return $this->NOMMarcas;
	}

	// TIPO
	public function setTipoMarcas($n){
		$this->TIPMarcas=$n;
	}

	public function getTipoMarcas(){
		return $this->TIPMarcas;
	}
	// CONSULTA ESPECIFICA UN CLIENTE POR REGISTROS {GESTIONAR CLIENTES}
	public function ConsultarUnaMarca($cnn,$ID_Marcas){
		$resultado=mysqli_query($cnn,"CALL ConsultaMarcasEspecifica('".$ID_Marcas."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setCodigoMarcas($Usuarios['cod_marca']);
		$this->setDetalleMarcas($Usuarios['marca']);
		$this->setTipoMarcas($Usuarios['tipo']);
	}
	// CONSULTAR TODOS LOS DETALLES DE MARCAS
	public function ConsultarDetalleMarca($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultarDetallesDeMarcas();");
		return $resultado;
	}

	// INSERTAR NUEVOS DETALLES MARCAS PRODUCTOS
	public function RegistroNuevosDetalleMarca($cnn,$IDMarcas,$CODMarcas,$NOMMarcas,$TIPMarcas)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarNuevosDetallesMarcas('".$IDMarcas."','".$CODMarcas."','".$NOMMarcas."','".$TIPMarcas."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoMarcas.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoMarcas.html');
		}	
	}

	// ELIMINAR CLIENTES
	public function EliminarMarca($cnn,$ID_Marcas)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarDetalleMarca('".$ID_Marcas."');");
		return $resultado;
	}

	// MODIFICAR CLIENTES
	public function ModificarMarca($cnn,$IDMarcas,$CODMarcas,$NOMMarcas,$TIPMarcas)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarDetalleMarcas('".$IDMarcas."','".$CODMarcas."','".$NOMMarcas."','".$TIPMarcas."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoMarcas.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoMarcas.html');
		}	
	}

} // CIERRE DE CLASE MARCAS
?>