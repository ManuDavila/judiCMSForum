<?php
session_start();
if ($_SESSION["usuario"] != true)
{
header("location: index.php");
exit();
}
?>
