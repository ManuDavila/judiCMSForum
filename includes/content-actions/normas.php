<?php
if ($_GET["action"] == "normas")
{
?>
<center>
<strong><?php echo $inc_normas[0]; ?></strong>
<hr>
<ul style="width: 70%; text-align: left;">
<li><b>1.1</b> - <?php echo $inc_normas[1]; ?></li>
<li><b>1.2</b> - <?php echo $inc_normas[2]; ?></li>
<li><b>1.3</b> - <?php echo $inc_normas[3]; ?></li>
<li><b>1.4</b> - <?php echo $inc_normas[4]; ?></li>
<li><b>1.5</b> - <?php echo $inc_normas[5]; ?></li>
<li><b>1.6</b> - <?php echo $inc_normas[6]; ?></li>
</ul>
</center>
<?php
}
?>