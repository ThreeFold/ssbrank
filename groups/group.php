<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/header.php";
	include_once($path);
	include_once("groupHeader.php");
?>
	
    
    <?php
    $db = PDOFactory::getConnection();
    $stmt = $db->prepare('SELECT * from community where name = ?');
    $stmt->execute([$_GET['name']]);
    $info = $stmt->fetch();
    $users = get_users($_GET['name']);
    echo '<div id="group-desc">';
    echo '<h3>' . $info['name'] . '</h3>';
    echo '<div class="header" style="background-image:url(' . $info['header_image'] . ')"></div>';
    echo '<p>' . $info['description'] . '</p>';
    echo '<h4>Members</h4>';
    echo '<div class="user-images">';
    foreach($users as $user){
        $img = get_gravatar($user['email'], 30);
        echo '<a href="/users/user.php?name=' . $user['name'] . '">'; 
        echo '<img src="' . $img . '">';
        echo '</a>';
    }
    echo '</div>';
    echo '</div>';
    ?>

    <?php
    $posts = PDOFactory::getGroupPosts($_GET['name']);
    echo formatPosts($posts);
    ?>
    </div>

<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/footer.php";
	include_once($path);
?>