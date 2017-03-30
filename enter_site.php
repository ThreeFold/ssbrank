<?php
    $db = new PDO("mysql:host=127.0.0.1;dbname=ssbrank;charset=utf8", "root", '');
    $stmt = $db->prepare('SELECT * from user where name = ? or email = ?');
    $stmt->execute([$_POST['email'],$_POST['email']]);
    $user = $stmt->fetch();
    if(!password_verify($_POST['password'],$user['password'])){
    	header('Location: login.php?error=Issue with login, account not found or password not valid');
    }
    $_SESSION['user_id'] = $user;
    header('Location: index.php');