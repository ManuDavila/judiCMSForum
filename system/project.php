<?php 
error_reporting("E_NOTICE");
include "system/no_xss/class.inputfilter.php";
include "system/no_xss/no-quotes.php";
include "system/conexion.php";
include "system/procesos/detalles-foro.php";
include "admin/system/language/$language_foro.php";
include "system/banear_ip/banear-ip.php"; 
include "system/session.php";
include "system/procesos.php";
?>