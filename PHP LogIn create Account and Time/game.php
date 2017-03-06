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
echo"<br/><b>End of premium</b> ".$_SESSION['dnipremium']."</p>";

$datatime = new DateTime();
echo "Date and time server: ".$datatime->format('Y-m-d h:i:s'); //z apacha?

$endP = DateTime::createFromFormat('Y-m-d h:i:s', $_SESSION['dnipremium']);

$difference = $datatime->diff($endP);
if($datatime<$endP){
	echo "<br/>To end premium: ".$difference->format('%m month, %d days, %h hours, %i min, %s sek');

}else echo "<br/>Premium has ended : ".$difference->format('%y years, %m month, %d days, %h hours, %i min, %s sek');
?>


</form>

</body>
</html>