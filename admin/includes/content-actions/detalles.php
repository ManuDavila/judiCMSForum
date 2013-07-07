<?php
if($_GET["action"] == "detalles")
{
restringido();
?>
<h3>Detalles administrativos del Foro</h3>
    <div class="btn-group">
    <button class="btn" id="btn_informacion_basica">Editar información básica del Foro</button>
    <button class="btn" id="btn_notificaciones">Notificaciones</button>
    </div>
<?php
$consulta_foro = "SELECT * FROM detalles_foro";
$resultado_foro = $conexion->query($consulta_foro);
$fila_foro = $resultado_foro -> fetch_array();
$title = $fila_foro["title"];
$keywords = $fila_foro["keywords"];
$description = $fila_foro["description"];
$email = $fila_foro["email_notificaciones"];
$notificacion_registro = $fila_foro["notificacion_registro"];
$notificacion_tema = $fila_foro["notificacion_tema"];
$notificacion_mensaje = $fila_foro["notificacion_mensaje"];
?>	
<div id='box_informacion_basica'>
<br><br>
<form method='post'>
<label><h4>Información básica del Foro</h4></label>
<table style="width: 100%;">
<tr>
<td style="text-align: right;">Título:</td><td style="width: 80%;"><input type='text' name='title' id='title' style='width: 80%;' value="<?php echo $title; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Keywords:</td><td><input type='text' name='keywords' id='keywords' style='width: 80%;' value="<?php echo $keywords; ?>"></td>
</tr>
</table>
Email para notificaciones: <input type='email' name='email_notificaciones' id='email_notificaciones' value="<?php echo $email;?>">
<br>
<textarea rows='8' style="width: 90%;" id='description' name='description'><?php echo $description; ?></textarea>
<br><br>
<button type='submit' class='btn'>Editar</button>
<button type="button" class="btn" id="cerrar_informacion_basica"><span class=" icon-remove-circle"></span> Cerrar</button>
<input type="hidden" name="informacion_basica">
</form>
</div>

<div id='box_notificaciones'>
<br><br>
<label><h4>Notificarme por email cada vez que ocurra uno de los siguientes procesos ...</h4></label>
<form method="post">
registro: <input type="checkbox" name="registro" <?php if ($notificacion_registro == "on") {echo "checked";} ?>>
temas: <input type="checkbox" name="temas" <?php if ($notificacion_tema == "on") {echo "checked";} ?>>
mensajes: <input type="checkbox" name="mensajes" <?php if ($notificacion_mensaje == "on") {echo "checked";} ?>>
<input type="hidden" name="informacion_notificaciones">
<button type="submit" class="btn">Aceptar</button>
<button type="button" class="btn" id="cerrar_notificaciones"><span class=" icon-remove-circle"></span> Cerrar</button>
</form>
</div>
<script>
$(function(){
$("#box_informacion_basica").hide();
$("#box_notificaciones").hide();

$("#btn_informacion_basica").click(function()
{
$("#box_informacion_basica").show();
$("#box_notificaciones").hide();
});
$("#btn_notificaciones").click(function(){
$("#box_notificaciones").show();
$("#box_informacion_basica").hide();
});
$("#cerrar_informacion_basica").click(function(){
$("#box_informacion_basica").hide();
});
$("#cerrar_notificaciones").click(function(){
$("#box_notificaciones").hide();
});
});
</script>
<?php
}
?>