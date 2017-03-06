<?php
	session_start();

	if(!isset($_SESSION['correctreg'])){
		header('Location: index.php');
		exit();
	}else{
		unset($_SESSION['correctreg']);
	}

	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//unset input
	if(isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
	if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if(isset($_SESSION['fr_password1'])) unset($_SESSION['fr_password1']);
	if(isset($_SESSION['fr_password2'])) unset($_SESSION['fr_password2']);
	if(isset($_SESSION['fr_reg'])) unset($_SESSION['fr_reg']);
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//unset errors
	if(isset($_SESSION['e_nick']))unset($_SESSION['e_nick']);
	if(isset($_SESSION['e_email']))unset($_SESSION['e_email']);
	if(isset($_SESSION['e_password1']))unset($_SESSION['e_password1']);
	if(isset($_SESSION['e_password2']))unset($_SESSION['e_password2']);
	if(isset($_SESSION['e_reg']))unset($_SESSION['e_reg']);
	if(isset($_SESSION['e_bot']))unset($_SESSION['e_bot']);


?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Registration &#9762</title>
</head>

<body>
“A reader lives a thousand lives before he dies, said Jojen. The man who never reads lives only one.”
<br/><br/>
<p>Thank you for registering</p>
<a href="index.php">Login on your account</a>

</body>
</html>