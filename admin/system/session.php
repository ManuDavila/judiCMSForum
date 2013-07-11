<?php
session_start();
if ($_SESSION["admin"] == true)
{
$session = "
<form method='post' class='navbar-form pull-right'>
<button type='submit' class='btn'>
<i class='icon-off icon-grey'></i></button>
<input type='hidden' name='exit'>
</form>

<form method='get' class='navbar-form pull-right'>
<button type='submit' class='btn'>
<i class='icon-user icon-grey'></i>".$session_adm[0]." ".$_SESSION["nick_admin"]."
</button>
<input type='hidden' name='action' value='detalles'>
</form>
";
}
else
{
header("location: admin.php");
exit();
}
?>