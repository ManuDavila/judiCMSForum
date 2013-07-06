<?php
if (isset($_POST["htaccess"]))
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}
$server = $_SERVER['HTTP_HOST'];
$server = str_replace("www.", "", $server);

if ($server == "localhost" || $server == "127.0.0.1")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>No modificado estás en localhost</strong>
</div>";
return;
}

if ($_POST["forzar_request"] == "con" && $_POST["forzar_ssl"] == "si" && $server != "localhost" && $server != "127.0.0.1")
{
$request = 
"
    #con www
    RewriteCond %{HTTP_HOST} ^$server [NC]
    RewriteRule ^(.*)$ https://www.$server/$1 [L,R=301]
	
		#Forzar https
RewriteCond %{SERVER_PORT} 80
RewriteRule ^(.*)$ https://www.$server/$1 [R=301,L]
";
$url = "https://www.$server/";
$consulta = "UPDATE detalles_foro SET url='$url'";
$resultado = $conexion -> query($consulta);
$consulta = "UPDATE htaccess SET www='".$_POST["forzar_request"]."', ssl='".$_POST["forzar_ssl"]."'";
$resultado = $conexion -> query($consulta);
$mensaje = true;
}

if ($_POST["forzar_request"] == "sin" && $_POST["forzar_ssl"] == "si" && $server != "localhost" && $server != "127.0.0.1")
{
$request = 
"
	#sin www
    RewriteCond %{HTTP_HOST} ^www.(.*) [NC]
    RewriteRule ^(.*) https://%1/$1 [R=301,L]
	
		#Forzar https
RewriteCond %{SERVER_PORT} 80
RewriteRule ^(.*)$ https://$server/$1 [R=301,L]
";
$url = "https://$server/";
$consulta = "UPDATE detalles_foro SET url='$url'";
$resultado = $conexion -> query($consulta);
$consulta = "UPDATE htaccess SET www='".$_POST["forzar_request"]."', ssl='".$_POST["forzar_ssl"]."'";
$resultado = $conexion -> query($consulta);
$mensaje = true;
}

if ($_POST["forzar_request"] == "con" && $_POST["forzar_ssl"] == "no" && $server != "localhost" && $server != "127.0.0.1")
{
$request = 
"
    #con www
    RewriteCond %{HTTP_HOST} ^$server [NC]
    RewriteRule ^(.*)$ http://www.$server/$1 [L,R=301]
";
$url = "http://www.$server/";
$consulta = "UPDATE detalles_foro SET url='$url'";
$resultado = $conexion -> query($consulta);
$consulta = "UPDATE htaccess SET www='".$_POST["forzar_request"]."', ssl='".$_POST["forzar_ssl"]."'";
$resultado = $conexion -> query($consulta);
$mensaje = true;
}

if ($_POST["forzar_request"] == "sin" && $_POST["forzar_ssl"] == "no" && $server != "localhost" && $server != "127.0.0.1")
{
$request = 
"
	#sin www
    RewriteCond %{HTTP_HOST} ^www.(.*) [NC]
    RewriteRule ^(.*) http://%1/$1 [R=301,L]
";
$url = "http://$server/";
$consulta = "UPDATE detalles_foro SET url='$url'";
$resultado = $conexion -> query($consulta);
$consulta = "UPDATE htaccess SET www='".$_POST["forzar_request"]."', ssl='".$_POST["forzar_ssl"]."'";
$resultado = $conexion -> query($consulta);
$mensaje = true;
}

$escribe = 
"
RewriteEngine On 
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

$request

#Errores
ErrorDocument 404 ".$url."error.php
ErrorDocument 403 ".$url."error.php
ErrorDocument 400 ".$url."error.php
ErrorDocument 401 ".$url."error.php
ErrorDocument 500 ".$url."error.php
";

$ruta = "../.htaccess";
$archivo = fopen($ruta, "w+");
fwrite($archivo, $escribe);
fclose($archivo);

if ($mensaje == true)
{
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con éxito</strong>
</div>";
}
}
?>