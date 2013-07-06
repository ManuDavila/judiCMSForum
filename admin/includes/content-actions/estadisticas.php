<?php
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}
if($_GET["action"] == "estadisticas")
{
$fecha = date("Y-m-d");
$consulta_fecha_inicial = "SELECT fecha FROM visitas LIMIT 0, 1";
$resultado_fecha_inicial = $conexion -> query($consulta_fecha_inicial);
$fila_fecha_inicial = $resultado_fecha_inicial -> fetch_array();
$fecha_inicial = $fila_fecha_inicial["fecha"];
$fecha_inicial = explode("-", $fecha_inicial);
$fecha_inicial = $fecha_inicial[2]."-".$fecha_inicial[1]."-".$fecha_inicial[0];


$consulta_fecha = "SELECT fecha, visitas FROM visitas WHERE fecha='$fecha'";
$resultado_fecha = $conexion -> query($consulta_fecha);
$fila_fecha = $resultado_fecha -> fetch_array();
$default_fecha = $fila_fecha["fecha"];
$default_fecha = explode("-", $default_fecha);
$visitas_desde = $default_fecha[2]."-".$default_fecha[1]."-".$default_fecha[0];
$visitas_hasta = $default_fecha[2]."-".$default_fecha[1]."-".$default_fecha[0];
$total_visitas = "Páginas vistas en el día de hoy <span class='icon-arrow-right'></span> <strong><span class='label label-info'>".$fila_fecha["visitas"]."</span></strong>";


if (isset($_POST["visitas_desde"]) && isset($_POST["visitas_hasta"]))
{
$total_visitas = "";
$visitas_desde = $_POST["visitas_desde"];
$visitas_hasta = $_POST["visitas_hasta"];

if (!preg_match("/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/", $visitas_desde) || !preg_match("/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/", $visitas_hasta))
{
$visitas_desde = $fecha;
$visitas_hasta = $fecha;
}
else
{
$inicio = explode("-", $visitas_desde);
$inicio = $inicio[2]."-".$inicio[1]."-".$inicio[0];
$final = explode("-", $visitas_hasta);
$final = $final[2]."-".$final[1]."-".$final[0];
$consulta_fecha = "SELECT * FROM visitas WHERE DATE(fecha) BETWEEN '$inicio' AND '$final'";
$resultado_fecha = $conexion->query($consulta_fecha);
while($fila_fecha = $resultado_fecha -> fetch_array())
{
$sumando_visitas += $fila_fecha["visitas"];
}
$total_visitas = "Páginas vistas desde el <i>$visitas_desde</i> hasta el <i>$visitas_hasta</i> <span class='icon-arrow-right'></span> <strong><span class='label label-info'>".$sumando_visitas."</span></strong>";
}
}
?>
<h3>Estadísticas del Foro</h3>
<div class="alert alert-info">
<button type="button" class="close" data-dismiss="alert">&times;</button>
El primer reporte de páginas vistas del foro fue recibido el <i><?php echo $fecha_inicial; ?></i>
</div>
<form method="post" class="form-search" id="form_fecha">
Desde: <input type="text" name="visitas_desde" id="visitas_desde" class="input-small" value="<?php echo $visitas_desde; ?>"> 
Hasta: <input type="text" name="visitas_hasta" id="visitas_hasta" class="input-small" value="<?php echo $visitas_hasta; ?>">
<button type="button" onclick="fechas()" class="btn">Buscar</button>
</form>
<?php
echo $total_visitas;
}
?>