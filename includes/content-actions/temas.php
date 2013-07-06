<?php
if ($_GET["action"] == "temas")
{
$id_categoria = $_GET["categoria"];
$id_subcategoria = $_GET["subcategoria"];

//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $id_categoria) || !preg_match("/^([0-9])+$/", $id_subcategoria))
{
header("location: index.php");
exit();
}
//Consulta la categoría de temas
$consulta_categoria = "SELECT * FROM categorias WHERE id_categoria=$id_categoria";
$resultado_categoria = $conexion->query($consulta_categoria);
$fila_categoria = $resultado_categoria->fetch_array();
$id_categoria = $fila_categoria["id_categoria"]; //Se obtiene el id_categoria
$nombre_categoria = $fila_categoria["categoria"]; //Se obtiene el nombre de la categoría

//Se comprueba si existe
if ($id_categoria > 0)
{
//Consulta la subcategoría de temas
$consulta_subcategoria = "SELECT * FROM subcategorias WHERE id_subcategoria=$id_subcategoria";
$resultado_subcategoria = $conexion->query($consulta_subcategoria);
$fila_subcategoria = $resultado_subcategoria->fetch_array();
$id_subcategoria = $fila_subcategoria["id_subcategoria"]; //Se obtiene el id_subcategoria
$nombre_subcategoria = $fila_subcategoria["subcategoria"]; // Se obtiene el nombre de la subcategoria

//Se comprueba si existe
if ($id_subcategoria > 0)
{

//primero se hace la llamada al script
require("system/paginacion/paginacion.php");
// paginacion(conexion a la base de datos);
$paginacion = new paginacion($conexion);
//contar_filas(consulta para contar el total de filas);
$paginacion->contar_filas("SELECT COUNT(id_tema) FROM temas WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria"); 
//tipo_resultados(numero de páginas, número de filas por página);
$paginacion->tipo_resultados(3, 10);

$consulta_temas = "SELECT * FROM temas WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria ORDER BY id_tema ASC LIMIT ".$_empezar_de_fila.", ".$_maximo_resultados_pagina."";
$resultado_temas = $conexion->query($consulta_temas);

//Se extraen los datos
$x = 0;
while($fila_temas = $resultado_temas->fetch_array())
{
//resto del código para obtener temas de la subcategoría
$temas .= "<tr>";
$temas .= "<td><a id='text-overflow1-$x' href='index.php?action=tema&categoria=$id_categoria&subcategoria=$id_subcategoria&tema=".$fila_temas["id_tema"]."'>".$fila_temas["tema"]."</a></td>";

//Respuestas
$consulta_respuestas = "SELECT COUNT(id_mensaje) AS total_respuestas FROM mensajes WHERE id_tema=".$fila_temas["id_tema"]." AND es_tema_principal='false'";
$resultado_respuestas = $conexion->query($consulta_respuestas);
$fila_respuestas = $resultado_respuestas->fetch_array();
$total_respuestas = $fila_respuestas["total_respuestas"];
$temas .= "<td style='text-align:center;'><span class='label label-success'>$total_respuestas</span></td>";
$temas .= "<td style='text-align:center;'><span class='label label-success'>".$fila_temas["visitas"]."</span></td>";

//Último mensaje
$consulta_ultimo_mensaje = "SELECT * FROM mensajes WHERE id_tema=".$fila_temas["id_tema"]." ORDER BY id_mensaje DESC";
$resultado_ultimo_mensaje = $conexion->query($consulta_ultimo_mensaje);
$fila_ultimo_mensaje = $resultado_ultimo_mensaje->fetch_array();
$ultimo_mensaje = $fila_ultimo_mensaje["mensaje"];
$id_usuario = $fila_ultimo_mensaje["id_usuario"];

$consulta_usuario = "SELECT nick, id FROM usuarios WHERE id='$id_usuario'";
$resultado_usuario = $conexion->query($consulta_usuario);
$fila_usuario = $resultado_usuario->fetch_array();
   $nombre_autor = "<a href='index.php?action=user&id_usuario=".$fila_usuario["id"]."&query=verusuario'><span class='label label-important'>".$fila_usuario["nick"]."</span></a>";
   if($fila_usuario["nick"] == "")
   {
   $nombre_autor = "<span class='label label-important'>Ya no pertenece al foro</span>";
   }
$temas .= "<td>".$nombre_autor." <span class='icon-arrow-right'></span> <a id='text-overflow2-$x' href='index.php?action=tema&categoria=$id_categoria&subcategoria=$id_subcategoria&tema=".$fila_temas["id_tema"]."'>$ultimo_mensaje</a></td>";
$temas .= "</tr>";
$temas .= "<script type='text/javascript'>
   $(function()
   {
   text_ellipsis('#text-overflow1-$x', 30);
   text_ellipsis('#text-overflow2-$x', 50);
   });
   </script>";
$x++;
}
}
}
else
{
header("location: index.php");
exit();
}
?>
<h3>Índice: <?php echo "<a href='index.php?action=categoria&categoria=$id_categoria'>$nombre_categoria</a>"; ?></h3>
<?php echo $formularios_temas; ?>
<br><br>
    <table class="table table-bordered" style="width: 90%;">
   <tr>
   <td><a href=""><strong style="font-size: 18px;">Temas de <?php echo $nombre_subcategoria; ?></strong></a></td>
   <td><strong>RESPUESTAS</strong></td>
   <td><strong>VISTAS</strong></td>
   <td><strong>ÚLTIMO MENSAJE</strong></td>
   </tr>
   <?php echo $temas; ?>
   </table>
<div id='paginacion' class="btn-toolbar">
<div class="btn-group">
<?php
// paginas(id, parametros opcionales);
$paginacion->paginas("paginacion", "&action=temas&&categoria=$id_categoria&subcategoria=$id_subcategoria");
?>
</div>
</div>
<br><br>
<script>
$(function(){
$("#button_comentar, #myModalC").remove();
});
</script>
<?php
}
?>