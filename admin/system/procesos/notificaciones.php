<?php
if (isset($_POST["informacion_notificaciones"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$notificacion_registro = addslashes(htmlspecialchars(strip_tags($_POST["registro"])));
$notificacion_tema = addslashes(htmlspecialchars(strip_tags($_POST["temas"])));
$notificacion_mensaje = addslashes(htmlspecialchars(strip_tags($_POST["mensajes"])));

$consulta = "UPDATE detalles_foro SET notificacion_registro='$notificacion_registro', notificacion_tema='$notificacion_tema', notificacion_mensaje='$notificacion_mensaje'";
$resultado = $conexion -> query($consulta);

$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_notificaciones_adm[0]."</strong>
</div>";
}
?>