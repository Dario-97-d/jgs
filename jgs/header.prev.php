<html>
<head><title>JoGoS</title><link href="style.css" rel="stylesheet" type="text/css"/></head>
<body>
<div align="center">
	<div id="header"><a href="index"><b>J✧G✧S</b></a></div>
	<?php session_start();
	include("functions.php");
	if(isset($_SESSION['uid'])){
		extract(sql_mfa($conn,"SELECT username,sessions FROM users  WHERE id='".$_SESSION['uid']."'"));
		$mail=sql_query($conn,"SELECT pmid FROM mailbox WHERE pmto='".$username."' AND seen=0");?>
		<div id="container">
			<div class="menu" style="float:right">
				<b>Sessions:</b> <?php echo $sessions?>
				<br /><br />
				<a href="mail"<?php echo(mysqli_num_rows($mail)>0?'style="text-decoration:underline"':'');?>><b>MAIL</b></a>
				<br /><br />
				<a href="msent"><b>SENT</b></a>
				<br /><br />
				<a href="mp"><b>SEND</b></a>
				<br /><br />
				<a href="index">Feedback</a>
			</div>
			<div class="menu" style="float:left">
				<a href="arena">✧ ARENA ✧</a>
				<br /><br />
				<a href="geral">✧ GERAL ✧</a>
				<br /><br />
				<a href="ludus">✧ LUDUS ✧</a>
				<br /><br />
				<a href="mates">✧ MATES ✧</a>
				<br /><br />
				<a href="under">✧ UNDER ✧</a>
			</div>
	<?php
	}
	?>
			<div id="content">