<?php 
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}

if ($_GET["action"] == "subindice")
{
?>
<h3>Subíndices del foro</h3>
<div class="alert alert-info">Tenga en cuenta que al eliminar un subíndice también se eliminarán todos los elementos asociados como temas y mensajes.</div>
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
 echo     "<li><a style='cursor: pointer;' href='index.php?action=subindice&id_categoria=".$fila_in["id_categoria"]."'>".$fila_in["categoria"]."</a></li>";
 }
 ?>
    </ul>
    </div>
	<?php
	}
if ($_GET["action"] == "subindice" && $_GET["id_categoria"] != "")
{
$id_categoria = $_GET["id_categoria"];

$consulta = "SELECT categoria FROM categorias WHERE id_categoria=$id_categoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$categoria = $fila["categoria"];
?>
<h3>Índice: <?php echo $categoria; ?></h3>
<div class="btn-group">
  <button type="button" class='btn btn-inverse' id="btn_nuevo_subindice">Nuevo subíndice</button>
</div>
    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    Acciones
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
    <li><a style="cursor: pointer;" id="editar_sub">Editar</a></li>
	<li><a style="cursor: pointer;" id="eliminar_sub">Eliminar</a></li>
    </ul>
    </div>
	<form id="form_editar_sub" method="post">
	<input type="hidden" name="editar_subindices">
	</form>
    <form id="form_eliminar_sub" method="post">
	<input type='hidden' name='eliminar_subindices'>
	</form>
	<div id="box_subindices">
<br><br>
<form method="post" id="form">
    <table class="table table-bordered" style="width: 85%;">
   <tr class="info">
   <td><strong>ID</strong></td>
   <td><strong>SUBÍNDICES</strong></td>
   <td><strong>TEMAS<strong></td>
   <td><strong>ACCIONES</strong></td>
   </tr>
  <?php
  $consulta = "SELECT * FROM subcategorias WHERE id_categoria=$id_categoria";
  $resultado = $conexion->query($consulta);
  while($fila=$resultado->fetch_array())
  {
  $consulta_tema = "SELECT COUNT(id_tema) AS total_tema FROM temas WHERE id_subcategoria=".$fila["id_subcategoria"]."";
  $resultado_tema = $conexion->query($consulta_tema);
  $fila_tema = $resultado_tema->fetch_array();
  $total_tema = $fila_tema["total_tema"];
  echo "
  <tr>
  <td>".$fila["id_subcategoria"]."</td>
  <td><a href='index.php?action=temas&id_categoria=".$fila["id_categoria"]."&id_subcategoria=".$fila["id_subcategoria"]."'>".$fila["subcategoria"]."</a></td>
  <td style='text-align: center;'><a href='index.php?action=temas&id_categoria=$id_categoria&id_subcategoria=".$fila["id_subcategoria"]."'><span class='badge badge-success'>$total_tema</span> <span class='icon-edit'></span></a></td>
  <td style='text-align: center;'><input type='checkbox' name='subindice' value='".$fila["id_subcategoria"]."'></td>
  </tr>";
  }
  ?>
  </table>
 </form>
 </div>

<div id='box_nuevo_subindice'>
<form method='post' id='form_nuevo_subindice'>
<label><h4>Nuevo subíndice</h4></label>
Título: <input type='text' name='titulo' id='titulo' placeholder='Título' style='width: 80%;'><label id='e_titulo'></label>
Descripción:
<textarea rows='8' style='width: 90%;' placeholder='Descripcion' id='descripcion' name='descripcion'></textarea><label id='e_descripcion'></label>
Keywords: <input type='text' name='keywords' id='keywords' placeholder='Keywords' style='width: 80%;'><label id='e_keywords'></label>
<button type='button' id='button_nuevo_subindice' class='btn'>Crear subíndice</button>
<button type="button" class="btn" id="cerrar_nuevo_subindice"><span class=" icon-remove-circle"></span> Cerrar</button>
<input type='hidden' name='nuevo_subindice'>
<input type="hidden" name="id_categoria" value="<?php echo $id_categoria; ?>">
</form>
</div>
<script>
$(function(){
$("#box_nuevo_subindice").hide();
$("#btn_nuevo_subindice").click(function()
{
$("#box_nuevo_subindice").show();
$("#box_subindices").hide();
});
$("#cerrar_nuevo_subindice").click(function()
{
$("#box_nuevo_subindice").hide();
$("#box_subindices").show();
});
});
</script>
<?php
}
?>