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
class Lineas{
	// VARIABLES DE GESTION
	private $Id_Linea;
	private $Cod_Linea;
	private $Tipo_Linea;

	// ID
	public function setIDLinea($n){
		$this->Id_Linea=$n;
	}

	public function getIDLinea(){
		return $this->Id_Linea;
	}

	// CODIGO
	public function setCodLinea($n){
		$this->Cod_Linea=$n;
	}

	public function getCodLinea(){
		return $this->Cod_Linea;
	}

	// TIPO LINEA
	public function setTipoLinea($n){
		$this->Tipo_Linea=$n;
	}

	public function getTipoLinea(){
		return $this->Tipo_Linea;
	}

	// CONSULTA ESPECIFICA UNA LINEA POR REGISTROS {GESTIONAR LINEAS}
	public function ConsultarUnaLineaRegistrada($cnn,$ID_LineasGestiones){
		$resultado=mysqli_query($cnn,"CALL ConsultaEspecificaLineas('".$ID_LineasGestiones."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setCodLinea($Usuarios['cod_linea']);
		$this->setTipoLinea($Usuarios['tipo']);
	}

   // CONSULTAR TODAS LAS LINEAS
  public function ConsultarLineas($cnn)
  {
    $resultado=mysqli_query($cnn,"CALL ConsultarLineasRegistradas();");
    return $resultado;
  }

  // INSERTAR NUEVAS LINEAS
	public function InsertarNuevasLineasSistema($cnn,$IDELineas,$CODILineas,$TIPPLineas)
	{
		$resultado=mysqli_query($cnn,"CALL RegistroNuevasLineas('".$IDELineas."','".$CODILineas.
			"','".$TIPPLineas."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoLineas.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoLineas.html');
		}	
	}

	// ELIMINAR LINEAS
	public function EliminarLineasGestiones($cnn,$ID_LineasGestiones)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarLineas('".$ID_LineasGestiones."');");
		return $resultado;
	}

	// MODIFICAR LINEAS
	public function ModificaeLineasSistema($cnn,$IDELineas,$TIPPLineas)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarLineas('".$IDELineas."','".$TIPPLineas."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoLineas.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoLineas.html');
		}	
	}
} // CIERRE DE CLASE LINEAS
?>