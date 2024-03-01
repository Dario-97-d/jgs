<?php include("header.php");?>
<h1>Arena</h1>
<h4>
	Every day, the arena comes alive.
	<br />
	The thirst for blood brings a divine aura from the audience.
	<br />
	Flesh will be served to the gods today.
	<br />
	Whose life is this?
</h4>
<h3>Ranking por ouro</h3>
<table id="table-ranks" cellpadding="4">
	<tr><th>#</th><th style="width:128px;">Gladiator</th><th>V</th></tr>
	<?php $r=1;
	$glads=sql_query($conn,"SELECT u.id,username,value FROM users u JOIN ludus l WHERE u.id=l.id ORDER BY value DESC, u.id LIMIT 50");
	while($row=mysqli_fetch_assoc($glads)){
		echo '<tr><td>'.$r.'</td><td><a href="arena-pre?id='.$row['id'].'">'.$row['username'].'</a></td><td>'.$row['value'].'</td></tr>';$r++;
	}
	?>
</table>
<?php include("footer.php");?>