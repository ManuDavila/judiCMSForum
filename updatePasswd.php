<?php

/*
 * NOTES
 * Patch Script for 1.0.1 update,
 * In order to use this version you must Update passwords in DB using this patch script to encrypt them using SHA1.
 * It's strongly recomended to do a backup of the database and files before to this update.
 * 
 * NOTAS
 * Script de actualización para la versión 1.0.1, 
 * Debido a cambios en la base de datos se debe aplicar este parche para actualizar a la versión 1.0.1,
 * para cifrar las contraseñas actuales usando SHA1.
 * Se recomienda encarecidamente realizar una copia de seguridad de la base de datos y archivos antes de realizar esta actualización.
 * 
 * 
 * @author David Torres <gsanox@gmail.com>
 */

include_once './system/conexion.php';
// First UPDATE Table usuarios, col password to make it VARCHAR(50) instead of VARCHAR(20), 
// Sha1 requires 40 chars but since in detalles_foro the password is 50, we make it 50 for coherence
// 
// Primero Actualizamos la columna password de la tabla usuarios para hacerla VARCHAR(50) en vez de VARCHAR(20)
// Sha1 Requiere 40 caracteres, pero como en detalles_foro la columna password es de 50 lo mantenemos por coherencia
$sql = "ALTER TABLE `usuarios` CHANGE COLUMN `password` `password` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL  ;";
$resultado = $conexion->query($sql);

// If all went ok ...
// Si todo ha ido ok ...
if ($resultado) {
    // Get all current passwords from the system users and encrypt them
    // 
    // Obtenemos las contraseñas actuales de los usuarios dl sistema y las ciframos
    $sql = "SELECT * FROM `usuarios`";
    $resultado = $conexion->query($sql);
    $updates = array();
    while ($row = $resultado->fetch_assoc()) {
        $updates[] = array(
            "email" => $row["email"],
            "id" => $row["id"],
            "pass" => sha1($row["password"])
        );
    }

    // UPDATE new enc passwords
    // 
    // Actualizamos con las contraseñas cifradas
    $retorno = "";
    foreach ($updates as $upd) {
        $sql = "UPDATE `usuarios` SET password='" . $upd["pass"] . "' WHERE id=" . $upd["id"];
        $resultado = $conexion->query($sql) == 1 ? "con éxito." : "con errores.";
        $retorno .= "Usuario: " . $upd["email"] . " con id:" . $upd["id"] . " actualizado " . $resultado . "<br>";
    }
    $retorno .= "<br> Usuarios actualizados. <br>";
    
    // Update admin passwords too, assuming that there is only a single administrator in the forum
    // 
    // Actualiazmos la contraseña del administrador, asumiendo que solo hay uno en el foro
    $sql = "SELECT password FROM `detalles_foro` WHERE id=1";
    $resultado = $conexion->query($sql);
    $admin_pass = $resultado->fetch_row();
    $sql = "UPDATE `detalles_foro` SET password='".sha1($admin_pass[0])."' WHERE id=1";
    $resultado = $conexion->query($sql);
    
    // Finish
    // 
    // Acabamos
    if($resultado)
        echo $retorno."Administrador actualizado.";
    else 
        echo $retorno."Error al actualizar la contraseña del Administrador.";

    // Delete this file
    // 
    // Borramos este archivo
    unlink(__FILE__);
}
else {
    echo "Error al actualizar la tabla de usuarios.";
}
?>
