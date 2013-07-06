<?php
if(isset($_POST["antirobots"]))
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}

$max_registro = $_POST["max_registro"];
$max_activar_cuenta = $_POST["max_activar_cuenta"];
$max_iniciar_sesion = $_POST["max_iniciar_sesion"];
$max_recuperar_password = $_POST["max_recuperar_password"];
$max_activar_password = $_POST["max_activar_password"];
$max_contacto = $_POST["max_contacto"];
$max_temas = $_POST["max_temas"];
$max_mensajes = $_POST["max_mensajes"];
$max_iniciar_sesion_adm = $_POST["max_iniciar_sesion"];
$max_recuperar_password_adm = $_POST["max_recuperar_password_adm"];
$max_activar_password_adm = $_POST["max_activar_password_adm"];

$array_max = array
(
$max_registro, 
$max_activar_cuenta, 
$max_iniciar_sesion, 
$max_recuperar_password, 
$max_activar_password,
$max_contacto,
$max_temas,
$max_mensajes,
$max_iniciar_sesion_adm,
$max_recuperar_password_adm,
$max_activar_password_adm
);

for($x = 0; $x < count($array_max); $x++)
{
if (!preg_match("/^([0-9])+$/", $array_max[$x]))
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Alguno de los campos no contiene los caracteres permitidos, sólo números</strong>
</div>";
return;
}
}

$consulta = "UPDATE antirobots SET max_registro=$max_registro, max_activar_cuenta=$max_activar_cuenta, max_iniciar_sesion=$max_iniciar_sesion, ";
$consulta .= "max_recuperar_password=$max_recuperar_password, max_activar_password=$max_activar_password, max_contacto=$max_contacto, ";
$consulta .= "max_temas=$max_temas, max_mensajes=$max_mensajes, max_iniciar_sesion_adm=$max_iniciar_sesion_adm, ";
$consulta .= "max_recuperar_password_adm=$max_recuperar_password_adm, max_activar_password_adm=$max_activar_password_adm";
$resultado = $conexion -> query($consulta);

$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con éxito</strong>
</div>";
}
?>