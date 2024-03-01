<html>
<head><title>JoGoS</title><link href="style.css" rel="stylesheet" type="text/css"/></head>
<body>
<div align="center">
	<?php session_start();include("functions.php");if(isset($_SESSION['uid'])){extract(sql_mfa($conn,"SELECT username,sessions,ludus,gold FROM users u JOIN batts b ON u.id=b.id WHERE u.id='".$_SESSION['uid']."'"));}?>
	<div id="header">
		<a href="index"><b>J✧G✧S</b></a>
		<!--<div style="margin:16px;color:whitesmoke">
			<b>Sessions:</b> <?php echo $sessions?>
			<b>Ludus:</b> <?php echo $ludus?>
			<b>Gold:</b> <?php echo $gold?>
		</div>-->
	</div>
	<div id="container" style="display:flex;justify-content:center;">
		<div id="content" style="order:2">