<?php
error_reporting("E_ALL");
include_once "../conexion.php";
if(isset($_POST["check_nick"]))
{
$nick = $_POST["check_nick"];
if(!preg_match("/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_]+$/", $nick))
{
echo "<span class='alert alert-error'>S&#243;lo letras, n&#250;meros y guiones bajos</span>";
return;
}

if (strlen($nick) < 3 || strlen($nick) > 25)
{
echo "<span class='alert alert-error'>No menos de 3 caracteres ni m&#225;s de 25</span>";
return;
}

$consulta_nick = "SELECT nick FROM usuarios WHERE nick='$nick'";
$resultado_nick = $conexion->query($consulta_nick);
$fila_nick = $resultado_nick->fetch_array();

if ($fila_nick > 0)
{
echo "<span class='alert alert-error'>El nick no se encuentra disponible</span>";
return;
}
else
{
echo "<span class='alert alert-success'>El nick se encuentra disponible</span>";
return;
}
}
?>