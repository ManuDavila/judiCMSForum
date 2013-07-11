<?php 
if ($_GET["action"] == "ayuda")
{
?>
<center>
<strong><?php echo $inc_ayuda[0]; ?></strong>
<hr>
<ul style="width: 70%; text-align: left;">
<li><?php echo $inc_ayuda[1]; ?></li>
<li><?php echo $inc_ayuda[2]; ?></li>
<li><?php echo $inc_ayuda[3]; ?></li>
<li><?php echo $inc_ayuda[4]; ?></li>
<li><?php echo $inc_ayuda[5]; ?></li>
</ul>
</center>
<?php
}
?>