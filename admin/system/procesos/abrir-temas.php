<?php
if(isset($_POST["abrir_temas"]))
{
include_once "".$url_foro."admin/system/restricted.php";
foreach($_POST["item_a_abrir"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta = "UPDATE temas SET tema_cerrado='false' WHERE id_tema=$valor";
$resultado = $conexion ->query($consulta);
}
}
}
?>