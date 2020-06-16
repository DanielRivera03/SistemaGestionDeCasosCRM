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
class ReportesPlataforma{
	// VARIABLES DE GESTION
	private $Id_ReportePlataforma;
	private $Id_UsuarioReportePlataforma;
	private $Nombre_UsuarioReportePlataforma;
	private $Nombre_UsuarioGestion;
	private $Detalles_ReportePlataforma;
	private $Urgencia_ReportePlataforma;
	private $Estado_ReportePlataforma;
	private $Comentarios_ReportePlataforma;

	// ID REPORTE
	public function setIDReportePlataforma($n){
		$this->Id_ReportePlataforma=$n;
	}

	public function getIDReportePlataforma(){
		return $this->Id_ReportePlataforma;
	}

	// ID USUARIO REPORTE
	public function setIDUsuarioReportePlataforma($n){
		$this->Id_UsuarioReportePlataforma=$n;
	}

	public function getIDUsuarioReportePlataforma(){
		return $this->Id_UsuarioReportePlataforma;
	}

	// NOMBRE DE USUARIO REPORTE
	public function setNombreUsuarioReportePlataforma($n){
		$this->Nombre_UsuarioReportePlataforma=$n;
	}

	public function getNombreUsuarioReportePlataforma(){
		return $this->Nombre_UsuarioReportePlataforma;
	}

	// NOMBRE DE USUARIO GESTIONANDO REPORTE
	public function setNombreUsuarioGestionReportePlataforma($n){
		$this->Nombre_UsuarioGestion=$n;
	}

	public function getNombreUsuarioGestionReportePlataforma(){
		return $this->Nombre_UsuarioGestion;
	}

	// DETALLE REPORTE
	public function setDetalleReportePlataforma($n){
		$this->Detalles_ReportePlataforma=$n;
	}

	public function getDetalleReportePlataforma(){
		return $this->Detalles_ReportePlataforma;
	}

	// URGENCIA REPORTE
	public function setUrgenciaReportePlataforma($n){
		$this->Urgencia_ReportePlataforma=$n;
	}

	public function getUrgenciaReportePlataforma(){
		return $this->Urgencia_ReportePlataforma;
	}

	// ESTADO REPORTE
	public function setEstadoReportePlataforma($n){
		$this->Estado_ReportePlataforma=$n;
	}

	public function getEstadoReportePlataforma(){
		return $this->Estado_ReportePlataforma;
	}

	// COMENTARIOS REPORTE
	public function setComentariosReportePlataforma($n){
		$this->Comentarios_ReportePlataforma=$n;
	}

	public function getComentariosReportePlataforma(){
		return $this->Comentarios_ReportePlataforma;
	}

	// CONSULTA ESPECIFICA UN REPORTE PLATAFORMA POR REGISTROS {GESTIONAR REPORTES PLATAFORMA}
	public function ConsultarUnReportePlataforma($cnn,$ID_ReporteSistema){
		$resultado=mysqli_query($cnn,"CALL ConsultaEspecificaReportesPlataforma('".$ID_ReporteSistema."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setIDUsuarioReportePlataforma($Usuarios['Id_cliente']);
		$this->setNombreUsuarioReportePlataforma($Usuarios['nombre_usuario']);
		$this->setNombreUsuarioGestionReportePlataforma($Usuarios['usuario_gestion']);
		$this->setDetalleReportePlataforma($Usuarios['DetallesReporte']);
		$this->setUrgenciaReportePlataforma($Usuarios['Urgencia']);
		$this->setEstadoReportePlataforma($Usuarios['EstadoReporte']);
		$this->setComentariosReportePlataforma($Usuarios['Comentarios_Finales']);
	}

	// CONSULTAR TODOS LOS REPORTES PROBLEMAS PLATAFORMA
	public function ConsultarReportesPlataforma($cnn)
	{
		$resultado=mysqli_query($cnn,"CALL ConsultarReportesPlataforma();");
		return $resultado;
	}

	// INSERTAR NUEVOS REPORTES DE PLATAFORMA {PROBLEMAS}
	public function InsertarReportesPlataforma($cnn,$IDDReportePlataforma,$IDUsuarioReportePlataforma,$NombreUsuarioReportePlataforma, $DetalleREReportePlataforma, $URGENCIAReportePlataforma, $ESTADOReportePlataforma)
	{
		$resultado=mysqli_query($cnn,"CALL RegistroNuevosReportesDePlataforma('".$IDDReportePlataforma."','".$IDUsuarioReportePlataforma."','".$NombreUsuarioReportePlataforma."','".$DetalleREReportePlataforma."','".$URGENCIAReportePlataforma."','".$ESTADOReportePlataforma."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroInsertadoPlataformaReportes.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoInsertadoPlataformaReportes.html');
		}	
	}

	// ELIMINAR USUARIOS ADMINISTRADORES
	public function EliminarReportesSistema($cnn,$ID_ReporteSistema)
	{
		$resultado=mysqli_query($cnn,"CALL EliminarReportesDePlataforma('".$ID_ReporteSistema."');");
		return $resultado;
	}

	// MODIFICAR REPORTES DE PLATAFORMA {PROBLEMAS}
	public function ModificarReportesPlataforma($cnn,$IDDReportePlataforma,$IDUsuarioReportePlataforma,$NombreUsuarioReportePlataforma, $NombreUsuarioGestionandoReportePlataforma, $DetalleREReportePlataforma, $URGENCIAReportePlataforma, $ESTADOReportePlataforma,$COMReportePlataforma)
	{
		$resultado=mysqli_query($cnn,"CALL ModificarReportesDePlataforma('".$IDDReportePlataforma."','".$IDUsuarioReportePlataforma."','".$NombreUsuarioReportePlataforma."','".$NombreUsuarioGestionandoReportePlataforma."','".$DetalleREReportePlataforma."','".$URGENCIAReportePlataforma."','".$ESTADOReportePlataforma."','".$COMReportePlataforma."');");
		if($resultado)
		{
			include ('../Vista/MensajesUsuarios/RegistroModificadoReportesPlataforma.html');
		}else
		{
			include ('../Vista/MensajesUsuarios/RegistroNoModificadoReportesPlataforma.html');
		}	
	}	
} // CIERRE DE CLASE REPORTES PLATAFORMA
?>