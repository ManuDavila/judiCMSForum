<?php
$fecha_visitas = date("Y-m-d");
$consulta_visitas = "SELECT * FROM visitas WHERE fecha='$fecha_visitas'";
$resultado_visitas = $conexion -> query($consulta_visitas);
$fila_visitas = $resultado_visitas -> fetch_array();
if ($fila_visitas > 0)
{
$consulta_update_visitas = "UPDATE visitas SET visitas=visitas+1 WHERE fecha='$fecha_visitas'";
$resultado_update_visitas = $conexion -> query($consulta_update_visitas);
}
else
{
$consulta_insert_visitas = "INSERT INTO visitas(fecha, visitas) VALUES('$fecha_visitas', '1')";
$resultado_insert_visitas = $conexion -> query($consulta_insert_visitas);
}
?>