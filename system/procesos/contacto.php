<?php
if(isset($_POST["contacto"]))
{
session_start();
if ($_SESSION["usuario"] != true)
{
header("location: index.php");
exit();
}

/*SEGURIDAD*/
if (empty($_COOKIE["contacto"]))
{
setcookie("contacto", 1, time()+3600);
}
else
{
setcookie("contacto", $_COOKIE["contacto"] + 1, time()+3600);
}
if ($_COOKIE["contacto"] > $max_contacto)
{
echo "NO ROBOTS";
exit();
}
/*SEGURIDAD*/
$consulta = htmlspecialchars(strip_tags($_POST["contacto"]));
$nick = $_SESSION["nick"];
$id_usuario = $_SESSION["id"];
$fecha = date("d-m-Y");
$hora = date("H:m:s");
$ip = $_SERVER['REMOTE_ADDR'];

require("system/phpmailer/class.phpmailer.php");

$titulo = "Consulta de usuario - $title_foro";
$mensaje = "<b>Administrador nueva consulta en el foro <a href='$url_foro'>$title_foro</a> ...</b>
<br><br>
Fecha: $fecha<br>
Hora: $hora<br>
Whois: <a href='http://whois.arin.net/rest/ip/$ip'>http://whois.arin.net/rest/ip/$ip</a>
<br><br> 
El usuario con nick:$nick y id:$id_usuario ha realizado la siguiente consulta ...
<br><br>
<i>$consulta</i>
<br><br>
Puedes tener más información sobre este usuario introduciendo su nick o id de usuario en la búsqueda de usuarios del <a href='".$url_foro."admin/'>panel de administración</a>.
<br><br>
Saludos.
";

$mail = new PHPMailer();
$mail->Host = $url_foro;
$mail->From = $email_foro;
$mail->FromName = $titulo;
$mail->Subject = $titulo;
$mail->AddAddress($email_foro);
$mail->Body = $mensaje;
$mail->IsHTML(true);

if($mail->send())
{
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Consulta enviada con éxito</strong>
</div>";
}
}
?>