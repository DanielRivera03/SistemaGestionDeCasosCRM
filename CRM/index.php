<!DOCTYPE html>
<html lang="ES-SV">
<head>
    <meta charset="utf-8">
    <title>:: Sistema Gesti&oacute;n de Casos VTiger ::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CRM Gesti&oacute;n de casos en espa&ntilde;ol">
    <meta name="author" content="Sistema Gesti&oacute;n de Casos VTiger">
    <link rel="stylesheet" type="text/css" href="Vista/dist/css/estilos-generales.css">
    <link rel="stylesheet" type="text/css" href="Vista/dist/css/responsivo.css">
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo:400,600" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="Vista/dist/img/favicon.ico">
    <link rel="icon" href="Vista/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="Vista/dist/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="Vista/dist/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="Vista/dist/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="Vista/dist/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="Vista/dist/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="Vista/dist/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="Vista/dist/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="Vista/dist/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="Vista/dist/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="Vista/dist/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Vista/dist/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="Vista/dist/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Vista/dist/img/favicon-16x16.png">
    <link rel="manifest" href="Vista/dist/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="Vista/dist/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div class="contenedor_principal">
  <div class="barra_principal">
    <img src="Vista/dist/img/logo.png">
    <h2>Sistema Gesti&oacute;n de Casos VTiger</h2>
  </div><!-- cierre barra principal -->
  <div class="contenedor_secundario">  
    <h2>Por favor, elija su tipo de usuario (rol)</h2>
    <ul class="opcion_usuario">
        <li>
            <a href="Controlador/ControlLoginAdmin.php?acc=1">
                <img class="icons-users" src="Vista/dist/img/icon-admins.png" alt="departamento administrativo">
                <div class="contenedor_menu_bloque">
                    <h2 class="titulo_principal_menu">Administradores</h2>
                    <h3 class="titulo_secundario_menu">Administradores del Sistema VTiger</h3>
                </div>
            </a>
        </li>
        <li>
            <a href="Controlador/ControlLoginEmpleados.php?acc=1">
                <img class="icons-users" src="Vista/dist/img/icon-empleados.png" alt="departamento de personal">
                <div class="contenedor_menu_bloque">
                    <h2 class="titulo_principal_menu">Empleados</h2>
                    <h3 class="titulo_secundario_menu">Empleados de Gesti&oacute;n de Casos VTiger</h3>
                </div>
            </a>
        </li>
    </ul>
  </div><!-- cierre contenedor secundario -->
</div><!-- cierre contenedor principal -->  
</body>
</html>