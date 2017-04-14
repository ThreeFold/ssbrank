<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	include_once($path . '/classes/user.php');
	include_once($path . '/library.php');

    session_start();
	
	$user = User::onlyID($_SESSION['user_id']);
	echo print_r($_POST, true);
	$data = json_decode($_POST['data'], true);
	$msg = "";
	if(!preg_match('/^([a-zA-Z]{0,4})/', $_POST['team'])){
		$msg .= "<li>Team name must be between 0 and 4 characters<li>";
	}
	if($_post['username'] !== "" and !preg_match('/^([a-zA-Z_]{3,15})/',$_POST['username'])){
		$msg .= "<li>Username was not valid<li>";
	}
	if($msg === ""){


	}
	else{
		header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => $msg)));

	}