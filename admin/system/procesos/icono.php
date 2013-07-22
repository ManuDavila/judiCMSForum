<?php
if (isset($_POST["icono"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$nombre = $_FILES['file']['name'];
if($nombre == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_icono_adm[0]."</strong>
</div>";
return;
}
$rand = rand(1, 1000);
$cad = $nombre;
$tamano = $_FILES [ 'file' ][ 'size' ];
$tamano_max="8400000";

if( $tamano < $tamano_max){
$destino = '../imagenes' ;
$sep=explode("image/", $_FILES["file"]["type"]);
$tipo=$sep[1];

if ($tipo == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_icono_adm[1]."</strong>
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
<strong>".$pro_icono_adm[2]."</strong>
</div>";
}

else {
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_icono_adm[3]."</strong>
</div>";
return;
}
}

else {
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_icono_adm[4]."</strong>
</div>";
return;
}

if ($_FILES['file']['tmp_name']=="")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_icono_adm[5]."</strong>
</div>";
unlink($ruta);
return;
}
}
?>