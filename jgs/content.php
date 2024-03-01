<?php
if(isset($_GET['c'])){
	switch($_GET['c']){
		default:
			break;
		case "f":
			include("cfeedback.php");
			break;
		case "g":
			include("cgeral.php");
			break;
		case "l":
			include("cludus.php");
			break;
		case "m":
			include("cmail.php");
			break;
		case "p":
			include("cmp.php");
			break;
		case "s":
			include("cmsent.php");
	}
}else{
	include("cinfo.php");
}
?>