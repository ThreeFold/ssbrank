<?php
include_once('PDOFactory.php');
include_once('library.php');
session_start();

$email = clean($_POST['email']);
$username = clean($_POST['username']);
$password = clean($_POST['password']);
$check = clean($_POST['password-check']);
$location = clean($_POST['location']);
$n64 = checkCheckbox('n64');
$ssbm = checkCheckbox('melee');
$ssbb = checkCheckbox('ssbb');
$ssbpm = checkCheckbox('pm');
$roa = checkCheckbox('roa');
$ssb4 = checkCheckbox('sm4sh');
$user_id = uniqid('', true);
$role = 1;
 
if(!isEmailValid($email)){
     header('Location: register.php?error=Please Enter a valid email ' . $email);
}
else if($email === "" or $username === "" or $password === "" or $check === ""){
	header('Location: register.php?error=Please enter all data please');
}
else if($password !== $check){
	header('Location: register.php?error=Passwords don\'t match');
}
else if(!preg_match('/^([a-zA-Z_]{3,15})/',$username)){

	header('Location: register.php?error=Your username can only contain Alphanumerics and Underscores, and be between 3 and 15 characters');
}
else if(strlen($password) < 8 ){

	header('Location: register.php?error=Password is not long enough');
}
else{
	$db = PDOFactory::getConnection();

	$stmt = $db->prepare('INSERT INTO user (id, name,  location, password, email, role, melee, n64, sm4sh, brawl, roa, pm)
		VALUES (:id, :username, :location, :password, :email, :role, :melee, :n64, :sm4sh, :brawl, :roa, :pm)');

	$password = password_hash($password, PASSWORD_DEFAULT);
	$stmt->bindParam(':id', $user_id, PDO::PARAM_STR, 23);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR, 32);
	$stmt->bindParam(':password', $password , PDO::PARAM_STR, 256);
	$stmt->bindParam(':location', $location, PDO::PARAM_STR, 100);
	$stmt->bindParam(':email', $email, PDO::PARAM_STR, 254);
	$stmt->bindParam(':role', $role, PDO::PARAM_INT, 11);
	$stmt->bindParam(':melee', $ssbm, PDO::PARAM_BOOL);
	$stmt->bindParam(':n64', $n64, PDO::PARAM_BOOL);
	$stmt->bindParam(':sm4sh', $ssb4, PDO::PARAM_BOOL);
	$stmt->bindParam(':brawl', $ssbb, PDO::PARAM_BOOL);
	$stmt->bindParam(':roa', $roa, PDO::PARAM_BOOL);
	$stmt->bindParam(':pm', $ssbpm, PDO::PARAM_BOOL);
	$stmt->execute();

	#echo mkdir('/users/'.$user_id.'/', 0777, true);
	$_SESSION['user_id'] = $user_id;
	header('Location: index.php');
}
