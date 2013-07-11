<?php
if(isset($_POST["bloquearIP_usuarios"]))
{
include_once "".$url_foro."admin/system/restricted.php";
foreach($_POST["item_bloquearIP_usuarios"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta_ip = "SELECT ip FROM usuarios WHERE id=$valor";
$resultado_ip = $conexion -> query ($consulta_ip);
$fila_ip = $resultado_ip -> fetch_array();
$ip = $fila_ip["ip"];
$baneado = "true";
$consulta = "INSERT INTO ip(ip, baneado) VALUES('$ip', '$baneado')";
$resultado = $conexion ->query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_bloquear_ip_usuarios_adm[0]."</strong>
</div>";
}
?>