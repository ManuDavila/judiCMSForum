<?php
if ($_GET["id_subcategoria"])
{
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $_GET["id_subcategoria"]))
{
header("location: index.php");
exit();
}
}

if ($_GET["id_categoria"])
{
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $_GET["id_categoria"]))
{
header("location: index.php");
exit();
}
}

if ($_GET["id_tema"])
{
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $_GET["id_tema"]))
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

if ($_GET["id_usuario"] == "")
{
$_GET["id_usuario"] = 0;
}

if ($_GET["orden"])
{
//Evitar inyección sql
if (!preg_match("/^([A-Z])+$/", $_GET["orden"]))
{
header("location: index.php");
exit();
}
}
?>