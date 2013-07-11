<?php 
error_reporting("E_NOTICE");
$language = "en";

if (isset($_POST["language"]))
{
$language = $_POST["language"];
if ($language != "es" && $language != "en")
{
$language = "en";
}
}

if ($language == "es")
{
$language_install = array
(
0 => "P·gina de instalaciÛn de Judi CMS Forum",
1 => "InstalaciÛn de Judi CMS Forum",
2 => "Idioma",
3 => "Inicio",
4 => "Base de Datos",
5 => "Datos de AdministraciÛn",
6 => "Finalizado",
7 => "Seleccionar lenguaje",
8 => "Seleccionar",
9 => "Siguiente",
10 => "Servidor",
11 => "VersiÛn de PHP",
12 => "Servidor de correo",
13 => "Servidor de correo activo",
14 => "Es necesario un servidor de correos para poder enviar emails",
15 => "Crear la Base de datos mysql",
16 => "campos obligatorios",
17 => "Servidor",
18 => "Usuario",
19 => "Repetir Password",
20 => "Base de Datos",
21 => "Datos de AdministraciÛn",
22 => "Email de Administrador",
23 => "Email para notificaciones",
24 => "Nombre de Administrador",
25 => "TÌtulo",
26 => "Aceptar",
27 => "Ya puedes iniciar sesiÛn como administrador con su nueva cuenta.<br>
		El archivo install.php se eliminar· autom·ticamente, una vez que inicies sesiÛn como administrador.<br>
		El panel de administraciÛn se encuentra en la ruta /admin, evite el acceso directo desde el foro a este espacio.<br><br>
		<a href='admin/admin.php'>Ir al Panel de AdministraciÛn</a><br>
		<a href='index.php'>Ir al foro</a>",
28 => "Las contraseÒas no coinciden",
29 => "Campo de texto obligatorio",
30 => "Email incorrecto",
31 => "SÛlo letras, n˙meros y guiones bajos, no use espacios",
32 => "La contraseÒa debe contener n˙meros y letras",
33 => "Entre 8 y 16 caracateres",
34 => "No es un nombre de dominio",
35 => "Es un nombre de dominio",
36 => "VersiÛn PHP v·lida",
37 => "Es necesario actualizar la versiÛn de PHP a la versiÛn 5",
38 => "Los datos de conexiÛn son inv·lidos",
39 => "Base de datos instalada, ya sÛlo te queda este ˙ltimo paso.",
40 => "El email de administrador contiene errores.",
41 => "El email para notificaciones contiene errores.",
42 => "El nombre de administrador contiene errores.",
43 => "El password contiene errores.",
44 => "Enhorabuena, el foro ha sido instalado correctamente."
);
}

if ($language == "en")
{
$language_install = array
(
0 => "Judi CMS Forum - Installation",
1 => "Judi CMS Forum - Installation",
2 => "Language",
3 => "Initiation",
4 => "Data Base",
5 => "Administration data",
6 => "Finalized",
7 => "Select language",
8 => "Select",
9 => "Next",
10 => "Server",
11 => "PHP Version",
12 => "Mail Server",
13 => "Mail Server - active",
14 => "We need a mail server to send emails",
15 => "Create mysql database",
16 => "Required",
17 => "Server",
18 => "User",
19 => "Password repeat",
20 => "Data Base",
21 => "Administration data",
22 => "Email Administrator",
23 => "Email for notifications",
24 => "Administrator name",
25 => "Title",
26 => "Accept",
27 => "You can login as administrator with your new account.<br>
		The install.php file is automatically deleted once you login as administrator.<br>
		The admin panel is in the path /admin, avoid direct access to this space forum.<br><br>
		<a href='admin/admin.php'>Administration Panel</a><br>
		<a href='index.php'>Go to Forum</a>",
28 => "Passwords do not match",
29 => "Required",
30 => "Wrong email",
31 => "Only letters, numbers and underscores, no spaces",
32 => "Numbers and letters",
33 => "Between 8 and 16 char",
34 => "This is not a domain name",
35 => "This is a domain name",
36 => "Valid PHP Version",
37 => "You need to upgrade the version of PHP to version 5",
38 => "The connection data are invalid",
39 => "Database installed, and you just have this last step.",
40 => "The administrator email contains errors.",
41 => "Email for notification contains errors.",
42 => "The administrator name contains errors.",
43 => "The password contains errors.",
44 => "Congratulations, the forum has been installed correctly."
);
}

