<?php
	session_start();

	include_once('PDOFactory.php');
    $db = PDOFactory::getConnection();
    $stmt = $db->prepare('SELECT * from user where  email = ?');
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    if(!password_verify($_POST['password'],$user['password'])){
        $_SESSION['login-error'] = ['email' => $_POST['email']];
    	header('Location: login.php?error=Issue with login, account not found or password not valid');
    }
    else{
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
    }