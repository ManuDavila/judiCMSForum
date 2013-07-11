     <center>
	 <br><br>
		<span class="badge badge-success"><?php echo $inc_footer[0]; ?></span>
	<span class="badge badge-info"><?php echo $inc_footer[1]; ?>: <?php echo $total_invitados; ?> <?php echo $inc_footer[2]; ?> - <?php echo $registrados_conectados ?> <?php echo $inc_footer[3]; ?></span>
	</center>
	  <br><br>
	  <footer>
	  <div class="text-center">
		  <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.<?php echo $footer_adm[0]; ?>"><img alt="Licencia de Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Judi CMS Forum</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.judicms.com" property="cc:attributionName" rel="cc:attributionURL">@judi</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.es_ES">Creative Commons 3.0 Unported License</a>.<br /> <a xmlns:dct="http://purl.org/dc/terms/" href="http://www.judicms.com" rel="dct:source">JUDI CMS FORUM</a>.
	</div>
	<br><br>
	</footer>
<?php mysqli_close($conexion); ?>