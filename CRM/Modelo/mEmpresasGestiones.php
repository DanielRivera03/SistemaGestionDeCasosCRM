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
class Empresa{
  // VARIABLES DE GESTION
	private $Id_Empresa;
	private $Cod_Empresa;
	private $Cod_EmpresaSucursal;
	private $Cod_EmpresaMarcas;

	// ID
  public function setIDEmpresa($n){
    $this->Id_Empresa=$n;
  }

  public function getIDEmpresa(){
    return $this->Id_Empresa;
  }

  // CODIGO
  public function setCODEmpresa($n){
    $this->Cod_Empresa=$n;
  }

  public function getCODEmpresa(){
    return $this->Cod_Empresa;
  }

  // CODIGO SUCURSAL
  public function setCODSucursalEmpresa($n){
    $this->Cod_EmpresaSucursal=$n;
  }

  public function getCODSucursalEmpresa(){
    return $this->Cod_EmpresaSucursal;
  }

  // MARCA -> EMPRESA
  public function setMarcaEmpresa($n){
    $this->Cod_EmpresaMarcas=$n;
  }

  public function getMarcaEmpresa(){
    return $this->Cod_EmpresaMarcas;
  }

  // CONSULTA ESPECIFICA UNA EMPRESA POR REGISTROS {GESTIONAR EMPRESAS SISTEMA}
  public function ConsultarUnaEmpresaSistema($cnn,$ID_EmpresaRegistro){
    $resultado=mysqli_query($cnn,"CALL ConsultaEspecificaEmpresas('".$ID_EmpresaRegistro."');");
    $Usuarios=mysqli_fetch_array($resultado);
    $this->setCODEmpresa($Usuarios['cod_empresa']);
    $this->setCODSucursalEmpresa($Usuarios['cod_sucursales']);
    $this->setMarcaEmpresa($Usuarios['marcas']);
  }

  // CONSULTAR TODAS LAS EMPRESAS
  public function ConsultarEmpresas($cnn)
  {
    $resultado=mysqli_query($cnn,"CALL ConsultarEmpresas();");
    return $resultado;
  }

  // INSERTAR NUEVAS EMPRESAS
	public function InsertarEmpresasSistema($cnn,$IDEEmpresa,$CODIEmpresa,$CODISUCEmpresa,$MARCEmpresa)
	{
		$resultado=mysqli_query($cnn,"CALL InsertarNuevasEmpresas('".$IDEEmpresa."','".$CODIEmpresa.
			"','".$CODISUCEmpresa."','".$MARCEmpresa."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoEmpresas.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoEmpresas.html');
		}	
	}

  // ELIMINAR EMPRESAS
  public function EliminarEmpresasRegistradas($cnn,$ID_EmpresaRegistro)
  {
    $resultado=mysqli_query($cnn,"CALL EliminarEmpresas('".$ID_EmpresaRegistro."');");
    return $resultado;
  }

  // MODIFICAR EMPRESAS
  public function ModificarEmpresasRegistradas($cnn,$IDEEmpresa,$CODIEmpresa,$CODISUCEmpresa,$MARCEmpresa)
  {
    $resultado=mysqli_query($cnn,"CALL ModificarEmpresas('".$IDEEmpresa."','".$CODIEmpresa."','".$CODISUCEmpresa."','".$MARCEmpresa."');");
    if($resultado)
    {
      include ('../Vista/MensajesUsuarios/RegistroModificadoEmpresas.html');
    }else
    {
      include ('../Vista/MensajesUsuarios/RegistroNoModificadoEmpresas.html');
    } 
  }
} // CIERRE DE CLASE EMPRESAS
?>