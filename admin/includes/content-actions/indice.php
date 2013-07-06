<?php 

session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}

if ($_GET["action"] == "indice")
{
?>
<h3>Índices del foro</h3>
<div class="alert alert-info">Tenga en cuenta que al eliminar un índice también se eliminarán todos los elementos asociados como subíndices, temas y mensajes.</div>
<div class="btn-group">
  <button type="button" class='btn btn-inverse' id="btn_nuevo_indice">Nuevo índice</button>
</div>
    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    Acciones
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
    <li><a style="cursor: pointer;" id="editar">Editar</a></li>
	<li><a style="cursor: pointer;" id="eliminar">Eliminar</a></li>
    </ul>
    </div>
	<form id="form_editar" method="post">
	<input type="hidden" name="editar_indices">
	</form>
    <form id="form_eliminar" method="post">
	<input type='hidden' name='eliminar_indices'>
	</form>
<div id="box_indices">
<br><br>
<form method="post" id="form">
    <table class="table table-bordered" style="width: 85%;">
   <tr class="info">
   <td><strong>ID</strong></td>
   <td><strong>ÍNDICES</strong></td>
   <td><strong>SUBÍNDICES<strong></td>
   <td><strong>ACCIONES</strong></td>
   </tr>
  <?php
  $consulta = "SELECT * FROM categorias";
  $resultado = $conexion->query($consulta);
  while($fila=$resultado->fetch_array())
  {
  $consulta_sub = "SELECT COUNT(id_subcategoria) AS total_sub FROM subcategorias WHERE id_categoria=".$fila["id_categoria"]."";
  $resultado_sub = $conexion->query($consulta_sub);
  $fila_sub = $resultado_sub->fetch_array();
  $total_sub = $fila_sub["total_sub"];
  echo "
  <tr>
  <td>".$fila["id_categoria"]."</td><td><a href='index.php?action=subindice&id_categoria=".$fila["id_categoria"]."'>".$fila["categoria"]."</a></td>
  <td style='text-align: center;'><a href='index.php?action=subindice&id_categoria=".$fila["id_categoria"]."'><span class='badge badge-success'>$total_sub</span> <span class='icon-edit'></span></a></td>
  <td style='text-align: center;'><input type='checkbox' name='indice' value='".$fila["id_categoria"]."'></td>
  </tr>";
  }
  ?>
  </table>
 </form>
 </div>

<div id="box_nuevo_indice">
<form method='post' id='form_nuevo_indice'>
<label><h4>Nuevo índice</h4></label>
Título: <input type='text' name='titulo' id='titulo' placeholder='Título' style='width: 80%;'><label id='e_titulo'></label>

Descripción:
<textarea rows='8' style='width: 90%;' placeholder='Descripcion' id='descripcion' name='descripcion'></textarea><label id='e_descripcion'></label>

Keywords: <input type='text' name='keywords' id='keywords' placeholder='Keywords' style='width: 80%;'><label id='e_keywords'></label>
<button type='button' id='button_nuevo_indice' class='btn'>Crear Índice</button>
<button type="button" class="btn" id="cerrar_nuevo_indice"><span class=" icon-remove-circle"></span> Cerrar</button>
<input type='hidden' name='nuevo_indice'>
</form>
</div>
<script>
$(function(){
$("#box_nuevo_indice").hide();
$("#btn_nuevo_indice").click(function()
{
$("#box_nuevo_indice").show();
$("#box_indices").hide();
});
$("#cerrar_nuevo_indice").click(function()
{
$("#box_nuevo_indice").hide();
$("#box_indices").show();
});
});
</script>
<?php
}
?>