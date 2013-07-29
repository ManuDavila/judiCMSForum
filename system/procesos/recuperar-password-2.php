<?php

if (isset($_POST["recuperar_password_2"])) {
    if (empty($_COOKIE["recuperar_password"])) {
        setcookie("recuperar_password", 1, time() + 3600);
    } else {
        setcookie("recuperar_password", $_COOKIE["recuperar_password"] + 1, time() + 3600);
    }
    if ($_COOKIE["recuperar_password"] > $max_activar_password) {
        echo "NO ROBOTS";
        exit();
    }
    $email = addslashes(htmlspecialchars(strip_tags($_POST["email"])));
    $password = addslashes(htmlspecialchars(strip_tags($_POST["password"])));
    $codigo_verificacion = addslashes(htmlspecialchars(strip_tags($_POST["codigo_verificacion"])));

    $filtrar = new InputFilter();
    $email = $filtrar->process($email);
    $password = $filtrar->process($password);
    $codigo_verificacion = $filtrar->process($codigo_verificacion);

    $consulta = "SELECT * FROM usuarios WHERE email='$email' AND codigo_verificacion='$codigo_verificacion'";
    $resultado = $conexion->query($consulta);
    $fila = $resultado->fetch_array();

    /* Encrypt pass to query the DB */
    $password = sha1($password);

    if ($fila > 0) {
        $consulta = "UPDATE usuarios SET password='$password' WHERE email='$email' AND codigo_verificacion='$codigo_verificacion'";
        $resultado = $conexion->query($consulta);
        $msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_recuperar_password_2[0] . "</strong>
</div>";
    } else {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_recuperar_password_2[1] . "</strong>
</div>";
    }
}
?>