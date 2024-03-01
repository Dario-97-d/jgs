<?php include("header.php");
extract(sql_mfa($conn,"SELECT chartext,b.*,d.* FROM users u JOIN batts b ON u.id=b.id JOIN ludus d ON u.id=d.id WHERE u.id=".$_SESSION['uid']));
if(isset($_GET['train'])&&$sessions>4){if(in_array($_GET['train'],array('speed','power','flair','sense'))){sql_query($conn,"UPDATE batts SET ".$_GET['train']."=".($$_GET['train']+=1).",sessions=".($sessions-=5)." WHERE id=".$_SESSION['uid']);}elseif($_GET['train']=='skill'){$skill-=1;}}
$lv=1;$exp=0;?>
<h1><?php echo $username;?></h1>
<!--<h4>
	Training shapes a gladiator.
	Without training, a slave is just a slave.
	Besides, a slave must learn to use a sword before he's allowed to gladiate.
	He'd be worthless if he accidentally cut one of his arms off.
	Everyone trains with the same kind of sword - a wooden one.
</h4>-->
<table id="table-stats" cellpadding="4" cellspacing="4"><tr><th>Lv (xp)</th><th>Rank</th><th>Wins/Battles</th></tr><tr><th><?php echo $lv." ($exp)";?></th><th><?php echo "# ".$rank;?></th><th><?php echo $wins." / ".$battles;?></th></tr></table>
<h2>Train</h2>
<table id="table-batts" cellpadding="4" border="1" style="text-align: center"><tr><th width="52px">Speed</th><th width="52px">Power</th><th width="52px">Skill</th><th width="52px">Flair</th><th width="52px">Sense</th></tr><tr><td><?php echo $speed;?></td><td><?php echo $power;?></td><td><?php echo $skill;?></td><td><?php echo $flair;?></td><td><?php echo $sense;?></td></tr>
	<tr>
		<td><a href="geral?train=speed"><div id="tb-td">+</div></a></td>
		<td><a href="geral?train=power"><div id="tb-td">+</div></a></td>
		<td>--</td>
		<td><a href="geral?train=flair"><div id="tb-td">+</div></a></td>
		<td><a href="geral?train=sense"><div id="tb-td">+</div></a></td>
	</tr>
</table>
<br />Upgrade: 5 sessions
<hr style="width:320px;" color="gray">
<br />
<form method="POST">
	<?php
	if(isset($_POST['chartext'])){
		if(!ctype_space($_POST['chartext'])){
			$updct=mysqli_prepare($conn,"UPDATE users SET chartext=? WHERE id=".$_SESSION['uid']."") or die(mysqli_error($conn));
			mysqli_stmt_bind_param($updct,"s",$_POST['chartext']);
			mysqli_stmt_execute($updct);
			mysqli_stmt_close($updct);
			$chartext=$_POST['chartext'];
		}
	}
	echo '
		<textarea name="chartext">'.$chartext.'</textarea>
		<br />
		<input type="submit" value="Update"/>
	';
	?>
</form>
<?php include("footer.php");?>