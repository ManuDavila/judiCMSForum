<?php 
if ($_GET["action"] == "mensajes" && !$_GET["id_usuario"])
{
restringido();
$tema = $_GET["tema"];
$id_tema = $_GET["id_tema"];
?>
<h3>Mensajes del Tema: <?php echo $tema; ?></h3>
    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    Acciones
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
	<li><a style="cursor: pointer;" id="btn_eliminar_mensaje">Eliminar mensaje</a></li>
    </ul>
    </div>
    <form id="form_eliminar_mensaje" method="post">
	<input type='hidden' name='eliminar_mensaje'>
	</form>
<br><br>
<form method="post" id="form">
    <table class="table table-bordered" style="width: 85%;">
   <tr class="info">
   <td><strong>USUARIO</strong></td>
   <td><strong>MENSAJE</strong></td>
   <td><strong>TEMA<strong></td>
   <td><strong>ACCIONES</strong></td>
   </tr>
  <?php
    // Esto es para el final
//primero se hace la llamada al script
require("system/paginacion/paginacion.php");
// paginacion(conexion a la base de datos);
$paginacion = new paginacion($conexion);
$paginacion->contar_filas("SELECT COUNT(id_mensaje) FROM mensajes WHERE id_tema=$id_tema AND es_tema_principal='false'"); 
//tipo_resultados(numero de páginas, número de filas por página);
$paginacion->tipo_resultados(3, 10);
  $consulta = "SELECT * FROM mensajes WHERE id_tema=$id_tema AND es_tema_principal='false' ORDER BY id_mensaje DESC LIMIT ".$_empezar_de_fila.", ".$_maximo_resultados_pagina."";
  $resultado = $conexion->query($consulta);
  while($fila=$resultado->fetch_array())
  {
  $consulta_usuario = "SELECT * FROM usuarios WHERE id=".$fila["id_usuario"]."";
  $resultado_usuario = $conexion->query($consulta_usuario);
  $fila_usuario = $resultado_usuario->fetch_array();
  $usuario = $fila_usuario["nick"];
  $id_usuario = $fila_usuario["id"];
  echo "
  <tr>
  <td style='text-align: center;'><a href='index.php?action=usuario&id_usuario=$id_usuario'><span class='label label-important'>$usuario</span> <span class='icon-edit'></span></a></td>
  <td>".$fila["mensaje"]."</td>
  <td style='text-align: center;'><a href='".$url_foro."index.php?action=tema&categoria=".$fila["id_categoria"]."&subcategoria=".$fila["id_subcategoria"]."&tema=".$fila["id_tema"]."' target='_blank'>".$fila["tema"]."</a></td>
  <td style='text-align: center;'><input type='checkbox' name='mensaje' value='".$fila["id_mensaje"]."'></td>
  </tr>";
  }
  ?>
  </table>
 </form>
  <div id='paginacion' class="btn-toolbar">
<div class="btn-group">
<?php
// paginas(id, parametros opcionales);
$paginacion->paginas("paginacion", "&action=mensajes&id_tema=$id_tema&tema=$tema");
?>
</div>
</div>
<?php
}
?>