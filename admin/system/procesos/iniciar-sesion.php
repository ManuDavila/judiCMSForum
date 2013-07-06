<?php 
if (isset($_POST["iniciar_sesion"]))
{
/*SEGURIDAD*/
if (empty($_COOKIE["sesion_admin"]))
{
setcookie("sesion_admin", 1, time()+3600);
}
else
{
setcookie("sesion_admin", $_COOKIE["sesion_admin"] + 1, time()+3600);
}
if ($_COOKIE["sesion_admin"] > $max_iniciar_sesion_adm)
{
$ip_sospechosa = $_SERVER['REMOTE_ADDR'];
$consulta_ip_sospechosa = "INSERT INTO ip(ip, baneado) VALUES('$ip_sospechosa', 'true')";
$resultado_ip_sospechosa = $conexion->query($consulta_ip_sospechosa);
echo "NO ROBOTS";
exit();
}
/*SEGURIDAD*/

$admin = addslashes(htmlspecialchars(strip_tags($_POST["admin"])));
$password = addslashes(htmlspecialchars(strip_tags($_POST["password"])));
$ip = $_SERVER['REMOTE_ADDR'];

/*SEGURIDAD*/
$filtrar = new InputFilter();
$admin = $filtrar->process($admin);
$password = $filtrar->process($password);
/*SEGURIDAD*/
  
$consulta = "SELECT * FROM detalles_foro WHERE admin='$admin' AND password='$password'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();

if($fila > 0)
{
session_start();
$_SESSION["admin"] = true;
$_SESSION["nick_admin"] = $_POST["admin"];
$_SESSION["nombre_foro"] = $fila["title"];
Header('Location: index.php');
}
else
{
session_start();
$_SESSION["admin"] = false;
session_destroy();
header("location: admin.php");
}
}
?>