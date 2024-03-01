		</div>
	<?php
	if(isset($_SESSION['uid'])){
		$mail=sql_query($conn,"SELECT pmid FROM mailbox WHERE pmto='".$username."' AND seen=0");?>
		<div class="menu" style="order:1;">
			<a href="ranks">✧ RANKS ✧</a>
			<br /><br />
			<a href="arena">✧ ARENA ✧</a>
			<br /><br />
			<a href="geral">✧ GERAL ✧</a>
			<br /><br />
			<a href="ludus">✧ LUDUS ✧</a>
			<br /><br />
			<a href="armas">✧ ARMAS ✧</a>
			<br /><br />
			<a href="mates">✧ MATES ✧</a>
			<br /><br />
			<a href="under">✧ UNDER ✧</a>
		</div>
		<div class="menu" style="order:3;">
			<b>Sessions:</b> <?php echo $sessions?>
			<br /><br />
			<b>Ludus:</b> <?php echo $ludus?>
			<br /><br />
			<b>Gold:</b> <?php echo $gold?>
			<br /><br />
			<a href="mail"<?php echo(mysqli_num_rows($mail)>0?'style="text-decoration:underline"':'');?>><b>MAIL</b></a>
			<br /><br />
			<a href="msent"><b>SENT</b></a>
			<br /><br />
			<a href="mp"><b>SEND</b></a>
			<br /><br />
			<a href="index">Feedback</a>
		</div>
	<?php
	}
	?>
	</div>
</div>
<div id="X"><h1><a href="logout">X</a></h1></div>
<?php mysqli_close($conn);?>
</body>
</html>