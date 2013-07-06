<?php 
if (isset($_POST["exit"]))
{
$time_out = time();
$consulta_ip = "UPDATE usuarios SET ip='".$_SERVER['REMOTE_ADDR']."', conectado=$time_out WHERE id=".$_SESSION["id"]."";
$resultado_ip = $conexion->query($consulta_ip);
session_start();
session_destroy();
header("location: index.php");
}
?>