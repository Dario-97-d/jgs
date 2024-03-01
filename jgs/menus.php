<?php
if(isset($_SESSION['uid'])){
	$udata=sql_mfa($conn, "SELECT u.*,a.*,b.*,v.*,d.* FROM users u JOIN useratts a ON u.id=a.id JOIN userbatts b ON b.id=a.id JOIN userlevel v ON u.id=v.id JOIN userludus d ON u.id=d.id WHERE u.id='".$_SESSION['uid']."'");
	$sumbatt=$udata['speed']+$udata['power']+$udata['attack']+$udata['defense']+$udata['skill'];
	if(isset($_GET['t'])){include("train.php");}
	$mail=sql_query($conn,"SELECT pmid FROM mailbox WHERE pmto='".$udata['username']."' AND seen=0");?>
	<div id="container">
		<div class="menu" style="float:left">
			<a href="main?c=g">✧ GERAL ✧</a>
			<br /><br />
			<a href="main?c=l">✧ LUDUS ✧</a>
			<br /><br />
			<a href="main?c=f">✧ Feedback ✧</a>
		</div>
		<div class="menu" style="float:right">
			<a href="mail"<?php echo(mysqli_num_rows($mail)>0?'style="text-decoration:underline"':'');?>>
			<b>MAIL</b></a>
			<br /><br />
			<b>Sessions:</b> <?php echo $udata['sessions']?>
			<br /><br />
			<b><a href="logout">Logout</a></b>
		</div>
<?php
}?>