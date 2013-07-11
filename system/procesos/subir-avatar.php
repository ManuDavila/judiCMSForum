<?php
if (isset($_POST["subir_avatar"]))
{
include_once "".$url_foro."system/restricted.php";

$nombre = $_FILES['file']['name'];
$rand = rand(10000, 99999);
$cad = $rand."-".$nombre;
$tamano = $_FILES [ 'file' ][ 'size' ]; 
$tamano_max= 1000000; 
if( $tamano < $tamano_max){ 
$destino = 'imagenes/avatares' ; 
$sep=explode('image/',$_FILES["file"]["type"]); 
$tipo=$sep[1]; 
if($tipo == "gif" || $tipo == "jpeg" || $tipo == "jpg" || $tipo == "png" || $tipo == "pjpeg" || $tipo == "x-png" || $_FILES['file']['tmp_name']=="")
{ 
$ruta = $destino . '/' .$cad; 
move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $ruta);

$consulta = "SELECT avatar FROM usuarios WHERE id=".$_SESSION["id"]."";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();

$imagen_a_eliminar = $fila["avatar"];

if ($imagen_a_eliminar != "imagenes/avatares/chico.jpg" && $imagen_a_eliminar != "imagenes/avatares/chica.jpg")
{
unlink($imagen_a_eliminar);
}

$consulta = "UPDATE usuarios SET avatar='$ruta' WHERE id=".$_SESSION["id"]."";
$resultado = $conexion->query($consulta);
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_subir_avatar[0]."</strong>
</div>";
}
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_subir_avatar[1]."</strong>
</div>";
unlink($ruta);
return;
}
if ($_FILES['file']['tmp_name']=="")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_subir_avatar[2]."</strong>
</div>";
unlink($ruta);
return;
}
}
if ($tamano > $tamano_max)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_subir_avatar[3]."</strong>
</div>";
return;
}
}
?>