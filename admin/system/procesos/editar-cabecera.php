<?php 
if (isset($_POST["editar_cabecera"]))
{
restringido();
$no_permitido = array("<?", "<?php", "?>", "\\");
$permitido = array("&lt;?", "&lt;?php", "?&gt;", "");

$editar_cabecera = $_POST["editar_cabecera"];
$editar_cabecera = str_replace($no_permitido, $permitido, $editar_cabecera);

$ruta = "../system/procesos/include-cabecera.php";
$archivo = fopen($ruta, "w+");
fwrite($archivo, $editar_cabecera);
fclose($archivo);

$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con ?xito</strong>
</div>";

}
?>