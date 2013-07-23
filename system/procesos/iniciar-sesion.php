<?php 
if (isset($_POST["iniciar_sesion"]))
{
/*SEGURIDAD*/
if (empty($_COOKIE["iniciar_sesion"]))
{
setcookie("iniciar_sesion", 1, time()+3600);
}
else
{
setcookie("iniciar_sesion", $_COOKIE["iniciar_sesion"] + 1, time()+3600);
}
if ($_COOKIE["iniciar_sesion"] > $max_iniciar_sesion)
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
$ip = $_SERVER['REMOTE_ADDR'];
/*SEGURIDAD*/
$filtrar = new InputFilter();
$email = $filtrar->process($email);
$password = $filtrar->process($password);
/*SEGURIDAD*/

$consulta = "SELECT * FROM usuarios WHERE email='$email' AND password='$password' AND activo='true'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();

if($fila > 0)
{
$tiempo_de_conexion = time()+600;
$consulta_ip = "UPDATE usuarios SET ip='$ip', conectado=$tiempo_de_conexion WHERE id=".$fila["id"]."";
$resultado_ip = $conexion->query($consulta_ip);
session_start();
$_SESSION["usuario"] = true;
$_SESSION["email"] = $_POST["email"];
$_SESSION["nick"] = $fila["nick"];
$_SESSION["nombre"] = $fila["nombre"];
$_SESSION["apellidos"] = $fila["apellidos"];
$_SESSION["fecha"] = $fila["fecha_registro"];
$_SESSION["id"] = $fila["id"];
$_SESSION["sexo"] = $fila["sexo"];
$_SESSION["avatar"] = $fila["avatar"];
Header('Location: ');
}
else
{
session_start();
$_SESSION["usuario"] = false;
session_destroy();
header("location: index.php?action=registro");
}
}
?>