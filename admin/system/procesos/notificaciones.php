<?php
if (isset($_POST["informacion_notificaciones"]))
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}
$notificacion_registro = addslashes(htmlspecialchars(strip_tags($_POST["registro"])));
$notificacion_tema = addslashes(htmlspecialchars(strip_tags($_POST["temas"])));
$notificacion_mensaje = addslashes(htmlspecialchars(strip_tags($_POST["mensajes"])));

$consulta = "UPDATE detalles_foro SET notificacion_registro='$notificacion_registro', notificacion_tema='$notificacion_tema', notificacion_mensaje='$notificacion_mensaje'";
$resultado = $conexion -> query($consulta);

$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con éxito</strong>
</div>";
}
?>