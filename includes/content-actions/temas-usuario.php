<?php
if ($_GET["query"] == "temas")
{
$id_usuario = $_GET["id_usuario"];
if (!preg_match("/^([0-9])+$/", $id_usuario))
{
header("location: index.php");
exit();
}
$consulta_usuario = "SELECT * FROM usuarios WHERE id=$id_usuario";
$resultado_usuario = $conexion->query($consulta_usuario);
$fila_usuario = $resultado_usuario->fetch_array();
if($fila_usuario>0)
{
$nombre_usuario = $fila_usuario["nick"];
$apellidos_usuario = $fila_usuario["apellidos"];
$fecha_registro_usuario = $fila_usuario["fecha_registro"];
$fecha_registro_usuario = explode("-", $fecha_registro_usuario);

if ($language == "es")
{
$fecha_registro_usuario = $fecha_registro_usuario[2]." del ".get_string_mes($fecha_registro_usuario[1])." del ".$fecha_registro_usuario[0];
}
if ($language == "en")
{
$fecha_registro_usuario = "".get_string_mes($fecha_registro_usuario[1])." ".$fecha_registro_usuario[2].", ".$fecha_registro_usuario[0]."";
}

$avatar_usuario = $fila_usuario["avatar"];
$leyenda = $fila_usuario["leyenda"];
if ($leyenda != ""){
$leyenda = "<span class='label label-inverse'>".$fila_usuario["leyenda"]."</span>";
}
}
else
{
header("location: index.php");
exit();
}
require("system/paginacion/paginacion.php");
$paginacion = new paginacion($conexion);
$paginacion->contar_filas("SELECT COUNT(id_tema) FROM temas WHERE id_usuario=$id_usuario"); 
$paginacion->tipo_resultados(3, 10);

$consulta_temas = "SELECT * FROM temas WHERE id_usuario=$id_usuario ORDER BY id_tema DESC LIMIT ".$_empezar_de_fila.", ".$_maximo_resultados_pagina."";
$resultado_temas = $conexion->query($consulta_temas);
$x = 0;
while ($fila_temas = $resultado_temas->fetch_array())
{
$description_user .= $fila_temas["tema"].", ";
$fecha_tema = $fila_temas["fecha"];
$fecha_tema = explode("-", $fecha_tema);
$fecha_tema = $fecha_tema[2]."-".$fecha_tema[1]."-".$fecha_tema[0];
$temas_usuario .= "<tr>";
$temas_usuario .= "<td><a id='text-overflow1-$x' href='index.php?action=tema&categoria=".$fila_temas["id_categoria"]."&subcategoria=".$fila_temas["id_subcategoria"]."&tema=".$fila_temas["id_tema"]."'>".$fila_temas["tema"]."</a></td>";
$temas_usuario .= "<td id='text-overflow2-$x'>".$fila_temas["mensaje"]."</td>";
$temas_usuario .= "<td>".$fecha_tema."</td>";
$temas_usuario .= "</tr>";
$temas_usuario .= "<script type='text/javascript'>
   $(function()
   {
   text_ellipsis('#text-overflow1-$x', 30);
   text_ellipsis('#text-overflow2-$x', 80);
   });
   </script>";
$x++;
}
?>
<h3><?php echo $inc_temas_usuario[2]; ?></h3>
<table>
<tr>
<td>
<img src="<?php echo $avatar_usuario; ?>" class="img-rounded" style="width: 160px; height: 160px;">
</td>
<td style="padding-left: 15px;">
<?php echo $inc_temas_usuario[3]; ?>: <a href="index.php?action=user&id_usuario=<?php echo $_GET["id_usuario"]; ?>&query=verusuario"><strong><?php echo $nombre_usuario; ?></strong></a>
<br>
<?php echo $inc_temas_usuario[4]; ?> <?php echo $fecha_registro_usuario; ?>
<br><br>
</td>
<td style="padding-left: 10px;">
<table>
<tr>
<td><?php echo $inc_temas_usuario[5]; ?></td>
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
<tr><td><?php echo $inc_temas_usuario[6]; ?></td>
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
<br><br>
<table class="table table-bordered" style="width: 90%;">
<tr><td><strong><?php echo $inc_temas_usuario[7]; ?></strong></td><td><strong><?php echo $inc_temas_usuario[8]; ?></strong></td><td><strong><?php echo $inc_temas_usuario[9]; ?></strong></td></tr>
<?php echo $temas_usuario; ?>
</table>
<div id='paginacion' class="btn-toolbar">
<div class="btn-group">
<?php
$paginacion->paginas("paginacion", "&action=query&id_usuario=$id_usuario&query=temas");
?>
</div>
</div>
<?php
}
?>