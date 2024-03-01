<?php include("header.php");
if(!isset($_POST['bet'])||!ctype_digit($bet=$_POST['bet'])||!$bet>0||$bet%5!=0||!in_array('Fight',$_POST)||!is_int($pid=array_search('Fight',$_POST))||$pid==$_SESSION['uid']){exiter("arena");}
extract(sql_mfa($conn,"SELECT username,b.* FROM users u JOIN batts b ON u.id=b.id WHERE b.id=".$_SESSION['uid']),EXTR_PREFIX_ALL,"u");
extract(sql_mfa($conn,"SELECT username,b.* FROM users u JOIN batts b ON u.id=b.id WHERE b.id=".$pid),EXTR_PREFIX_ALL,"p");
?>
<h1>Arena</h1>
<table style="margin:24px 0;text-align:center;">
	<tr style="font-size:24px;"><th colspan="5" style="width:128px;"><?php echo $u_username;?></th><th rowspan="3" style="width:64px;">VS</th><th colspan="5" style="width:128px;"><?php echo $p_username;?></th></tr>
	<tr><td>Speed</td><td>Power</td><td>Skill</td><td>Flair</td><td>Sense</td><td>Speed</td><td>Power</td><td>Skill</td><td>Flair</td><td>Sense</td></tr>
	<tr>
		<th><?php echo $u_speed;?></th><th><?php echo $u_power;?></th><th><?php echo $u_skill;?></th><th><?php echo $u_flair;?></th><th><?php echo $u_sense;?></th>
		<th><?php echo $p_speed;?></th><th><?php echo $p_power;?></th><th><?php echo $p_skill;?></th><th><?php echo $p_flair;?></th><th><?php echo $p_sense;?></th>
	</tr>
	<tr><td colspan="5">Standard</td><th>Style</th><td colspan="5">Standard</td></tr>
	<tr>
		<td colspan="5">
			<table id="table-batts" cellpadding="4" border="1" style="text-align:center">
				<tr><th style="background:rgba(127,127,127,0.5);"></th><th style="">Helmet</th><th style="background:rgba(127,127,127,0.5);"></th></tr>
				<tr><th>Arm-band</th><th rowspan="3" style="">Armor</th><th>Arm-band</th></tr>
				<tr><th rowspan="2">Sword<br />or<br />Shield</th><th rowspan="2">Sword<br />or<br />Shield</th></tr>
				<tr></tr>
				<tr><th>Leg-band</th><th style="background:rgba(127,127,127,0.5);"></th><th>Leg-band</th></tr>
			</table>
		</td>
		<th>ARMAS</th>
		<td colspan="5">
			<table id="table-batts" cellpadding="4" border="1" style="text-align:center">
				<tr><th style="background:rgba(127,127,127,0.5);"></th><th style="">Helmet</th><th style="background:rgba(127,127,127,0.5);"></th></tr>
				<tr><th>Arm-band</th><th rowspan="3" style="">Armor</th><th>Arm-band</th></tr>
				<tr><th rowspan="2">Sword<br />or<br />Shield</th><th rowspan="2">Sword<br />or<br />Shield</th></tr>
				<tr></tr>
				<tr><th>Leg-band</th><th style="background:rgba(127,127,127,0.5);"></th><th>Leg-band</th></tr>
			</table>
		</td>
	</tr>
</table>
<h3>For <?php echo $bet;?> Gold</h3>
<table style="text-align:center;">
<tr><th>Stamina</th><th>Comp</th><th>Will</th><th></th><th>Will</th><th>Comp</th><th>Stamina</th></tr>
<?php
$u_stamina=100;$p_stamina=100;
$u_tries=$p_tries=0;
$will='u';
$editor=50;
$e=1;
$u_comp=$p_comp=0;
for($r=1;$u_stamina>0&&$p_stamina>0;$r++){
	$u_comp=($u_stamina*($u_speed+$u_sense));
	$p_comp=($p_stamina*($p_speed+$p_sense));
	$u_will=(($u_stamina-5*$u_tries)*($u_flair+$p_sense));
	$p_will=(($p_stamina-5*$p_tries)*($p_flair+$u_sense));
	if($u_will>=$p_will){$nu_will=$G1='u';$G2='p';}else{$nu_will=$G1='p';$G2='u';}
	if($nu_will==$will){$editor-=5;}$will=$nu_will;
	echo '<tr><th colspan="7" style="padding:8px;">Round '."$r</th></tr>";
	echo "<tr><td>$u_stamina</td><td>$u_comp</td><td>$u_will</td><th>".${$G1.'_username'}." attacks!</th><td>$p_will</td><td>$p_comp</td><td>$p_stamina</td></tr>";
	${$G1.'_tries'}+=1;
	if(${$G1.'_comp'}>=${$G2.'_comp'}){echo "<tr><td>$u_stamina</td><td>$u_comp</td><td>$u_will</td><th>".${$G2.'_username'}." blocks 1x.</th><td>$p_will</td><td>$p_comp</td><td>$p_stamina</td></tr>";}
	for($t=2;${$G1.'_comp'}>0&&${$G2.'_comp'}>0&&${$G1.'_comp'}>=${$G2.'_comp'};$t++){
		${$G1.'_stamina'}-=1;
		${$G1.'_comp'}-=(${$G2.'_speed'}+${$G2.'_sense'}+100)*$t;
		${$G2.'_comp'}-=(${$G1.'_speed'}+${$G1.'_sense'}+100);
		if(${$G2.'_comp'}<100){
			echo '<tr><th>Critical!</th></tr>';
			if($critical=100-${$G2.'_comp'}>50){
				break 2;
			}
			${$G2.'_stamina'}-=$critical;
		}else{
			${$G2.'_stamina'}=max(${$G2.'_stamina'}-${$G1.'_power'},0);
			echo "<tr><td>$u_stamina</td><td>$u_comp</td><td>$u_will</td><th>blocks $t x</th><td>$p_will</td><td>$p_comp</td><td>$p_stamina</td></tr>";
		}
		$editor++;
		if(${$G2.'_stamina'}<=0){
			echo '<tr><th colspan="7" style="padding:8px;">'.${$G2.'_username'}." can't fight anymore<br />".${$G1.'_username'}." wins!<br />Editor: $editor</th></tr>";
			break 2;
		}
	}
	echo "<tr><td>".($u_stamina-=1).'</td><th colspan="5">'.${$G2.'_username'}." evades...</th><td>".($p_stamina-=1)."</td></tr>";
	if($editor<=25){
		echo '<tr><th colspan="7" style="padding:8px;">'."The people don't like this battle.<br />The editor incites both gladiators to fight viciously</th></tr>";
		$u_flair*=2;$p_flair*=2;
	}
	//echo '<tr><th colspan="7" style="padding:8px;">The gladiators circle around each other</th></tr>';
	elseif($editor<=0){echo '<tr><th colspan="7" style="padding:8px;">The editor has canceled the fight.<br />The people are booing the gladiators.</th></tr>';break;}
}
?>
</table>
<?php
if($editor<=0){echo "Shitty battle! You ain't getting your gold back.";}
elseif($editor<=25){echo "Poor battle";}
elseif($editor<=50){echo "Poor battle";}
elseif($editor<=100){echo "Good battle";}
else{echo "The gods blah blah";}
include("footer.php");?>