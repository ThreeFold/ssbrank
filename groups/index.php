<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/header.php";
	include_once($path);
	include_once("groupHeader.php");
    include_once("PDOFactory.php");
?>
	
    
    <?php
    $db = new PDOFactory();
    $stmt = $db->prepare('SELECT * from posts where id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if(empty($user)){
        header('Location:landing.php');
    }
    //NOTE: possible to transport this in ajax
    
    $posts = array(
        0 => array(
            "type" => 1,
            "poster-image" => "",
            "Poster-ID" => "",
            "poster-name" => "Nick",
            "group-id" => "",
            "group-name" => "test",
            "text" => "Soufflé biscuit topping. Dessert chupa chups caramels cheesecake tiramisu cake chocolate cake. Bear claw candy cake lemon drops muffin candy chocolate cake. Marzipan soufflé gingerbread. Toffee candy canes dragée brownie gummi bears oat cake caramels chocolate cake fruitcake. Icing biscuit chupa chups powder soufflé croissant cotton candy wafer. Chocolate cake sweet roll bonbon pastry bonbon cake dessert tart caramels."
            ),
        1 => array(
            "type" => 2,
            "poster-image" => "",
            "Poster-ID" => "",
            "poster-name" => "Nick",
            "group-id" => "",
            "event-image" => "",
            "group-name" => "test",
            "text" => "Soufflé biscuit topping. Dessert chupa chups caramels cheesecake tiramisu cake chocolate cake. Bear claw candy cake lemon drops muffin candy chocolate cake. Marzipan soufflé gingerbread. Toffee candy canes dragée brownie gummi bears oat cake caramels chocolate cake fruitcake. Icing biscuit chupa chups powder soufflé croissant cotton candy wafer. Chocolate cake sweet roll bonbon pastry bonbon cake dessert tart caramels."
            ),
        );
    #NOTE: takes in a list of posts and generates posts for them, can be used later in a function if need be
    #could also rewrite in js and just pass the above information back from an ajax request
    foreach($posts as $post){
        echo '<div class="post ';
        if ($post["type"] == 2)
            echo 'event-post';
        echo '">
            <div class="poster-info">
                <img class="poster-image" src="'. $post["poster-image"] .'" />
                <a href="#" class="post-location">'. $post["group-name"] .'</a>
                <a href="#" class="poster-name">'. $post["poster-name"] .'</a>
            </div>
            <div class="clear"></div>';
        if ($post["type"] == 2)
            echo '<img src="'.$post["event-image"].'" class="event-image" />';
        echo '<div class="text">' . $post["text"] . '</div>
            <hr/>
            <a href="" class="button comment">Comment</a>
        </div>';
    }
    function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
    ?>

    </div>

<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/footer.php";
	include_once($path);
?>