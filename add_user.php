<?php
include_once('PDOFactory.php');
include_once('library.php');
include_once('classes/user.php');
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
$role = 1;
echo 'Hello';
if(!isEmailValid($email)){
     header('Location: register.php?error=Please Enter a valid email ' . $email);
}
else if($email === "" or $username === "" or $password === "" or $check === ""){
	header('Location: register.php?error=Please enter all data please');
}
else if($password !== $check){
	header('Location: register.php?error=Passwords don\'t match');
}
else if(!preg_match('/^([a-zA-Z0-9_]{3,15})/',$username)){

	header('Location: register.php?error=Your username can only contain Alphanumerics and Underscores, and be between 3 and 15 characters');
}
else if(strlen($password) < 8 ){

	header('Location: register.php?error=Password is not long enough');
}
else{
	$password = password_hash($password, PASSWORD_DEFAULT);
	$user = User::createNewUser($username, $email, $password, $location, $n64, $ssbm, $ssbb, $ssbpm, $roa, $ssb4, $role);

	$_SESSION['user_id'] = $user->getID();
	header('Location: index.php');
}
