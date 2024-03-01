<?php include("header.php");
if(!isset($_SESSION['uid'])){exiter("index");}?>
<h1>Send PM</h1>
<?php
if(isset($_GET['to'])){
	$upmto=$_GET['to'];
	//look for the person who's set to receive the message
}
if(isset($_POST['sendpm'])){
	$getupmto = sql_query($conn, "SELECT username FROM users WHERE username='".$upmto."'");
	if(mysqli_num_rows($getupmto)!=1){output("User not found!");}
	else{
		$pmtext=$_POST['pmtext'];
		if($pmtext==""){output("Null message!");}
		elseif(strlen($pmtext)>800){output("Message is too long! Max: 800 chrs.");}
		else{
			$pmsend = sql_query($conn, "INSERT INTO mailbox (time,pmfrom,pmto,pmtext,seen) VALUES (".time().",'".$udata['username']."',$upmto,$pmtext,0)");
			output("PM sent!");
		}
	}
}elseif(isset($_POST['pmto'])){
	$getupmto=sql_query($conn, "SELECT username FROM users WHERE username=$upmto");
	if(mysqli_num_rows($getupmto)!=1){output("User not found!");}
}?>
<form method="POST">
	<input type="text" name="pmto"<?php echo 'value="'.(isset($_GET['to'])?$upmto:'PM to').'"';?>/>
	<br /><br />
	<textarea name="pmtext" maxlength="800"></textarea>
	<input type="submit" class="button1" name="sendpm" value="Send"/>
</form>
<?php include("footer.php");?>