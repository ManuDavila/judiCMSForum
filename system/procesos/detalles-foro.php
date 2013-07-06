<?php
$consulta_foro = "SELECT * FROM detalles_foro";
$resultado_foro = $conexion->query($consulta_foro);
$fila_foro = $resultado_foro->fetch_array();
$email_foro = $fila_foro["email_notificaciones"];
$url_foro = $fila_foro["url"];
$title_foro = $fila_foro["title"];
$description_foro = $fila_foro["description"];
$keywords_foro = $fila_foro["keywords"];
$notificacion_registro = $fila_foro["notificacion_registro"];
$notificacion_tema = $fila_foro["notificacion_tema"];
$notificacion_mensaje = $fila_foro["notificacion_mensaje"];
$theme_foro = $fila_foro["theme"];
$icono_foro = $fila_foro["icono"];
?>