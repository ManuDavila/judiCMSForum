<?php
if(isset($_POST["lista_negra"]))
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}
$consulta_limpieza = "DELETE FROM ip";
$resultado_limpieza = $conexion -> query ($consulta_limpieza);

$lista_negra = htmlspecialchars($_POST["lista_negra"]);
$lista_negra = explode(",", $lista_negra);
for ($x=0; $x <= count($lista_negra); $x++)
{
if (preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", trim($lista_negra[$x])))
{
$consulta = "INSERT INTO ip(ip, baneado) VALUES('".trim($lista_negra[$x])."', 'true')";
$resultado = $conexion -> query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Ips añadidas a la lista negra con éxito</strong>
</div>";
}
?>