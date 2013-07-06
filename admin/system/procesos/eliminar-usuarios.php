<?php
if(isset($_POST["eliminar_usuarios"]))
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}
foreach($_POST["item_eliminar_usuarios"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta = "DELETE FROM usuarios WHERE id=$valor";
$resultado = $conexion ->query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con éxito</strong>
</div>";
}
?>