<?php 
if ($_GET["action"] == "temas" && !$_GET["id_usuario"])
{
restringido();
?>
<h3>Temas del foro</h3>
<div class="alert alert-info">Tenga en cuenta que al eliminar un tema también se eliminarán todos los mensajes asociados al tema.</div>
<ul class="alert alert-info" style="width: 20%;">
<li>1º - Seleccione el índice</li>
<li>2º - Seleccione el subíndice</li>
</ul>
    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    Seleccionar índice:
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
 <?php
 $consulta_in = "SELECT * FROM categorias";
 $resultado_in = $conexion->query($consulta_in);
 while ($fila_in = $resultado_in -> fetch_array())
 {
 echo     "<li><a style='cursor: pointer;' href='index.php?action=temas&id_categoria=".$fila_in["id_categoria"]."'>".$fila_in["categoria"]."</a></li>";
 }
 ?>
    </ul>
    </div>
	<?php
	}

if ($_GET["action"] == "temas" && $_GET["id_categoria"] != "" && !$_GET["id_usuario"])
{
$id_categoria = $_GET["id_categoria"];
?>

    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    Seleccionar subíndice:
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
 <?php
 $consulta_in = "SELECT * FROM subcategorias WHERE id_categoria=$id_categoria";
 $resultado_in = $conexion->query($consulta_in);
 while ($fila_in = $resultado_in -> fetch_array())
 {
 echo     "<li><a style='cursor: pointer;' href='index.php?action=temas&id_categoria=".$fila_in["id_categoria"]."&id_subcategoria=".$fila_in["id_subcategoria"]."'>".$fila_in["subcategoria"]."</a></li>";
 }
 ?>
    </ul>
    </div>
<?php
}
if ($_GET["action"] == "temas" && $_GET["id_categoria"] != "" && $_GET["id_subcategoria"] != "" && !$_GET["id_usuario"])
{

$id_categoria = $_GET["id_categoria"];
$id_subcategoria = $_GET["id_subcategoria"];

$consulta = "SELECT subcategoria FROM subcategorias WHERE id_subcategoria=$id_subcategoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$subcategoria = $fila["subcategoria"];
?>
<h3>Temas del subíndice: <?php echo $subcategoria; ?></h3>
    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    Acciones
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
	<li><a style="cursor: pointer;" id="eliminar_temas">Eliminar</a></li>
	<li><a style="cursor: pointer;" id="cerrar_temas">Cerrar comentarios</a></li>
	<li><a style="cursor: pointer;" id="abrir_temas">Abrir comentarios</a></li>
    </ul>
    </div>
    <form id="form_eliminar_temas" method="post">
	<input type='hidden' name='eliminar_temas'>
	</form>
	    <form id="form_cerrar_temas" method="post">
	<input type='hidden' name='cerrar_temas'>
	</form>
		    <form id="form_abrir_temas" method="post">
	<input type='hidden' name='abrir_temas'>
	</form>
	
<br><br>
<form method="post" id="form">
    <table class="table table-bordered" style="width: 85%;">
   <tr class="info">
   <td><strong>ID</strong></td>
   <td><strong>TEMAS</strong></td>
   <td><strong>ESTADO</strong></td>
   <td><strong>AUTOR<strong></td>
   <td><strong>MENSAJES</strong></td>
   <td><strong>ACCIONES</strong></td>
   </tr>
  <?php
  // Esto es para el final
//primero se hace la llamada al script
require("system/paginacion/paginacion.php");
// paginacion(conexion a la base de datos);
$paginacion = new paginacion($conexion);
$paginacion->contar_filas("SELECT COUNT(id_tema) FROM temas WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria"); 
//tipo_resultados(numero de páginas, número de filas por página);
$paginacion->tipo_resultados(3, 10);
  
  $consulta = "SELECT * FROM temas WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria ORDER BY id_tema DESC LIMIT ".$_empezar_de_fila.", ".$_maximo_resultados_pagina."";
  $resultado = $conexion->query($consulta);
  while($fila=$resultado->fetch_array())
  {
if ($fila["tema_cerrado"] == "false")
{
$estado = "Abierto";
}
else
{
$estado = "Cerrado";
}
  
  $consulta_autor = "SELECT * FROM usuarios WHERE id=".$fila["id_usuario"]."";
  $resultado_autor = $conexion->query($consulta_autor);
  $fila_autor = $resultado_autor->fetch_array();
  $usuario = $fila_autor["nick"];
  $id_usuario = $fila_autor["id"];
  
  $consulta_total_mensajes = "SELECT COUNT(id_mensaje) AS total_mensajes FROM mensajes WHERE id_tema=".$fila["id_tema"]." AND es_tema_principal='false'";
  $resultado_total_mensajes = $conexion -> query($consulta_total_mensajes);
  $fila_total_mensajes = $resultado_total_mensajes->fetch_array();
  $total_mensajes = $fila_total_mensajes["total_mensajes"];
  
  echo "<tr><td>".$fila["id_tema"]."</td>
  <td><a href='".$url_foro."index.php?action=tema&categoria=$id_categoria&subcategoria=$id_subcategoria&tema=".$fila["id_tema"]."' target='_blank'>".$fila["tema"]."</a></td>
  <td>$estado</td>
  <td style='text-align: center;'><a href='index.php?action=usuario&id_usuario=$id_usuario'><span class='label label-important'>$usuario</span> <span class='icon-edit'></span></a></td>
  <td style='text-align: center;'><a href='index.php?action=mensajes&id_tema=".$fila["id_tema"]."&tema=".$fila["tema"]."'><span class='badge badge-success'>$total_mensajes</span> <span class='icon-edit'></span></a></td>
  <td style='text-align: center;'><input type='checkbox' name='tema' value='".$fila["id_tema"]."'></td></tr>";
  }
  ?>
  </table>
 </form>
 <div id='paginacion' class="btn-toolbar">
<div class="btn-group">
<?php
// paginas(id, parametros opcionales);
$paginacion->paginas("paginacion", "&action=temas&id_categoria=$id_categoria&id_subcategoria=$id_subcategoria");
?>
</div>
</div>
<?php
}
?>