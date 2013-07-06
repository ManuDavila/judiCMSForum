<?php
if($_GET["query"] == "verusuario")
{
?>
<table>
<tr>
<td>
<?php
$id_usuario = $_GET["id_usuario"];
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $id_usuario))
{
header("location: index.php");
exit();
}
$consulta = "SELECT * FROM usuarios WHERE id=".$id_usuario."";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$nombre = $fila["nick"];
$apellido_1 = $fila["apellido_1"];
$apellido_2 = $fila["apellido_2"];
$avatar = $fila["avatar"];
$leyenda = $fila["leyenda"];
if ($leyenda != ""){
$leyenda = "Leyenda: <span class='label label-inverse'>".$fila["leyenda"]."</span>";
}
$fecha = $fila["fecha_registro"];
$fecha = explode("-", $fecha);
$fecha = $fecha[2]." de ".get_string_mes($fecha[1])." del ".$fecha[0];
?>
<img src="<?php echo $avatar; ?>" class="img-rounded" style="width: 160px; height: 160px;">
</td>
<td style="padding-left: 15px;">
Usuario: <a href="index.php?action=user&id_usuario=<?php echo $_GET["id_usuario"]; ?>&query=verusuario"><strong><?php echo $nombre; ?></strong></a>
<br>
<?php 

?>
Registrado el <?php echo $fecha; ?>
</td>
<td style="padding-left: 10px;">
<table>
<tr>
<td>TEMAS</td>
<td>
<?php 
$consulta_temas = "SELECT COUNT(id_tema) AS total_temas FROM temas WHERE id_usuario=".$id_usuario."";
$resultado_temas = $conexion->query($consulta_temas);
$fila_temas = $resultado_temas->fetch_array();
$total_temas = $fila_temas["total_temas"];
echo "<a href='index.php?action=user&id_usuario=".$id_usuario."&query=temas' class='label label-success'>$total_temas</a>";
?>
</td>
</tr>
<tr><td>MENSAJES</td>
<td>
<?php
$consulta_mensajes = "SELECT COUNT(id_mensaje) AS total_mensajes FROM mensajes WHERE id_usuario=".$id_usuario." AND es_tema_principal='false'";
$resultado_mensajes = $conexion->query($consulta_mensajes);
$fila_mensajes = $resultado_mensajes->fetch_array();
$total_mensajes = $fila_mensajes["total_mensajes"];
echo "<a href='index.php?action=user&id_usuario=".$id_usuario."&query=mensajes' class='label label-success'>$total_mensajes</a>";
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
<?php echo $leyenda; ?>
<?php
}
?>