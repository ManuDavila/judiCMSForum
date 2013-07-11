<?php
if (isset($_POST["nick_usuario"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$nick_usuario = addslashes(htmlspecialchars(strip_tags($_POST["nick_usuario"])));
$consulta = "SELECT id FROM usuarios WHERE nick='$nick_usuario'";
$resultado = $conexion -> query($consulta);
$fila = $resultado -> fetch_array();
$id = $fila["id"];
if ($fila == 0)
{
header("location: index.php?action=usuario&id_usuario=0");
exit();
}
else
{
header("location: index.php?action=usuario&id_usuario=$id");
exit();
}
}
?>