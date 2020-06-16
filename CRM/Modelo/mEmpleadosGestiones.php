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
class Empleados{
  // VARIABLES DE GESTION
	private $Id_Empleado;
	private $Cod_Empleado;
	private $Nombre_Empleado;
	private $Apellido_Empleado;
	private $Dui_Empleado;
	private $Telefono_Empleado;
	private $Direccion_Empleado;

	// ID
  public function setIDEmpleados($n){
    $this->Id_Empleado=$n;
  }

  public function getIDEmpleados(){
    return $this->Id_Empleado;
  }

  // CODIGO
  public function setCODEmpleados($n){
    $this->Cod_Empleado=$n;
  }

  public function getCODEmpleados(){
    return $this->Cod_Empleado;
  }

  // NOMBRE
  public function setNOMEmpleados($n){
    $this->Nombre_Empleado=$n;
  }

  public function getNOMEmpleados(){
    return $this->Nombre_Empleado;
  }

  // APELLIDO
  public function setAPEEmpleados($n){
    $this->Apellido_Empleado=$n;
  }

  public function getAPEEmpleados(){
    return $this->Apellido_Empleado;
  }

  // DUI
  public function setDUIEmpleados($n){
    $this->Dui_Empleado=$n;
  }

  public function getDUIEmpleados(){
    return $this->Dui_Empleado;
  }

  // TELEFONO
  public function setTELEmpleados($n){
    $this->Telefono_Empleado=$n;
  }

  public function getTELEmpleados(){
    return $this->Telefono_Empleado;
  }

  // DIRECCION
  public function setDIREmpleados($n){
    $this->Direccion_Empleado=$n;
  }

  public function getDIREmpleados(){
    return $this->Direccion_Empleado;
  }

  // CONSULTA ESPECIFICA UN EMPLEADO SISTEMA POR REGISTROS {GESTIONAR EMPLEADOS SISTEMA}
  public function ConsultarUnEmpleadoSistema($cnn,$ID_EmpleadosSistema){
    $resultado=mysqli_query($cnn,"CALL ConsultaEspecificaEmpleados('".$ID_EmpleadosSistema."');");
    $Usuarios=mysqli_fetch_array($resultado);
    $this->setCODEmpleados($Usuarios['cod_empl']);
    $this->setNOMEmpleados($Usuarios['nombre']);
    $this->setAPEEmpleados($Usuarios['apellido']);
    $this->setDUIEmpleados($Usuarios['dui']);
    $this->setTELEmpleados($Usuarios['telefono']);
    $this->setDIREmpleados($Usuarios['direccion']);
  }

  // CONSULTAR TODOS LOS EMPLEADOS
  public function ConsultarEmpleados($cnn)
  {
    $resultado=mysqli_query($cnn,"CALL ConsultarEmpleados();");
    return $resultado;
  }

  // INSERTAR EMPLEADOS
	public function InsertarNuevosEmpleados($cnn,$IDEmpleado,$CODEmpleado,$NOMBEmpleado,$APELEmpleado,$DUIEmpleado,$TELEmpleado,$DIREmpleado)
	{
		$resultado=mysqli_query($cnn,"CALL RegistrarEmpleadosSistema('".$IDEmpleado."','".$CODEmpleado.
			"','".$NOMBEmpleado."','".$APELEmpleado."','".$DUIEmpleado."','".$TELEmpleado."','".$DIREmpleado."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoEmpleados.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoEmpleados.html');
		}	
	}

  // ELIMINAR EMPLEADOS
  public function EliminarEmpleadosSistema($cnn,$ID_EmpleadosSistema)
  {
    $resultado=mysqli_query($cnn,"CALL EliminarEmpleados('".$ID_EmpleadosSistema."');");
    return $resultado;
  }

  // MODIFICAR EMPLEADOS
  public function ModificarEmpleadosSistema($cnn,$IDEmpleado,$NOMBEmpleado,$APELEmpleado,$DUIEmpleado,$TELEmpleado,$DIREmpleado)
  {
    $resultado=mysqli_query($cnn,"CALL ModificarEmpleados('".$IDEmpleado."','".$NOMBEmpleado."','".$APELEmpleado."','".$DUIEmpleado."','".$TELEmpleado."','".$DIREmpleado."');");
    if($resultado)
    {
      include ('../Vista/MensajesUsuarios/RegistroModificadoEmpleadosSistema.html');
    }else
    {
      include ('../Vista/MensajesUsuarios/RegistroNoModificadoEmpleadosSistema.html');
    } 
  }
} // CIERRE DE CLASE EMPLEADOS
?>