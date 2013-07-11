<?php
error_reporting("E_ALL");
include_once "../conexion.php";
$consulta_foro = "SELECT * FROM detalles_foro";
$resultado_foro = $conexion->query($consulta_foro);
$fila_foro = $resultado_foro->fetch_array();
$language_foro = $fila_foro["language"];

include_once "../../admin/system/language/$language_foro.php";

if(isset($_POST["check_nick"]))
{
$nick = $_POST["check_nick"];
if(!preg_match("/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_]+$/", $nick))
{
echo "<span class='alert alert-error'>".$pro_comprobar_nick[0]."</span>";
return;
}

if (strlen($nick) < 3 || strlen($nick) > 25)
{
echo "<span class='alert alert-error'>".$pro_comprobar_nick[1]."</span>";
return;
}

$consulta_nick = "SELECT nick FROM usuarios WHERE nick='$nick'";
$resultado_nick = $conexion->query($consulta_nick);
$fila_nick = $resultado_nick->fetch_array();

if ($fila_nick > 0)
{
echo "<span class='alert alert-error'>".$pro_comprobar_nick[2]."</span>";
return;
}
else
{
echo "<span class='alert alert-success'>".$pro_comprobar_nick[3]."</span>";
return;
}
}
?>