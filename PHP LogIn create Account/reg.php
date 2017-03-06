<?php
	session_start();

	if(isset($_POST['email'])){
		//good valid
		$all_ok=true;
		
		//check nik
		$nick=$_POST['nick'];
		
		//check length nick
		if((strlen($nick)<3) || (strlen($nick)>20)){
			$all_ok=false;
			$_SESSION['e_nick']="Nick must have 3 to 20 letters";
		}

		if(ctype_alnum($nick)==false){
			$all_ok=false;
			$_SESSION['e_nick']="Only letters or numbers";

		}
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		//check email
		$email=$_POST['email'];
		$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);

		if(filter_var($emailB, FILTER_VALIDATE_EMAIL)==false || ($emailB!=$email)){
			$all_ok=false;
			$_SESSION['e_email']="Verify Email Address";
		}

		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		//check passwords
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];

		if((strlen($password1)<8) || (strlen($password1)>20)){
			$all_ok=false;
			$_SESSION['e_password']="Password must have from 8 to 20 letters";
		}
		if($password1!=$password2){
			$all_ok=false;
			$_SESSION['e_password']="Passwords must match";
		}

		$passwords_hash=password_hash($password1, PASSWORD_DEFAULT);
		
		
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		//checkbox
		if(!isset($_POST['reg'])){
			$all_ok=false;
			$_SESSION['e_reg']="Check Terms and Conditions";
		}

		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		//reCaptcha
		$secret_key="6LdYIRYUAAAAACnB1KMOLdUjbep_6A48EU8VBXOe";

		$check=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

		$odp= json_decode($check);

		if($odp->success==false){
			$all_ok=false;
			$_SESSION['e_bot']="Check reCaptcha";
		}
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		//memorize input
		$_SESSION['fr_nick']=$nick;
		$_SESSION['fr_email']=$email;
		$_SESSION['fr_password1']=$password1;
		$_SESSION['fr_password2']=$password2;
		if(isset($_POST['reg']))$_SESSION['fr_reg']=true;


		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

		try {
			$connection = new mysqli(
				$host,
				$db_user,
				$db_password,
				$db_name);
			if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
				}else{
					//email check if it exists----------------------------------------------
					$rez=$connection->query("SELECT id FROM uzytkownicy WHERE email='$email'");
					if(!$rez)throw new Exception($connection->error);

					$how_many_mails= $rez->num_rows;
					if($how_many_mails>0){
						$all_ok=false;
						$_SESSION['e_email']="Email address already in use";
					}
					//Login check if it exists----------------------------------------------
					$rez=$connection->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
					if(!$rez)throw new Exception($connection->error);

					$how_many_nicks= $rez->num_rows;
					if($how_many_nicks>0){
						$all_ok=false;
						$_SESSION['e_nick']="Nickname already in use";
					}

					//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					//New account
					if($all_ok==true){
						//All in working oreder, add player...
					if($connection->query("INSERT INTO uzytkownicy VALUES (NULL,'$nick','$passwords_hash','$email',100,100,100,14)")){
							$_SESSION['correctreg']=true;
							header('Location: welcom.php');
					}else{
						throw new Exception($connection->error);
					}
					}

					$connection->close();
				}
		}catch(Exception $e){
			echo '<span style="color:red">Server error</span><br/>';
		//	echo '<br/>Inf dev: '.$e;
		}

	}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Registration</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>

<style>
	.error{
		color:red;
		margin-top: 10px;
		margin-bottom: 10px;
	}

</style>


</head>

<body>
“A reader lives a thousand lives before he dies, said Jojen. The man who never reads lives only one.”
<br/><br/>

	<form method="POST">
		Nickname:<br/><input type="text" value="<?php
			if(isset($_SESSION['fr_nick'])){
				echo $_SESSION['fr_nick'];
				unset($_SESSION['fr_nick']);
			}
		?>" name="nick"><br/>
		<?php
		if(isset($_SESSION['e_nick'])){
			echo'<div class="error">'.$_SESSION["e_nick"].'</div>';
			unset($_SESSION['e_nick']);
		}
		?>

		E-mail:<br/><input type="text" value="<?php
			if(isset($_SESSION['fr_email'])){
				echo $_SESSION['fr_email'];
				unset($_SESSION['fr_email']);
			}
		?>"name="email"><br/>
		<?php
		if(isset($_SESSION['e_email'])){
			echo'<div class="error">'.$_SESSION["e_email"].'</div>';
			unset($_SESSION['e_email']);
		}
		?>

		Password:<br/><input type="password" value="<?php
			if(isset($_SESSION['fr_password1'])){
				echo $_SESSION['fr_password1'];
				unset($_SESSION['fr_password1']);
			}
		?>" name="password1"><br/>
		<?php
		if(isset($_SESSION['e_password'])){
			echo'<div class="error">'.$_SESSION["e_password"].'</div>';
			unset($_SESSION['e_password']);
		}
		?>

		Repeat Password:<br/><input type="password" value="<?php
			if(isset($_SESSION['fr_password2'])){
				echo $_SESSION['fr_password2'];
				unset($_SESSION['fr_password2']);
			}
		?>" name="password2"><br/>

		<label><input type="checkbox" name="reg" <?php 
		if(isset($_SESSION['fr_reg'])){
			echo "checked";
			unset($_SESSION['fr_reg']);
		}
		 ?>
		 />I agree to the Terms and Conditions</label>
		<?php
		if(isset($_SESSION['e_reg'])){
			echo'<div class="error">'.$_SESSION["e_reg"].'</div>';
			unset($_SESSION['e_reg']);
		}
		?>
		<div class="g-recaptcha" data-sitekey="6LdYIRYUAAAAANzgagw49nv9qkFwmT4LUX6XpJDc"></div>
		<?php
		if(isset($_SESSION['e_bot'])){
			echo'<div class="error">'.$_SESSION["e_bot"].'</div>';
			unset($_SESSION['e_bot']);
		}
		?>
		<br/>
		<input type="submit" value="Register"/>


	</form>

</body>
</html>