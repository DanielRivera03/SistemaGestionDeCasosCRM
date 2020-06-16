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
class Ciudades{
  // VARIABLES DE GESTION
  private $IdCiudad;
  private $CodCiudad;
  private $NomCiudad;

  // ID
  public function setIDCiudades($n){
    $this->IdCiudad=$n;
  }

  public function getIDCiudades(){
    return $this->IdCiudad;
  }

  // CODIGO
  public function setCodCiudades($n){
    $this->CodCiudad=$n;
  }

  public function getCodCiudades(){
    return $this->CodCiudad;
  }

  // NOMBRE
  public function setNombreCiudades($n){
    $this->NomCiudad=$n;
  }

  public function getNombreCiudades(){
    return $this->NomCiudad;
  }

  // CONSULTA ESPECIFICA UN CLIENTE POR REGISTROS {GESTIONAR CLIENTES}
  public function ConsultarUnaCiudad($cnn,$ID_Ciudades){
    $resultado=mysqli_query($cnn,"CALL ConsultaCiudadesEspecifica('".$ID_Ciudades."');");
    $Usuarios=mysqli_fetch_array($resultado);
    $this->setCodCiudades($Usuarios['cod_ciudad']);
    $this->setNombreCiudades($Usuarios['nombre_ciu']);
  }

  // CONSULTAR TODOS LOS USUARIOS -> ADMINISTRADORES
  public function ConsultarCiudades($cnn)
  {
    $resultado=mysqli_query($cnn,"CALL ConsultarCiudadesRegistradas();");
    return $resultado;
  }

  // INSERTAR CIUDADES
  public function InsertarCiudad($cnn,$IdCiu,$CodCiu,$NomCiu)
  {
    $resultado=mysqli_query($cnn,"CALL InsertarNuevasCiudades('".$IdCiu."','".$CodCiu."','".$NomCiu."');");
    if($resultado)
    {
      include ('../Vista/MensajesUsuarios/RegistroInsertadoCiudades.html');
    }else
    {
      include ('../Vista/MensajesUsuarios/RegistroNoInsertadoCiudades.html');
    } 
  }
    // ELIMINAR CLIENTES
  public function EliminarCiudad($cnn,$ID_Ciudades)
  {
    $resultado=mysqli_query($cnn,"CALL EliminarCiudades('".$ID_Ciudades."');");
    return $resultado;
  }
  // MODIFICAR CLIENTES
  public function ModificarCiudad($cnn,$IdCiu,$CodCiu,$NomCiu)
  {
    $resultado=mysqli_query($cnn,"CALL ModificarCiudades('".$IdCiu."','".$CodCiu."','".$NomCiu."');");
    if($resultado)
    {
      include ('../Vista/MensajesUsuarios/RegistroModificadoCiudades.html');
    }else
    {
      include ('../Vista/MensajesUsuarios/RegistroNoModificadoCiudades.html');
    } 
  }
} // CIERRE DE CLASE CIUDADES
?>