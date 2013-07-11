<?php
if(isset($_POST["instalar_tema"]))
{
include_once "".$url_foro."admin/system/restricted.php";
if ($_POST["instalar_tema"] == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_instalar_tema_adm[0]."</strong>
</div>";
return;
}
if (!preg_match("/^http:\/\/www\.judicms\.com/", $_POST["instalar_tema"]))
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_instalar_tema_adm[1]."</strong>
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
<strong>".$pro_instalar_tema_adm[2]."</strong>
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
<strong>Theme $carpeta ".$pro_instalar_tema_adm[3]."</strong>
</div>";
}
?>