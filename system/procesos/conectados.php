<?php
$time = time();

//Extraer usuarios que han iniciado sesión
$consulta_conectados = "SELECT COUNT(id) AS registrados_conectados FROM usuarios WHERE conectado > $time";
$resultado_conectados = $conexion->query($consulta_conectados);
$fila_conectados = $resultado_conectados->fetch_array();
$registrados_conectados = $fila_conectados["registrados_conectados"];

$consulta_si_esta_registrado = "SELECT * FROM usuarios WHERE conectado > $time AND ip='".$_SERVER["REMOTE_ADDR"]."'";
$resultado_si_esta_registrado = $conexion->query($consulta_si_esta_registrado);
$fila_si_esta_registrado = $resultado_si_esta_registrado->fetch_array();

if ($fila_si_esta_registrado == 0)
{
//Comprobar si ya se encuentra en la DB
$consulta_ip_invitados = "SELECT * FROM invitados WHERE ip='".$_SERVER["REMOTE_ADDR"]."'";
$resultado_ip_invitados = $conexion->query($consulta_ip_invitados);
$fila_ip_invitados = $resultado_ip_invitados->fetch_array();
if($fila_ip_invitados == 0){
//Insertar usuario invitado
$limite_invitado = $time+600;
$consulta_invitados = "INSERT INTO invitados(ip, conectado) VALUES('".$_SERVER["REMOTE_ADDR"]."', '$limite_invitado')";
$resultado_invitados = $conexion->query($consulta_invitados);  
}
}
else
{
$consulta_invitados = "DELETE FROM invitados WHERE ip='".$_SERVER["REMOTE_ADDR"]."'";
$resultado_invitados = $conexion->query($consulta_invitados);  
}
//Extraer invitados
$consulta_inv = "SELECT COUNT(id) AS total_invitados FROM invitados WHERE conectado > $time";
$resultado_inv = $conexion->query($consulta_inv);
$fila_inv = $resultado_inv->fetch_array();
$total_invitados = $fila_inv["total_invitados"];


$consulta_delete_inv = "DELETE FROM invitados WHERE conectado < $time";
$resultado_delete_inv = $conexion->query($consulta_delete_inv);

?>