<?php include("header.php");extract(sql_mfa($conn,"SELECT * FROM batts WHERE id=".$_SESSION['uid']));?>
<h1>Ludus</h1>
<h2>Oenomathopaeus</h2>
<h4>
	Training shapes a gladiator.
	Without training, a slave is just a slave.
	<br />
	Besides, a slave must learn to use a sword before he's allowed to gladiate.
	He'd be worthless if he accidentally cut one of his arms off.
</h4>
<p>You can train: <?php echo $ludus;?> times</p>
<table id="table-batts" cellpadding="4" border="0" style="border-collapse:collapse;">
	<tr>
		<th width="32px">#</th><th width="128px">Gajo</th>
		<th width="32px">S</th><th width="32px">P</th><th width="32px">S</th><th width="32px">F</th><th width="32px">S</th><th width="32px">Train</th>
	</tr>
	<?php
	$users=sql_query($conn,"SELECT username,b.*,l.* FROM users u JOIN batts b ON u.id=b.id JOIN ludus l ON u.id=l.id ORDER BY rank LIMIT 50");
	while($row=mysqli_fetch_assoc($users)){
		if($row['id']==$_SESSION['uid']){$outline=' style="outline:thin solid;background:rgba(255,255,255,0.25);"';}else{$outline='';}
		echo '<tr'.$outline.'><th>'.$row['rank'].'</td><td><a href="player?id='.$row['id'].'">'.$row['username']."</a></td>
		<th>".$row['speed']."</th><th>".$row['power']."</th><th>".$row['skill']."</th><th>".$row['flair']."</th><th>".$row['sense'].'</th><th>'.($row['id']==$_SESSION['uid']?'---':'<a href="ludus-go?id='.$row['id'].'">Go</a>').'</th></tr>';
	}?>
</table>
<?php include("footer.php");sql_query($conn,"UPDATE batts SET ludus=5");?>