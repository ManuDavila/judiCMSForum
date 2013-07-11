<?php 
if ($_GET["action"] == "indice")
{
include_once "".$url_foro."admin/system/restricted.php";
?>
<h3><?php echo $inc_indice_adm[0]; ?></h3>
<div class="alert alert-info">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php echo $inc_indice_adm[1]; ?>
</div>
<div class="btn-group">
  <button type="button" class='btn btn-inverse' id="btn_nuevo_indice"><?php echo $inc_indice_adm[2]; ?></button>
</div>
    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    <?php echo $inc_indice_adm[3]; ?>
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
    <li><a style="cursor: pointer;" id="editar"><?php echo $inc_indice_adm[4]; ?></a></li>
	<li><a style="cursor: pointer;" id="eliminar"><?php echo $inc_indice_adm[5]; ?></a></li>
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
   <td><strong><?php echo $inc_indice_adm[6]; ?></strong></td>
   <td><strong><?php echo $inc_indice_adm[7]; ?></strong></td>
   <td><strong><?php echo $inc_indice_adm[8]; ?><strong></td>
   <td><strong><?php echo $inc_indice_adm[9]; ?></strong></td>
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
<label><h4><?php echo $inc_indice_adm[10]; ?></h4></label>
<?php echo $inc_indice_adm[11]; ?>: <input type='text' name='titulo' id='titulo' placeholder='<?php echo $inc_indice_adm[11]; ?>' style='width: 80%;'><label id='e_titulo'></label>

<?php echo $inc_indice_adm[12]; ?>:
<textarea rows='8' style='width: 90%;' placeholder='<?php echo $inc_indice_adm[12]; ?>' id='descripcion' name='descripcion'></textarea><label id='e_descripcion'></label>

<?php echo $inc_indice_adm[13]; ?>: <input type='text' name='keywords' id='keywords' placeholder='<?php echo $inc_indice_adm[13]; ?>' style='width: 80%;'><label id='e_keywords'></label>
<button type='button' id='button_nuevo_indice' class='btn'><?php echo $inc_indice_adm[14]; ?></button>
<button type="button" class="btn" id="cerrar_nuevo_indice"><span class=" icon-remove-circle"></span> <?php echo $inc_indice_adm[15]; ?></button>
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