<html><head><title>SPANTAKUS</title><link href="style.css" rel="stylesheet" type="text/css"/></head>
<body>
<div align="center">
	<div id="header"><a href="index"><b>SPANTAKUS</b></a></div>
	<?php session_start();
	include("functions.php");
	include("menus.php");?>
	<div id="content">
		<?php include("content.php");?>
	</div>
</div>
</body>
</html>