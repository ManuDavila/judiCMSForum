<?php
if(isset($_POST["informacion_basica"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$title = addslashes(strip_tags(htmlspecialchars($_POST["title"])));
$keywords = addslashes(strip_tags(htmlspecialchars($_POST["keywords"])));
$description = addslashes(strip_tags(htmlspecialchars($_POST["description"])));
$email_notificaciones = $_POST["email_notificaciones"];

/*SEGURIDAD*/
if(!preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $email_notificaciones))
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_informacion_basica_foro_adm[0]."</strong>
</div>";
return;
}
/*SEGURIDAD*/

$consulta = "UPDATE detalles_foro SET title='$title', keywords='$keywords', description='$description', email_notificaciones='$email_notificaciones'";
$resultado = $conexion -> query($consulta);

if ($resultado)
{
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_informacion_basica_foro_adm[1]."</strong>
</div>";
}
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_informacion_basica_foro_adm[2]."</strong>
</div>";
}
}
?>