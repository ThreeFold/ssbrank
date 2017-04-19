<!DOCTYPE html>
<html>
<head>
	<title>SSBRank</title>
	<link href="/rsc/landing.css" rel="stylesheet">
</head>
<?php

session_start();
unset($_SESSION['user_id']);
?>
<body>
	<div class="centered">
	<h1>Sign up for SSBRank!</h1>
	<a class="landing-button" href="register.php">Register!</a>
	<p>Already signed up? <a href="login.php">Login!</a></p>
	</div>
</body>
</html>