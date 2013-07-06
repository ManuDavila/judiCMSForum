<?php
if($_GET["action"] == "panel-usuario")
{
session_start();
if ($_SESSION["usuario"] != true)
{
header("location: index.php");
exit();
}
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
$leyenda = "Leyenda: <span class='label label-inverse'>".$fila_avatar["leyenda"]."</span>";
}
?>
<img class="img-rounded" src="<?php echo $el_avatar; ?>" style="width: 160px; height: 160px;">
</td>
<td style="padding-left: 15px;">
Usuario: <a href="#"><strong><?php echo $_SESSION["nick"]; ?></strong></a>
<br>
<?php 
$fecha = $_SESSION["fecha"];
$fecha = explode("-", $fecha);
$fecha = $fecha[2]." de ".get_string_mes($fecha[1])." del ".$fecha[0];
?>
Registrado el <?php echo $fecha; ?>
<br><br>
<button id='button_avatar' class='btn btn-primary' data-toggle='modal' style='margin-right: 20px;' data-target='#myModal'>Cambiar Avatar</button><br><br>
<button id='button_baja' class='btn btn-danger' data-toggle='modal' style='margin-right: 20px;' data-target='#myModal2'>Solicitar mi eliminación del foro</button>
<br><br>
<form method="post">
<input type="text" name="guardar_leyenda" placeholder="Añade una Leyenda">
<br>
<button type="submit" class="btn">Añadir leyenda</button>
</form>
</td>
<td style="padding-left: 10px;">
<table>
<tr>
<td>TEMAS</td>
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
<tr><td>MENSAJES</td>
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
<label><strong>Seleccionar imagen: </strong><input type="file" name="file"></label>
<label>Formatos permitidos: jpg | jpeg | gif | png</label>
<label>Tamaño máximo 1 mb</label>
<input type="hidden" name="subir_avatar">
<button type="submit" class="btn">Subir</button>
</form>
<div class='modal-footer'>
<button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
</div>
</div>
</div>

<div id='myModal2' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='moda-body'>
<br><br>
<form method='post'>
<label><strong>Este paso es irreversible, ¿seguro que quieres continuar con la acción? </strong></label>
<input type="hidden" name="eliminar_cuenta">
<button type="submit" class="btn btn-danger">Eliminar mi cuenta</button>
</form>
<div class='modal-footer'>
<button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
</div>
</div>
</div>
</center>
<?php
}
?>