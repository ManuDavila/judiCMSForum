<?php
if ($_GET["tema"])
{
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $_GET["tema"]))
{
header("location: index.php");
exit();
}
}

if ($_GET["subcategoria"])
{
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $_GET["subcategoria"]))
{
header("location: index.php");
exit();
}
}

if ($_GET["categoria"])
{
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $_GET["categoria"]))
{
header("location: index.php");
exit();
}
}

if ($_GET["id_usuario"])
{
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $_GET["id_usuario"]))
{
header("location: index.php");
exit();
}
}
?>