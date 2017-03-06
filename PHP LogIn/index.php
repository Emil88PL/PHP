<?php
	session_start();

	if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true)){
	header('Location: game.php');
	exit();
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>PHP LogIn &#9762</title>
</head>

<body>
“A reader lives a thousand lives before he dies, said Jojen. The man who never reads lives only one.”
<br/><br/>

<form action="login.php" method="POST">
	Login:
	<br/>
	<input type="text" name="login"/>
	<br/>
	Password:
	<br/>
	<input type="Password" name="password">
	<br/>
	<input type="submit" name="tologin">
	<br/>
</form>
<?php
	if(isset($_SESSION['blad']))echo $_SESSION['blad'];
?>
</body>
</html>