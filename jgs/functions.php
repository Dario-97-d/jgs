<?php
$conn = mysqli_connect('localhost', 'root', 'uchihasasukeitachi97D', 'jgs');

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

function exiter($to){exit(header("Location: $to"));}

function sql_query($conn,$query){$result=mysqli_query($conn,$query) or die(mysqli_error($conn));return $result;}
function sql_mfa($conn,$query){$result=mysqli_fetch_assoc(mysqli_query($conn,$query)) or die(mysqli_error($conn));return $result;}

function handle_name($name){
	$name=trim($name);
	$sln=strlen($name);
	// check length, safe chars, min 4 letters
	if($sln<4||$sln>16){$name="Name must be 4-16 chars long";}
	elseif(!ctype_alnum(str_replace(array('_','-',' '),'',$name))){$name="Characters allowed include only numbers, letters, underscore, hyphen and space";}
	elseif(strlen(str_replace(array('_','-',' ','0','1','2','3','4','5','6','7','8','9'),'',$name))<4){$name="Name must contain minimum 4 letters";}
	return $name;
}
function handle_email($email){
	$email=trim($email);
	$slem=strlen($email);
	if($slem<8||$slem>48){$email="E-mail expected to be min 12 et max 48 chars long";}
	elseif(!ctype_alnum(str_replace(array('_','-','.','@'),'',$email))){$email="E-mail expected to include only numbers, letters, underscore, hyphen, dot and @";}
	return $email;
}

function output($string) {
    echo '<div id="output">' . $string . "</div>";
}
?>