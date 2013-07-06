<?php
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}

if ($_GET["action"] == "temas" && $_GET["id_usuario"])
{
$id_usuario = $_GET["id_usuario"];
?>
<h3>Temas de usuario</h3>
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
   <td><strong>ACCIONES</strong></td>
   </tr>
  <?php
  // Esto es para el final
//primero se hace la llamada al script
require("system/paginacion/paginacion.php");
// paginacion(conexion a la base de datos);
$paginacion = new paginacion($conexion);
$paginacion->contar_filas("SELECT COUNT(id_tema) FROM temas WHERE id_usuario=$id_usuario"); 
//tipo_resultados(numero de páginas, número de filas por página);
$paginacion->tipo_resultados(3, 10);
  
  $consulta = "SELECT * FROM temas WHERE id_usuario=$id_usuario ORDER BY id_tema DESC LIMIT ".$_empezar_de_fila.", ".$_maximo_resultados_pagina."";
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
    
  echo "<tr><td>".$fila["id_tema"]."</td>
  <td><a href='".$url_foro."index.php?action=tema&categoria=".$fila["id_categoria"]."&subcategoria=".$fila["id_subcategoria"]."&tema=".$fila["id_tema"]."' target='_blank'>".$fila["tema"]."</a></td>
  <td>$estado</td>
  <td style='text-align: center;'><a href='index.php?action=usuario&id_usuario=$id_usuario'><span class='label label-important'>$usuario</span> <span class='icon-edit'></span></a></td>
  <td style='text-align: center;'><input type='checkbox' name='tema' value='".$fila["id_tema"]."'></td></tr>";
  }
  ?>
  </table>
 </form>
 <div id='paginacion' class="btn-toolbar">
<div class="btn-group">
<?php
// paginas(id, parametros opcionales);
$paginacion->paginas("paginacion", "&action=temas&id_usuario=$id_usuario");
?>
</div>
</div>
<?php
}
?>