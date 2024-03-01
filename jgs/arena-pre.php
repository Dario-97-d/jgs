<?php include("header.php");
if(!isset($_GET['id'])||!ctype_digit($pid=$_GET['id'])||$pid==$_SESSION['uid']){exiter("arena");}
extract(sql_mfa($conn,"SELECT username,b.* FROM users u JOIN batts b ON u.id=b.id WHERE b.id=".$_SESSION['uid']),EXTR_PREFIX_ALL,"u");
extract(sql_mfa($conn,"SELECT username,b.* FROM users u JOIN batts b ON u.id=b.id WHERE b.id=".$pid),EXTR_PREFIX_ALL,"p");
?>
<h1>Arena</h1>
<h2>Prepare fight</h2>
<table cellpadding="8" border="1" style="text-align:center;">
	<tr><th style="width:128px;"><?php echo $u_username;?></th><th style="width:64px;">VS</th><th style="width:128px;"><?php echo $p_username;?></th></tr>
	<tr><td><?php echo $u_speed;?></td><td>Speed</td><td><?php echo $p_speed;?></td></tr>
	<tr><td><?php echo $u_power;?></td><td>Power</td><td><?php echo $p_power;?></td></tr>
	<tr><td><?php echo $u_skill;?></td><td>Skill</td><td><?php echo $p_skill;?></td></tr>
	<tr><td><?php echo $u_flair;?></td><td>Flair</td><td><?php echo $p_flair;?></td></tr>
	<tr><td><?php echo $u_sense;?></td><td>Sense</td><td><?php echo $p_sense;?></td></tr>
	<tr><td>Standard</td><th>Style</th><td>Standard</td></tr>
</table>
<br />
<form action="arena-go" method="POST">
Bet <input type="number" min="5" step="5" onkeydown="return false" name="bet" value="5" style="caret-color:transparent;width:64px;text-align:center;font-weight:bold;"/>Gold
<br /><input type="submit" name="<?php echo $pid;?>" value="Fight">
</form>
<!--
<form method="POST">
<input type="number" name="name[]" value1="value1" />
<input type="number" name="name[]" value1="value2" />
<input type="submit" name="butom" value="Fight">
</form>
-->
<?php include("footer.php");?>