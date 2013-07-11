<?php
if (isset($_POST["eliminar_cuenta"]))
{
include_once "".$url_foro."system/restricted.php";
$consulta = "SELECT avatar FROM usuarios WHERE id=".$_SESSION["id"]."";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$imagen_a_eliminar = $fila["avatar"];
if ($imagen_a_eliminar != "imagenes/avatares/chico.jpg" && $imagen_a_eliminar != "imagenes/avatares/chica.jpg")
{
unlink($imagen_a_eliminar);
}
$consulta = "DELETE FROM usuarios WHERE id=".$_SESSION["id"]."";
$resultado = $conexion->query($consulta);
session_start();
session_destroy();
header("location: index.php");
exit();
}
?>