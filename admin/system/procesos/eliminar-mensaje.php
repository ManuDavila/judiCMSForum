<?php
if(isset($_POST["eliminar_mensaje"]))
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}
foreach($_POST["item_eliminar_mensaje"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta = "DELETE FROM mensajes WHERE id_mensaje=$valor";
$resultado = $conexion ->query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con �xito</strong>
</div>";
}
?>