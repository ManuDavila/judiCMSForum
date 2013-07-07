<?php
if ($_GET["action"] == "themes")
{
restringido();
function listar_directorios_ruta($ruta){
   // abrir un directorio y listarlo recursivo
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
            //mostraría tanto archivos como directorios
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
            if (is_dir($ruta . $file) && $file!="." && $file!=".." && $file != "img"){
               //solo si el archivo es un directorio, distinto que "." y ".."
               echo "<option value='$file'>$file</option>";
               listar_directorios_ruta($ruta . $file . "/");
            }
         }
      closedir($dh);
      }
   }
}
$consulta_selected = "SELECT theme FROM detalles_foro";
$resultado_selected = $conexion -> query($consulta_selected);
$fila_selected = $resultado_selected -> fetch_array();
$theme_selected = $fila_selected["theme"];
?>
<h3>Diseñando el Foro</h3>

	<div class="btn-group">
    <button class="btn" id="btn_temas">Temas</button>
	<button class="btn" id="btn_instalar_tema">Instalar tema</button>
    <button class="btn" id="btn_icono">Icono</button>
	<button class="btn" id="btn_cabecera">Cabecera</button>
    </div>

<div id="box_temas">
<br>
<h4>Temas disponibles ...</h4>
Para descargar nuevos temas para tu foro ve a la siguiente dirección ... <a href="http://www.judicms.com/index.php?action=buscar-themes" target="_blank">THEMES</a>
<br><br>
<form method="post">
<select name='theme' multiple="multiple" size="10">
<?php
listar_directorios_ruta("../bootstrap/themes/"); 
?>
</select>
<button type="submit" class="btn">Aplicar estilos del tema seleccionado</button>
<button type="button" class="btn" id="cerrar_temas"><span class=" icon-remove-circle"></span> Cerrar</button>
</form>
</div>

<div id="box_icono">
<br><br>
<strong>Icono actual:</strong> <img src="<?php echo $url_foro."imagenes/".$icono_foro ?>">
<form method="post" enctype="multipart/form-data">
<b>Icono del Foro:</b>
<input type='file' name='file'> 
<input type="hidden" name="icono">
<span class="font-size-10">Max. 1Mb | .ico</span>
<br><br>
<button type="submit" class="btn">Subir icono</button>
<button type="button" class="btn" id="cerrar_icono"><span class=" icon-remove-circle"></span> Cerrar</button>
</form>
</div>

<div id="box_instalar_tema">
<br>
<h3>Instalar Tema</h3>
Para descargar nuevos temas para tu foro ve a la siguiente dirección ... <a href="http://www.judicms.com/index.php?action=buscar-themes" target="_blank">THEMES</a>
<br><br>
<form method="post" action="" class="form-search">
url del tema: <input type="text" name="instalar_tema">
<button type="submit" class="btn">Instalar</button>
<button type="button" class="btn" id="cerrar_instalar_tema"><span class=" icon-remove-circle"></span> Cerrar</button>
</form>
</div>

<div id="box_cabecera">
<br>
<h4>Insertar código HTML/Javascript en la cabecera del foro</h4>
<form method="post">
<textarea rows='8' style="width: 90%; font-family: 'Lucida Console'; font-size: 12px;" id='editar_cabecera' name='editar_cabecera'>
<?php include "../system/procesos/include-cabecera.php"; ?>
</textarea>
<br><br>
<button type="submit" class="btn">Aceptar</button>
<button type="button" class="btn" id="cerrar_cabecera"><span class=" icon-remove-circle"></span> Cerrar</button>
</form>
</div>

<script>
$(function()
{
$("#box_temas").hide();
$("#btn_temas").click(function()
{
$("#box_temas").show();
$("#box_icono").hide();
$("#box_instalar_tema").hide();
$("#box_cabecera").hide();
});

$("#box_instalar_tema").hide();
$("#btn_instalar_tema").click(function()
{
$("#box_instalar_tema").show();
$("#box_icono").hide();
$("#box_temas").hide();
$("#box_cabecera").hide();
});

$("#box_icono").hide();
$("#btn_icono").click(function()
{
$("#box_icono").show();
$("#box_temas").hide();
$("#box_instalar_tema").hide();
$("#box_cabecera").hide();
});

$("#box_cabecera").hide();
$("#btn_cabecera").click(function()
{
$("#box_cabecera").show();
$("#box_temas").hide();
$("#box_instalar_tema").hide();
$("#box_icono").hide();
});

$("#cerrar_temas").click(function()
{
$("#box_temas").hide();
});

$("#cerrar_instalar_tema").click(function()
{
$("#box_instalar_tema").hide();
});

$("#cerrar_icono").click(function()
{
$("#box_icono").hide();
});

$("#cerrar_cabecera").click(function()
{
$("#box_cabecera").hide();
});

$("select option").each(function(index){
 if($("select option:eq("+index+")").val() == "<?php echo $theme_selected; ?>")
 {
$("select option:eq("+index+")").attr("selected", true);
}
});

});
</script>
<?php
}
?>