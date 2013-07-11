<?php
if(isset($_POST["contacto"]))
{
include_once "".$url_foro."system/restricted.php";

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

$consulta = htmlspecialchars(strip_tags($_POST["contacto"]));
$nick = $_SESSION["nick"];
$id_usuario = $_SESSION["id"];
$fecha = date("d-m-Y");
$hora = date("H:m:s");
$ip = $_SERVER['REMOTE_ADDR'];

require("system/phpmailer/class.phpmailer.php");

$titulo = "".$pro_contacto[0]." - $title_foro";
$mensaje = "<b>".$pro_contacto[1]." <a href='$url_foro'>$title_foro</a> ...</b>
<br><br>
".$pro_contacto[2].": $fecha<br>
".$pro_contacto[3].": $hora<br>
Whois: <a href='http://whois.arin.net/rest/ip/$ip'>http://whois.arin.net/rest/ip/$ip</a>
<br><br> 
".$pro_contacto[4].":$nick ".$pro_contacto[5]." id:$id_usuario ".$pro_contacto[6]." ...
<br><br>
<i>$consulta</i>
<br><br>
".$pro_contacto[7]." <a href='".$url_foro."admin/'>".$pro_contacto[8]."</a>.
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
<strong>".$pro_contacto[9]."</strong>
</div>";
}
}
?>