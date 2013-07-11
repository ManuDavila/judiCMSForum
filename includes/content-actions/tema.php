<?php 
if ($_GET["action"] == "tema")
{

$query_id_tema = $_GET["tema"];

if (!preg_match("/^([0-9])+$/", $query_id_tema) || !preg_match("/^([0-9])+$/", $_GET["categoria"]) || !preg_match("/^([0-9])+$/", $_GET["subcategoria"]))
{
header("location: index.php");
exit();
}

$consulta_tema = "SELECT * FROM temas WHERE id_tema=$query_id_tema";
$resultado_tema = $conexion->query($consulta_tema);
$fila_tema = $resultado_tema->fetch_array();

if ($fila_tema > 0)
{
$query_id_categoria = $fila_tema["id_categoria"]; 
$query_id_subcategoria = $fila_tema["id_subcategoria"];
$query_id_usuario = $fila_tema["id_usuario"];
$query_tema = $fila_tema["tema"];
$query_mensaje_tema = $fila_tema["mensaje"];
$query_imagen_tema = $fila_tema["imagen"];
$query_url_tema = $fila_tema["url"];
$query_estado_tema = $fila_tema["tema_cerrado"];

if ($query_estado_tema == "true")
{
$estado_tema = 
"
<script>
$(function(){
$('#button_comentar').remove();
$('#myModaC').remove();
$('#comandos').prepend(\"<span class='label label-important' style='margin-right: 10px;'><i class='icon-exclamation-sign icon-white'></i> ".$inc_tema[0]." </span>\");
});
</script>
";
}
else
{
$estado_tema = "";
}
if ($query_url_tema == "")
{
$query_url_tema = "#";
}
$query_hora_tema = $fila_tema["hora"];
$query_fecha_tema = $fila_tema["fecha"];
$query_fecha_tema = explode("-",$query_fecha_tema);
if ($language == "es")
{
$query_fecha_tema = $query_fecha_tema[2]." del ".get_string_mes($query_fecha_tema[1])." del ".$query_fecha_tema[0];
}
if ($language == "en")
{
$query_fecha_tema = "".get_string_mes($query_fecha_tema[1])." ".$query_fecha_tema[2].", ".$query_fecha_tema[0]."";
}



//Actualizar contador de visitas
$consulta_visitas = "UPDATE temas SET visitas=visitas+1 WHERE id_tema=$query_id_tema";
$resultado_visitas = $conexion->query($consulta_visitas);

//Consulta la categoría del tema
$consulta_categoria = "SELECT * FROM categorias WHERE id_categoria=$query_id_categoria";
$resultado_categoria = $conexion->query($consulta_categoria);
$fila_categoria = $resultado_categoria->fetch_array();
$categoria = $fila_categoria["categoria"];

//Consulta la subcategoría del tema
$consulta_subcategoria = "SELECT * FROM subcategorias WHERE id_subcategoria=$query_id_subcategoria";
$resultado_subcategoria = $conexion->query($consulta_subcategoria);
$fila_subcategoria = $resultado_subcategoria->fetch_array();
$subcategoria = $fila_subcategoria["subcategoria"];

//Consulta los datos del autor del tema
$consulta_autor = "SELECT * FROM usuarios WHERE id=".$query_id_usuario."";
$resultado_autor = $conexion->query($consulta_autor);
$fila_autor = $resultado_autor->fetch_array();
$query_nombre_autor = "<a href='index.php?action=user&id_usuario=".$fila_autor["id"]."&query=verusuario'><span class='label label-important'>".$fila_autor["nick"]."</span></a>";
$query_avatar_autor = $fila_autor["avatar"];
$query_leyenda_autor = $fila_autor["leyenda"];
if ($query_leyenda_autor != ""){
$query_leyenda_autor = "<span class='label label-inverse'>".$fila_autor["leyenda"]."</span>";
}
$fecha_registro = $fila_autor["fecha_registro"];
$fecha_registro = explode("-", $fecha_registro);

if ($language == "es")
{
$fecha_registro = $fecha_registro[2]." del ".get_string_mes($fecha_registro[1])." del ".$fecha_registro[0];
}
if ($language == "en")
{
$fecha_registro = "".get_string_mes($fecha_registro[1])." ".$fecha_registro[2].", ".$fecha_registro[0]."";
}


if($fila_autor["nick"] == "")
{
$query_nombre_autor = "<span class='label label-important'>".$inc_tema[3]."</span>";
$query_avatar_autor = "imagenes/avatares/delete.jpeg";
$fecha_registro = "[".$inc_tema[4]."]";
}
}
else
{
header("location: index.php");
exit();
}
require("system/paginacion/paginacion.php");
$paginacion = new paginacion($conexion);
$paginacion->contar_filas("SELECT COUNT(id_mensaje) FROM mensajes WHERE id_tema=$query_id_tema AND es_tema_principal='false'"); 
$paginacion->tipo_resultados(3, 10);

$consulta = "SELECT * FROM mensajes WHERE id_tema=$query_id_tema AND es_tema_principal='false' ORDER BY id_tema ASC LIMIT ".$_empezar_de_fila.", ".$_maximo_resultados_pagina."";
$resultado = $conexion->query($consulta);
while($fila=$resultado->fetch_array())
{
$fecha_mensaje = explode("-",$fila["fecha"]);

if ($language == "es")
{
$fecha_mensaje = $fecha_mensaje[2]." del ".get_string_mes($fecha_mensaje[1])." del ".$fecha_mensaje[0];
}
if ($language == "en")
{
$fecha_mensaje = "".get_string_mes($fecha_mensaje[1])." ".$fecha_mensaje[2].", ".$fecha_mensaje[0]."";
}

$hora_mensaje = $fila["hora"];

$consulta_usuario = "SELECT * FROM usuarios WHERE id=".$fila["id_usuario"]."";
$resultado_usuario = $conexion->query($consulta_usuario);
$fila_usuario = $resultado_usuario->fetch_array();
$nombre_usuario = "<a href='index.php?action=user&id_usuario=".$fila_usuario["id"]."&query=verusuario'><span class='label label-important'>".$fila_usuario["nick"]."</span></a>";
$avatar_usuario = $fila_usuario["avatar"];
$fecha_usuario = $fila_usuario["fecha_registro"];
$fecha_usuario = explode("-", $fecha_usuario);

if ($language == "es")
{
$fecha_usuario = $fecha_usuario[2]." del ".get_string_mes($fecha_usuario[1])." del ".$fecha_usuario[0];
}
if ($language == "en")
{
$fecha_usuario = "".get_string_mes($fecha_usuario[1])." ".$fecha_usuario[2].", ".$fecha_usuario[0]."";
}


$leyenda_usuario = $fila_usuario["leyenda"];
if ($leyenda_usuario != ""){
$leyenda_usuario = "<span class='label label-inverse'>".$fila_usuario["leyenda"]."</span>";
}

if ($fila["url"] == "")
{
$fila["url"] = "#";
}

if($fila_usuario["nick"] == "")
{
$nombre_usuario = "<span class='label label-important'>".$inc_tema[3]."</span>";
$avatar_usuario = "imagenes/avatares/delete.jpeg";
$fecha_usuario = "[".$inc_tema[4]."]";
}

$mensajes .= "<div class='text-left' style='width: 80%; height: auto; border-radius: 5px; border: 1px solid #C8C8C9; padding: 10px;'>
<table class='table'>
<tr>
<td><img src='$avatar_usuario' class='img-rounded' style='float: left; margin-right: 10px; width: 120px; height: 120px;'></td>
<td>".$inc_tema[5].": <strong>$nombre_usuario</strong> ".$inc_tema[6]." $fecha_usuario<br>
".$inc_tema[7].": $fecha_mensaje<br>
".$inc_tema[8].": $hora_mensaje<br>
".$inc_tema[9].": <a href='".$fila["url"]."' style='font-size: 11px;' target='_blank'>".$fila["url"]."</a>
</td>
</tr>
</table>
<div style='width: 75%; padding-left: 12.5%;'> 
".$fila["mensaje"]."
<br><br>
<center><img style='width: 25%; height: 25%;' src='".$fila["imagen"]."' title='".$fila["tema"]."'></center>
$leyenda_usuario
</div>
</div>";
}
?>
<br>
<?php echo $formularios_temas; ?>
<br>
<h2 class='text-info'><a href="index.php?action=tema&categoria=<?php echo $query_id_categoria; ?>&subcategoria=<?php echo $query_id_subcategoria; ?>&tema=<?php echo $query_id_tema; ?>"><?php echo $query_tema; ?></a></h2>
<h4><?php echo $query_nombre_autor; ?> <?php echo $inc_tema[10]; ?>: <?php echo "<a href='index.php?action=categoria&categoria=$query_id_categoria'>".$categoria."</a> - <a href='index.php?action=temas&categoria=$query_id_categoria&subcategoria=$query_id_subcategoria'>".$subcategoria; ?></a></h4>
<br>
<div class='text-left' style='width: 80%; height: auto; border-radius: 5px; border: 1px solid #C8C8C9; padding: 10px;'>
<table class="table">
<tr>
<td>
<img class="img-rounded" src="<?php echo $query_avatar_autor; ?>" style="width: 120px; height: 120px;">
</td>
<td style="padding-left: 15px;">
<?php echo $inc_tema[5]; ?>: <strong><?php echo $query_nombre_autor; ?></strong> <?php echo $inc_tema[6]; ?> <?php echo $fecha_registro; ?><br>
<?php echo $inc_tema[7]; ?>: <?php echo $query_fecha_tema; ?><br>
<?php echo $inc_tema[8]; ?>: <?php echo $query_hora_tema; ?><br>
<?php echo $inc_tema[9]; ?>: <a href='<?php echo $query_url_tema; ?>' style='font-size: 11px;' target='_blank'><?php echo $query_url_tema; ?></a><br>
<?php echo $inc_tema[11]; ?>: <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode($url_foro."index.php?action=tema&categoria=".$_GET["categoria"]."&subcategoria=".$_GET["subcategoria"]."&tema=".$_GET["tema"].""); ?>" target="_blank"><img src="imagenes/facebook.png" title="<?php echo $inc_tema[12]; ?>" width="16" height="16"></a> 
           <a href="http://www.twitter.com/home?status=<?php echo rawurlencode($url_foro."index.php?action=tema&categoria=".$_GET["categoria"]."&subcategoria=".$_GET["subcategoria"]."&tema=".$_GET["tema"].""); ?>" target="_blank"><img src="imagenes/twitter.png" title="<?php echo $inc_tema[13]; ?>" width="16" height="16"></a> 
		   <a href="https://plus.google.com/share?url=<?php echo rawurlencode($url_foro."index.php?action=tema&categoria=".$_GET["categoria"]."&subcategoria=".$_GET["subcategoria"]."&tema=".$_GET["tema"].""); ?>" target="_blank"><img src="imagenes/googleplus.png" title="<?php echo $inc_tema[14]; ?>" width="16" height="16"></a>
</td>
</tr>
</table>
<div style="width: 75%; padding-left: 12.5%;">
<?php echo $query_mensaje_tema; ?>
<br><br>
<center><img style='width: 25%; height: 25%;' src='<?php echo $query_imagen_tema; ?>' title='<?php echo $query_tema; ?>'></center>
<?php echo $query_leyenda_autor; ?>
</div>
</div>
<?php echo $mensajes; ?>
</center>
   <center>
<div id='paginacion' class="btn-toolbar">
<div class="btn-group">
<?php
// paginas(id, parametros opcionales);
$paginacion->paginas("paginacion", "&action=tema&categoria=$query_id_categoria&subcategoria=$query_id_subcategoria&tema=$query_id_tema");
?>
</div>
</div>
<?php
echo $estado_tema;
}
?>