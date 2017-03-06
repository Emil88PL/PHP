<?php
session_start();

if(!isset($_SESSION['logged'])){
	header('Location: index.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Game</title>
</head>

<body>
“A reader lives a thousand lives before he dies, said Jojen. The man who never reads lives only one.”

<?php

echo"<p>Witaj ".$_SESSION['user'].'![<a href="logout.php">Sign out</a>]</p>';
echo"<p><b>Drewno</b>: ".$_SESSION['drewno'];
echo"| <b>Kamien</b>: ".$_SESSION['kamien'];
echo"| <b>Zboze</b>: ".$_SESSION['zboze']."</p>";

echo"<p><b>E-mail</b>: ".$_SESSION['email'];
echo"<br/><b>Dni premium</b> ".$_SESSION['dnipremium']."</p>";

?>


</form>

</body>
</html>