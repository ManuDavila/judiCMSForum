<?php
if (isset($_POST["language"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$language = addslashes(htmlspecialchars($_POST["language"]));

$consulta = "UPDATE detalles_foro SET language='$language'";
$resultado = $conexion -> query($consulta);

$msg_box = "
<meta http-equiv='refresh' content='3;URL=index.php?action=detalles'>
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_save_language_adm[0]."</strong>
</div>";

}
?>