$activo_0 = true;
$activo_1 = false;
$activo_2 = false;
$activo_3 = false;
$activo_4 = false;
$error_db = "";


/* probando ruta */
	$ruta = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
	$ruta = str_replace("install.php", "", $ruta);
	$ruta_absoluta = "http://".$ruta;
	if ($_SERVER["HTTP_HOST"] == "localhost" || $_SERVER["HTTP_HOST"] == "127.0.0.1")
	{
	$es_localhost = "<span class='label label-success'>".$language_install[34]."</span>";
	}
	else
	{
	$es_localhost = "<span class='label label-success'>".$language_install[35]."</span>";
	}
/* probando ruta */

/* probando versiÛn */
	$version_php = phpversion();
	$v_php = substr($version_php, 0, 1);
	if ($v_php >= 5)
	{
	$es_valido_php = "<span class='label label-success'>".$language_install[36]."</span>";
	}
	else
	{
	$es_valido_php = "<span class='label label-warning'>".$language_install[37]."</span>";
	}
/* probando versiÛn */

if($_POST["siguiente"]=="1")
{
$siguiente = $_POST["siguiente"];
if ($siguiente == "1")
{
$activo_0 = false;
$activo_1 = true;
$activo_2 = false;
$activo_3 = false;
$activo_4 = false;
}
}


if($_POST["siguiente"]=="2")
{
$siguiente = $_POST["siguiente"];
if ($siguiente == "2")
{
$activo_0 = false;
$activo_1 = false;
$activo_2 = true;
$activo_3 = false;
$activo_4 = false;
}
}

