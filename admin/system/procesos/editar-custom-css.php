<?php

if (isset($_POST["editar_custom_css"])) {
    include_once "" . $url_foro . "admin/system/restricted.php";
    $no_permitido = array("<?", "<?php", "?>", "\\");
    $permitido = array("&lt;?", "&lt;?php", "?&gt;", "");

    $editar_custom_css = $_POST["editar_custom_css"];
    $editar_custom_css = str_replace($no_permitido, $permitido, $editar_custom_css);

    $ruta = "../bootstrap/css/style.css";
    $archivo = fopen($ruta, "w+");
    fwrite($archivo, $editar_custom_css);
    fclose($archivo);

    $msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_editar_custom_css_adm[0] . "</strong>
</div>";
}
?>