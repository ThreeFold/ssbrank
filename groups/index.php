<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/header.php";
	include_once($path);
	include_once("groupHeader.php");
?>
	
    
    <?php
    $posts = PDOFactory::getPosts();
    echo formatPosts($posts);
    ?>

    </div>

<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/footer.php";
	include_once($path);
?>