<?php
if ($_GET["query"] == "mensajes")
{
$id_usuario = $_GET["id_usuario"];
//Evitar inyección sql
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
$apellido_1_usuario = $fila_usuario["apellido_1"];
$apellido_2_usuario = $fila_usuario["apellido_2"];
$fecha_registro_usuario = $fila_usuario["fecha_registro"];
$fecha_registro_usuario = explode("-", $fecha_registro_usuario);
$fecha_registro_usuario = $fecha_registro_usuario[2]." de ".get_string_mes($fecha_registro_usuario[1])." del ".$fecha_registro_usuario[0];
$avatar_usuario = $fila_usuario["avatar"];
$leyenda = $fila_usuario["leyenda"];
if ($leyenda != ""){
$leyenda = "Leyenda: <span class='label label-inverse'>".$fila_usuario["leyenda"]."</span>";
}
}
else
{
header("location: index.php");
exit();
}
//primero se hace la llamada al script
require("system/paginacion/paginacion.php");
// paginacion(conexion a la base de datos);
$paginacion = new paginacion($conexion);
//contar_filas(consulta para contar el total de filas);
$paginacion->contar_filas("SELECT COUNT(id_mensaje) FROM mensajes WHERE id_usuario=$id_usuario AND es_tema_principal='false'"); 
//tipo_resultados(numero de páginas, número de filas por página);
$paginacion->tipo_resultados(3, 10);

$consulta_temas = "SELECT * FROM mensajes WHERE id_usuario=$id_usuario AND es_tema_principal='false' ORDER BY id_mensaje DESC LIMIT ".$_empezar_de_fila.", ".$_maximo_resultados_pagina."";
$resultado_temas = $conexion->query($consulta_temas);
$x = 0;
while ($fila_temas = $resultado_temas->fetch_array())
{
$consulta_categoria = "SELECT id_categoria FROM subcategorias WHERE id_subcategoria=".$fila_temas["id_subcategoria"]."";
$resultado_categoria = $conexion->query($consulta_categoria);
$fila_categoria = $resultado_categoria->fetch_array();
$id_categoria = $fila_categoria["id_categoria"];

$description_user .= $fila_temas["tema"].", ";
$fecha_tema = $fila_temas["fecha"];
$fecha_tema = explode("-", $fecha_tema);
$fecha_tema = $fecha_tema[2]."-".$fecha_tema[1]."-".$fecha_tema[0];
$temas_usuario .= "<tr>";
$temas_usuario .= "<td><a id='text-overflow1-$x' href='index.php?action=tema&categoria=".$id_categoria."&subcategoria=".$fila_temas["id_subcategoria"]."&tema=".$fila_temas["id_tema"]."'>".$fila_temas["tema"]."</a></td>";
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
<h3>MENSAJES DE USUARIO</h3>
<table>
<tr>
<td>
<img src="<?php echo $avatar_usuario; ?>" class="img-rounded" style="width: 160px; height: 160px;">
</td>
<td style="padding-left: 15px;">
Usuario: <a href="index.php?action=user&id_usuario=<?php echo $_GET["id_usuario"]; ?>&query=verusuario"><strong><?php echo $nombre_usuario; ?></strong></a>
<br>
Registrado el <?php echo $fecha_registro_usuario; ?>
<br><br>
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
<br><br>
<table class="table table-bordered" style="width: 90%;">
<tr><td><strong>TEMA</strong></td><td><strong>MENSAJE</strong></td><td><strong>FECHA</strong></td></tr>
<?php echo $temas_usuario; ?>
</table>
<div id='paginacion' class="btn-toolbar">
<div class="btn-group">
<?php
// paginas(id, parametros opcionales);
$paginacion->paginas("paginacion", "&action=query&id_usuario=$id_usuario&query=mensajes");
?>
</div>
</div>
<?php
}
?>