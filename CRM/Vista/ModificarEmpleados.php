<?php
// NO PERMITIR ACCESO NO LOGUEADO
if(!isset($_GET['acc']))
{
    header('location:../Controlador/ControlLoginAdmin.php?acc=1');
}
if(!isset($_SESSION['vsCodigo']))
{
    header('location:../Controlador/ControlLoginAdmin.php?acc=1');    
}
// NO PERMITIR ACCESO OTRO ROL DIFERENTE DE USUARIO AL ACCEDIDO
if($_SESSION['vsTipo']=="Usuario"){
    header('location:../Vista/Empleados/PrincipalEmpleados.php?acc=1');
}
?>
<!DOCTYPE html>
<html lang="ES-SV">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>..:: Sistema Gesti&oacute;n de Casos vtiger | Modificar Empleados ..::</title>
    <meta name="description" content="Sistema Gesti&oacute;n de Casos vtiger CRM Espa&ntilde;ol" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="../Vista/dist/img/favicon.ico">
    <link rel="icon" href="../Vista/dist/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="../Vista/dist/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../Vista/dist/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../Vista/dist/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../Vista/dist/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../Vista/dist/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../Vista/dist/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../Vista/dist/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../Vista/dist/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../Vista/dist/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../Vista/dist/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Vista/dist/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../Vista/dist/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Vista/dist/img/favicon-16x16.png">
    <link rel="manifest" href="../Vista/dist/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../Vista/dist/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Toggles CSS -->
    <link href="../Vista/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="../Vista/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- ION CSS -->
    <link href="../Vista/vendors/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css">
    <link href="../Vista/vendors/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css" rel="stylesheet" type="text/css">

    <!-- select2 CSS -->
    <link href="../Vista/vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Pickr CSS -->
    <link href="../Vista/vendors/pickr-widget/dist/pickr.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS -->
    <link href="../Vista/vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="../Vista/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    
    
	<!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar shadow-lg shadow-hover-xl">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand font-weight-700" href="../Vista/AdministracionAdmin.php?acc=1">
                VTiger
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <!-- BUSCADOR 
                <li class="nav-item">
                    <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
                </li> -->
                <li class="nav-item">
                    <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="settings"></i></span></a>
                </li>
                <li class="nav-item dropdown dropdown-notifications">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="feather-icon"><i data-feather="bell"></i></span><span class="badge-wrap"><span class="badge badge-primary badge-indicator badge-indicator-sm badge-pill pulse"></span></span></a>
                    <!-- NOTIFICACIONES ESTATICAS -->
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <h6 class="dropdown-header">Notificaciones <a href="javascript:void(0);" class=""></a></h6>
                        <div class="notifications-nicescroll-bar">
                            <a href="javascript:void(0);" class="dropdown-item">
                                <?php
                                    // MOSTRAR TODAS LAS NUEVAS NOTIFICACIONES
                                    include('NotificacionesUsuarios.php');
                                ?>
                            </a>
                        </div>
                    </div>
                </li>
                <!-- SESION ACTIVA -->
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="../Vista/dist/fotosperfiles/<?php echo $_SESSION['vsFotosPerfilesUs'] ?>" alt="FotoPerfil" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span><?php echo $_SESSION['vsUsuario'] ?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <!-- AJUSTES PERFIL -->
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <div class="sub-dropdown-menu show-on-hover">
                            <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Activo Ahora</a>
                        </div>
                        <a class="dropdown-item" href="../Controlador/cUsuariosAdministradores.php?acc=7"><i class="dropdown-icon zmdi zmdi-account"></i><span>Mi Perfil</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../Controlador/cUsuariosAdministradores.php?acc=8"><i class="dropdown-icon zmdi zmdi-power"></i><span>Cerrar Sesi&oacute;n</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->

        <!-- MENU DE NAVEGACION -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-dark">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">


                        <!-- INICIO -->
                        <li class="nav-item">
                            <a class="nav-link" href="../Vista/AdministracionAdmin.php?acc=1" data-target="#Home">
                                <span class="feather-icon"><i data-feather="home"></i></span>
                                <span class="nav-link-text">Inicio</span>
                            </a>
                        </li>


                        <!-- USUARIOS ADMINISTRADORES -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#UsuariosAdministradores">
                                <span class="feather-icon"><i data-feather="user-x"></i></span>
                                <span class="nav-link-text">Administradores</span>
                            </a>
                            <ul id="UsuariosAdministradores" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cUsuariosAdministradores.php?acc=2">Registrar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cUsuariosAdministradores.php?acc=4">Gestionar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cUsuariosAdministradores.php?acc=1">Consultar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cUsuariosAdministradores.php?acc=5">Exportar Usuarios</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <!-- USUARIOS PLATAFORMA -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#UsuariosClientes">
                                <span class="feather-icon"><i data-feather="user-check"></i></span>
                                <span class="nav-link-text">Usuarios</span>
                            </a>
                            <ul id="UsuariosClientes" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cUsuariosAdministrativos.php?acc=2">Registrar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cUsuariosAdministrativos.php?acc=4">Gestionar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cUsuariosAdministrativos.php?acc=1">Consultar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cUsuariosAdministrativos.php?acc=5">Exportar Usuarios</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>



                        <!-- CASOS CLIENTES -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Reportes">
                                <span class="feather-icon"><i data-feather="check-circle"></i></span>
                                <span class="nav-link-text">Casos Clientes</span>
                            </a>
                            <ul id="Reportes" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesClientes.php?acc=2">Registrar Casos Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesClientes.php?acc=4">Gestionar Casos Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesClientes.php?acc=1">Consultar Casos Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesClientes.php?acc=10">Ver Historial de Casos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesClientes.php?acc=5">Exportar Casos Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesClientes.php?acc=reportecasosclientes">Generar Documento PDF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>



                        <!-- CLIENTES -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp">
                                <span class="feather-icon"><i data-feather="users"></i></span>
                                <span class="nav-link-text">Clientes</span>
                            </a>
                            <ul id="dash_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarClientes.php?acc=2">Registrar Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarClientes.php?acc=4">Gestionar Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarClientes.php?acc=1">Consultar Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarClientes.php?acc=5">Exportar Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarClientes.php?acc=reporteclientes">Generar Documento PDF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- CIUDADES -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#app_drp">
                                <span class="feather-icon"><i data-feather="map-pin"></i></span>
                                <span class="nav-link-text">Ciudades</span>
                            </a>
                            <ul id="app_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarCiudades.php?acc=2">Registrar Ciudades</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarCiudades.php?acc=4">Gestionar Ciudades</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarCiudades.php?acc=1">Consultar Ciudades</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarCiudades.php?acc=5">Exportar Ciudades</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- PRODUCTOS -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Productos">
                                <span class="feather-icon"><i data-feather="shopping-cart"></i></span>
                                <span class="nav-link-text">Productos</span>
                            </a>
                            <ul id="Productos" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarProductos.php?acc=2">Registrar Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarProductos.php?acc=4">Gestionar Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarProductos.php?acc=1">Consultar Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarProductos.php?acc=5">Exportar Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarProductos.php?acc=reporteproducto">Generar Documento PDF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- MARCAS PRODUCTOS -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#MarcaProductos">
                                <span class="feather-icon"><i data-feather="package"></i></span>
                                <span class="nav-link-text">Marcas Productos</span>
                            </a>
                            <ul id="MarcaProductos" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarMarcas.php?acc=2">Registrar Marcas Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarMarcas.php?acc=4">Gestionar Marcas Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarMarcas.php?acc=1">Consultar Marcas Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarMarcas.php?acc=5">Exportar Marcas Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarMarcas.php?acc=reportemarcaproducto">Generar Documento PDF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- SUCURSALES -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Sucursales">
                                <span class="feather-icon"><i data-feather="layers"></i></span>
                                <span class="nav-link-text">Sucursales</span>
                            </a>
                            <ul id="Sucursales" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarSucursales.php?acc=2">Registrar Sucursales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarSucursales.php?acc=4">Gestionar Sucursales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarSucursales.php?acc=1">Consultar Sucursales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarSucursales.php?acc=5">Exportar Sucursales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarSucursales.php?acc=reportesucursal">Generar Documento PDF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <!-- VENDEDORES -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Vendedores">
                                <span class="feather-icon"><i data-feather="user-plus"></i></span>
                                <span class="nav-link-text">Vendedores</span>
                            </a>
                            <ul id="Vendedores" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarVendedores.php?acc=2">Registrar Vendedores</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarVendedores.php?acc=4">Gestionar Vendedores</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarVendedores.php?acc=1">Consultar Vendedores</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarVendedores.php?acc=5">Exportar Vendedores</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarVendedores.php?acc=reportevendedores">Generar Documento PDF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- VENTAS -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Ventas">
                                <span class="feather-icon"><i data-feather="tag"></i></span>
                                <span class="nav-link-text">Ventas</span>
                            </a>
                            <ul id="Ventas" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarFacturas.php?acc=2">Registrar Ventas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarFacturas.php?acc=4">Gestionar Ventas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarFacturas.php?acc=1">Consultar Ventas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarFacturas.php?acc=5">Exportar Ventas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarFacturas.php?acc=reporteventas">Generar Documento PDF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- EMPLEADOS -->
                        <li class="nav-item active">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Empleados">
                                <span class="feather-icon"><i data-feather="folder-minus"></i></span>
                                <span class="nav-link-text">Empleados</span>
                            </a>
                            <ul id="Empleados" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpleados.php?acc=2">Registrar Empleados</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpleados.php?acc=4">Gestionar Empleados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpleados.php?acc=1">Consultar Empleados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpleados.php?acc=5">Exportar Empleados</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- EMPRESA -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Empresa">
                                <span class="feather-icon"><i data-feather="home"></i></span>
                                <span class="nav-link-text">Empresas</span>
                            </a>
                            <ul id="Empresa" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpresas.php?acc=2">Registrar Empresas</a>
                                        </li>
                                       <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpresas.php?acc=4">Gestionar Empresas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpresas.php?acc=1">Consultar Empresas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpresas.php?acc=5">Exportar Empresas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarEmpresas.php?acc=reporteempresas">Generar Documento PDF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <!-- LINEAS -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Lineas">
                                <span class="feather-icon"><i data-feather="phone"></i></span>
                                <span class="nav-link-text">L&iacute;neas</span>
                            </a>
                            <ul id="Lineas" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarLineas.php?acc=2">Registrar L&iacute;neas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarLineas.php?acc=4">Gestionar L&iacute;neas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarLineas.php?acc=1">Consultar L&iacute;neas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarLineas.php?acc=5">Exportar L&iacute;neas</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                       

                        <!-- REPORTES PROBLEMAS PLATAFORMA -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#ReportesProblemas">
                                <span class="feather-icon"><i data-feather="headphones"></i></span>
                                <span class="nav-link-text">Reportar Problemas</span>
                            </a>
                            <ul id="ReportesProblemas" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesPlataforma.php?acc=2">Registrar Reportes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesPlataforma.php?acc=4">Gestionar Reportes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesPlataforma.php?acc=1">Consultar Reportes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../Controlador/cGestionarReportesPlataforma.php?acc=5">Exportar Reportes</a>
                                        </li>
                                    
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Opciones Extras</span>
                        <span></span>
                    </div>
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="documentation.html" >
                                <span class="feather-icon"><i data-feather="book"></i></span>
                                <span class="nav-link-text">Documentaci&oacute;n</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Setting Panel -->
        <div class="hk-settings-panel">
            <div class="nicescroll-bar position-relative">
                <div class="settings-panel-wrap">
                    <div class="settings-panel-head">
                        <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
                    </div>
                    <hr>
                    
                    <h6 class="mb-5">Ajustes de Preferencias</h6>
                    <p class="font-14">Men&uacute; de Navegaci&oacute;n</p>
                    <div class="button-list hk-nav-select mb-10">
                        <button type="button" id="nav_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Modo D&iacute;a</span></button>
                        <button type="button" id="nav_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Modo Noche</span></button>
                    </div>
                    <hr>
                    <h6 class="mb-5">Seleccione modo de header / contenido superior</h6>
                    <p class="font-14">Seleccione su preferencia</p>
                    <div class="button-list hk-navbar-select mb-10">
                        <button type="button" id="navtop_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Modo D&iacute;a</span></button>
                        <button type="button" id="navtop_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Modo Noche</span></button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Agregar Scroll Men&uacute; de Navegaci&oacute;n</h6>
                        <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch"></div>
                    </div>
                    <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Reiniciar Ajustes</button>
                </div>
            </div>
            <img class="d-none" src="../Vista/dist/img/logo-light.png" alt="brand" />
            <img class="d-none" src="../Vista/dist/img/logo-dark.png" alt="brand" />
        </div>
        <!-- /Setting Panel -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="../Vista/AdministracionAdmin.php?acc=1">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Empleados</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modificar Empleados</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="toggle-right"></i></span></span>Modificar Empleados</h4>
                </div>
                <!-- /Title -->

                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <!-- MENSAJE DE ALERTA USUARIOS -->
                                    <div class="alert alert-secondary alert-wth-icon alert-dismissible fade show" role="alert">
                                        <span class="alert-icon-wrap"><i class="zmdi zmdi-notifications-active"></i></span>Tome en Consideraci&oacute;n: Todos los campos marcados con <span style="color :#F00; font-weight: 800;">(*)</span> son obligatorios
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <!-- FIN MENSAJE DE ALERTA USUARIOS -->
                                    <form class="needs-validation" novalidate method="POST" action="../Controlador/cGestionarEmpleados.php?acc=9">
                                        <div class="form-row">
                                            <!-- ID -->
                                            <div class="col-md-12 mb-10">
                                                <input type="hidden" name="IDEmpleados" class="form-control" id="validationCustom01" value="<?php echo $ID_EmpleadosSistema; ?>">
                                            </div>


                                            <!-- CODIGO -->
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Ingrese el c&oacute;digo de empleado <span class="CampoObligatorio">(*)</span></label>
                                                <input type="text" minlength="3" maxlength="3" name="CODEmpleados" class="form-control" id="validationCustom01" placeholder="Por favor Ingrese C&oacute;digo de Empleado..." value="<?php echo $Usuarios->getCODEmpleados(); ?>" required>
                                                <!-- INVALIDO -->
                                                <div class="invalid-feedback">
                                                    Por favor ingrese el c&oacute;digo de empleado...<br>
                                                    Car&aacute;cteres M&iacute;nimos: 3
                                                    Car&aacute;cteres M&aacute;ximos: 3
                                                </div>
                                                <!-- VALIDO -->
                                                <div class="valid-feedback">
                                                    Campo Completado Exitosamente!...
                                                </div>
                                            </div>

                                            <!-- NOMBRE -->
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Ingrese el nombre del empleado <span class="CampoObligatorio">(*)</span></label>
                                                <input type="text" minlength="3" maxlength="50" name="NOMEmpleados" class="form-control" id="validationCustom01" placeholder="Por favor Ingrese El Nombre del empleado..." value="<?php echo $Usuarios->getNOMEmpleados(); ?>" required>
                                                <!-- INVALIDO -->
                                                <div class="invalid-feedback">
                                                    Por favor ingrese el nombre del empleado...<br>
                                                    Car&aacute;cteres M&iacute;nimos: 3
                                                    Car&aacute;cteres M&aacute;ximos: 50
                                                </div>
                                                <!-- VALIDO -->
                                                <div class="valid-feedback">
                                                    Campo Completado Exitosamente!...
                                                </div>
                                            </div>

                                            <!-- APELLIDO -->
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Ingrese el apellido del empleado <span class="CampoObligatorio">(*)</span></label>
                                                <input type="text" minlength="3" maxlength="50" name="APEEmpleados" class="form-control" id="validationCustom01" placeholder="Por favor Ingrese el apellido del empleado..." value="<?php echo $Usuarios->getAPEEmpleados(); ?>" required>
                                                <!-- INVALIDO -->
                                                <div class="invalid-feedback">
                                                    Por favor Ingrese el apellido del empleado...<br>
                                                    Car&aacute;cteres M&iacute;nimos: 3
                                                    Car&aacute;cteres M&aacute;ximos: 50
                                                </div>
                                                <!-- VALIDO -->
                                                <div class="valid-feedback">
                                                    Campo Completado Exitosamente!...
                                                </div>
                                            </div>

                                            <!-- DUI -->
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Ingrese el Dui del empleado <span class="CampoObligatorio">(*)</span></label>
                                                <input type="text" minlength="8" maxlength="12" name="DUIEmpleados" class="form-control" id="validationCustom01" placeholder="Por favor Ingrese direcci&oacute;n de sucursal..." value="<?php echo $Usuarios->getDUIEmpleados(); ?>" required>
                                                <!-- INVALIDO -->
                                                <div class="invalid-feedback">
                                                    Por favor ingrese el Dui del empleado...<br>
                                                    Car&aacute;cteres M&iacute;nimos: 8
                                                    Car&aacute;cteres M&aacute;ximos: 12
                                                </div>
                                                <!-- VALIDO -->
                                                <div class="valid-feedback">
                                                    Campo Completado Exitosamente!...
                                                </div>
                                            </div>

                                            <!-- TELEFONO -->
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Ingrese el Tel&eacute;fono del empleado <span class="CampoObligatorio">(*)</span></label>
                                                <input type="text" minlength="8" maxlength="9" name="TELEmpleados" class="form-control" id="validationCustom01" placeholder="Por favor Ingrese el Tel&eacute;fono del empleado..." value="<?php echo $Usuarios->getTELEmpleados(); ?>" required>
                                                <!-- INVALIDO -->
                                                <div class="invalid-feedback">
                                                    Por favor ingrese el Tel&eacute;fono del empleado...<br>
                                                    Car&aacute;cteres M&iacute;nimos: 8
                                                    Car&aacute;cteres M&aacute;ximos: 9
                                                </div>
                                                <!-- VALIDO -->
                                                <div class="valid-feedback">
                                                    Campo Completado Exitosamente!...
                                                </div>
                                            </div>

                                            <!-- DIRECCION -->
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Ingrese la Direcci&oacute;n del empleado <span class="CampoObligatorio">(*)</span></label>
                                                <textarea name="DIREmpleados" minlength="5" maxlength="100" class="form-control" id="validationCustom01" placeholder="Por favor Ingrese la Direcci&oacute;n del emplead..." value="" required><?php echo $Usuarios->getDIREmpleados(); ?></textarea>
                                                <!-- INVALIDO -->
                                                <div class="invalid-feedback">
                                                    Por favor ingrese la Direcci&oacute;n del empleado...<br>
                                                    Car&aacute;cteres M&iacute;nimos: 5
                                                    Car&aacute;cteres M&aacute;ximos: 100
                                                </div>
                                                <!-- VALIDO -->
                                                <div class="valid-feedback">
                                                    Campo Completado Exitosamente!...
                                                </div>
                                            </div>

                                        </div>
                                        <button class="btn btn-gradient-primary" type="submit"><i class="fa fa-check"></i> Modificar Empleado</button>
                                    </form>
                                </div>
                            </div>
            </div>
            <!-- /Container -->

            <!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>&copy; Copyright 2020 | CRM VTiger S.A de C.V</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->

    </div>
   <!-- /HK Wrapper -->

     <!-- jQuery -->
    <script src="../Vista/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../Vista/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../Vista/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Jasny-bootstrap  JavaScript -->
    <script src="../Vista/vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="../Vista/dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="../Vista/dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="../Vista/dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="../Vista/vendors/jquery-toggles/toggles.min.js"></script>
    <script src="../Vista/dist/js/toggle-data.js"></script>

    <!-- Init JavaScript -->
    <script src="../Vista/dist/js/init.js"></script>
    <script src="../Vista/dist/js/validation-data.js"></script>
</body>

</html>