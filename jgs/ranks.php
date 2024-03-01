<?php include("header.php");$row_lv=1;?>
<h1>Ranking</h1>
<form action="arena-search" method="GET">
	<input type="text" name="gladiator"/>
	<br />
	<input type="submit" value="Find Gladiator">
</form>
<table id="table-batts" cellpadding="4" border="1" style="text-align: center">
	<tr><th width="32px">#</th><th width="128px">Gajo</th><th width="64px">Lanista</th><th width="64px">Value</th>
	<?php
	$get_users=sql_query($conn,"SELECT username,l.* FROM users u JOIN ludus l ON u.id=l.id WHERE rank>0 ORDER BY rank LIMIT 50");
	while($row=mysqli_fetch_assoc($get_users)){
		echo '<tr><td>'.$row['rank'].'</td>
		<td><a href="player?id='.$row['id'].'">'.$row['username'].'</a></td>
		<td></td>
		<td>'.$row['value'].'</td></tr>';
	}?>
</table>
<?php include("footer.php")?>