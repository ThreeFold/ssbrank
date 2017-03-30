<!DOCTYPE html>
<html>

<head>
<title>Smash Rank</title>
    <link href="/rsc/master.css" rel="stylesheet">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
</head>
<body>
    <div id="main-nav">
        <div id="user-block">
<?php 

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } 

    $db = new PDO("mysql:host=127.0.0.1;dbname=ssbrank;charset=utf8", "root", '');
    $stmt = $db->prepare('SELECT * from user where id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if(empty($user)){
        header('Location:landing.php');
    }

?>
            <div class="user-image">
                <img src="/users/<?php echo $user['id']; ?>/profile-image_100.png" />
            </div>
            <p id="username"><?php echo $user['name'] ?></p>
        </div>
        <ul id="navbar">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/groups/">Community</a></li>
            <li><a href="/ranking/">Ranks</a></li>
            <li><a href="/tourney/">Tourneys</a></li>
        </ul>
    </div>
