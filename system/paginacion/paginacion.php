<?php
//http://php-estudios.blogspot.com
// Autor: manudg_1@msn.com

error_reporting("E_NOTICE");

class paginacion
{

var $conexion;
var $total;
var $_page;
var $_empezar_de_fila;
var $_item;
var $_maximo_de_paginas;
var $_maximo_resultados_pagina;
var $_max;
var $_param;


function __construct($conexion)
{
$this->conexion=$conexion;
}

function contar_filas($consulta)
{
$this->consulta=$consulta;
$resultado = $this->conexion->query($consulta);
$fila = $resultado->fetch_array();
global $total;
$total=$fila[0];
}

function tipo_resultados($maximo_de_paginas, $maximo_resultados_pagina)
{
$this->maximo_de_paginas=$maximo_de_paginas;
$this->maximo_resultados_pagina=$maximo_resultados_pagina;
$this->saltos=$saltos;
$this->parametros=$parametros;


global $_page;
global $_empezar_de_fila;
global $_item;
global $_maximo_de_paginas;
global $_maximo_resultados_pagina;
global $_max;
global $_saltos;




$_empezar_de_fila=0;
$_item = 0;
$_maximo_de_paginas = $maximo_de_paginas;
$_maximo_resultados_pagina = $maximo_resultados_pagina;


if ($_GET["page"])
{

/* No inyeccion sql */
$_page = $_GET["page"];
if ($_page < 0 || !preg_match("/^([0-9])+$/", $_page))
{
return;
}
/* no inyección sql */

$_empezar_de_fila = $_page * $maximo_resultados_pagina;

/* No inyección sql */
$_item = $_GET["item"];
if ($_item < 0  || !preg_match("/^([0-9])+$/", $_item))
{
return;
}
/* No inyección sql */

$_maximo_de_paginas = $maximo_de_paginas + $maximo_resultados_pagina;

/* No inyeccion sql */
$_max = $_GET["max"];
if ($_max < 0  || !preg_match("/^([0-9])+$/", $_max))
{
return;
}
/* No inyección sql */

$_maximo_de_paginas = $_max;
}


if($_GET["page_siguiente"])
{
/*No inyección sql*/
$_page = $_GET["page_siguiente"];
if ($_page < 0  || !preg_match("/^([0-9])+$/", $_page))
{
return;
}
/*No inyección sql*/

$_empezar_de_fila = $_page * $maximo_resultados_pagina;

/* No inyección sql */
$_item = $_GET["item"];
if ($_item < 0  || !preg_match("/^([0-9])+$/", $_item))
{
return;
}
/* No inyección sql */

/* No inyección sql */
$_max = $_GET["max"];
if ($_max < 0  || !preg_match("/^([0-9])+$/", $_max))
{
return;
}
/* No inyección sql */

$_maximo_de_paginas = $_max + 1;
}

if($_GET["page_anterior"])
{

/* No inyección sql */
$_page = $_GET["page_anterior"] - 1;
if ($_page < 0  || !preg_match("/^([0-9])+$/", $_page))
{
return;
}
/* No inyección sql */

$_empezar_de_fila = $_page * $maximo_resultados_pagina;

/* No inyección sql */
$_item = $_GET["item"] - 1;
if ($_item < 0  || !preg_match("/^([0-9])+$/", $_item))
{
return;
}
/* No inyección sql */

/* no inyección sql */
$_max = $_GET["max"];
if ($_max < 0  || !preg_match("/^([0-9])+$/", $_max))
{
return;
}
/* no inyección sql */

$_maximo_de_paginas = $_max - 1;
}

if ($_GET["previous"])
{
$_maximo_de_paginas = $_maximo_de_paginas;
$_empezar_de_fila=0;
$_item = 0;
}
}

function paginas($class, $param)
{
global $_item;
global $_page;
global $_maximo_de_paginas;
global $_maximo_resultados_pagina;
global $total;
global $_param;

$_param = $param;
if($_item >= 1)
{
echo "<a class='$class btn'  href='?previous=1".$_param."'>Primera</a>";
echo "<a class='$class btn'  href='?page_anterior=$_page&item=$_item&max=$_maximo_de_paginas".$_param."'>Anterior</a>";
}


for($x = $_item; $x < $_maximo_de_paginas; $x++)
{
while($x * $_maximo_resultados_pagina < $total)
{
$p = $x+1;
echo "<a class='$class btn' href='?page=$x&item=$_item&max=$_maximo_de_paginas".$_param."'>$p</a>";
break;
}

}

$numeros = $_page+1;
echo "<span class='btn'>Pág. <b>$numeros</b></span>";

if ($_maximo_de_paginas * $_maximo_resultados_pagina < $total)
{
$_page = $_page+1;
$_item = $_item + 1;
echo "<a class='$class btn' href='?page_siguiente=$_page&item=$_item&max=$_maximo_de_paginas".$_param."'>Siguiente</a>";
}
}
}