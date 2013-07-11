<?php
if (isset($_POST["theme"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$theme = htmlspecialchars($_POST["theme"]);
$consulta = "UPDATE detalles_foro SET theme='$theme'";
$resultado = $conexion -> query($consulta);
$msg_box = "
<meta http-equiv='refresh' content='3;URL=index.php?action=themes'>
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_themes_adm[0]."</strong>
</div>";
?>
<?php
}
?>