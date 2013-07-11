<?php
if (isset($_POST["recuperar_password_2"]))
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
if ($_COOKIE["recuperar_password"] > $max_activar_password_adm)
{
$ip_sospechosa = $_SERVER['REMOTE_ADDR'];
$consulta_ip_sospechosa = "INSERT INTO ip(ip, baneado) VALUES('$ip_sospechosa', 'true')";
$resultado_ip_sospechosa = $conexion->query($consulta_ip_sospechosa);
echo "NO ROBOTS";
exit();
}
/*SEGURIDAD*/

$email = addslashes(htmlspecialchars(strip_tags($_POST["email"])));
$password = addslashes(htmlspecialchars(strip_tags($_POST["password"])));
$codigo_verificacion = addslashes(htmlspecialchars(strip_tags($_POST["codigo_verificacion"])));

/*SEGURIDAD*/
$filtrar = new InputFilter();
$email = $filtrar->process($email);
$password = $filtrar->process($password);
$codigo_verificacion = $filtrar->process($codigo_verificacion);
/*SEGURIDAD*/

$consulta = "SELECT * FROM detalles_foro WHERE email_admin='$email' AND codigo_verificacion='$codigo_verificacion'";
$resultado=$conexion->query($consulta);
$fila = $resultado->fetch_array();

if($fila > 0)
{
$consulta = "UPDATE detalles_foro SET password='$password' WHERE email_admin='$email' AND codigo_verificacion='$codigo_verificacion'";
$resultado = $conexion->query($consulta);
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_recuperar_password_2_adm[0]."</strong>
</div>";
}
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_recuperar_password_2_adm[1]."</strong>
</div>";
}
}
?>