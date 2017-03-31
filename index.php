<?php
    include('header.php');

    ?>
    <div class="content">
    <?php
    if($_SESSION['user_id'] == ''){
        header('Location: landing.php');
    }
    $posts = PDOFactory::getPosts();
    //NOTE: possible to transport this in ajax

    foreach($posts as $post){
        echo '<div class="post ';
        if ($post["type"] == 2)
            echo 'event-post';
        echo '">
            <div class="poster-info">
                <img class="poster-image" src="'. get_gravatar($post['email']) .'" />
                <a href="/groups/group.php?name='. $post['group_name'] .'" class="post-location">'. $post["group_name"] .'</a>
                <a href="/users/user.php?name='. $post['name'] .'" class="poster-name">'. $post["name"] .'</a>
            </div>
            <div class="clear"></div>';
        if ($post["type"] == 2)
            echo '<img src="'.$post["event-image"].'" class="event-image" />';
        echo '<div class="text">' . $post["text"] . '</div>
            <hr/>
            <a href="" class="button comment">Comment</a>
        </div>';
    }
    ?>
    </div>
<?php
include('footer.php');
?>