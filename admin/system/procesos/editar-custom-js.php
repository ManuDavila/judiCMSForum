<?php

if (isset($_POST["editar_custom_js"])) {
    include_once "" . $url_foro . "admin/system/restricted.php";
    $no_permitido = array("<?", "<?php", "?>", "\\");
    $permitido = array("&lt;?", "&lt;?php", "?&gt;", "");

    $editar_custom_js = $_POST["editar_custom_js"];
    $editar_custom_js = str_replace($no_permitido, $permitido, $editar_custom_js);

    $ruta = "../bootstrap/js/custom.js";
    $archivo = fopen($ruta, "w+");
    fwrite($archivo, $editar_custom_js);
    fclose($archivo);

    $msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_editar_custom_js_adm[0] . "</strong>
</div>";
}
?>