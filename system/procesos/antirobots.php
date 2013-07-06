<?php
$consulta_antirobots = "SELECT * FROM antirobots";
$resultado_antirobots = $conexion->query($consulta_antirobots);
$fila_antirobots = $resultado_antirobots -> fetch_array();
$max_registro = $fila_antirobots["max_registro"];
$max_activar_cuenta = $fila_antirobots["max_activar_cuenta"];
$max_iniciar_sesion = $fila_antirobots["max_iniciar_sesion"];
$max_recuperar_password = $fila_antirobots["max_recuperar_password"];
$max_activar_password = $fila_antirobots["max_activar_password"];
$max_contacto = $fila_antirobots["max_contacto"];
$max_temas = $fila_antirobots["max_temas"];
$max_mensajes = $fila_antirobots["max_mensajes"];
$max_iniciar_sesion_adm = $fila_antirobots["max_iniciar_sesion_adm"];
$max_recuperar_password_adm = $fila_antirobots["max_recuperar_password_adm"];
$max_activar_password_adm = $fila_antirobots["max_activar_password_adm"];
?>
