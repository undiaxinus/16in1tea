<?php
session_start();
unset($_SESSION['Role']);
header('Location: ../login.php?success=Account Logged out');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php 
	session_destroy();
	?>
</body>
</html>