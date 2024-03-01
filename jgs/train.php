<?php include("header.php");
extract(sql_mfa($conn,"SELECT username,chartext,a.*,b.*,v.*,d.* FROM users u JOIN useratts a ON u.id=a.id JOIN userbatts b ON b.id=a.id JOIN userlevel v ON u.id=v.id JOIN userludus d ON u.id=d.id WHERE u.id='".$_SESSION['uid']."'"));
$sumatt = floor($agi+$str+$att+$def+$dex/5);
if(isset($_GET['t'])){$t=$_GET['t'];}?>
<h1>Char upgrades</h1>
<br />
<table id="table-batts" cellpadding="4" border="1" style="text-align: center"><tr><th width="52px">Speed</th><th width="52px">Power</th><th width="52px">Flair</th><th width="52px">Sense</th><th width="52px">Skill</th></tr><tr><td><?php echo $speed;?></td><td><?php echo $power;?></td><td><?php echo $flair;?></td><td><?php echo $sense;?></td><td><?php echo $skill;?></td></tr></table>
<br />
<table cellspacing="4">
	<tr>
		<th>Agility</th><td><?php echo $agi;?></td>
		<td><div class="barprogt"><div class="bartrain" style="width:<?php echo $agi;?>px;"></div></div></td>
		<td>100</td><td><a href="geral?t=agi">Train</a></td>
	</tr>
	<tr>
		<th>Strength</th><td><?php echo $str;?></td>
		<td><div class="barprogt"><div class="bartrain" style="width:<?php echo $str;?>px;"></div></div></td>
		<td>100</td><td><a href="geral?t=str">Train</a></td>
	</tr>
	<tr>
		<th>Attack</th><td><?php echo $att;?></td>
		<td><div class="barprogt"><div class="bartrain" style="width:<?php echo $att;?>px;"></div></div></td>
		<td>100</td><td><a href="geral?t=att">Train</a></td>
	</tr>
	<tr>
		<th>Defense</th><td><?php echo $def;?></td>
		<td><div class="barprogt"><div class="bartrain" style="width:<?php echo $def;?>px;"></div></div></td>
		<td>100</td><td><a href="geral?t=def">Train</a></td>
	</tr>
	<tr>
		<th>Dexterity</th><td><?php echo $dex;?></td>
		<td><div class="barprogt"><div class="bartrain" style="width:<?php echo $dex;?>px;"></div></div></td>
		<td>100</td><td><a href="geral?t=dex">Train</a></td>
	</tr>
</table>
Cost: <?php echo $lv;?> sessions