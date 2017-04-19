<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include_once($path . '/classes/user.php');
include_once($path . '/library.php');

session_start();

$user = User::onlyID($_SESSION['user_id']);
echo print_r($_POST, true);
$msg = "";
try{
	if(!preg_match('/^([a-zA-Z]{0,4})/', $_POST['team'])){
		$msg .= "<li>Team name must be between 0 and 4 characters<li>";
	}
	else{
		if($_POST['team'] !== "")
		$user->setTeam(clean($_POST['team']));
	}
	if($_POST['username'] !== "" and !preg_match('/^([a-zA-Z0-9_]{3,15})/',$_POST['username'])){
		$msg .= "<li>Username was not valid<li>";
	}
	else {
		if($_POST['username'] !== "")
		$user->setName(clean($_POST['username']));
	}
	if($msg === ""){
		$user->setGames($_POST['games']);
		$user->saveSettings();
	}

	else{
		header('HTTP/1.1 400 Bad Request');
	    header('Content-Type: application/json; charset=UTF-8');
	    die(json_encode(array('message' => $msg)));

	}
}
catch(Exception $e){
		header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die();

}