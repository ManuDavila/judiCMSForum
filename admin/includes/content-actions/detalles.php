<?php
if($_GET["action"] == "detalles")
{
include_once "".$url_foro."admin/system/restricted.php";
?>
<h3><?php echo $inc_detalles_adm[0]; ?></h3>
    <div class="btn-group">
    <button class="btn" id="btn_informacion_basica"><?php echo $inc_detalles_adm[1]; ?></button>
    <button class="btn" id="btn_notificaciones"><?php echo $inc_detalles_adm[2]; ?></button>
	<button class="btn" id="btn_language"><?php echo $inc_detalles_adm[15]; ?></button>
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
<label><h4><?php echo $inc_detalles_adm[3]; ?></h4></label>
<table style="width: 100%;">
<tr>
<td style="text-align: right;"><?php echo $inc_detalles_adm[4]; ?>:</td><td style="width: 80%;"><input type='text' name='title' id='title' style='width: 80%;' value="<?php echo $title; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_detalles_adm[5]; ?>:</td><td><input type='text' name='keywords' id='keywords' style='width: 80%;' value="<?php echo $keywords; ?>"></td>
</tr>
</table>
<?php echo $inc_detalles_adm[6]; ?>: <input type='email' name='email_notificaciones' id='email_notificaciones' value="<?php echo $email;?>">
<br>
<textarea rows='8' style="width: 90%;" id='description' name='description'><?php echo $description; ?></textarea>
<br><br>
<button type='submit' class='btn'><?php echo $inc_detalles_adm[7]; ?></button>
<button type="button" class="btn" id="cerrar_informacion_basica"><span class=" icon-remove-circle"></span> <?php echo $inc_detalles_adm[8]; ?></button>
<input type="hidden" name="informacion_basica">
</form>
</div>

<div id='box_notificaciones'>
<br><br>
<label><h4><?php echo $inc_detalles_adm[9]; ?></h4></label>
<form method="post">
<?php echo $inc_detalles_adm[10]; ?>: <input type="checkbox" name="registro" <?php if ($notificacion_registro == "on") {echo "checked";} ?>>
<?php echo $inc_detalles_adm[11]; ?>: <input type="checkbox" name="temas" <?php if ($notificacion_tema == "on") {echo "checked";} ?>>
<?php echo $inc_detalles_adm[12]; ?>: <input type="checkbox" name="mensajes" <?php if ($notificacion_mensaje == "on") {echo "checked";} ?>>
<input type="hidden" name="informacion_notificaciones">
<button type="submit" class="btn"><?php echo $inc_detalles_adm[13]; ?></button>
<button type="button" class="btn" id="cerrar_notificaciones"><span class=" icon-remove-circle"></span> <?php echo $inc_detalles_adm[14]; ?></button>
</form>
</div>

<div id='box_language'>
<br><br>
<label><h4><?php echo $inc_detalles_adm[15]; ?></h4></label>
<form method="post">
<select name="language" multiple="multiple" size="5">
<?php
$dir = "system/language/";
// Abre un directorio conocido, y procede a leer el contenido
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		if ($file != "." && $file != "..")
		{
		$file = str_replace(".php", "", $file);
		$file = trim($file);
            echo "<option value='$file'>$file</option>";
			}
        }
        closedir($dh);
    }
}
?>
</select>
<button type="submit" class="btn"><?php echo $inc_detalles_adm[16]; ?></button>
<button type="button" class="btn" id="cerrar_language"><span class=" icon-remove-circle"></span> <?php echo $inc_detalles_adm[17]; ?></button>
</form>
</div>
<script>
$(function(){
$("#box_informacion_basica").hide();
$("#box_notificaciones").hide();
$("#box_language").hide();

$("#btn_informacion_basica").click(function()
{
$("#box_informacion_basica").show();
$("#box_notificaciones").hide();
$("#box_language").hide();
});
$("#btn_notificaciones").click(function(){
$("#box_notificaciones").show();
$("#box_informacion_basica").hide();
$("#box_language").hide();
});
$("#btn_language").click(function(){
$("#box_language").show();
$("#box_informacion_basica").hide();
$("#box_notificaciones").hide();
});
$("#cerrar_informacion_basica").click(function(){
$("#box_informacion_basica").hide();
});
$("#cerrar_notificaciones").click(function(){
$("#box_notificaciones").hide();
});
$("#cerrar_language").click(function(){
$("#box_language").hide();
});
});
</script>
<?php
}
?>