<?php
if (isset($_POST["destinatarios"]) != "")
{
restringido();
require("system/phpmailer/class.phpmailer.php");
$asunto = $_POST["asunto"];
$destinatarios = $_POST["destinatarios"];
$mensaje = $_POST["mensaje"];
$file = $_FILES['archivo1']['tmp_name'];
$file_name = $_FILES['archivo1']['name'];

$destinatarios = explode(",", $destinatarios);
$x = 0;
while ($x < count($destinatarios))
{
$mail = new PHPMailer();
$mail->Host = $url_foro;
$mail->From = $email_foro;
$mail->FromName = $title_foro;
$mail->Subject = $asunto;
$mail->AddBCC(trim($destinatarios[$x]));
$mail->Body = $mensaje;
$mail->IsHTML(true);
if ($file != "")
{
$mail->AddAttachment($file, $file_name);
}
$mail->Send();
$x++;
}
if($mail)
{
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>$x Email/s enviado/s con éxito</strong>
</div>";
}
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Ha ocurrido un error</strong>
</div>";
}
}
?>