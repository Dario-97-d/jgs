<?php include("header.php");
$pid = $_GET['id'];
if(!isset($_SESSION['uid']) OR $pid<1 OR !ctype_digit($pid) /*OR $pid==$_SESSION['uid']*/ OR $udata['sessions']<5){exiter("ludus"));}
else{
	extract($pdata=sql_mfa($conn, "SELECT username,b.* FROM users u JOIN userbatts b ON b.id=u.id WHERE u.id=$uid"),EXTR_PREFIX_ALL,'u');
	extract($pdata=sql_mfa($conn, "SELECT username,b.* FROM users u JOIN userbatts b ON b.id=u.id WHERE u.id=$pid"),EXTR_PREFIX_ALL,'p');
	/*
	$uattacks=round(100*($udata['speed']+$udata['attack'])/($pdata['speed']+$pdata['defense']));
	$pattacks=round(100*($pdata['speed']+$pdata['attack'])/($pdata['skill']+$pdata['defense']));
	$uhits=round(sqrt($uattacks*$udata['speed']/($udata['speed']+$pdata['speed'])));
	$phits=round(sqrt($pattacks*$pdata['speed']/($udata['speed']+$pdata['speed'])));
	*/
	$uattacks=round(100*$u_speed/$p_speed);$pattacks=round(100*$p_speed/$u_speed);
	$uhits=$uattacks*$u_flair/($p_sense);$phits=$pattacks*$p_flair/($u_sense);
	$ubpoints=$uattacks+$uhits**2;$pbpoints=$pattacks+$phits**2;?>
	<h1>Ludus Combat</h1>
	<table>
		<tr><th><?php echo $u_username:?></th><th>VS</th><th><?php echo $p_username;?></th></tr>
		<tr><th><?php echo $udata['speed']?></th><th>Speed</th><th><?php echo $pdata['speed']?></th></tr>
		<tr><th><?php echo $udata['power']?></th><th>Power</th><th><?php echo $pdata['power']?></th></tr>
		<tr><th><?php echo $udata['flair']?></th><th>Flair</th><th><?php echo $pdata['flair']?></th></tr>
		<tr><th><?php echo $udata['sense']?></th><th>Sense</th><th><?php echo $pdata['sense']?></th></tr>
		<tr><th><?php echo $udata['skill']?></th><th>Skill</th><th><?php echo $pdata['skill']?></th></tr>
		<tr><th colspan="3">Battle Stats</th></tr>
		<tr><th><?php echo $uattacks?></th><th>Attacks</th><th><?php echo $pattacks?></th></tr>
		<tr><th><?php echo $uhits?></th><th>Hits</th><th><?php echo $phits?></th></tr>
		<tr><th><?php echo $ubpoints?></th><th>Battle Points</th><th><?php echo $pbpoints?></th></tr>
	</table>
	<?php
	$uname='Kuzum';
	$pname='Dozuk';
	$uvida=100;
	$pvida=100;
	$ustam=100;
	$pstam=100;
	while(min($uvida,$pvida)>0){
		$uvelos=$u_speed*$ustam/100;
		$pvelos=$p_speed*$pstam/100;
		$udano=$u_power*$ustam/100;
		$pdano=$p_power*$pstam/100;
		$uthreat=$u_flair*$ustam/100;
		$pthreat=$p_flair*$pstam/100;
		$ucomp=($u_speed+$u_power)*$ustam/100;
		$pcomp=($p_speed+$p_power)*$pstam/100;
		// define G1 and G2
		($uthreat>=$pthreat?($G1='$u'&&$G2='$p'):($G1='$p'&&$G2='$u'));
		// replace G1 and G2
		while(G1comp>0){
			// G1 ataca
			echo G1name.' attacks!<br />';
			if(G1comp>(2*G2comp)){
				// G1 crit
				echo '*Critical hit*<br />';
				if(G2comp>0){
					G1crit=(((G1comp-G2comp)/G2comp)-1)*50;
					echo G1name.' scores '.G1crit.' points<br />';
					if(G1crit>50){
						// G1 wins, break all
						echo G1name.' wins!';
						break 2;
					}
					G2vida-=G1crit;
					G1stam-=1;
				}else{
					//G1 wins, break all
					echo G1name.' wins!';
					break 2;
				}
			}elseif(G1comp>G2comp){
				// ataque forte
				G2comp-=G1velos;
				G2stam-=G1dano;
				G1comp-=1;
				G1stam-=1;
				echo G1name.' +'.G1dano.' points';
				if(G2stam<1){
					//G1 wins, break all
					echo G1name.' wins!';
					break 2;
				}
			}elseif(G2comp>(2*G1comp)){
				// G2 crit
				echo '*Critical hit*<br />';
				if(G1comp>0){
					G2crit= (((G2comp - G1comp) / G1comp) -1) *50;
					echo G2name.' scores '.G2crit.' points<br />';
					if(G2crit>50){
						// G2 wins, break all
						echo G2name.' wins!';
						break 2;
					}
					G1vida-=G2crit;
					G2stam-=1;
				}else{
					//G2 wins, break all
					echo G2name.' wins!';
					break 2;
				}
			}elseif(G2comp>G1comp){
				// ataque forte
				G1comp-=G2velos;
				G1stam-=G2dano;
				G2comp-=1;
				G2stam-=1;
				echo G2name.' +'.G2dano.' points';
				if(G1stam<1){
					//G2 wins, break all
					echo G2name.' wins!';
					break 2;
				}
			}/*else{
				// comp==, ataque sem efeito, ambos perdem 1 stam
				G1stam-=1;
				G2stam-=1;
				G1comp-=1;
				G2comp-=1;
			}*/
		}
	}
	/*$ucomp=$udata['speed']+$udata['power'];
	$pcomp=$pdata['speed']+$pdata['power'];
	$udano=$udata['power']-$pdata['power'];
	$pdano=$pdata['power']-$udata['power'];
	while($ucomp>=$pcomp){
		echo '<br />'.$udata['username'].' attacks';
		$pvigor-=$udano;
		$pcomp-=($ucomp-$pcomp);
		$uvigor-=1;
		$ucomp-=1;
		if($pvigor<1){
			echo $pdata['username']." can't keep up anymore<br />".$udata['username']." wins";
			break 1;
		}
		if($ucomp>=2*$pcomp){
			$uvigor-=1;
			$pvigor-=1;
			if($pcomp<1){
				echo '<br />'.$pdata['username'].' is too slow to react and stands ridiculously exposed!
				<br />*'.$udata['username'].' hits his oponent\'s face with the stick*
				<br />\"In your face\" - he shouts //20190613
				<br />'.$udata['username'].' wins';
				break 1;
			}else{
				$ucrit=floor((($ucomp/$pcomp)-2)*50);
				$pvida-=$ucrit;
				echo '<br />'.$udata['username'].'Gets '.$ucrit.' points!<br />';
				if($pvida<1){
					echo $udata['username'].' won this combat.';
					break 1;
				}
			}
		}else{
			echo '<br />| Blocked |';
		}
	}
	$ucomp+=1;
	while($pcomp>=$ucomp){
		echo '<br />'.$pdata['username'].' attacks';
		$uvigor-=$udano;
		$ucomp-=($pcomp-$ucomp);
		$pvigor-=1;
		$pcomp-=1;
		if($uvigor<1){
			echo $udata['username']." can't keep up anymore<br />".$pdata['username']." wins";
			break 1;
		}
		if($pcomp>=2*$ucomp){
			$uvigor-=1;
			$pvigor-=1;
			if($ucomp<1){
				echo '<br />'.$udata['username'].' is too slow to react and stands ridiculously exposed!
				<br />*'.$pdata['username'].' hits his oponent\'s face with the wooden sword*
				<br />'.$pdata['username'].' wins';
				break 1;
			}else{
				$pcrit=floor((($pcomp/$ucomp)-2)*50);
				$uvida-=$pcrit;
				echo '<br />He gets '.$pcrit.' points!<br />';
				if($uvida<1){
					echo $pdata['username'].' won this combat.';
					break 1;
				}
			}
		}else{
			echo '<br />| Blocked |';
		}
	}
	$pcomp+=1;
	echo '<br />The slaves stand back for a while';
	$ucomp=round(($udata['speed']+$udata['power'])*$uvigor/100);
	$pcomp=round(($pdata['speed']+$pdata['power'])*$pvigor/100);*/
}
include("footer.php");?>