<?php include("header.php");
if(isset($_POST['login'])){
	if(isset($_SESSION['uid'])){exiter("geral");}
	else{
		$username=handle_name($_POST['username']);
		$cun=sql_query($conn,"SELECT id FROM users WHERE username='$username' AND password='".md5($_POST['password'])."'");
		if(mysqli_num_rows($cun)!=1){output("Invalid Username-Password Combination!");}
		else{
			$id=mysqli_fetch_array($cun);
			$_SESSION['uid']=$id[0];
			exiter("geral");
		}
	}
}
if(isset($_SESSION['uid'])){
	extract(sql_mfa($conn,"SELECT feedback FROM users WHERE id=".$_SESSION['uid']));
	$fdbk=$feedback;
	if(isset($_POST['fdb'])){
		$fdb=prot($conn,$_POST['fdb']);
		if(strlen($fdb)>4000){output("Text is too long. Max: 4000 characters");}
		else{
			$updfdb=sql_query($conn, "UPDATE users SET feedback='$fdb' WHERE id=".$_SESSION['uid']."");
			output("Feedback has been updated");
			$fdbk=$fdb;
		}
	}
	?>
	<h1>Feedback</h1>
	<form method="POST">
		<textarea name="feedback" maxlength="4000"><?php echo $fdbk;?></textarea>
		<input type="submit" name="fdb" value="Update"/>
	</form>
	<?php
}else{
	?>
	<h1>Login</h1>
	<center>
	<form method="POST">
		<div class="formkeywords">Username:</div>
		<input type="text" name="username"/>
		<div class="formkeywords">Password:</div>
		<input type="password" name="password"/>
		<br /><input type="submit" name="login" value="Login"/>
	</form>
	<h4><a href="register">Register</a><h4>
	</center>
	<?php
}
?>
<hr color="#999">
<center><h2>INFO</h2></center>
<br />Rapidez [Agilidade, Espada(s), Escudo, Armadura]
<br />Dano [Força, Destreza, Espada]
<br />Bloqueio [Força, Destreza, Espada, Escudo]
<br />Defesa [Armadura]
<br />Resistência [Força]
<br />
<br />Espada + Escudo (3 % Bloqueio, 3 F Bloqueio, 1 Velocidade, 1 Crítico)
<br />2 Espadas (2 % Bloqueio, 1 F Bloqueio, 2 Velocidade, 2 Crítico)
<br />1 Espada (1 % Bloqueio, 2 F Bloqueio, 3 Velocidade, 3 Crítico)
<br />
<br />Vigor (+ Resistência)
<br />Energia (+ Ataque, + Rapidez)
<br />Agilidade (+ Rapidez)
<br />Força (+ Dano, + Rapidez)
<br />Destreza (+ Bloqueio, + Dano)
<?php include("footer.php")?>