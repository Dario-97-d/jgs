<?php include("header.php");
$pid=(ctype_digit($_GET['id'])?$_GET['id']:'');
if($pid==''||$pid==$_SESSION['uid']){exiter("ludus");}
$check_player=sql_query($conn,"SELECT id FROM users WHERE id=".$pid);
if(mysqli_num_rows($check_player)!=1){exiter("ludus");}
extract(sql_mfa($conn,"SELECT username,rank,b.* FROM users u JOIN ludus l ON u.id=l.id JOIN batts b ON u.id=b.id WHERE b.id=".$_SESSION['uid']),EXTR_PREFIX_ALL,"u");
extract(sql_mfa($conn,"SELECT username,rank,b.* FROM users u JOIN ludus l ON u.id=l.id JOIN batts b ON u.id=b.id WHERE b.id=".$pid),EXTR_PREFIX_ALL,"p");
if($u_ludus==0){exiter("ludus");}
$u_ovr=$u_speed+$u_power+2*$u_skill+$u_flair+$u_sense;
$p_ovr=$p_speed+$p_power+2*$p_skill+$p_flair+$p_sense;
$batts=array('speed','power','skill','flair','sense');
if($u_ovr+11>$p_ovr&&$p_ovr+11>$u_ovr){$doctore='Very good effort!<br /><br />+1 Gold<br />+1 Skill<br />+5 sessions';$u_skill+=1;$sessions+=5;sql_query($conn,"UPDATE batts SET skill=skill+1,sessions=sessions+5,ludus=ludus-1,gold=gold+1 WHERE id=".$_SESSION['uid']);}
elseif($u_ovr+25>=$p_ovr&&$p_ovr+25>=$u_ovr){$doctore='Doctore likes your effort.<br /><br />+1 Gold<br />+1 Skill';$u_skill+=1;sql_query($conn,"UPDATE batts SET skill=skill+1,ludus=ludus-1,gold=gold+1 WHERE id=".$_SESSION['uid']);}
elseif($u_ovr>2*$p_ovr||$p_ovr>2*$u_ovr){$doctore='This was shit! Switch partner.<br /><br />+1 session';$sessions+=1;sql_query($conn,"UPDATE batts SET sessions=sessions+1,ludus=ludus-1 WHERE id=".$_SESSION['uid']);}
elseif($u_ovr>1.5*$p_ovr||$p_ovr>1.5*$u_ovr){$doctore='Doctore is not pleased. You need another partner.<br /><br />+5 sessions';$sessions+=5;sql_query($conn,"UPDATE batts SET sessions=sessions+5,ludus=ludus-1 WHERE id=".$_SESSION['uid']);}
else{$batt=$batts[substr(microtime(true),-1)%5];${'u_'.$batt}+=1;sql_query($conn,"UPDATE batts SET $batt=$batt+1,ludus=ludus-1 WHERE id=".$_SESSION['uid']);$doctore='Keep working.<br /><br />+1 '.ucfirst($batt);}
$ludus-=1;
if($u_ovr>=$p_ovr){if($u_rank>$p_rank){sql_query($conn,"UPDATE ludus SET rank=(CASE WHEN id=".$_SESSION['uid']." THEN $p_rank WHEN id=$pid THEN $u_rank END) WHERE id IN (".$_SESSION['uid'].",$pid)");}}else{if($u_rank<$p_rank){sql_query($conn,"UPDATE ludus SET rank=(CASE WHEN id=".$_SESSION['uid']." THEN $p_rank WHEN id=$pid THEN $u_rank END) WHERE id IN (".$_SESSION['uid'].",$pid)");}}
?>
<h1>Ludus</h1>
<table style="font-size:24px;margin:24px;"><tr><th style="width:128px;"><?php echo $u_username;?></th><th style="width:64px;">VS</th><th style="width:128px;"><?php echo $p_username;?></th></tr></table>
<table id="table-batts" cellpadding="4" border="1" style="text-align: center">
	<tr><td><?php echo $u_speed;?></td><td><?php echo $u_power;?></td><td><?php echo $u_skill;?></td><td><?php echo $u_flair;?></td><td><?php echo $u_sense;?></td></tr>
	<tr><th width="52px">Speed</th><th width="52px">Power</th><th width="52px">Skill</th><th width="52px">Flair</th><th width="52px">Sense</th></tr>
	<tr><td><?php echo $p_speed;?></td><td><?php echo $p_power;?></td><td><?php echo $p_skill;?></td><td><?php echo $p_flair;?></td><td><?php echo $p_sense;?></td></tr>
</table>
<h3>Doctore</h3>
<?php echo $doctore;?>
<h3><a href="ludus">Back to Ludus</a></h3>
<?php include("footer.php")?>