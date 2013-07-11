<?php
if (isset($_POST["recuperar_password_1"]))
{
/*SEGURIDAD*/
if (empty($_COOKIE["recuperar_password"]))
{
setcookie("recuperar_password", 1, time()+3600);
}
else
{
setcookie("recuperar_password", $_COOKIE["recuperar_password"] + 1, time()+3600);
}
if ($_COOKIE["recuperar_password"] > $max_recuperar_password_adm)
{
$ip_sospechosa = $_SERVER['REMOTE_ADDR'];
$consulta_ip_sospechosa = "INSERT INTO ip(ip, baneado) VALUES('$ip_sospechosa', 'true')";
$resultado_ip_sospechosa = $conexion->query($consulta_ip_sospechosa);
echo "NO ROBOTS";
exit();
}
/*SEGURIDAD*/
$email = addslashes(htmlspecialchars(strip_tags($_POST["email"])));
$codigo_array = array ("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f");
$codigo_verificacion = "";
for($x=0; $x < 16; $x++)
{
$codigo_verificacion .= $codigo_array[rand(0, count($codigo_array) - 1)];
}

/*SEGURIDAD*/
$filtrar = new InputFilter();
$email = $filtrar->process($email);
/*SEGURIDAD*/

/*SEGURIDAD*/
if(!preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $email))
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_recuperar_password_1_adm[0]." ".$_SERVER['REMOTE_ADDR']."</strong>
</div>";
return;
}
/*SEGURIDAD*/

$consulta = "SELECT * FROM detalles_foro WHERE email_admin='$email'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
if ($fila>0)
{
$consulta = "UPDATE detalles_foro SET codigo_verificacion=$codigo_verificacion WHERE email_admin='$email'";
$resultado = $conexion->query($consulta);

require("system/phpmailer/class.phpmailer.php");

$titulo = "".$pro_recuperar_password_1_adm[1]." - $title_foro";
$mensaje = "<b>".$pro_recuperar_password_1_adm[2]." <a href='$url_foro'>$title_foro</a> ...</b>
<br><br>
".$pro_recuperar_password_1_adm[3]."
<a href='".$url_foro."admin/recuperar-password-2.php'>".$pro_recuperar_password_1_adm[4]."</a>
".$pro_recuperar_password_1_adm[5].": <b>$codigo_verificacion</b>
<br><br>
".$pro_recuperar_password_1_adm[6]."
<br><br>
".$pro_recuperar_password_1_adm[7]."
";
$mail = new PHPMailer();
$mail->Host = $url_foro;
$mail->From = $email_foro;
$mail->FromName = $titulo;
$mail->Subject = $titulo;
$mail->AddAddress($email_foro);
$mail->Body = $mensaje;
$mail->IsHTML(true);
$mail->send();
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_recuperar_password_1_adm[8]."</strong>
</div>";
}
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_recuperar_password_1_adm[9]."</strong>
</div>";
}
}
?>