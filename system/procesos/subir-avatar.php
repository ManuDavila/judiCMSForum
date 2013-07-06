<?php
if (isset($_POST["subir_avatar"]))
{
session_start();
if ($_SESSION["usuario"] != true)
{
header("location: index.php");
exit();
}
$nombre = $_FILES['file']['name'];

$rand = rand(10000, 99999);
$cad = $rand."-".$nombre;
// Fin de la creacion de la cadena aletoria
$tamano = $_FILES [ 'file' ][ 'size' ]; // Leemos el tamaño del fichero
$tamano_max= 1000000; // Tamaño maximo permitido

if( $tamano < $tamano_max){ // Comprobamos el tamaño 
$destino = 'imagenes/avatares' ; // Carpeta donde se guardara
$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/
$tipo=$sep[1]; // Optenemos el tipo de imagen que es

if($tipo == "gif" || $tipo == "jpeg" || $tipo == "jpg" || $tipo == "png" || $tipo == "pjpeg" || $tipo == "x-png" || $_FILES['file']['tmp_name']=="")
{ 
$ruta = $destino . '/' .$cad; //Ruta donde se guarda el archivo
move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $ruta);  // Subimos el archivo

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
<strong>Avatar cambiado con éxito</strong>
</div>";
}
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>El tipo de archivo no es de los permitidos</strong>
</div>";
unlink($ruta);
return;
}
if ($_FILES['file']['tmp_name']=="")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Archivo desconocido</strong>
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
<strong>La imagen supera el máximo permitido</strong>
</div>";
return;
}
}
?>