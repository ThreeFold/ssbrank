<!DOCTYPE html>
<html>

<head>
<title>Smash Rank</title>
    <link href="/rsc/master.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div id="main-nav">
        <div id="user-block">
<?php 
    
    include_once('PDOFactory.php');
    include_once('library.php');
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } 
    $db = PDOFactory::getConnection();
    $stmt = $db->prepare('SELECT * from user where id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if(empty($user)){
        header('Location:/landing.php');
    }

?>
            <div class="user-image">
                <img src="<?php echo get_gravatar($user['email'],100); ?>" />
            </div>
            <p id="username"><?php echo $user['name'] ?> <span class="role"><?php echo get_role($user['role']);?></span></p>
        </div>
        <ul id="navbar">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/groups/">Community</a></li>
            <li><a href="/ranking/">Ranks</a></li>
            <li><a href="/tourney/">Tourneys</a></li>
        </ul>
    </div>