if (isset($_POST["servidor_db"]))
{
$alias_db = $_POST["alias_db"];
$servidor_db = $_POST["servidor_db"];
$usuario_db = $_POST["usuario_db"];
$password_db = $_POST["password_db"];
$db = $_POST["db"];

//ConfiguraciÛn de la conexiÛn al archivo conexion.php
$ruta_conexion = "system/conexion.php";
$open_file = fopen($ruta_conexion, "w+");
fwrite($open_file, "<?php $".'conexion'." = new mysqli('$servidor_db', '$usuario_db', '$password_db', '$db'); ?>");
fclose($open_file);

//ConfiguraciÛn .htaccess

$write_htaccess = 
"RewriteEngine On
Options +FollowSymLinks 

DirectoryIndex index.php

AddDefaultCharset charset=ISO-8859-1

#algunos servidores no lo soportan
#Desactivacion de las Magic quotes para evitar ataques SQL
#php_flag magic_quotes_gpc off

#algunos servidores no lo soportan
#Desactiva el inicio de sesion automatico
#php_flag session.auto_start off

#impedir navegacion en directorios
Options All -Indexes 

#Errores
ErrorDocument 404 ".$ruta_absoluta."error.php
ErrorDocument 403 ".$ruta_absoluta."error.php
ErrorDocument 400 ".$ruta_absoluta."error.php
ErrorDocument 401 ".$ruta_absoluta."error.php
ErrorDocument 500 ".$ruta_absoluta."error.php
";

$ruta_htaccess = ".htaccess";
$open_file = fopen($ruta_htaccess, "w+");
fwrite($open_file, $write_htaccess);
fclose($open_file);

$conexion = new mysqli($servidor_db, $usuario_db, $password_db, $db);

$consulta = array();

$consulta[0] = "CREATE TABLE IF NOT EXISTS `antirobots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `max_registro` int(11) NOT NULL DEFAULT '50',
  `max_activar_cuenta` int(11) NOT NULL DEFAULT '50',
  `max_iniciar_sesion` int(11) NOT NULL DEFAULT '50',
  `max_recuperar_password` int(11) NOT NULL DEFAULT '50',
  `max_activar_password` int(11) NOT NULL DEFAULT '50',
  `max_contacto` int(11) NOT NULL DEFAULT '50',
  `max_temas` int(11) NOT NULL DEFAULT '50',
  `max_mensajes` int(11) NOT NULL DEFAULT '50',
  `max_iniciar_sesion_adm` int(11) NOT NULL DEFAULT '50',
  `max_recuperar_password_adm` int(11) NOT NULL DEFAULT '50',
  `max_activar_password_adm` int(11) NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[1] = "INSERT INTO `antirobots` (`id`, `max_registro`, `max_activar_cuenta`, `max_iniciar_sesion`, `max_recuperar_password`, `max_activar_password`, `max_contacto`, `max_temas`, `max_mensajes`, `max_iniciar_sesion_adm`, `max_recuperar_password_adm`, `max_activar_password_adm`) VALUES
(1, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50);";

$consulta[2] = "CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `keywords` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[3] = "CREATE TABLE IF NOT EXISTS `detalles_foro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo_verificacion` int(11) NOT NULL,
  `email_admin` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `email_notificaciones` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `title` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `keywords` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `notificacion_registro` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'on',
  `notificacion_tema` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'on',
  `notificacion_mensaje` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'on',
  `theme` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `icono` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `language` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$codigo_array = array ("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f");
$codigo_verificacion = "";
for($x=0; $x < 16; $x++)
{
$codigo_verificacion .= $codigo_array[rand(0, count($codigo_array) - 1)];
}
$consulta[4] = "INSERT INTO detalles_foro(url, theme, codigo_verificacion, icono) VALUES('$ruta_absoluta', 'united', '$codigo_verificacion', 'judiCMS.ico')";

$consulta[5] = "CREATE TABLE IF NOT EXISTS `htaccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `www` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `ssl` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[6] = "INSERT INTO `htaccess` (`id`, `www`, `ssl`) VALUES
(1, 'con', 'no');";

$consulta[7] = "CREATE TABLE IF NOT EXISTS `invitados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `conectado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[8] = "CREATE TABLE IF NOT EXISTS `ip` (
  `id_ip` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `baneado` varchar(10) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id_ip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[9] = "CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `tema` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `es_tema_principal` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mensaje` text COLLATE utf8_spanish2_ci NOT NULL,
  `url` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[10] = "CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `subcategoria` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_ultimo_mensaje` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `keywords` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_subcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[11] = "CREATE TABLE IF NOT EXISTS `temas` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `tema` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish2_ci NOT NULL,
  `tema_cerrado` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'false',
  `url` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `visitas` int(11) NOT NULL,
  PRIMARY KEY (`id_tema`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[12] = "CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nick` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_1` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_2` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `leyenda` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo_verificacion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `activo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'false',
  `fecha_registro` date NOT NULL,
  `ip` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `denuncias` int(11) NOT NULL,
  `conectado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

$consulta[13] = "CREATE TABLE IF NOT EXISTS `visitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `visitas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

for($x=0; $x<count($consulta); $x++)
{
$resultado = $conexion -> query($consulta[$x]);
}
if(!$resultado)
{
$activo_0 = false;
$activo_1 = false;
$activo_2 = true;
$activo_3 = false;
$activo_4 = false;
$error_db = "<span class='label label-warning'>".$language_install[38]."</span>";
}
else
{
$hecho_db = "<span class='label label-success'>".$language_install[39]."</span>";
$activo_0 = false;
$activo_1 = false;
$activo_2 = false;
$activo_3 = true;
$activo_4 = false;
}
}

if(isset($_POST["datos_administracion"]))
{
include "system/conexion.php";

$email_admin = $_POST["email_admin"];
$email_notificaciones = $_POST["email_notificaciones"];
$admin = $_POST["admin"];
$password = $_POST["password"];
$repetir_password = $_POST["repetir_password"];
$title = addslashes(strip_tags(htmlspecialchars($_POST["title"])));
$keywords = addslashes(strip_tags(htmlspecialchars($_POST["keywords"])));
$description = addslashes(strip_tags(htmlspecialchars($_POST["description"])));

if (!preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $email_admin) || $email_admin == "")
{
$hecho_db = "<span class='label label-error'>".$language_install[40]."</span>";
$activo_0 = false;
$activo_1 = false;
$activo_2 = false;
$activo_3 = true;
$activo_4 = false;
return;
}

if (!preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $email_notificaciones) || $email_notificaciones == "")
{
$hecho_db = "<span class='label label-error'>".$language_install[41]."</span>";
$activo_0 = false;
$activo_1 = false;
$activo_2 = false;
$activo_3 = true;
$activo_4 = false;
return;
}

if (!preg_match("/^[0-9a-zA-Z·ÈÌÛ˙‡ËÏÚ˘¿»Ã“Ÿ¡…Õ”⁄Ò—¸‹_]+$/", $admin) || $admin == "")
{
$hecho_db = "<span class='label label-error'>".$language_install[42]."</span>";
$activo_0 = false;
$activo_1 = false;
$activo_2 = false;
$activo_3 = true;
$activo_4 = false;
return;
}

if (!preg_match("/^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i", $password) || $password == "")
{
$hecho_db = "<span class='label label-error'>".$language_install[43]."</span>";
$activo_0 = false;
$activo_1 = false;
$activo_2 = false;
$activo_3 = true;
$activo_4 = false;
return;
}

if ($password != $repetir_password)
{
$hecho_db = "<span class='label label-error'>".$language_install[43]."</span>";
$activo_0 = false;
$activo_1 = false;
$activo_2 = false;
$activo_3 = true;
$activo_4 = false;
return;
}

if ($title == "")
{
$title = "Judi CMS Forum";
}
if ($keywords == "")
{
$keywords = "Judi, CMS, Forum";
}
if ($description == "")
{
$description = "Judi CMS Forum - Bootstrap, PHP & Mysql Forum - Responsive Design";
}

$consulta = "UPDATE detalles_foro SET email_admin='$email_admin', email_notificaciones='$email_notificaciones', admin='$admin', ";
$consulta .= "password='$password', title='$title', keywords='$keywords', description='$description', language='$language'";
$resultado = $conexion -> query($consulta);

$activo_0 = false;
$activo_1 = false;
$activo_2 = false;
$activo_3 = false;
$activo_4 = true;

$hecho_finalizado = "<span class='label label-success'>".$language_install[44]."</span>";
}
?>
<!DOCTYPE html>
<html>
  <head>
	<title><?php echo $language_install[0]; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="shortcut icon" href="imagenes/JudiCMS.ico" type="image/x-icon">
	<meta name="title" content="">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="language" content="">
	<meta name="robot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/themes/united/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="bootstrap/js/jquery-1.10.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body>
      <!-- Begin page content -->
      <div class="container">
	  <center>
        <div class="page-header">
          <h3><?php echo $language_install[1]; ?></h3>
        </div>

		<div class="tabbable">
		 <ul class="nav nav-tabs">
<li <?php if($activo_0 == true){echo 'class="active"';} else{echo 'class="disabled"';} ?>><a href="<?php if($activo_0 == true){echo "#tab0";} ?>" data-toggle="tab"><?php echo $language_install[2]; ?></a></li> 
<li <?php if($activo_1 == true){echo 'class="active"';} else{echo 'class="disabled"';} ?>><a href="<?php if($activo_1 == true){echo "#tab1";} ?>" data-toggle="tab"><?php echo $language_install[3]; ?></a></li>
<li <?php if($activo_2 == true){echo 'class="active"';} else{echo 'class="disabled"';}?>><a href="<?php if($activo_2 == true){echo "#tab2";} ?>" data-toggle="tab"><?php echo $language_install[4]; ?></a></li>
<li <?php if($activo_3 == true){echo 'class="active"';} else{echo 'class="disabled"';}?>><a href="<?php if($activo_3 == true){echo "#tab3";} ?>" data-toggle="tab"><?php echo $language_install[5]; ?></a></li>
<li <?php if($activo_4 == true){echo 'class="active"';} else{echo 'class="disabled"';}?>><a href="<?php if($activo_4 == true){echo "#tab4";} ?>" data-toggle="tab"><?php echo $language_install[6]; ?></a></li>
</ul>
<div class="tab-content">

<div class="tab-pane <?php if($activo_0 == true){echo 'active';} ?>" id="tab0">
			
			<form method="post" id="form_language" class="form-search">
			<?php echo $language_install[7]; ?>:
			<select name="language" onchange="document.getElementById('form_language').submit()">
			<option value="en"><?php echo $language_install[8]; ?></option>
			<option value="en">English</option>
			<option value="es">EspaÒol</option>
			</select>
			</form>
			
		<form method="post">
		<button class="btn" type="submit"><?php echo $language_install[9]; ?></button>
		<input type="hidden" name="siguiente" value="1">
		<input type="hidden" name="language" value="<?php echo $language; ?>">
		</form>
</div>

<div class="tab-pane <?php if($activo_1 == true){echo 'active';} ?>" id="tab1">
		<table class="table">
		<tr>
		<td style="text-align: right;"> <?php echo $language_install[10]; ?>: </td><td style="text-align: center;"><strong> <?php echo $ruta; ?> </strong></td><td><?php echo $es_localhost; ?></td>
		</tr>
		<tr>
		<td style="text-align: right;"> <?php echo $language_install[11]; ?>: </td><td style="text-align: center;"><strong> <?php echo $version_php; ?> </strong></td><td><?php echo $es_valido_php; ?></td>
		</tr>
			<tr>
		<td style="text-align: right;"> <?php echo $language_install[12]; ?>: </td>
		<td style="text-align: center;">
		<?php
		/* probando correo */
include "system/phpmailer/class.phpmailer.php";
$mail = new PHPMailer();
$mail->Host = $ruta;
$mail->From = $ruta;
$mail->FromName = "Judi CMS Forum";
$mail->Subject = $ruta_absoluta;
$mail->AddAddress("info@judicms.com");
$mail->Body = $ruta_absoluta;
$mail->IsHTML(true);

if ($mail->send())
{
$es_valido_correo = "<span class='label label-success'>".$language_install[13]."</span>";
}
else
{
$es_valido_correo = "<span class='label label-warning'>".$language_install[14]."</span>";
}
/* probando correo */
?>
		</td>
		<td><?php echo $es_valido_correo; ?></td>
		</tr>
		</table>
		<form method="post">
		<button class="btn" type="submit"><?php echo $language_install[9]; ?></button>
		<input type="hidden" name="siguiente" value="2">
		<input type="hidden" name="language" value="<?php echo $language; ?>">
		</form>
		
		</div>
		
		
		<div class="tab-pane <?php if($activo_2 == true){echo 'active';} ?>" id="tab2">

		<h3><?php echo $language_install[15]; ?> <span style="font-size: 10px;">* <?php echo $language_install[16]; ?></span></h3>
		<?php echo $error_db; ?>
		<form method="post" id="form_db">
		<table class="table">
		<tr>
		<td style="text-align: right;"><?php echo $language_install[17]; ?>:</td><td><input type="text" name="servidor_db"> * </td>
		</tr>
		<tr>
		<td style="text-align: right;"><?php echo $language_install[18]; ?>:</td><td><input type="text" name="usuario_db"> * </td>
		</tr>
		<tr>
		<td style="text-align: right;">Password:</td><td><input type="password" name="password_db" id="password_db"> * </td>
		</tr>
			<tr>
		<td style="text-align: right;"><?php echo $language_install[19]; ?>:</td><td><input type="password" name="repetir_password_db" id="repetir_password_db"> * <label id="e_repetir_password_db" class="text-error"></label></td>
		</tr>
		<tr>
		<td style="text-align: right;"><?php echo $language_install[20]; ?>:</td><td><input type="text" name="db"> * </td>
		</tr>
		<tr>
		<td style="text-align: right;"></td>
		<td>
		<input type="hidden" name="siguiente" value="3">
		<button type="button" id="btn_form_db" class="btn"><?php echo $language_install[9]; ?></button>
		<input type="hidden" name="language" value="<?php echo $language; ?>">
		</td>
		</tr>
		</table>
		</form>
		</div>
		
		<div class="tab-pane <?php if($activo_3 == true){echo 'active';} ?>" id="tab3">
		<?php echo $hecho_db; ?>
		<h3><?php echo $language_install[21]; ?> <span style="font-size: 10px;">* <?php echo $language_install[16]; ?></span></h3>
<form method='post' id="form_administracion">
<table class="table">
<tr>
<td style="text-align: right;"><?php echo $language_install[22]; ?>:</td><td><input type='text' name='email_admin' id='email_admin' placeHolder="<?php echo $language_install[22]; ?>"> * <label id="e_email_admin" class="text-error"></div></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $language_install[23]; ?>:</td><td><input type='text' name='email_notificaciones' id='email_notificaciones' placeHolder="<?php echo $language_install[23]; ?>"> * <label id="e_email_notificaciones" class="text-error"></label></div></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $language_install[24]; ?>:</td><td><input type='text' name='admin' id='admin' placeHolder="<?php echo $language_install[24]; ?>"> * <label id="e_admin" class="text-error"></label></div></td>
</tr>
<tr>
<td style="text-align: right;">Password:</td><td><input type='password' name='password' id='password' placeHolder="Password"> * <label id="e_password" class="text-error"></label></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $language_install[19]; ?>:</td><td><input type='password' name='repetir_password' id='repetir_password' placeHolder="<?php echo $language_install[19]; ?>"> * <label id="e_repetir_password" class="text-error"></label></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $language_install[25]; ?>:</td><td style="width: 80%;"><input type='text' name='title' id='title' placeHolder="<?php echo $language_install[25]; ?>" style='width: 80%;'></td>
</tr>
<tr>
<td style="text-align: right;">Keywords:</td><td><input type='text' name='keywords' id='keywords' placeHolder="Keywords" style='width: 80%;'></td>
</tr>
</table>
<textarea rows='8' style="width: 90%;" id='description' name='description' placeHolder="Description"></textarea>
<br><br>
<button type='button' id="btn_datos_administracion" class='btn' style='font-size: 18px;'><?php echo $language_install[26]; ?></button>
<input type="hidden" name="language" value="<?php echo $language; ?>">
<input type="hidden" name="datos_administracion">
</form>

		</div>
		
				<div class="tab-pane <?php if($activo_4 == true){echo 'active';} ?>" id="tab4">
		<?php echo $hecho_finalizado; ?>
		<div>
		<br><br>
<?php echo $language_install[27]; ?>
		<br><br>
		</div>
		</div>
		  </div>
		</div>
		 </center>
	  </div>	  
   	  <footer>
	  <div class="text-center">
		  <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_EN"><img alt="Licencia de Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Judi CMS Forum</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.judicms.com" property="cc:attributionName" rel="cc:attributionURL">@judi</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.es_ES">Creative Commons 3.0 Unported License</a>.<br /> <a xmlns:dct="http://purl.org/dc/terms/" href="http://www.judicms.com" rel="dct:source">JUDI CMS FORUM</a>.
	</div>
	<br><br>
	</footer>
	
	<script>
	$(function(){
	
	$("#btn_form_db").click(function(){
	db();
	});
	$("#btn_datos_administracion").click(function(){
	datos_administracion();
	});
	
	$("#form_administracion :input, #form_db :input").blur(function(){$(".text-error").html("");});
	});
	
	function db()
	{
elemento = $("#repetir_password_db").val();
if (elemento != $("#password_db").val())
{
$("#e_repetir_password_db").html("<?php echo $language_install[28]; ?>");
return;
}
else
{
$("#form_db").submit();
}
	}
	
	function datos_administracion()
	{
elemento = $("#email_admin").val();
var buscar = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/
if (elemento == "")
{
$("#e_email_admin").html("<?php echo $language_install[29]; ?>");
return;
}
else if(!elemento.match(buscar) || elemento.length > 80)
{
$("#e_email_admin").html("<?php echo $language_install[30]; ?>");
return;
}

elemento = $("#email_notificaciones").val();
var buscar = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/
if (elemento == "")
{
$("#e_email_notificaciones").html("<?php echo $language_install[29]; ?>");
return;
}
else if(!elemento.match(buscar) || elemento.length > 80)
{
$("#e_email_notificaciones").html("<?php echo $language_install[30]; ?>");
return;
}

elemento = $("#admin").val();
var buscar = /^[0-9a-zA-Z·ÈÌÛ˙‡ËÏÚ˘¿»Ã“Ÿ¡…Õ”⁄Ò—¸‹_]+$/
if (elemento == "")
{
$("#e_admin").html("<?php echo $language_install[29]; ?>");
return;
}
else if(!elemento.match(buscar) || elemento.length > 80)
{
$("#e_admin").html("<?php echo $language_install[31]; ?>");
return;
}
//password
elemento = $("#password").val();
var buscar = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i
if (elemento == "")
{
$("#e_password").html("<?php echo $language_install[29]; ?>");
return;
}
else if(!elemento.match(buscar))
{
$("#e_password").html("<?php echo $language_install[32]; ?>");
return;
}
else if(elemento.length < 8 || elemento.length > 16)
{
$("#e_password").html("<?php echo $language_install[33]; ?>");
return;
}

elemento = $("#repetir_password").val();
if (elemento != $("#password").val())
{
$("#e_repetir_password").html("<?php echo $language_install[28]; ?>");
return;
}
else
{
$("#form_administracion").submit();
}
}

	</script>
	
  </body>
</html>