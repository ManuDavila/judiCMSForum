<?php
if($_GET["action"] == "panel-usuario")
{
include_once "".$url_foro."system/restricted.php";
?>
<center>
<table>
<tr>
<td>
<?php
$consulta_avatar = "SELECT avatar, leyenda FROM usuarios WHERE id=".$_SESSION["id"]."";
$resultado_avatar = $conexion->query($consulta_avatar);
$fila_avatar = $resultado_avatar->fetch_array();
$el_avatar = $fila_avatar["avatar"];
$leyenda = $fila_avatar["leyenda"];
if ($leyenda != ""){
$leyenda = "<span class='label label-inverse'>".$fila_avatar["leyenda"]."</span>";
}
?>
<img class="img-rounded" src="<?php echo $el_avatar; ?>" style="width: 160px; height: 160px;">
</td>
<td style="padding-left: 15px;">
<?php echo $inc_panel_usuario[0]; ?>: <a href="#"><strong><?php echo $_SESSION["nick"]; ?></strong></a>
<br>
<?php 
$fecha = $_SESSION["fecha"];
$fecha = explode("-", $fecha);

if ($language == "es")
{
$fecha = $fecha[2]." del ".get_string_mes($fecha[1])." del ".$fecha[0];
}
if ($language == "en")
{
$fecha = "".get_string_mes($fecha[1])." ".$fecha[2].", ".$fecha[0]."";
}

?>
<?php echo $inc_panel_usuario[3]; ?> <?php echo $fecha; ?>
<br><br>
<button id='button_avatar' class='btn btn-primary' data-toggle='modal' style='margin-right: 20px;' data-target='#myModal'><?php echo $inc_panel_usuario[4]; ?></button><br><br>
<button id='button_baja' class='btn btn-danger' data-toggle='modal' style='margin-right: 20px;' data-target='#myModal2'><?php echo $inc_panel_usuario[5]; ?></button>
<br><br>
<form method="post">
<input type="text" name="guardar_leyenda" placeholder="<?php echo $inc_panel_usuario[6]; ?>">
<br>
<button type="submit" class="btn"><?php echo $inc_panel_usuario[6]; ?></button>
</form>
</td>
<td style="padding-left: 10px;">
<table>
<tr>
<td><?php echo $inc_panel_usuario[7]; ?></td>
<td>
<?php 
$consulta_temas = "SELECT COUNT(id_tema) AS total_temas FROM temas WHERE id_usuario=".$_SESSION["id"]."";
$resultado_temas = $conexion->query($consulta_temas);
$fila_temas = $resultado_temas->fetch_array();
$total_temas = $fila_temas["total_temas"];
echo "<a href='index.php?action=user&id_usuario=".$_SESSION["id"]."&query=temas' class='label label-success'>$total_temas</a>";
?>
</td>
</tr>
<tr><td><?php echo $inc_panel_usuario[8]; ?></td>
<td>
<?php
$consulta_mensajes = "SELECT COUNT(id_mensaje) AS total_mensajes FROM mensajes WHERE id_usuario=".$_SESSION["id"]." AND es_tema_principal='false'";
$resultado_mensajes = $conexion->query($consulta_mensajes);
$fila_mensajes = $resultado_mensajes->fetch_array();
$total_mensajes = $fila_mensajes["total_mensajes"];
echo "<a href='index.php?action=user&id_usuario=".$_SESSION["id"]."&query=mensajes' class='label label-success'>$total_mensajes</a>";
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
<?php echo $leyenda; ?>
<div id='myModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='moda-body'>
<br><br>
<form method='post' enctype="multipart/form-data">
<label><strong><?php echo $inc_panel_usuario[9]; ?>: </strong><input type="file" name="file"></label>
<label><?php echo $inc_panel_usuario[10]; ?>: jpg | jpeg | gif | png</label>
<label><?php echo $inc_panel_usuario[11]; ?> 1 mb</label>
<input type="hidden" name="subir_avatar">
<button type="submit" class="btn"><?php echo $inc_panel_usuario[12]; ?></button>
</form>
<div class='modal-footer'>
<button class='btn' data-dismiss='modal' aria-hidden='true'><?php echo $inc_panel_usuario[13]; ?></button>
</div>
</div>
</div>

<div id='myModal2' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='moda-body'>
<br><br>
<form method='post'>
<label><strong><?php echo $inc_panel_usuario[14]; ?> </strong></label>
<input type="hidden" name="eliminar_cuenta">
<button type="submit" class="btn btn-danger"><?php echo $inc_panel_usuario[15]; ?></button>
</form>
<div class='modal-footer'>
<button class='btn' data-dismiss='modal' aria-hidden='true'><?php echo $inc_panel_usuario[16]; ?></button>
</div>
</div>
</div>
</center>
<?php
}
?>