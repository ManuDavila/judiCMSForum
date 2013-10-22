<?php
if (isset($_POST["subir_avatar"]))
{

include_once "".$url_foro."system/restricted.php";

$nombre = $_FILES['file']['name'];
$rand = rand(10000, 99999);
$cad = $rand."-".$nombre;
$tamano = $_FILES [ 'file' ][ 'size' ]; 
$tamano_max= 1000000; 

//Si el tamaño es el permitido y el nombre no está vacío
if( $tamano < $tamano_max && $nombre != ""){ 
$destino = 'imagenes/avatares' ; 
$sep=explode('image/',$_FILES["file"]["type"]); 
$tipo=$sep[1];

//Comprobar la extensión 
if($tipo == "gif" || $tipo == "jpeg" || $tipo == "jpg" || $tipo == "png" || $tipo == "pjpeg" || $tipo == "x-png")
{ 

//Si la extensión es correcta guardar el avatar
$ruta = $destino . '/' .$cad; 
move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $ruta);

//Seleccionar el avatar que tenía anteriormente
$consulta = "SELECT avatar FROM usuarios WHERE id=".$_SESSION["id"]."";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$imagen_a_eliminar = $fila["avatar"];

//Si el avatar es distinto de los predeterminados eliminarlo
if ($imagen_a_eliminar != "imagenes/avatares/chico.jpg" && $imagen_a_eliminar != "imagenes/avatares/chica.jpg")
{
unlink($imagen_a_eliminar);
}

//Actualizar la base de datos con la nueva ruta del avatar
$consulta = "UPDATE usuarios SET avatar='$ruta' WHERE id=".$_SESSION["id"]."";
$resultado = $conexion->query($consulta);
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_subir_avatar[0]."</strong>
</div>";
}
// Si no se ha podido realizar la operación mostrar un mensaje de error
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_subir_avatar[1]."</strong>
</div>";
return;
}
}
// Si no se ha podido realizar la operación mostrar un mensaje de error
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_subir_avatar[1]."</strong>
</div>";
return;
}
}
?>