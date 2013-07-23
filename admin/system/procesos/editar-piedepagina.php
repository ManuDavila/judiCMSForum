<?php 
if (isset($_POST["editar_piedepagina"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$no_permitido = array("<?", "<?php", "?>", "\\");
$permitido = array("&lt;?", "&lt;?php", "?&gt;", "");

$editar_piedepagina = $_POST["editar_piedepagina"];
$editar_piedepagina = str_replace($no_permitido, $permitido, $editar_piedepagina);

$ruta = "../system/procesos/include-piedepagina.php";
$archivo = fopen($ruta, "w+");
fwrite($archivo, $editar_piedepagina);
fclose($archivo);

$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_editar_piedepagina_adm[0]."</strong>
</div>";
}
?>