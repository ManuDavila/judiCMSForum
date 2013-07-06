<?php

$ip_entrante = $_SERVER['REMOTE_ADDR'];
$consulta_ip = "SELECT ip FROM ip WHERE baneado='true'";
$resultado_ip = $conexion->query($consulta_ip);
while($fila_ip = $resultado_ip->fetch_array())
{
if ($ip_entrante == $fila_ip["ip"])
{
header("location: http://www.google.com");
exit();
}
}
/*
if ($_SERVER["REMOTE_ADDR"] != "127.0.0.1")
{
require("geoip.inc");
$consulta_pais = "SELECT pais FROM paises WHERE baneado='true'";
$resultado_pais = $conexion->query($consulta);
$abir_bd = geoip_open("GeoIP.dat",GEOIP_STANDARD);
while ($fila_pais = $resultado_pais->fetch_array())
{
$pais = geoip_country_name_by_addr($abir_bd, $_SERVER['REMOTE_ADDR']); 
if ($pais == $fila_pais["pais"])
{
header("location: http://www.google.com");
exit();
}
}
geoip_close($abir_bd); 
}
*/
?>