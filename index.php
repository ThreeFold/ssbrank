<?php
    include('header.php');
    ?>
    <div class="content">
    <?php
    if($_SESSION['user_id'] == ''){
        header('Location: /landing.php');
    }
    $posts = PDOFactory::getPosts();
    echo formatPosts($posts);
    ?>
    </div>
<?php
include('footer.php');
?>