<?php
if(isset($_POST["instalar_tema"]))
{
restringido();
if ($_POST["instalar_tema"] == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>No has especificado la url del tema</strong>
</div>";
return;
}
if (!preg_match("/^http:\/\/www\.judicms\.com/", $_POST["instalar_tema"]))
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>url de descarga inválida</strong>
</div>";
return;
}

$paquete = explode("/", $_POST["instalar_tema"]);
for ($x = 0; $x < count($paquete); $x++)
{
$item = $x;
}
$url_theme = $_POST["instalar_tema"]."bootstrap.min.css";
$new_css = file_get_contents($url_theme);

if(!$new_css)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>URL inválida</strong>
</div>";
return;
}
$carpeta = $paquete[$item-1];
$new_folder = "../bootstrap/themes/".$carpeta;
$crear = mkdir($new_folder, 0777, true);

$new_ruta = $new_folder."/bootstrap.min.css";
$archivo = fopen($new_ruta, "w+");
fwrite($archivo, $new_css);
fclose($archivo);

$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tema $carpeta instalado con éxito</strong>
</div>";
}
?>