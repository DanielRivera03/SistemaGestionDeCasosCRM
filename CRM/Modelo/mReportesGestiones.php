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
class ReportesClientes{
	// VARIABLES DE GESTION
	private $Id_Reporte;
	private $Id_ClienteReporte;
	private $Nombre_ClienteReporte;
	private $Nombre_EmpleadoRegistro;
	private $Nombre_EmpleadoGestionando;
	private $Producto_Reporte;
	private $Marca_Reporte;
	private $Fecha_RegistrosCasosClientes;
	private $Fecha_UltimaActualizacionCasosClientes;
	private $Detalle_ClienteReporte;
	private $Urgencia_Reporte;
	private $Estado_ClienteReporte;
	private $Comentarios_CasosClientesGestiones;

	// ID REPORTE
	public function setIDReporteria($n){
		$this->Id_Reporte=$n;
	}

	public function getIDReporteria(){
		return $this->Id_Reporte;
	}

	// ID CLIENTE
	public function setIDClienteReporteria($n){
		$this->Id_ClienteReporte=$n;
	}

	public function getIDClienteReporteria(){
		return $this->Id_ClienteReporte;
	}

	// NOMBRE CLIENTE
	public function setNombreClienteReporteria($n){
		$this->Nombre_ClienteReporte=$n;
	}

	public function getNombreClienteReporteria(){
		return $this->Nombre_ClienteReporte;
	}

	// NOMBRE EMPLEADO REGISTRO CASO
	public function setNombreEmpleadoRegistroReporteria($n){
		$this->Nombre_EmpleadoRegistro=$n;
	}

	public function getNombreEmpleadoRegistroReporteria(){
		return $this->Nombre_EmpleadoRegistro;
	}

	// NOMBRE EMPLEADO GESTIONANDO CASO
	public function setNombreEmpleadoGestionandoReporteria($n){
		$this->Nombre_EmpleadoGestionando=$n;
	}

	public function getNombreEmpleadoGestionandoReporteria(){
		return $this->Nombre_EmpleadoGestionando;
	}

	// PRODUCTO REPORTE
	public function setProductoReporteria($n){
		$this->Producto_Reporte=$n;
	}

	public function getProductoReporteria(){
		return $this->Producto_Reporte;
	}

	// MARCA PRODUCTO REPORTE
	public function setMarcaProductoReporteria($n){
		$this->Marca_Reporte=$n;
	}

	public function getMarcaProductoReporteria(){
		return $this->Marca_Reporte;
	}

	// FECHA REGISTRO REPORTE
	public function setFechaRegistroReporteria($n){
		$this->Fecha_RegistrosCasosClientes=$n;
	}

	public function getFechaRegistroReporteria(){
		return $this->Fecha_RegistrosCasosClientes;
	}

	// FECHA / HORA ULTIMA ACTUALIZACION REPORTE
	public function setFechaActualizacionReporteria($n){
		$this->Fecha_UltimaActualizacionCasosClientes=$n;
	}

	public function getFechaActualizacionReporteria(){
		return $this->Fecha_UltimaActualizacionCasosClientes;
	}

	// DETALLE REPORTE
	public function setDetalleReporteria($n){
		$this->Detalle_ClienteReporte=$n;
	}

	public function getDetalleReporteria(){
		return $this->Detalle_ClienteReporte;
	}

	// URGENCIA REPORTE
	public function setUrgenciaReporteria($n){
		$this->Urgencia_Reporte=$n;
	}

	public function getUrgenciaReporteria(){
		return $this->Urgencia_Reporte;
	}

	// ESTADO REPORTE
	public function setEstadoReporteria($n){
		$this->Estado_ClienteReporte=$n;
	}

	public function getEstadoReporteria(){
		return $this->Estado_ClienteReporte;
	}

	// COMENTARIOS EMPLEADOS -> GESTIONANDO CASOS CLIENTES
	public function setComentariosGestiones($n){
		$this->Comentarios_CasosClientesGestiones=$n;
	}

	public function getComentariosGestiones(){
		return $this->Comentarios_CasosClientesGestiones;
	}

	// CONSULTA ESPECIFICA UN CASO CLIENTE POR REGISTROS {GESTIONAR CASOS CLIENTES}
	public function ConsultarUnReportePlataforma($cnn,$ID_CasosClientes){
		$resultado=mysqli_query($cnn,"CALL ConsultaEspecificaCasosClientes('".$ID_CasosClientes."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setIDClienteReporteria($Usuarios['Id_cliente']);
		$this->setNombreClienteReporteria($Usuarios['Nombre_cliente']);
		$this->setNombreEmpleadoRegistroReporteria($Usuarios['nombre_empleado_registro']);
		$this->setNombreEmpleadoGestionandoReporteria($Usuarios['nombre_empleado_gestionando']);
		$this->setProductoReporteria($Usuarios['Producto']);
		$this->setMarcaProductoReporteria($Usuarios['Marca']);
		$this->setFechaRegistroReporteria($Usuarios['Fecha_Registro_Caso']);
		$this->setFechaActualizacionReporteria($Usuarios['Ultima_Actualizacion_Caso']);
		$this->setDetalleReporteria($Usuarios['Detalle_de_problema']);
		$this->setUrgenciaReporteria($Usuarios['Urgencia']);
		$this->setEstadoReporteria($Usuarios['Estado_de_reporte']);
		$this->setComentariosGestiones($Usuarios['Comentarios_EmpleadoGestionando']);
	}

	// CONSULTAR TODOS LOS REPORTES
	public function ConsultarReportesClientes($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultarReportesReclamosClientes();");
		return $resultado;
	}

	// INSERTAR NUEVOS CASOS DE CLIENTES
	public function InsertarReportesClientesSistema($cnn,$IDDReportes,$IDClienteReportes,$NomClienteReportes, $NomEmpleadoRegistros, $PRODReportes, $MARCAPRReportes, $FECHAREGISTROReportes, $DetallePrReportes, $URGReportes, $EstReportes)
	{
		
		$resultado=mysqli_query($cnn,"CALL RegistroNuevosReportesDeClientes('".$IDDReportes."','".$IDClienteReportes.
			"','".$NomClienteReportes."','".$NomEmpleadoRegistros."','".$PRODReportes."','".$MARCAPRReportes."','".$FECHAREGISTROReportes."','".$DetallePrReportes."','".$URGReportes."','".$EstReportes."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoClientesReportes.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoClientesReportes.html');
		}	
	}

	// MODIFICAR CASOS DE CLIENTES
	public function ModificarReportesClientesSistema($cnn,$IDDReportes,$IDClienteReportes,$NomClienteReportes, $NomEmpleadoRegistros, $NomEmpleadoGestiones, $PRODReportes, $MARCAPRReportes, $DetallePrReportes, $URGReportes, $EstReportes, $ComentariosReportesEmpleados)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarReportesDeClientes('".$IDDReportes."','".$IDClienteReportes."','".$NomClienteReportes."','".$NomEmpleadoRegistros."','".$NomEmpleadoGestiones."','".$PRODReportes."','".$MARCAPRReportes."','".$DetallePrReportes."','".$URGReportes."','".$EstReportes."','".$ComentariosReportesEmpleados."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoCasosClientes.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoCasosClientes.html');
		}	
	}

	// ELIMINAR CASOS DE CLIENTES REGISTRADOS
	public function EliminarCasosClientesSistema($cnn,$ID_CasosClientes)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarReportesDeClientes('".$ID_CasosClientes."');");
		return $resultado;
	}	
} // CIERRE DE CLASE REPORTES CLIENTES
?>