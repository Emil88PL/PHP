<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Order</title>
</head>
<body>

<?php

$firstText = $_POST["x"];  //any name for variable but in ['name']
$secondText = $_POST['y'];
$sum = 0.99*$firstText + 1.29*$secondText;

echo<<<END

<h2>Order</h2>

<table border="1" cellpadding="10" cellspaceing="0">
<tr>
	<td>x(0.99p)</td> <td>$firstText</td>
</tr>
<tr>
	<td>y(1.29p)</td> <td>$secondText</td>
</tr>
<tr>
	<td>Sum</td> <td>$sum</td>
</tr>
</table>
<br/><a href="index.php">Go back</a>

END;

?>

</body>
</html>