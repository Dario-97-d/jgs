<?php include("header.php");
if(isset($_SESSION['uid'])){exiter("geral");}
if(isset($_POST['register'])){
	$username=handle_name($_POST['username']);
	$password=md5($_POST['password']);
	$email=handle_email($_POST['email']);
	if(strlen($username)>16){output("$username");}
	elseif(strlen($email)>48){output("$email");}
	elseif(strlen($password)>32||strlen($password)<8){output("Password must be 8-32 characters long.");}
	else{
		$strings=[$username,$password];
		$checkun=sql_query($conn,"SELECT id FROM users WHERE username='$username'");
		if(mysqli_num_rows($checkun)>0){output("This username is already in use");}
		else{
			$ins1=sql_query($conn,"INSERT INTO users (username,password,email,active,chartext,feedback) VALUES ('$username','".md5($password)."','$email',0,'Character Text','- Feedback -')");
			$ins2=sql_query($conn,"INSERT INTO batts (speed,power,flair,sense,skill,sst) VALUES (1,1,1,1,1,5)");
			$ins3=sql_query($conn,"INSERT INTO ludus (rank,battles,wins) VALUES (0,0,0)");
			$ins4=sql_query($conn,"INSERT INTO userlevel (lv,exp,value,sessions) VALUES (1,0,0,50)");
			exiter("geral");
		}
	}
}
// password: urraurra
?>
<h1>Register</h1>
<center>
	<form method="POST">
		<div class="formkeywords">Username:</div>
			<input type="text" name="username"/>
		<div class="formkeywords">Password:</div>
			<input type="password" name="password"/>
		<div class="formkeywords">E-mail:</div>
			<input type="email" name="email"/>
		<br /><br /><input type="submit" name="register" value="Register"/>
	</form>
</center>
<?php include("footer.php");?>