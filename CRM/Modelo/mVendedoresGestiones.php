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
class Vendedores{
	// VARIABLES DE GESTION
	private $Id_Empleado;
	private $Cod_Empleado;
	private $Tipo_Empleado;
	private $Nombre_Empleado;
	private $Area_Empleado;

	// ID
	public function setIDVendedor($n){
		$this->Id_Empleado=$n;
	}

	public function getIDVendedor(){
		return $this->Id_Empleado;
	}

	// CODIGO
	public function setCODVendedor($n){
		$this->Cod_Empleado=$n;
	}

	public function getCODVendedor(){
		return $this->Cod_Empleado;
	}

	// TIPO
	public function setTipoVendedor($n){
		$this->Tipo_Empleado=$n;
	}

	public function getTipoVendedor(){
		return $this->Tipo_Empleado;
	}

	// TIPO
	public function setNombreVendedor($n){
		$this->Nombre_Empleado=$n;
	}

	public function getNombreVendedor(){
		return $this->Nombre_Empleado;
	}

	// AREA
	public function setAreaVendedor($n){
		$this->Area_Empleado=$n;
	}

	public function getAreaVendedor(){
		return $this->Area_Empleado;
	}

  	// CONSULTA ESPECIFICA UN VENDEDOR POR REGISTROS {GESTIONAR VENDEDOR}
  	public function ConsultarUnVendedor($cnn,$ID_Vendedores){
   		$resultado=mysqli_query($cnn,"CALL ConsultaVendedoresEspecifica('".$ID_Vendedores."');");
    	$Usuarios=mysqli_fetch_array($resultado);
    	$this->setCODVendedor($Usuarios['cod_empleado']);
    	$this->setTipoVendedor($Usuarios['tipo']);
    	$this->setNombreVendedor($Usuarios['nombre']);
    	$this->setAreaVendedor($Usuarios['area']);
  	}

	// CONSULTAR TODAS LOS DETALLES DE VENDEDORES
	public function ConsultarTodosVendedores($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultarVendedoresDetalles();");
		return $resultado;
	}

	// INSERTAR NUEVOS DETALLES DE VENDEDORES
	public function InsertarNuevosVendedores($cnn,$IDVendedores,$CODVendedores,$TIPOVendedores,$NOMVendedores,$AREAVendedores)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarDetallesVendedoresNuevos('".$IDVendedores."','".$CODVendedores."','".$TIPOVendedores."','".$NOMVendedores."','".$AREAVendedores."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoVendedores.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoVendedores.html');
		}	
	}
	// ELIMINAR VENDEDOR
	public function EliminarVendedoresSistema($cnn,$ID_Vendedores)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarDetalleVendedor('".$ID_Vendedores."');");
		return $resultado;
	}
  // MODIFICAR VENDEDOR
  public function ModificarVendedor($cnn,$CODVendedores,$TIPOVendedores,$NOMVendedores,$AREAVendedores)
  {
    $resultado=mysqli_query($cnn,"CALL ModificarDetalleVendedor('".$CODVendedores."','".$TIPOVendedores."','".$NOMVendedores."','".$AREAVendedores."');");
    if($resultado)
    {
      include ('../Vista/MensajesUsuarios/RegistroModificadoVendedores.html');
    }else
    {
      include ('../Vista/MensajesUsuarios/RegistroNoModificadoVendedores.html');
    } 
  }	
}  // CIERRE DE CLASE VENDEDORES
?>