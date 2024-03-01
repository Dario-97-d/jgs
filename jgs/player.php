<?php include("header.php");
$pid=$_GET['id'];
if(!ctype_digit($pid)){exiter("ludus");}
$checkplayer=sql_query($conn,"SELECT username,chartext,b.*,l.* FROM users u JOIN batts b ON u.id=b.id JOIN ludus l ON u.id=l.id WHERE u.id='".$pid."'") or die(mysqli_error($conn));
if(mysqli_num_rows($checkplayer)!=1){exiter("ludus");}
extract(mysqli_fetch_assoc($checkplayer),EXTR_PREFIX_ALL,"p");
$p_lv=1;$p_exp=0;?>
<h1><?php echo $p_username;?></h1>
<table id="table-stats" cellpadding="4" cellspacing="4"><tr><th>Lv (xp)</th><th>Rank</th><th>Wins/Battles</th></tr><tr><th><?php echo $p_lv." ($p_exp)";?></th><th><?php echo "# ".$p_rank;?></th><th><?php echo $p_wins." / ".$p_battles;?></th></tr></table>
<div style="margin:16px;padding:16px;">
	<table id="table-batts" cellpadding="4" border="1" style="text-align:center">
		<tr><th style="background:rgba(127,127,127,0.5);"></th><th style="">Helmet</th><th style="background:rgba(127,127,127,0.5);"></th></tr>
		<tr><th>Arm-band</th><th rowspan="3" style="">Armor</th><th>Arm-band</th></tr>
		<tr><th rowspan="2">Sword<br />or<br />Shield</th><th rowspan="2">Sword<br />or<br />Shield</th></tr>
		<tr></tr>
		<tr><th>Leg-band</th><th style="background:rgba(127,127,127,0.5);"></th><th>Leg-band</th></tr>
	</table>
</div>
<table id="table-batts" cellpadding="4" border="1" style="text-align: center">
	<tr><th width="52px">Speed</th><th width="52px">Power</th><th width="52px">Skill</th><th width="52px">Flair</th><th width="52px">Sense</th></tr>
	<tr><td><?php echo $p_speed;?></td><td><?php echo $p_power;?></td><td><?php echo $p_skill;?></td><td><?php echo $p_flair;?></td><td><?php echo $p_sense;?></td></tr>
</table>
<table cellspacing="4" cellpadding="4" style="margin:16px;">
	<tr><td colspan="1" class="linkbutton"><a href="mp.php?to=<?php echo $p_username?>">Send PM</a></td></tr>
	<tr><td colspan="1" class="linkbutton"><a href="ludus-go?id=<?php echo $pid?>">Ludus</a></td></tr>
	<tr><td colspan="1" class="linkbutton"><a href="arena-pre?id=<?php echo $pid?>">Arena</a></td></tr>
</table>
<hr style="width:320px;" color="gray">
<div style="padding:16px">
<?php
echo '<div id="textbody">'.nl2br($p_chartext).'</div></div>';
include("footer.php");?>