<?php
if (isset($_POST["icono"]))
{
restringido();
$nombre = $_FILES['file']['name'];
if($nombre == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>No has seleccionado ningún icono</strong>
</div>";
return;
}
$rand = rand(1, 1000);
$cad = $nombre;
$tamano = $_FILES [ 'file' ][ 'size' ];
$tamaño_max="8400000";

if( $tamano < $tamaño_max){
$destino = '../imagenes' ;
$sep=explode("image/", $_FILES["file"]["type"]);
$tipo=$sep[1];

if ($tipo == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tipo de archivo desconocido</strong>
</div>";
return;
}

if($tipo == "x-icon" || $_FILES['file']['tmp_name']==""){ 
$ruta = $destino . '/' .$cad;
move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $ruta);

$consulta_ico = "UPDATE detalles_foro SET icono='".$_FILES['file']['name']."'";
$resultado_ico = $conexion->query($consulta_ico);

$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con éxito</strong>
</div>";
}

else {
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>El tipo de archivo no es de los permitidos</strong>
</div>";
return;
}
}

else {
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>El archivo supera máximo permitido</strong>
</div>";
return;
}

if ($_FILES['file']['tmp_name']=="")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Ha ocurrido un error grave</strong>
</div>";
unlink($ruta);
return;
}
}
?>